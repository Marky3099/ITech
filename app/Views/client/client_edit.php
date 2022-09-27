<div class="body-content">
  <div class="edit-form">
    <form method="post" id="update_client" name="update_client" 
    action="<?= base_url('client/update') ?>">
      <input type="hidden" name="client_id" id="id" value="<?php echo $Client_obj['client_id']; ?>">
      <h1>Edit Client Details</h1>
      <div class="form-content long">
      <div class="form-group">
        <label id="label1">Branch Area</label>
        <input type="text" name="area" class="form-control" value="<?php echo $Client_obj['area']; ?>">
      </div>
      <div class="form-group">
        <label>Branch Name</label>
        <input type="text" name="client_branch" class="form-control" value="<?php echo $Client_obj['client_branch']; ?>">
      </div>

      <div class="form-group">
        <label>Address</label>
        <input type="text" name="client_address" class="form-control" value="<?php echo $Client_obj['client_address']; ?>">
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" name="client_email" class="form-control" value="<?php echo $Client_obj['client_email']; ?>">
      </div>

      <div class="form-group">
        <label>Contact Number</label>
        <input type="tel" name="client_contact" class="form-control" pattern="[0-9]{11}" value="<?php echo $Client_obj['client_contact']; ?>">
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
      <div class="form-group">
        <a href="<?= base_url('/client');?>" class="btn btn-secondary back">Back</a>
      </div>
    </div>
    </form>
  </div>
</div>
</div>

