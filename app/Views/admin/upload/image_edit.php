<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<div class="body-content">
  <div class="edit-form">
    <form method="post" id="update_image" name="update_image" 
    action="<?= base_url('service-reports/update/'.$Upload_obj['upload_id']) ?>" enctype = "multipart/form-data">
    <input type="hidden" name="upload_id" id="id" value="<?php echo $Upload_obj['upload_id']; ?>">
    
    <div class="form-box" style="left: 280px;">
      <h3>Upload Service Report</h3><br>
      <div class="user-box">
        <div class="icon-box"><i class="fas fa-file-image"></i></div>
        <input type="text" name="upload_title" value="<?php echo $Upload_obj['upload_title']; ?>">
      </div>

      <div class="user-box">
        <textarea name="upload_description" class="form-control" rows="3" cols="50"><?php echo $Upload_obj['upload_description']; ?></textarea>
      </div>

      <div class="user-box">
        <div class="icon-box"><i class="fas fa-file-image"></i></div>
        <input class="upimg" type="file" name="image">
      </div><br>

      <div class="container1">
        <button type="submit" class="btn btn-success">Update</button>
        <a href='<?=base_url('/service-reports')?>' class="back-btn">Back</a>
      </div>

    </div>
  </form>
</div>
<div class="image_edit">
  <h3>Uploaded File:</h3>
  <?php $data = explode('.', $Upload_obj['image']);?>
  <?php if ($data[1] == 'pdf'):?> 
   <a href="<?=base_url("uploads/".$Upload_obj['image']);?>" target="_blank"><img src="<?=base_url('uploads/pdf.png')?>" height="350px" width="350px"></a>
 <?php elseif ($data[1] == 'docx'):?> 
   <a href="<?=base_url("uploads/".$Upload_obj['image']);?>" target="_blank"><img src="<?=base_url('uploads/docx.png')?>" height="350px" width="350px"></a>
 <?php else:?>
   <a href="<?=base_url("uploads/".$Upload_obj['image']);?>" target="_blank"><img src="<?=base_url("uploads/".$Upload_obj['image']);?>" height="350px" width="350px" alt="File"></a>
 <?php endif;?>
</div>
</div>


