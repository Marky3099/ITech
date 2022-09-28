<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<div class="body-content">
  <div class="edit-form">
    <form method="post" id="update_client" name="update_client" action="<?= base_url('client/update') ?>">
      <input type="hidden" name="client_id" id="id" value="<?php echo $Client_obj['client_id']; ?>">
    
    <div class="form-box">
      <h3>Edit Client Details</h3>
        <div class="user-box">
           <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
           <input type="text" name="area" class="area" value="<?php echo $Client_obj['area']; ?>">
        </div>

        <div class="user-box">
          <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
          <input type="text" name="client_branch" class="client_branch" value="<?php echo $Client_obj['client_branch']; ?>">
        </div>

        <div class="user-box">
          <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
          <input type="text" name="client_address" class="address" value="<?php echo $Client_obj['client_address']; ?>">
        </div>

        <div class="user-box">
          <div class="icon-box"><i class="fas fa-phone"></i></div>
          <input type="tel" name="client_contact" pattern="[0-9]{11}" class="client_contact" value="<?php echo $Client_obj['client_contact']; ?>">
        </div>

        <div class="user-box">
          <div class="icon-box"><i class="fas fa-user-alt"></i></div>
          <input type="email" name="client_email" class="email" value="<?php echo $Client_obj['client_email']; ?>">
        </div><br>
        
        <div class="container1">
          <button type="submit" class="btn btn-success">Add Data</button>
          <button onclick="history.back()" class="back-btn">Back</button>
        </div>
    </div>
    </form>
  </div>
</div>

