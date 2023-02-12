<?php $validation1 = \Config\Services::validation();?>
<br><br><br><br><br><br><br><br><br><br><br><br>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Admin Login</title>

  <link rel="stylesheet" href="<?= base_url('assets/css/loginstyle.css')?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="login-box col-12 col-lg-6 col-md-6 col-sm-12">
        <div class="header mt-2">
          <a href="<?= base_url('#home')?>" class="texthp"><img src="<?= base_url('assets/image/iicon.png')?>"></a>
        </div>

        <h3>Admin Login</h3>
        <form class="login100-form validate-form" action="<?= base_url('pages/check');?>" method="post">

          <?php 
            if(!empty($errorAcc)){ ?>
              <div class="err-msg">
               <center><h4><?php echo $errorAcc;?></h4></center>
              </div>
          <?php }?>
          <?php 
            if(!empty($success)){ ?>
              <div class="suc-msg">
                <center><h4><?php echo $success;?></h4></center>
              </div>
          <?php }?>

          <br>
          <div class="form-group user-box">
            <div class="icon-box"><i class="fas fa-user-alt"></i></div>
            <input class="form-control" type="text" name="email" placeholder="Enter your Email" value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>"><?php if($validation1->getError('email')) {?>
              <span id="wronginput_msg">
                <?= $error = $validation1->getError('email'); ?>
              </span>
              <?php }?>
          </div>

          <div class="form-group user-box">
            <div class="icon-box"><i class="fas fa-key"></i></div>
            <input type="password" class="form-control" name="password" id="id_password" placeholder="Enter your Password" value="<?php if(isset($_POST['password'])) { echo $_POST['password']; }?>"><i class="far fa-eye fa-eye-slash" id="togglePassword"></i>
          </div>

          <?php if($validation1->getError('password')) {?>
            <span id="wronginput_msg1">
              <?= $error = $validation1->getError('password'); ?>
            </span>
          <?php }?>
          <?php 
          if(!empty($errorMessage)){ ?>
            <span id="wronginput_msg1">
              <?php echo $errorMessage;?>
            </span>
          <?php }?>

          <div class="fpass" >
            <a href="<?=base_url('/forgot-password');?>">Forgot Password?</a>
          </div>

          <div class="Login-btn-class col-sm-12 col-md-12 col-lg-12">
            <button class="btn">Login</button>
          </div>

          <br><br>
          <div class="back-btn-class mb-2">
              <a href="<?= base_url('/user-type');?>" class="back-btn">Back</a>
          </div>
        </form>
      </div>
    </div>
  </div>

<script type="text/javascript">
  const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#id_password');

  togglePassword.addEventListener('click', function (e) {
          // toggle the type attribute
          const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
          password.setAttribute('type', type);
          // toggle the eye slash icon
          this.classList.toggle('fa-eye-slash');
        });
</script>

</body>
</html>



    


    