<?php
$password = $partner_password; //Change to whatever you want your password to be
$passWrong = false;
if (isset($_POST['submit'])) {
    if ($_POST['password'] == $password) {
        // if ($password == $password) {
?>
        <!-- <div class="breadcrumb n-breadcrumb">
            <div class="container">
                <ul>
                    <li><a href="<?= BASE_URL ?>">Home</a></li>
                    <li>Partners</li>
                </ul>
            </div>
        </div> -->
        <section class="text-section">
            <div class="container">
                <h2 class="title">Search shared tour</h2>
                <div class="search-shared-tour-wrapper">
                    <form action="#" method="post" name="sharedTourSearch" id="sharedTourSearch" class="custom-form">
                        <div class="row justify-content-center">
                            <div class="col-md-12 col-lg-3">
                                <div class="form-group field-group select2-popup">
                                    <fieldset class="tour-city-fieldset tour-fieldset">
                                        <legend>City</legend>
                                        <select readonly name="sharedTourCity" id="sharedTourCity" class="form-control search-tour">
                                            <option value="">-- Select--</option>
                                            <option value="1">Civitavecchia</option>
                                            <option value="2">Livorno</option>
                                            <option value="3">Naples</option>
                                        </select>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-3">
                                <div class="form-group field-group select2-popup">
                                    <fieldset class="tour-city-fieldset">
                                        <legend>Tour</legend>
                                        <select readonly name="sharedTour" id="sharedTour" class="form-control search-tour">
                                            <option value="">-- Select--</option>
                                            <?php
                                            if ($shared_tour_variables)
                                                foreach ($shared_tour_variables as $shared_tour_variable) {
                                            ?>
                                                <!-- <option value="<?php echo $shared_tour_variable['id'] ?>"><?php echo $shared_tour_variable['name'] ?></option> -->
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-3">
                                <div class="form-group field-group">
                                    <fieldset class="tour-date-fieldset">
                                        <legend>Date</legend>
                                        <input type="text" autocomplete="off" placeholder="Select" name="sharedTourDate" id="sharedTourDate" class="form-control search-tour">
                                    </fieldset>
                                </div>
                            </div>
                            <div class="col-auto search-shared-btn pt-2">
                                <button type="submit" class="btn btn-blue pt-2 pb-2 pl-4 pr-4 w-100 d-none" id="searchSharedTour" name="searchSharedTour">Search</button>
                            </div>
                            <div class="cstm-error-wrapper"></div>
                        </div>
                        <input type="hidden" name="sharedTourDate1" id="sharedTourDate1" value="">
                    </form>
                </div>
                <!-- AJAX search list will be add here -->
                <div class="search-result-wrapper">
                </div>
            </div>
        </section>
    <?php
    } else {
    ?>
        <!-- <div class="breadcrumb n-breadcrumb">
            <div class="container">
                <ul>
                    <li><a href="<?php echo BASE_URL ?>">Home</a></li>
                    <li>Partners</li>
                </ul>
            </div>
        </div> -->
        <section class="text-section">
            <div class="container">
                <h2 class="title">Password Required</h2>
                <div class="custom-form">
                    <form method="post" style="text-align:center;">
                        <p>You need to enter the password below to access the content of this page!</p>
                        <div class="row justify-content-center">
                            <div class="col-md-3">
                                <div class="form-group field-group">
                                    <fieldset class="fullname-fieldset">
                                        <legend class="text-left">Password</legend>
                                        <input type="password" class="form-control" autocomplete="off" name="password" />
                                    </fieldset>
                                </div>
                            </div>
                            <div class="col-auto pt-2">
                                <button type="submit" class="btn btn-blue pt-2 pb-2" name="submit">Submit Password</button>
                            </div>
                            <div class="col-md12 w-100">
                                <p style="color: red">Sorry the password were incorrect</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    <?php
    }
} else { //IF THE FORM WAS NOT SUBMITTED
    //SHOW FORM
    ?>
    <!-- <div class="breadcrumb n-breadcrumb">
        <div class="container">
            <ul>
                <li><a href="<?php echo BASE_URL ?>">Home</a></li>
                <li>Partners</li>
            </ul>
        </div>
    </div> -->
    <section class="text-section">
        <div class="container">
            <h2 class="title">Password Required</h2>
            <div class="custom-form">
                <form method="post" style="text-align:center;">
                    <p>You need to enter the password below to access the content of this page!</p>
                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            <div class="form-group field-group">
                                <fieldset class="fullname-fieldset">
                                    <legend class="text-left">Password</legend>
                                    <input type="password" class="form-control" autocomplete="off" name="password" />
                                </fieldset>
                            </div>
                        </div>
                        <div class="col-auto pt-2">
                            <button type="submit" class="btn btn-blue pt-2 pb-2" name="submit">Submit Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <?php
    // exit();
    ?>
<?php
}
