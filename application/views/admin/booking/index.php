<!--Page header -->



<!-- <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script> -->



<!-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" /> -->



<!-- <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script> -->



<!-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" /> -->



<div class="page-header">



    <div class="page-header-content">



        <div class="page-title">



            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo _l('bookings_list'); ?></span></h4>



        </div>







    </div>







    <div class="breadcrumb-line breadcrumb-line-component">



        <ul class="breadcrumb">



            <li>



                <a href="<?php echo admin_url(); ?>"><i class="icon-home2 position-left"></i><?= _l('dashboard'); ?></a>



            </li>



            <li class="active"><?php echo _l('bookings_list'); ?></li>



        </ul>







    </div>



</div>



<!-- /Page header -->











<!-- Content area -->



<div class="content">



    <!-- Panel -->



    <div class="panel panel-flat">



        



        <!-- Listing table -->



        <div class="panel-body table-responsive">



            <div class="input-daterange">



                <div class="row">



                    <div class="col-md-4">



                        <label class="col-form-label label_text text-lg-right">Select From and To Date<small class="req text-danger"></small></label>



                        <div class="input-group date tour_datepicker" > 



                            <input type="text" name="start_date" id="start_date" class="form-control  start_date" placeholder="Select Start Date" autocomplete="off">



                            <div class="input-group-addon"> 



                                <span class="glyphicon glyphicon-th"></span>



                            </div>



                        </div>                                                



                    </div>



                    <div class="col-md-4">



                        <div class="clear-wrap">



                            <input type="button" name="clear" id="clear" value="clear" class="btn btn-info" />



                        </div>



                    </div>



                    <!-- <div class="col-md-4">



                        <div class="input-group date tour_datepicker" > 



                            <input type="text" name="end_date" id="end_date" class="form-control  end_date" placeholder="Select Start Date" autocomplete="off">



                            <div class="input-group-addon"> 



                                <span class="glyphicon glyphicon-th"></span>



                            </div>



                        </div>



                    </div> -->



                    <!-- <div class="col-md-4">



                        <input type="button" name="search" id="search" value="Search" class="btn btn-info" />



                    </div>



                    <div class="col-md-4">



                        <input type="button" name="clear" id="clear" value="clear" class="btn btn-error" />



                    </div> -->



                </div>



            </div>



            <table id="booking_list_table" class="table table-bordered table-striped" width="100%">



                <thead>



                    <tr>



                        <th></th>



                        <th>Name</th>



                        <th>Email</th>



                        <th>Phone Number</th>                        



                        <th>Tour/Transfer Name</th>



                        <th>Type</th>



                        <th>Created Date</th>



                        <th>Booking Date</th>



                        <th>Subscription</th>



                    </tr>



                </thead>



                



            </table>          



        </div>



        <!-- /Listing table -->



    </div>



    <!-- /Panel -->



</div>