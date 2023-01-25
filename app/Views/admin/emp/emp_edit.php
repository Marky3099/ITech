<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<div class="body-content">
  <div class="edit-form">
    <form method="post" id="update_emp" name="update_emp" 
    action="<?= base_url('/emp/update') ?>">
    <input type="hidden" name="emp_id" id="id" value="<?php echo $Emp_obj['emp_id']; ?>">
    
    <div class="form-box">
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

      <div class="user-box">
        <div class="icon-box"><i class="fas fa-user-alt"></i></div>
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
        <br>

        <div class="container1">
          <button type="submit" class="btn btn-success">Update</button>
          <a href='<?=base_url('/emp')?>' class="back-btn">Back</a>
        </div>
      </div>

    </form>
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

