<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<div class="body-content">
  <div class="edit-form">
    <form method="post" id="update_client" name="update_client" action="<?= base_url('client/update') ?>">
      <input type="hidden" name="client_id" id="id" value="<?php echo $Client_obj['client_id']; ?>">
    
    <div class="form-box">
      <h3>Edit Client Details</h3>
        <div class="user-box">
           <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
           <input type="text" name="area" value="<?php echo $Client_obj['area']; ?>" placeholder="Branch Area">
        </div>

        <div class="user-box">
          <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
          <input type="text" name="client_branch" value="<?php echo $Client_obj['client_branch']; ?>" placeholder="Branch Name">
        </div>

        <div class="user-box">
          <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
          <input type="text" name="client_address" value="<?php echo $Client_obj['client_address']; ?>" placeholder="Address">
        </div>

        <div class="user-box">
          <div class="icon-box"><i class="fas fa-phone"></i></div>
          <input type="tel" name="client_contact" pattern="[0-9]{11}" value="<?php echo $Client_obj['client_contact']; ?>" placeholder="09XXXXXXXXX - 11 digits only">
        </div>

        <div class="user-box">
          <div class="icon-box"><i class="fas fa-user-alt"></i></div>
          <input type="email" name="client_email" value="<?php echo $Client_obj['client_email']; ?>" placeholder="E-mail">
        </div><br>
        
        <div class="container1">
          <button type="submit" class="btn btn-success">Update</button>
          <a href='<?=base_url('/client')?>' class="back-btn">Back</a>
        </div>
    </div>
    </form>
  </div>
</div>

