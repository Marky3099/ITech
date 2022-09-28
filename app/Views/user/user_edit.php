<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<div class="body-content">
  <div class="edit-form">
    <form method="post" id="update_user" name="update_user" 
    action="<?= base_url('/user/update/'.$User_obj['user_id']) ?>">
      <input type="hidden" name="serv_id" id="id" value="<?php echo $User_obj['user_id']; ?>">
    
      <div class="form-box">
        <h3>Edit User</h3>
          <div class="user-box">
              <div class="icon-box"><i class="fas fa-user-alt"></i></div>
              <input type="text" name="name" id="name" value="<?php echo $User_obj['name']; ?>">
          </div>

          <div class="user-box">
              <div class="icon-box"><i class="fas fa-user-alt"></i></div>
              <input type="text" name="email" id="email" value="<?php echo $User_obj['email']; ?>">
          </div>

          <div class="user-box">
              <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
              <input type="text" name="address" id="address" value="<?php echo $User_obj['address']; ?>">
          </div>

          <div class="user-box">
            <div class="icon-box"><i class="fas fa-phone"></i></div>
            <input type="tel" name="contact" id="contact" pattern="[0-9]{11}" value="<?php echo $User_obj['contact']; ?>">
          </div>

          <label>Role</label>
          <div class="select-dropdown">
            <select id="position" name="position">
              <?php if($User_obj['position' ]== "Admin"):?>
              <option value="Employee">Employee</option>
              <option value="Admin" selected>Admin</option>
              <?php elseif($User_obj['position'] == "Employee"):?>
              <option value="Employee" selected>Employee</option>
              <option value="Admin" >Admin</option>
              <?php endif;?>
            </select>
          </div><br>

          <div class="container1">
          <button type="submit" class="btn btn-success">Submit</button>
          <button onclick="history.back()" class="back-btn">Back</button>
          </div>

      </div>

    </form>
  </div>
</div>