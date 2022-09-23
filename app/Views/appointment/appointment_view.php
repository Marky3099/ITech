<div class="body-content">
	<div class="crud-text"> <h1>Schedule Appointment</h1></div>

    <div class="d-flex justify-content-left">
        <a href="<?=base_url("/appointment/create")?>" class="btn">Add Appointment</a>
   </div>
<!--     <?php
     if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
      }
     ?> -->
     <?php 
        // Display Response
        if(session()->has('message')){
        ?>
           <div class="alert <?= session()->getFlashdata('alert-class') ?>">
              <?= session()->getFlashdata('message') ?>
           </div>
        <?php
        }
        ?>
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
              <a href="#" class="btn btn-primary btn-sm">Edit</a>
              <a href=#>Delete</a>
              </td>
          </tr>
          <?php endforeach; ?>
       </tbody>
     </table>
     <?php else: ?>
        <h1>No Appointmeent Yet!</h1>
      <?php endif; ?>
  </div>
</div>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
$(document).ready( function () {
    $('#table1').DataTable();
} );
</script>
