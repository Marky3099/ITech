<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<div class="body-content">
  <div class="edit-form">
    <form method="post" id="update_aircon" name="update_aircon" 
    action="<?= base_url('aircon/update');?>">
      <input type="hidden" name="aircon_id" id="id" value="<?php echo $Aircon_obj['aircon_id']; ?>">
    
    <div class="form-box">
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
          <button type="submit" class="btn btn-success">Add Data</button>
          <a href='<?=base_url('/aircon')?>' class="back-btn">Back</a>
        </div>
    </div>
    </form>
  </div>
</div>
