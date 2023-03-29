<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<div class="body-content" style="width: 100%">
   <div class="crud-text"><h3>Technicians</h3></div>
   <div class="d-flex justify-content-left">
    <a href="<?= base_url('emp/create/view') ?>" class="btn">Add Technician</a>
    <a href="<?= base_url('emp/print') ?>" target="_blank" class="btn">Print</a>
 </div>
 <div class="col-12 col-lg-12 col-md-12 col-sm-12 mt-3">
    <table class="table table-bordered" emp_id="users-list" id="example" style="width: 100%">
     <thead>
        <tr>
           <th>#</th>
           <th>Name</th>
           <th>Email</th>
           <th>Address</th>
           <th>Contact</th>
           <th>Expertise</th>
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
                 <td>
                    <?php foreach($expertise as $exp){
                      if($employee['emp_id'] == $exp['emp_id']){
                        echo $exp['serv_name']."<br>";
                      }
                    }?>
                 </td>
                 <td>
                   <a href="<?php echo base_url('/emp/'.$employee['emp_id']);?>" class="btnn btn btn-primary border-0 btn-sm"><i class="fas fa-edit"></i></a>
                   <a href="<?php echo base_url('/emp/delete/'.$employee['emp_id']);?>" class="btn btn-danger btn-sm del"><i class="fas fa-trash"></i></a>
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
      del = 'Employee is Deleted Successfully';
   <?php }elseif(session()->has('add')){?>
      add = true;
      del = 'New Employee is Added Successfully';
   <?php }elseif(session()->has('update')){?>
      update = true;
      del = 'Employee Details are Updated Successfully';
      <?php }?>;
   </script>
   <script type="text/javascript" src="<?= base_url('assets/js/crud.js')?>"></script>
