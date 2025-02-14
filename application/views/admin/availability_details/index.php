<!-- Load Toastr CSS and JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link href="<?php echo base_url('assets/css/admin_availability.css'); ?>" rel="stylesheet" type="text/css">

<div class="page-header page-header-default">

    <!-- <div class="page-header-content">

        <div class="page-title">

            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo _l('availability'); ?></span></h4>

        </div>

    </div> -->

    <div class="breadcrumb-line">

        <ul class="breadcrumb">

            <li><a href="<?= admin_url() ?>"><i class="icon-home2 position-left"></i><?php echo _l('dashboard'); ?></a>
            </li>
            <li><a href="<?= admin_url('availability') ?>"><?php echo _l('availability'); ?></a>
            </li>

        </ul>

    </div>

</div>

<!-- /Page header -->



<!-- Content area -->

<div class="content">

    <div class="row">

        <div class="col-md-12">

            <!-- Panel -->




            <div class="panel panel-flat">
                <div class="panel-body">
                    <!-- Calendar Form Section -->
                    <div class="custom-form availability-close-wrapper mt-5">
                        <fieldset>
                            <legend>Availability Calendar</legend>
                            <form action="#" id="calendarForm" method="POST">
                                <div class="form-group">
                                    <!-- Radio Buttons for Selection Mode -->
                                    <label class="col-form-label label_text">Select Date Mode:</label>
                                    <div class="mt-2">
                                        <label class="mr-3">
                                            <input type="radio" name="date_mode" value="single" checked> Single Date
                                        </label>
                                        <label>
                                            <input type="radio" name="date_mode" value="range"> Range Date
                                        </label>
                                    </div>

                                    <!-- Calendar -->
                                    <div id="datepicker" class="mt-3"></div>

                                </div>
                            </form>
                        </fieldset>
                    </div>

                    <!-- Availability Details Section -->
                    <div class="custom-form availability-close-wrapper mt-4" style="margin-top:30px">
                        <fieldset>
                            <legend>Availability Details</legend>
                            <form action="#" id="availabilityDetails" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <div class="row">
                                        <!-- Availability Title -->
                                        <div class="col-md-12 mt-3">
                                            <label class="col-form-label label_text">Availability Title
                                                <small class="req text-danger">*</small>
                                            </label>
                                            <textarea name="availability_title" id="availability_title"
                                                class="form-control" rows="3" required>
                            <?= isset($availability_details['availability_title']) ? htmlspecialchars($availability_details['availability_title']) : '' ?>
                        </textarea>
                                        </div>
                                        <!-- Availability Description -->
                                        <div class="col-md-12 mt-3">
                                            <label class="col-form-label label_text">Availability Description
                                                <small class="req text-danger">*</small>
                                            </label>
                                            <textarea name="availability_description" id="availability_description"
                                                class="form-control" rows="3" required>
                            <?= isset($availability_details['availability_description']) ? htmlspecialchars($availability_details['availability_description']) : '' ?>
                        </textarea>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="btn-bottom-toolbar text-center btn-toolbar-container-out">
                                            <button type="submit" class="btn btn-primary"><?php _el('save'); ?></button>
                                            <button type="button" class="btn btn-default"
                                                id="reset_open_close_tour"><?php _el('reset'); ?></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </fieldset>
                    </div>

                    <div id="rates-container" style="margin-top:30px">
                        <div class="custom-form rate-close-wrapper">
                            <fieldset>
                                <legend>Rates</legend>

                                <!-- "Add rates" Button Aligned to the Right -->
                                <div class="text-right mb-2" style="padding: 10px;
    margin-bottom: 10px; margin-top: -20px;">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" id="ratesAdd">
                                        Add Rates
                                    </button>
                                </div>

                                <!-- DataTable for displaying rates items -->
                                <table id="rates_table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>

                                            <th>Drag</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                        </div>
                        </fieldset>


                    </div> <!-- Container where the rates table will be loaded dynamically -->

                </div>
            </div>



            <!-- Modal for displaying selected date and options -->
            <div id="dateModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="dateModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="dateModalLabel">Select Booking Option</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p id="selectedDateDisplay">Selected Date: </p>
                            <!-- Dropdown for options -->
                            <label for="bookingOption">Select Option:</label>
                            <select id="bookingOption" class="form-control">
                                <option value="1">Booked</option>
                                <option value="2">Optioned</option>
                                <option value="3">Available</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" id="saveOption" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>

<!-- Modal Structure -->
<div class="modal fade" id="ratesModal" tabindex="-1" role="dialog" aria-labelledby="ratesModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" id="ratesForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="ratesModalLabel">Rates Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="id" name="id" class="form-control">

                        <!-- From Date Input Field -->
                        <div class="col-md-6 mt-3">
                            <label class="col-form-label label_text">From Date <small
                                    class="req text-danger">*</small></label>
                            <input type="date" id="fromDate" name="from_date" class="form-control" required>
                        </div>

                        <!-- To Date Input Field -->
                        <div class="col-md-6 mt-3">
                            <label class="col-form-label label_text">To Date <small
                                    class="req text-danger">*</small></label>
                            <input type="date" id="toDate" name="to_date" class="form-control" required>
                        </div>

                        <!-- Price Input Field -->
                        <div class="col-md-6 mt-3">
                            <label class="col-form-label label_text">Price <small
                                    class="req text-danger">*</small></label>
                            <input type="number" id="price" name="price" class="form-control" placeholder="Enter price"
                                min="0" step="0.01" required>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

            <!-- /Panel -->

        </div>

    </div>

</div>

<!-- /page header -->
<script type="text/javascript" src="<?php echo base_url('assets/scripts/admin/availability.js'); ?>"></script>
