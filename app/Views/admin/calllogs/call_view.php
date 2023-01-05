<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<link rel="stylesheet" href="<?= base_url('assets/css/style.css')?>">
<link rel="stylesheet" href="<?= base_url('assets/css/main.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/select2.css')?>">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">



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
                    <th>Log Code:</th>
                    <td id="modal_log_code"></td>
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
                    <th>Caller:</th>
                    <td id="modal_caller"></td>
                  </tr>
                  <tr>
                    <th>Particulars:</th>
                    <td id="modal_particulars"></td>
                  </tr>
              </table>
            </div>
           <div class="col-md-6">
            <table class="table-hover" style="width:100%">
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
        <div class="crud-text"><h5>Client Details:</h5></div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="time">Date</label><br>
            <input type="text" name="date" id="calDate" required>
          </div>
          <div class="form-group col-md-6">
            <label for="time">Time<span style="color:red; font-size: 20px;">*</span></label><br>
            <input type="time" name="time" id="time" value="00:00:00">
          </div>
        </div>
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
          
          <label class="serv_idlblll" for="serv_id">Service<span style="color:red; font-size: 20px;">*</span></label><br>
          <div class="select-dropdown" id="serv-select1">
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
        </div><br>
        <div class="crud-text"><h5>Aircon Details:</h5></div>
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
          
          <label class="ml-5" for="emp_id">Employee<span style="color:red; font-size: 20px;">*</span></label><br>
          <select id="emp_id" name="emp_id[]" class="form-control w-75 ml-5 selectpicker border border-dark" multiple data-selected-text-format="count > 8" required>
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
      <form action="<?= base_url('/calllogs/filtered');?>" method="GET">
         <div class="row">
            <div class="mt-2 col-lg-2">
               <div class="form-group">
                  <label>Start Date:</label><br>
                  <input type="date" name="start_date" class="form-control border border-default" value="<?php if(isset($_GET['start_date'])){echo $_GET['start_date'];} ?>" required>
               </div>
            </div>
            <div class="mt-2 col-lg-2">
               <div class="form-group">
                  <label>To Date:</label><br>
                  <input type="date" name="to_date" class="form-control border border-default" value="<?php if(isset($_GET['to_date'])){echo $_GET['to_date'];} ?>" required>
               </div>
            </div>
            
            
               <div class="col-lg-2 advance-filter">
                     <select name="caller_filter" class="form-control">
                        <option selected disabled value="">Caller</option>
                        <?php foreach($caller as $call):  ?>
                          <?php if(isset($_GET['caller_filter'])):?>
                            <?php if($_GET['caller_filter'] == $call['caller']):?>
                              <option value="<?php echo $call['caller'];?>" selected><?php echo $call['caller'];?></option>
                            <?php else:?>
                              <option value="<?php echo $call['caller'];?>"><?php echo $call['caller'];?></option>
                            <?php endif;?>
                          <?php else:?>
                            <option value="<?php echo $call['caller'];?>"><?php echo $call['caller'];?></option>
                          <?php endif;?>
                        <?php endforeach; ?>
                     </select>
                  </div>
                  <div class="col-lg-2 advance-filter">
                     <select name="clientArea" id="area" class="form-control">
                        <option selected disabled value="">Client Area</option>
                        <?php foreach($area as $cl):  ?>
                           <?php if(isset($_GET['client_id'])):?>
                              <?php if($cbranch['area'] == $cl['area']):?>
                                 <option value=<?php echo $cl['area']; ?> selected><?php echo $cl['area'];?></option>
                              <?php else:?>
                                 <option value=<?php echo $cl['area']; ?>><?php echo $cl['area'];?></option>
                              <?php endif;?>
                              <?php else:?>
                                 <option value=<?php echo $cl['area']; ?>><?php echo $cl['area'];?></option>
                           <?php endif;?>
                           
                        <?php endforeach; ?>
                     </select>
                  </div>
                  <div class="col-lg-2 advance-filter">
                     <select name="client_id" id="client_id" class="form-control">
                        <option selected disabled value="">Branch Name</option>
                     </select>
                  </div>
            
            <div class="col-lg-1">
               <div class="form-group">
                  <button type="submit" class="btn mb-1 btn-success" id="sub">Generate</button>
                  <a href="<?= base_url('calllogs') ?>" type="button" class="btn btn-secondary">Reset</a>
               </div>
            </div>
         
            <div class="col-lg-1">
               <div class="form-group">
                  <!-- <button type="button" class="btn btn-info" id="sub1">Advance</button> -->
                  <?php if(isset($_GET['start_date']) && isset($_GET['to_date']) && !isset($_GET['caller_filter']) && !isset($_GET['client_id'])): ?>
                     <?php $caller_filter = '""'?>
                     <?php $client_id = '""'?>
                     <a href="<?= base_url('/calllogs/filtered/print/'.$_GET['start_date']."/".$_GET['to_date']."/".$caller_filter."/".$client_id)?>" target="_blank" class="btn btn-info" id="print">Print</a>
                  <?php elseif(isset($_GET['start_date']) && isset($_GET['to_date']) && isset($_GET['caller_filter']) && isset($_GET['client_id'])):?>
                     <a href="<?= base_url('/calllogs/filtered/print/'.$_GET['start_date']."/".$_GET['to_date']."/".$_GET['caller_filter']."/".$_GET['client_id'])?>" target="_blank" class="btn btn-info" id="print">Print</a>
                  <?php elseif(isset($_GET['start_date']) && isset($_GET['to_date']) && isset($_GET['caller_filter']) && !isset($_GET['client_id'])):?>
                     <?php $client_id = '""'?>
                     <a href="<?= base_url('/calllogs/filtered/print/'.$_GET['start_date']."/".$_GET['to_date']."/".$_GET['caller_filter']."/".$client_id)?>" target="_blank" class="btn btn-info" id="print">Print</a>
                  <?php elseif(isset($_GET['start_date']) && isset($_GET['to_date']) && !isset($_GET['caller_filter']) && isset($_GET['client_id'])):?>
                     <?php $caller_filter = '""'?>
                     <a href="<?= base_url('/calllogs/filtered/print/'.$_GET['start_date']."/".$_GET['to_date']."/".$caller_filter."/".$_GET['client_id'])?>" target="_blank" class="btn btn-info" id="print">Print</a>   
                 
                     
                  <?php endif; ?>
               </div>
            </div>
          </div>
   </form>
</div>   

</div>
<div class="mt-3 mr-5">
    <?php if($view_calllogs):?>
       <table class="table stable-bordered table-hover" serv_id="users-list" id="event-table" style="font-size: 1rem;">
         <thead>
          <tr>
           <th>Date</th>
           <th>Log Code</th>
           <th>Status</th>
           <th>Action</th>
       </tr>
   </thead>
   <tbody>
       
      <?php foreach($view_calllogs as $call_log):  ?>
          <tr>
           <td><?php echo $call_log->date; ?></td>
           <td><?php echo $call_log->log_code; ?></td>
      
          <td><?php echo $call_log->status; ?></td>
         <td>
          <?php if($call_log->set_status != 1):?>
            <?php if($call_log->date >= $now):?>
              <a href="#" id="<?php echo $call_log->cl_id; ?>" class="btn btn-warning btn-sm set_btn">Set</a>
            <?php endif;?>
             <a href="<?php echo base_url('/calllogs/'.$call_log->cl_id);?>" class="btn btn-primary btn-sm">Edit</a>
             <a href="#" id="<?php echo $call_log->cl_id;?>" class="btn btn-info btn-sm view">View</a>
             <a href="<?php echo base_url('/calllogs/delete/'.$call_log->cl_id);?>" class="btn btn-danger btn-sm del">Delete</a>
          <?php else:?>
              <h6>Scheduled</h6>
              <a href="#" id="<?php echo $call_log->cl_id;?>" class="btn btn-info btn-sm view">View</a>
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
        console.log(logCode);

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
             type: "POST",
             url:"http://localhost/tsms/calllogs/cancel",
             data: {
                'log_code': logCode
             },
             dataType: 'json',
              success: function(response){
                console.log(response);

              },
            });
            location.reload();
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
         url: 'http://localhost/tsms/calllogs/view',
         data:{
            'cl_id': id
         },
         success: function(response){
          console.log(response);
            var date = new Date(response.cl_data.date);
            var startEvent = date.toLocaleDateString("en-US",(options));
            var apptCode = response.cl_data.log_code;
            var clientId = response.cl_data.client_id;
            var clientData = response.client_data;
            var area;
            var branch;
            var devBrand = response.cl_data.device_brand;
            var airconType = response.cl_data.aircon_type;
            var caller = response.cl_data.caller;
            var particulars = response.cl_data.particulars;
            var fcuNoArr = new Array();
            var fcuData = response.fcu_data;
            var fcuNo;
            var qty = response.cl_data.qty;
            var statusData = response.cl_data.status;

            $('#modalTitle').html("["+apptCode+"] Schedule");
            $('#modal_start_event').html(startEvent);
            $('#modal_log_code').html(apptCode);
            $('#modal_caller').html(caller);
            $('#modal_particulars').html(particulars);

             for (var a = 0; a < clientData.length; a++) {
                if(clientId == clientData[a].client_id){
                  area = clientData[a].area;
                  branch = clientData[a].client_branch;
                }
             }
             $('#modal_area').html(area);
             $('#modal_branch').html(branch);

            $('#modal_dev_brand').html(devBrand);
            $('#modal_aircon_type').html(airconType);

            for (var i = 0; i < fcuData.length; i++) {
              if(id == fcuData[i].cl_id){
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

var areas = <?php echo json_encode($client_area); ?> ;
var cId = <?php echo json_encode($cId); ?>;
var cBranch = <?php echo json_encode($cbranch); ?>;

 </script>
 <script type="text/javascript" src="<?= base_url('assets/js/filter.js')?>"></script>
 <script type="text/javascript" src="<?= base_url('assets/js/crud.js')?>"></script>