<div class="body-content">
  <div class="edit-form">
    <form method="post" id="update_emp" name="update_emp" 
    action="<?= base_url('/emp/update') ?>">
      <input type="hidden" name="emp_id" id="id" value="<?php echo $Emp_obj['emp_id']; ?>">
      <h1>Edit Employee</h1>
      <div class="form-content long">
      <div class="form-group">
        <label id="label1">Name</label>
        <input type="text" name="emp_name" class="form-control" value="<?php echo $Emp_obj['emp_name']; ?>">
      </div>

      <div class="form-group">
        <label>Email</label>
        <input type="email" name="emp_email" class="form-control" value="<?php echo $Emp_obj['emp_email']; ?>">
      </div>

      <div class="form-group">
        <label>Address</label>
        <input type="text" name="emp_address" class="form-control" value="<?php echo $Emp_obj['emp_address']; ?>">
      </div>

      <div class="form-group">
        <label>Contact</label>
        <input type="text" name="emp_contact" class="form-control" value="<?php echo $Emp_obj['emp_contact']; ?>">
      </div>

      <div class="form-group">
        <label>Position</label>
        <input type="text" name="emp_position" class="form-control" value="<?php echo $Emp_obj['emp_position']; ?>">
      </div> 

      <div class="form-group">
        <button type="submit" class="btn btn-success">Save Data</button>
      </div>
      <div class="form-group">
        <a href="<?= base_url('/emp');?>" class="btn btn-secondary back">Back</a>
      </div>
    </div>
    </form>
    </div>
</div>
</div>