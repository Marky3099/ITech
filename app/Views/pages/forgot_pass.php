    <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/fpass.css');?>">

</head>
<body>

  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default" id="panell">
          <div class="panel-body">
            <div class="header">
             <a href="<?= base_url('#home')?>" class="texthp"><img src="<?= base_url('assets/image/logo.png')?>">&nbsp;&nbsp;Tasks and Schedule Monitoring System</a>
           </div>
           <div class="text-center">
            <h3><i class="fa fa-lock fa-4x"></i></h3>
            <?php 
                      // Display Response
            if(session()->has('message')):
              ?>
            <div class="alert <?= session()->getFlashdata('alert-class') ?>" style="margin-left: 20px; background-color: green;width: 294px; color: white;">
             <h5><?= session()->getFlashdata('message') ?></h5>
           </div>
         <?php elseif(session()->has('error')):?>
         <div class="alert <?= session()->getFlashdata('alert-class') ?>" style="margin-left: 20px; background-color: red;width: 294px; color: white;">
           <h5><?= session()->getFlashdata('error') ?></h5>
         </div>
       <?php endif;?>
       <h3 class="text-center">Forgot Password?</h3>
       <p>Enter Your Email Address</p>
       <div class="panel-body">
        
        <form id="register-form" role="form" autocomplete="off" class="form" method="get" action="<?=base_url('/forgot-password/sent');?>">
          
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
              <input id="email" name="email" placeholder="Email Address" class="form-control"  type="email" required>
            </div>
          </div>
          <div class="form-group">
            <input name="recover-submit" class="rpass btn btn-lg btn-success btn-block" value="Reset Password" type="submit">
          </div>

          <div class="container1">
            <a href="<?= base_url('/user-type');?>" class="back-btn">Back</a>
          </div>
          
          <input type="hidden" class="hide" name="token" id="token" value=""> 
        </form>
        
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>

</body>
</html>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
  var timeout = 3000; // in miliseconds (3*1000)

  $('.alert').delay(timeout).fadeOut(300);
</script>