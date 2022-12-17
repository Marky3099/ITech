
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<div id="mymodal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document" id="dialog">
    <div class="modal-content">
     <form id="toCal" action="<?= base_url('/admin-appointment/add-to-calendar');?>" method="POST"> 
      <div class="modal-header">
        <h4 class="modal-title">Add Schedule</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="adata">
        <input type="hidden" name="appt_id" id="appt_id">
        <input type="hidden" name="user_id" id="user_id">
        <input type="hidden" name="appt_code" id="appt_code">
        
        <div class="form-group">
          <input class="form-control" type="hidden" name="title" id="title" placeholder="Title">
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="date">Date</label><br>
            <input type="text" name="date" id="calDate" required>
          </div>
          <div class="form-group col-md-6">
            <label for="time">Time</label><br>
            <input type="time" name="time" id="time">
          </div>
        </div>
        <h3>Client Details:</h3>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="calArea">Branch Area</label><br>
            <input id="calArea" name="area" class="form-control" >
          </div>
          <div class="form-group col-md-6">
            <label for="calName">Branch Name</label><br>
            <input type="hidden" id="client_id_modal" name="client_id_modal">
            <input id="calName" class="form-control" >
          </div>
        </div>
        <div class="form-group">
          
          <label for="Calserv_id">Service</label><br>
          <input type="hidden" id="serv_id_modal" name="serv_id_modal">
          <input id="Calserv_id" name="Calserv_id" class="form-control">
        </div>
        <h3>Aircon Details:</h3>
        <div class="form-row">
          <div class="form-group col-md-3">
            
            <label for="calBrand">Device Brand</label>
            <input id="calBrand" name="device_brand" class="form-control" >
          </div> 
          <div class="form-group col-md-3">
            
            <label for="calType">Aircon Type</label>
            <input type="hidden" id="aircon_id_modal" name="aircon_id_modal" class="form-control" >
            <input id="calType" class="form-control aircon" >
          </div> 
          <div class="form-group col-md-3">
            
            <label for="calFcu">Fcuno</label>
            <input type="hidden" name="fcu[]" id="fcuno">
            <input id="calFcu" name="fcuno[]" class="form-control">
          </div> 
          <div class="form-group col-md-2">
            
            <label for="calQty">Quantity</label>
            <input id="calQty" type="number" class="form-control" name="quantity" min="1" required>
          </div> 
        </div>
        <div id="auth-rows"></div>
        <div class="form-group">
          
          <label for="emp_id">Employee<span style="color:red; font-size: 20px;">*</span></label><br>
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


<div class="body-content">
   <div class="crud-text"> <h3>Appointment</h3></div>

  <!-- <div class="d-flex justify-content-left">
    <a href="<?=base_url("/appointment/create")?>" class="btn">Add Appointment</a>
 </div> -->
 <div class="mt-3">
   <?php if($view_appoint):?>
    <table class="table table-bordered" id="table1">
     <thead>
        <tr>
           <th>Date</th>
           <th>Appt Code</th>
           <th>Time</th>
           <th>Branch Area</th>
           <th>Branch Name</th>
           <th>Service</th>
           <th>Service Type</th>
           <th>Device Brand</th>
           <th>Aircon Type</th>
           <th>FCU No.</th>
           <th>Qty.</th>
           <th>Status</th>
           <th>Action</th>
        </tr>
     </thead>
     <tbody>
      <?php foreach($view_appoint as $appt):  ?>
        <tr name="user_id" id="user_id" value="<?php echo $appt->user_id;?>">
           <td><?php echo $appt->appt_date; ?></td>
           <td><?php echo $appt->appt_code; ?></td>
           <td><?php echo $appt->appt_time; ?></td>
           <td><?php echo $appt->area; ?></td>
           <td><?php echo $appt->client_branch; ?></td>
           <td><?php echo $appt->serv_name; ?></td>
           <td>N/A</td>
           <td><?php echo $appt->device_brand; ?></td>
           <td><?php echo $appt->aircon_type; ?></td>
           <td> <?php $data1 = explode(',',$appt->fcu_arr);
           $count1 = 0;
           ?>
           <?php foreach($data1 as $fc):  ?>
            <?php if($count1 < (count($data1) - 1) ):  ?>
              <?php echo $fc; $count1+=1; ?> <br>
           <?php endif;  ?>
           <?php endforeach; ?></td>
           <td><?php echo $appt->qty; ?></td>
           <td><?php echo $appt->appt_status; ?></td>
           <td>
            <?php if($appt->set_status ==0):?>
             <a href="#" id="<?php echo $appt->appt_id; ?>" class="btn btn-primary btn-sm set_btn">Set</a>
             <a href="#" id="<?php echo $appt->appt_id; ?>" data-id="<?php echo $appt->user_id;?>" class="btn btn-danger btn-sm dec_btn">Reject</a>
           <?php elseif($appt->set_status ==1):?>
            <h6 style="color:green;"><b>Already Set</h6>
          <?php else:?>
            <h6 style="color:red;"><b>REJECTED</h6>
          <?php endif;?>
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

   $(document).on('click','.set_btn',function(e){
      var apptId = e.target.id;
      
      $.ajax({
         method:"POST",
         url:"http://localhost/tsms/appointment/set-Appointment",
         data: {
            'appt_id': apptId
         },
         success: function(response){
            var user_id = response.appt.user_id;
            var fcuLength = response.fcu.length;
            var clientLength = response.client.length;
            var servLength = response.serv.length;
            var airconLength = response.aircon.length;

            var appt_id = response.appt.appt_id;
            var appt_code = response.appt.appt_code;
            var date = response.appt.appt_date;
            var time = response.appt.appt_time;
            var client = response.appt.client_id;
            var clientBranch;
            var clientArea;
            var airconBrand;
            var airconType;
            var servType;
            var service = response.appt.serv_id;
            var aircon = response.appt.aircon_id;
            var fcu = new Array();
            var fcuName = new Array();
            
            var qty = response.appt.qty;
            var myModal = new bootstrap.Modal(document.getElementById('mymodal'));

            for (var i = 0; i < fcuLength; i++) {
               fcu.push(response.fcu[i].fcuno);
             }; 
            document.getElementById("calDate").value = date;
            document.getElementById("time").value = time;
            document.getElementById("client_id_modal").value = client;
            
            for (var a = 0; a < clientLength; a++) {
               if (client == response.client[a].client_id) {
                // console.log('true');
                  clientArea = response.client[a].area;
                  clientBranch = response.client[a].client_branch;
                  
               }
             }; 
             document.getElementById("calArea").value = clientArea;
             document.getElementById("calName").value = clientBranch;      

             for (var b = 0; b < servLength; b++) {
               if (service == response.serv[b].serv_id) {
                  
                  // servName = response.serv[b].serv_name;
                  servType = response.serv[b].serv_type;
               }
             }; 

             document.getElementById("serv_id_modal").value = service;     
             document.getElementById("Calserv_id").value = servType;    

             for (var c = 0; c < airconLength; c++) {
               if (aircon == response.aircon[c].aircon_id) {
                  
                  // servName = response.serv[b].serv_name;
                  airconBrand = response.aircon[c].device_brand;
                  airconType = response.aircon[c].aircon_type;
               }
             }; 
             document.getElementById("aircon_id_modal").value = aircon;
             document.getElementById("calBrand").value = airconBrand;
             document.getElementById("calType").value = airconType;
             document.getElementById("calQty").value = qty;
             document.getElementById("fcuno").value = fcu;
             
             for (var d = 0; d < fcuLength; d++) {
               fcuName.push("FCU "+response.fcu[d].fcuno);
             }; 
             document.getElementById("calFcu").value =fcuName;
             // console.log(document.getElementById("calFcu").value);
             document.getElementById("appt_id").value = appt_id;
             document.getElementById("appt_code").value = appt_code;
             document.getElementById("user_id").value = user_id;
             // console.log(document.getElementById("user_id").value);
            myModal.show();
         }

      });
   });

   $(document).on('click','.dec_btn',function(e){
    var apptId = e.target.id;
    var userId = $(this).data("id");

    // console.log(userId);
    Swal.fire({
        title: 'Are you sure you want to Reject?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      }).then((result) => {
        if (result.isConfirmed) {
          location.reload();
          $.ajax({
             method:"POST",
             url:"http://localhost/tsms/appointment/reject",
             data: {
                'appt_id': apptId,
                'user_id': userId

             },
             success: function(response){
             }
          })


          
        }
      })
      
      // console.log(apptId);
      
    })

   </script>
   <script type="text/javascript" src="<?= base_url('assets/js/crud.js')?>"></script>
