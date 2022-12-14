
<!-- <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
           <div class="col-md-6">
              <h6>Date:</h6>
              <hr>
              <h6>Time:</h6>
              <hr>
              <h6>Task Code:</h6>
              <hr>
              <h6>Log Code:</h6>
              <hr>
              <h6>Appt Code:</h6>
              <hr>
              <h6>Area:</h6>
              <hr>
              <h6>Client Branch:</h6>
              <hr>
              <h6>Service Name:</h6>
              <hr>
              <h6>Service Type:</h6>
              <hr>
              <h6>Device Brand:</h6>
              <hr>
              <h6>Aircon Type:</h6>
              <hr>
              <h6>FCU #:</h6>
              <hr>
              <h6>Quantity:</h6>
              <hr>
              <h6>Employee:</h6>
              <hr>
              <h6>Status:</h6>
           </div>
           <div class="col-md-6">
              <h6 id="modal_start_event"></h6>
              <hr>
              <h6 id="modal_time"></h6>
              <hr>
              <h6 id="modal_event_code"></h6>
              <hr>
              <h6 id="modal_log_code"></h6>
              <hr>
              <h6 id="modal_appt_code"></h6>
              <hr>
              <h6 id="modal_area"></h6>
              <hr>
              <h6 id="modal_branch"></h6>
              <hr>
              <h6 id="modal_serv_name"></h6>
              <hr>
              <h6 id="modal_serv_type"></h6>
              <hr>
              <h6 id="modal_dev_brand"></h6>
              <hr>
              <h6 id="modal_aircon_type"></h6>
              <hr>
              <h6 id="modal_fcu"></h6>
              <hr>
              <h6 id="modal_qty"></h6>
              <hr>
              <h6 id="modal_emp"></h6>
              <hr>
              <h6 id="modal_status"></h6>
           </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> -->


<div class="body-content">
   <div class="event-header">
      
     <h1><b>Scheduled Tasks</b></h1>

     <div class="tsk">
        <a href="<?= base_url('/calendar') ?>" class="btn" >Calendar</a>
        <a href="<?= base_url('/calendar/events/today') ?>" class="btn " >Daily</a>
        <a href="<?= base_url('/calendar/events/weekly') ?>" class="btn " >Weekly</a>
        <a href="<?= base_url('/calendar/events/monthly') ?>" class="btn " >Monthly</a>
     </div>
     
     <div class="card-body filter">
      <form action="<?= base_url('/calendar/events/filtered');?>" method="GET">
         
         <div class="row">
            <div class="col-md-4">
               <div class="form-group">
                  <label>Start Date:</label><br>
                  <input type="date" name="start_date" class="form-control" value="<?php if(isset($_GET['start_date'])){echo $_GET['start_date'];} ?>">
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label>To Date:</label><br>
                  <input type="date" name="to_date" class="form-control" value="<?php if(isset($_GET['to_date'])){echo $_GET['to_date'];} ?>">
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <button type="submit" class="btn btn-success" id="sub">Generate</button>
               </div>
               <div class="form-group">
                  <?php if(isset($_GET['start_date']) && isset($_GET['to_date'])): ?>
                  <a href="<?= base_url('/calendar/events/filtered/print/'.$_GET['start_date']."/".$_GET['to_date'])?>" target="_blank" class="btn btn-success" id="print">Print</a>
               <?php endif; ?>
            </div>
         </div>
      </div>
      
   </form>
</div>   
</div>
<div class="col-sm-12 mt-3 bg-light" style=" padding:10px;">
   <?php if($event): ?>
      <table class="table table-bordered table-hover" id="event-table">
        <thead>
           <tr>
              <th>Date</th>
              <th>Task Code</th>
              <th>Log Code</th>
              <th>Appt Code</th>
              <th>Time</th>
              <th>Area</th>
              <th>Client Branch</th>
              <th>Service Name</th>
              <th>Service Type</th>
              <th>Device Brand</th>
              <th>Aircon Type</th>
              <th>FCU No.</th>
              <th>Qty</th>
              <th>Employee</th>
              <th>Status</th>
              <th>Action</th>
           </tr>
        </thead>
        <tbody>
           
           <?php foreach($event as $dat):  ?>
              <tr>
               <td><?php echo date('m-d-Y',strtotime($dat->start_event)); ?></td>
               <td><?php echo $dat->event_code; ?></td>
               <?php if($dat->log_code != ""):?>
                  <td><?php echo $dat->log_code; ?></td>
               <?php else: ?>
                  <td>N/A</td>
               <?php endif;?>
               <?php if($dat->appt_code != ""):?>
                  <td><?php echo $dat->appt_code; ?></td>
               <?php else: ?>
                  <td>N/A</td>
               <?php endif;?>
               <td>
                  <?php if($dat->time == "00:00:00"): ?>
                     <?php echo "N/A"; ?>
                  <?php else:?>
                     <?php echo $dat->time; ?>
                  <?php endif;?>
               </td>
               <td><?php echo $dat->area; ?></td>
               <td><?php echo $dat->client_branch; ?></td>
               <td><?php echo $dat->serv_name; ?></td>
               <td><?php echo $dat->serv_type; ?></td>
               <td>
                  
                  <?php $current =''; ?>

                  <?php foreach($distinct as $data):  ?>
                     <?php if($dat->id ==  $data->id): ?>
                      <?php if($current !=  $data->device_brand):  ?>
                        <?php echo  $data->device_brand;  ?> <hr>
                        <?php $current =$data->device_brand; ?>
                     <?php endif;  ?>
                     <?php endif;  ?>
                 <?php endforeach; ?>

              </td>
              <td>
                  <?php $current_aircon_type =''; ?>
                  <?php foreach($distinct as $data):  ?>
                     <?php if($dat->id ==  $data->id): ?>
                      <?php if($current_aircon_type !=  $data->aircon_type):  ?>
                        <?php echo $data->aircon_type;  ?> <hr>
                        <?php $current_aircon_type =$data->aircon_type; ?>
                     <?php endif;  ?>
                     <?php endif;  ?>
                 <?php endforeach; ?>
           </td>
           <td>

                     <?php foreach($distinct_event as $dis_event):  ?>  
                        
                        <!--  -->
                        <?php foreach($distinct as $dis):  ?>
                           <?php $current_fcu =0; $concut = ''; ?> 
                           <?php foreach($dat->fcu_array as $fcu_data):  ?> 
                         

                           <?php if( (int) $dis_event->id == $dis->id):  ?>

                              <?php if( (int) $dis->id == $fcu_data->id):  ?>
                                 <?php if( (int) $dis->aircon_id == $fcu_data->aircon_id):  ?>

                                 <?php   $concut.= $fcu_data->fcu.' ' ?>

                              <?php endif;  ?> 
                              <?php endif;  ?> 
                           <?php endif;  ?>

                        <?php endforeach; ?>
                        <?php if( $concut != ''):  ?>
                        <?php echo  $concut;  ?> <hr> 
                         <?php endif;  ?>    
                       <?php endforeach; ?>
                        <!--  -->
                        
                 <?php endforeach; ?>

        </td> 
        <td>

        <?php $current =''; ?>
                  <?php foreach($distinct as $data):  ?>
                     <?php if($dat->id ==  $data->id): ?>
                      <?php if($current !=  $data->device_brand):  ?>
                        <?php echo  $data->quantity;  ?> <hr>
                        <?php $current =$data->device_brand; ?>
                     <?php endif;  ?>
                     <?php endif;  ?>
                 <?php endforeach; ?>
     </td> 
     <td>
      <?php $data = explode(',',$dat->emp_array);
      $count = 0;
      ?>
      <?php foreach($data as $emp):  ?>
         <?php if($count < (count($data) - 1) ):  ?>
            * <?php echo $emp; $count+=1; ?> <br>
         <?php endif;  ?>
      <?php endforeach; ?>
   </td> 
   <?php if($dat->status == 'Pending'):?>
     <td style="color:#4F6FA6;"><b>
      <?php echo $dat->status; ?>
   </b>
</td>
<?php else:?>
   <td><b>
      <?php echo $dat->status; ?>
   </b>
</td>
<?php endif;?>
<td>
 <!-- <a href="#" id="<?=$dat->id?>" class="btn btn-info btn-sm view">View</a> -->
 <a href="<?= base_url('/calendar/delete/'.$dat->id);?>" class="btn btn-danger btn-sm del">Delete</a>
</td>
</tr>
<?php endforeach; ?>

</tbody>
</table>
<?php else: ?>
   <h3 style="text-align:center;">Ooops.. No work Yet!</h3>
<?php endif; ?>
</div>
</div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
   var msg = ''; 
   var del = '';
   var add = '';
   var update = '';
   <?php if(session()->has('msg')){?>
      msg = true;
      del = 'Aircon is Deleted Successfully';
      <?php }?>;

   // $(document).on('click','.view',function(e){
   //    // console.log(e.target.id);
   //    var id = e.target.id;
   //    var options = { year: 'numeric', month: 'long', day: 'numeric' };

   //    var myModal = new bootstrap.Modal(document.getElementById('viewModal'));
   //    $.ajax({
   //       method: 'Post',
   //       url: 'http://localhost/tsms/calendar/events/view',
   //       data:{
   //          'id': id
   //       },
   //       success: function(response){
   //          var date = new Date(response.event_data.start_event);
   //          var startEvent = date.toLocaleDateString("en-US",(options));
   //          var eventCode = response.event_data.event_code;
   //          var logCode = response.event_data.log_code;
   //          var apptCode = response.event_data.appt_code;
   //          var clientId = response.event_data.client_id;
   //          var clientData = response.client_data;
   //          var area;
   //          var branch;
   //          var servId = response.event_data.serv_id;
   //          var servData = response.serv_data;
   //          var servName;
   //          var servType;
   //          var time = response.event_data.time.split(":");
   //          var formatTime;
   //          var dBrandArr = new Array();
   //          var airconTypeArr = new Array();
   //          var devBrand;
   //          var airconType;
   //          var fcuArr = response.distinct;
   //          var fcuNoArr = new Array();
   //          var fcuData = response.fcu_data;
   //          var fcuNo;
   //          var qty;
   //          // var date = 

   //          $('#modalTitle').html("["+eventCode+"] Schedule");
   //          $('#modal_start_event').html(startEvent);
   //          $('#modal_event_code').html(eventCode);
   //          if(logCode == ''){
   //             $('#modal_log_code').html("N/A");
   //          }else{
   //             $('#modal_log_code').html(logCode);
   //          }
            
   //          if(apptCode == ''){
   //             $('#modal_appt_code').html("N/A");
   //          }else{
   //              $('#modal_appt_code').html(apptCode);
   //          }
            
   //          if(time[0] == '00'){
   //             formatTime = 'N/A';
   //          }else if (time[0]>=12){
   //              var hour = time[0] - 12;
   //              var amPm = "PM";
   //              formatTime = hour + ":" + time[1] + " " + amPm;
   //          } else {
   //              var hour = time[0]; 
   //              var amPm = "AM";
   //              formatTime = hour + ":" + time[1] + " " + amPm;
   //          }
            
   //           $('#modal_time').html(formatTime);

   //           for (var a = 0; a < clientData.length; a++) {
   //              if(clientId == clientData[a].client_id){
   //                area = clientData[a].area;
   //                branch = clientData[a].client_branch;
   //              }
   //           }
   //           // console.log(area + " "+branch);
   //           $('#modal_area').html(area);
   //           $('#modal_branch').html(branch);

   //           for (var b = 0; b < servData.length; b++) {
   //              if(servId == servData[b].serv_id){
   //                servName = servData[b].serv_name;
   //                servType = servData[b].serv_type;
   //              }
   //           }
   //           $('#modal_serv_name').html(servName);
   //           $('#modal_serv_type').html(servType);
   //          for (var i = 0; i < fcuArr.length; i++) {
   //            dBrandArr.push(response.distinct[i].device_brand);
   //            airconTypeArr.push(response.distinct[i].aircon_type);
   //          }
            
   //          devBrand = dBrandArr.toString();
   //          airconType = airconTypeArr.toString();
   //          $('#modal_dev_brand').html(devBrand);
   //          $('#modal_aircon_type').html(airconType);
   //          // console.log(devBrand +" "+ airconType);

   //          for (var i = 0; i < fcuData.length; i++) {
   //            if(id == fcuData[i].id){
   //             // console.log("true");
   //             fcuNoArr.push(response.fcu_data[i].fcu);
   //            }
              
   //          }
   //          fcuNo = fcuNoArr.toString();
   //          $('#modal_fcu').html(fcuNo);
   //          // console.log(fcuNo);
   //          console.log(response);
   //          myModal.show();
   //       }
   //    })
   // })
   </script>
   <script type="text/javascript" src="<?= base_url('assets/js/crud.js')?>"></script>