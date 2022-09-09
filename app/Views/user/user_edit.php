<div class="body-content">
  <div class="edit-form">
    <form method="post" id="update_user" name="update_user" 
    action="<?= base_url('/user/update/'.$User_obj['user_id']) ?>">
      <input type="hidden" name="serv_id" id="id" value="<?php echo $User_obj['user_id']; ?>">
      <h1>Edit User</h1>
      <div class="form-content long">
      <div class="form-group">
        <label id="label1">User Name</label>
        <input type="text" name="name" id="name" class="form-control" value="<?php echo $User_obj['name']; ?>">
      </div>

      <div class="form-group">
        <label>Email Address</label>
        <input type="text" name="email" id="email" class="form-control" value="<?php echo $User_obj['email']; ?>">
      </div>
       <div class="form-group">
        <label>Address</label>
        <input type="text" name="address" id="address" class="form-control" value="<?php echo $User_obj['address']; ?>">
      </div>

      <div class="form-group">
        <label>Contact Number</label>
        <input type="text" name="contact" id="contact" class="form-control" value="<?php echo $User_obj['contact']; ?>">
      </div>
      <div class="form-group">
        <label>Role</label>
        <select id="position" name="position" class="form-control">
          <?php if($User_obj['position' ]== "Admin"):?>
          <option value="Employee">Employee</option>
          <option value="Admin" selected>Admin</option>
        <?php elseif($User_obj['position'] == "Employee"):?>
          <option value="Employee" selected>Employee</option>
          <option value="Admin" >Admin</option>
        <?php endif;?>
        </select>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-success">Save Data</button>
      </div>
      <div class="form-group">
        <a href="<?= base_url('/user');?>" class="btn btn-secondary back">Back</a>
      </div>
    </div>
    </form>
  </div>
</div>
</div>