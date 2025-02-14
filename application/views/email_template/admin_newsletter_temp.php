<tr>
   <td style="padding:0;margin:0;vertical-align:middle;">
      <table style="width:100%; padding:35px 30px 80px 30px; margin:0 auto;  background:#fff;vertical-align:middle;" cellspacing="0" cellpadding="0">
         <tbody>
            <tr>
               <td style="padding:0;margin:0;vertical-align:middle;">
                  <p style="font-family: 'Montserrat' !important;font-size: 14px;color: #4A4A4A;line-height: 19px;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;">Dear <?php echo $username;?>,</p>
                  <p style="border: none; padding: 0cm; line-height: 0.5cm;">
                     <font color="#4a4a4a"><font face="Montserrat"><font style="font-size: 10pt"></font></font></font>
                  </p>
                  <?php 
                  if($newsletter_content) { ?>
                  <div style="background-color:transparent;">
                     <!-- <div class="block-grid" style="min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;Margin: 0 auto;background-color: #fbf5ee;border-left: 1px solid #fbf5ee;border-right: 1px solid #fbf5ee;"> -->
                     <!-- <div class="block-grid" style="min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;Margin: 0 auto;border-left: 1px solid #fbf5ee;border-right: 1px solid #fbf5ee;"> -->
                     <div class="block-grid" style="min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;margin: 0 auto;">
                        <!-- <div style="border-collapse: collapse;display: table;width: 100%;background-color:#fbf5ee;"> -->
                        <div style="border-collapse: collapse;display: table;width: 100%;">
                           <div class="col num12" style="min-width: 320px;max-width: 600px;display: table-cell;vertical-align: top;width: 600px;">
                              <div class="col_cont" style="width:100% !important;">
                                 <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:15px; padding-bottom:15px; padding-right: 20px; padding-left: 20px;">
                                    <div style="color:#111111;font-family: 'Montserrat' !important;line-height:1.5;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;">
                                       <div class="txtTinyMce-wrapper" style="line-height: 1.5; font-size: 14px; font-family: 'Montserrat' !important; color: #111111; mso-line-height-alt: 18px;">
                                          <p style="margin: 0; font-size: 16px; line-height: 1.5; word-break: break-word; text-align: left; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;"><?php echo $newsletter_content;?>&nbsp;</span></p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
                  <div style="background-color:transparent;">
                     <!-- <div class="block-grid two-up" style="min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;Margin: 0 auto;background-color: #ffffff;border-left: 1px solid #fbf5ee;border-right: 1px solid #fbf5ee;"> -->
                     <div class="block-grid two-up" style="min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;Margin: 0 auto;background-color: #ffffff;">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
                           <?php 
                           if($tour_image1) { ?>
                           <div class="col num6" style="display: table-cell;vertical-align: top;max-width: 320px;min-width: 298px;width: 300px;">
                              <div class="col_cont" style="width:100% !important;">
                                 <div style="border-top:0px solid #FFFFFF;border-left:0px solid #FFFFFF;border-bottom:0px solid #FFFFFF;border-right:0px solid #FFFFFF;padding-right: 20px;padding-left: 20px;">
                                    <div align="center" class="img-container center fixedwidth fullwidthOnMobile" style="padding-right: 0px;padding-left: 0px;"><a href="<?php echo $tour_image1_url;?>" ><img align="center" alt="Tour Image" border="0" class="center fixedwidth fullwidthOnMobile" src="<?php echo base_url().'uploads/newsletter_images/'.$tour_image1;?>" style="text-decoration: none;-ms-interpolation-mode: bicubic;height: auto;border: 0;width: 100%;max-width: 100%;max-height: 280px;min-height: 280px;display: block;object-fit: fill;object-position: top center;" title="Tour Image" width="280"></a>
                                    </div>
                                    <!-- <div align="center" class="button-container" style="padding-top:15px;padding-right:0px;padding-bottom:0px;padding-left:0px;"><a href="http://www.example.com/" style="-webkit-text-size-adjust: none; text-decoration: none; display: inline-block; color: #2b7797; background-color: transparent; border-radius: 0px; -webkit-border-radius: 0px; -moz-border-radius: 0px; width: auto; width: auto; border-top: 2px solid #2B7797; border-right: 2px solid #2B7797; border-bottom: 2px solid #2B7797; border-left: 2px solid #2B7797; padding-top: 5px; padding-bottom: 5px; font-family: TimesNewRoman, 'Times New Roman', Times, Beskerville, Georgia, serif; text-align: center; mso-border-alt: none; word-break: keep-all;" target="_blank"><span style="padding-left:40px;padding-right:40px;font-size:16px;display:inline-block;letter-spacing:undefined;"><span style="font-size: 16px; line-height: 2; word-break: break-word; mso-line-height-alt: 32px;"><span style="font-size: 16px; line-height: 32px;">Learn more</span></span></span></a>
                                    </div> -->
                                 </div>
                              </div>
                           </div>
                           <?php } 
                           if($tour_image2) { ?>
                           <div class="col num6" style="display: table-cell;vertical-align: top;max-width: 320px;min-width: 298px;width: 300px;">
                              <div class="col_cont" style="width:100% !important;">
                                 <div style="border-top:0px solid #FFFFFF;border-left:0px solid #FFFFFF;border-bottom:0px solid #FFFFFF;border-right:0px solid #FFFFFF;padding-right: 20px;padding-left: 20px;">
                                    <div align="center" class="img-container center fixedwidth fullwidthOnMobile" style="padding-right: 0px;padding-left: 0px;"><a href="<?php echo $tour_image2_url;?>" ><img align="center" alt="Tour Image" border="0" class="center fixedwidth fullwidthOnMobile" src="<?php echo base_url().'uploads/newsletter_images/'.$tour_image2;?>" style="text-decoration: none;-ms-interpolation-mode: bicubic;height: auto;border: 0;width: 100%;max-width: 100%;max-height: 280px;min-height: 280px;display: block;object-fit: fill;object-position: top center;" title="Ice" width="280"></a>
                                    </div>
                                    <!-- <div align="center" class="button-container" style="padding-top:15px;padding-right:0px;padding-bottom:0px;padding-left:0px;"><a href="http://www.example.com/" style="-webkit-text-size-adjust: none; text-decoration: none; display: inline-block; color: #2b7797; background-color: transparent; border-radius: 0px; -webkit-border-radius: 0px; -moz-border-radius: 0px; width: auto; width: auto; border-top: 2px solid #2B7797; border-right: 2px solid #2B7797; border-bottom: 2px solid #2B7797; border-left: 2px solid #2B7797; padding-top: 5px; padding-bottom: 5px; font-family: TimesNewRoman, 'Times New Roman', Times, Beskerville, Georgia, serif; text-align: center; mso-border-alt: none; word-break: keep-all;" target="_blank"><span style="padding-left:40px;padding-right:40px;font-size:16px;display:inline-block;letter-spacing:undefined;"><span style="font-size: 16px; line-height: 2; word-break: break-word; mso-line-height-alt: 32px;"><span style="font-size: 16px; line-height: 32px;">Learn more</span></span></span></a>
                                    </div> -->
                                 </div>
                              </div>
                           </div>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
                  <?php 
                  if($newsletter_content_more) { ?>
                  <div style="background-color:transparent;">
                     <!-- <div class="block-grid" style="min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;Margin: 0 auto;background-color: #fbf5ee;border-left: 1px solid #fbf5ee;border-right: 1px solid #fbf5ee;"> -->
                     <!-- <div class="block-grid" style="min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;Margin: 0 auto;border-left: 1px solid #fbf5ee;border-right: 1px solid #fbf5ee;"> -->
                     <div class="block-grid" style="min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;Margin: 0 auto;">
                        <!-- <div style="border-collapse: collapse;display: table;width: 100%;background-color:#fbf5ee;"> -->
                        <div style="border-collapse: collapse;display: table;width: 100%;">
                           <div class="col num12" style="min-width: 320px;max-width: 600px;display: table-cell;vertical-align: top;width: 600px;">
                              <div class="col_cont" style="width:100% !important;">
                                 <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:15px; padding-bottom:15px; padding-right: 20px; padding-left: 20px;">
                                    <div style="color:#111111;font-family: 'Montserrat' !important;line-height:1.5;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;">
                                       <div class="txtTinyMce-wrapper" style="line-height: 1.5; font-size: 14px; font-family: 'Montserrat' !important; color: #111111; mso-line-height-alt: 18px;">
                                          <p style="margin: 0; font-size: 16px; line-height: 1.5; word-break: break-word; text-align: left; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;"><?php echo $newsletter_content_more;?></span></p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
               </td>
            </tr>
         </tbody>
      </table>
   </td>
</tr>