<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<div class="body-content">
  <div class="add-form">
    <form method="post" id="add_client" name="add_client" 
    action="<?= base_url('client/add') ?>">
    
    <div class="form-box">
      <h3>Add Client</h3><br>
      <div class="user-box">
       <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
       <input type="text" name="area" placeholder="Branch Area" value="<?php if(isset($_POST['area'])) { echo $_POST['area']; } ?>" required>
     </div>

     <div class="user-box">
      <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
      <input type="text" name="client_branch" placeholder="Branch Name" value="<?php if(isset($_POST['client_branch'])) { echo $_POST['client_branch']; } ?>" required>
    </div>

    <div class="user-box">
      <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
      <input type="text" name="client_address" placeholder="Address" value="<?php if(isset($_POST['client_address'])) { echo $_POST['client_address']; } ?>">
    </div>

    <div class="user-box">
      <div class="icon-box"><i class="fas fa-phone"></i></div>
      <input type="tel" name="client_contact" pattern="[0-9]{11}" placeholder="09XXXXXXXXX - 11 digits only" value="<?php if(isset($_POST['client_contact'])) { echo $_POST['client_contact']; } ?>">
    </div>

    <div class="user-box">
      <div class="icon-box"><i class="fas fa-user-alt"></i></div>
      <input type="email" name="client_email" placeholder="E-mail" value="<?php if(isset($_POST['client_email'])) { echo $_POST['client_email']; } ?>" required>
    </div><br>
    
    <div class="container1">
      <button type="submit" class="btn btn-success">Submit</button>
      <a href='<?=base_url('/client')?>' class="back-btn">Back</a>
    </div>
  </div>

</form>
</div>
</div>  
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
  <?php if(session()->getFlashdata('branchError')) {?>
      // alert('Delete');
      Swal.fire({
       icon: 'error',
       title: 'Branch Name Existed!',
       text: 'This Branch is already registered.',
       type: 'error'
     })
    <?php }?>
    <?php if(session()->getFlashdata('emailExist')) {?>
      // alert('Delete');
      Swal.fire({
       icon: 'error',
       title: 'Email Existed!',
       text: 'This Email is Already Registered, Please Use Another Email for this Client.',
       type: 'error'
     })
    <?php }?>
  </script>