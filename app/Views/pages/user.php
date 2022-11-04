<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
<script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/type.css')?>">


<div class="left-half"></div>
<div class="right-half">
	<div class="container">
		<div class="header">
			<a href="<?= base_url('#home')?>" class="texthp"><img src="<?= base_url('assets/image/iicon.png')?>"></a>
		</div>
		<div class="box-content">
			<h2>Hi, User!</h2>
			<p><i class="fas fa-chevron-circle-down"></i>&nbsp;Please click or tap type of account.</i></p>

			<div class="btn-layer">
				<a href="<?= base_url('/admin-login')?>" class="btn btn-success"><div class="icon-box"><i class="fas fa-user-shield"></i></div>Admin</a></br>
				<a href="<?= base_url('/employee-login')?>" class="btn btn-success"><div class="icon-box"><i class="fas fa-user-alt"></i></div>Employee</a>
			</div>
			
			<p class="para1">Want to book an Appointment?<a href="<?= base_url('/client-type')?>" style="font-style: italic; color: limegreen;">&nbsp;Click here.</a></p>
		</br>
	</br>
	<p class="para1"> By using this service, you understood and agree to Maylaflor’s Tasks and Schedule Monitoring System <i>Terms of Use and Privacy Statement.</i></p>
	<a href="<?= base_url();?>" class="back2w">Back to Website</a>
</div>
</div>

</div>