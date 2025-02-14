<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- font-awesome icon css -->
<link rel="stylesheet" href="<?php echo ASSET.'web/font-icon/css/all.css'; ?>">

<link href="<?php echo ASSET.'web/css/bootstrap.min.css'; ?>" rel="stylesheet" media="all">
<link href="<?php echo ASSET.'web/css/bootstrap-iso.css'; ?>" rel="stylesheet">
<link href="<?php echo ASSET.'web/css/daterangepicker.css'; ?>" rel="stylesheet">
<link href="<?php echo ASSET.'web/css/dataTables.bootstrap4.min.css'; ?>" rel="stylesheet">

<?php 
if($this->uri->segment(1) == "change_password" || $this->uri->segment(1) == "reset_password" || $this->uri->segment(1) == "reset_password_action" || $this->uri->segment(1) == "update_profile" || $this->uri->segment(1) == "about_us" || $this->uri->segment(1) == "contact_us") { ?>

<link href="<?php echo ASSET.'web/css/login.css'; ?>" rel="stylesheet">

<?php }
if($this->uri->segment(1) == "" || $this->uri->segment(1) == "signup" || $this->uri->segment(1) == "my_account") { ?>

<link href="<?php echo ASSET.'web/css/signup.css'; ?>" rel="stylesheet">

<?php } ?>

<?php 
if($this->uri->segment(1)=="property_details") { ?>

<link href="<?php echo ASSET.'web/css/Property-Address.css'; ?>" rel="stylesheet" >

<?php } else { ?>

<link href="<?php echo ASSET.'web/css/custom.css'; ?>" rel="stylesheet">

<?php } ?>