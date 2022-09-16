<?php $validation1 = \Config\Services::validation();
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>Login</title>
 	<link rel="stylesheet" href="<?= base_url('assets/css/loginstyle.css')?>">
 </head>
 <body>
	 <div class="login-box" >
		  <!-- <img src=" //base_url('assets/image/logo.png')" align="center"><br><br>
		  <h4>Tasks and Schedule Monitoring System</h4> -->
		  <div class="header">
                   <a href="<?= base_url('#home')?>" class="texthp"><img src="<?= base_url('assets/image/logo.png')?>">&nbsp;&nbsp;Tasks and Schedule Monitoring System</a>
                   </div>
                   <hr>
		  <h3>LOGIN</h3>
		  <form class="login100-form validate-form" action="<?= base_url('pages/check');?>" method="post">

		  	<?php 
					if(!empty($errorAcc)){ ?>
			            <div style="background-color: red;"><b>
			             <h4><center><?php echo $errorAcc;?></center></h4>
			            </div>
			        <?php }?>
			     <?php 
					if(!empty($success)){ ?>
			            <div style=" background-color: green;"><b>
			             <h4><center><?php echo $success;?></center></h4>
			            </div>
			        <?php }?>
			        <br>
					<div class="user-box">
						<input class="email" type="text" name="email"
						value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>"><label>Email</label><?php if($validation1->getError('email')) {?>
			            <div style="color: #FF6969;"><b>
			              <?= $error = $validation1->getError('email'); ?>
			            </div>
			        <?php }?>
					</div>
					<br>
					 

					<div class="user-box">
						<input type="password" name="password"  
						value="<?php if(isset($_POST['password'])) { echo $_POST['password']; } ?>"><label>Password</label>
						
					</div>
					<div class="fpass" style="float:right;" >
			        	<a href="<?=base_url('/forgot_password');?>" style="color: white; font-size: 12px;">Forgot Password?</a>
			        </div>
					<?php if($validation1->getError('password')) {?>
			            <div style="color: #FF6969;"><b>
			              <?= $error = $validation1->getError('password'); ?>
			            </div>
			        <?php }?>
			        <?php 
					if(!empty($errorMessage)){ ?>
			            <div style="color: #FF6969;"><b>
			             <?php echo $errorMessage;?>
			            </div>
			        <?php }?>
			        
			        <button class="btn">
				    <span></span>
				    <span></span>
				    <span></span>
				    <span></span>Submit</button>
				    
				    </a>
				    <br><br><br>
				    <a href="<?= base_url();?>"><h5>Back to Website</h5></a>
		  </form>
		</div>	
 </body>
 </html>



	


	