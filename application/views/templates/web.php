
<!DOCTYPE html>
<html class="h-100">
 
    <head>
       <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>

          <?php 
          if($this->uri->segment(1)==""){
            echo "All Access Foreclosures";
          } else {
            echo $this->page_title;
          } ?>

        </title>
        
        <?php $this->load->view('templates/web_head');?>
        
    </head>
 
    <body class="h-100">
        
    <!-- Header / Navbar content Start !-->
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark navbar-bg">
        <div class="container">
          <a class="navbar-brand d-block d-lg-none" href="<?php echo BASE_URL; ?>">
            <div class="imgshape-block">
              <img src="<?php echo ASSET.'web/images/logo.png';?>" class="img-fluid" />
            </div>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
      
          <div class="collapse navbar-collapse" id="navbarsExample07">
            <ul class="navbar-nav justify-content-start w-100">
              <li class="nav-item" id="home">
                <a class="nav-link" href="<?php echo BASE_URL; ?>">Home</a>
              </li>
              <?php
                if(!(is_array($this->session->userdata('user_info')) && sizeof($this->session->userdata('user_info'))>0))
                  { ?>
              <li class="nav-item" id="pricing">
                  <?php
                    if($this->uri->segment(1) == ""){ ?>
                          <a class="nav-link pricing_link" id="pricing_link" href="javascript:void(0);">Subscribe Now</a>
                    <?php } else { ?>
                        <a class="nav-link" href="<?php echo BASE_URL.'#subscribe'; ?>">Subscribe Now</a>                  
                    <?php } ?>
                </li> <?php } ?>
                <?php
                if(is_array($this->session->userdata('user_info')) && sizeof($this->session->userdata('user_info'))>0)
                  { ?>
                <li class="nav-item" id="property_list">                
                  <a class="nav-link" href="<?php echo BASE_URL.'properties'; ?>">Properties</a>  
                </li><?php } ?>
              <li class="nav-item" id="aboutus">
                <a class="nav-link" href="<?php echo BASE_URL.'about_us'; ?>">About Us</a>
              </li>
              <li class="nav-item" id="contact_us">
                <a class="nav-link" href="<?php echo BASE_URL.'contact_us'; ?>">Contact Us</a>
              </li>
            </ul>
            
            <a class="navbar-brand d-none d-lg-block logo-block" href="<?php echo BASE_URL; ?>">
              <div class="imgshape-block">
                <img src="<?php echo ASSET.'web/images/logo.png'; ?>" class="img-fluid" />
              </div>
              
            </a>

            <ul class="navbar-nav justify-content-end w-100">
              <?php        
              if(!(is_array($this->session->userdata('user_info')) && sizeof($this->session->userdata('user_info'))>0)) { ?>
                <li class="nav-item">
                  <a class="nav-link btn-navbar" href="<?php echo BASE_URL.'signup'; ?>"><i class="fas fa-user pr-2"></i>Sign Up</a>
                </li>
                <li class="nav-item ml-lg-4">
                  <a class="nav-link btn-navbar border-bottom-xs-0 open_login_model" href="#" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-sign-in-alt pr-2"></i>Login</a>
                </li>
              <?php } else { ?>
              <li class="nav-item dropdown">
                  <a class="nav-link btn-navbar dropdown-toggle user-profilebtn" href="#" id="dropdown10" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-user pr-2"></i>  <?php 
                              if(strlen($this->session->userdata('user_info')['username'])<=15) {
                                  echo $this->session->userdata('user_info')['username'];
                                } else {
                                  echo substr($this->session->userdata('user_info')['username'],0,15).'...';
                                }
                              
                            ?>
                  </a>
                  <div class="dropdown-menu user-profile" aria-labelledby="dropdown10">
                    <a class="dropdown-item" href="<?php echo BASE_URL.'update_profile'; ?>"><i class="fas fa-user-edit pr-2"></i>Update Profile</a>
                    <a class="dropdown-item" href="<?php echo BASE_URL.'reset_password'; ?>"><i class="fas fa-lock pr-2"></i>Change Password</a>
                    <a class="dropdown-item" href="<?php echo BASE_URL.'transactions'; ?>"><i class="far fa-list-alt pr-2" ></i>My Transaction List</a>
                    <a class="dropdown-item border-bottom-0" href="<?php echo BASE_URL.'logout'; ?>"><i class="fas fa-sign-out-alt pr-2"></i>Logout</a>
                  </div>
              </li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <!-- Header / Navbar content End !-->
	        
             
            <?php echo $body; ?>
             
        
        <?php $this->load->view('templates/web_footer');?>
    