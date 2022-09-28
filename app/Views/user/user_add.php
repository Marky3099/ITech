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
        <input type="tel" name="contact" id="contact" pattern="[0-9]{11}" placeholder="09XXXXXXXXX - 11 digits only" class="form-control" required>
      </div>
      <!-- <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
      </div> -->
      <div class="form-group">
        <label>Role</label>
        <select id="position" name="position" class="form-control">
          <option value="Admin">Admin</option>
          <option value="Employee">Employee</option>
          
        </select>
      </div>
       <div class="form-group" id="for">
        
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
      <div class="form-group">
        <a href="<?= base_url('/user');?>" class="btn btn-secondary back">Back</a>
      </div>
    </div>
    </form>
</div>
</div>
</div>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>  
<script type="text/javascript">
  $emp = $('#position');
  

  $emp.change(function(){
    $empPosition = $emp.val();
    if($empPosition === "Employee"){
      $('#for').prepend(`
                                <label>Account for</label>
      
                                <select id="emp_id" name="emp_id" class="form-control">
                                <?php foreach($emp as $e):  ?>
                                    <option value=<?php echo $e['emp_id']; ?>><?php echo $e['emp_name'];?></option>
                                <?php endforeach; ?>
                                `)
  }else if($empPosition === "Admin") {
    $('#for').hide();
  }
  })

  

</script>
 
