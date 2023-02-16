<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="<?= base_url('assets/css/style.css')?>">
<div class="body-content"  style="width: 100%;">
  <div class="crud-text" style="width: 100%"><h3>Services</h3></div>
  <div class="d-flex">
    <a href="<?= base_url('serv/create/view') ?>" class="btn">Add Service</a>
    <a href="<?= base_url('serv/print') ?>" target="_blank" class="btn">Print</a>
 </div>
 <!--  -->
 <div class="col-12 col-lg-12 col-md-12 col-sm-12 mt-3">
    <table class="table table-bordered" serv_id="users-list" id="example" style="width: 100%">
     <thead>
        <tr>
           <th>ID</th>
           <th>Service Name</th>
           <th>Service Type</th>
<!--            <th>Aircon Brand</th>
           <th>Aircon Type</th> -->
           <th>Price</th>
           <th>Color</th>
           <th>Action</th>
        </tr>
     </thead>
     <tbody style= "width: 100%">
        <?php if($services): $n = 1;?>
           <?php foreach($services as $service):  ?>
              <tr>
                 <td><?php echo $n ?></td>
                 <td><?php echo $service['serv_name']; ?></td>
                 <td><?php echo $service['serv_type']; ?></td>
                 <!-- <td>
                  n/a
                  </td>
                 <td>
                  n/a
                 </td> -->
                 <td><?php echo $service['price']; ?></td>
                 <td style="background-color:<?php echo $service['serv_color']; ?>"></td>
                 <td>
                   <a href="<?php echo base_url('/serv/'.$service['serv_id']);?>" class="btnn btn btn-primary border-0 btn-sm">Edit</a>
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
<script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script>
$(document).ready(function() {
   var table = $('#example').DataTable( {
         responsive: true
   } );
} );
</script>

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