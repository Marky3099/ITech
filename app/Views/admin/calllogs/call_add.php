<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/select2.css')?>">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">


<div id="mymodal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document" id="dialog">
    <div class="modal-content">
     <form id="toCal" action="<?= base_url('/calllogs/add-to-calendar');?>" method="POST"> 
      <div class="modal-header">
        <h4 class="modal-title">Add Schedule</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="adata">
        <input type="hidden" name="caller" id="callerC" value="">
        <input type="hidden" name="particulars" id="particularsC" value="">
        <input type="hidden" name="start_event" id="start_event" value="">
        <div class="form-group">
          <input class="form-control" type="hidden" name="title" id="title" placeholder="Title">
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="time">Date</label><br>
            <input type="text" name="date" id="calDate">
          </div>
          <div class="form-group col-md-6">
            <label for="time">Time</label><br>
            <input type="time" name="time" id="time" value="00:00:00">
          </div>
        </div>
        <h3>Client Details:</h3>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="area">Branch Area</label><br>
            <input id="calArea" name="area" class="form-control" >
          </div>
          <div class="form-group col-md-6">
            <label for="client_id">Branch Name</label><br>
            <input type="hidden" id="client_id_modal" name="client_id_modal">
            <input id="calName" class="form-control" >
          </div>
        </div>
        <div class="form-group">
          
          <label for="serv_id">Service</label><br>
          <select name="serv_id" class="form-control" required>
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
        <h3>Aircon Details:</h3>
        <div class="form-row">
          <div class="form-group col-md-3">
            
            <label for="dbrand">Device Brand</label>
            <input id="calBrand" name="device_brand[]" class="form-control" >
          </div> 
          <div class="form-group col-md-3">
            
            <label for="aircont">Aircon Type</label>
            <input type="hidden" id="aircon_id_modal" name="aircon_id_modal" class="form-control" >
            <input id="calType" class="form-control aircon" >
          </div> 
          <div class="form-group col-md-3">
            
            <label for="fcunos">Fcuno</label>
            <select id="calFcu" name="fcuno[]" class="selectpicker" multiple data-width="100%">
             
            </select>
          </div> 
          <div class="form-group col-md-2">
            
            <label for="fcunos">Quantity</label>
            <input id="calQty" type="number" class="form-control" name="quantity" min="1" value="1" required>
          </div> 
        </div>
        <div id="auth-rows"></div>
        <div class="form-group">
          
          <label for="emp_id">Employee</label><br>
          <select id="emp_id" name="emp_id[]" class="form-control selectpicker" multiple data-selected-text-format="count > 8" required>
            <?php foreach($emp as $em):  ?>
              <option value=<?php echo $em['emp_id']; ?>><?php echo $em['emp_name'];?></option>
            <?php endforeach; ?>
          </select>
        </div> 


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
  </div>
</div>
</div>



<div class="body-content" style="height: 100%;">
  <div class="add-form"> 
    <form method="post" id="add_create" name="add_create" >
      <div class="form-box" style="height: 600px; top: 45%;">
        <h3>Add Log Information</h3>
        <div class="user-box">
          <label>Branch Area</label>
          <label class="tdate">Date</label><br>
          <input type="text" name="date" id="date" class="form-control datepicker datee" placeholder="mm-dd-yyyy" autocomplete="off" required>
          <div class="select-dropdown" style="width: 40%;">
            <select id="area" name="area">
              <?php foreach($area as $cl):  ?>
                <option value=<?php echo $cl['area']; ?>><?php echo $cl['area'];?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <label>Branch Name</label>
        <div class="select-dropdown">
          <select id="client_id" name="client_id"></select>
        </div>

        <div class="user-box">
          <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
          <input type="text" id="caller" name="caller" placeholder="Caller" required>
        </div>

        <div class="user-box">
          <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
          <input type="text" id="particulars" name="particulars" placeholder="Particulars" size="50" required>
        </div>
        
        <div class="user-box" style="height: 75px">
          <label>Device Brand</label>
          <label id="Atype">Aircon Type</label>
          <div class="select-dropdown" style="width: 40%; position: relative;">
            <select id="device_brand" name="device_brand">
              <?php foreach($device_brand as $d_b):  ?>
                <option value=<?php echo $d_b['device_brand']; ?>><?php echo $d_b['device_brand'];?></opti>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="select-dropdown" style="width: 40%; margin-left: 257px; top: -46px;">
              <select id="aircon_id" name="aircon_id">
              </select>
            </div>
          </div>

          <div class="user-box" style="margin-bottom: -10px;">
            <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
            <input type="number" id="qty" name="qty" placeholder="Quantity" min="1" value="1" required>
          </div>
          <div class="user-box" >
            <label>FCU Number</label>
            <select id="fcuno" name="fcuno[]" class="selectpicker" multiple data-selected-text-format="count > 3" required>
              <?php foreach($fcu_no as $f):  ?>
                <option value="<?php echo $f['fcuno']; ?>"><p id="s2option"><?php echo $f['fcu'];?></p></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="container1">
            <button type="button" id="sub" class="btn btn-success" data-toggle="modal" data-target="#schedModal">Submit</button>
            <a href='<?= base_url('/calllogs');?>' class="back-btn">Back</a>
          </div> 
        </div>
      </form>
    </div>
  </div>

  <div class="modal"  id="schedModal" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Schedule Task</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Schedule this task on Calendar?</p>
        </div>
        <div class="modal-footer">
          <button type="submit" id="submit1" class="btn btn-primary" data-dismiss="modal">Yes</button>
          <button type="submit" id="submit2" class="btn btn-secondary" data-dismiss="modal" >No</button>
        </div>
      </div>
    </div>
  </div> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
  <script type="text/javascript">
        // -----------------
        var getUrl = window.location;
        // $('#fcuno').select2();
        $('#fcuno .selectpicker').selectpicker();
        $('#calFcu .selectpicker').selectpicker();

        $("#submit1").click(function(e) {
          e.preventDefault();
          var form = $('#add_create').serializeArray();
          console.log(form);
          // $.ajax({
          //  type: "POST",
          //  url: "/tsms/calllogs/add",
          //    data: form, // serializes form input
          //  });
          // console.log(document.getElementById("date").value);
          // console.log(document.getElementById("area").value);
          // console.log(document.getElementById("client_id").value);
          // console.log(document.getElementById("device_brand").value);
          // console.log(document.getElementById("aircon_id").value);
          // console.log(document.getElementById("qty").value);console.log(document.getElementById("fcuno").options);

          // alert(document.getElementById("log_code").value);
          document.getElementById("calDate").value = document.getElementById("date").value;
          document.getElementById("callerC").value = document.getElementById("caller").value;
          document.getElementById("particularsC").value = document.getElementById("particulars").value;
          document.getElementById("calArea").value = document.getElementById("area").value;


          document.getElementById("client_id_modal").value = document.getElementById("client_id").value
         const bname = document.getElementById("calName");
         
         for (var option of document.getElementById('client_id').options)
            {
                if (option.selected) {
                   bname.value = option.innerHTML
                    
                }
            }
      
         document.getElementById("calBrand").value = document.getElementById("device_brand").value;
         document.getElementById("aircon_id_modal").value = document.getElementById("aircon_id").value
         const airc = document.getElementById("calType");
        
          for (var option of document.getElementById('aircon_id').options)
            {
                if (option.selected) {
                   airc.value = option.innerHTML
                    
                }
            }
          document.getElementById("calQty").value = document.getElementById("qty").value;
          const selectss = document.getElementById("calFcu");

           for (var option of document.getElementById('fcuno').options)
            {
                if (option.selected) {
                    var opt = document.createElement('option');
                    opt.selected = true;
                    opt.value = option.value;
                    opt.innerHTML = 'fCU '+option.value;

                    selectss.appendChild(opt);
                }
            }
         $("#calFcu").selectpicker("refresh");
          var myModal = new bootstrap.Modal(document.getElementById('mymodal'));
          var schedModal = new bootstrap.Modal(document.getElementById('schedModal'));
          myModal.show();
          
          // $.ajax({
          //  type: "POST",
          //  url: "/tsms/calllogs/add",
          //    data: form, // serializes form input
          //    success: function(data){
          //      window.location.href = '/tsms/calendar'; 
          //    }
          //  });
        });
        
        $("#submit2").click(function(e) {
          e.preventDefault();
          var form = $('#add_create').serializeArray(); 
          $.ajax({
           type: "POST",
           url: "/tsms/calllogs/add",
             data: form ,// serializes form input
             success: function(data){
               window.location.href = '/tsms/calllogs'; 
             }
           });
        });


// ---------------------------------
var areas = <?php echo json_encode($client_area); ?> ;
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

    var disableDates = ["9-11-2022", "14-11-2022", "15-11-2022","27-12-2022"];
      
    $('.datepicker').datepicker({
        format: 'mm/dd/yyyy',
        beforeShowDay: function(date){
            dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
            if(disableDates.indexOf(dmy) != -1 || date.getDay() == 0 || date.getDay() == 6){
                return false;
            }
            else{
                return true;
            }
        }
    });

    </script>

    
