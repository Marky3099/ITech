
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/select2.css');?>">
  
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/main.min.css')?>">

<body>
  <div class="body-content">
    <div class="col-sm-3">
      <h2 id="calendar-text"><b>Calendar</b></h2>
    <div class="tsk">
        <a href="<?= base_url('calendar/events') ?>" class="btn" >Tasks</a>
   </div>
   <div class="tsk2">
        <a href="<?= base_url('/aircon');?>" class="btn" >Aircon</a>
   </div>
 </div>
   <div class="legend col-lg-12">
  <h3 id="legend-text">Legend:</h3>
  
  <ul><b>
    <?php foreach ($serv as $s): ?>
      <li style="background-color:<?=$s['serv_color'];?>;"><?=$s['serv_name'];?></li>
    <?php endforeach ?>
  </ul>
</div>
<div id='calendar' class="col-lg-12 col-md-10" style="width:100%;"></div>
 <div id='datepicker'></div>
</div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment-with-locales.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.0.1/fullcalendar.js"></script>


<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {

  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    handleWindowResize: false,
    defaultDate: '',
    selectable: true,   
    // editable: true,
    selectHelper:true,
    responsive: {
      medium: {
          controls: ['calendar'],
          display: 'bottom',
          touchUi: true
        }
    },
    headerToolbar: {
      left: 'prev,next',
      center: 'title',
      right: 'today',
    },
    events: <?php echo json_encode($event); ?>,
    dateClick: function(info) {
    // alert('Date: ' + info.dateStr);
     var myModal = new bootstrap.Modal(document.getElementById('mymodal'));
     var ad = document.getElementById('start_event');
     ad.value = info.dateStr;
     myModal.show();
    },
    eventClick: function(info) {
     var myModal = new bootstrap.Modal(document.getElementById('mymodal2'));
     var tt = document.getElementById('start_event');
     // var i = document.getElementById('time');
     var ad = document.getElementById('id');
    
     var t = document.getElementById('title_update');
     var ti = document.getElementById('time_update');
     var s = document.getElementById('serv_id_update');
     var a = document.getElementById('aircon_id_update');
     var q = document.getElementById('quantity_update');
    var r = document.getElementById('start_event_update');


      // select cliend and branch
      var s1 = document.getElementById('area_update');
      var s2 = document.getElementById('client_id_update');
      s1.innerHTML='';
      s2.innerHTML='';
      var areas = <?php echo json_encode($area); ?>;
      var c_area = <?php echo json_encode($client_area2); ?> ;
      var int_index_area = 0;
      var count = 0;

      areas.map((one_by_one_area)=>{
         var opt_one = document.createElement('option');
          opt_one.value = one_by_one_area.area;
          opt_one.innerHTML = one_by_one_area.area;
          s1.appendChild(opt_one);
          if (one_by_one_area.area == info.event.extendedProps.area ) {
            s1.value = one_by_one_area.area;
            int_index_area = count;
          }
          count +=1;
      });
    

     c_area.forEach((one, index_here)=>{

        

        if (int_index_area == index_here) {


          one.forEach((value, index)=>{

            var opt_client = document.createElement('option');
                      opt_client.value = value.client_id;
                      opt_client.innerHTML = value.client_branch;
                      s2.append(opt_client);

                      if (value.client_branch == info.event.extendedProps.client_branch ) {
                        s2.value = value.client_id;
                      }
          })

        }
         
      });
      s2.value = info.event.extendedProps.client_id;
      // -------------------------------------------------------------------------
      // select brand and aircon type
      var s3 = document.getElementById('device_brand_update');
      var s4 = document.getElementById('aircon_id_update');
      s3.innerHTML='';
      s4.innerHTML='';
      var brand = <?php echo json_encode($device_brand); ?>;
      var dev_brand = <?php echo json_encode($brand2); ?> ;
      var int_index_area1 = 0;
      var count1 = 0;

      brand.map((one_by_one_area)=>{
        console.log(one_by_one_area);
         var opt_one = document.createElement('option');
          opt_one.value = one_by_one_area.device_brand;
          opt_one.innerHTML = one_by_one_area.device_brand;
          s3.appendChild(opt_one);

          if (one_by_one_area.device_brand == info.event.extendedProps.device_brand ) {
            s3.value = one_by_one_area.device_brand;
            int_index_area1 = count1;
          }
          count1 +=1;
      });

      
     dev_brand.forEach((ones, index_here1)=>{

        if (int_index_area1 == index_here1) {

          ones.forEach((value, index)=>{

            var opt_client1 = document.createElement('option');
                      opt_client1.value = value.aircon_id;
                      opt_client1.innerHTML = value.aircon_type;
                      s4.append(opt_client1);

                      if (value.aircon_type == info.event.extendedProps.aircon_type ) {
                        s4.value = value.aircon_id;
                      }
          })

        }
         
      });
      s4.value = info.event.extendedProps.aircon_id;
      tt.value = info.event.start_event;
      ad.value = info.event.id;
      r.value = new Date(info.event.start).toLocaleDateString("fr-CA");
      t.value = info.event.title;
      ti.value = info.event.extendedProps.time;
     
      s.value = info.event.extendedProps.serv_id;
      a.value = info.event.extendedProps.aircon_id;
      q.value = info.event.extendedProps.quantity;


// ---------------------------------------------------------------------
       document.getElementById('emp_id_update').innerHTML='';

      var arr = info.event.extendedProps.emp_array.split(',');



       
      var emp_all = <?php echo json_encode($emp); ?>;
      emp_all.map((all_emp)=>{
        let i = 0;
         while(arr) {
             if(parseInt(arr[i]) == all_emp.emp_id){
              $("#emp_id_update").append(`
                  <option value="`+ all_emp.emp_id+`" selected>`+all_emp.emp_name+`</option>`
                );
              break;
             }

             if (emp_all.length == i) {
              $("#emp_id_update").append(`
                  <option value="`+ all_emp.emp_id+`">`+all_emp.emp_name+`</option>`
                );
              break;
             }
            
            i++;
          }

      });

      $('#emp_id_update').select2({
        dropdownParent: $('#mymodal2')
      });

     // myModal.show();
// ---------------------------------------------------------------------------
    document.getElementById('fcuno_update').innerHTML='';

      var arr1 = info.event.extendedProps.fcu_array.split(',');

      var fcu_all = <?php echo json_encode($fcu_no); ?>;
      fcu_all.map((all_fcu)=>{
        let a = 0;
         while(arr1) {
             if(parseInt(arr1[a]) == all_fcu.fcuno){
              $("#fcuno_update").append(`
                  <option value="`+ all_fcu.fcuno+`" selected>`+all_fcu.fcu+`</option>`
                );
              break;
             }

             if (fcu_all.length == a) {
              $("#fcuno_update").append(`
                  <option value="`+ all_fcu.fcuno+`">`+all_fcu.fcu+`</option>`
                );
              break;
             }
            
            a++;
          }

      });

      $('#fcuno_update').select2({
        dropdownParent: $('#mymodal2')
      });
     myModal.show();

    // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
    // alert('View: ' + info.view.type);
    },
  });



  calendar.render();
});
</script>
<!-- insert -->
<div id="mymodal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document" id="dialog">
    <div class="modal-content">
     <form action="<?= base_url('/calendar/insert');?>" method="POST"> 
      <div class="modal-header">
        <h4 class="modal-title">Add Schedule</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="adata">

            <input type="hidden" name="start_event" id="start_event" value="">
          <div class="form-group">
            <input class="form-control" type="hidden" name="title" id="title" placeholder="Title">
          </div>
          <div class="form-group">
            <h5>Time</h5>
            <input type="time" name="time" id="time" value="00:00:00">
          </div>
          <div class="form-group">
            <h5>Repeat</h5>
            <select id="repeatable" name = "repeatable">
              <option value="None">None</option>
              <option value="Weekly">Weekly</option>
              <option value="Monthly">Monthly</option>
            </select>
          </div>
          <div class="form-group">
            
            <h3>Client Details:</h3>
            <h5 id="area1">Branch Area</h5>
            <h5 id="branch1">Branch Name</h5>
            <!-- Branch Area -->
            <select id="area" name="area" class="form-control">
              <?php foreach($area as $cl):  ?>
                  <option value=<?php echo $cl['area']; ?>><?php echo $cl['area'];?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <!-- Branch Name -->
            <select id="client_id" name="client_id" class="form-control" required>

            </select>
          </div>
          <div class="form-group">
            
            <h5>Service</h5>
            <select id="serv_id" name="serv_id" class="form-control" required>

              <?php foreach($serv as $ser):  ?>
                  <option value=<?php echo $ser['serv_id']; ?>><?php echo $ser['serv_name'];?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
           
            <h3>Aircon Details:</h3>
            <h5 id="dbrand">Device Brand</h5>
            <h5 id="atype">Aircon Type</h5>
            <h5 id= "fcu">FCU No.</h5>
            <h5 id="qty">Qty</h5>
            <!-- Device Brand -->
            <select id="device_brand" name="device_brand" class="form-control" required>
              <?php foreach($device_brand as $d_b):  ?>
                  <option value=<?php echo $d_b['device_brand']; ?>><?php echo $d_b['device_brand'];?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <!-- Aircon Type -->
            <select id="aircon_id" name="aircon_id" class="form-control" required>

            </select>
          </div>
          <div class="form-group">
            <!-- FCU -->
            <select id="fcuno" name="fcuno[]" class="form-control" multiple="multiple" required>
               <?php foreach($fcu_no as $f):  ?>
                  <option value="<?php echo $f['fcuno']; ?>"><p id="s2option"><?php echo $f['fcu'];?></p></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <!-- Quantity -->
            <input type="number" name="quantity" id="quantity" min="1" value="1" required>
          </div>
          
         <div class="form-group">
          
            <h5>Employee</h5>
            <select id="emp_id" name="emp_id[]" class="form-control" multiple="multiple" style="width: 400px;" required>
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
<!-- update -->
<div class="modal" id="mymodal2" tabindex="-1" role="dialog">
  <div class="modal-dialog" id="dialog2" role="document">
    <div class="modal-content">
     
      <div class="modal-header">
        <h3 class="modal-title">Edit Schedule</h3>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('/calendar/update');?>" method="POST"> 
      <div class="modal-body" id="adata">
             <input type="hidden" name="id" id="id" value="">
          <div class="form-group">
             <h5>Reschedule</h5>
            <input type="date" name="start_event_update" id="start_event_update" >
          </div>
          <div class="form-group">
            
            <!-- <h5>Title</h5> -->
            <input class="form-control" type="hidden" name="title_update" id="title_update" placeholder="Title">
          </div>
          <div class="form-group">
            <h5>Time</h5>
            <input type="time" name="time_update" id="time_update">
          </div>
           <div class="form-group">
            
            <!-- ----------------------------------------------------- -->
          <h3>Client Details: </h3>
           <h5 id="area1">Branch Area</h5>
            <h5 id="branch1">Branch Name</h5>
            <select id="area_update" name="area_update" class="form-control" >
              
            </select>
          </div>

          <div class="form-group">
           
            <select class="form-control" id="client_id_update" name="client_id_update">
          
            </select>
          </div>
          <!-- ----------------------------------------------------- -->
          <div class="form-group">
            
            <h5>Service</h5>
            <select class="form-control" id="serv_id_update" name="serv_id_update"style="width: 120px;">
              <?php foreach($serv as $ser):  ?>
                  <option value=<?php echo $ser['serv_id']; ?>><?php echo $ser['serv_name'];?></option>
              <?php endforeach; ?>
            </select>
          </div>
           <div class="form-group">
            
            <h3>Aircon Details:</h3>
           <h5 id="dbrand">Device Brand</h5>
            <h5 id="atype">Aircon Type</h5>
            <h5 id= "fcu">FCU No.</h5>
            <h5 id="qty">Qty</h5>
            <select id="device_brand_update" name="device_brand_update" class="form-control">
               <?php foreach($device_brand as $d_b):  ?>
                  <option value="<?php echo $d_b['device_brand']; ?>"><?php echo $d_b['device_brand'];?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
           
            <select class="form-control" id="aircon_id_update" name="aircon_id_update"  required>
          
            </select>
          </div>
          <div class="form-group">
            <!-- FCU -->
            <select id="fcuno_update" name="fcuno_update[]" class="form-control" multiple="multiple">
              
            </select>
          </div>
          <div class="form-group">
            
            <input type="number" name="quantity_update" id="quantity_update" min="1" >
          </div>
         
          <div class="form-group">
            
            <h5>Employee</h5>
            <select class="form-control" multiple="multiple" id="emp_id_update" name="emp_id_update[]" style="width:400px;">

            </select> 
          </div>
       </div>
      <div class="modal-footer">
        <div class="form-group">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        

        <button type="submit" name="update_sched" class="btn btn-success">Save changes</button>
      </div>
     </form>
    </div>
  </div>
</div>
</body>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<!-- Time Picker -->
<script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>  
<script src = "https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>  
<!-- <script src = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>   -->
<script src = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
<!--  -->

<!-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js"></script> -->
<script src="<?=base_url("assets/js/main.min.js")?>"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
  


      // console.log(areas);
    $('#emp_id').select2({
        dropdownParent: $('#mymodal')
    });
    $('#fcuno').select2({
        dropdownParent: $('#mymodal')
    });

    var areas = <?php echo json_encode($client_area); ?> ;
          $.each(areas[0], function(key, v) {
          // alert(value.client_id+" "+value.client_branch);
           // console.log(v);
           $.each(v, function(key, value) {
          $("#client_id").append('<option value='+value.client_id+'>'+value.client_branch+'</option>');
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

</html>