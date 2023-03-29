<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<div class="body-content" style="width: 100%">
   <div class="crud-text"> <h3>Client</h3></div>

   <div class="d-flex justify-content-left">
    <a href="<?= base_url('client/create/view') ?>" class="btn">Add Client</a>
    <a href="<?= base_url('client/print') ?>" target="_blank" class="btn">Print</a>
 </div>
 
 <div class="col-12 col-lg-12 col-md-12 col-sm-12 mt-3">
    <table class="table table-bordered" client_id="client-list" id="example" style="width: 100%">
     <thead>
        <tr>
           <th>#</th>
           <th>Branch Area</th>
           <th>Branch Name</th>
           <th>Address</th>
           <th>Email</th>
           <th>Contact</th>
           <th>Unique Code</th>
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
                 <td><?php echo $client['code']; ?></td>
                 <td>
                   <a href="<?php echo base_url('/client/'.$client['client_id']);?>" class="btnn btn btn-primary border-0 btn-sm"><i class="fas fa-edit"></i></a>
                   <a href="<?php echo base_url('/client/delete/'.$client['client_id']);?>" class="btn btn-danger btn-sm del"><i class="fas fa-trash"></i></a>
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
<script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
   var table = $('#example').DataTable( {
         responsive: true
   } );
} );
</script>

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