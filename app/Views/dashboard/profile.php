<link rel="stylesheet" href="<?= base_url('assets/css/profilestyle.css')?>">
<div class="body-content">
    <form method="post" id="updateuser" name="updateuser" enctype="multipart/form-data"
    action="<?= base_url('/profile/update') ?>">
      <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_data['user_id']; ?>">
     <?php 
        // Display Response
        if(session()->has('message')):
        ?>
           <div class="alert <?= session()->getFlashdata('alert-class') ?>" style="background-color: green;width: 400px; color: white;">
              <?= session()->getFlashdata('message') ?>
           </div>
        
        <?php 
        // Display Response
        elseif(session()->has('error')):
        ?>
           <div class="alert <?= session()->getFlashdata('alert-class') ?>" style="background-color: red; width: 400px; color: white;">
              <?= session()->getFlashdata('error') ?>
           </div>
        <?php endif;?>
        <!-- <a href = "Account.html" ><button class = "buttonp buttonp2"><i style = "color: white"></i> Profile </button></a> -->
        <!-- <a href = "Dashboard.html" ><button class = "buttonp buttonp1"><i style = "color: white"></i> Home </button></a> -->
       
        <div class="crud-text"><h1>Profile</h1></div>

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
</div>