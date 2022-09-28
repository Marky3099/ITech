<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
  <div class="edit-form"> 
     <form method="post" id="update_user" name="update_user" action="<?= base_url('/serv/update') ?>">
      <input type="hidden" name="serv_id" id="id" value="<?php echo $Serv_obj['serv_id']; ?>">
             
    <div class="form-box" style="height: 65%; top: 50%;">
      <h3>Edit Service</h3><br>
      <div class="user-box">
         <div class="icon-box"><i class="fas fa-wrench"></i></div>
        <input type="text" name="serv_name" class="serv-name" value="<?php echo $Serv_obj['serv_name']; ?>">
      </div>

      <div class="user-box">
        <div class="icon-box"><i class="fas fa-wrench"></i></div>
        <input type="text" name="serv_description" class="serv-desc" value="<?php echo $Serv_obj['serv_description']; ?>">
      </div>

      <div class="user-box">
        <div class="icon-box"><i class="fas fa-tags"></i></div>
        <input type="number" name="price" class="price" value="<?php echo $Serv_obj['price']; ?>">
      </div>

      <div class="container">
        <input type="color" name="serv_color" id="color-picker" value="<?= htmlspecialchars($Serv_obj['serv_color']);?>">
        <label for="color-picker">Color</label>
      </div><br>
      
      <div class="container1">
        <button type="submit" class="btn btn-success">Add Data</button>
        <button onclick="history.back()" class="back-btn">Back</button>
      </div>
    </div>
    </form>
  </div>

 
