<div class="body-content">
 <div class="crud-text"> <h1>Service Report Uploads</h1></div>

 <div class="d-flex justify-content-left">
  <a href="<?= base_url('service-reports/upload') ?>" class="btn">Upload File</a>
</div>
<div class="mt-3">
 <table class="table table-bordered" client_id="client-list" id="table1">
   <thead>
    <tr>
     <th>ID</th>
     <th>Title</th>
     <th>File</th>
     <th>Type</th>
     <th>Uploaded at</th>
     <th>Action</th>
   </tr>
 </thead>
 <tbody>
  <?php if($Upload): $u = 1;?>
    <?php foreach($Upload as $up):  ?>
      <tr >
       <td><?php echo $u ?></td>
       <td><?php echo $up['upload_title']; ?></td>
       <td align="center">
         <?php $data = explode('.', $up['image']);?>
         <?php if ($data[1] == 'pdf'):?> 
           <a href="<?="uploads/".$up['image'];?>" target="_blank"><img src="<?=base_url('uploads/pdf.png')?>" height="50px" width="50px"></a>
         <?php elseif ($data[1] == 'docx'):?> 
           <a href="<?="uploads/".$up['image'];?>" target="_blank"><img src="<?=base_url('uploads/docx.png')?>" height="50px" width="50px"></a>
         <?php elseif ($data[1] == 'pptx'):?> 
           <a href="<?="uploads/".$up['image'];?>" target="_blank"><img src="<?=base_url('uploads/ppt.png')?>" height="50px" width="50px"></a>
         <?php elseif ($data[1] == 'xlsx'):?> 
           <a href="<?="uploads/".$up['image'];?>" target="_blank"><img src="<?=base_url('uploads/excel.png')?>" height="50px" width="50px"></a>
         <?php else:?>
           <a href="<?="uploads/".$up['image'];?>" target="_blank"><img src="<?="uploads/".$up['image'];?>" height="50px" width="50px" alt="File"></a>
         <?php endif;?>
       </td>
       <td><?php $data = explode('.', $up['image']);?>
       <?php if ($data[1] == 'pdf'):?> 
         PDF               
       <?php elseif ($data[1] == 'docx'):?> 
         DOCX
       <?php elseif ($data[1] == 'pptx'):?> 
         PPT
       <?php elseif ($data[1] == 'jpg'):?> 
         JPG
       <?php elseif ($data[1] == 'png'):?> 
         PNG
       <?php elseif ($data[1] == 'jpeg'):?> 
         JPEG
       <?php elseif ($data[1] == 'xlsx'):?> 
         EXCEL/XLSX
       <?php else:?>
         UNKNOWN
         <?php endif;?></td>
         <td><?php echo date("m-d-Y H:i:s A", strtotime($up['uploaded_at'])); ?></td>
         
         <td>
          <a href="<?php echo base_url('/service-reports/edit/'.$up['upload_id']);?>" class="btn btn-primary btn-sm">Edit</a>
          <a href="<?php echo base_url('/service-reports/delete/'.$up['upload_id']);?>" class="btn btn-danger btn-sm del">Delete</a>
        </td>
      </tr>
      <?php  $u=$u+1;
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
   del = 'File is Deleted Successfully';
 <?php }elseif(session()->has('add')){?>
   add = true;
   del = 'New File is Added Successfully';
 <?php }elseif(session()->has('update')){?>
   update = true;
   del = 'File Details are Updated Successfully';
   <?php }?>;
 </script>
 <script type="text/javascript" src="<?= base_url('assets/js/crud.js')?>"></script>