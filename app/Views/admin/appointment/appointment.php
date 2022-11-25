

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



<div class="body-content">
   <div class="crud-text"> <h1>Appointment</h1></div>

  <!-- <div class="d-flex justify-content-left">
    <a href="<?=base_url("/appointment/create")?>" class="btn">Add Appointment</a>
 </div> -->
 <div class="mt-3">
   <?php if($view_appoint):?>
    <table class="table table-bordered" id="table1">
     <thead>
        <tr>
           <th>Date</th>
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
        <tr>
           <td><?php echo $appt->appt_date; ?></td>
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
             <a href="#" id="<?php echo $appt->appt_id; ?>" class="btn btn-primary btn-sm set_btn">Set</a>
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

   $(document).on('click','.set_btn',function(e){
      var apptId = e.target.id;
      
      $.ajax({
         method:"POST",
         url:"http://localhost/tsms/appointment/set-Appointment",
         data: {
            'appt_id': apptId
         },
         success: function(response){
            console.log(response);
         }
      });
   });

   </script>
   <script type="text/javascript" src="<?= base_url('assets/js/crud.js')?>"></script>
