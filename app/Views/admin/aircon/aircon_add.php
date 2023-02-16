<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


<div class="container">
  <div class="row">
    <div class="body-content" style="width: 100%;">
      <div class="add-form">
        <form method="post" id="add_aircon" name="add_aircon" action="<?= base_url('aircon/add');?>">
          <?php if($error) {?>
            <div class='alert alert-danger mt-2' align="center">
              <?= $error ?>
            </div>
          <?php }?>

          <div class="form-box col-12 col-lg-5 col-md-5 col-sm-12" id="aircon-form" style="margin-top: 285px; padding: 35px;">
            <h3>Add Aircon Details</h3><br>
            <div class="user-box">
             <div class="icon-box"><i class="fas fa-wrench"></i></div>
             <input type="text" name="device_brand" placeholder="Aircon Brand" required>
            </div>

            <div class="user-box">
             <div class="icon-box"><i class="fas fa-wrench"></i></div>
             <input type="text" name="aircon_type" placeholder="Aircon type" required>
            </div><br>

            <div class="container1">
              <a href='<?=base_url('/aircon')?>' class="back-btn">Back</a>
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
