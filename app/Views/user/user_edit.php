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
              <input type="text" name="name" id="name" value="<?php echo $User_obj['name']; ?>"placeholder="Username">
          </div>

          <div class="user-box">
              <div class="icon-box"><i class="fas fa-user-alt"></i></div>
              <input type="text" name="email" id="email" value="<?php echo $User_obj['email']; ?>" placeholder="E-mail">
          </div>

          <div class="user-box">
              <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
              <input type="text" name="address" id="address" value="<?php echo $User_obj['address']; ?>" placeholder="Address">
          </div>

          <div class="user-box">
            <div class="icon-box"><i class="fas fa-phone"></i></div>
            <input type="tel" name="contact" id="contact" pattern="[0-9]{11}" value="<?php echo $User_obj['contact']; ?>" placeholder="09XXXXXXXXX - 11 digits only">
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
          <div id="for">
            <!-- dont remove this div with id="for" -->
          </div>
          <div class="container1">
          <button type="submit" class="btn btn-success">Submit</button>
          <a href='<?=base_url('/user')?>' class="back-btn">Back</a>
          </div>

      </div>

    </form>
  </div>
</div>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>  
<script type="text/javascript">
  $emp = $('#position');
  $count = 0;
  $empPosition = $emp.val();
  // alert($empPosition);
  if($empPosition === "Employee"){
      $('#for').show();
      
      if ($count===0) {
        $('#for').append(`
            <label>Account for</label>
      
            <select id="emp_id" name="emp_id">
              <?php foreach($emp as $e):  ?>
                <option value=<?php echo $e['emp_id']; ?>><?php echo $e['emp_name'];?></option>
              <?php endforeach; ?>`);
        $count++;
    }
  }
  $emp.change(function(){
    $empPosition = $emp.val();
    if($empPosition === "Employee"){
      $('#for').show();
      
      if ($count===0) {
        $('#for').append(`
            <label>Account for</label>
      
            <select id="emp_id" name="emp_id">
              <?php foreach($emp as $e):  ?>
                <option value=<?php echo $e['emp_id']; ?>><?php echo $e['emp_name'];?></option>
              <?php endforeach; ?>`);
        $count++;
    }
      
  }else if($empPosition === "Admin") {
    $('#for').hide();
  }
  })

</script>