<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<div class="edit-form"> 
 <form method="post" id="update_user" name="update_user" action="<?= base_url('/serv/update') ?>">
  <input type="hidden" name="serv_id" id="id" value="<?php echo $Serv_obj['serv_id']; ?>">
  
  <div class="mb-5 form-box">
    <h3>Edit Service</h3><br>
    <div class="user-box" id="ibserv1">
     <div class="icon-box"><i class="fas fa-wrench"></i></div>
     <input type="text" name="serv_name" value="<?php echo $Serv_obj['serv_name']; ?>" placeholder="Service Name">
   </div>
   <div class="user-box" id="ibserv2">
     <div class="icon-box"><i class="fas fa-wrench"></i></div>
     <input type="text" name="serv_type" placeholder="Service Type" value="<?php echo $Serv_obj['serv_type']; ?>" placeholder="Service Type" required>
   </div>
   <div class="user-box" id="ibserv3">
    <div class="icon-box"><i class="fas fa-wrench"></i></div>
    <input type="text" name="serv_description" value="<?php echo $Serv_obj['serv_description']; ?>" placeholder="Service Description">
  </div>

  <div class="user-box" id="ibserv4">
    <div class="icon-box"><i class="fas fa-tags"></i></div>
    <input type="number" name="price" value="<?php echo $Serv_obj['price']; ?>" placeholder="Price">
  </div>

  <div class="container" id="ibserv5">
    <input type="color" name="serv_color" id="color-picker" value="<?= htmlspecialchars($Serv_obj['serv_color']);?>">
    <label for="color-picker" id="colorlbl">Color</label>
  </div><br>
  
  <div class="container1">
    <button type="submit" class="btn btn-success">Submit</button>
    <a href='<?=base_url('/serv')?>' class="back-btn">Back</a>
  </div>
</div>
</form>
</div>


