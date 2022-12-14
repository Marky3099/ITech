<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
<div class="body-content">
  <div class="edit-form">
    <form method="post" id="update_appoint" name="update_appoint" 
    action="<?=base_url("/appointment/update")?>">
    <input type="hidden" name="appt_id" id="id" value="<?php echo $appt['appt_id']; ?>">
    <h1>Edit Appointment</h1>
    <div class="form-content">

      <div class="form-group">
        <label id="label1">Date</label>
        <!-- <input type="date" name="appt_date" class="form-control" value="<?php echo $appt['appt_date']; ?>"> -->
        <input type="text" name="appt_date" id="appt_date" class="form-control datepicker datee" placeholder="mm-dd-yyyy" value="<?php echo $new_date; ?>" autocomplete="off" required>
      </div>
      <div class="form-group">
        <label id="label1">Time</label>
        <input type="time" name="appt_time" class="form-control" value="<?php echo $appt['appt_time']; ?>">
      </div>

      <div class="form-group">
        <label>Branch Area</label>
        <select id="area_update" name="area_update" class="form-control" >
          <?php foreach($area as $a):  ?>
            <option value="<?php echo $a['area'];?>"<?php if($a['area'] == $view_appoint['area']) echo 'selected="selected"';?>><?php echo $a['area'];?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label>Branch Name</label>
        <select class="form-control" id="client_id_update" name="client_id_update">
          
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
        <select id="device_brand_update" name="device_brand_update" class="form-control">
         <?php foreach($device_brand as $d_b):  ?>
          <option value="<?php echo $d_b['device_brand']; ?>"<?php if($d_b['device_brand']==$view_appoint['device_brand'])echo 'selected="selected"';?>><?php echo $d_b['device_brand'];?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="form-group">
      <label>Aircon Type</label>
      <select class="form-control" id="aircon_id_update" name="aircon_id_update"  required>
        
      </select>
    </div>

    <div class="form-group">
      <label>Quantity</label>
      <input type="number" name="qty" class="form-control" value="<?php echo $appt['qty']; ?>">
    </div>

    <div class="form-group">
      <label>FCU Number</label>
      <select id="fcuno_update" name="fcuno_update[]" class="form-control selectpicker" multiple="multiple" required>
        <?php foreach($fcu_no as $f):  ?>
          <?php foreach($fcu_views as $fv):  ?>
            <option value="<?php echo $f['fcuno'];?>"<?php if($f['fcuno']==$fv['fcuno'])echo 'selected';?>><p id="s2option"><?php echo $f['fcu'];?></p></option>
          <?php endforeach; ?>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-success">Update</button>
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
<script type="text/javascript">

  // $('#fcuno_update').select2();
  var areas = <?php echo json_encode($client_area); ?> ;
  var client_current_area = <?php echo json_encode($appt); ?> ;
      //     $.each(areas[0], function(key, v) {
      //     // alert(value.client_id+" "+value.client_branch);
      //      // console.log(v);
      //      $.each(v, function(key, value) {
      //     $("#client_id").append('<option value='+value.client_id+'>'+value.client_branch+'</option>');
      //   });
      // });



      
      $("#client_id_update").empty();
      var current_value = document.getElementById("area_update").selectedIndex;
      
      $.each(areas[current_value], function(key, v) {
          // alert(value.client_id+" "+value.client_branch);
          
          $.each(v, function(key, value) {
           
            if (client_current_area.client_id == value.client_id) {
              $("#client_id_update").append('<option value='+value.client_id+' selected>'+value.client_branch+'</option>')
              
            }else{
              $("#client_id_update").append('<option value='+value.client_id+'>'+value.client_branch+'</option>')
            }
          });
        });
      
      $("#area_update").change(function(){
        $("#client_id_update").empty();
        var current_value = document.getElementById("area_update").selectedIndex;

        $.each(areas[current_value], function(key, v) {
          // alert(value.client_id+" "+value.client_branch);
          
          $.each(v, function(key, value) {
           console.log(value.client_branch);
           $("#client_id_update").append('<option value='+value.client_id+'>'+value.client_branch+'</option>')
         });
        });
        // $("#area").append('<option value='+'>My option</option>');
      });


  // ---------------------------------------------
  var devbrand = <?php echo json_encode($brand); ?> ;

  $("#aircon_id_update").empty();
  var current_value = document.getElementById("device_brand_update").selectedIndex;
  $.each(devbrand[current_value], function(key, v) {
          // alert(value.client_id+" "+value.client_branch);
          
          $.each(v, function(key, value) {
            if (client_current_area.aircon_id == value.aircon_id) {
              $("#aircon_id_update").append('<option value='+value.aircon_id+' selected>'+value.aircon_type+'</option>')
            }else{
              $("#aircon_id_update").append('<option value='+value.aircon_id+'>'+value.aircon_type+'</option>')
            }
          });
        });

  $("#device_brand_update").change(function(){
    $("#aircon_id_update").empty();
    var current_value = document.getElementById("device_brand_update").selectedIndex;
    $.each(devbrand[current_value], function(key, v) {
          // alert(value.client_id+" "+value.client_branch);
          console.log(v);
          $.each(v, function(key, value) {
            $("#aircon_id_update").append('<option value='+value.aircon_id+'>'+value.aircon_type+'</option>')
          });
        });
        // $("#area").append('<option value='+'>My option</option>');
      });

  // ----------------------------------------
  // document.getElementById('fcuno_update').innerHTML='';

  //     var arr1 = info.event.extendedProps.fcu_array.split(',');

  //     var fcu_all = <?php echo json_encode($fcu_no); ?>;
  //     fcu_all.map((all_fcu)=>{
  //       let a = 0;
  //        while(arr1) {
  //            if(parseInt(arr1[a]) == all_fcu.fcuno){
  //             $("#fcuno_update").append(`
  //                 <option value="`+ all_fcu.fcuno+`" selected>`+all_fcu.fcu+`</option>`
  //               );
  //             break;
  //            }

  //            if (fcu_all.length == a) {
  //             $("#fcuno_update").append(`
  //                 <option value="`+ all_fcu.fcuno+`">`+all_fcu.fcu+`</option>`
  //               );
  //             break;
  //            }
  
  //           a++;
  //         }

  //     });
                      //dd-mm
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