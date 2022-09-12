<div class="body-content">
       <div class="crud-text"><h1>Daily Call Logs</h1></div>
    <div class="d-flex">
        <a href="<?= base_url('calllogs/create/view') ?>" class="btn">Add Log</a>
   </div>
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
                              <button type="submit" class="btn btn-success" id="sub">Generate</button>
                           </div>
                           <div class="form-group">
                              <?php if(isset($_GET['start_date']) && isset($_GET['to_date'])): ?>
                              <a href="<?= base_url('/calllogs/filtered/print/'.$_GET['start_date']."/".$_GET['to_date'])?>" target="_blank" class="btn btn-success" id="print">Download</a>
                              <?php endif; ?>
                           </div>
                        </div>
                     </div>
                  
                  </form>
               </div>   
    <?php
     if(isset($_SESSION['success'])){
        echo $_SESSION['success'];
      }
     ?>
  <div class="mt-3">
    <?php if($view_calllogs):?>
     <table class="table table-bordered" serv_id="users-list" id="table1" style="font-size: 11px;">
       <thead>
          <tr>
             <th>DATE</th>
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
                 <a href="#" class="btn btn-warning btn-sm">Set</a>
             </td>
             <td>
                 <a href="<?php echo base_url('/calllogs/'.$call_log->cl_id);?>" class="btn btn-primary btn-sm">Edit</a>
                 <a href="<?php echo base_url('/calllogs/delete/'.$call_log->cl_id);?>" class="btn btn-danger btn-sm">Delete</a>
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

<script type="text/javascript">
$(document).ready( function () {
    $('#table1').DataTable();
} );
</script>