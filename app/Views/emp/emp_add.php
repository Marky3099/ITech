<div class="body-content">
  <div class="add-form">
    <form method="post" id="add_create" name="add_create" 
    action="<?= base_url('emp/add') ?>">
    <?php if($error) {?>
                  <div class='alert alert-danger mt-2' align="center">
                    <?= $error ?>
                  </div>
              <?php }?>
  
    <h1>Add Employee</h1>
    <div class="form-content long">
      <div class="form-group">
        <label id="label1">Name</label>
        <input type="text" name="emp_name" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Email</label>
        <input type="text" name="emp_email" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Address</label>
        <input type="text" name="emp_address" class="form-control">
      </div>

      <div class="form-group">
        <label>Contact</label>
        <input type="text" name="emp_contact" class="form-control">
      </div>
      
      <div class="form-group">
        <label>Position</label>
        <input type="text" name="emp_position" class="form-control">
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-success">Add Data</button>
      </div>
      <div class="form-group">
        <a href="<?= base_url('/emp');?>" class="btn btn-secondary back">Back</a>
      </div>
    </div>
    </form>
  </div>
</div>
</div>

 
