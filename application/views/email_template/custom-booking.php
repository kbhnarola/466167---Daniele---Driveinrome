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
                                <!-- Your eternary has been received and is now being prossesed. Your eternary details are shown below for your reference: -->
                                We received your completed form .Your reservation is now being processed.You will be receiving a booking voucher shortly .Your Itinerary details are shown below for your reference.
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
                              Itinerary
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
                           <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><span><?=(isset($full_name) && !empty($full_name)) ? ucwords($full_name) : '' ?></span></td>
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
                                <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><span><?=(isset($address) && !empty($address)) ? $address : '' ?></span></td>
                                </tr>
                                <tr>
                                <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><strong>Country</strong></td>
                                <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><span><?=(isset($country) && !empty($country)) ? $country : '' ?></span></td>
                                </tr>
                                <tr>
                                <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><strong>City</strong></td>
                                <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><span><?=(isset($city) && !empty($city)) ? $city : '' ?></span></td>
                                </tr>
                                <tr>
                                <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><strong>Zipcode</strong></td>
                                <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><span><?=(isset($zipcode) && !empty($zipcode)) ? $zipcode : '' ?></span></td>
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