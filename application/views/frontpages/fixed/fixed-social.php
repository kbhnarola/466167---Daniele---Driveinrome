<?php
$get_settings = get_admin_settings();
// echo '<pre>';
// print_r(get_admin_settings());die;
// print_r(get_email_template('contact-us'));die;
$facebook_url = $twitter_url = $youtube_url = $instagram_url = $google_plus_url = $pinterest_url = '';
foreach($get_settings as $social_settings){
  // echo $social_settings['name'];
  if($social_settings['name'] == 'facebook_url'){
      $facebook_url = $social_settings['value'];
  }
  else if($social_settings['name'] == 'twitter_url'){
      $twitter_url = $social_settings['value'];
  }
  else if($social_settings['name'] == 'youtube_url'){
      $youtube_url = $social_settings['value'];
  }
  else if($social_settings['name'] == 'instagram_url'){
      $instagram_url = $social_settings['value'];
  }
  else if($social_settings['name'] == 'google_plus_url'){
      $google_plus_url = $social_settings['value'];
  }
  else if($social_settings['name'] == 'pinterest_url'){
      $pinterest_url = $social_settings['value'];
  }
  
}
?>
<ul class="fixed-social">    
    <?='<li><a href="javascript:void(0);" id="yt_link"><i class="fab fa-youtube"></i></a></li>'?>    
    <?=(!empty($facebook_url)) ? '<li><a href="'.$facebook_url.'" target="_blank"><i class="fab fa-facebook-f"></i></a></li>' : '';?>    
    <?=(!empty($instagram_url)) ? '<li><a href="'.$instagram_url.'" target="_blank"><i class="fab fa-instagram"></i></a></li>' : '';?>
    <?=(!empty($google_plus_url)) ? '<li><a href="'.$google_plus_url.'" target="_blank"><i class="fab fa-google-plus-g"></i></a></li>' : '';?>    
    <?=(!empty($twitter_url)) ? '<li><a href="'.$twitter_url.'" target="_blank"><i class="fab fa-twitter"></i></a></li>' : '';?>
    <?=(!empty($pinterest_url)) ? '<li><a href="'.$pinterest_url.'" target="_blank"><i class="fab fa-pinterest"></i></a></li>' : '';?>
  </ul>