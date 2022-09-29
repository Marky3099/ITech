<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<div class="body-content">
  <div class="add-form">
    <form method="post" id="add_client" name="add_client" 
    action="<?= base_url('client/add') ?>">
    <?php if($error) {?>
                  <div class='alert alert-danger mt-2' align="center">
                    <?= $error ?>
                  </div>
              <?php }?>
    
    <div class="form-box">
        <h3>Add Client</h3><br>
        <div class="user-box">
           <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
           <input type="text" name="area" placeholder="Branch Area" required>
        </div>

        <div class="user-box">
          <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
          <input type="text" name="client_branch" placeholder="Branch Name" required>
        </div>

        <div class="user-box">
          <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
          <input type="text" name="client_address" placeholder="Address">
        </div>

        <div class="user-box">
          <div class="icon-box"><i class="fas fa-phone"></i></div>
          <input type="tel" name="client_contact" pattern="[0-9]{11}" placeholder="09XXXXXXXXX - 11 digits only">
        </div>

        <div class="user-box">
          <div class="icon-box"><i class="fas fa-user-alt"></i></div>
          <input type="email" name="client_email" placeholder="E-mail">
        </div><br>
        
        <div class="container1">
          <button type="submit" class="btn btn-success">Submit</button>
          <a href='<?=base_url('/client')?>' class="back-btn">Back</a>
        </div>
    </div>

    </form>
  </div>
</div>  