<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<div class="body-content">
  <div class="add-form"> 
    <form method="post" id="add_create" name="add_create" 
    action="<?= base_url('serv/add') ?>">
    <?php if($error) {?>
      <div class='alert alert-danger mt-2' align="center">
        <?= $error ?>
      </div>
    <?php }?>
    
    <div class="form-box">
     <h3>Add Service</h3><br>
     <div class="user-box" id="ibserv1">
       <div class="icon-box"><i class="fas fa-wrench"></i></div>
       <input type="text" name="serv_name" placeholder="Service Name" required>
     </div>
     <div class="user-box" id="ibserv2">
       <div class="icon-box"><i class="fas fa-wrench"></i></div>
       <input type="text" name="serv_type" placeholder="Service Type" required>
     </div>
     <div class="user-box">
      <label for="dbrand">Aircon Brand</label>
      <div class="select-dropdown">
          <select id="device_brand" name="device_brand" class="form-control" required>
            <option value="" selected disabled>Select Type</option>
          <?php foreach($aircon as $d_b):  ?>
          <option value=<?php echo $d_b['device_brand']; ?>><?php echo $d_b['device_brand'];?></option>
          <?php endforeach; ?>
      </select>
      </div>
    </div> 
     <div class="user-box">
        <label for="aircont">Aircon Type</label>
        <div class="select-dropdown">
          <select id="aircon_id" name="aircon_id" class="form-control aircon" required>
          <option value="" selected disabled>Select Type</option>
        </select>
        </div>
      </div> 

     <div class="user-box" id="ibserv3">
      <div class="icon-box"><i class="fas fa-wrench"></i></div>
      <input type="text" name="serv_description" placeholder="Service Description" required>
    </div>

    <div class="user-box" id="ibserv4">
      <div class="icon-box"><i class="fas fa-tags"></i></div>
      <input type="number" name="price" placeholder="Price" required>
    </div>

    <div class="container" id="ibserv5">
      <input type="color" name="serv_color" id="color-picker" required>
      <label for="color-picker" id="colorlbl">Color</label>
    </div><br>
    
    <div class="container1">
      <button type="submit" class="btn btn-success">Submit</button>
      <a href='<?=base_url('/serv')?>' class="back-btn">Back</a>
    </div>
  </div>
</form>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
  var Url = '<?= base_url('/serv/aircon-type')?>';
</script>
<script src="<?=base_url('assets/js/onChangeAircon.js')?>"></script>


