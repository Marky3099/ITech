<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/main.min.css')?>">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">


<div class="body-content">
  <div class="col-sm-3">
    <h2 id="calendar-text"><b>Calendar</b></h2>
    
   <!-- <div class="tsk2">
        
   </div> -->
 </div>
 <div class="legend col-md-12 col-sm-1">
  <h3 id="legend-text">Legend:</h3>
  
  <ul><b>
    <?php foreach ($servName as $s): ?>
      <li style="background-color:<?=$s['serv_color'];?>;"><?=$s['serv_name'];?></li>
    <?php endforeach ?>
  </ul>
</div>
<div id='calendar' class="col-lg-12 col-md-10" style="width:100%;"></div>
<div id='datepicker'></div>
</div>
</div>
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
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="time">Time</label><br>
            <input type="time" name="time" id="time" value="00:00:00">
          </div>
          <div class="form-group col-md-6">
            <label for="repeatable">Repeat</label><br>
            <select id="repeatable" name = "repeatable">
              <option value="None">None</option>
              <option value="Weekly">Weekly</option>
              <option value="Monthly">Monthly</option>
            </select>
          </div>
        </div>
        <h3>Client Details:</h3>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="area">Branch Area</label><br>
            <select id="area" name="area" class="form-control">
              <?php foreach($area as $cl):  ?>
                <option value=<?php echo $cl['area']; ?>><?php echo $cl['area'];?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="client_id">Branch Name</label><br>
            <select id="client_id" name="client_id" class="form-control" required>

            </select>
          </div>
        </div>
        <div class="form-group">
          
          <label for="serv_id">Service</label><br>
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
        <h3>Aircon Details:</h3>
        <div class="form-row">
          <div class="form-group col-md-3">
            
            <label for="dbrand">Device Brand</label>
            <select id="device_brand" name="device_brand[]" class="form-control " data-id="0"required>
              <option value="">Select Brand</option>
              <?php foreach($device_brand as $d_b):  ?>
                <option value=<?php echo $d_b['device_brand']; ?>><?php echo $d_b['device_brand'];?></option>
              <?php endforeach; ?>
            </select>
          </div> 
          <div class="form-group col-md-3">
            
            <label for="aircont">Aircon Type</label>

            <select id="aircon_id_0" name="aircon_id[]" class="form-control aircon" required>
              <option value="">Select Type</option>
            </select>
          </div> 
          <div class="form-group col-md-3">
            
            <label for="fcunos">Fcuno</label>
            <select id="fcuno" name="fcuno0[]" class="selectpicker" data-width="100%" multiple data-selected-text-format="count > 3">
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
            <span id="add_aut" class="btn btn-primary"><i class="fa-solid fa-plus"></i></span>
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
<!-- update -->
<div class="modal fade" id="mymodal2" tabindex="-1" role="dialog">
  <div class="modal-dialog" id="dialog2" role="document">
    <div class="modal-content">
     
      <div class="modal-header">
        <h3 class="modal-title">Your Schedule</h3>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('/calendar/update');?>" method="POST"> 
        <div class="modal-body" id="adata">
          <input type="hidden" name="id" id="id" value="">
          <!-- <h5>Title</h5> -->
          <input class="form-control" type="hidden" name="title_update" id="title_update" placeholder="Title">
          
          <div class="form-row">
            <div class="form-group col-md-6">
             <label for="start_event_update">Date</label><br>
             <input type="date" name="start_event_update" id="start_event_update" disabled>
           </div>
           <div class="form-group col-md-6">
            <label for="time_update">Time</label><br>
            <input type="time" name="time_update" id="time_update" disabled>
          </div>
        </div>
        <h3>Client Details:</h3>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="area_update">Branch Area</label><br>
            <select id="area_update" name="area_update" class="form-control" disabled>
              
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="client_id_update">Branch Name</label><br>
            <select id="client_id_update" name="client_id_update" class="form-control" disabled>

            </select>
          </div>
        </div>
        
        <div class="form-group">
          
          <label for="serv_id_update">Service</label><br>
          <select class="form-control" id="serv_id_update" name="serv_id_update" disabled>
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

        <!-- =================================================== -->
        <div id="auth-rows-edit"></div>


        <!-- <div class="form-row" >
          <div class="form-group col-md-12" align="center" style="background-color:lightgreen;">
            <span id="add_aut_update" class="btn btn-primary"><i class="fa-solid fa-plus"></i></span>
          </div> 
        </div> -->

        <div class="form-group">
          
          <label for="emp_id_update">Employee</label><br>
          <select id="emp_id_update" name="emp_id_update[]" class="form-control selectpicker" multiple data-selected-text-format="count > 8" disabled>
            <!--  -->
          </select>
        </div> 
      </div>
      <div class="modal-footer">
        <div class="form-group">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
<script src = "https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>  
<!-- <script src = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>   -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
<!--  -->

<!-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js"></script> -->
<script src="<?=base_url("assets/js/main.min.js")?>"></script>



<script type="text/javascript">
// Calendar Variables--------------------

var event = <?php echo json_encode($event); ?>;

var areas = <?php echo json_encode($area); ?>;
var c_area = <?php echo json_encode($client_area2); ?> ;

var emp_all = <?php echo json_encode($emp); ?>;

var areas1 = <?php echo json_encode($client_area); ?> ;
var airconD = <?php echo json_encode($client_area); ?> ;
var distinct = <?php echo json_encode($distinct); ?> ;
var distinctEvent = <?php echo json_encode($distinct_event); ?> ;
var deviceBrand = <?php echo json_encode($device_brand); ?> ;
 
 console.log(distinct);
  console.log(deviceBrand);


var count = 1;
var count_update = 1;

  // console.log(event);
  $("#add_aut").click(function(e){
    var html3 = `<div class="form-row" id="row">
    <div class="form-group col-md-3">
    
    <label for="dbrand">Device Brand</label>
    <select id="device_brand" name="device_brand[]" class="form-control " data-id="`+count+`"required>
    <option value="0">Select Brand</option>
    <?php foreach($device_brand as $d_b):  ?>
      <option value=<?php echo $d_b['device_brand']; ?>><?php echo $d_b['device_brand'];?></option>
    <?php endforeach; ?>
    </select>
    </div> 
    <div class="form-group col-md-3">
    
    <label for="aircont">Aircon Type</label>
    <select id="aircon_id_`+count+`" name="aircon_id[]" class="form-control aircon" required>
    <option value="0">Select Type</option>
    </select>
    </div> 
    <div class="form-group col-md-3">
    
    <label for="fcunos">Fcuno</label>
    <select id="fcuno" name="fcuno`+count+`[]" class="selectpicker" data-width="100%" multiple data-selected-text-format="count > 2">
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
    
    <label for="dbrand">Device Brand</label>
    <select id="device_brand_update" name="device_brand[]" class="form-control " data-id="`+count_update+`"required>
    <option value="0">Select Brand</option>
    <?php foreach($device_brand as $d_b):  ?>
      <option value=<?php echo $d_b['device_brand']; ?>><?php echo $d_b['device_brand'];?></option>
    <?php endforeach; ?>
    </select>
    </div> 
    <div class="form-group col-md-3">
    
    <label for="aircont">Aircon Type</label>
    <select id="aircon_update_id_`+count_update+`" name="aircon_update_id[]" class="form-control aircon" data-id="`+count_update+`" required>
    <option value="0">Select Type</option>
    </select>
    </div> 

    <div class="form-group col-md-3">
    
    <label for="fcunos">Fcuno</label>
    <select id="fcuno_update_`+count_update+`"  class="selectpicker" data-width="100%" multiple data-selected-text-format="count > 2">
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
      url: 'http://localhost/tsms/aircon/brand/'+category_id,
      method:"GET",
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
    alert(aircon+' '+category_id);
    $.ajax({
      url: 'http://localhost/tsms/aircon/brand/'+category_id,
      method:"GET",
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
    alert(aircon_id);
   
  });

  $('#mymodal .selectpicker').selectpicker();
      </script>
      <script type="text/javascript" src="<?=base_url('assets/js/empCalendar.js')?>"></script>

      </html>