
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/select2.css');?>">
  
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/main.min.css')?>">


  <div class="body-content">
    <div class="col-sm-3">
      <h2 id="calendar-text"><b>Calendar</b></h2>
    <div class="tsk">
        <a href="<?= base_url('calendar/events') ?>" class="btn" >Tasks</a><br>
   </div>
   <!-- <div class="tsk2">
        
   </div> -->
 </div>
   <div class="legend col-lg-12">
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment-with-locales.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.0.1/fullcalendar.js"></script>


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
// Calendar Variables--------------------

  var event = <?php echo json_encode($event); ?>;
  var areas = <?php echo json_encode($area); ?>;
  var c_area = <?php echo json_encode($client_area2); ?> ;
  var brand = <?php echo json_encode($device_brand); ?>;
  var dev_brand = <?php echo json_encode($brand2); ?> ;
  var emp_all = <?php echo json_encode($emp); ?>;
  var fcu_all = <?php echo json_encode($fcu_no); ?>;
// 

  var areas1 = <?php echo json_encode($client_area); ?> ;
  var devbrand = <?php echo json_encode($brand); ?> ;
</script>
<script type="text/javascript" src="<?=base_url('assets/js/calendar.js')?>"></script>

</html>