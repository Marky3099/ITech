<div class="body-content">
  <div class="add-form">
    <form method="post" id="add_client" name="add_client" 
    action="<?= base_url('client/add') ?>">
    <?php if($error) {?>
                  <div class='alert alert-danger mt-2' align="center">
                    <?= $error ?>
                  </div>
              <?php }?>
  
    <h1>Add Client</h1>
    <div class="form-content long">
      <div class="form-group">
        <label id="label1">Branch Area</label>
        <input type="text" name="area" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Branch Name</label>
        <input type="text" name="client_branch" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Address</label>
        <input type="text" name="client_address" class="form-control">
      </div>

      <div class="form-group">
        <label>Contact</label>
        <input type="text" name="client_contact" class="form-control">
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-success">Add Data</button>
      </div>
      <div class="form-group">
        <a href="<?= base_url('/client');?>" class="btn btn-secondary back">Back</a>
      </div>
    </div>
    </form>
  </div>
</div>
</div>
 
