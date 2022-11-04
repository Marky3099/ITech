<link rel="stylesheet" href="<?= base_url('assets/css/profilestyle.css')?>">
<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<div class="body-content" style="height: 100%;">
  <form method="post" id="updateuser" name="updateuser" enctype="multipart/form-data"
  action="<?= base_url('/profile/update') ?>">
  <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_data['user_id']; ?>">
  
  <!-- <a href = "Account.html" ><button class = "buttonp buttonp2"><i style = "color: white"></i> Profile </button></a> -->
  <!-- <a href = "Dashboard.html" ><button class = "buttonp buttonp1"><i style = "color: white"></i> Home </button></a> -->
  
  <div class="form-box" style="width: 600px; height: 550px; top: 45%;" >
    <h3 class="sidef">Profile</h3>
    
    <div class="profilee">
      <?php if($_SESSION['user_img'] != NULL):?>
        <img src="<?= base_url("uploads/".$_SESSION['user_img']);?>" class="pimg">
      <?php else:?>
        <img src="<?= base_url("assets/image/profile.jpg");?>" class="pimg">
      <?php endif;?>
    </div>
    <h2><?php echo $_SESSION['username'] ?> </h2>
    <h3><?php echo $_SESSION['email'] ?></h3>

    <hr>
    <div class="user-box">
      <div class="icon-box"><i class="fas fa-user-alt"></i></div>
      <div class="icon-box1"><i class="fas fa-user-alt"></i></div>
      <input type="text" class="pname" id="name" name = "name" size = "40" style="color: grey" value="<?php echo $user_data['username']; ?>" placeholder="Username">
      <input type="email" class="pemail" id="email" name = "email" size = "40" style="color: grey" value="<?php echo $user_data['email']; ?>" placeholder="E-mail">
    </div>

    <div class="user-box">
      <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
      <div class="icon-box1"><i class="fas fa-phone"></i></div>
      <input type="text" id="address" class="paddress" name = "address" size = "40" style="color: grey" value="<?php echo $user_data['address']; ?>" placeholder="Address">
      <input type="tel" id="contact" class="pcontact"name = "contact" style="color: grey" value="<?php echo $user_data['contact']; ?>" pattern="[0-9]{11}" placeholder="09XXXXXXXXX - 11 digits only">
    </div>

    <div class="user-box">
      <div class="icon-box"><i class="fas fa-phone"></i></div>
      <div class="icon-box1"><i class="fas fa-phone"></i></div>
      <input type="password" class="ppassword" id="password" name = "password" style="color: grey" placeholder="Password">
      <input type="password" class="pcpassword" id="c_password" name = "c_password" style="color: grey" placeholder="Confirm Password">
    </div>

    <div class="user-box">
      <div class="icon-box"><i class="fas fa-file-image"></i></div>
      <input type="file" id="user_img" name = "user_img" style="color: grey; width: 89%;" value="<?php echo $user_data['user_img']; ?>" >
    </div><br>

    <div class="container1">
      <button type="submit" class="btn btn-success">Update Profile</button>
    </div>
    <br>
  </div>     
  
</form>
</div>
       <!--  <div class="crud-text"><h1>Profile</h1></div>

        <div class = "Top1">
        <div class = "Form1">

          <?php if($_SESSION['user_img'] != NULL):?>
              <img src="<?= base_url("uploads/".$_SESSION['user_img']);?>">
                <?php else:?>
                    <img src="<?= base_url("assets/image/profile.jpg");?>">
                <?php endif;?>
          <h1><?php echo $_SESSION['username'] ?> </h1>
          <h4><?php echo $_SESSION['email'] ?></h4>
        </div>
        </div>

        <div class = "Top">
        <div class = "Form">
          
          <h1>Edit Profile </h1><font color = red size = 4 face = "Arial"><b>
          
          <font color = #323F4B size = 4 face = "Arial"><b>Name</b></font><br><input type="text" id="name" 
          name = "name" size = "40" style="color: grey" value="<?php echo $user_data['username']; ?>" ><br><br>
          <font color = #323F4B size = 4 face = "Arial"><b>Email Address</b></font><br><input type="email" 
          id="email" name = "email" size = "40" style="color: grey" value="<?php echo $user_data['email']; ?>"><br><br>
          <font color = #323F4B size = 4 face = "Arial"><b>Address</b></font><br><input type="text" id="address"
          name = "address" size = "40" style="color: grey" value="<?php echo $user_data['address']; ?>"><br><br>
          <font color = #323F4B size = 4 face = "Arial"><b>Contact Number</b></font><br><input type="text"
          id="contact" name = "contact" style="color: grey" value="<?php echo $user_data['contact']; ?>" size = "11" maxlength = "18" ><br><br>
          <font color = #323F4B size = 4 face = "Arial"><b>Password</b></font><br><input type="password"
          id="password" name = "password" style="color: grey" ><br><br>
          <font color = #323F4B size = 4 face = "Arial"><b>Confirm Password</b></font><br><input type="password"
          id="c_password" name = "c_password" style="color: grey" ><br><br>
          <font color = #323F4B size = 4 face = "Arial"><b>Profile Pic</b></font><br><input type="file"
          id="user_img" name = "user_img" style="color: grey" value="<?php echo $user_data['user_img']; ?>" ><br><br>
        <div class="form-group">
          <button type="submit" class="btn btn-success">Update Profile</button> 
        </div>
      </div>
    </form>
</div>
</div> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
  <?php if(session()->has('message')) {?>
      // alert('Delete');
      Swal.fire({
       icon: 'success',
       title: 'Updated Successfully!',
       text: 'Your Account has been updated.',
       type: 'success'
     })
    <?php }?>
    <?php if(session()->has('error')) {?>
      // alert('Delete');
      Swal.fire({
       icon: 'error',
       title: 'Password didn\'t match!',
       text: 'Please try again.',
     })
    <?php }?>
  </script>