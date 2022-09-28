<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<div class="body-content">
  <div class="edit-form">
    <form method="post" id="update_emp" name="update_emp" 
    action="<?= base_url('/emp/update') ?>">
      <input type="hidden" name="emp_id" id="id" value="<?php echo $Emp_obj['emp_id']; ?>">
    
    <div class="form-box">
      <h3>Edit Employee Details</h3>
        <div class="user-box">
          <div class="icon-box"><i class="fas fa-user-alt"></i></div>
          <input type="text" name="emp_name" value="<?php echo $Emp_obj['emp_name']; ?>">
        </div>

        <div class="user-box">
          <div class="icon-box"><i class="fas fa-user-alt"></i></div>
          <input type="email" name="emp_email" value="<?php echo $Emp_obj['emp_email']; ?>">
        </div>

        <div class="user-box">
          <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
          <input type="text" name="emp_address" value="<?php echo $Emp_obj['emp_address']; ?>">
        </div>

        <div class="user-box">
          <div class="icon-box"><i class="fas fa-phone"></i></div>
          <input type="tel" pattern="[0-9]{11}" name="emp_contact" value="<?php echo $Emp_obj['emp_contact']; ?>">
        </div>

        <div class="user-box">
          <div class="icon-box"><i class="fas fa-user-alt"></i></div>
          <input type="text" name="emp_position" value="<?php echo $Emp_obj['emp_position']; ?>">
        </div><br>

        <div class="container1">
          <button type="submit" class="btn btn-success">Save Data</button>
          <button onclick="history.back()" class="back-btn">Back</button>
        </div>
    </div>

    </form>
  </div>
</div>  


