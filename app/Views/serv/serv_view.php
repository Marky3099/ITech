<div class="body-content">
       <div class="crud-text"><h1>Services</h1></div>
    <div class="d-flex">
        <a href="<?= base_url('serv/create/view') ?>" class="btn">Add Service</a>
        <a href="<?= base_url('serv/print') ?>" class="btn">Download</a>
   </div>
    <?php
     if(isset($_SESSION['success'])){
        echo $_SESSION['success'];
      }
     ?>
  <div class="mt-3">
     <table class="table table-bordered" serv_id="users-list" id="table1">
       <thead>
          <tr>
             <th>Service ID</th>
             <th>Service Name</th>
             <th>Price</th>
             <th>Color</th>
             <th>Action</th>
          </tr>
       </thead>
       <tbody>
          <?php if($services): ?>
          <?php foreach($services as $service):  ?>
          <tr>
             <td><?php echo $service['serv_id']; ?></td>
             <td><?php echo $service['serv_name']; ?></td>
             <td><?php echo $service['price']; ?></td>
             <td style="background-color:<?php echo $service['serv_color']; ?>"></td>
             <td>
                 <a href="<?php echo base_url('/serv/'.$service['serv_id']);?>" class="btn btn-primary btn-sm">Edit</a>
                 <a href="<?php echo base_url('/serv/delete/'.$service['serv_id']);?>" class="btn btn-danger btn-sm">Delete</a>
             </td>
          </tr>
          <?php endforeach; ?>
         <?php endif; ?>
       </tbody>
     </table>
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