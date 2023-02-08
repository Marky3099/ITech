<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<div class="body-content">
  <div class="add-form">
    <form method="post" id="add_create" name="add_create" enctype="multipart/form-data"
    action="<?= base_url('user/add') ?>">
    <?php if($error) {?>
      <div class='alert alert-danger mt-2' align="center">
        <?= $error ?>
      </div>
    <?php }?>
    
    <div class="form-box">
      <h3>Add User</h3>
      <div class="user-box">
        <div class="icon-box"><i class="fas fa-user-alt"></i></div>
        <input type="text" name="name" id="name" placeholder="Username" required>
      </div>

      <div class="user-box">
        <div class="icon-box"><i class="fas fa-user-alt"></i></div>
        <input type="text" name="email" id="email" placeholder="E-mail" required>
      </div>

      <div class="user-box">
        <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
        <input type="text" name="address" id="address" placeholder="Address" required>
      </div>

      <div class="user-box">
        <div class="icon-box"><i class="fas fa-phone"></i></div>
        <input type="tel" name="contact" id="contact" pattern="[0-9]{11}" placeholder="09XXXXXXXXX - 11 digits only" required>
      </div>

      <label>Role</label>
      <div class="select-dropdown">
        <select id="position" name="position">
          <option value="Admin">Admin</option>
          <option value="Secretary">Secretary</option>
          <option value="Employee">Technician</option>
          
        </select>
      </div>
      <div id="for">
        <!-- dont remove this div with id="for" -->
      </div><br>
      <div class="container1">
         <a href='<?=base_url('/user')?>' class="back-btn">Back</a>
        <button type="submit" class="btn btn-success">Submit</button>
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
       text: 'Email already recorded, use unique email for this User',
       type: 'error'
     })
    <?php }?>

    $emp = $('#position');
    $count = 0;
    $emp.change(function(){
      $empPosition = $emp.val();
      if($empPosition === "Employee"){
        $('#for').show();
        
        if ($count===0) {
          $('#for').append(`
            <label>Account for</label>
            
            <div class="select-dropdown">
            <select id="emp_id" name="emp_id">
            <?php foreach($emp as $e):  ?>
              <option value=<?php echo $e['emp_id']; ?>><?php echo $e['emp_name'];?></option>
              <?php endforeach; ?>`);
          $count++;
        }
        
      }else if($empPosition === "Admin") {
        $('#for').hide();
      }
    })

  </script>
  
