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
                                            <?php
                                            if ($to_admin) {
                                            ?>
                                                You have received an Itinerary from '<?= (isset($full_name) && !empty($full_name)) ? ucwords($full_name) : '' ?>''. The Itinerary is as follows:
                                        </strong>
                                    <?php
                                            } else {
                                    ?>
                                        <!-- Your eternary has been received and is now being prossesed. Your eternary details are shown below for your reference: -->
                                        We received your completed form .Your reservation is now being processed.You will be receiving a booking voucher shortly .Your Itinerary details are shown below for your reference.
                                    <?php
                                            }
                                    ?>
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
                                    <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><span><?= (isset($full_name) && !empty($full_name)) ? ucwords($full_name) : '' ?></span></td>
                                </tr>
                                <tr>
                                    <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><strong>Email</strong></td>
                                    <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><span><?= (isset($email) && !empty($email)) ? $email : '' ?></span></td>
                                </tr>
                                <tr>
                                    <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><strong>Contact No</strong></td>
                                    <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><span><?= (isset($phone_no) && !empty($phone_no)) ? $phone_no : '' ?></span></td>
                                </tr>
                                <tr>
                                    <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><strong>Special Needs</strong></td>
                                    <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><span><?= (isset($special_needs) && !empty($special_needs)) ? $special_needs : '' ?></span></td>
                                </tr>
                                <tr>
                                    <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><strong>Found By</strong></td>
                                    <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><span><?= (isset($found_us) && !empty($found_us)) ? $found_us : '' ?></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <!-- display only if payment made by card -->
                    <?php
                    if (!isset($affiliate_code) && empty($affiliate_code)) {
                    ?>
                        <td style="padding:0;margin:0;vertical-align:middle;">
                            <table style="width:100%; margin:0 auto;  background:#fff;vertical-align:middle;" cellspacing="0" cellpadding="0">
                                <tbody>
                                    <tr>
                                        <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><strong>Address</strong></td>
                                        <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><span><?= (isset($checkoutaddress) && !empty($checkoutaddress)) ? $checkoutaddress : '' ?></span></td>
                                    </tr>
                                    <tr>
                                        <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><strong>Country</strong></td>
                                        <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><span><?= (isset($checkoutcountry) && !empty($checkoutcountry)) ? $checkoutcountry : '' ?></span></td>
                                    </tr>
                                    <tr>
                                        <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><strong>City</strong></td>
                                        <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><span><?= (isset($checkoutcity) && !empty($checkoutcity)) ? $checkoutcity : '' ?></span></td>
                                    </tr>
                                    <tr>
                                        <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><strong>Zipcode</strong></td>
                                        <td style="font-family: 'Montserrat';font-size: 14px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 5px 0;vertical-align: middle;margin:0;"><span><?= (isset($checkoutzipcode) && !empty($checkoutzipcode)) ? $checkoutzipcode : '' ?></span></td>
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
if ($cart_product_type == 'transfer') {
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
                                    if (isset($cart_contents) && !empty($cart_contents)) {
                                        foreach ($cart_contents as $product) {
                                    ?>
                                            <tr style="text-align: center;">
                                                <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                    <p style="margin: 0;padding-bottom: 5px;"><?= $product['transfer_detail_data']['title'] ?></p>
                                                    <p style="margin: 0;padding-bottom: 5px;"><span><strong>Code :</strong> <?= $product['transfer_detail_data']['unique_code'] ?></span></p>
                                                    <p style="margin: 0;padding-bottom: 5px;"><span><strong>Duration :</strong> <?= ($product['transfer_detail_data']['duration'] > 1) ? $product['transfer_detail_data']['duration'] . ' Hours' : $product['transfer_detail_data']['duration'] . ' Hour' ?></span></p>
                                                </td>
                                                <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                    <p style="margin: 0;padding-bottom: 5px;"><?= $product['options']['transfer_variation_title']; ?> Person</p>
                                                </td>
                                                <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                    <p style="margin: 0;padding-bottom: 5px;"><?= $product['transfer_detail_data']['city'] ?></p>
                                                </td>
                                                <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                    <p style="margin: 0;padding-bottom: 5px;">€<?= price_format($product['price']) ?></p>
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
                                            <p style="margin: 0;text-align: center;"> <strong>€<?= $cart_total ?></strong> </p>
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
} else if ($cart_product_type == 'tour' || $cart_product_type == 'both') {
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
                                        <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Tour Date</strong></th>
                                        <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Total Members</strong></th>
                                        <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Tour Upgrades</strong></th>
                                        <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Tour Upgrade Price</strong></th>
                                        <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Extra Cost Price</strong></th>
                                        <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Price</strong></th>
                                        <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Total Price</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($cart_contents) && !empty($cart_contents)) {
                                        foreach ($cart_contents as $product) {
                                            $tour_extra_costs_array = $product['tours_detail_data']['tour_extra_cost'];
                                            $total_extra_cost = price_format($product['tours_detail_data']['toursData']['total_extra_cost']);
                                            $total_tour_cost = $product['tours_detail_data']['toursData']['total_tour_cost'];
                                            if (array_key_exists('tours_detail_data', $product)) {
                                    ?>
                                                <tr style="text-align: center;">
                                                    <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                        <!-- <p style="margin: 0;padding-bottom: 5px;"><a href="<?php //echo base_url('tours/'.$product['tours_detail_data']['toursData']['tour_slug']);
                                                                                                                ?>" style="padding-bottom: 5px;"><?php //echo $product['tour_title_meta'];
                                                                                                                                                    ?></a></p> -->
                                                        <p style="margin: 0;padding-bottom: 5px;"><a href="<?php echo base_url('tours/' . $product['tours_detail_data']['toursData']['tour_slug']); ?>" style="padding-bottom: 5px;"><?php echo $product['name']; ?></a></p>
                                                        <p style="margin: 0;padding-bottom: 5px;"><span><strong>Code :</strong> <?php echo $product['tours_detail_data']['toursData']['unique_code']; ?></span></p>
                                                        <p style="margin: 0;padding-bottom: 5px;"><span><strong>Duration :</strong>
                                                                <?php
                                                                if ($product['tours_detail_data']['toursData']['tour_type_id'] == 8) {
                                                                    if ($product['tours_detail_data']['toursData']['duration'] > 1) {
                                                                        echo $product['tours_detail_data']['toursData']['duration'] . ' Days';
                                                                    } else {
                                                                        echo $product['tours_detail_data']['toursData']['duration'] . ' Day';
                                                                    }
                                                                } else {
                                                                    if ($product['tours_detail_data']['toursData']['duration'] > 1) {
                                                                        echo $product['tours_detail_data']['toursData']['duration'] . ' Hours';
                                                                    } else {
                                                                        echo $product['tours_detail_data']['toursData']['duration'] . ' Hour';
                                                                    }
                                                                } ?></span>
                                                        </p>
                                                        <p style="margin: 0;padding-bottom: 5px;"><span><strong>City :</strong> <?php echo $product['tours_detail_data']['toursData']['city']; ?></span></p>
                                                        <p style="margin: 0;padding-bottom: 5px;"><span><strong>Type :</strong> <?php echo $product['tours_detail_data']['toursData']['tour_type']; ?></span></p>
                                                        <?php
                                                        if ($product['tours_detail_data']['tour_notes']) { ?>
                                                            <p style="margin: 0;padding-bottom: 5px;"><span><strong>Tour Notes :</strong> <?php echo $product['tours_detail_data']['tour_notes']; ?></span></p>
                                                        <?php } ?>
                                                    </td>
                                                    <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                        <p style="margin: 0;"><?php if ($product['tours_detail_data']['request_date']) {
                                                                                    echo date("d M Y", strtotime($product['tours_detail_data']['request_date']));
                                                                                } ?></p>
                                                    </td>
                                                    <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                        <?php
                                                        if ($product['tours_detail_data']['total_adult_person'] > 0) { ?>
                                                            <p style="margin: 0;padding-bottom: 5px;">
                                                                Adult-<strong><?php echo $product['tours_detail_data']['total_adult_person']; ?></strong>
                                                            </p>
                                                        <?php }
                                                        if ($product['tours_detail_data']['total_kids'] > 0) { ?>
                                                            <p style="margin: 0;padding-bottom: 5px;">Kids-<strong><?php echo $product['tours_detail_data']['total_kids']; ?></strong></p>
                                                        <?php }
                                                        if ($product['tours_detail_data']['total_senior_person'] > 0) { ?>
                                                            <p style="margin: 0;padding-bottom: 5px;">Senior-<strong><?php echo $product['tours_detail_data']['total_senior_person']; ?></strong></p>
                                                        <?php }
                                                        if ($product['tours_detail_data']['total_infants'] > 0) { ?>
                                                            <p style="margin: 0;padding-bottom: 5px;">Infants-<strong><?php echo $product['tours_detail_data']['total_infants']; ?></strong></p>
                                                        <?php } ?>
                                                    </td>
                                                    <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                        <?php
                                                        if (is_array($product['tours_detail_data']['tour_upgrades']) && sizeof($product['tours_detail_data']['tour_upgrades']) > 0) {
                                                            $tour_upgrades = $product['tours_detail_data']['tour_upgrades'];
                                                            $extra_services = set_extra_services();

                                                            foreach ($tour_upgrades as $key => $value) {

                                                                if (array_key_exists($value, $extra_services)) { ?>
                                                                    <p style="margin: 0;padding-bottom: 5px;"><?php echo $extra_services[$value]; ?></p>
                                                            <?php }
                                                            }
                                                        } else { ?><p style="margin: 0;padding-bottom: 5px;">-</p><?php } ?>
                                                    </td>
                                                    <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                        <?php
                                                        if (is_array($product['tours_detail_data']['tour_upgrades']) && sizeof($product['tours_detail_data']['tour_upgrades']) > 0) {
                                                            $tour_upgrades = $product['tours_detail_data']['tour_upgrades'];
                                                            $extra_services = get_extra_services();
                                                            foreach ($extra_services as $value) {
                                                                if (in_array($value['id'], $tour_upgrades)) {
                                                                    if ($value['id'] == 14) {
                                                                        $custom_rate = json_decode($value['person_custom_rate'], true);
                                                                        if (is_array($custom_rate)) {
                                                                            if (sizeof($custom_rate) >= $product['tours_detail_data']['total_passenger']) { ?>
                                                                                <p style="margin: 0;padding-bottom: 5px;">Flate Rate = <?php echo "€" . $custom_rate[($product['tours_detail_data']['total_passenger'] - 1)]; ?></p>
                                                                            <?php } else { ?>
                                                                                <p style="margin: 0;padding-bottom: 5px;">Flate Rate = <?php echo "€" . $product['tours_detail_data']['total_passenger'] * $value['price']; ?></p>
                                                                            <?php }
                                                                        } else { ?>
                                                                            <p style="margin: 0;padding-bottom: 5px;">Flate Rate = <?php echo "€" . $product['tours_detail_data']['total_passenger'] * $value['price']; ?></p>
                                                                        <?php }
                                                                    } elseif ($value['rate_opt'] == 1) {
                                                                        ?>
                                                                        <p style="margin: 0;padding-bottom: 5px;"><?php echo $product['tours_detail_data']['total_passenger'] . " * " . $value['price'] . " = €" . price_format($product['tours_detail_data']['total_passenger'] * $value['price']); ?></p>
                                                                    <?php } else { ?>
                                                                        <p style="margin: 0;padding-bottom: 5px;">Flate Rate = <?php echo "€" . price_format($value['price']); ?></p>
                                                            <?php }
                                                                }
                                                            }
                                                        } else { ?><p style="margin: 0;padding-bottom: 5px;">-</p><?php } ?>
                                                    </td>
                                                    <!-- start to display extra cost -->
                                                    <?php
                                                    $extra_cost_details = '';
                                                    if ($tour_extra_costs_array) {
                                                        foreach ($tour_extra_costs_array as $tour_extra_cost) {
                                                            $extra_cost_details .= $tour_extra_cost['title'] . ': €' . price_format($tour_extra_cost['price']) . ' + ';
                                                        }
                                                    }
                                                    ?>
                                                    <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                        <p style="margin: 0;"><?php echo ($extra_cost_details) ? trim($extra_cost_details, '+ ') . ' = €' . $total_extra_cost : '--'; ?></p>
                                                    </td>
                                                    <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                        <p style="margin: 0;"><?php echo "€" . price_format($product['tours_detail_data']['total_rate']); ?></p>
                                                    </td>
                                                    <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                        <p style="margin: 0;"><?php echo "€" . price_format($product['subtotal']); ?> </p>
                                                    </td>
                                                </tr>
                                            <?php
                                            } else if (array_key_exists('transfer_detail_data', $product)) {
                                            ?>
                                                <tr style="text-align: center;">
                                                    <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                        <p style="margin: 0;padding-bottom: 5px;"><?php echo $product['name']; ?></p>
                                                        <p style="margin: 0;padding-bottom: 5px;"><span><strong>Code :</strong> <?php echo $product['transfer_detail_data']['unique_code']; ?></span></p>
                                                        <p style="margin: 0;padding-bottom: 5px;"><span><strong>Duration :</strong>
                                                                <?php
                                                                $duration = $product['transfer_detail_data']['duration'];
                                                                if ($duration > 1) {
                                                                    echo $duration . ' Hours';
                                                                } else {
                                                                    echo $duration . ' Hour';
                                                                }
                                                                ?></span>
                                                        </p>
                                                        <p style="margin: 0;padding-bottom: 5px;"><span><strong>City :</strong> <?php echo $product['transfer_detail_data']['city']; ?></span></p>
                                                        <p style="margin: 0;padding-bottom: 5px;"><span><strong>Type :</strong> <?php echo 'Transfer'; ?></span></p>
                                                    </td>
                                                    <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                        <p style="margin: 0;"><?php echo '-'; ?></p>
                                                    </td>
                                                    <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                        <p style="margin: 0;padding-bottom: 5px;"><?= $product['options']['transfer_variation_title']; ?> Person</p>
                                                    </td>
                                                    <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                        <p style="margin: 0;padding-bottom: 5px;"><?= '-' ?></p>
                                                    </td>
                                                    <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                        <p style="margin: 0;padding-bottom: 5px;"><?= '-' ?></p>
                                                    </td>
                                                    <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                        <p style="margin: 0;">€<?= price_format($product['price']) ?></p>
                                                    </td>
                                                    <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                        <p style="margin: 0;">€<?= price_format($product['price']) ?> </p>
                                                    </td>
                                                </tr>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="7" style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;text-align: right;">
                                            <strong>Grand Total Price</strong>
                                        </td>
                                        <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                            <p style="margin: 0;text-align: center;"> <strong>€<?= $cart_total ?></strong> </p>
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
    $itu = $colo_itu = 0;
    // $per_person_tour_upgrades=get_extra_servicesId_byPerPersonRate();
    if (isset($cart_contents) && !empty($cart_contents)) {
        foreach ($cart_contents as $t_u) {
            if (array_key_exists('tours_detail_data', $t_u)) {
                if (is_array($t_u['tours_detail_data']['tour_upgrades']) && sizeof($t_u['tours_detail_data']['tour_upgrades']) > 0) {
                    if (is_array($t_u['tours_detail_data']['tour_upgrades_passenger_detail']) && sizeof($t_u['tours_detail_data']['tour_upgrades_passenger_detail']) > 0) {
                        foreach ($t_u['tours_detail_data']['tour_upgrades'] as $tu_id) {
                            if ($tu_id == 16 || $tu_id == 17) {
                                //if(in_array($tu_id,$per_person_tour_upgrades)) {
                                $itu++;
                                $colo_itu++;
                                break;
                                //}
                            }
                        }
                    }
                }
            }
        }
    }
    if ($itu > 0) {
    ?>
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
                                        <?php
                                        //$per_person_tour_upgrades=get_extra_servicesId_byPerPersonRate();
                                        if (isset($cart_contents) && !empty($cart_contents)) {
                                            foreach ($cart_contents as $t_u) {
                                                if (array_key_exists('tours_detail_data', $t_u)) {
                                                    if (is_array($t_u['tours_detail_data']['tour_upgrades']) && sizeof($t_u['tours_detail_data']['tour_upgrades']) > 0) {
                                                        if (is_array($t_u['tours_detail_data']['tour_upgrades_passenger_detail']) && sizeof($t_u['tours_detail_data']['tour_upgrades_passenger_detail']) > 0) {
                                                            foreach ($t_u['tours_detail_data']['tour_upgrades'] as $tu_id) {
                                                                // for vatican ticket
                                                                if ($tu_id == 16) {
                                                                    //if(in_array($tu_id,$per_person_tour_upgrades)) {
                                        ?>
                                                                    <tr style="text-align: center;">
                                                                        <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                                            <p style="margin: 0;"><?php echo $t_u['name']; ?></p>
                                                                        </td>
                                                                        <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                                            <p style="margin: 0;">
                                                                                <?php
                                                                                $extra_services = set_extra_services();
                                                                                if (array_key_exists($tu_id, $extra_services)) {
                                                                                    echo $extra_services[$tu_id];
                                                                                } ?>
                                                                            </p>
                                                                        </td>
                                                                        <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                                            <table border="1" style="border-color:#fbf5ee75;width:100%; margin:0 auto;  background:#fff;vertical-align:middle;white-space: nowrap;" cellspacing="0" cellpadding="2">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Sr. No</strong></th>
                                                                                        <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Full Name</strong></th>
                                                                                        <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Date of Birth</strong></th>
                                                                                        <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Birth Place</strong></th>
                                                                                        <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Age</strong></th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php
                                                                                    for ($j = 0; $j < $t_u['tours_detail_data']['total_passenger']; $j++) { ?>
                                                                                        <tr style="text-align: center;">
                                                                                            <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                                                                <p style="margin: 0;"><?php echo ($j + 1); ?> </p>
                                                                                            </td>
                                                                                            <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                                                                <p style="margin: 0;">
                                                                                                    <?php echo ucwords($t_u['tours_detail_data']['tour_upgrades_passenger_detail']['first_name'][$tu_id][$j]) . " " . ucwords($t_u['tours_detail_data']['tour_upgrades_passenger_detail']['last_name'][$tu_id][$j]); ?>
                                                                                                </p>
                                                                                            </td>
                                                                                            <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                                                                <p style="margin: 0;">
                                                                                                    <?php
                                                                                                    if ($j == 0) {
                                                                                                        echo date('d M Y', strtotime($t_u['tours_detail_data']['tour_upgrades_passenger_detail']['birth_date'][$tu_id][$j]));
                                                                                                    } ?>
                                                                                                </p>
                                                                                            </td>
                                                                                            <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                                                                <p style="margin: 0;">
                                                                                                    <?php
                                                                                                    if ($j == 0) {
                                                                                                        echo $t_u['tours_detail_data']['tour_upgrades_passenger_detail']['birth_place'][$tu_id][$j];
                                                                                                    } ?>
                                                                                                </p>
                                                                                            </td>
                                                                                            <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                                                                <p style="margin: 0;">
                                                                                                    <?php
                                                                                                    if ($j > 0) {
                                                                                                        echo $t_u['tours_detail_data']['tour_upgrades_passenger_detail']['age'][$tu_id][$j];
                                                                                                    } ?>
                                                                                                </p>
                                                                                            </td>
                                                                                        </tr>
                                                                                    <?php } ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                <?php }

                                                                // for colosseum ticket
                                                                if ($tu_id == 17) {
                                                                    //if(in_array($tu_id,$per_person_tour_upgrades)) {
                                                                ?>
                                                                    <tr style="text-align: center;">
                                                                        <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                                            <p style="margin: 0;"><?php echo $t_u['name']; ?></p>
                                                                        </td>
                                                                        <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                                            <p style="margin: 0;">
                                                                                <?php
                                                                                $extra_services = set_extra_services();
                                                                                if (array_key_exists($tu_id, $extra_services)) {
                                                                                    echo $extra_services[$tu_id];
                                                                                } ?>
                                                                            </p>
                                                                        </td>
                                                                        <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                                            <table border="1" style="border-color:#fbf5ee75;width:100%; margin:0 auto;  background:#fff;vertical-align:middle;white-space: nowrap;" cellspacing="0" cellpadding="2">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Sr. No</strong></th>
                                                                                        <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Full Name</strong></th>
                                                                                        <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Date of Birth</strong></th>
                                                                                        <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Birth Place</strong></th>
                                                                                        <th style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;padding: 0 0 px 0;vertical-align: middle;margin:0;"><strong>Age</strong></th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php
                                                                                    for ($j = 0; $j < $t_u['tours_detail_data']['total_passenger']; $j++) { ?>
                                                                                        <tr style="text-align: center;">
                                                                                            <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                                                                <p style="margin: 0;"><?php echo ($j + 1); ?> </p>
                                                                                            </td>
                                                                                            <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                                                                <p style="margin: 0;">
                                                                                                    <?php echo ucwords($t_u['tours_detail_data']['tour_upgrades_passenger_detail']['colo_first_name'][$tu_id][$j]) . " " . ucwords($t_u['tours_detail_data']['tour_upgrades_passenger_detail']['colo_last_name'][$tu_id][$j]); ?>
                                                                                                </p>
                                                                                            </td>
                                                                                            <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                                                                <p style="margin: 0;">
                                                                                                    <?php
                                                                                                    if ($j == 0) {
                                                                                                        echo date('d M Y', strtotime($t_u['tours_detail_data']['tour_upgrades_passenger_detail']['colo_birth_date'][$tu_id][$j]));
                                                                                                    } ?>
                                                                                                </p>
                                                                                            </td>
                                                                                            <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                                                                <p style="margin: 0;">
                                                                                                    <?php
                                                                                                    if ($j == 0) {
                                                                                                        echo $t_u['tours_detail_data']['tour_upgrades_passenger_detail']['colo_birth_place'][$tu_id][$j];
                                                                                                    } ?>
                                                                                                </p>
                                                                                            </td>
                                                                                            <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                                                                <p style="margin: 0;">
                                                                                                    <?php
                                                                                                    if ($j > 0) {
                                                                                                        echo $t_u['tours_detail_data']['tour_upgrades_passenger_detail']['colo_age'][$tu_id][$j];
                                                                                                    } ?>
                                                                                                </p>
                                                                                            </td>
                                                                                        </tr>
                                                                                    <?php } ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                        <?php }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        } //} 
                                        ?>
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
}
?>
<?php
if ($to_admin) {
?>
    <!-- display only if payment made by card -->
    <?php
    if (!isset($affiliate_code) && empty($affiliate_code)) {
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
                                                <p style="margin: 0;"><?= (isset($nameoncard) && !empty($nameoncard)) ? $nameoncard : '' ?></p>
                                            </td>
                                            <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                <p style="margin: 0;"><?= (isset($cardnumber) && !empty($cardnumber)) ? $cardnumber : '' ?></p>
                                            </td>
                                            <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                <p style="margin: 0;"><?= (isset($exp_date) && !empty($exp_date)) ? $exp_date : '' ?></p>
                                            </td>
                                            <td style="font-family: 'Montserrat';font-size: 12px;color: #4A4A4A;line-height: 19px;font-weight: 400;margin: 0;vertical-align: middle;margin:0;">
                                                <p style="margin: 0;"><?= (isset($cvc) && !empty($cvc)) ? $cvc : '' ?></p>
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
    } else {
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
                                                <p style="margin: 0;"><?= (isset($affiliate_code) && !empty($affiliate_code)) ? $affiliate_code : '' ?></p>
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
<?php
}
?>