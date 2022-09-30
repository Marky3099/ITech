<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<div class="body-content">
  <div class="add-form">
    <form method="post" id="add_aircon" name="add_aircon" 
    action="<?= base_url('aircon/add');?>">
    <?php if($error) {?>
                  <div class='alert alert-danger mt-2' align="center">
                    <?= $error ?>
                  </div>
              <?php }?>
    
    <div class="form-box">
        <h3>Add Aircon Details</h3><br>
        <div class="user-box">
           <div class="icon-box"><i class="fas fa-wrench"></i></div>
          <input type="text" name="device_brand" placeholder="Device Brand" required>
        </div>

        <div class="user-box">
           <div class="icon-box"><i class="fas fa-wrench"></i></div>
           <input type="text" name="aircon_type" placeholder="Aircon type" required>
        </div><br>

        <div class="container1">
          <button type="submit" class="btn btn-success">Add Data</button>
          <a href='<?=base_url('/aircon')?>' class="back-btn">Back</a>
        </div>
    </div>

    </form>
  </div>
</div>