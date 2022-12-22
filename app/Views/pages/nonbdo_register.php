<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>
  <link rel="stylesheet" href="<?= base_url('assets/css/registerstyle.css')?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
</head>
<body>

 <div class="register-box" >
  <div class="header">
    <a href="<?= base_url('#home')?>" class="texthp"><img src="<?= base_url('assets/image/iicon.png')?>"></a>
  </div>
  <?php 
  if(!empty($error)){ ?>
    <div class="err-msg">
     <center><h4><?php echo $error;?></h4></center>
   </div>
 <?php }?>
 <?php 
 if(!empty($success)){ ?>
  <div class="suc-msg">
   <center><h4><?php echo $success;?></h4></center>
 </div>
<?php }?>
<h3>Registration</h3>
<p>Registrant's Name</p>
<form class="login100-form validate-form" action="<?= base_url('/non-bdo-register/add');?>" method="post">
  <div class="user-box">
    <div class="icon-box"><i class="fas fa-user-alt"></i></div><div class="icon-box1"><i class="fas fa-user-alt"></i></div>
    <input class="fname" type="text" name="fname" placeholder="First name" value="<?php if(isset($_POST['fname'])) { echo $_POST['fname']; }?>">
    <input class="lname" type="text" name="lname" placeholder="Last name" value="<?php if(isset($_POST['lname'])) { echo $_POST['lname']; }?>">
  </div>
  <div class="user-box">
    <div class="icon-box"><i class="fas fa-user-alt"></i></div><div class="icon-box1"><i class="fas fa-user-alt"></i></div>
    <input class="email" type="email" name="email" placeholder="E-mail" value="<?php if(isset($_POST['email'])) { echo $_POST['email']; }?>">
    <input class="contact" type="tel" pattern="[0-9]{11}" name="contact" placeholder="Contact Number" value="<?php if(isset($_POST['contact'])) { echo $_POST['contact']; }?>">
  </div>
  <div class="user-box">
    <div class="icon-box"><i class="fas fa-user-alt"></i></div>
    <input class="cname" type="text" name="company" placeholder="Company name (ex.BDO Taguig)" value="<?php if(isset($_POST['company'])) { echo $_POST['company']; }?>">
  </div>
  <div class="user-box">
    <div class="icon-box"><i class="fas fa-user-alt"></i></div>
    <input class="address" type="text" name="address" placeholder="Address" value="<?php if(isset($_POST['address'])) { echo $_POST['address']; }?>">
  </div>
  
  <div class="user-box">
    <div class="icon-box"><i class="fas fa-key"></i></div>
    <input class="password" type="password" name="password" id="password" placeholder="Enter your Password" value="<?php if(isset($_POST['password'])) { echo $_POST['password']; }?>"><i class="far fa-eye fa-eye-slash" id="togglePassword"></i>
    <?php 
      if(!empty($error_pass)){ ?>
        <div class="pass-err-msg">
         <center><h4><?php echo $error_pass;?></h4></center>
       </div>
     <?php }?>
  </div>
  
  <div class="user-box">
    <div class="icon-box"><i class="fas fa-key"></i></div>
    <input class="cpassword" type="password" name="c_password" id="cpassword" placeholder="Confirm your Password" value="<?php if(isset($_POST['c_password'])) { echo $_POST['c_password']; }?>"><i class="far fa-eye fa-eye-slash" id="togglePassword1"></i>
  </div>
  
  <p>NOTE: Partner Company’s account is subject to approval. Once approved, a message will be sent to your registered E-mail.</p>

  <button class="btn">
    <span></span>
    <span></span>
    <span></span>
    <span></span>Sign up</button>
    
    <p class="para1">Already have an account? <a href="<?=base_url('/non-bdo-login')?>" style="font-style: italic;">Login now</a>.</p>
  </a>
  <br><br><br>
  <a href="<?= base_url('/client-type');?>" class="back-btn">Back</a>
</form>
</div>  
<script type="text/javascript">
  const togglePassword = document.querySelector('#togglePassword');
  const togglePassword1 = document.querySelector('#togglePassword1');
  const password = document.querySelector('#password');
  const cpassword = document.querySelector('#cpassword');

  togglePassword.addEventListener('click', function (e) {
          // toggle the type attribute
          const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
          password.setAttribute('type', type);
          // toggle the eye slash icon
          this.classList.toggle('fa-eye-slash');
        });
  togglePassword1.addEventListener('click', function (e) {
          // toggle the type attribute
          const type = cpassword.getAttribute('type') === 'password' ? 'text' : 'password';
          cpassword.setAttribute('type', type);
          // toggle the eye slash icon
          this.classList.toggle('fa-eye-slash');
        });
      </script>
    </body>
    </html>



    


    