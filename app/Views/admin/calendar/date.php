<link rel="stylesheet" href="<?= base_url('assets/css/style.css')?>">
<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
<div class="body-content" style="width: 100%;">
   <div class="event-header">
     <h3 id="mod" class="mt-2 headerfont"><b>Restrict Date</b></h3>
     
     <div class="d-flex justify-content-left" style="margin-left:60px;">
         <a href="<?= base_url('/calendar');?>" class="btn">Calendar</a>
        <a href="<?= base_url('/calendar/dates-form') ?>" class="btn">Add Restriction   </a><br>
      </div>
    
   </div>
    <div class="col-12 col-lg-12 col-md-12 col-sm-12 mt-3 bg-light" style=" padding:10px;">
      <?php if($dates): ?>
         <table class="table table-bordered" id="example" style="width: 100%;">
           <thead>
              <tr>
                 <th>Date</th>
                 <th>Description</th>
                 <th>Action</th>
                 
              </tr>
           </thead>
           <tbody>

               <?php foreach($dates as $d):  ?>
                  <tr>
                     <td><?= $d['date'];?></td>
                     <td><?= $d['description'];?></td>
                     <td><a href="<?= base_url('/calendar/dates-edit-form/'.$d['date_id'])?>" class="btnn btn btn-primary border-0 btn-sm"><i class="fas fa-edit"></i></a>
                     <a href="<?= base_url('/calendar/dates-delete/'.$d['date_id'])?>" class="btn btn-danger btn-sm del"><i class="fas fa-trash"></i></a></td>
                  </tr>
               <?php endforeach; ?>
            </tbody>
         </table>
      <?php else: ?>
         <h3 style="text-align:center;">No Restricted Date!</h3>
      <?php endif; ?>
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
      del = 'Restricted Date is Deleted Successfully';
   <?php }elseif(session()->has('add')){?>
      add = true;
      del = 'New Restricted Date is Added Successfully';
   <?php }elseif(session()->has('update')){?>
      update = true;
      del = 'Restricted Date is Updated Successfully';
      <?php }?>;
</script>
<script type="text/javascript" src="<?= base_url('assets/js/crud.js')?>"></script>