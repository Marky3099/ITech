<link rel="stylesheet" href="<?= base_url('assets/css/style.css')?>">

<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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
            
               <table class="table-hover" style="width:100%">
                  <tr>
                    <th>Date:</th>
                    <td id="modal_start_event"></td>
                  </tr>
                  <tr>
                    <th>Time:</th>
                    <td id="modal_time"></td>
                  </tr>
                  <tr>
                    <th>Task Code:</th>
                    <td id="modal_event_code"></td>
                  </tr>
                  <tr>
                    <th>Log Code:</th>
                    <td id="modal_log_code"></td>
                  </tr>
                  <tr>
                    <th>Appt Code:</th>
                    <td id="modal_appt_code"></td>
                  </tr>
                  <tr>
                    <th>Branch Area:</th>
                    <td id="modal_area"></td>
                  </tr>
                  <tr>
                    <th>Branch Name:</th>
                    <td id="modal_branch"></td>
                  </tr>
                  <tr>
                    <th>Service Name:</th>
                    <td id="modal_serv_name"></td>
                  </tr>
              </table>
            </div>
           <div class="col-md-6">
            <table class="table-hover" style="width:100%">
                  <tr>
                    <th>Service Type:</th>
                    <td id="modal_serv_type"></td>
                  </tr>
                  <tr>
                    <th>Device Brand:</th>
                    <td id="modal_dev_brand"></td>
                  </tr>
                  <tr>
                    <th>Aircon Type:</th>
                    <td id="modal_aircon_type"></td>
                  </tr>
                  <tr>
                    <th>FCU #:</th>
                    <td id="modal_fcu"></td>
                  </tr>
                  <tr>
                    <th>Quantity:</th>
                    <td id="modal_qty"></td>
                  </tr>
                  <tr>
                    <th>Employee:</th>
                    <td id="modal_emp"></td>
                  </tr>
                  <tr>
                    <th>Status:</th>
                    <td id="modal_status"></td>
                  </tr>
                  
              </table>
           </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="body-content">
   <div class="event-header">
     <h3 id="mod" class="mt-2 headerfont"><b>Today's Scheduled Tasks - <?= date('F j, Y');?></b></h3>
     
     <div class="d-flex justify-content-left" style="margin-left:20px;">
         <a href="<?= base_url('/calendar');?>" class="btn">Calendar</a>
         <a href="<?= base_url('/calendar/events');?>" class="btn">Scheduled Tasks</a>
         <a href="<?= base_url('/calendar/events/today/print');?>" target="_blank" class="btn">Print</a>
      </div>
    
   </div>
    <div class="col-sm-12 mt-3 bg-light" style=" padding:10px;">
      <?php if($day): ?>
         <table class="table table-bordered" id="table1">
           <thead>
              <tr>
                 <th>Date</th>
                 <th>Time</th>
                 <th>Task Code</th>
                 <th>Branch Name</th>
                 <th>Service</th>
                 <th>Status</th>
                 <th>Action</th>
                 
              </tr>
           </thead>
           <tbody>

               <?php foreach($day as $d):  ?>
                  <tr>
                     <td><?php echo date('m-d-Y',strtotime($d->start_event)); ?></td>
                     <?php $time = explode(":",$d->time);?>
                     <?php if($time[0] == '00'):?>
                         <td>N/A</td>
                      <?php elseif ($time[0]>=12):?>
                          <?php $hour = $time[0] - 12;?>
                          <?php $amPm = "PM";?>
                          <td><?php echo $hour . ":" . $time[1] . " " . $amPm;?></td>
                      <?php else:?>
                          <?php $hour = $time[0]; ?>
                          <?php $amPm = "AM"; ?>
                          <td><?php echo  ltrim($hour, '0') . ":" . $time[1] . " " . $amPm;?></td>
                      <?php endif;?>
                     <td><?php echo $d->event_code; ?></td>
                     <td><?php echo $d->client_branch ?></td>
                    <!--  <?php if($d->log_code != ""):?>
                     <td><?php echo $d->log_code; ?></td>
                     <?php else: ?>
                        <td>N/A</td>
                     <?php endif;?> -->
                     <td><?php echo $d->serv_type ?></td>
                     <!-- <?php if($d->appt_code != ""):?>
                        <td><?php echo $d->appt_code; ?></td>
                     <?php else: ?>
                        <td>N/A</td>
                     <?php endif;?> -->
                     <?php if($d->status == 'Pending'):?>
                        <td style="color:#4F6FA6;"><b>
                           <?php echo $d->status; ?>
                           </b>
                        </td>
                     <?php else:?>
                        <td><b>
                           <?php echo $d->status; ?>
                        </b>
                        </td>
                     <?php endif;?>
                     <td><a href="#" id="<?=$d->id?>" class="btn btn-info btn-sm view">View</a></td>
                  </tr>
               <?php endforeach; ?>
            </tbody>
         </table>
      <?php else: ?>
         <h3 style="text-align:center;">Ooops.. No work for today!</h3>
      <?php endif; ?>
    </div>
</div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">


   $(document).on('click','.view',function(e){
      // console.log(e.target.id);
      var id = e.target.id;
      var options = { year: 'numeric', month: 'long', day: 'numeric' };

      var myModal = new bootstrap.Modal(document.getElementById('viewModal'));
      $.ajax({
         method: 'Post',
         url: 'http://localhost/tsms/calendar/events/view',
         data:{
            'id': id
         },
         success: function(response){
            var date = new Date(response.event_data.start_event);
            var startEvent = date.toLocaleDateString("en-US",(options));
            var eventCode = response.event_data.event_code;
            var logCode = response.event_data.log_code;
            var apptCode = response.event_data.appt_code;
            var clientId = response.event_data.client_id;
            var clientData = response.client_data;
            var area;
            var branch;
            var servId = response.event_data.serv_id;
            var servData = response.serv_data;
            var servName;
            var servType;
            var time = response.event_data.time.split(":");
            var formatTime;
            var dBrandArr = new Array();
            var airconTypeArr = new Array();
            var devBrand;
            var airconType;
            var fcuArr = response.distinct;
            var fcuNoArr = new Array();
            var fcuData = response.fcu_data;
            var fcuNo;
            var qty = new Array();
            var empArr = response.emp_data;
            var emp = new Array();
            var empData;
            var statusData = response.event_data.status;
            // var date = 

            $('#modalTitle').html("["+eventCode+"] Schedule");
            $('#modal_start_event').html(startEvent);
            $('#modal_event_code').html(eventCode);
            if(logCode == ''){
               $('#modal_log_code').html("N/A");
            }else{
               $('#modal_log_code').html(logCode);
            }
            
            if(apptCode == ''){
               $('#modal_appt_code').html("N/A");
            }else{
                $('#modal_appt_code').html(apptCode);
            }
            
            if(time[0] == '00'){
               formatTime = 'N/A';
            }else if (time[0]>=12){
                var hour = time[0] - 12;
                var amPm = "PM";
                formatTime = hour + ":" + time[1] + " " + amPm;
            } else {
                var hour = time[0]; 
                var amPm = "AM";
                formatTime = parseInt(hour) + ":" + time[1] + " " + amPm;
            }
            
             $('#modal_time').html(formatTime);

             for (var a = 0; a < clientData.length; a++) {
                if(clientId == clientData[a].client_id){
                  area = clientData[a].area;
                  branch = clientData[a].client_branch;
                }
             }
             // console.log(area + " "+branch);
             $('#modal_area').html(area);
             $('#modal_branch').html(branch);

             for (var b = 0; b < servData.length; b++) {
                if(servId == servData[b].serv_id){
                  servName = servData[b].serv_name;
                  servType = servData[b].serv_type;
                }
             }
             $('#modal_serv_name').html(servName);
             $('#modal_serv_type').html(servType);
            for (var i = 0; i < fcuArr.length; i++) {
              dBrandArr.push(response.distinct[i].device_brand);
              airconTypeArr.push(response.distinct[i].aircon_type);
            }
            
            devBrand = dBrandArr.toString();
            airconType = airconTypeArr.toString();
            $('#modal_dev_brand').html(devBrand);
            $('#modal_aircon_type').html(airconType);
            // console.log(devBrand +" "+ airconType);

            for (var i = 0; i < fcuData.length; i++) {
              if(id == fcuData[i].id){
               // console.log("true");
               fcuNoArr.push(response.fcu_data[i].fcu);
               qty.push(response.fcu_data[i].quantity);
              }
              
            }
            fcuNo = fcuNoArr.toString();
            $('#modal_fcu').html(fcuNo);
            $('#modal_qty').html(qty);

            for (var i = 0; i < empArr.length; i++) {
               emp.push(response.emp_data[i].emp_name);
            }
            empData = emp.toString();
            $('#modal_emp').html(empData);
            $('#modal_status').html(statusData);
            // console.log();
            console.log(response);
            myModal.show();
         }
      })
   })



   $(document).ready( function () {
     $('#table1').DataTable({
        pageLength : 5,
        lengthMenu: [[5, 10, 15,20], [5, 10, 15, 20,]]
     });
  } );
</script>