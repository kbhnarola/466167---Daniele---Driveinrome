<tr>
   <td style="padding:0;margin:0;vertical-align:middle;">
      <table style="width:100%; padding:15px; margin:0 auto;  background:#fff;vertical-align:middle;" cellspacing="0" cellpadding="0">
         <tbody>
            <tr>
               <td style="padding:0;margin:0;vertical-align:middle;">
                  <table style="width:100%; margin:0 auto;  background:#fff;vertical-align:middle;" cellspacing="0" cellpadding="0">
                     <tbody>
                        <tr>
                           <td style="font-family: 'Montserrat';font-size: 14px;color: #28a745;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 15px 0;vertical-align: middle;margin:0;">
                              <strong>
                              You have received an eternary from <?=(isset($full_name) && !empty($full_name)) ? $full_name : '' ?>. The eternary is as follows:
                              </strong>
                           </td>
                        </tr>
                        <tr>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
            <tr>
               <td style="padding:0;margin:0;vertical-align:middle;">
                  <table style="width:100%; margin:0 auto;  background:#fff;vertical-align:middle;" cellspacing="0" cellpadding="0">
                     <tbody>
                        <tr>
                           <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding:0;vertical-align: middle;margin:0;">
                              <strong>
                              Order
                              </strong>
                           </td>
                           <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding:0;vertical-align: middle;margin:0;text-align: right;">
                              <strong>
                                <?php
                                    echo date('d F, Y');
                                ?>
                              </strong>
                           </td>
                        </tr>
                        <tr>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
         </tbody>
      </table>
   </td>
</tr>
<tr>
   <td style="padding:0;margin:0;vertical-align:middle;">
      <table style="width:100%; padding:15px; margin:0 auto;  background:#fff;vertical-align:middle;border-top:1px solid #fbf5ee;border-bottom: 1px solid #fbf5ee;" cellspacing="0" cellpadding="0">
         <tbody>
            <tr>
               <td style="font-family: 'Montserrat';font-size: 15px;color: #4A4A4A;font-weight: 500;margin: 0;padding:0 0 5px 0;vertical-align: middle;">
                  <strong style="text-decoration: underline;color: #ff984a;">Personal Information</strong>
               </td>
            </tr>
            <tr>
               <td style="padding:0;margin:0;vertical-align:middle;">
                  <table style="width:100%; margin:0 auto;  background:#fff;vertical-align:middle;" cellspacing="0" cellpadding="0">
                     <tbody>
                        <tr>
                           <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Full Name</strong></td>
                           <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><span><?=(isset($full_name) && !empty($full_name)) ? $full_name : '' ?></span></td>
                        </tr>
                        <tr>
                           <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><strong>Email</strong></td>
                           <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><span><?=(isset($email) && !empty($email)) ? $email : '' ?></span></td>
                        </tr>
                        <tr>
                           <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><strong>Contact No</strong></td>
                           <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><span><?=(isset($phone_no) && !empty($phone_no)) ? $phone_no : '' ?></span></td>
                        </tr>
                        <tr>
                           <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><strong>Special Needs</strong></td>
                           <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><span><?=(isset($special_needs) && !empty($special_needs)) ? $special_needs : '' ?></span></td>
                        </tr>
                        <tr>
                           <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><strong>Found By</strong></td>
                           <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><span><?=(isset($found_us) && !empty($found_us)) ? $found_us : '' ?></span></td>
                        </tr>
                     </tbody>
                  </table>
               </td>
               <!-- display only if payment made by card -->
               <?php
                if(!isset($affiliate_code) && empty($affiliate_code)){
                ?>
                    <td style="padding:0;margin:0;vertical-align:middle;">
                        <table style="width:100%; margin:0 auto;  background:#fff;vertical-align:middle;" cellspacing="0" cellpadding="0">
                            <tbody>
                                <tr>
                                <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><strong>Address</strong></td>
                                <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><span><?=(isset($checkoutaddress) && !empty($checkoutaddress)) ? $checkoutaddress : '' ?></span></td>
                                </tr>
                                <tr>
                                <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><strong>Country</strong></td>
                                <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><span><?=(isset($checkoutcountry) && !empty($checkoutcountry)) ? $checkoutcountry : '' ?></span></td>
                                </tr>
                                <tr>
                                <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><strong>City</strong></td>
                                <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><span><?=(isset($checkoutcity) && !empty($checkoutcity)) ? $checkoutcity : '' ?></span></td>
                                </tr>
                                <tr>
                                <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><strong>Zipcode</strong></td>
                                <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><span><?=(isset($checkoutzipcode) && !empty($checkoutzipcode)) ? $checkoutzipcode : '' ?></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                <?php
                }
                ?>
            </tr>
         </tbody>
      </table>
   </td>
</tr>
<?php
if($cart_product_type == 'transfer'){
?>
    <tr>
        <td style="padding:0;margin:0;vertical-align:middle;">
            <table style="width:100%; padding:15px; margin:0 auto;  background:#fff;vertical-align:middle;border-top:1px solid #fbf5ee;border-bottom: 1px solid #fbf5ee;" cellspacing="0" cellpadding="0">
                <tbody>
                    <tr>
                    <td style="font-family: 'Montserrat';font-size: 15px;color: #4A4A4A;font-weight: 500;margin: 0;padding:0 0 5px 0;vertical-align: middle;">
                        <strong style="text-decoration: underline;color: #ff984a;">Product Information</strong>
                    </td>
                    </tr>
                    <tr>
                    <td style="padding:0;margin:0;vertical-align:middle;">
                        <table border="1" style="border-color:#fbf5ee75;width:100%; margin:0 auto;  background:#fff;vertical-align:middle;" cellspacing="0" cellpadding="5">
                            <thead>
                                <tr>
                                    <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Product</strong></th>
                                    <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Total Members</strong></th>
                                    <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>City</strong></th>
                                    <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Price</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(isset($cart_contents) && !empty($cart_contents)){
                                        foreach ($cart_contents as $product){
                                            ?>
                                            <tr style="text-align: center;">
                                                <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                    <p style="margin: 0;padding-bottom: 5px;"><?=$product['transfer_detail_data']['title']?></p>
                                                    <p style="margin: 0;padding-bottom: 5px;"><span><strong>Code :</strong> <?=$product['transfer_detail_data']['unique_code']?></span></p>
                                                    <p style="margin: 0;padding-bottom: 5px;"><span><strong>Duration :</strong> <?=($product['transfer_detail_data']['duration'] > 1) ? $product['transfer_detail_data']['duration']. ' Hours' : $product['transfer_detail_data']['duration'] . ' Hour'?></span></p>
                                                </td>
                                                <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                    <p style="margin: 0;padding-bottom: 5px;"><?=$product['options']['transfer_variation_title'];?> Person</p>
                                                </td>
                                                <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                    <p style="margin: 0;padding-bottom: 5px;"><?=$product['transfer_detail_data']['city']?></p>
                                                </td>
                                                <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                    <p style="margin: 0;padding-bottom: 5px;">€<?=price_format($product['price'])?></p>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                <td colspan="3" style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;text-align: right;">
                                    <strong>Grand Total Price</strong>
                                </td>
                                <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                    <p style="margin: 0;text-align: center;"> <strong>€<?=$cart_total?></strong> </p>
                                </td>
                                </tr>
                            </tfoot>
                        </table>
                    </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
<?php
}else if($cart_product_type == 'tour' || $cart_product_type == 'both'){
?>
    <tr>
        <td style="padding:0;margin:0;vertical-align:middle;">
            <table style="width:100%; padding:15px; margin:0 auto;  background:#fff;vertical-align:middle;border-top:1px solid #fbf5ee;border-bottom: 1px solid #fbf5ee;" cellspacing="0" cellpadding="0">
                <tbody>
                    <tr>
                    <td style="font-family: 'Montserrat';font-size: 15px;color: #4A4A4A;font-weight: 500;margin: 0;padding:0 0 5px 0;vertical-align: middle;">
                        <strong style="text-decoration: underline;color: #ff984a;">Product Information</strong>
                    </td>
                    </tr>
                    <tr>
                    <td style="padding:0;margin:0;vertical-align:middle;">
                        <table border="1" style="border-color:#fbf5ee75;width:100%; margin:0 auto;  background:#fff;vertical-align:middle;" cellspacing="0" cellpadding="5">
                            <thead>
                                <tr>
                                <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Product</strong></th>
                                <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Total Members</strong></th>
                                <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Tour Upgrades</strong></th>
                                <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Tour Upgrade Price</strong></th>
                                <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Tour Date</strong></th>
                                <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Price</strong></th>
                                <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Total Price</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="text-align: center;">
                                <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                    <p style="margin: 0;padding-bottom: 5px;"><a href="#" style="padding-bottom: 5px;">Product Title</a></p>
                                    <p style="margin: 0;padding-bottom: 5px;"><span><strong>Code :</strong> Abc</span></p>
                                    <p style="margin: 0;padding-bottom: 5px;"><span><strong>Duration :</strong> 9hours</span></p>
                                    <p style="margin: 0;padding-bottom: 5px;"><span><strong>City :</strong> Surat</span></p>
                                    <p style="margin: 0;padding-bottom: 5px;"><span><strong>Type :</strong> Type</span></p>
                                    <p style="margin: 0;padding-bottom: 5px;"><span><strong>Tour Notes :</strong> Notes here here</span></p>
                                </td>
                                <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                    <p style="margin: 0;padding-bottom: 5px;">Adult-2</p>
                                    <p style="margin: 0;padding-bottom: 5px;">Kids-1</p>
                                    <p style="margin: 0;padding-bottom: 5px;">Senior-4</p>
                                    <p style="margin: 0;padding-bottom: 5px;">Infant-6</p>
                                </td>
                                <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                    <p style="margin: 0;padding-bottom: 5px;">Upgrade1</p>
                                    <p style="margin: 0;padding-bottom: 5px;">Upgrade2</p>
                                    <p style="margin: 0;padding-bottom: 5px;">Upgrade3</p>
                                    <p style="margin: 0;padding-bottom: 5px;">Upgrade4</p>
                                </td>
                                <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                    <p style="margin: 0;padding-bottom: 5px;">Flate Rate - €400</p>
                                    <p style="margin: 0;padding-bottom: 5px;">1 * €200 = €200</p>
                                    <p style="margin: 0;padding-bottom: 5px;">4 * €200 = €800</p>
                                    <p style="margin: 0;padding-bottom: 5px;">6 * €200 = €1200</p>
                                </td>
                                <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                    <p style="margin: 0;">30 Jan, 2021</p>
                                </td>
                                <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                    <p style="margin: 0;">200 </p>
                                </td>
                                <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                    <p style="margin: 0;"> 2800 </p>
                                </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                <td colspan="6" style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;text-align: right;">
                                    <strong>Grand Total Price</strong>
                                </td>
                                <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                    <p style="margin: 0;text-align: center;"> <strong>€2800</strong> </p>
                                </td>
                                </tr>
                            </tfoot>
                        </table>
                    </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td style="padding:0;margin:0;vertical-align:middle;">
            <table style="width:100%; padding:15px; margin:0 auto;  background:#fff;vertical-align:middle;border-top:1px solid #fbf5ee;border-bottom: 1px solid #fbf5ee;" cellspacing="0" cellpadding="0">
                <tbody>
                    <tr>
                    <td style="font-family: 'Montserrat';font-size: 15px;color: #4A4A4A;font-weight: 500;margin: 0;padding:0 0 5px 0;vertical-align: middle;">
                        <strong style="text-decoration: underline;color: #ff984a;">Passenger Details</strong>
                    </td>
                    </tr>
                    <tr>
                    <td style="padding:0;margin:0;vertical-align:top;width:59%;padding-right: 1%;">
                        <table border="1" style="border-color:#fbf5ee75;width:100%; margin:0 auto;  background:#fff;vertical-align:middle;" cellspacing="0" cellpadding="5">
                            <thead>
                                <tr>
                                <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Tour Name</strong></th>
                                <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Tour Upgrade</strong></th>
                                <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Passenger Details</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="text-align: center;">
                                <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                    <p style="margin: 0;">Test Tour</p>
                                </td>
                                <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                    <p style="margin: 0;">Tour Upgrade here</p>
                                </td>
                                <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                    <table border="1" style="border-color:#fbf5ee75;width:100%; margin:0 auto;  background:#fff;vertical-align:middle;white-space: nowrap;" cellspacing="0" cellpadding="2">
                                        <thead>
                                            <tr>
                                            <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Sr. No</strong></th>
                                            <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Full Name</strong></th>
                                            <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Date of Birth</strong></th>
                                            <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Birth Place</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr style="text-align: center;">
                                            <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                <p style="margin: 0;">1 </p>
                                            </td>
                                            <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                <p style="margin: 0;">Akash Patel</p>
                                            </td>
                                            <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                <p style="margin: 0;">11-05-1991</p>
                                            </td>
                                            <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                <p style="margin: 0;">Surat</p>
                                            </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
<?php
}
?>
<!-- display only if payment made by card -->
<?php
if(!isset($affiliate_code) && empty($affiliate_code)){
?>
<tr>
   <td style="padding:0;margin:0;vertical-align:middle;">
      <table style="width:100%; padding:15px; margin:0 auto;  background:#fff;vertical-align:middle;border-top:1px solid #fbf5ee;border-bottom: 1px solid #fbf5ee;" cellspacing="0" cellpadding="0">
         <tbody>
            <tr>
               <td style="font-family: 'Montserrat';font-size: 15px;color: #4A4A4A;font-weight: 500;margin: 0;padding:0 0 5px 0;vertical-align: middle;">
                  <strong style="text-decoration: underline;color: #ff984a;">Payment Details</strong>
               </td>
            </tr>
            <tr>
               <td style="padding:0;margin:0;vertical-align:middle;">
                  <table border="1" style="border-color:#fbf5ee75;width:100%; margin:0 auto;  background:#fff;vertical-align:middle;" cellspacing="0" cellpadding="5">
                     <thead>
                        <tr>
                           <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Name On Card</strong></th>
                           <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Card Number</strong></th>
                           <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Expiry Month / Year</strong></th>
                           <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>CVV</strong></th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr style="text-align: center;">
                           <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                              <p style="margin: 0;"><?=(isset($nameoncard) && !empty($nameoncard)) ? $nameoncard : '' ?></p>
                           </td>
                           <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                              <p style="margin: 0;"><?=(isset($cardnumber) && !empty($cardnumber)) ? $cardnumber : '' ?></p>
                           </td>
                           <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                              <p style="margin: 0;"><?=(isset($exp_date) && !empty($exp_date)) ? $exp_date : '' ?></p>
                           </td>
                           <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                              <p style="margin: 0;"><?=(isset($cvc) && !empty($cvc)) ? $cvc : '' ?></p>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
         </tbody>
      </table>
   </td>
</tr>
<?php
}else{
?>
<!-- display only if payment made by affiliate code -->
<tr>
   <td style="padding:0;margin:0;vertical-align:middle;">
      <table style="width:100%; padding:15px; margin:0 auto;  background:#fff;vertical-align:middle;border-top:1px solid #fbf5ee;border-bottom: 1px solid #fbf5ee;" cellspacing="0" cellpadding="0">
         <tbody>
            <tr>
               <td style="font-family: 'Montserrat';font-size: 15px;color: #4A4A4A;font-weight: 500;margin: 0;padding:0 0 5px 0;vertical-align: middle;">
                  <strong style="text-decoration: underline;color: #ff984a;">Affiliate Code</strong>
               </td>
            </tr>
            <tr>
               <td style="padding:0;margin:0;vertical-align:middle;">
                  <table border="1" style="border-color:#fbf5ee75;width:100%; margin:0 auto;  background:#fff;vertical-align:middle;" cellspacing="0" cellpadding="5">
                     <tbody>
                        <tr style="text-align: center;">
                           <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                              <p style="margin: 0;"><strong>Code</strong></p>
                           </td>
                           <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                              <p style="margin: 0;"><?=(isset($affiliate_code) && !empty($affiliate_code)) ? $affiliate_code : '' ?></p>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
         </tbody>
      </table>
   </td>
</tr>
<?php
}
?>