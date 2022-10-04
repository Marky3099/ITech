<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<div class="body-content">
  <div class="add-form">
    <form method="post" id="add_create" name="add_create" 
    action="<?= base_url('emp/add') ?>">
    <?php if($error) {?>
                  <div class='alert alert-danger mt-2' align="center">
                    <?= $error ?>
                  </div>
              <?php }?>
    
    <div class="form-box">
      <h3>Add Employee</h3>
      <br>
        <div class="user-box">
          <div class="icon-box"><i class="fas fa-user-alt"></i></div>
          <input type="text" name="emp_name" placeholder="Name" required>
        </div>

        <div class="user-box">
          <div class="icon-box"><i class="fas fa-user-alt"></i></div>
          <input type="email" name="emp_email" placeholder="E-mail" required>
        </div>

        <div class="user-box">
          <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
          <input type="text" name="emp_address" placeholder="Address">
        </div>

        <div class="user-box">
          <div class="icon-box"><i class="fas fa-phone"></i></div>
          <input type="tel" pattern="[0-9]{11}" placeholder="09XXXXXXXXX - 11 digits only" name="emp_contact">
        </div>

       <!--  <div class="user-box">
          <div class="icon-box"><i class="fas fa-user-alt"></i></div>
          <input type="text" name="emp_position" placeholder="Position">
        </div> --><br>

        <div class="container1">
          <button type="submit" class="btn btn-success">Submit</button>
          <a href='<?=base_url('/emp')?>' class="back-btn">Back</a>
        </div>
    </div>

    </form>
  </div>
</div>  
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
  <?php if(session()->getFlashdata('emailExist')) {?>
      // alert('Delete');
      Swal.fire({
             icon: 'error',
             title: 'Email Existed!',
             text: 'Email already recorded, use unique email for this Employee',
             type: 'error'
            })
   <?php }?>
</script>

