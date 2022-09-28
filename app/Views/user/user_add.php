<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<div class="body-content">
  <div class="add-form">
    <form method="post" id="add_create" name="add_create" enctype="multipart/form-data"
    action="<?= base_url('user/add') ?>">
    <?php if($error) {?>
                  <div class='alert alert-danger mt-2' align="center">
                    <?= $error ?>
                  </div>
              <?php }?>
    
      <div class="form-box">
        <h3>Add User</h3>
          <div class="user-box">
              <div class="icon-box"><i class="fas fa-user-alt"></i></div>
              <input type="text" name="name" id="name" placeholder="User Name" required>
          </div>

          <div class="user-box">
              <div class="icon-box"><i class="fas fa-user-alt"></i></div>
              <input type="text" name="email" id="email" placeholder="E-mail" required>
          </div>

          <div class="user-box">
              <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
              <input type="text" name="address" id="address" placeholder="Address" required>
          </div>

          <div class="user-box">
            <div class="icon-box"><i class="fas fa-phone"></i></div>
            <input type="tel" name="contact" id="contact" pattern="[0-9]{11}" placeholder="09XXXXXXXXX - 11 digits only" required>
          </div>

          <label>Role</label>
          <div class="select-dropdown">
            <select id="position" name="position">
            <option value="Admin">Admin</option>
            <option value="Employee">Employee</option>
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
 
