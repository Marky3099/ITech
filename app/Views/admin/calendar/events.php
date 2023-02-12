<link rel="stylesheet" href="<?= base_url('assets/css/style.css')?>">

<!-- modal for viewing rate service -->
<div class="modal fade" id="rateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Service Review</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container rate-container">
          
          
        </div>
        <div class="techRate">
            
          </div>
        
        <h6></h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- modal for viewing uploaded reports -->
<div class="modal fade" id="reportsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Reports</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="container" id="report-container">
           <center><p><i class="fa-solid text-success fa-circle-exclamation"></i>&nbsp;There are no reports.</p></center>
          <div class="row" id="report_files">
            
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- modal for uploading reports -->
<div class="modal fade" id="fileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?= base_url('service-reports/add')?>" enctype="multipart/form-data">
      <div class="modal-body">
          <div class="form-group">
            <input type="hidden" id="event_id" name="event_id">
            <label for="fileuploads">Reports</label>
            <input type="file" class="py-1 border-success form-control" id="fileuploads" name="fileuploads[]" multiple aria-describedby="limitFile">
            <small id="limitFile" class="form-text text-muted">Uploaded Files must not exceed <b>25mb</b></small>  
          </div>
          <div class="form-group">
            <label for="notes">Notes/Comments</label>
            <textarea type="text" class="form-control border-success" id="notes" name="notes" placeholder="Description"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btnn btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- modal for View tasks -->
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
                    <th>Aircon Brand:</th>
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
      
     <div class="crud-text"><h3 class="headerfont">Scheduled Tasks</h3></div>

     <div class="tsk">
      <?php if($_SESSION['position'] != USER_ROLE_EMPLOYEE):?>
        <a href="<?= base_url('/calendar') ?>" class="btn" >Calendar</a>
      <?php endif;?>
     </div>
</div>
<div class="col-sm-12 mt-3 bg-light" style=" padding:10px;">
   <?php if($event): ?>
      <table class="table table-bordered table-hover" id="event-table">
        <thead>
           <tr>
              <th>Date</th>
              <th>Time</th>
              <th>Task Code</th>
              <th>Branch Name</th>
              <th>Service</th>
              <th>Status</th>
              <th>Review</th>
              <th>Action</th>
           </tr>
        </thead>
        <tbody>

          <?php foreach($event as $dat):  ?>
             <tr>
               <td><?php echo date('m-d-Y',strtotime($dat->start_event)); ?></td>
                  <?php $time = explode(":",$dat->time);
                        $endTime = explode(":",$dat->end_time);?>
                  <?php if($time[0] == '00'):?>
                     <td>N/A</td>
                  <?php elseif ($time[0]>=12):?>
                      <?php $hour = $time[0] - 12;?>
                      <?php $amPm = "PM";?>
                      <?php $startTime = $hour . ":" . $time[1] . " " . $amPm;?>
                  <?php else:?>
                      <?php $hour = $time[0]; ?>
                      <?php $amPm = "AM"; ?>
                      <?php $startTime = ltrim($hour, '0') . ":" . $time[1] . " " . $amPm;?>
                  <?php endif;?>

                  <?php if($endTime[0] == '00'):?>
                     <td>N/A</td>
                  <?php elseif ($endTime[0]==12):?>
                      <?php $hour = $endTime[0];?>
                      <?php $amPm = "PM";?>
                      <?php $end = $hour . ":" . $endTime[1] . " " . $amPm;?>
                  <?php elseif ($endTime[0]>12):?>
                      <?php $hour = $endTime[0] - 12;?>
                      <?php $amPm = "PM";?>
                      <?php $end = $hour . ":" . $endTime[1] . " " . $amPm;?>
                  <?php else:?>
                      <?php $hour = $endTime[0]; ?>
                      <?php $amPm = "AM"; ?>
                      <?php $end = ltrim($hour, '0') . ":" . $endTime[1] . " " . $amPm;?>
                  <?php endif;?>

                  <td><?php echo $startTime.' - '.$end;?></td>

               <td>
                  <?php echo $dat->event_code; ?>
               </td>
               <td>
                  <?php echo $dat->client_branch; ?>
               </td>
                  <!-- <?php if($dat->log_code != ""):?>
                  <td><?php echo $dat->log_code; ?></td>
               <?php else: ?>
                  <td>N/A</td>
               <?php endif;?> -->
               <td>
                  <?php echo $dat->serv_type; ?>
               </td>
               <!-- <?php if($dat->appt_code != ""):?>
                  <td><?php echo $dat->appt_code; ?></td>
               <?php else: ?>
                  <td>N/A</td>
               <?php endif;?> -->
               
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
      <td><?php if($dat->appt_code != ''):?>
          <?php if($dat->status == 'Done'):?>
            <a href="#" id="<?=$dat->id?>" class="btn btn-success btn-sm viewReport">View</a>
          <?php endif;?>
        <?php endif;?>
      </td>
      <td>
        <a href="#" id="<?=$dat->id?>" class="btn btn-info btn-sm mb-1 view">View Task</a><br>
        <?php if($dat->status!='Pending'):?>
          <a href="#" id="<?=$dat->id?>" class="btn btn-primary btn-sm mb-1 reports" data-toggle="modal" data-target="#fileModal">Upload Report</a><br>
          <a href="#" id="<?=$dat->id?>" class="btn btn-secondary btn-sm view-reports">View Report</a>
        <?php endif;?>
     </td>
  </tr>
<?php endforeach; ?>

</tbody>
</table>
<?php else: ?>
   <h4 style="text-align:center;">Ooops.. No scheduled task yet!</h4>
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
   <?php if(session()->has('limit')){?>
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: '<?= session()->getFlashdata('limit')?>',
    })
   <?php }?>;
   <?php if(session()->has('msg')){?>
      msg = true;
      del = 'Aircon is Deleted Successfully';
   <?php }?>;
   var myModal = new bootstrap.Modal(document.getElementById('reportsModal'));

   $('.reports').click(function(){
    var eventId = $(this).attr('id');
    $('#event_id').val(eventId);
   })
   $('.view-reports').click(function(){
    var eventId = $(this).attr('id');
    // alert(eventId);
    $.ajax({
       method:"GET",
       url:"<?=base_url('/service-reports')?>",
       data: {
          'id': eventId,
       },
       success: function(response){
          // console.log(response.reports.length>0);
          // console.log(response);
          var dir = '<?=base_url('uploads/')?>';
          $('#report_files').empty();
          $('#report-container #noreports').empty();
          if(response.reports.length>0){
            $('#report_files').append('<table class="table table-bordered" id="report_table"><thead><tr><th>#</th><th>File</th><th>Comments/Notes</th><th>Uploader</th><th>Action</th></tr></thead>');
            for(var i=0, a=0; i<response.reports.length; i++){
              var image = response.reports[i].image;
              var imageSplit = image.split(".");
              var imageFile;
              // console.log(imageSplit);
              if(imageSplit[1]=='pdf'){
                // console.log('Tru');
                imageFile = 'pdf.png';
              }
              else if(imageSplit[1]=='jpg' || imageSplit[1]=='png' || imageSplit[1]=='jpeg'){
                imageFile = image;
              }else if(imageSplit[1]=='docx'){
                imageFile = 'docx.png';
              }else if(imageSplit[1]=='pptx'){
                imageFile = 'ppt.png';
              }else if(imageSplit[1]=='xlsx'){
                imageFile = 'excel.png';
              }
              var notes = response.reports[i].upload_description;
              var username = '';
              var position = '';
              for(var j =0; j<response.users.length; j++){
                if(response.reports[i].user_id == response.users[j].user_id){
                  username = response.users[j].name;
                  position = response.users[j].position;
                }
              }

              $('#report_table').append('<tbody id=a'+response.reports[i].upload_id+'><tr><td>'+(a+=1)+'</td><td><a target="__blank" href = '+dir+'/'+image+' style="z-index:-1;"><img src='+dir+'/'+imageFile+' height="150px" width="150px"></a></td><td>'+notes+'</td><td>'+username+'('+position+')'+'</td><td><button id='+response.reports[i].upload_id+' class="btn btn-danger exis">Delete</button></td></tr></tbody></table>');
            }
            $('.exis').click(function(){
              var reportId = $(this).attr('id');
              if(reportId){
                $('#a'+reportId).remove();
                
                $.ajax({
                 method:"GET",
                 url:"<?=base_url('/service-reports/delete')?>",
                 data: {
                    'id': reportId,
                 },
                 success: function(response){
                    console.log(response);
                 }
               });
              }
              // console.log();
            })
          }else{
            $('#report-container #noreports').append('<h1><center>No Reports Yet<center></h1>')
          }
          myModal.show();
       }
    })
   });
var rateModal = new bootstrap.Modal(document.getElementById('rateModal'));
   $('.viewReport').click(function(){
      var id = $(this).attr('id');

      $.ajax({
           method:"GET",
           url:"<?=base_url('/calendar/events/view-ratings')?>",
           data: {
              'id': id,
           },
           success: function(response){
            var rate = response.rate;
            var emp = response.emp;
            $('.rate-container').empty();
            $('.techRate').empty();
            if(rate.length > 0){
              $('.rate-container').append(`<center><h2>Service's Review</h2></center>
          <div class="row">
            <div class="col-lg-4">
               <p class="servq">Service Quality</p>
            </div>
            <div class="rate col-lg-6">
              <input type="radio" id="star5" name="rate" value="5" disabled/>
              <label for="star5" title="Amazing">5 stars</label>
              <input type="radio" id="star4" name="rate" value="4" disabled/>
              <label for="star4" title="Good">4 stars</label>
              <input type="radio" id="star3" name="rate" value="3" disabled/>
              <label for="star3" title="Fair">3 stars</label>
              <input type="radio" id="star2" name="rate" value="2" disabled/>
              <label for="star2" title="Poor">2 stars</label>
              <input type="radio" id="star1" name="rate" value="1" disabled/>
              <label for="star1" title="Terrible">1 star</label>
            </div>
            <div class="col-lg-2 result"></div>
          </div>
          <textarea name="comments" id="event_comments" placeholder="Share more thoughts on our service..." rows="4" cols="50" disabled></textarea>
          <center><h2>Technician's Review</h2></center>`);

              for(var i =0; i <rate.length; i++){
                var empId = rate[i].emp_id;
                if(empId == emp[i].emp_id){
                  $('.techRate').append(`<h5>`+emp[i].emp_name+`</h5><div class="row rowa">
                  <div class="col-lg-5">
                     <p class="servq">Technician Quality</p>
                  </div>
                  <div class="tech col-lg-6">
                    <input type="radio" id="star5`+empId+`" name="rate_`+empId+`" value="5" disabled/>
                    <label for="star5`+empId+`" title="Amazing">5 stars</label>
                    <input type="radio" id="star4`+empId+`" name="rate_`+empId+`" value="4" disabled/>
                    <label for="star4`+empId+`" title="Good">4 stars</label>
                    <input type="radio" id="star3`+empId+`" name="rate_`+empId+`" value="3" disabled/>
                    <label for="star3`+empId+`" title="Fair">3 stars</label>
                    <input type="radio" id="star2`+empId+`" name="rate_`+empId+`" value="2" disabled/>
                    <label for="star2`+empId+`" title="Poor">2 stars</label>
                    <input type="radio" id="star1`+empId+`" name="rate_`+empId+`" value="1" disabled/>
                    <label for="star1`+empId+`" title="Terrible">1 star</label>
                  </div>
                  <div class="col-lg-1 resulttech" id= a`+empId+`></div>
                  </div>
                  <textarea name="techComments[]" id="tech`+empId+`" placeholder="Leave a comment..." rows="4" cols="50" multiple disabled></textarea>`);

                  if(rate[i].rate_emp == '100'){
                    $('#star5'+empId).prop('checked',true);
                    $('#a'+empId).html('Amazing');
                  }else if(rate[i].rate_emp == '80'){
                    $('#star4'+empId).prop('checked',true);
                    $('#a'+empId).html('Good');
                  }else if(rate[i].rate_emp == '60'){
                    $('#star3'+empId).prop('checked',true);
                    $('#a'+empId).html('Fair');
                  }else if(rate[i].rate_emp == '40'){
                    $('#star2'+empId).prop('checked',true);
                    $('#a'+empId).html('Poor');
                  }else if(rate[i].rate_emp == '20'){
                    $('#star1'+empId).prop('checked',true);
                    $('#a'+empId).html('Terrible');
                  }
                  if(rate[i].emp_comments.length > 0){
                    // console.log('com');
                    $('#tech'+empId).html(rate[i].emp_comments);
                  }else{
                    $('#tech'+empId).html('No Comments');
                  }


                }
              }

              if(rate[0].rate_event == '100'){
                $('#star5').prop('checked',true);
                $('.result').html('Amazing');
              }else if(rate[0].rate_event == '80'){
                $('#star4').prop('checked',true);
                $('.result').html('Good');
              }else if(rate[0].rate_event == '60'){
                $('#star3').prop('checked',true);
                $('.result').html('Fair');
              }else if(rate[0].rate_event == '40'){
                $('#star2').prop('checked',true);
                $('.result').html('Poor');
              }else if(rate[0].rate_event == '20'){
                $('#star1').prop('checked',true);
                $('.result').html('Terrible');
              }

              if(rate[0].event_comments.length > 0){
                $('#event_comments').html(rate[0].event_comments);
              }else{
                $('#event_comments').html('No Comments');
              }



            }else{
              $('.rate-container').append('<center><h1>No Reviews Yet</h1></center>');
            }
           }
      });

      rateModal.show();
   })
  var viewTask = "https://puptcapstone.net/tsms/calendar/events/view";
  $(document).on('click','.view',function(e){
      // console.log(e.target.id);
      var id = e.target.id;
      var options = { year: 'numeric', month: 'long', day: 'numeric' };

      var myModal = new bootstrap.Modal(document.getElementById('viewModal'));
      $.ajax({
         method: 'Post',
         url: '<?=base_url('/calendar/events/view')?>',
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
            var endTime = response.event_data.end_time.split(":");
            var formatTime;
            var formatEndTime;
            var dBrandArr = new Array();
            var airconTypeArr = new Array();
            var devBrand;
            var airconType;
            var fcuArr = response.distinct;
            var fcuNoArr = new Array();
            var fcuData = response.fcu_data;
            var fcuNo;
            var qty = new Array();
            var quantity;
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
            }else if (time[0]>12){
                var hour = time[0] - 12;
                var amPm = "PM";
                formatTime = hour + ":" + time[1] + " " + amPm;
            }else if (time[0]==12){
                var hour = time[0];
                var amPm = "PM";
                formatTime = hour + ":" + time[1] + " " + amPm;
            } else {
                var hour = time[0]; 
                var amPm = "AM";
                formatTime = parseInt(hour) + ":" + time[1] + " " + amPm;
            }

            if(endTime[0] == '00'){
               formatEndTime = 'N/A';
            }else if (endTime[0]>12){
                var hour = endTime[0] - 12;
                var amPm = "PM";
                formatEndTime = hour + ":" + endTime[1] + " " + amPm;
            }else if (endTime[0]==12){
                var hour = endTime[0];
                var amPm = "PM";
                formatEndTime = hour + ":" + endTime[1] + " " + amPm;
            } else {
                var hour = endTime[0]; 
                var amPm = "AM";
                formatEndTime = parseInt(hour) + ":" + endTime[1] + " " + amPm;
            }
            
             $('#modal_time').html(formatTime+" - "+formatEndTime);

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
               fcuNoArr.push(response.fcu_data[i].fcu);
              }
              
            }
            var pre = 0;
            for (var i = 0; i < fcuData.length; i++) {
                if(id == fcuData[i].id){
                    if(fcuData[i].aircon_id!=pre){
                        qty.push(response.fcu_data[i].quantity);
                        pre = fcuData[i].aircon_id;
                    }
                }
            }
            fcuNo = fcuNoArr.toString();
            quantity = qty.toString();
            $('#modal_fcu').html(fcuNo);
            $('#modal_qty').html(quantity);

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
   });
   
   </script>
   <script type="text/javascript" src="<?= base_url('assets/js/crud.js')?>"></script>
