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
 <div class="login-box" style="height: 85%;">
  <div class="header">
    <a href="<?= base_url('#home')?>" class="texthp"><img src="<?= base_url('assets/image/iicon.png')?>"></a>
  </div>
  <h3>Registration</h3>
  <p>Registrant's Name</p>
  <form class="login100-form validate-form" action="<?= base_url('pages/check');?>" method="post">
    <div class="user-box">
      <div class="icon-box"><i class="fas fa-user-alt"></i></div><div class="icon-box1"><i class="fas fa-user-alt"></i></div>
      <input class="fname" type="text" name="fname" placeholder="First name">
      <input class="lname" type="text" name="lname" placeholder="Last name">
    </div>
    <div class="user-box">
      <div class="icon-box"><i class="fas fa-user-alt"></i></div><div class="icon-box1"><i class="fas fa-user-alt"></i></div>
      <input class="email" type="text" name="email" placeholder="E-mail">
      <input class="contact" type="text" name="contactno" placeholder="Contact Number">
    </div>
    <div class="user-box">
      <div class="icon-box"><i class="fas fa-user-alt"></i></div>
      <input class="cname" type="text" name="cname" placeholder="Company name">
    </div>
    <div class="user-box">
      <div class="icon-box"><i class="fas fa-user-alt"></i></div>
      <input class="address" type="text" name="address" placeholder="Address">
    </div>
    <div class="user-box">
      <div class="icon-box"><i class="fas fa-key"></i></div>
      <input class="password" type="password" name="password" id="password" placeholder="Enter your Password">
    </div>
    <div class="user-box">
      <div class="icon-box"><i class="fas fa-key"></i></div>
      <input class="cpassword" type="password" name="cpassword" id="cpassword" placeholder="Confirm your Password">
    </div>
    <button class="btn">
      <span></span>
      <span></span>
      <span></span>
      <span></span>Sign up</button>
      
      <p class="para1">Already have an account? <a href="#" style="font-style: italic;">Login now</a>.</p>
    </a>
    <br><br><br>
    <button onclick="history.back()" class="back-btn">Back</button>
  </form>
</div>
</body>
</html>






