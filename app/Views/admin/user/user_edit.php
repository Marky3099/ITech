<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div class="container">
  <div class="row">
    <div class="body-content" style="width: 100%;">
      <div class="edit-form">
        <form method="post" id="update_user" name="update_user" action="<?= base_url('/user/update/'.$User_obj['user_id']) ?>">
          <input type="hidden" name="serv_id" id="id" value="<?php echo $User_obj['user_id']; ?>">

          <div class="form-box col-12 col-lg-5 col-md-5 col-sm-12" id="user-form1" style="margin-top: 285px; padding: 35px;">
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

            <div class="row">
              <label id="rolelbl">Role</label>
              <div class="select-dropdown" id="cssroles">
                <select id="position" name="position">
                  <?php if($User_obj['position' ]== "Admin"):?>
                    <option value="Employee">Technician</option>
                    <option value="Admin" selected>Admin</option>
                  <?php elseif($User_obj['position'] == "Employee"):?>
                    <option value="Employee" selected>Technician</option>
                    <option value="Admin" >Admin</option>
                  <?php endif;?>
                </select>
              </div>
              <div id="for">
                <!-- dont remove this div with id="for" -->
              </div>
            </div><br><br>
            <div class="container1" id="user-edit-submit">
              <a href='<?=base_url('/user')?>' class="back-btn">Back</a>
              <button type="submit" class="btn btn-success">Update</button>
            </div>
          </div>
        </form>
      </div>
    </div>
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
        <label id="accforlbl">Account for</label>
        
        <div class="select-dropdown" id="accfor">
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
          <label id="accforlbl">Account for</label>
          
          <div class="select-dropdown" id="accfor">
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