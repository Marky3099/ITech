<div class="body-content">
  <div class="add-form">
    <form method="post" id="add_create" name="add_create" enctype="multipart/form-data"
    action="<?= base_url('user/add') ?>">
    <?php if($error) {?>
                  <div class='alert alert-danger mt-2' align="center">
                    <?= $error ?>
                  </div>
              <?php }?>
  
    <h1>Add User</h1>
    <div class="form-content long">
      <div class="form-group">
        <label id="label1">User Name</label>
        <input type="text" name="name" id="name" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Email Address</label>
        <input type="text" name="email" id="email" class="form-control" required>
      </div>
       <div class="form-group">
        <label>Address</label>
        <input type="text" name="address" id="address" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Contact Number</label>
        <input type="text" name="contact" id="contact" class="form-control" required>
      </div>
      <!-- <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
      </div> -->
      <div class="form-group">
        <label>Role</label>
        <select id="position" name="position" class="form-control">
          <option value="Employee">Employee</option>
          <option value="Admin">Admin</option>
        </select>
      </div>
       <!-- <div class="form-group">
        <label>Profile Pic</label>
        <input type="file" name="user_img" class="form-control" required>
      </div> -->
      <div class="form-group">
        <button type="submit" class="btn btn-success">Add Data</button>
      </div>
      <div class="form-group">
        <a href="<?= base_url('/user');?>" class="btn btn-secondary back">Back</a>
      </div>
    </div>
    </form>
</div>
</div>
</div>
 
