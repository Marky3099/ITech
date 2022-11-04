<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<div class="body-content">
  <div class="edit-form">
    <form method="post" id="update_emp" name="update_emp" 
    action="<?= base_url('/emp/update') ?>">
    <input type="hidden" name="emp_id" id="id" value="<?php echo $Emp_obj['emp_id']; ?>">
    
    <div class="form-box">
      <h3>Edit Employee Details</h3>
      <br>
      <div class="user-box">
        <div class="icon-box"><i class="fas fa-user-alt"></i></div>
        <input type="text" name="emp_name" value="<?php echo $Emp_obj['emp_name']; ?>" placeholder="Name">
      </div>

      <div class="user-box">
        <div class="icon-box"><i class="fas fa-user-alt"></i></div>
        <input type="email" name="emp_email" value="<?php echo $Emp_obj['emp_email']; ?>" placeholder="E-mail">
      </div>

      <div class="user-box">
        <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
        <input type="text" name="emp_address" value="<?php echo $Emp_obj['emp_address']; ?>" placeholder="Address">
      </div>

      <div class="user-box">
        <div class="icon-box"><i class="fas fa-phone"></i></div>
        <input type="tel" pattern="[0-9]{11}" name="emp_contact" value="<?php echo $Emp_obj['emp_contact']; ?>" placeholder="09XXXXXXXXX - 11 digits only">
      </div>

        <!-- <div class="user-box">
          <div class="icon-box"><i class="fas fa-user-alt"></i></div>
          <input type="text" name="emp_position" value="<?php echo $Emp_obj['emp_position']; ?>">
        </div> --><br>

        <div class="container1">
          <button type="submit" class="btn btn-success">Update</button>
          <a href='<?=base_url('/emp')?>' class="back-btn">Back</a>
        </div>
      </div>

    </form>
  </div>
</div>  


