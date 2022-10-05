<div class="body-content">
       <div class="crud-text"><h1>Services</h1></div>
    <div class="d-flex">
        <a href="<?= base_url('serv/create/view') ?>" class="btn">Add Service</a>
        <a href="<?= base_url('serv/print') ?>" target="_blank" class="btn">Print</a>
   </div>
    <!--  -->
  <div class="mt-3">
     <table class="table table-bordered" serv_id="users-list" id="table1">
       <thead>
          <tr>
             <th>#</th>
             <th>Service Name</th>
             <th>Service Type</th>
             <th>Price</th>
             <th>Color</th>
             <th>Action</th>
          </tr>
       </thead>
       <tbody>
          <?php if($services): $n = 1;?>
          <?php foreach($services as $service):  ?>
          <tr>
             <td><?php echo $n ?></td>
             <td><?php echo $service['serv_name']; ?></td>
             <td><?php echo $service['serv_type']; ?></td>
             <td><?php echo $service['price']; ?></td>
             <td style="background-color:<?php echo $service['serv_color']; ?>"></td>
             <td>
                 <a href="<?php echo base_url('/serv/'.$service['serv_id']);?>" class="btn btn-primary btn-sm">Edit</a>
                 <a href="<?php echo base_url('/serv/delete/'.$service['serv_id']);?>" class="btn btn-danger btn-sm del">Delete</a>
             </td>
          </tr>
          <?php $n=$n+1; endforeach; ?>
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
  var msg = ''; 
  var del = '';
  var add = '';
  var update = '';
  <?php if(session()->has('msg')){?>
   msg = true;
   del = 'Service is Deleted Successfully';
  <?php }elseif(session()->has('add')){?>
   add = true;
   del = 'New Service is Added Successfully';
  <?php }elseif(session()->has('update')){?>
   update = true;
   del = 'Service Details are Updated Successfully';
  <?php }?>;
</script>
<script type="text/javascript" src="<?= base_url('assets/js/crud.js')?>"></script>