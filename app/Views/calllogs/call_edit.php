<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/select2.css');?>">
<div class="body-content">
  <div class="edit-form">
    <form method="post" id="update_user" name="update_user" 
    action="<?= base_url('/calllogs/update') ?>">
      <input type="hidden" name="cl_id" id="id" value="<?php echo $cl_obj['cl_id']; ?>">
      <h1>Edit Log Information</h1>
      <div class="form-content">

      <div class="form-group">
        <label id="label1">Date</label>
        <input type="date" name="date" class="form-control" value="<?php echo $cl_obj['date']; ?>">
      </div>

      <div class="form-group">
        <label>Branch Area</label>
        <select id="area_update" name="area_update" class="form-control" >
          <?php foreach($area as $a):  ?>
            <option value="<?php echo $a['area'];?>"<?php if($a['area'] == $cl_views['area']) echo 'selected="selected"';?>><?php echo $a['area'];?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label>Branch Name</label>
        <select class="form-control" id="client_id_update" name="client_id_update">
          
            </select>
      </div>

      <div class="form-group">
        <label>Caller</label>
        <input type="text" name="caller" class="form-control" value="<?php echo $cl_obj['caller']; ?>">
      </div>

      <div class="form-group">
        <label>Particulars</label>
        <input type="text" name="particulars" class="form-control" size="50" value="<?php echo $cl_obj['particulars']; ?>">
      </div>

      <div class="form-group">
        <label>Device Brand</label>
        <select id="device_brand_update" name="device_brand_update" class="form-control">
               <?php foreach($device_brand as $d_b):  ?>
                  <option value="<?php echo $d_b['device_brand']; ?>"<?php if($d_b['device_brand']==$cl_views['device_brand'])echo 'selected="selected"';?>><?php echo $d_b['device_brand'];?></option>
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
        <input type="text" name="qty" class="form-control" value="<?php echo $cl_obj['qty']; ?>">
      </div>

      <div class="form-group">
        <label>FCU Number</label>
        <select id="fcuno_update" name="fcuno_update[]" class="form-control" multiple="multiple" required>
              <?php foreach($fcu_no as $f):  ?>
                <?php foreach($fcu_views as $fv):  ?>
                  <option value="<?php echo $f['fcuno'];?>"<?php if($f['fcuno']==$fv['fcuno'])echo 'selected';?>><p id="s2option"><?php echo $f['fcu'];?></p></option>
                  <?php endforeach; ?>
              <?php endforeach; ?>
            </select>
      </div>

      <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control" value="<?php echo $cl_obj['status']; ?>">
          <option value="Pending">Pending</option>
          <option value="Done">Done</option>
        </select>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-success">Save Data</button>
      </div>
      <div class="form-group">
        <a href="<?= base_url('/calllogs');?>" class="btn btn-secondary back">Back</a>
      </div>
    </div>
    </form>
  </div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">

  $('#fcuno_update').select2();


    var areas = <?php echo json_encode($client_area); ?> ;
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
             
          $("#client_id_update").append('<option value='+value.client_id+'>'+value.client_branch+'</option>')
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
           console.log(v);
           $.each(v, function(key, value) {
          $("#aircon_id_update").append('<option value='+value.aircon_id+'>'+value.aircon_type+'</option>')
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

      
</script>