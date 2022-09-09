<div class="body-content">
    <div class="crud-text"><h1>Users</h1></div>
    <div class="d-flex justify-content-left">
        <a href="<?= base_url('user/create/view') ?>" class="btn">Add User</a>
        <a href="<?= base_url('user/print') ?>" class="btn">Download</a>
   </div>
    <?php
     if(isset($_SESSION['success'])){
        echo $_SESSION['success'];
      }
     ?>
  <div class="mt-3">
     <table class="table table-bordered" user_id="users-list" id="table1">
       <thead>
          <tr>
             <th>User ID</th>
             <th>User Name</th>
             <th>Email Address</th>
             <th>Address</th>
             <th>Contact Number</th>
             <th>Role</th>
             <th>Status</th>
             <th>Action</th>
          </tr>
       </thead>
       <tbody>
          <?php if($users): ?>
          <?php foreach($users as $user):  
                  if($user['name'] != $_SESSION['username'] ):
            ?>
          <tr>
             <td><?php echo $user['user_id']; ?></td>
             <td><?php echo $user['name']; ?></td>
             <td><?php echo $user['email']; ?></td>
             <td><?php echo $user['address']; ?></td>
             <td><?php echo $user['contact']; ?></td>
             <td><?php echo $user['position']; ?></td>
             <td><?php if($user['active'] == 1): ?>
                <p style="color:green; font-weight: bold"><?= "Active";?></p>
            <?php else:?>
                <p style="color:red; font-weight: bold"><?= "Not Active";?></p>
                 <?php endif;?>
             </td>
             
             <td>
                 <a href="<?php echo base_url('/user/'.$user['user_id']);?>" class="btn btn-primary btn-sm">Edit</a>
                 <a href="<?php echo base_url('/user/delete/'.$user['user_id']);?>" class="btn btn-danger btn-sm">Delete</a>
             </td>
          </tr>
          <?php endif; ?>
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
    $('#table1').DataTable();
} );
</script>