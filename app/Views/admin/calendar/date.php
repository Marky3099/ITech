<link rel="stylesheet" href="<?= base_url('assets/css/style.css')?>">

<div class="body-content">
   <div class="event-header">
     <h3 id="mod" class="mt-2 headerfont"><b>Restrict Date</b></h3>
     
     <div class="d-flex justify-content-left" style="margin-left:20px;">
         <a href="<?= base_url('/calendar');?>" class="btn">Calendar</a>
        <a href="<?= base_url('/calendar/dates-form') ?>" class="btn" style="margin-left: 0.2rem;">Add Restriction   </a><br>
      </div>
    
   </div>
    <div class="col-sm-12 mt-3 bg-light" style=" padding:10px;">
      <?php if($dates): ?>
         <table class="table table-bordered" id="table1">
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
                     <td><a href="<?= base_url('/calendar/dates-edit-form/'.$d['date_id'])?>" class="btn btn-info btn-sm">Edit</a>
                     <a href="<?= base_url('/calendar/dates-delete/'.$d['date_id'])?>" class="btn btn-danger btn-sm del">Delete</a></td>
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