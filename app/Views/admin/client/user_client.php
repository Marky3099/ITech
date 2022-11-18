<div class="body-content">
 <div class="crud-text"> <h1>User Requests</h1></div>

    <!-- <div class="d-flex justify-content-left">
        <a href="<?= base_url('client/create/view') ?>" class="btn">Add Client</a>
        <a href="<?= base_url('client/print') ?>" class="btn">Download</a>
    </div> -->
    
    <div class="mt-3">
       <table class="table table-bordered" client_id="client-list" id="table1">
         <thead>
          <tr>
           <th>#</th>
           <th>First Name</th>
           <th>Last Name</th>
           <th>Email</th>
           <th>Contact</th>
           <th>Company</th>
           <th>Address</th>
           <th>Status</th>
           <th>Action</th>
       </tr>
   </thead>
   <tbody>
      <?php if($user): $c = 1;?>
          <?php foreach($user as $client):  ?>
              <tr>
               <td><?php echo $c ?></td>
               <td><?php echo $client['bdo_fname']; ?></td>
               <td><?php echo $client['bdo_lname']; ?></td>
               <td><?php echo $client['bdo_email']; ?></td>
               <td><?php echo $client['bdo_contact']; ?></td>
               <td><?php echo $client['bdo_company']; ?></td>
               <td><?php echo $client['bdo_address']; ?></td>
               <td><?php echo $client['status']; ?></td>
               <td>
                <select onchange="status_update(this.options[this.selectedIndex].value,'<?php echo $client['bdo_id']; ?>')">
                    <?php if ($client['status'] == 'Pending'):?>
                        <option value="Pending" selected>Pending</option>
                        <option value="Approved">Approved</option>
                    <?php elseif ($client['status'] == 'Approved'):?>
                        <option value="Pending">Pending</option>
                        <option value="Approved" selected>Approved</option>
                    <?php endif;?>
                </select>
            </td>
        </tr>
        <?php  $c=$c+1;
    endforeach; ?>
<?php endif; ?>
</tbody>
</table>
</div>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">

    function status_update(value,id){
        const uid = id;
        const val = value;
        
        document.location.href = 'client-users/'+uid+'/'+val;
    }
    <?php if(session()->getFlashdata('msg')) {?>
      const status =  '<?=$_SESSION['msg']?>';
      Swal.fire({
       icon: 'success',
       title: 'Updated Successfully!',
       text: 'The account status has been changed ['+status+'].',
       type: 'success'
   })
  <?php }?>

  $(document).ready( function () {
    $('#table1').DataTable({
        pageLength : 5,
        lengthMenu: [[5, 10, 15,20], [5, 10, 15, 20,]]
    });
} );
</script>