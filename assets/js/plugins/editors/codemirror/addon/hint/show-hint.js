(function(mod) {
  if (typeof exports == "object" && typeof module == "object") // CommonJS
    mod(require("../../lib/codemirror"));
  else if (typeof define == "function" && define.amd) // AMD
    define(["../../lib/codemirror"], mod);
  else // Plain browser env
    mod(CodeMirror);
})(function(CodeMirror) {
  "use strict";

  var HINT_ELEMENT_CLASS        = "CodeMirror-hint";
  var ACTIVE_HINT_ELEMENT_CLASS = "CodeMirror-hint-active";

  CodeMirror.showHint = function(cm, getHints, options) {
    // We want a single cursor position.
    if (cm.listSelections().length > 1 || cm.somethingSelected()) return;
    if (getHints == null) {
      if (options && options.async) return;
      else getHints = CodeMirror.hint.auto;
    }

    if (cm.state.completionActive) cm.state.completionActive.close();

    var completion = cm.state.completionActive = new Completion(cm, getHints, options || {});
    CodeMirror.signal(cm, "startCompletion", cm);
    if (completion.options.async)
      getHints(cm, function(hints) { completion.showHints(hints); }, completion.options);
    else
      return completion.showHints(getHints(cm, completion.options));
  };

  function Completion(cm, getHints, options) {
    this.cm = cm;
    this.getHints = getHints;
    this.options = options;
    this.widget = this.onClose = null;
  }

  Completion.prototype = {
    close: function() {
      if (!this.active()) return;
      this.cm.state.completionActive = null;

      if (this.widget) this.widget.close();
      if (this.onClose) this.onClose();
      CodeMirror.signal(this.cm, "endCompletion", this.cm);
    },

    active: function() {
      return this.cm.state.completionActive == this;
    },

    pick: function(data, i) {
      var completion = data.list[i];
      if (completion.hint) completion.hint(this.cm, data, completion);
      else this.cm.replaceRange(getText(completion), completion.from || data.from,
                                completion.to || data.to, "complete");
      CodeMirror.signal(data, "pick", completion);
      this.close();
    },

    showHints: function(data) {
      if (!data || !data.list.length || !this.active()) return this.close();

      if (this.options.completeSingle != false && data.list.length == 1)
        this.pick(data, 0);
      else
        this.showWidget(data);
    },

    showWidget: function(data) {
      this.widget = new Widget(this, data);
      CodeMirror.signal(data, "shown");

      var debounce = 0, completion = this, finished;
      var closeOn = this.options.closeCharacters || /[\s()\[\]{};:>,]/;
      var startPos = this.cm.getCursor(), startLen = this.cm.getLine(startPos.line).length;

      var requestAnimationFrame = window.requestAnimationFrame || function(fn) {
        return setTimeout(fn, 1000/60);
      };
      var cancelAnimationFrame = window.cancelAnimationFrame || clearTimeout;

      function done() {
        if (finished) return;
        finished = true;
        completion.close();
        completion.cm.off("cursorActivity", activity);
        if (data) CodeMirror.signal(data, "close");
      }

      function update() {
        if (finished) return;
        CodeMirror.signal(data, "update");
        if (completion.options.async)
          completion.getHints(completion.cm, finishUpdate, completion.options);
        else
          finishUpdate(completion.getHints(completion.cm, completion.options));
      }
      function finishUpdate(data_) {
        data = data_;
        if (finished) return;
        if (!data || !data.list.length) return done();
        if (completion.widget) completion.widget.close();
        completion.widget = new Widget(completion, data);
      }

      function clearDebounce() {
        if (debounce) {
          cancelAnimationFrame(debounce);
          debounce = 0;
        }
      }

      function activity() {
        clearDebounce();
        var pos = completion.cm.getCursor(), line = completion.cm.getLine(pos.line);
        if (pos.line != startPos.line || line.length - pos.ch != startLen - startPos.ch ||
            pos.ch < startPos.ch || completion.cm.somethingSelected() ||
            (pos.ch && closeOn.test(line.charAt(pos.ch - 1)))) {
          completion.close();
        } else {
          debounce = requestAnimationFrame(update);
          if (completion.widget) completion.widget.close();
        }
      }
      this.cm.on("cursorActivity", activity);
      this.onClose = done;
    }
  };

  function getText(completion) {
    if (typeof completion == "string") return completion;
    else return completion.text;
  }

  function buildKeyMap(options, handle) {
    var baseMap = {
      Up: function() {handle.moveFocus(-1);},
      Down: function() {handle.moveFocus(1);},
      PageUp: function() {handle.moveFocus(-handle.menuSize() + 1, true);},
      PageDown: function() {handle.moveFocus(handle.menuSize() - 1, true);},
      Home: function() {handle.setFocus(0);},
      End: function() {handle.setFocus(handle.length - 1);},
      Enter: handle.pick,
      Tab: handle.pick,
      Esc: handle.close
    };
    var ourMap = options.customKeys ? {} : baseMap;
    function addBinding(key, val) {
      var bound;
      if (typeof val != "string")
        bound = function(cm) { return val(cm, handle); };
      // This mechanism is deprecated
      else if (baseMap.hasOwnProperty(val))
        bound = baseMap[val];
      else
        bound = val;
      ourMap[key] = bound;
    }
    if (options.customKeys)
      for (var key in options.customKeys) if (options.customKeys.hasOwnProperty(key))
        addBinding(key, options.customKeys[key]);
    if (options.extraKeys)
      for (var key in options.extraKeys) if (options.extraKeys.hasOwnProperty(key))
        addBinding(key, options.extraKeys[key]);
    return ourMap;
  }

  function getHintElement(hintsElement, el) {
    while (el && el != hintsElement) {
      if (el.nodeName.toUpperCase() === "LI" && el.parentNode == hintsElement) return el;
      el = el.parentNode;
    }
  }

  function Widget(completion, data) {
    this.completion = completion;
    this.data = data;
    var widget = this, cm = completion.cm, options = completion.options;

    var hints = this.hints = document.createElement("ul");
    hints.className = "CodeMirror-hints";
    this.selectedHint = options.getDefaultSelection ? options.getDefaultSelection(cm,options,data) : 0;

    var completions = data.list;
    for (var i = 0; i < completions.length; ++i) {
      var elt = hints.appendChild(document.createElement("li")), cur = completions[i];
      var className = HINT_ELEMENT_CLASS + (i != this.selectedHint ? "" : " " + ACTIVE_HINT_ELEMENT_CLASS);
      if (cur.className != null) className = cur.className + " " + className;
      elt.className = className;
      if (cur.render) cur.render(elt, data, cur);
      else elt.appendChild(document.createTextNode(cur.displayText || getText(cur)));
      elt.hintId = i;
    }

    var pos = cm.cursorCoords(options.alignWithWord !== false ? data.from : null);
    var left = pos.left, top = pos.bottom, below = true;
    hints.style.left = left + "px";
    hints.style.top = top + "px";
    // If we're at the edge of the screen, then we want the menu to appear on the left of the cursor.
    var winW = window.innerWidth || Math.max(document.body.offsetWidth, document.documentElement.offsetWidth);
    var winH = window.innerHeight || Math.max(document.body.offsetHeight, document.documentElement.offsetHeight);
    (options.container || document.body).appendChild(hints);
    var box = hints.getBoundingClientRect(), overlapY = box.bottom - winH;
    if (overlapY > 0) {
      var height = box.bottom - box.top, curTop = box.top - (pos.bottom - pos.top);
      if (curTop - height > 0) { // Fits above cursor
        hints.style.top = (top = curTop - height) + "px";
        below = false;
      } else if (height > winH) {
        hints.style.height = (winH - 5) + "px";
        hints.style.top = (top = pos.bottom - box.top) + "px";
        var cursor = cm.getCursor();
        if (data.from.ch != cursor.ch) {
          pos = cm.cursorCoords(cursor);
          hints.style.left = (left = pos.left) + "px";
          box = hints.getBoundingClientRect();
        }
      }
    }
    var overlapX = box.left - winW;
    if (overlapX > 0) {
      if (box.right - box.left > winW) {
        hints.style.width = (winW - 5) + "px";
        overlapX -= (box.right - box.left) - winW;
      }
      hints.style.left = (left = pos.left - overlapX) + "px";
    }

    cm.addKeyMap(this.keyMap = buildKeyMap(options, {
      moveFocus: function(n, avoidWrap) { widget.changeActive(widget.selectedHint + n, avoidWrap); },
      setFocus: function(n) { widget.changeActive(n); },
      menuSize: function() { return widget.screenAmount(); },
      length: completions.length,
      close: function() { completion.close(); },
      pick: function() { widget.pick(); },
      data: data
    }));

    if (options.closeOnUnfocus !== false) {
      var closingOnBlur;
      cm.on("blur", this.onBlur = function() { closingOnBlur = setTimeout(function() { completion.close(); }, 100); });
      cm.on("focus", this.onFocus = function() { clearTimeout(closingOnBlur); });
    }

    var startScroll = cm.getScrollInfo();
    cm.on("scroll", this.onScroll = function() {
      var curScroll = cm.getScrollInfo(), editor = cm.getWrapperElement().getBoundingClientRect();
      var newTop = top + startScroll.top - curScroll.top;
      var point = newTop - (window.pageYOffset || (document.documentElement || document.body).scrollTop);
      if (!below) point += hints.offsetHeight;
      if (point <= editor.top || point >= editor.bottom) return completion.close();
      hints.style.top = newTop + "px";
      hints.style.left = (left + startScroll.left - curScroll.left) + "px";
    });

    CodeMirror.on(hints, "dblclick", function(e) {
      var t = getHintElement(hints, e.target || e.srcElement);
      if (t && t.hintId != null) {widget.changeActive(t.hintId); widget.pick();}
    });

    CodeMirror.on(hints, "click", function(e) {
      var t = getHintElement(hints, e.target || e.srcElement);
      if (t && t.hintId != null) {
        widget.changeActive(t.hintId);
        if (options.completeOnSingleClick) widget.pick();
      }
    });

    CodeMirror.on(hints, "mousedown", function() {
      setTimeout(function(){cm.focus();}, 20);
    });

    CodeMirror.signal(data, "select", completions[0], hints.firstChild);
    return true;
  }

  Widget.prototype = {
    close: function() {
      if (this.completion.widget != this) return;
      this.completion.widget = null;
      this.hints.parentNode.removeChild(this.hints);
      this.completion.cm.removeKeyMap(this.keyMap);

      var cm = this.completion.cm;
      if (this.completion.options.closeOnUnfocus !== false) {
        cm.off("blur", this.onBlur);
        cm.off("focus", this.onFocus);
      }
      cm.off("scroll", this.onScroll);
    },

    pick: function() {
      this.completion.pick(this.data, this.selectedHint);
    },

    changeActive: function(i, avoidWrap) {
      if (i >= this.data.list.length)
        i = avoidWrap ? this.data.list.length - 1 : 0;
      else if (i < 0)
        i = avoidWrap ? 0  : this.data.list.length - 1;
      if (this.selectedHint == i) return;
      var node = this.hints.childNodes[this.selectedHint];
      node.className = node.className.replace(" " + ACTIVE_HINT_ELEMENT_CLASS, "");
      node = this.hints.childNodes[this.selectedHint = i];
      node.className += " " + ACTIVE_HINT_ELEMENT_CLASS;
      if (node.offsetTop < this.hints.scrollTop)
        this.hints.scrollTop = node.offsetTop - 3;
      else if (node.offsetTop + node.offsetHeight > this.hints.scrollTop + this.hints.clientHeight)
        this.hints.scrollTop = node.offsetTop + node.offsetHeight - this.hints.clientHeight + 3;
      CodeMirror.signal(this.data, "select", this.data.list[this.selectedHint], node);
    },

    screenAmount: function() {
      return Math.floor(this.hints.clientHeight / this.hints.firstChild.offsetHeight) || 1;
    }
  };

  CodeMirror.registerHelper("hint", "auto", function(cm, options) {
    var helpers = cm.getHelpers(cm.getCursor(), "hint"), words;
    if (helpers.length) {
      for (var i = 0; i < helpers.length; i++) {
        var cur = helpers[i](cm, options);
        if (cur && cur.list.length) return cur;
      }
    } else if (words = cm.getHelper(cm.getCursor(), "hintWords")) {
      if (words) return CodeMirror.hint.fromList(cm, {words: words});
    } else if (CodeMirror.hint.anyword) {
      return CodeMirror.hint.anyword(cm, options);
    }
  });

  CodeMirror.registerHelper("hint", "fromList", function(cm, options) {
    var cur = cm.getCursor(), token = cm.getTokenAt(cur);
    var found = [];
    for (var i = 0; i < options.words.length; i++) {
      var word = options.words[i];
      if (word.slice(0, token.string.length) == token.string)
        found.push(word);
    }

    if (found.length) return {
      list: found,
      from: CodeMirror.Pos(cur.line, token.start),
            to: CodeMirror.Pos(cur.line, token.end)
    };
  });

  CodeMirror.commands.autocomplete = CodeMirror.showHint;
});
