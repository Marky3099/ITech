<div class="body-content">
  <div class="edit-form">
    <form method="post" id="update_user" name="update_user" 
    action="<?= base_url('/serv/update') ?>">
      <input type="hidden" name="serv_id" id="id" value="<?php echo $Serv_obj['serv_id']; ?>">
      <h1>Edit Service</h1>
      <div class="form-content">
      <div class="form-group">
        <label id="label1">Service Name</label>
        <input type="text" name="serv_name" class="form-control" value="<?php echo $Serv_obj['serv_name']; ?>">
      </div>

      <div class="form-group">
        <label>Description</label>
        <input type="text" name="serv_description" class="form-control" value="<?php echo $Serv_obj['serv_description']; ?>">
      </div>
      <div class="form-group">
        <label>Price</label>
        <input type="text" name="price" class="form-control" value="<?php echo $Serv_obj['price']; ?>">
      </div>
      <div class="form-group">
        <label>Color</label>
        <input type="color" name="serv_color" class="form-control" value="<?= htmlspecialchars($Serv_obj['serv_color']);?>">
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-success">Save Data</button>
      </div>
      <div class="form-group">
        <a href="<?= base_url('/serv');?>" class="btn btn-secondary back">Back</a>
      </div>
    </div>
    </form>
  </div>
</div>
</div>