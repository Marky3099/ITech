<link rel="stylesheet" href="<?= base_url('assets/css/profilestyle.css')?>">
<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<div class="body-content" style="height: 100%;">
  <form method="post" id="updateuser" name="updateuser" enctype="multipart/form-data"
  action="<?= base_url('/profile-bdo/update') ?>">
  <input type="hidden" name="bdo_id" id="user_id" value="<?php echo $user_data['bdo_id']; ?>">
  
  <!-- <a href = "Account.html" ><button class = "buttonp buttonp2"><i style = "color: white"></i> Profile </button></a> -->
  <!-- <a href = "Dashboard.html" ><button class = "buttonp buttonp1"><i style = "color: white"></i> Home </button></a> -->
  
  <div class="form-box" id="clientfbox">
    <h3 class="sidef">Profile</h3>
    
    <div class="profilee">
      <?php if($_SESSION['user_img'] != NULL):?>
        <img src="<?= base_url("uploads/".$_SESSION['user_img']);?>" class="pimg">
      <?php else:?>
        <img src="<?= base_url("assets/image/profile.jpg");?>" class="pimg">
      <?php endif;?>
    </div>
    <h2><?php echo $_SESSION['bdo_fname'] .' '. $_SESSION['bdo_lname']  ?> </h2>
    <h3><?php echo $_SESSION['bdo_email'] ?></h3>

    <hr>
    <div class="user-box">
      <div class="icon-box"><i class="fas fa-user-alt"></i></div>
      <div class="icon-box1"><i class="fas fa-user-alt"></i></div>
      <input type="text" class="pname" id="name" name = "bdo_fname" size = "40" style="color: grey" value="<?php echo $user_data['bdo_fname']; ?>" placeholder="First Name">
      <input type="text" class="plname" id="name" name = "bdo_lname" size = "40" style="color: grey" value="<?php echo $user_data['bdo_lname']; ?>" placeholder="Last Name">
    </div>
    <div class="user-box">
      <div class="icon-box"><i class="fas fa-user-alt"></i></div>
      <input type="email" class="bdo_email" id="email" name = "bdo_email" size = "40" style="color: grey" value="<?php echo $user_data['bdo_email']; ?>" placeholder="E-mail">
    </div>

    <div class="user-box">
      <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
      <div class="icon-box1"><i class="fas fa-phone"></i></div>
      <input type="text" id="address" class="paddress" name = "bdo_address" size = "40" style="color: grey" value="<?php echo $user_data['bdo_address']; ?>" placeholder="Address">
      <input type="tel" id="contact" class="pcontact"name = "bdo_contact" style="color: grey" value="<?php echo $user_data['bdo_contact']; ?>" pattern="[0-9]{11}" placeholder="09XXXXXXXXX - 11 digits only">
    </div>

    <div class="user-box">
      <div class="icon-box"><i class="fas fa-phone"></i></div>
      <div class="icon-box1"><i class="fas fa-phone"></i></div>
      <input type="password" class="ppassword" id="password" name = "bdo_password" style="color: grey" placeholder="Password">
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