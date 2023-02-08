<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<div class="body-content">
	<div class="crud-text"> <h3>Aircon Details</h3></div>

  <div class="d-flex justify-content-left">
    <a href="<?= base_url('/aircon/create/view');?>" class="btn">Add Aircon</a>
    
 </div>
 <div class="mt-3">
    <table class="table table-bordered" client_id="aircon-list" id="table1">
     <thead>
        <tr>
           <th>ID</th>
           <th>Aircon Brand</th>
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
                   <a href="<?php echo base_url('/aircon/'.$devices['aircon_id']);?>" class="btnn btn btn-primary border-0 btn-sm">Edit</a>
                   <a href="<?php echo base_url('/aircon/delete/'.$devices['aircon_id']);?>" class="btn btn-danger btn-sm del">Delete</a>
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
   var msg = ''; 
   var del = '';
   var add = '';
   var update = '';
   <?php if(session()->has('msg')){?>
      msg = true;
      del = 'Aircon is Deleted Successfully';
   <?php }elseif(session()->has('add')){?>
      add = true;
      del = 'New Aircon is Added Successfully';
   <?php }elseif(session()->has('update')){?>
      update = true;
      del = 'Aircon Details are Updated Successfully';
      <?php }?>;
   </script>
   <script type="text/javascript" src="<?= base_url('assets/js/crud.js')?>"></script>