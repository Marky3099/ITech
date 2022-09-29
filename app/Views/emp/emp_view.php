<div class="body-content">
      <div class="crud-text"><h1>Employee</h1></div>
    <div class="d-flex justify-content-left">
        <a href="<?= base_url('emp/create/view') ?>" class="btn">Add Employee</a>
        <a href="<?= base_url('emp/print') ?>" class="btn">Download</a>
   </div>
    <?php
     if(isset($_SESSION['success'])){
        echo $_SESSION['success'];
      }
     ?>
  <div class="mt-3">
     <table class="table table-bordered" emp_id="users-list" id="table1">
       <thead>
          <tr>
             <th>Employee #</th>
             <th>Name</th>
             <th>Email</th>
             <th>Address</th>
             <th>Contact</th>
             <th>Position</th>
             <th>Action</th>
          </tr>
       </thead>
       <tbody>
          <?php if($employees): $c = 1;?>
          <?php foreach($employees as $employee):  ?>
          <tr>
             <td><?php echo $c ?></td>
             <td><?php echo $employee['emp_name']; ?></td>
             <td><?php echo $employee['emp_email']; ?></td>
             <td><?php echo $employee['emp_address']; ?></td>
             <td><?php echo $employee['emp_contact']; ?></td>
             <td><?php echo $employee['emp_position']; ?></td>
             <td>
              <a href="<?php echo base_url('/emp/'.$employee['emp_id']);?>" class="btn btn-primary btn-sm">Edit</a>
              <a href="<?php echo base_url('/emp/delete/'.$employee['emp_id']);?>" class="btn btn-danger btn-sm del">Delete</a>
              </td>
          </tr>
         <?php  $c=$c+1;
     endforeach; ?>
         <?php endif; ?>
       </tbody>
     </table>
  </div>
</div>
</div>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">

 $('.del').click(function(e){
    e.preventDefault();
    const href = $(this).attr('href');
    Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            document.location.href = href;
            Swal.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            )
          }
        })

 })
$(document).ready( function () {
    $('#table1').DataTable({
    pageLength : 5,
    lengthMenu: [[5, 10, 15,20], [5, 10, 15, 20,]]
  });
} );
</script>