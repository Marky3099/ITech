<div class="body-content">
  <div class="edit-form">
    <form method="post" id="update_aircon" name="update_aircon" 
    action="<?= base_url('aircon/update');?>">
      <input type="hidden" name="aircon_id" id="id" value="<?php echo $Aircon_obj['aircon_id']; ?>">
      <h1>Edit Aircon</h1>
      <div class="form-content long">
      <div class="form-group">
        <label id="label1">Device Brand</label>
        <input type="text" name="device_brand" class="form-control" value="<?php echo $Aircon_obj['device_brand']; ?>">
      </div>
      <div class="form-group">
        <label>Aircon Type</label>
        <input type="text" name="aircon_type" class="form-control" value="<?php echo $Aircon_obj['aircon_type']; ?>">
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-success">Save Data</button>
      </div>
      <div class="form-group">
        <a href="<?= base_url('/aircon');?>" class="btn btn-secondary back">Back</a>
      </div>
    </div>
    </form>
  </div>
</div>
</div>

