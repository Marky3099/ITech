<br>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Register</title>

  <link rel="stylesheet" href="<?= base_url('assets/css/registerstyle.css')?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="register-box col-8 col-lg-8 col-md-8 col-sm-12">
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

          <form class="login100-form validate-form" action="<?= base_url('/bdo-register/add');?>" method="post">
            
            <div class="row">
              <div class="col-8 col-lg-8 col-md-8 col-sm-12">
                <div class="user-box">
                  <div class="icon-box"><i class="fas fa-user-alt"></i></div>
                    <input class="fname" type="text" name="fname" placeholder="First name" value="<?php if(isset($_POST['fname'])) { echo $_POST['fname']; }?>" required>
                    <div class="icon-box1" id="ib1"><i class="fas fa-user-alt"></i></div>
                    <input class="lname" id="lname" type="text" name="lname" placeholder="Last name" value="<?php if(isset($_POST['lname'])) { echo $_POST['lname']; }?>"required> 
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-8 col-lg-8 col-md-8 col-sm-12">
                <div class="user-box">
                  <div class="icon-box"><i class="fas fa-user-alt"></i></div>
                    <input class="email" type="email" name="email" placeholder="E-mail" value="<?php if(isset($_POST['email'])) { echo $_POST['email']; }?>" required>
                    <div class="icon-box1" id="ib2"><i class="fas fa-user-alt"></i></div>
                    <input class="contact" type="tel" pattern="[0-9]{11}" name="contact" placeholder="Contact Number" value="<?php if(isset($_POST['contact'])) { echo $_POST['contact']; }?>" required>
                  </div>
              </div>
            </div>

            <div class="row">
              <div class="col-8 col-lg-8 col-md-8 col-sm-12">
                <div class="user-box">
                  <div class="icon-box"><i class="fas fa-user-alt"></i></div>
                  <input class="cname" type="text" name="company" placeholder="Company name (ex.BDO Taguig)" value="<?php if(isset($_POST['company'])) { echo $_POST['company']; }?>" required>
                  </div>
              </div>
            </div>

            <div class="row">
              <div class="col-8 col-lg-8 col-md-8 col-sm-12">
                <div class="user-box">
                  <div class="icon-box"><i class="fas fa-user-alt"></i></div>
                  <input class="address" type="text" name="address" placeholder="Address" value="<?php if(isset($_POST['address'])) { echo $_POST['address']; }?>" required>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-8 col-lg-8 col-md-8 col-sm-12">
                <div class="user-box">
                  <div class="icon-box"><i class="fas fa-user-alt"></i></div>
                  <input class="unqcode" type="text" name="code" placeholder="Unique code" value="<?php if(isset($_POST['code'])) { echo $_POST['code']; }?>" required>  
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-8 col-lg-8 col-md-8 col-sm-12">
                <div class="user-box">
                    <div class="icon-box"><i class="fas fa-key"></i></div>
                    <input class="password" type="password" name="password" id="password" placeholder="Enter your Password" value="<?php if(isset($_POST['password'])) { echo $_POST['password']; }?>" minlength="8" required><i class="far fa-eye fa-eye-slash" id="togglePassword"></i>
                      <?php 
                      if(!empty($error_pass)){ ?>
                      <div class="pass-err-msg">
                        <center><h4><?php echo $error_pass;?></h4></center>
                      </div>
                      <?php }?>
                  </div>
              </div>
            </div>

            <div class="row">
              <div class="col-8 col-lg-8 col-md-8 col-sm-12">
                <div class="user-box">
                    <div class="icon-box"><i class="fas fa-key"></i></div>
                    <input class="cpassword" type="password" name="c_password" id="cpassword" placeholder="Confirm your Password" value="<?php if(isset($_POST['c_password'])) { echo $_POST['c_password']; }?>" required><i class="far fa-eye fa-eye-slash" id="togglePassword1"></i>  
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-8 col-lg-8 col-md-8 col-sm-12">
                <div class="user-box">
                  <p class="px-2">NOTE: The password should contain characters, capital and small letters, and numbers.</p>
                </div>
              </div>
            </div>

            <div class="reg-btn-class col-sm-12 col-md-12 col-lg-12">
            <button class="btn">Sign Up</button>
            </div>

            <p class="para1">Already have an account? <a href="<?=base_url('/bdo-login')?>"><i><b>Login now</b></i></a>.</p></a>
            <br><br><br>
            <a href="<?= base_url('/client-type');?>" class="back-btn">Back</a>

          </form>
      </div>
    </div>
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



    


    