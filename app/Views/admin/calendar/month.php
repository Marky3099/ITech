<div class="body-content">
   <div class="event-header">
     <h1 id="mod"><b>Monthly Scheduled Tasks - <?= date('F Y');?></b></h1>
     
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
              <th>Event Title</th>
              <th>Date</th>
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
                 <td>
                  <?php if($m->title == NULL): ?>
                     <?php echo "N/A"; ?>
                  <?php else:?>
                     <?php echo $m->title; ?>
                  <?php endif;?>
               </td>
               <td><?php echo date('m-d-Y',strtotime($m->start_event)); ?></td>
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
                  <?php $data= explode(',',$m->device_array);
                  $count = 0;
                  ?>
                  <?php foreach($data as $device):  ?>
                     <?php if($count < (count($data) - 1) ):  ?>
                       <?php echo $device; $count+=1; ?> <br>
                    <?php endif;  ?>
                 <?php endforeach; ?>
              </td>
              <td>
               <?php $data= explode(',',$m->aircon_array);
               $count = 0;
               ?>
               <?php foreach($data as $aircon):  ?>
                  <?php if($count < (count($data) - 1) ):  ?>
                    <?php echo $aircon; $count+=1; ?> <br>
                 <?php endif;  ?>
              <?php endforeach; ?>
           </td>
               <td>
                  <?php $data1 = explode(',',$m->fcu_array);
                  $count1 = 0;
                  ?>
                  <?php foreach($data1 as $fc):  ?>
                     <?php if($count1 < (count($data1) - 1) ):  ?>
                       <?php echo $fc; $count1+=1; ?> <br>
                    <?php endif;  ?>
                 <?php endforeach; ?>
              </td> 
              <td>
                  <?php $data = explode(',',$m->quantity_array);
                  $count = 0;
                  ?>
                  <?php foreach($data as $quantity):  ?>
                     <?php if($count < (count($data) - 1) ):  ?>
                       <?php echo $quantity; $count+=1; ?> <br>
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