<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div class="container">
  <div class="row">
    <div class="body-content" style="width: 100%">
      <div class="edit-form">
        <form method="post" id="update_appoint" name="update_appoint" action="<?=base_url("/appointment/update")?>">
          <input type="hidden" name="appt_id" id="id" value="<?php echo $appt['appt_id']; ?>">

          <div class="form-box col-12 col-lg-5 col-md-5 col-sm-12" id="appt-form" style="postion: absolute; top: 400px; padding: 35px;">
            <h3>Edit Appointment</h3>

            <div class="user-box">
              <label id="label1">Date</label>
              <label class="ttime">Time</label>
              <input type="text" name="appt_date" id="appt_date" class="datepicker dateee" placeholder="mm-dd-yyyy" value="<?php echo $new_date; ?>" autocomplete="off" required>
              <input type="time" name="appt_time" class="timee" value="<?php echo $appt['appt_time']; ?>">
            </div><br><br>

            <div class="user-box">
              <label>Branch Area</label>
              <label class="bname">Branch Name</label>
              <div class="select-dropdown" style="width: 41%;">
                <select id="area_update" name="area_update">
                <?php foreach($area as $a):  ?>
                  <option value="<?php echo $a['area'];?>"<?php if($a['area'] == $view_appoint['area']) echo 'selected="selected"';?>><?php echo $a['area'];?></option>
                <?php endforeach; ?>
                </select>
              </div>
              <div class="select-dropdown" id="cid">
                  <select id="client_id_update" name="client_id_update"></select>
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
                          <?php if($st['serv_id'] == $appt['serv_id']):?>
                            <option value=<?= $st['serv_id'];?> selected><?= $st['serv_type'];?></option>
                          <?php else:?>
                            <option value=<?= $st['serv_id'];?>><?= $st['serv_type'];?></option>
                          <?php endif;?>
                        <?php endif;?>
                      <?php endforeach; ?>
                    </optgroup>
                  <?php endforeach; ?>
              </select>
              </div>
            </div>


            <div class="crud-text m-2"><h5>Aircon Details:</h5></div>
            <div id="auth-rows-edit"></div>
              <!-- <div class="user-box addUpdateBtn">
                <span id="add_aut_update" class="btn btn-primary"><i class="fa-solid fa-plus"></i></span>
              </div>  -->
            <br>
            <div class="user-box">
              <label>Comments/Suggestions</label>
              <textarea name="comments" id="comments" rows="2" cols="40" ><?php echo htmlspecialchars($appt['comments']); ?></textarea>
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
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
var distinct = <?php echo json_encode($distinct); ?> ;
var distinctEvent = <?php echo json_encode($distinct_event); ?> ;
var deviceBrand = <?php echo json_encode($device_brand); ?> ;
var appt_fcu = <?php echo json_encode($appt_fcu); ?> ;
var fcu_select = <?php echo json_encode($fcu_select); ?> ;

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
  
                      //dd-mm
  var disableDates = ["1-1","1-2","25-2","9-4","14-4","16-4","1-5","9-5","12-6","29-8","21-8","31-10","1-11","2-11","30-11","8-12","24-12","25-12","30-12","31-12"];
      
    $('.datepicker').datepicker({
        format: 'mm/dd/yyyy',
        startDate: new Date(),
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

    $('#auth-rows-edit').html('');
    // console.log(distinctEvent);
     distinctEvent.forEach((disEvent, index)=>{
      console.log(appt_fcu.appt_id);
          var concut = '';
          // console.log(disEvent,distinct);
        distinct.forEach((dis, index)=>{
    if ( appt_fcu[0].appt_id == dis.appt_id &&  dis.appt_id == disEvent.appt_id) {
        
         concut = `<div class="form-row" id="row" style="background-color:lightblue;">
    <div class="user-box col-md-6">
    <label for="dbrand">Aircon Brand</label>
    <select id="device_brand_update" name="device_brand[]" class="form-control " data-id="`+dis.aircon_id+`"required>`;
      
      deviceBrand.forEach((dbrand, index)=>{
        if (dis.device_brand == dbrand.device_brand) {
          concut = concut + `<option value="`+dbrand.device_brand+`" selected>`+dbrand.device_brand+`</option>`;
        }else{
          concut = concut + `<option value="`+dbrand.device_brand+`">`+dbrand.device_brand+`</option>`;
        }
         
      });
        
    concut = concut + ` </select>
    </div> 
    <div class="user-box col-md-6">
    
    <label for="aircont">Aircon Type</label>
    <select id="aircon_update_id_`+dis.aircon_id+`" name="aircon_update_id[]" class="form-control aircon" data-id="`+dis.aircon_id+`" required>
    <option value="`+dis.aircon_id+`">`+dis.aircon_type+`</option>
    </select>
    </div>
    <div class="user-box col-md-6 fcuClass fcuAdded">
    
    <label for="fcunos">FCU No.</label>

    

    <select id="fcuno_update_`+dis.aircon_id+`" name="fcuno_update_`+dis.aircon_id+`[]" class="selectpicker rounded" data-width="100%" multiple data-selected-text-format="count > 2">
    <option value="1">FCU 1</option>
    <option value="2">FCU 2</option>
    <option value="3">FCU 3</option>
    <option value="4">FCU 4</option>
    <option value="5">FCU 5</option>
    <option value="6">FCU 6</option>
    <option value="7">FCU 7</option>
    <option value="8">FCU 8</option>
    <option value="9">FCU 9</option>
    <option value="10">FCU 10</option>
    </select>
    </div> 

    <div class="user-box col-md-4 qtyClass qtyAdded1">
    
    <label for="quantity">Quantity</label>
    <input type="number" class="form-control" name="quantity[]" id="quantity" min="1" value="`+dis.qty+`" required>
    </div> 
    <div class="user-box col-md-2 minusbtn1"><br>
    <span id="auth-del-edit" class="btn"><i class="fas fa-minus"></i></span>
    </div>
    </div>`;
    $('#auth-rows-edit').append(concut);
    }
    
          appt_fcu.forEach((fcuData, index)=>{
          if (disEvent.appt_id == dis.appt_id) {
            if (dis.appt_id == fcuData.appt_id && dis.aircon_id == fcuData.aircon_id) {
              


                for(let i=1;i<=10;i++){
                    if (fcuData.fcuno == i) {
                       
                       $("#fcuno_update_"+dis.aircon_id +" option[value='" + fcuData.fcuno + "']").prop("selected", true);
                      
                    }
                    
                
    
                
              } 
            }


          }
        });
          
         
          $('#auth-rows-edit').on('click', '#auth-del-edit', function(E){

            $(this).parents('#row').remove();

          });
          
        });
          


      });
     var devbrand = <?php echo json_encode($brand); ?> ;

  $("#aircon_id_update").empty();
  var current_value = document.getElementById("device_brand_update").selectedIndex;

  $.each(devbrand[current_value], function(key, v) {
          // alert(value.client_id+" "+value.client_branch);
          
          $.each(v, function(key, value) {
            $.each(fcu_select, function(key, fcuSelect) {

              if (fcuSelect.aircon_id == value.aircon_id) {
                console.log(value.aircon_id);
                $("#aircon_id_update").append('<option value='+value.aircon_id+' selected>'+value.aircon_type+'</option>')
              }else{
                console.log('flase');
                $("#aircon_id_update").append('<option value='+value.aircon_id+'>'+value.aircon_type+'</option>')
              }
            });
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

</script>