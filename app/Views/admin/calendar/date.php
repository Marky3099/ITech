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
                     <td><a href="<?= base_url('/calendar/dates-edit-form/'.$d['date_id'])?>" class="btn btn-info btn-sm view">Edit</a>
                     <a href="<?= base_url('/calendar/dates-delete/'.$d['date_id'])?>" class="btn btn-danger btn-sm view">Delete</a></td>
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

<script type="text/javascript">

   $(document).ready( function () {
     $('#table1').DataTable({
        pageLength : 5,
        lengthMenu: [[5, 10, 15,20], [5, 10, 15, 20,]]
     });
  } );
</script>