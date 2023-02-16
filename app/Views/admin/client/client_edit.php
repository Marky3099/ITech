<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div class="container" style="width: 100%">
  <div class="row">
    <div class="body-content" style="width: 100%">
      <div class="edit-form">
        <form method="post" id="update_client" name="update_client" action="<?= base_url('client/update') ?>">
          <input type="hidden" name="client_id" id="id" value="<?php echo $Client_obj['client_id']; ?>">
            <div class="form-box col-12 col-lg-5 col-md-5 col-sm-12" id="client-form" style="margin-top: 285px; padding: 35px;">
              <h3>Edit Client</h3><br>
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
              </div>

              <div class="user-box">
                <div class="icon-box"><i class="fas fa-user-alt"></i></div>
                <input type="text" name="code" value="<?php echo $Client_obj['code']; ?>" placeholder="Unique Code">
              </div><br>

              <div class="container1">
                <a href='<?=base_url('/client')?>' class="back-btn">Back</a>
                <button type="submit" class="btn btn-success">Update</button>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>