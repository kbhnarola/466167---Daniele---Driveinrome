<!-- Advanced login -->
          <form action="<?= admin_url('authentication'); ?>" id="loginform" method="post">
            <div class="panel panel-body login-form">
              <div class="text-center">
                <!-- <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div> -->
                <div class="login-logo">
                  <img src="<?php echo base_url('assets/images/blue-logo.svg');?>">
                </div>
                <h5 class="content-group">Login to your account <small class="display-block">Your credentials</small></h5>
              </div>

              <?php $this->load->view('admin/includes/alerts'); ?>

              <div class="form-group has-feedback has-feedback-left">
                <input type="text" class="form-control" placeholder="Email" autocomplete="off" id="email" name="email">
                <div class="form-control-feedback">
                  <i class="icon-user text-muted"></i>
                </div>
              </div>

              <div class="form-group has-feedback has-feedback-left">
                <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                <div class="form-control-feedback">
                  <i class="icon-lock2 text-muted"></i>
                </div>
              </div>

              <div class="form-group login-options">
                <div class="row">
                  <div class="col-sm-6">
                    <label class="checkbox-inline">
                      <input type="checkbox" class="styled" name="remember" id="remember">
                      <?php _el('remember_me') ?>
                    </label>
                  </div>
                  <div class="col-sm-6 text-right">
                    <a href="<?php echo admin_url('authentication/forgot_password'); ?>"><?php _el('forgot_password') ?></a>
                  </div>                 
                </div>
              </div>

              <div class="form-group">
                <button type="submit" class="btn bg-blue btn-block">Login <i class="icon-arrow-right14 position-right"></i></button>
              </div>

              
            </div>
          </form>
          <!-- /advanced login -->


<!-- /simple login form -->
<script type="text/javascript">
$(function () {
  $("#loginform").validate
  ({
    rules: {
      email: {
        required: true
        
      },
      password: {
        required: true
      }
    },
    messages: {
      email: {
        required:"<?php _el('please_enter_', _l('email')) ?>"
      },
      password: {
        required:"<?php _el('please_enter_', _l('password')) ?>"
      },
    }
  });
});
</script>