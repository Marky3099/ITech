<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/select2.css');?>">
<div class="body-content">
  <div class="add-form"> 
    <form method="post" id="add_create" name="add_create" action="<?=base_url("/appointment/add")?>">
      
    <!--  -->
             
    <h1>Add Appointment</h1>
    <div class="form-content">
      <div class="form-group">
        <label id="label1">Date</label>
        <input type="date" name="appt_date" class="form-control" required>
      </div>
      <div class="form-group">
        <label >Time</label>
        <input type="time" name="appt_time" class="form-control" value="00:00:00" required>
      </div>
     <div class="form-group">
        <label>Branch Area</label>
       <select id="area" name="area" class="form-control">
              <?php foreach($area as $cl):  ?>
                  <option value=<?php echo $cl['area']; ?>><?php echo $cl['area'];?></option>
              <?php endforeach; ?>
            </select>
      </div>

      <div class="form-group">
        <label>Branch Name</label>
        <select id="client_id" name="client_id" class="form-control" >

            </select>
      </div>
      <div class="form-group">
        <label>Service</label>
        <select id="serv_id" name="serv_id" class="form-control" required>

              <?php foreach($serv as $ser):  ?>
                  <option value=<?php echo $ser['serv_id']; ?>><?php echo $ser['serv_name'];?></option>
              <?php endforeach; ?>
            </select>
      </div>
      <div class="form-group">
        <label>Device Brand</label>
        <select id="device_brand" name="device_brand" class="form-control">
              <?php foreach($device_brand as $d_b):  ?>
                  <option value=<?php echo $d_b['device_brand']; ?>><?php echo $d_b['device_brand'];?></option>
              <?php endforeach; ?>
            </select>
      </div>

      <div class="form-group">
        <label>Aircon Type</label>
        <select id="aircon_id" name="aircon_id" class="form-control">

        </select>
      </div>

      <div class="form-group">
        <label>Quantity</label>
        <input type="number" name="qty" class="form-control" min="1" required>
      </div>

      <div class="form-group">
        <label>FCU Number</label>
        <select id="fcuno" name="fcuno[]" class="form-control" multiple="multiple">
               <?php foreach($fcu_no as $f):  ?>
                  <option value="<?php echo $f['fcuno']; ?>"><p id="s2option"><?php echo $f['fcu'];?></p></option>
              <?php endforeach; ?>
            </select>
      </div>
      
      <div class="form-group">
        <button type="submit" class="btn btn-success">Save</button>
      </div>
      <div class="form-group">
        <a href="<?= base_url('/appointment');?>" class="btn btn-secondary back">Back</a>
      </div>
    </div>
    </form>
  </div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
  
        // -----------------
        
        var getUrl = window.location;
        $('#fcuno').select2();
// ---------------------------------
  var areas = <?php echo json_encode($client_area); ?> 
          $.each(areas[0], function(key, v) {
          // alert(value.client_id+" "+value.client_branch);
           // console.log(v);
           $.each(v, function(key, value) {
          $("#client_id").append('<option value='+value.client_id+'>'+value.client_branch+'</option>');
        });
      });        
  $("#area").change(function(){
      $("#client_id").empty();
          var current_value = document.getElementById("area").selectedIndex;
          $.each(areas[current_value], function(key, v) {
            // alert(value.client_id+" "+value.client_branch);
             console.log(v);
             $.each(v, function(key, value) {
            $("#client_id").append('<option value='+value.client_id+'>'+value.client_branch+'</option>')
          });
        });
        // $("#area").append('<option value='+'>My option</option>');
    });

  // ------------------------------------------------
    var devbrand = <?php echo json_encode($brand); ?> ;
      // console.log(areas);
   

      $.each(devbrand[0], function(key, v) {
          // alert(value.client_id+" "+value.client_branch);
           // console.log(v);
           $.each(v, function(key, value) {
          $("#aircon_id").append('<option value='+value.aircon_id+'>'+value.aircon_type+'</option>');
          $("#aircon_id_update").append('<option value='+value.aircon_id+'>'+value.aircon_type+'</option>');
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
        // $("#area").append('<option value='+'>My option</option>');
    });


 
</script>
