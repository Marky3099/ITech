<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<link rel="stylesheet" href="<?= base_url('assets/css/style.css')?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/select2.css')?>">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<div id="mymodal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document" id="dialog">
    <div class="modal-content">
     <form id="toCal" action="<?= base_url('/calllogs/set-to-calendar');?>" method="POST"> 
      <div class="modal-header">
        <h4 class="modal-title">Add Schedule</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="adata">
        <!-- <input type="hidden" name="caller" id="callerC" value="">
        <input type="hidden" name="particulars" id="particularsC" value=""> -->
        <input type="hidden" name="log_code" id="log_code" value="">
        <input type="hidden" name="cl_id" id="cl_id" value="">
        <!-- <input type="hidden" name="start_event" id="start_event" value=""> -->
        <div class="form-group">
          <input class="form-control" type="hidden" name="title" id="title" placeholder="Title">
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="time">Date</label><br>
            <input type="text" name="date" id="calDate" required>
          </div>
          <div class="form-group col-md-6">
            <label for="time">Time</label><br>
            <input type="time" name="time" id="time" value="00:00:00">
          </div>
        </div>
        <h3>Client Details:</h3>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="area">Branch Area</label><br>
            <input id="calArea" name="area" class="form-control" >
          </div>
          <div class="form-group col-md-6">
            <label for="client_id">Branch Name</label><br>
            <input type="hidden" id="client_id_modal" name="client_id_modal">
            <input id="calName" class="form-control" >
          </div>
        </div>
        <div class="form-group">
          
          <label for="serv_id">Service<span style="color:red; font-size: 20px;">*</span></label><br>
          <select name="serv_id" class="form-control" required>
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
            <input id="calBrand" name="device_brand" class="form-control" >
          </div> 
          <div class="form-group col-md-3">
            
            <label for="aircont">Aircon Type</label>
            <input type="hidden" id="aircon_id_modal" name="aircon_id_modal" class="form-control" >
            <input id="calType" class="form-control aircon" >
          </div> 
          <div class="form-group col-md-3">
            
            <label for="fcunos">Fcuno</label>
            <input type="hidden" name="fcu[]" id="fcuno">
            <input id="calFcu" name="fcuno[]" class="form-control">
          </div> 
          <div class="form-group col-md-2">
            
            <label for="fcunos">Quantity</label>
            <input id="calQty" type="number" class="form-control" name="quantity" min="1" value="1" required>
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
    <div class="crud-text"><h3>Daily Call Logs</h3></div>
    <div class="d-flex">
        <a href="<?= base_url('calllogs/create/view') ?>" class="btn">Add Log</a>
    </div>
    <div class="event-header">
        <div class="card-body filter">
            <form action="<?= base_url("/calllogs/filtered"); ?>" method="GET">           
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
                            <button type="submit" class="btn btn-success" id="gen">Generate</button>
                        </div>
                        <div class="form-group">
                            <?php if(isset($_GET['start_date']) && isset($_GET['to_date'])): ?>
                            <a href="<?= base_url('/calllogs/filtered/print/'.$_GET['start_date']."/".$_GET['to_date'])?>" target="_blank" class="btn btn-success" id="dl">Print</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>         
        </form>
    </div>   
</div>
<div class="mt-3">
    <?php if($view_calllogs):?>
       <table class="table table-bordered" serv_id="users-list" id="table1" style="font-size: 11px;">
         <thead>
          <tr>
           <th>DATE</th>
           <th>Log Code</th>
           <th>BRANCH AREA</th>
           <th>BRANCH NAME</th>
           <th>CALLER</th>
           <th>PARTICULARS</th>
           <th>DEVICE BRAND</th>
           <th>AIRCON TYPE</th>
           <th>FCU No.</th>
           <th>QTY</th>
           <th>STATUS</th>
           <th>SCHEDULE</th>
           <th>ACTION</th>
       </tr>
   </thead>
   <tbody>
       
      <?php foreach($view_calllogs as $call_log):  ?>
          <tr>
           <td><?php echo $call_log->date; ?></td>
           <td><?php echo $call_log->log_code; ?></td>
           <td><?php echo $call_log->area; ?></td>
           <td><?php echo $call_log->client_branch; ?></td>
           <td><?php echo $call_log->caller; ?></td>
           <td><?php echo $call_log->particulars; ?></td>
           <td><?php echo $call_log->device_brand; ?></td>
           <td><?php echo $call_log->aircon_type; ?></td>
           <td>
             <?php $data1 = explode(',',$call_log->fcu_arr);
             $count1 = 0;
             ?>
             <?php foreach($data1 as $fc):  ?>
               <?php if($count1 < (count($data1) - 1) ):  ?>
                  <?php echo $fc; $count1+=1; ?> <br>
              <?php endif;  ?>
          <?php endforeach; ?>
      </td> 
      <td><?php echo $call_log->qty; ?></td>
      
      <td><?php echo $call_log->status; ?></td>
      <td>
       <a href="#" class="btn btn-primary btn-sm">View</a>
       <?php if($call_log->set_status != 1):?>
         <a href="#" id="<?php echo $call_log->cl_id; ?>" class="btn btn-warning btn-sm set_btn">Set</a>
       <?php endif;?>

   </td>
   <td>
    <?php if($call_log->set_status != 1):?>
       <a href="<?php echo base_url('/calllogs/'.$call_log->cl_id);?>" class="btn btn-primary btn-sm">Edit</a>
       <a href="<?php echo base_url('/calllogs/delete/'.$call_log->cl_id);?>" class="btn btn-danger btn-sm del">Delete</a>
    <?php else:?>
        <h6>Scheduled</h6>
        <a href="#" id="<?= $call_log->log_code?>" class="btn btn-secondary btn-sm cancel">Cancel</a>
    <?php endif;?>
   </td>
   
</tr>
<?php endforeach; ?>

</tbody>
</table>
<?php else: ?>
    <h1>No Call Logs</h1>
<?php endif; ?>
</div>
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
     del = 'Log is Deleted Successfully';
 <?php }elseif(session()->has('add')){?>
     add = true;
     del = 'New Log is Added Successfully';
 <?php }elseif(session()->has('update')){?>
     update = true;
     del = 'Log Details are Updated Successfully';
     <?php }?>;

$('#mymodal .selectpicker').selectpicker();
      $(document).on('click','.set_btn',function(e){
        var clId = e.target.id;
        var myModal = new bootstrap.Modal(document.getElementById('mymodal'));

        // alert(clId);
        $.ajax({
             method:"POST",
             url:"http://localhost/tsms/calllogs/set-Calllogs",
             data: {
                'cl_id': clId
             },
              success: function(response){
                var clId = response.cl_data.cl_id;
                var date = response.cl_data.date;
                var client = response.cl_data.client_id;
                var logCode = response.cl_data.log_code;
                var aircon = response.cl_data.aircon_id;
                var clientBranch;
                var clientArea;
                var airconBrand;
                var airconType;
                var clientLength = response.client.length;
                var airconLength = response.aircon.length;
                var fcuLength = response.fcu.length;
                var fcu = new Array();
                var fcuName = new Array();

                document.getElementById("cl_id").value = clId;
                document.getElementById("calDate").value = date;
                document.getElementById("client_id_modal").value = client;
                document.getElementById("aircon_id_modal").value = aircon;
                document.getElementById("log_code").value = logCode;

                for (var a = 0; a < clientLength; a++) {
                   if (client == response.client[a].client_id) {
                    // console.log('true');
                      clientArea = response.client[a].area;
                      clientBranch = response.client[a].client_branch;
                      
                   }
                 }; 
                document.getElementById("calArea").value = clientArea;
                document.getElementById("calName").value = clientBranch;
                for (var c = 0; c < airconLength; c++) {
                   if (aircon == response.aircon[c].aircon_id) {
                        airconBrand = response.aircon[c].device_brand;
                        airconType = response.aircon[c].aircon_type;
                    }
                 }; 
                document.getElementById("calBrand").value = airconBrand;
                document.getElementById("calType").value = airconType;

                for (var i = 0; i < fcuLength; i++) {
                   fcu.push(response.fcu[i].fcuno);
                 }; 
                for (var d = 0; d < fcuLength; d++) {
                   fcuName.push("FCU "+response.fcu[d].fcuno);
                }; 
                document.getElementById("fcuno").value = fcu;
                document.getElementById("calFcu").value =fcuName;
                console.log(log_code);
                console.log(response);
                myModal.show();
              }
        });
      });

      //cancel
      $(document).on('click','.cancel', function(e){
        var logCode = e.target.id;


        Swal.fire({
          title: 'Cancel the schedule of this Log??',
          // showDenyButton: true,
          showCancelButton: true,
          confirmButtonText: 'Yes',
          // denyButtonText: `Don't Cancel`,
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            // Swal.fire('Saved!', '', 'success')
            // alert(logCode);
            $.ajax({
             method:"POST",
             url:"http://localhost/tsms/calllogs/cancel",
             data: {
                'log_code': logCode
             },
              success: function(response){
                console.log(response);

              }
            });
            location.reload();
          }
        })
      })

 </script>
 <script type="text/javascript" src="<?= base_url('assets/js/crud.js')?>"></script>