<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
<div class="body-content">
  <div class="add-form"> 
    <form method="post" id="add_create" name="add_create" action="<?=base_url("/appointment/add")?>">
      
      <!--  -->
      
      
      <div class="form-box">
        <h3>Add Appointment</h3>
        <div class="user-box">
          <label id="label1">Date</label>
          <label class="ttime">Time</label>
          <input type="text" name="appt_date" id="appt_date" class="datepicker dateee" placeholder="mm-dd-yyyy" autocomplete="off" required>
          <input type="time" name="appt_time" class="timee" value="00:00:00" required>
        </div><br><br>

        <div class="user-box">
          <label>Branch Area</label>
          <label class="bname">Branch Name</label>
          <div class="select-dropdown" style="width: 41%;">
            <select id="area" name="area">
              <?php foreach($area as $cl):  ?>
                <option value=<?php echo $cl['area']; ?>><?php echo $cl['area'];?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="select-dropdown" id="cid">
             <select id="client_id" name="client_id"> </select>
          </div>
        </div>

        <div class="user-box">
          <label>Service</label>
          <div class="select-dropdown" style="width: 90%;">
            <select id="serv_id" name="serv_id" required>
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
        </div>

        <div class="user-box" style="margin-bottom: -30px">
          <label>Device Brand</label>
          <label class="bname">Aircon Type</label>
          <div class="select-dropdown" style="width: 40%;">
            <select id="device_brand" name="device_brand">
            <?php foreach($device_brand as $d_b):  ?>
              <option value=<?php echo $d_b['device_brand']; ?>><?php echo $d_b['device_brand'];?></option>
            <?php endforeach; ?>
          </select>
          </div>
           <div class="select-dropdown" style="width: 40%;" id="cid">
            <select id="aircon_id" name="aircon_id">
            </select>
          </div>
        </div>

        <div class="user-box">
          <input class="number" type="number" name="qty" placeholder="Quantity" min="1" required></input>
          <label class="fcunum">FCU Number</label>
          <select id="fcuno" name="fcuno[]" class="selectpicker" multiple data-selected-text-format="count > 3" required>
            <?php foreach($fcu_no as $f):  ?>
              <option value="<?php echo $f['fcuno']; ?>"><p id="s2option"><?php echo $f['fcu'];?></p></option>
            <?php endforeach; ?>
          </select>
        </div><br>

        <div class="container1">
          <button type="submit" class="btn btn-success">Submit</button>
          <a href="<?= base_url('/appointment');?>" class="back-btn">Back</a>
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
