<link rel="stylesheet" href="<?= base_url('assets/css/style.css')?>">
<div class="body-content">
   <div class="event-header">
     <h3 id="mod" class="mt-2 headerfont"><b>Monthly Scheduled Tasks - <?= date('F Y');?></b></h3>
     
     <div class="d-flex justify-content-left" style="margin-left:20px;">
       <a href="<?= base_url('/calendar');?>" class="btn">Calendar</a>
       <a href="<?= base_url('/calendar/events');?>" class="btn">Scheduled Tasks</a>
       <a href="<?= base_url('/calendar/events/monthly/print');?>" target="_blank" class="btn">Print</a>
    </div>
    
 </div>
 <div class="col-sm-12 mt-3 bg-light" style=" padding:10px;">
   <?php if($month): ?>
      <table class="table table-bordered" id="table1">
        <thead>
           <tr>
              <th>Date</th>
              <th>Task Code</th>
              <th>Time</th>
              <th>Area</th>
              <th>Client Branch</th>
              <th>Service</th>
              <th>Service Type</th>
              <th>Device Brand</th>
              <th>Aircon Type</th>
              <th>FCU No.</th>
              <th>Qty</th>
              <th>Employee</th>
              <th>Status</th>
              
           </tr>
        </thead>
        <tbody>
           
           <?php foreach($month as $m):  ?>
              <tr>
               <td><?php echo date('m-d-Y',strtotime($m->start_event)); ?></td>
               <td><?php echo $m->event_code; ?></td>
               <td>
                  <?php if($m->time == "00:00:00"): ?>
                     <?php echo "N/A"; ?>
                  <?php else:?>
                     <?php echo $m->time; ?>
                  <?php endif;?>
               </td>
               <td><?php echo $m->area; ?></td>
               <td><?php echo $m->client_branch; ?></td>
               <td><?php echo $m->serv_name; ?></td>
               <td><?php echo $m->serv_type; ?></td>
                <td>
                <?php $current =''; ?>

               <?php foreach($distinct as $data):  ?>
                  <?php if($m->id ==  $data->id): ?>
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
                     <?php if($m->id ==  $data->id): ?>
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
                           <?php foreach($m->fcu_array as $fcu_data):  ?> 
                         

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
                     <?php if($m->id ==  $data->id): ?>
                      <?php if($current !=  $data->device_brand):  ?>
                        <?php echo  $data->quantity;  ?> <hr>
                        <?php $current =$data->device_brand; ?>
                     <?php endif;  ?>
                     <?php endif;  ?>
                 <?php endforeach; ?>
              </td> 
              <td>
               <?php $data = explode(',',$m->emp_array);
               $count = 0;
               ?>
               <?php foreach($data as $emp):  ?>
                  <?php if($count < (count($data) - 1) ):  ?>
                     * <?php echo $emp; $count+=1; ?> <br>
                  <?php endif;  ?>
               <?php endforeach; ?>
            </td> 
            <?php if($m->status == 'Pending'):?>
              <td style="color:#4F6FA6;"><b>
               <?php echo $m->status; ?>
            </b>
         </td>
      <?php else:?>
         <td><b>
            <?php echo $m->status; ?>
         </b>
      </td>
   <?php endif;?>
   
</tr>
<?php endforeach; ?>

</tbody>
</table>
<?php else: ?>
   <h3 style="text-align:center;">Ooops.. No work for this Month!</h3>
<?php endif; ?>
</div>
</div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
   $(document).ready( function () {
     $('#table1').DataTable({
        pageLength : 5,
        lengthMenu: [[5, 10, 15,20], [5, 10, 15, 20,]]
     });
  } );
</script>