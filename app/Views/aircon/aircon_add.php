<div class="body-content">
  <div class="add-form">
    <form method="post" id="add_aircon" name="add_aircon" 
    action="<?= base_url('aircon/add');?>">
    <?php if($error) {?>
                  <div class='alert alert-danger mt-2' align="center">
                    <?= $error ?>
                  </div>
              <?php }?>
  
    <h1>Add Aircon</h1>
    <div class="form-content long">
      <div class="form-group">
        <label id="label1">Device Brand</label>
        <input type="text" name="device_brand" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Aircon Type</label>
        <input type="text" name="aircon_type" class="form-control" required>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-success">Add Data</button>
      </div>
      <div class="form-group">
        <a href="<?= base_url('/aircon');?>" class="btn btn-secondary back">Back</a>
      </div>
    </div>
    </form>
  </div>
</div>
</div>
 
