<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/main.min.css')?>">
<link rel="stylesheet" href="<?= base_url('assets/css/style.css')?>">

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">


<div class="body-content">
  <div class="col-sm-12">
    <div class="crud-text"><h3>Calendar</h3></div>
    
      <div class="tsk">
        <a href="<?= base_url('calendar/events') ?>" class="btn" >Tasks</a>
        <a href="<?= base_url('/calendar/dates') ?>" class="btn" style="margin-left: 0.2rem;">Restrict Date</a><br>
      </div>
      
    <br><br>
   <div class="row justify-content-end">
    <div class="col-12 col-lg-4 col-md-4 col-sm-12">
    <div class="card legend-box" id="cal2">
    <div class="card-header">Legend</div>
    <div class="card-body">
      <ul class="legend-list">
        <?php foreach ($servName as $s): ?>
          <li ><i class="fas fa-circle" style="color: <?=$s['serv_color'];?>"></i><?=$s['serv_name'];?></li>
        <?php endforeach ?>
      </ul>
    </div>
    </div>
  </div>
</div>
  </div><br> 
 
<div id='calendar' class="col-lg-12 col-md-10" style="width:100%;"></div>
<div id='datepicker'></div>
</div>
</div>
<!-- insert -->
<div id="mymodal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document" id="dialog">
    <div class="modal-content">
     <form action="<?= base_url('/calendar/insert');?>" method="POST"> 
      <div class="modal-header headTask">
        <h4 class="modal-title addTask">Add Schedule</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="adata">

        <input type="hidden" name="start_event" id="start_event" value="">
        <input type="hidden" name="cl_id" id="cl_id" value="">
        <div class="swtch">
          <label class="add2callloglbl">Add to Call logs</label><br>
          <label class="switch">
          <input type="checkbox" id="checkLog" name="checkLog">
          <span class="slider round"></span>
        </label></div><br><br>
        <div class="form-group">
          <input class="form-control" type="hidden" name="title" id="title" placeholder="Title">
        </div>

        <div class="crud-text"><h5>Client Details:</h5></div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="time">Start Time</label><br>
            <input type="time" name="time" id="time" step="3600" required>
          </div>
          <div class="form-group col-md-4">
            <label for="time">End Time</label><br>
            <input type="time" name="end_time" id="end_time" step="3600" required>
          </div>
          <div class="form-group col-md-4">
            <label for="repeatable">Repeat</label><br>
            <div class="select-dropdown">
              <select id="repeatable" name = "repeatable">
              <option value="None">None</option>
              <optgroup label="Week">
                <option value="Weekly">Every Week</option>
                <option value="2Week">Every 2 Weeks</option>
                <option value="3Week">Every 3 Weeks</option>
              </optgroup>
              <optgroup label="Month">
                <option value="Monthly">Every Month</option>
                <option value="2Month">Every 2 Months</option>
                <option value="3Month">Every 3 Months</option>
              </optgroup>
              </select>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="area">Branch Area</label><br>
              <div class="select-dropdown">
                <select id="area" name="area" class="form-control">
                <?php foreach($area as $cl):  ?>
                  <option value=<?php echo $cl['area']; ?>><?php echo $cl['area'];?></option>
                <?php endforeach; ?>
                </select>
              </div>
          </div>
          <div class="form-group col-md-6">
            <label for="client_id">Branch Name</label><br>
            <div class="select-dropdown" id="Branchname">
              <select id="client_id" name="client_id" class="form-control" required>
              </select>
            </div>
          </div>
        </div>
        <div class="form-group" id="serv-form">
          <label class="serv_idlbl" for="serv_id">Service</label><br>
          <div class="select-dropdown" id="serv-select">
            <select id="serv_id" name="serv_id" class="form-control" required>
              <option selected disabled>Select Service</option>
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
        </div><br>
        <div class="crud-text"><h5>Aircon Details:</h5></div>
        <div class="form-row">
          <div class="form-group col-md-3">
            <label for="dbrand">Aircon Brand</label>
            <div class="select-dropdown">
                <select id="device_brand" name="device_brand[]" class="form-control " data-id="0"required>
                  <option value="" selected disabled>Select Type</option>
                <?php foreach($device_brand as $d_b):  ?>
                <option value=<?php echo $d_b['device_brand']; ?>><?php echo $d_b['device_brand'];?></option>
                <?php endforeach; ?>
            </select>
            </div>
          </div> 
          <div class="form-group col-md-3">
            <label for="aircont">Aircon Type</label>
            <div class="select-dropdown">
              <select id="aircon_id_0" name="aircon_id[]" class="form-control aircon" required>
              <option value="">Select Type</option>
            </select>
            </div>
          </div> 
          <div class="form-group col-md-3">
            
            <label for="fcunos">FCU No.</label>
            <select id="fcuno" name="fcuno0[]" class="selectpicker rounded border border-dark" data-width="87%" multiple data-selected-text-format="count > 3" required>
              <?php foreach($fcu_no as $f):  ?>
                <option value="<?php echo $f['fcuno']; ?>"><p id="s2option"><?php echo $f['fcu'];?></p></option>
              <?php endforeach; ?>
            </select>
          </div> 
          <div class="form-group col-md-2">
            
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" name="quantity[]" id="quantity" min="1" value="1" required>
          </div> 
          <div class="form-group col-md-1"><br>
            <span id="add_aut" class="btn btn-primary"><i class="fa-solid fa-plus"></i></span>
          </div>
        </div>
        <div id="auth-rows"></div>
        <div class="form-group">
          
          <label class="emp_idlbll" for="emp_id">Technician <i class="fa-regular fa-circle-question"><span class="infoEmp">Highlighted Technicians with expertise of the chosen task</span></i></label><br>
          <select id="emp_id" name="emp_id[]" class="form-control w-75 ml-5 selectpicker border border-dark" multiple data-selected-text-format="count > 8" required>
          </select>
        </div> 
        <div class="form-group">
          <label class="emp_idlbll" for="comments">Comments/Suggestions</label><br>
          <textarea name="comments" class="form-control w-75 ml-5 selectpicker border border-dark" cols="50" rows="4"></textarea>
        </div> 


      </div>
      <div class="modal-footer">
        <button type="button" class="btn py-2 btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btnn btn py-2 btn-primary">Save changes</button>
      </div>
    </form>
  </div>
</div>
</div>
<!-- update -->
<div class="modal fade" id="mymodal2" tabindex="-1" role="dialog">
  <div class="modal-dialog" id="dialog2" role="document">
    <div class="modal-content">
     
      <div class="modal-header">
        <h3 class="modal-title">Edit Schedule </h3>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="<?= base_url('/calendar/update');?>" method="POST"> 
        <div class="modal-body" id="adata">
          <input type="hidden" name="id" id="id" value="">

          <div class="crud-text"><h5>Client Details:</h5></div>
          <!-- <h5>Title</h5> -->
          <input type="hidden" name="title_update" id="title_update" placeholder="Title">
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="event_code">Task Code: </label>
              <input type="text" name="event_code" id="event_code" value="" disabled>
            </div>
            <div class="form-group col-md-4">
              <label for="log_code">Call Log Code: </label>
              <input type="text" name="log_code" id="log_code" value="" disabled>
            </div>
            <div class="form-group col-md-4">
              <label for="appt_code">Appt Code: </label>
              <input type="text" name="appt_code" id="appt_code" value="" disabled>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
             <label for="start_event_update">Reschedule</label><br>
             <input type="text" name="start_event_update" id="start_event_update" class="datepicker datee" placeholder="mm-dd-yyyy" autocomplete="off" required>
             <!-- <input type="text" name="date" id="date" > -->
           </div>
           <div class="form-group col-md-4">
            <label for="time_update">Start Time</label><br>
            <input type="time" name="time_update" id="time_update">
          </div>
          <div class="form-group col-md-4">
            <label for="time_update">End Time</label><br>
            <input type="time" name="end_time_update" id="end_time_update">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="area_update">Branch Area</label><br>
            <div class="select-dropdown">
              <select id="area_update" name="area_update">
            </select>
            </div>
          </div>
          <div class="form-group col-md-6">
            <label for="client_id_update">Branch Name</label><br>
            <div class="select-dropdown">
              <select id="client_id_update" name="client_id_update" class="form-control">
              </select>
            </div>
          </div>
        </div>
        
        <div class="form-group" id="serv-form">
          <label class="serv_id_updatelbl" for="serv_id_update">Service</label><br>
          <div class="select-dropdown" id="serv-select1">
            <select class="form-control" id="serv_id_update" name="serv_id_update">
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
        </div> <br>

        <div class="crud-text"><h5>Aircon Details:</h5></div>

        <!-- =================================================== -->
        <div id="auth-rows-edit"></div>


        <div class="form-row" >
          <div class="form-group mt-2 col-md-12" align="center">
            <span id="add_aut_update" class="btn btn-primary"><i class="fa-solid fa-plus"></i></span>
          </div> 
        </div>

        <div class="form-group">
          
          <label class="ml-5" for="emp_id_update">Technician</label><br>
          <select id="emp_id_update" name="emp_id_update[]" class="form-control w-75 ml-5 selectpicker border border-dark" multiple data-selected-text-format="count > 8">
            <!--  -->
          </select>
        </div> 
        <div class="form-group">
          <label class="emp_idlbll" for="comments">Comments/Suggestions</label><br>
          <textarea name="comments_update" id="comments_update" class="form-control w-75 ml-5 selectpicker border border-dark" cols="50" rows="4"></textarea>
        </div> 
      </div>
      <div class="modal-footer">
        <div class="form-group">
          <button type="button" class="btn py-2 btn-secondary" data-dismiss="modal">Close</button>
          

          <button type="submit" name="update_sched" class="btnn btn py-2 btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment-with-locales.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.0.1/fullcalendar.js"></script>




<!-- Time Picker -->
<script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>  
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>  
<!-- <script src = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>   -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
<!--  -->

<!-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js"></script> -->
<script src="<?=base_url("assets/js/main.min.js")?>"></script>



<script type="text/javascript">
// Calendar Variables--------------------

var event = <?php echo json_encode($event); ?>;
var disableDates = <?php echo json_encode($date); ?>;

var areas = <?php echo json_encode($area); ?>;
var c_area = <?php echo json_encode($client_area2); ?> ;

var emp_all = <?php echo json_encode($emp); ?>;

var areas1 = <?php echo json_encode($client_area); ?> ;
var airconD = <?php echo json_encode($client_area); ?> ;
var distinct = <?php echo json_encode($distinct); ?> ;
var distinctEvent = <?php echo json_encode($distinct_event); ?> ;
var deviceBrand = <?php echo json_encode($device_brand); ?> ;
 
var count = 1;
var count_update = 1;

  // console.log(event);
  $("#add_aut").click(function(e){
    var html3 = `<div class="form-row" id="row">
    <div class="form-group col-md-3">
    
    <label for="dbrand">Aircon Brand</label>
    <div class="select-dropdown">
      <select id="device_brand" name="device_brand[]" class="form-control " data-id="`+count+`"required>
      <option value="0">Select Brand</option>
      <?php foreach($device_brand as $d_b):  ?>
      <option value=<?php echo $d_b['device_brand']; ?>><?php echo $d_b['device_brand'];?></option>
      <?php endforeach; ?>
      </select>
    </div>
    </div> 
    <div class="form-group col-md-3">
    
    <label for="aircont">Aircon Type</label>
    <div class="select-dropdown">
    <select id="aircon_id_`+count+`" name="aircon_id[]" class="form-control aircon" required>
    <option value="0">Select Type</option>
    </select>
    </div>
    </div> 
    <div class="form-group col-md-3">
    
    <label for="fcunos">FCU No.</label>
    <select id="fcuno" name="fcuno`+count+`[]" class="selectpicker rounded border border-dark" data-width="87%" multiple data-selected-text-format="count > 2">
    <?php foreach($fcu_no as $f):  ?>
      <option value="<?php echo $f['fcuno']; ?>"><p id="s2option"><?php echo $f['fcu'];?></p></option>
    <?php endforeach; ?>
    </select>
    </div> 
    <div class="form-group col-md-2">
    
    <label for="fcunos">Quantity</label>
    <input type="number" class="form-control" name="quantity[]" id="quantity" min="1" value="1" required>
    </div> 
    <div class="form-group col-md-1"><br>
    <span id="auth-del" class="btn"><i class="fas fa-minus"></i></span>
    </div>
    </div>`;



    
    count++;
    $('#auth-rows').append(html3);
    
    $('#mymodal .selectpicker').selectpicker();

  });

// ------------------------------------

   $("#add_aut_update").click(function(e){
    var html3 = `<div class="form-row" id="row" style="background-color:lightgreen;">
    <div class="form-group col-md-3">
    
    <label for="dbrand">Aircon Brand</label>
    <div class="select-dropdown">
    <select id="device_brand_update" name="device_brand[]" class="form-control " data-id="`+count_update+`"required>
    <option value="0">Select Brand</option>
    <?php foreach($device_brand as $d_b):  ?>
      <option value=<?php echo $d_b['device_brand']; ?>><?php echo $d_b['device_brand'];?></option>
    <?php endforeach; ?>
    </select>
    </div>
    </div> 
    <div class="form-group col-md-3">
    
    <label for="aircont">Aircon Type</label>
    <div class="select-dropdown">
    <select id="aircon_update_id_`+count_update+`" name="aircon_update_id[]" class="form-control aircon" data-id="`+count_update+`" required>
    <option value="0">Select Type</option>
    </select>
    </div>
    </div> 

    <div class="form-group col-md-3">
    
    <label for="fcunos">FCU No.</label>
    <select id="fcuno_update_`+count_update+`"  class="selectpicker rounded border border-dark" data-width="100%" multiple data-selected-text-format="count > 2">
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

    <div class="form-group col-md-2">
    
    <label for="fcunos">Quantity</label>
    <input type="number" class="form-control" name="quantity[]" id="quantity" min="1" value="1" required>
    </div> 
    <div class="form-group col-md-1"><br>
    <span id="auth-del-edit" class="btn"><i class="fas fa-minus"></i></span>
    </div>
    </div>`;



    count_update++;
    $('#auth-rows-edit').append(html3);
    
    $('#mymodal2 .selectpicker').selectpicker();

  });



  $('#auth-rows').on('click', '#auth-del', function(E){

    $(this).parents('#row').remove();

  });
  $('#auth-rows-edit').on('click', '#auth-del-edit', function(E){

    $(this).parents('#row').remove();

  });

  $(document).on('change', '#device_brand', function(){
    var category_id = $(this).val();
    var aircon = $(this).data('id');
  
    $.ajax({
      url: '<?= base_url("/aircon/brand/")?>',
      method:"GET",
      data:{
      'brand': category_id
      },
      success:function(data)
      {
        var res = JSON.parse(data);
        console.log(res.options);
        var html = '';
        html += res.options;
        $('#aircon_id_'+aircon).html(html);

      },
      error:function(e){
        console.log(e);
      }
    })
  });

  $(document).on('change', '#device_brand_update', function(){
    var category_id = $(this).val();
    var aircon = $(this).data('id');
    
    $.ajax({
      url: '<?= base_url("/aircon/brand/")?>',
      method:"GET",
      data:{
      'brand': category_id
      },
      success:function(data)
      {
        var res = JSON.parse(data);
        
        var html = '';
        html += res.options;
        $('#aircon_update_id_'+aircon).html(html);

      },
      error:function(e){
        console.log(e);
      }
    })
  });

  $(document).on('change','.aircon', function(){
    var aircon_id = $(this).val();
    var count_aircon = $(this).data('id');
    // document.getElementById('fcuno_update_'+aircon).id = 'fcuno_update_';
    $('#fcuno_update_'+count_aircon).attr('name','fcuno_update_'+aircon_id+'[]');
    
   
  });

  $('#mymodal .selectpicker').selectpicker();


  $('#checkLog').click(function(){
    if ($('#checkLog').is(":checked"))
    {
      $('.addTask').html("Add Schedule");
      $('.addTask').css('color','white');
      $('.headTask').css('background-color','green');
      $('#repeatable').prop('disabled', 'disabled');
    }else{
      $('.addTask').html("Add Schedule");
      $('.addTask').css('color','black');
      $('.headTask').css('background-color','white');
      $('#repeatable').prop('disabled', false);
    }
  });
      $('#serv_id').on('change',function(){
    var timeee = $('#end_time').val();
    var startDate = $('#start_event').val();
    var startTime = $('#time').val();
    var servId = $(this).val();
    // console.log(servName);
    $.ajax({
           method: "GET",
           url: '<?= base_url("/calendar/checkEmp")?>',
             data: {
                'start_event' : startDate,
                'time' : startTime,
                'end_time' : timeee,
                'serv_id': servId
             } ,// serializes form input
             success: function(data){
               
              $('#emp_id').empty();
              var availEmp = data.available_emp;

              var expertEmp = data.expertise;
              for (var i = 0; i < availEmp.length; i++) {
                $('#emp_id').append('<option id="'+availEmp[i].emp_id+'" value="'+availEmp[i].emp_id+'">'+availEmp[i].emp_name+'</option>')
                for (var j = 0; j < expertEmp.length; j++) {
                  if(availEmp[i].emp_id == expertEmp[j].emp_id){
                    $('#'+availEmp[i].emp_id).css('background-color','#7BCB76');
                  }
                }
              }
              $('#mymodal .selectpicker').selectpicker("refresh");

             }
           });

  });
  
      </script>
      <script type="text/javascript" src="<?=base_url('assets/js/calendar.js')?>"></script>

      </html>
