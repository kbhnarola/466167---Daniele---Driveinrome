<span class="clear-tour-search"><i class="fas fa-undo"></i> Clear search</span>
<?php
if ($search_shared_tour_list) {
?>
    <p class=" text-center text-orange text-uppercase"><b> Your search result as below </b> </p>
    <div class="searchtour-wrapper mt-3 d-none">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 searchtour-list-wrapper">
                <div class="searchtour-list">
                    <div class="searchtour-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="searchtour-info">
                        <label class="mb-1">
                            City
                        </label>
                        <h5><?php echo $search_shared_tour_list[0]['shared_tour_city_name'] ?></h5>
                    </div>

                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 searchtour-list-wrapper">
                <div class="searchtour-list border-right-0">
                    <div class="searchtour-icon">
                        <i class="fas fa-plane-departure"></i>
                    </div>
                    <div class="searchtour-info">
                        <label class="mb-1">Tour</label>
                        <h5><?php echo $search_shared_tour_list[0]['shared_tour_variable_name'] ?></h5>
                    </div>

                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 searchtour-list-wrapper">
                <div class="searchtour-list">
                    <div class="searchtour-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="searchtour-info">
                        <label class="mb-1">Date</label>
                        <h5><?php echo date('F jS Y', strtotime($search_shared_tour_list[0]['tour_date'])); ?></h5>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row pl-md-3 pr-md-3 mt-sm-3 pt-4">
        <?php
        $tourCounter = 1;
        foreach ($search_shared_tour_list as $key => $search_shared_tour) {
            $color = 'orange';
            switch ($tourCounter) {
                case 1:
                    $color = 'blue';
                    break;
                case 2:
                    $color = 'green';
                    break;
                case 3:
                    $color = 'red';
                    break;
            }
        ?>
            <div class=" col-sm-12 col-md-12 col-lg-6 col-xl-4">
                <div class="searchtour-list-block">
                    <div class="city-img">
                        <img src="<?php echo base_url('uploads/tour_city/' . $search_shared_tour['city_image']); ?>" alt="Tour City" onerror="this.src='<?= DEFAULT_IMAGE ?>/transfers_default.png';">
                    </div>
                    <div class="tour-date <?php echo $color ?>">
                        <?php
                        echo date('d M Y', strtotime($search_shared_tour['tour_date']));
                        ?>
                    </div>
                    <div class="tour-city-name">
                        <h2>
                            <?php
                            echo '"' . $search_shared_tour['shared_tour_variable_name'] . '"';
                            ?>
                            <span>
                                <?php
                                echo 'FROM ' . $search_shared_tour['shared_tour_city_name']
                                ?>
                            </span>
                        </h2>
                    </div>
                    <div class="tour-details">
                        <div class="searchtour-list-inner">
                            <h5 class="searchtour-list-label mb-0">
                                <i class="fas fa-user-tie"></i>Agency
                            </h5>
                            <label class="mb-0 agency-name">
                                <?php echo $search_shared_tour['agency'] ?>
                            </label>
                        </div>
                        <div class="searchtour-list-inner">
                            <h5 class="searchtour-list-label mb-0">
                                <i class="fas fa-ship"></i>Ship
                            </h5>
                            <label class="mb-0">
                                <?php echo $search_shared_tour['ship'] ?>
                                <?php // echo date('Y-m-d', strtotime($search_shared_tour['tour_date'])) 
                                ?>
                            </label>
                        </div>
                        <div class="searchtour-list-inner">
                            <h5 class="searchtour-list-label mb-0">
                                <i class="fas fa-user-alt"></i>Passengers
                            </h5>
                            <label class="mb-0">
                                <?php echo $search_shared_tour['passengers'] ?>
                            </label>
                        </div>
                        <div class="searchtour-list-inner">
                            <h5 class="searchtour-list-label mb-0">
                                <i class="fas fa-clock"></i>Pick up time
                            </h5>
                            <label class="mb-0">
                                <?php echo $search_shared_tour['pick_up_time'] ?>
                            </label>
                        </div>
                        <div class="searchtour-list-inner">
                            <h5 class="searchtour-list-label mb-0">
                                <i class="fas fa-file-alt"></i>Notes
                            </h5>
                            <label class="mb-0 lh-cstm">
                                <?php
                                echo strlen($search_shared_tour['notes']) > 40 ? substr($search_shared_tour['notes'], 0, 40) . "...&nbsp" . '<a  data-toggle="modal" data-target="#notes" class="readMore">Read more</a>' : $search_shared_tour['notes'];
                                ?>
                            </label>
                            <p class="d-none"><?php echo $search_shared_tour['notes'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            $tourCounter++;
            if ($tourCounter == 5) {
                $tourCounter = 1;
            }
        }
        ?>
    </div>
    <?php
    if ($pagination) {
    ?>
        <div class="pagination-div">
            <?php
            echo $pagination;
            ?>
        </div>
    <?php
    }
    ?>
    <!-- Read more modal -->
    <!-- data-toggle="modal" data-target="#video_galley_popup" -->
    <!-- <a data-toggle="modal" data-target="#notes">Modal</a> -->
    <div id="notes" class="modal fade notes-modal" role="dialog" data-backdrop="static">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Notes</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fal fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <h5 class="modal-agency-name">Agency: <span></span></h5>
                    <p class="brief-notes"></p>
                </div>
            </div>
        </div>
    </div>
<?php
} else {
?>
    <h4 class="text-center mt-4">Sorry, no tour available for your search!</h4>
<?php
}
?>