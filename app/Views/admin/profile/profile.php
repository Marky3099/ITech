<link rel="stylesheet" href="<?= base_url('assets/css/profilestyle.css')?>">
<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">

<div class="container">
  <div class="row">
    <div class="body-content" style="width: 100%;">
      <form method="post" id="updateuser" name="updateuser" enctype="multipart/form-data" action="<?= base_url('/profile/update') ?>">
        <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_data['user_id']; ?>">
        <div class="form-box col-12 col-lg-5 col-md-5 col-sm-12" id="profile-form" style="padding: 35px; margin-top: 60px;">
          <h3 class="sidef">Profile</h3>

          <div class="row justify-content-center">
            <div class="col-12 col-lg-5 col-md-5 col-sm-12">
              <div class="profilee">
                <?php if($_SESSION['user_img'] != NULL):?>
                  <img src="<?= base_url("uploads/".$_SESSION['user_img']);?>" class="pimg">
                <?php else:?>
                  <img src="<?= base_url("assets/image/profile.jpg");?>" class="pimg">
                <?php endif;?>
              </div>
              <h2><?php echo $_SESSION['username'] ?> </h2>
              <h3><?php echo $_SESSION['email'] ?></h3>
            </div>
          </div>

          <hr>
          <div class="row">
            <div class="col-12 col-lg-5 col-md-5 col-sm-12">
              <div class="user-box">
                <div class="icon-box" id="name-icon"><i class="fas fa-user-alt"></i></div>
                <div class="icon-box1" id="pemail-icon"><i class="fas fa-user-alt"></i></div>
                <input type="text" class="pname" id="name" name = "name" size = "40" style="color: grey" value="<?php echo $user_data['username']; ?>" placeholder="Username">
                <input type="email" class="pemail" id="email" name = "email" size = "40" style="color: grey" value="<?php echo $user_data['email']; ?>" placeholder="E-mail">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12 col-lg-5 col-md-5 col-sm-12">
              <div class="user-box">
                <div class="icon-box" id="paddress-icon"><i class="fas fa-map-marker-alt"></i></div>
                <div class="icon-box1" id="pcontact-icon"><i class="fas fa-phone"></i></div>
                <input type="text" id="address" class="paddress" name = "address" size = "40" style="color: grey" value="<?php echo $user_data['address']; ?>" placeholder="Address">
                <input type="tel" id="contact" class="pcontact"name = "contact" style="color: grey" value="<?php echo $user_data['contact']; ?>" pattern="[0-9]{11}" placeholder="09XXXXXXXXX - 11 digits only">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12 col-lg-5 col-md-5 col-sm-12">
              <div class="user-box">
                <div class="icon-box" id="ppassword-icon"><i class="fas fa-phone"></i></div>
                <div class="icon-box1" id="pcpassword-icon"><i class="fas fa-phone"></i></div>
                <input type="password" class="ppassword" id="password" name = "password" style="color: grey" placeholder="Password">
                <input type="password" class="pcpassword" id="c_password" name = "c_password" style="color: grey" placeholder="Confirm Password">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12 col-lg-5 col-md-5 col-sm-12">
              <div class="user-box">
                <div class="icon-box" id="file-icon"><i class="fas fa-file-image"></i></div>
                <input type="file" id="user_img" name = "user_img" style="color: grey; width: 100%;" value="<?php echo $user_data['user_img']; ?>" >
              </div><br>
            </div>
          </div>

          <div class="container1">
            <button type="submit" class="btn btn-success" id="submitbtn">Save Changes</button>
          </div>

          </div>
      </form>
    </div>
  </div>
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