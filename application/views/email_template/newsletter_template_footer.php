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
<div style="background-color:transparent;">
         <div class="block-grid" style="min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;Margin: 0 auto;background-color: #2b7797;border-left: 1px solid #fbf5ee;border-right: 1px solid #fbf5ee;">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#2b7797;">
                           <div class="col num12" style="min-width: 320px;max-width: 600px;display: table-cell;vertical-align: top;width: 600px;">
                              <div class="col_cont" style="width:100% !important;">
                                 <div style="border-top:5px solid #FF984A; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:15px; padding-bottom:15px; padding-right: 20px; padding-left: 20px;">
                                    <table cellpadding="0" cellspacing="0" class="social_icons" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" valign="top" width="100%">
                                       <tbody>
                                          <tr style="vertical-align: top;" valign="top">
                                             <td style="word-break: break-word; vertical-align: top; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px;" valign="top">
                                                <table align="center" cellpadding="0" cellspacing="0" class="social_table" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-tspace: 0; mso-table-rspace: 0; mso-table-bspace: 0; mso-table-lspace: 0;" valign="top">
                                                   <tbody>
                                                      <tr align="center" style="vertical-align: top; display: inline-block; text-align: center;" valign="top">
                                                         <?php
                                                         if($facebook_url) {?>
                                                         <td style="word-break: break-word; vertical-align: top; padding-bottom: 0; padding-right: 5px; padding-left: 5px;" valign="top">
                                                            <a href="<?php echo $facebook_url;?>"><img width="32" title="facebook" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; display: block;" src="<?php echo ASSET.'images/emails/ic-1.png';?>" height="32" alt="Facebook"></a>
                                                         </td>
                                                         <?php }
                                                         if($instagram_url) {?>
                                                         <td style="word-break: break-word; vertical-align: top; padding-bottom: 0; padding-right: 5px; padding-left: 5px;" valign="top"><a href="<?php echo $instagram_url;?>" ><img alt="Instagram" height="32" src="<?php echo ASSET.'images/emails/ic-2.png';?>" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; display: block;" title="instagram" width="32"></a>
                                                         </td><?php } ?>
                                                         <?php 
                                                         if($twitter_url) {?>
                                                         <td style="word-break: break-word; vertical-align: top; padding-bottom: 0; padding-right: 5px; padding-left: 5px;" valign="top"><a href="<?php echo $twitter_url;?>"><img width="32" title="twitter" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; display: block;" src="<?php echo ASSET.'images/emails/ic-3.png';?>" height="32" alt="Twitter"></a>
                                                         </td><?php } ?>
                                                         <?php 
                                                         if($youtube_url) {?>
                                                         <td style="word-break: break-word; vertical-align: top; padding-bottom: 0; padding-right: 5px; padding-left: 5px;" valign="top"><a href="<?php echo $youtube_url;?>"><img width="32" title="linkedin" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; display: block;" src="<?php echo ASSET.'images/emails/ic-5.png';?>" height="32" alt="Linkedin"></a>
                                                         </td><?php } ?>
                                                         
                                                         <?php 
                                                         if($google_plus_url) {?>
                                                         <td style="word-break: break-word; vertical-align: top; padding-bottom: 0; padding-right: 5px; padding-left: 5px;" valign="top"><a href="<?php echo $google_plus_url;?>"><img width="32" title="linkedin" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; display: block;" src="<?php echo ASSET.'images/emails/ic-6.png';?>" height="32" alt="Linkedin"></a>
                                                         </td><?php } ?>
                                                         <?php 
                                                         if($pinterest_url) {?>
                                                         <td style="word-break: break-word; vertical-align: top; padding-bottom: 0; padding-right: 5px; padding-left: 5px;" valign="top"><a href="<?php echo $pinterest_url;?>"><img width="32" title="linkedin" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; display: block;" src="<?php echo ASSET.'images/emails/ic_pinterest.png';?>" height="32" alt="Linkedin"></a>
                                                         </td><?php } ?>
                                                      </tr>
                                                   </tbody>
                                                </table>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
         </div>
</div>
</td>
</tr>
</tbody>
</table>
</body>
</html>