<?php

$get_settings = get_admin_settings();

$facebook_url = $twitter_url = $youtube_url = $instagram_url = $pinterest_url = $google_plus_url = '';

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
  else if($social_settings['name'] == 'pinterest_url'){

      $pinterest_url = $social_settings['value'];

  }
  else if($social_settings['name'] == 'google_plus_url'){

      $google_plus_url = $social_settings['value'];

  }

  

}

?>

               <tr>

                  <td style="padding:0;margin:0;vertical-align:middle;">

                     <center>

                        <table style="width: 100%;padding: 30px 25px;margin: 0;background: #2b7797;text-align: center;" cellspacing="0" cellpadding="0">

                           <tbody>

                              <tr>

                                 <td style="padding: 0 0 20px 0;margin: 0;vertical-align: middle;">

                                 <?=(!empty($facebook_url)) ? '<a href="'.$facebook_url.'" style="padding: 0 5px;margin: 0;display: inline-block;vertical-align: middle;"><img style="vertical-align: middle;padding: 0;margin: 0;" src="'.ASSET.'images/emails/ic-1.png" alt=""></a>' : ''?>



                                 <?=(!empty($instagram_url)) ? '<a href="'.$instagram_url.'" style="padding: 0 5px;margin: 0;display: inline-block;vertical-align: middle;"><img style="vertical-align: middle;padding: 0;margin: 0;" src="'.ASSET.'images/emails/ic-2.png" alt=""></a>' : ''?>



                                 <?=(!empty($twitter_url)) ? '<a href="'.$twitter_url.'" style="padding: 0 5px;margin: 0;display: inline-block;vertical-align: middle;"><img style="vertical-align: middle;padding: 0;margin: 0;" src="<'.ASSET.'images/emails/ic-3.png" alt=""></a>' : ''?>



                                 <?=(!empty($youtube_url)) ? '<a href="'.$youtube_url.'" style="padding: 0 5px;margin: 0;display: inline-block;vertical-align: middle;"><img style="vertical-align: middle;padding: 0;margin: 0;" src="'.ASSET.'images/emails/ic-5.png" alt=""></a>' : ''?>



                                 <?=(!empty($google_plus_url)) ? '<a href="'.$google_plus_url.'" style="padding: 0 5px;margin: 0;display: inline-block;vertical-align: middle;"><img style="vertical-align: middle;padding: 0;margin: 0;" src="'.ASSET.'images/emails/ic-6.png" alt=""></a>' : ''?>

                                 <?=(!empty($pinterest_url)) ? '<a href="'.$pinterest_url.'" style="padding: 0 5px;margin: 0;display: inline-block;vertical-align: middle;"><img style="vertical-align: middle;padding: 0;margin: 0;" src="<'.ASSET.'images/emails/ic_pinterest.png" alt=""></a>' : ''?>

                                 </td>

                              </tr>

                           </tbody>

                        </table>

                     </center>

                  </td>

               </tr>

            </thead>

         </table>

      </center>

   </body>

   <script src="js/jquery-1.10.2.js" type="text/javascript"></script>

   <script src="js/bootstrap.min.js" type="text/javascript"></script>

</html>