<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div class="container">
  <div class="row">
    <div class="body-content" style="width: 100%;">
      <div class="add-form">
        <form method="post" id="add_create" name="add_create" action="<?= base_url('emp/add') ?>">
          <?php if($error) {?>
          <div class='alert alert-danger mt-2' align="center">
            <?= $error ?>
          </div>
          <?php }?>

          <div class="form-box col-12 col-lg-5 col-md-5 col-sm-12" id="emp-form" style="margin-top: 285px; padding: 35px;">
            <h3>Add Technician</h3><br>
      
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

            <div class="user-box" id="expertise">
              <label class="explbl">Expertise</label>
              <select type="text" name="emp_expertise[]" class="exp selectpicker" multiple data-selected-text-format="count > 3">
                <?php foreach($service as $serv):?>
                  <option value="<?=$serv['serv_id']?>"><?=$serv['serv_name']?></option>
                <?php endforeach;?>
              </select>
            </div>
            </br></br><br>

              <div class="container1 mt-4">
                <a href='<?=base_url('/emp')?>' class="back-btn">Back</a>
                <button type="submit" class="btn btn-success">Submit</button>
              </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
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

