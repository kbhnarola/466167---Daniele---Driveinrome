<?php 
if($this->uri->segment(1) == "" || $this->uri->segment(1) =="about_us" || $this->uri->segment(1) =="contact_us" || $this->uri->segment(1) =="properties" || $this->uri->segment(1) =="property_details" || $this->uri->segment(1) =="transactions" || $this->uri->segment(1) =="update_profile" || $this->uri->segment(1) =="reset_password") { ?>
<!-- Footer content start -->

    <footer class="footer-section">
        <div class="container">
            <div class="row">
              <div class="col-sm-12 text-center">
                <div class="bottom-logo">
                    <img src="<?php echo ASSET.'web/images/logo.png'; ?>" class="img-fluid" width="150px">
                </div>
              </div>
            </div>
            <div class="row">
             
              <div class="col-sm-12 mt-2 mt-md-4 pt-2">
                  <div class="footer-link text-center">
                    <a href="<?php echo BASE_URL; ?>" class="text-white pr-2 pr-xl-3">Home</a> 
                    <span class="text-white"> | </span>
                     <?php
                if(!(is_array($this->session->userdata('user_info')) && sizeof($this->session->userdata('user_info'))>0))
                  { 
                     
                    if($this->uri->segment(1) == ""){ ?>
                        <a href="#subscribe" class="text-white pl-2 pr-2 pl-xl-3 pr-xl-3 pricing_link">Subscribe Now</a>
                    <?php } else { ?>
                        <a href="<?php echo BASE_URL.'#subscribe'; ?>" class="text-white pl-2 pr-2 pl-xl-3 pr-xl-3">Subscribe Now</a>
                    <?php } ?>
                    <span class="text-white"> | </span>
                    <?php } 
                if(is_array($this->session->userdata('user_info')) && sizeof($this->session->userdata('user_info'))>0)
                  { ?>
                <a href="<?php echo BASE_URL.'properties'; ?>" class="text-white pl-2 pr-2 pl-xl-3 pr-xl-3">Properties</a>
                    <span class="text-white"> | </span>
                    
                <?php } ?>
                    <a href="<?php echo BASE_URL.'about_us'; ?>" class="text-white pl-2 pr-2 pl-xl-3 pr-xl-3">About Us</a>
                    <span class="text-white"> | </span>
                    <a href="<?php echo BASE_URL.'contact_us'; ?>" class="text-white pl-2 pl-xl-3">Contact Us</a>
                  </div>
              </div>
            </div>
        </div>
    </footer>
  
    <div class="copyright-main">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-sm-12 col-md-12 col-lg-7 col-xl-8 text-center text-lg-left">
                <span class="cpy-txt text-white">Copyright © 2020 All Access Foreclosures - All Rights Reserved.</span>
            </div>
            
          </div>
        </div>
      </div>
    <!-- Footer content End -->
<?php } ?>
 <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered log-for" role="document">
                <div class="modal-content tabcontent" id="login">
                    <div class="modal-header border-bottom-0">
                        <div class="heading-form w-100">
                            <h1 class="text-center text-transform-uppercase"><b>Log<span class="txt-yellow">in</span></b></h1>
                            <div class="border-line mb-4"></div>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12 col-xl-12" id="login_form_content" >
                                  <div class="alert alert-success" id="login_success_msg">
                                    
                                  </div>
                                  <div class="alert alert-danger" id="login_error_msg">
                                    
                                  </div>
                                    <form id="login_form" method="post" >
                                      <div class="form-group position-relative">
                                          <label class="box-label">Email <span class="required">*</span></label>
                                          <input type="text" class="input-box" placeholder="Please Enter Email" name="user_email" >
                                          <span class="fas fa-envelope box-icon"></span>
                                          <div class="myErrors1"></div>
                                      </div>
                                      <div class="form-group position-relative">
                                          <label class="box-label">Password <span class="required">*</span></label>
                                          <input type="password" class="input-box" placeholder="Please Enter Password" name="user_password" id="login_password">
                                          <span class="fas fa-key box-icon"></span>
                                          <!-- <span id="show_password"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                          <span id="hide_password" style="display:none"><i class="fa fa-eye-slash" aria-hidden="true"></i></span> -->

                                          <div class="myErrors1"></div>
                                      </div>
                                      <div class="form-group mt-3 pt-2">
                                          <div class="custom-control custom-checkbox">
                                              <input type="checkbox" class="custom-control-input rem-chkbox" id="customCheck11" name="remember_me" value="1">
                                              <label class="custom-control-label rem-label" for="customCheck11">Remember me</label>
                                              <a type="button" class="forgot-block float-right" onclick="openCity(event, 'forgot')">
                                                  <i class="fas fa-lock d-none d-sm-inline"></i> 
                                                  Forgot Password?
                                              </a>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group mt-4 mt-lg-4">
                                          <button class="btn login-btn" type="submit" name="login_submit" value="submit" id="login_button">
                                              <i class="fas fa-user"></i> LOGIN
                                          </button>
                                      </div>
                                  </form>
                                </div>
                                <div class="col-sm-12 col-xl-12 text-center" id="loader_login"  >
                                  <img src="<?php echo ASSET.'web/images/loader.gif';?>">
                                </div>
                            </div>
                         </div>
                    </div>
                    
                </div>
                <div class="modal-content forgot-content tabcontent" id="forgot">
                    <div class="modal-header border-bottom-0">
                        <div class="heading-form w-100">
                            <h1 class="text-center text-transform-uppercase"><b>FORGOT<span class="txt-yellow"> PASSWORD</span></b></h1>
                            <div class="border-line mb-4"></div>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"> 
                        <div class="col-sm-12">
                            <div class="row">                                
                                <div class="col-sm-12 col-xl-12" id="forgot_form_content" > 
                                  <div class="alert alert-success" id="forgot_success_msg" >
                                      
                                  </div>
                                  <div class="alert alert-danger" id="forgot_error_msg">
                                    
                                  </div>
                                  <form id="forgot_password_form" method="post">
                                      <div class="form-group position-relative">
                                       
                                          <label class="box-label">Email <span class="required">*</span></label>
                                          <input type="text" class="input-box" placeholder="Please Enter Email" name="email_user">
                                          <span class="fas fa-envelope box-icon"></span>
                                          <div class="myErrors1"></div>
                                      </div>
                                      
                                      <div class="form-group mt-4 mt-lg-5">
                                          <button class="btn login-btn" type="submit" name="forgot_submit" value="submit" id="forgot_button">
                                              <i class="fas fa-key"></i> FORGOT PASSWORD
                                          </button>
                                          
                                      </div>
                                    
                                    <div class="form-group mt-2 mt-xl-4 pt-3 text-center">  
                                        <a type="button" class="text-decoration back-signup" onclick="openCity(event, 'login')" id="defaultOpen"> 
                                            <span class="forgot-block">
                                                <i class="fas fa-angle-left d-none d-sm-inline"></i>
                                                Back to Login
                                            </span>
                                        </a>
                                    </div>
                                  </form>
                                </div>
                                <div class="col-sm-12 col-xl-12 text-center" id="loader_forgot" >
                                  <img src="<?php echo ASSET.'web/images/loader.gif';?>">
                                </div>
                            </div>
                         </div>
                    </div>                    
                </div>
            </div>
  </div>
<input type="hidden" name="baseURL" id="baseURL" value="<?php echo BASE_URL; ?>">
<?php
$log_user="";
if(is_array($this->session->userdata('user_info')) && sizeof($this->session->userdata('user_info'))>0) {
  $log_user=$this->session->userdata('user_info')['username'];
} ?>
<input type="hidden" name="log_user" id="log_user" value="<?php echo $log_user; ?>">
<input type="hidden" name="uri_segment" id="uri_segment" value="<?php echo $this->uri->segment(1); ?>">

<script type="text/javascript" src="<?php echo ASSET.'web/js/jquery.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo ASSET.'web/js/jquery.validate.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo ASSET.'web/js/additional-methods.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo ASSET.'web/js/sweetalert.min.js'; ?>"></script>

<script type="text/javascript">

    var baseURL = jQuery("#baseURL").val();

    jQuery(".open_login_model").click(function(){
          jQuery("#login").show();
          jQuery("#forgot").hide();
    });

    

        function openCity(evt, cityName) {

          var i, tabcontent, tablinks;
          tabcontent = document.getElementsByClassName("tabcontent");
          for (i = 0; i < tabcontent.length; i++) {
              tabcontent[i].style.display = "none";
          }
          tablinks = document.getElementsByClassName("tablinks");
          for (i = 0; i < tablinks.length; i++) {
              tablinks[i].className = tablinks[i].className.replace(" active", "");
          }
          document.getElementById(cityName).style.display = "flex";
          evt.currentTarget.className += " active";


          if(cityName=="login") {

             jQuery("label.help-inline-error").css("display","none");
             jQuery("#login_form")[0].reset();            
             
          }
          if(cityName=="forgot") {

            jQuery("label.help-inline-error").css("display","none");
            jQuery("#forgot_password_form")[0].reset();            
            
          }
        }

        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();

  function getElementY(query) {
    return window.pageYOffset + document.querySelector(query).getBoundingClientRect().top
  }
  function doScrolling(element, duration) {
    var startingY = window.pageYOffset
    var elementY = getElementY(element)
    // If element is close to page's bottom then window will scroll only to some position above the element.
    var targetY = document.body.scrollHeight - elementY < window.innerHeight ? document.body.scrollHeight - window.innerHeight : elementY
    var diff = targetY - startingY
    // Easing function: easeInOutCubic
    // From: https://gist.github.com/gre/1650294
    var easing = function (t) { return t<.5 ? 4*t*t*t : (t-1)*(2*t-2)*(2*t-2)+1 }
    var start

    if (!diff) return

    // Bootstrap our animation - it will get called right before next frame shall be rendered.
    window.requestAnimationFrame(function step(timestamp) {
      if (!start) start = timestamp
      // Elapsed miliseconds since start of scrolling.
      var time = timestamp - start
      // Get percent of completion in range [0, 1].
      var percent = Math.min(time / duration, 1)
      // Apply the easing.
      // It can cause bad-looking slow frames in browser performance tool, so be careful.
      percent = easing(percent)

      window.scrollTo(0, startingY + diff * percent)

      // Proceed with animation as long as we wanted it to.
      if (time < duration) {
        window.requestAnimationFrame(step)
      }
    })
    var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '#subscribe';
    window.history.pushState({path:newurl},'',newurl);
  }

  $('#exampleModalCenter').on('hidden.bs.modal', function () {
      jQuery("#login_form")[0].reset();
      jQuery("#forgot_password_form")[0].reset();
      jQuery("label.help-inline-error").css("display","none");
             
  });
var log_user=jQuery("#log_user").val();
if(log_user==""){
  jQuery(".pricing_link").click(function(){
      jQuery("#home").removeClass("active");
      jQuery("#pricing").addClass("active");
      jQuery("#aboutus").removeClass("active");
      jQuery("#contact_us").removeClass("active");
      jQuery("#property_list").removeClass("active");
  });
}

  var segment=jQuery("#uri_segment").val();

  if(segment == "") {
    if(log_user==""){
      document.getElementById('pricing_link').addEventListener('click', doScrolling.bind(null, '#subscribe', 1000));
    }
    jQuery("#home").addClass("active");
    jQuery("#pricing").removeClass("active");
    jQuery("#aboutus").removeClass("active");
    jQuery("#contact_us").removeClass("active");
    jQuery("#property_list").removeClass("active");

  }
 
  if(segment == "about_us") {
    jQuery("#home").removeClass("active");
    jQuery("#pricing").removeClass("active");
    jQuery("#aboutus").addClass("active");
    jQuery("#contact_us").removeClass("active");
    jQuery("#property_list").removeClass("active");

  }
  if(segment == "contact_us") {
    jQuery("#home").removeClass("active");
    jQuery("#pricing").removeClass("active");
    jQuery("#aboutus").removeClass("active");
    jQuery("#contact_us").addClass("active");
    jQuery("#property_list").removeClass("active");

  }
  if(segment == "properties") {
    jQuery("#home").removeClass("active");
    jQuery("#pricing").removeClass("active");
    jQuery("#aboutus").removeClass("active");
    jQuery("#contact_us").removeClass("active");
    jQuery("#property_list").addClass("active");

  }  
  
</script>

<script type="text/javascript" src="<?php echo ASSET.'web/js/bootstrap.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo ASSET.'web/js/popper.min.js'; ?>"></script>
<!--<script type="text/javascript" src="<?php //echo ASSET.'web/js/bootstrap-datepicker.min.js'; ?>"></script>-->
<script type="text/javascript" src="<?php echo ASSET.'web/js/jquery.dataTables.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo ASSET.'web/js/datatables.bootstrap4.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo ASSET.'web/scripts/register_login.js'; ?>"></script>
<?php 
if($this->uri->segment(1) == "contact_us") { ?>
<script type="text/javascript" src="<?php echo ASSET.'web/scripts/contact_us.js'; ?>"></script>
<?php } 
if($this->uri->segment(1) == "properties") { ?>
<script type="text/javascript" src="<?php echo ASSET.'web/js/moment.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo ASSET.'web/js/daterangepicker.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo ASSET.'web/scripts/property_list.js'; ?>"></script>
<?php } 
if($this->uri->segment(1) == "property_details") { ?>
<script type="text/javascript" src="<?php echo ASSET.'web/scripts/property_details.js'; ?>"></script>
<?php } ?>
<?php 
if($this->uri->segment(1) == "transactions") { ?>
<script type="text/javascript" src="<?php echo ASSET.'web/scripts/subscription_list.js'; ?>"></script>
<?php } ?>
  </body>
</html>