<?php $validation1 = \Config\Services::validation();
 ?>
 <!DOCTYPE html>
 <html>
 <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link rel="stylesheet" href="<?= base_url('assets/css/loginstyle.css')?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
 </head>
 <body>
   <div class="login-box" >
      <!-- <img src=" //base_url('assets/image/logo.png')" align="center"><br><br>
      <h4>Tasks and Schedule Monitoring System</h4> -->
      <div class="header">
        <a href="<?= base_url('#home')?>" class="texthp"><img src="<?= base_url('assets/image/iicon.png')?>"></a>
        </div>
      <h3>Employee Login</h3>
      <form class="login100-form validate-form" action="<?= base_url('pages/checkEmployee');?>" method="post">

        <?php 
          if(!empty($errorAcc)){ ?>
                  <div style="background-color: red; ">
                   <h4 style="color: white;"><center><?php echo $errorAcc;?></center></h4>
                  </div>
              <?php }?>
           <?php 
          if(!empty($success)){ ?>
                  <div style=" background-color: green;">
                   <h4><center><?php echo $success;?></center></h4>
                  </div>
              <?php }?>
              <br>
          <div class="form-group user-box">
            <div class="icon-box"><i class="fas fa-user-alt"></i></div>
            <input class="email" type="text" name="email" placeholder="Enter your Email"
            value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>"><?php if($validation1->getError('email')) {?>
                  <span style="margin-left: 80px; color: #FF6969;">
                    <?= $error = $validation1->getError('email'); ?>
                  </span>
              <?php }?>
          </div>
          <div class="form-group user-box">
            <div class="icon-box"><i class="fas fa-key"></i></div>
            <input type="password" name="password" id="id_password" placeholder="Enter your Password"
            value="<?php if(isset($_POST['password'])) { echo $_POST['password']; }?>"><i class="far fa-eye fa-eye-slash" id="togglePassword" style="margin-left: -45px; color: #344F21; cursor: pointer;"></i>
          </div>
          <div class="fpass" >
                <a href="<?=base_url('/forgot_password');?>">Forgot Password?</a>
              </div>
          <?php if($validation1->getError('password')) {?>
                  <span style="margin-left: 80px; color: #FF6969;">
                    <?= $error = $validation1->getError('password'); ?>
                  </span>
              <?php }?>
              <?php 
          if(!empty($errorMessage)){ ?>
                  <span style="margin-left: 80px; color: #FF6969;">
                   <?php echo $errorMessage;?>
                  </span>
              <?php }?>
              
              <button class="btn">
            <span></span>
            <span></span>
            <span></span>
            <span></span>Login</button>
            
            </a>
            <br><br><br>
              <a href="<?= base_url('/user-type');?>" class="back-btn">Back</a>
      </form>
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



  


  