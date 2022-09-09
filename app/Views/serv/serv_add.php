<div class="body-content">
  <div class="add-form"> 
    <form method="post" id="add_create" name="add_create" 
    action="<?= base_url('serv/add') ?>">
    <?php if($error) {?>
                  <div class='alert alert-danger mt-2' align="center">
                    <?= $error ?>
                  </div>
              <?php }?>
             
    <h1>Add Service</h1>
    <div class="form-content">
      <div class="form-group">
        <label id="label1">Service Name</label>
        <input type="text" name="serv_name" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Description</label>
        <input type="text" name="serv_description" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Price</label>
        <input type="text" name="price" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Color</label>
        <input type="color" name="serv_color" class="form-control" required>
      </div>
      
      <div class="form-group">
        <button type="submit" class="btn btn-success">Add Data</button>
      </div>
      <div class="form-group">
        <a href="<?= base_url('/serv');?>" class="btn btn-secondary back">Back</a>
      </div>
    </div>
    </form>
  </div>
</div>
</div>

 
