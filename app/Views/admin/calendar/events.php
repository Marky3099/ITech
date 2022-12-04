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
<div class="col-sm-12 mt-3 bg-light" style=" padding:10px; ">
   <?php if($event): ?>
      <table class="table table-bordered table-hover" id="table1">
        <thead>
           <tr>
              <th>Date</th>
              <th>Task Code</th>
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
   </script>
   <script type="text/javascript" src="<?= base_url('assets/js/crud.js')?>"></script>