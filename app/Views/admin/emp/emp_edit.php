<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div class="container">
  <div class="row">
    <div class="body-content" style="width: 100%;">
      <div class="edit-form">
        <form method="post" id="update_emp" name="update_emp" action="<?= base_url('/emp/update') ?>">
          <input type="hidden" name="emp_id" id="id" value="<?php echo $Emp_obj['emp_id']; ?>">
          <div class="form-box col-12 col-lg-5 col-md-5 col-sm-12" id="emp-form1" style="margin-top: 285px; padding: 35px;">
            <h3>Edit Technician Details</h3>
            <br>
            <div class="user-box">
              <div class="icon-box"><i class="fas fa-user-alt"></i></div>
              <input type="text" name="emp_name" value="<?php echo $Emp_obj['emp_name']; ?>" placeholder="Name">
            </div>

            <div class="user-box">
              <div class="icon-box"><i class="fas fa-user-alt"></i></div>
              <input type="email" name="emp_email" value="<?php echo $Emp_obj['emp_email']; ?>" placeholder="E-mail">
            </div>

            <div class="user-box">
              <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
              <input type="text" name="emp_address" value="<?php echo $Emp_obj['emp_address']; ?>" placeholder="Address">
            </div>

            <div class="user-box">
              <div class="icon-box"><i class="fas fa-phone"></i></div>
              <input type="tel" pattern="[0-9]{11}" name="emp_contact" value="<?php echo $Emp_obj['emp_contact']; ?>" placeholder="09XXXXXXXXX - 11 digits only">
            </div>

            <div class="user-box" id="expertise">
              <label class="explbl">Expertise</label>
              <select type="text" name="emp_expertise[]" class="selectpicker" multiple data-selected-text-format="count > 3" required>
                <?php foreach($service as $serv):?>
                  <?php foreach($expertise as $exp):?>
                    <?php if($serv['serv_id']==$exp['serv_id']):?>
                      <option value="<?=$serv['serv_id'];?>" selected><?=$serv['serv_name']?></option>
                    <?php else:?>
                      <option value="<?=$serv['serv_id'];?>"><?=$serv['serv_name']?></option>
                  <?php endif;?>
                  <?php endforeach;?>
                  <option value="<?=$serv['serv_id'];?>"><?=$serv['serv_name']?></option>
                <?php endforeach;?>
              </select>
            </div>
              <br><br><br>

            <div class="container1 mt-4">
              <a href='<?=base_url('/emp')?>' class="back-btn">Back</a>
              <button type="submit" class="btn btn-success">Update</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
  $(".selectpicker option").each(function() {
    if($(this).attr('selected')){
      $(this).siblings('[value="'+ this.value +'"]').remove();
    }
  });
  $(".selectpicker option").each(function() {
    $(this).siblings('[value="'+ this.value +'"]').remove();
  });
  $(".selectpicker").html($(".selectpicker option").sort(function (a, b) {
    return a.text == b.text ? 0 : a.text < b.text ? -1 : 1
  }));
</script>

