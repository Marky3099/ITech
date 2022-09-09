<div class="body-content">
	<div class="crud-text"> <h1>Aircon Details</h1></div>

    <div class="d-flex justify-content-left">
        <a href="<?= base_url('/aircon/create/view');?>" class="btn">Add Brand</a>
        <a href="<?= base_url('/calendar');?>" class="btn">Calendar</a>
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
     <table class="table table-bordered" client_id="aircon-list" id="table1">
       <thead>
          <tr>
             <th>Aircon ID</th>
             <th>Device Brand/Type</th>
             <th>Aircon Type</th>
             <th>Action</th>
          </tr>
       </thead>
       <tbody>
          <?php if($device): $d = 1;?>
          <?php foreach($device as $devices):  ?>
          <tr>
             <td><?php echo $d ?></td>
             <td><?php echo $devices['device_brand']; ?></td>
             <td><?php echo $devices['aircon_type']; ?></td>
             <td>
              <a href="<?php echo base_url('/aircon/'.$devices['aircon_id']);?>" class="btn btn-primary btn-sm">Edit</a>
              <a href="<?php echo base_url('/aircon/delete/'.$devices['aircon_id']);?>" class="btn btn-danger btn-sm">Delete</a>
              </td>
          </tr>
         <?php  $d=$d+1;
     endforeach; ?>
         <?php endif; ?>
       </tbody>
     </table>
  </div>
</div>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
$(document).ready( function () {
    $('#table1').DataTable();
} );
</script>
