<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
<div class="body-content">
  <div class="add-form"> 
    <form method="post" id="add_create" name="add_create" action="<?=base_url("/appointment/add")?>">
      
      <!--  -->
      
      <h1>Add Appointment</h1>
      <div class="form-content">
        <input type="hidden" name="bdo_id" value="<?=$_SESSION['user_id']?>">
        <div class="form-group">
          <label id="label1">Date</label>
          <!-- <input type="date" name="appt_date" class="form-control" required> -->
          <input type="text" name="appt_date" id="appt_date" class="form-control datepicker datee" placeholder="mm-dd-yyyy" autocomplete="off" required>
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

            <?php foreach($servName as $s):  ?>
              <optgroup label="<?= $s['serv_name']; ?>">
                <?php foreach($servType as $st):  ?>
                  <?php if($st['serv_name'] == $s['serv_name']):?>
                    <option value=<?= $st['serv_id'];?>><?= $st['serv_type'];?></option>
                  <?php endif;?>
                <?php endforeach; ?>
              </optgroup>
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
          <select id="fcuno" name="fcuno[]" class="form-control selectpicker" multiple="multiple">
           <?php foreach($fcu_no as $f):  ?>
            <option value="<?php echo $f['fcuno']; ?>"><p id="s2option"><?php echo $f['fcu'];?></p></option>
          <?php endforeach; ?>
        </select>
      </div>
      
      <div class="form-group">
        <button type="submit" class="btn btn-success">Submit</button>
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
<script type="text/javascript">
  
        // -----------------
        
        // var getUrl = window.location;
        // $('#fcuno').select2();
        $('#fcuno .selectpicker').selectpicker();
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


var disableDates = ["1-1","1-2","25-2","9-4","14-4","16-4","1-5","9-5","12-6","29-8","21-8","31-10","1-11","2-11","30-11","8-12","24-12","25-12","30-12","31-12"];
      
    $('.datepicker').datepicker({
        format: 'mm/dd/yyyy',
        beforeShowDay: function(date){
            dmy = date.getDate() + "-" + (date.getMonth() + 1);
            if(disableDates.indexOf(dmy) != -1 || date.getDay() == 0 || date.getDay() == 6){
                return false;
            }
            else{
                return true;
            }
        }
    });

      
    </script>
