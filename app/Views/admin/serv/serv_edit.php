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
   <div class="user-box">
      <label for="dbrand">Aircon Brand</label>
      <div class="select-dropdown">
          <select id="device_brand" name="device_brand" class="form-control" required>
            <option value="" selected disabled>Select Type</option>
          <?php foreach($device_brand as $d_b):  ?>
            <option value="<?php echo $d_b['device_brand']; ?>"<?php if($d_b['device_brand']==$airconSelected['device_brand'])echo 'selected="selected"';?>><?php echo $d_b['device_brand'];?></option>
          <?php endforeach; ?>
      </select>
      </div>
    </div> 
     <div class="user-box">
        <label for="aircont">Aircon Type</label>
        <div class="select-dropdown">
          <select id="aircon_id" name="aircon_id" class="form-control aircon" required>
        </select>
        </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
  var Url = '<?= base_url('/serv/aircon-type')?>';

   var devbrand = <?php echo json_encode($brand); ?> ;
   var servObj = <?php echo json_encode($Serv_obj); ?> ;


  $("#aircon_id").empty();
  var current_value = document.getElementById("device_brand").selectedIndex;
  // console.log(devbrand[current_value]);
  $.each(devbrand[current_value-1], function(key, v) {
          // alert(value.client_id+" "+value.client_branch);
          
          $.each(v, function(key, value) {
            if (servObj.aircon_id == value.aircon_id) {
              $("#aircon_id").append('<option value='+value.aircon_id+' selected>'+value.aircon_type+'</option>')
            }else{
              $("#aircon_id").append('<option value='+value.aircon_id+'>'+value.aircon_type+'</option>')
            }
          });
        });

  $("#device_brand").change(function(){
    $("#aircon_id").empty();
    var current_value = document.getElementById("device_brand").selectedIndex;
    $.each(devbrand[current_value], function(key, v) {
          // alert(value.client_id+" "+value.client_branch);
          console.log(v);
          $.each(v, function(key, value) {
            $("#aircon_id").append('<option value='+value.aircon_id+'>'+value.aircon_type+'</option>')
          });
        });
      });
</script>
<script src="<?=base_url('assets/js/onChangeAircon.js')?>"></script>

