(function(mod) {
  if (typeof exports == "object" && typeof module == "object") // CommonJS
    mod(require("../lib/codemirror"));
  else if (typeof define == "function" && define.amd) // AMD
    define(["../lib/codemirror"], mod);
  else // Plain browser env
    mod(CodeMirror);
})(function(CodeMirror) {
  "use strict";

CodeMirror.modeInfo = [
  {name: 'APL', mime: 'text/apl', mode: 'apl'},
  {name: 'Asterisk', mime: 'text/x-asterisk', mode: 'asterisk'},
  {name: 'C', mime: 'text/x-csrc', mode: 'clike'},
  {name: 'C++', mime: 'text/x-c++src', mode: 'clike'},
  {name: 'Cobol', mime: 'text/x-cobol', mode: 'cobol'},
  {name: 'Java', mime: 'text/x-java', mode: 'clike'},
  {name: 'C#', mime: 'text/x-csharp', mode: 'clike'},
  {name: 'Scala', mime: 'text/x-scala', mode: 'clike'},
  {name: 'Clojure', mime: 'text/x-clojure', mode: 'clojure'},
  {name: 'CoffeeScript', mime: 'text/x-coffeescript', mode: 'coffeescript'},
  {name: 'Common Lisp', mime: 'text/x-common-lisp', mode: 'commonlisp'},
  {name: 'CSS', mime: 'text/css', mode: 'css'},
  {name: 'D', mime: 'text/x-d', mode: 'd'},
  {name: 'diff', mime: 'text/x-diff', mode: 'diff'},
  {name: 'DTD', mime: 'application/xml-dtd', mode: 'dtd'},
  {name: 'Dylan', mime: 'text/x-dylan', mode: 'dylan'},
  {name: 'ECL', mime: 'text/x-ecl', mode: 'ecl'},
  {name: 'Eiffel', mime: 'text/x-eiffel', mode: 'eiffel'},
  {name: 'Erlang', mime: 'text/x-erlang', mode: 'erlang'},
  {name: 'Fortran', mime: 'text/x-fortran', mode: 'fortran'},
  {name: 'F#', mime: 'text/x-fsharp', mode: 'mllike'},
  {name: 'Gas', mime: 'text/x-gas', mode: 'gas'},
  {name: 'Gherkin', mime: 'text/x-feature', mode: 'gherkin'},
  {name: 'GitHub Flavored Markdown', mime: 'text/x-gfm', mode: 'gfm'},
  {name: 'Go', mime: 'text/x-go', mode: 'go'},
  {name: 'Groovy', mime: 'text/x-groovy', mode: 'groovy'},
  {name: 'HAML', mime: 'text/x-haml', mode: 'haml'},
  {name: 'Haskell', mime: 'text/x-haskell', mode: 'haskell'},
  {name: 'Haxe', mime: 'text/x-haxe', mode: 'haxe'},
  {name: 'ASP.NET', mime: 'application/x-aspx', mode: 'htmlembedded'},
  {name: 'Embedded Javascript', mime: 'application/x-ejs', mode: 'htmlembedded'},
  {name: 'JavaServer Pages', mime: 'application/x-jsp', mode: 'htmlembedded'},
  {name: 'HTML', mime: 'text/html', mode: 'htmlmixed'},
  {name: 'HTTP', mime: 'message/http', mode: 'http'},
  {name: 'Jade', mime: 'text/x-jade', mode: 'jade'},
  {name: 'JavaScript', mime: 'text/javascript', mode: 'javascript'},
  {name: 'JSON', mime: 'application/x-json', mode: 'javascript'},
  {name: 'JSON', mime: 'application/json', mode: 'javascript'},
  {name: 'JSON-LD', mime: 'application/ld+json', mode: 'javascript'},
  {name: 'TypeScript', mime: 'application/typescript', mode: 'javascript'},
  {name: 'Jinja2', mime: null, mode: 'jinja2'},
  {name: 'Julia', mime: 'text/x-julia', mode: 'julia'},
  {name: 'LESS', mime: 'text/x-less', mode: 'css'},
  {name: 'LiveScript', mime: 'text/x-livescript', mode: 'livescript'},
  {name: 'Lua', mime: 'text/x-lua', mode: 'lua'},
  {name: 'Markdown (GitHub-flavour)', mime: 'text/x-markdown', mode: 'markdown'},
  {name: 'mIRC', mime: 'text/mirc', mode: 'mirc'},
  {name: 'Nginx', mime: 'text/x-nginx-conf', mode: 'nginx'},
  {name: 'NTriples', mime: 'text/n-triples', mode: 'ntriples'},
  {name: 'OCaml', mime: 'text/x-ocaml', mode: 'mllike'},
  {name: 'Octave', mime: 'text/x-octave', mode: 'octave'},
  {name: 'Pascal', mime: 'text/x-pascal', mode: 'pascal'},
  {name: 'PEG.js', mime: null, mode: 'pegjs'},
  {name: 'Perl', mime: 'text/x-perl', mode: 'perl'},
  {name: 'PHP', mime: 'text/x-php', mode: 'php'},
  {name: 'PHP(HTML)', mime: 'application/x-httpd-php', mode: 'php'},
  {name: 'Pig', mime: 'text/x-pig', mode: 'pig'},
  {name: 'Plain Text', mime: 'text/plain', mode: 'null'},
  {name: 'Properties files', mime: 'text/x-properties', mode: 'properties'},
  {name: 'Python', mime: 'text/x-python', mode: 'python'},
  {name: 'Puppet', mime: 'text/x-puppet', mode: 'puppet'},
  {name: 'Cython', mime: 'text/x-cython', mode: 'python'},
  {name: 'R', mime: 'text/x-rsrc', mode: 'r'},
  {name: 'reStructuredText', mime: 'text/x-rst', mode: 'rst'},
  {name: 'Ruby', mime: 'text/x-ruby', mode: 'ruby'},
  {name: 'Rust', mime: 'text/x-rustsrc', mode: 'rust'},
  {name: 'Sass', mime: 'text/x-sass', mode: 'sass'},
  {name: 'Scheme', mime: 'text/x-scheme', mode: 'scheme'},
  {name: 'SCSS', mime: 'text/x-scss', mode: 'css'},
  {name: 'Shell', mime: 'text/x-sh', mode: 'shell'},
  {name: 'Sieve', mime: 'application/sieve', mode: 'sieve'},
  {name: 'Smalltalk', mime: 'text/x-stsrc', mode: 'smalltalk'},
  {name: 'Smarty', mime: 'text/x-smarty', mode: 'smarty'},
  {name: 'SmartyMixed', mime: 'text/x-smarty', mode: 'smartymixed'},
  {name: 'Solr', mime: 'text/x-solr', mode: 'solr'},
  {name: 'SPARQL', mime: 'application/x-sparql-query', mode: 'sparql'},
  {name: 'SQL', mime: 'text/x-sql', mode: 'sql'},
  {name: 'MariaDB', mime: 'text/x-mariadb', mode: 'sql'},
  {name: 'sTeX', mime: 'text/x-stex', mode: 'stex'},
  {name: 'LaTeX', mime: 'text/x-latex', mode: 'stex'},
  {name: 'SystemVerilog', mime: 'text/x-systemverilog', mode: 'verilog'},
  {name: 'Tcl', mime: 'text/x-tcl', mode: 'tcl'},
  {name: 'TiddlyWiki ', mime: 'text/x-tiddlywiki', mode: 'tiddlywiki'},
  {name: 'Tiki wiki', mime: 'text/tiki', mode: 'tiki'},
  {name: 'TOML', mime: 'text/x-toml', mode: 'toml'},
  {name: 'Turtle', mime: 'text/turtle', mode: 'turtle'},
  {name: 'VB.NET', mime: 'text/x-vb', mode: 'vb'},
  {name: 'VBScript', mime: 'text/vbscript', mode: 'vbscript'},
  {name: 'Velocity', mime: 'text/velocity', mode: 'velocity'},
  {name: 'Verilog', mime: 'text/x-verilog', mode: 'verilog'},
  {name: 'XML', mime: 'application/xml', mode: 'xml'},
  {name: 'XQuery', mime: 'application/xquery', mode: 'xquery'},
  {name: 'YAML', mime: 'text/x-yaml', mode: 'yaml'},
  {name: 'Z80', mime: 'text/x-z80', mode: 'z80'}
];

});
