<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<div class="container">
  <div class="row">
    <div class="body-content" style="width: 100%" style="margin-top: 285px; padding: 35px;">
      <div class="edit-form">
        <form method="post" id="update_aircon" name="update_aircon" action="<?= base_url('aircon/update');?>">
          <input type="hidden" name="aircon_id" id="id" value="<?php echo $Aircon_obj['aircon_id']; ?>">
            <div class="form-box col-12 col-lg-6 col-md-6 col-sm-12" id="aircon-form">
              <h3>Edit Aircon Details</h3><br>
              <div class="user-box">
                <div class="icon-box"><i class="fas fa-wrench"></i></div>
                <input type="text" name="device_brand" value="<?php echo $Aircon_obj['device_brand']; ?>">
              </div>

              <div class="user-box">
                <div class="icon-box"><i class="fas fa-wrench"></i></div>
                <input type="text" name="aircon_type" value="<?php echo $Aircon_obj['aircon_type']; ?>">
              </div><br>

              <div class="container1">
                <a href='<?=base_url('/aircon')?>' class="back-btn">Back</a>
                <button type="submit" class="btn btn-success">Update</button>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>