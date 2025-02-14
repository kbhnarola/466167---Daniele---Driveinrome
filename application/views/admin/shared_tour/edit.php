<!--Page header -->
<div class="page-header page-header-default">
  <div class="page-header-content">
    <div class="page-title">
      <h4>
        <span class="text-semibold"><?php echo _l('edit_shared_tour'); ?></span>
      </h4>
    </div>
  </div>
  <div class="breadcrumb-line">
    <ul class="breadcrumb">
      <li>
        <a href="<?php echo admin_url('shared-tour'); ?>"><i class="icon-home2 position-left"></i><?php echo _l('shared_tour_list'); ?></a>
      </li>
      <li class="active"><?php _el('edit'); ?></li>
    </ul>
  </div>
</div>
<!-- /Page header -->
<!-- Content area -->
<div class="content ">
  <div class="row">
    <div class="col-md-12">
      <!-- Panel -->
      <div class="panel panel-flat">
        <!-- Panel heading -->
        <div class="panel-body">
          <div class="custom-form">
            <form action="<?php echo admin_url('shared_tour/edit/' . base64_encode($sharedTourData['id'])); ?>" id="editSharedTour" method="POST">
              <fieldset>
                <legend><?php echo _l('edit_shared_tour'); ?></legend>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                      <label class="col-form-label label_text text-lg-right"><?php echo _l('select_tour'); ?><small class="req text-danger">*</small></label>
                      <div class="tour-wrapper">
                        <input type="radio" name="tour" id="civitavecchia" class="checkbox-input" <?php echo ($sharedTourData['shared_tour_city_id'] == 1) ? 'checked' : '' ?> value="1">
                        <label for="civitavecchia" class="checkbox-label">
                          <div class="checkbox-text">
                            <p class="checkbox-text--title">Civitavecchia</p>
                          </div>
                        </label>
                        <input type="radio" name="tour" id="livorno" class="checkbox-input" value="2" <?php echo ($sharedTourData['shared_tour_city_id'] == 2) ? 'checked' : '' ?> />
                        <label for="livorno" class="checkbox-label">
                          <div class="checkbox-text">
                            <p class="checkbox-text--title">Livorno</p>
                          </div>
                        </label>
                        <input type="radio" name="tour" id="naples" class="checkbox-input" value="3" <?php echo ($sharedTourData['shared_tour_city_id'] == 3) ? 'checked' : '' ?> />
                        <label for="naples" class="checkbox-label">
                          <div class="checkbox-text">
                            <p class="checkbox-text--title">Naples</p>
                          </div>
                        </label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label class="col-form-label label_text text-lg-right"><?php echo _l('select_date'); ?><small class="req text-danger">*</small></label>
                      <div class="input-group date tour_datepicker">
                        <input type="text" name="tour_date" id="tour_date" class="form-control tour_date" placeholder="Select Date" autocomplete="off" aria-invalid="false" value="<?php echo date('d-m-Y', strtotime($sharedTourData['tour_date'])) ?>">
                        <div class="input-group-addon">
                          <span class="glyphicon glyphicon-th"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6 tour-id-selction">
                      <label class="col-form-label label_text text-lg-right "><?php echo _l('tour_variable'); ?><small class="req text-danger">*</small></label>
                      <select name="tour_variable_id" id="tour_variable_id" class="form-control" autocomplete="off">
                        <option></option>
                        <?php
                        if ($shared_tour_variable) {
                          foreach ($shared_tour_variable as $single_shared_tour_variable) {
                        ?>
                            <option value="<?php echo $single_shared_tour_variable['id'] ?>" <?php echo ($single_shared_tour_variable['id'] == $sharedTourData['shared_tour_variable_id']) ? 'selected="selected"' : '' ?>><?php echo $single_shared_tour_variable['name']; ?></option>
                        <?php
                          }
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label class="col-form-label label_text text-lg-right "><?php echo _l('passengers'); ?><small class="req text-danger">*</small></label>
                      <input type="number" id="passengers" class="form-control" name="passengers" autocomplete="off" value="<?php echo $sharedTourData['passengers'] ?>">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                      <label class="col-form-label label_text text-lg-right "><?php echo _l('agency'); ?><small class="req text-danger">*</small></label>
                      <input type="text" id="agency" class="form-control" name="agency" autocomplete="off" value="<?php echo $sharedTourData['agency'] ?>">
                    </div>
                    <div class="col-md-6">
                      <label class="col-form-label label_text text-lg-right "><?php echo _l('ship'); ?><small class="req text-danger">*</small></label>
                      <input type="text" id="ship" class="form-control" name="ship" autocomplete="off" value="<?php echo $sharedTourData['ship'] ?>">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                      <label class="col-form-label label_text text-lg-right "><?php echo _l('time'); ?><small class="req text-danger">*</small></label>
                      <input type="text" id="time" class="form-control" name="time" autocomplete="off" value="<?php echo $sharedTourData['pick_up_time'] ?>">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12">
                      <label class="col-form-label label_text text-lg-right "><?php echo _l('notes'); ?></label>
                      <textarea id="notes" name="notes" class="form-control resize_box" rows="4"><?php echo $sharedTourData['notes'] ?></textarea>
                    </div>
                  </div>
                </div>
                <div class="row mr-t-25">
                  <div class="col-sm-12">
                    <hr>
                  </div>
                </div>
                <div class="row">
                  <div class="btn-bottom-toolbar text-center btn-toolbar-container-out">
                    <button type="submit" class="btn btn-primary" name="edit_shared_tour"><?php echo _l('edit_shared_tour'); ?></button>
                    <button type="reset" class="btn btn-default" name="reset_shared_tour" id="reset_shared_tour"><?php _el('reset'); ?></button>
                  </div>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
      <!-- /Panel -->
    </div>
  </div>
</div>
<!-- /Content area-->