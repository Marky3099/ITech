<link rel="stylesheet" href="<?= base_url('assets/css/style.css')?>">

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
            <input type="file" class="form-control" id="fileuploads" name="fileuploads[]" multiple aria-describedby="limitFile">
            <small id="limitFile" class="form-text text-muted">Uploaded Files must not exceed <b>25mb</b></small>  
          </div>
          <div class="form-group">
            <label for="notes">Notes/Comments</label>
            <textarea type="text" class="form-control" id="notes" name="notes" placeholder="Description"></textarea>
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
      
     <div class="crud-text"><h3 class="headerfont">Scheduled Tasks</h3></div>

     <div class="tsk">
        <a href="<?= base_url('/calendar') ?>" class="btn" >Calendar</a>
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
              <th>Action</th>
           </tr>
        </thead>
        <tbody>

          <?php foreach($event as $dat):  ?>
             <tr>
               <td><?php echo date('m-d-Y',strtotime($dat->start_event)); ?></td>
                  <?php $time = explode(":",$dat->time);?>
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
      <td>
        <a href="#" id="<?=$dat->id?>" class="btn btn-info btn-sm view">View Task</a>
        <?php if($dat->status!='Pending'):?>
          <a href="#" id="<?=$dat->id?>" class="btn btn-primary btn-sm reports" data-toggle="modal" data-target="#fileModal">Upload Report</a>
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
          console.log(response);
          var dir = '<?=base_url('uploads/')?>';
          $('#report_files').empty();
          if(response.reports.length>0){
            $('#report-container h1').empty();
            $('#report_files').append('<table class="table table-bordered" id="report_table"><thead><tr><th>#</th><th>File</th><th>Comments/Notes</th><th>Uploader</th><th>Action</th></tr></thead>');
            for(var i=0, a=0; i<response.reports.length; i++){
              var image = response.reports[i].image;
              var notes = response.reports[i].upload_description;
              var username = '';
              var position = '';
              for(var j =0; j<response.users.length; j++){
                if(response.reports[i].user_id == response.users[j].user_id){
                  username = response.users[j].name;
                  position = response.users[j].position;
                }
              }

              $('#report_table').append('<tbody id=a'+response.reports[i].upload_id+'><tr><td>'+(a+=1)+'</td><td><a target="__blank" href = '+dir+'/'+image+' style="z-index:-1;"><img src='+dir+'/'+image+' height="150px" width="150px"></a></td><td>'+notes+'</td><td>'+username+'('+position+')'+'</td><td><button id='+response.reports[i].upload_id+' class="btn btn-danger exis">Delete</button></td></tr></tbody></table>');
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
            $('#report-container').append('<h1><center>No Reports Yet<center></h1>')
          }
          myModal.show();
       }
    })
   });
   
   </script>
   <script type="text/javascript" src="<?= base_url('assets/js/view.js')?>"></script>
   <script type="text/javascript" src="<?= base_url('assets/js/crud.js')?>"></script>