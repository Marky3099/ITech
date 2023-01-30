<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<link rel="stylesheet" href="<?= base_url('assets/css/main.min.css')?>">

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
                    <th>Appt Code:</th>
                    <td id="modal_appt_code"></td>
                  </tr>
                  <tr>
                    <th>Area:</th>
                    <td id="modal_area"></td>
                  </tr>
                  <tr>
                    <th>Client Branch:</th>
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
   <div class="crud-text"> <h3>Appointment</h3></div>
   <br>
 <div class="mt-3">
   <?php if($view_appoint):?>
    <table class="table table-bordered" id="appt-table" style="font-size: 1.2rem;">
     <thead>
        <tr>
           <th>Date</th>
           <th>Time</th>
           <th>Appt Code</th>
           <th>Status</th>
           <th>Action</th>
        </tr>
     </thead>
     <tbody>
      <?php foreach($view_appoint as $appt):  ?>
        <tr name="user_id" id="user_id" value="<?php echo $appt->user_id;?>">
           <td><?php echo $appt->appt_date; ?></td>
           <?php $time = explode(":",$appt->appt_time);?>
           <?php if($time[0] == '00'):?>
               <td>N/A</td>
            <?php elseif ($time[0]>=12):?>
                <?php $hour = $time[0] - 12;?>
                <?php $amPm = "PM";?>
                <td><?php echo $hour . ":" . $time[1] . " " . $amPm;?></td>
            <?php else:?>
                <?php $hour = $time[0]; ?>
                <?php $amPm = "AM"; ?>
                <td><?php echo ltrim($hour, '0') . ":" . $time[1] . " " . $amPm;?></td>
            <?php endif;?>
           <td><?php echo $appt->appt_code; ?></td>
           <td><?php echo $appt->appt_status; ?></td>
           <td>
             <a href="#" id="<?php echo $appt->appt_id;?>" class="btn btn-info btn-sm view">View</a>
             <a href="#" id="<?php echo $appt->appt_id; ?>" data-id="<?php echo $appt->user_id;?>" class="btn btn-secondary btn-sm dec_btn">Cancel</a>
          </td>
       </tr>
    <?php endforeach; ?>
 </tbody>
</table>
<?php else: ?>
 <h1>No Appointment Yet!</h1>
<?php endif; ?>
</div>
</div>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
   var msg = ''; 
   var del = '';
   var add = '';
   var update = '';
   <?php if(session()->has('msg')){?>
      msg = true;
      del = 'Appointment is Deleted Successfully';
   <?php }elseif(session()->has('add')){?>
      add = true;
      del = 'New Appointment is Added Successfully';
   <?php }elseif(session()->has('update')){?>
      update = true;
      del = 'Appointment Details are Updated Successfully';
      <?php }?>;

    $('#mymodal .selectpicker').selectpicker();

   $(document).on('click','.dec_btn',function(e){
    var apptId = e.target.id;
    var userId = $(this).data("id");

    // console.log(userId);
    Swal.fire({
        title: 'Are you sure you want to cancel?',
        text: "",
        icon: 'warning',

        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        html:"You won't be able to revert this!<br><br> Reason<br><textarea name='reasonMsg' rows='4' cols='30'></textarea>",
      }).then((result) => {
        if (result.isConfirmed) {
          const valMsg = Swal.getHtmlContainer().querySelector('textarea').value;
          // console.log(valMsg);
          location.reload();
          $.ajax({
             method:"POST",
             url:"http://localhost/tsms/appointment/reject",
             data: {
                'appt_id': apptId,
                'user_id': userId,
                'reason': valMsg,
             },
             success: function(response){
              
             }
          })


          
        }
      })
    })

   $(document).on('click','.view',function(e){
      // console.log(e.target.id);
      var id = e.target.id;
      // console.log(id);
      var options = { year: 'numeric', month: 'long', day: 'numeric' };

      var myModal = new bootstrap.Modal(document.getElementById('viewModal'));
      $.ajax({
         method: 'Post',
         url: 'http://localhost/tsms/appointment/view',
         data:{
            'appt_id': id
         },
         success: function(response){
          console.log(response);
            var date = new Date(response.appt_data.appt_date);
            var startEvent = date.toLocaleDateString("en-US",(options));
            var apptCode = response.appt_data.appt_code;
            var clientId = response.appt_data.client_id;
            var clientData = response.client_data;
            var area;
            var branch;
            var servId = response.appt_data.serv_id;
            var servData = response.serv_data;
            var servName;
            var servType;
            var time = response.appt_data.appt_time.split(":");
            var formatTime;
            var devBrand = response.appt_data.device_brand;
            var airconType = response.appt_data.aircon_type;
            var fcuNoArr = new Array();
            var fcuData = response.fcu_data;
            var fcuNo;
            var qty = response.appt_data.qty;
            var statusData = response.appt_data.appt_status;

            $('#modalTitle').html("["+apptCode+"] Schedule");
            $('#modal_start_event').html(startEvent);
            $('#modal_appt_code').html(apptCode);
            
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
            $('#modal_dev_brand').html(devBrand);
            $('#modal_aircon_type').html(airconType);

            for (var i = 0; i < fcuData.length; i++) {
              if(id == fcuData[i].appt_id){
               fcuNoArr.push(response.fcu_data[i].fcu);
              }
            }
            fcuNo = fcuNoArr.toString();
            $('#modal_fcu').html(fcuNo);
            $('#modal_qty').html(qty);
            $('#modal_status').html(statusData);
            console.log(response);
            myModal.show();
         }
      })
   })

   </script>
   <script type="text/javascript" src="<?= base_url('assets/js/crud.js')?>"></script>
