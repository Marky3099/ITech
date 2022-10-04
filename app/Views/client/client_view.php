<div class="body-content">
   <div class="crud-text"> <h1>Client</h1></div>

    <div class="d-flex justify-content-left">
        <a href="<?= base_url('client/create/view') ?>" class="btn">Add Client</a>
        <a href="<?= base_url('client/print') ?>" class="btn">Download</a>
   </div>
   
  <div class="mt-3">
     <table class="table table-bordered" client_id="client-list" id="table1">
       <thead>
          <tr>
             <th>#</th>
             <th>Branch Area</th>
             <th>Branch Name</th>
             <th>Address</th>
             <th>Email</th>
             <th>Contact</th>
             <th>Action</th>
          </tr>
       </thead>
       <tbody>
          <?php if($clients): $c = 1;?>
          <?php foreach($clients as $client):  ?>
          <tr>
             <td><?php echo $c ?></td>
             <td><?php echo $client['area']; ?></td>
             <td><?php echo $client['client_branch']; ?></td>
             <td><?php echo $client['client_address']; ?></td>
             <td><?php echo $client['client_email']; ?></td>
             <td><?php echo $client['client_contact']; ?></td>
             <td>
              <a href="<?php echo base_url('/client/'.$client['client_id']);?>" class="btn btn-primary btn-sm">Edit</a>
              <a href="<?php echo base_url('/client/delete/'.$client['client_id']);?>" class="btn btn-danger btn-sm del">Delete</a>
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
   var msg = ''; 
  var del = '';
  var add = '';
  var update = '';
  <?php if(session()->has('msg')){?>
   msg = true;
   del = 'Client is Deleted Successfully';
  <?php }elseif(session()->has('add')){?>
   add = true;
   del = 'New Client is Added Successfully';
  <?php }elseif(session()->has('update')){?>
   update = true;
   del = 'Client Details are Updated Successfully';
  <?php }?>;
</script>
<script type="text/javascript" src="<?= base_url('assets/js/crud.js')?>"></script>