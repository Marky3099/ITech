<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
<script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/type.css')?>">

<div class="container">
	<div class="row">
		<div class="left-half col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
		</div>
		<div class="right-half col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
			<div class="containerr" style="width: 100%">
				<div class="header">
					<a href="<?= base_url('#home')?>" class="texthp"><img src="<?= base_url('assets/image/iicon.png')?>"></a>
				</div>
				<br class="spacing">
				<div class="box-content">
					<h2 class="mt-2">Hi, User!</h2>
					<p class="mt-2"><i class="fas fa-chevron-circle-down"></i>&nbsp;Please click or tap type of account.</i></p>

					<div class="btn-layer">
						<a href="<?= base_url('/admin-login')?>" class="btn btn-success btn-sm"><div class="icon-box"><i class="fas fa-user-shield"></i></div>Admin</a></br>
						<a href="<?= base_url('/secretary-login')?>" class="btn btn-success btn-sm"><div class="icon-box"><i class="fas fa-user-shield"></i></div>Secretary</a></br>
						<a href="<?= base_url('/employee-login')?>" class="btn btn-success btn-sm"><div class="icon-box"><i class="fas fa-user-alt"></i></div>Technician</a>
					</div>
					<br><br>
					<p class="para1">Want to book an Appointment?<a href="<?= base_url('/client-type')?>" style="font-style: italic; color: limegreen;">&nbsp;Click here.</a></p>
		
					<p class="para1"> @ 2022 by ITechs.</i></p>
					<a href="<?= base_url();?>" class="btn btn-success" id="back-btn">Back to Website</a>
				</div>
			</div>
		</div>
	</div>
</div>