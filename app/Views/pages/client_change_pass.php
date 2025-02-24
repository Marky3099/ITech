<br><br><br>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title></title>

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/fpass.css');?>">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-4 col-xl-4 col-lg-4 col-md-4 col-sm-offset-4 col-md-offset-4">
        <div class="panel panel-default" style="border-radius: 10px; background-color: #fff;">
          <div class="panel-body">
            <div class="header">
              <a href="<?= base_url('#home')?>" class="texthp"><img src="<?= base_url('assets/image/logo.png')?>">&nbsp;&nbsp;Tasks and Schedule Monitoring and Appointment System</a>
            </div>

            <div class="text-center">
              <h3><i class="fa fa-lock fa-4x"></i></h3>
              <?php 
              // Display Response
              if(session()->has('message')):
              ?>
                <div class="alert <?= session()->getFlashdata('alert-class') ?>" style="margin-left: -16px; background-color: green; width: 360px; color: white;">
                  <h5><?= session()->getFlashdata('message') ?></h5>
                </div>
              <?php elseif(session()->has('error')):?>
                <div class="alert <?= session()->getFlashdata('alert-class') ?>" style="margin-left: -16px; background-color: red;width: 360px; color: white;">
                  <h5><?= session()->getFlashdata('error') ?></h5>
                </div>
              <?php endif;?>

              <h2 class="text-center">Reset Password</h2>

              <div class="panel-body">
                <form id="register-form" role="form" autocomplete="off" class="form" method="post" action="<?=base_url('/reset-password/'.$bdo_obj['bdo_email']);?>">

                  <div class="form-group">
                    <div class="input-group">
                      <label>New Password</label>
                      <input id="password" name="password" placeholder="Enter New Password" class="form-control"  type="password" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <label>Confirm Password</label>
                      <input id="c_password" name="c_password" placeholder="Confirm Password" class="form-control"  type="password" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <input name="recover-submit" class="btn btn-lg btn-success btn-block" value="Reset Password" type="submit">
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

<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
  var timeout = 3000; // in miliseconds (3*1000)

  $('.alert').delay(timeout).fadeOut(300);
</script>
</body>
</html>