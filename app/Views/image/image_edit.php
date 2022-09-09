<div class="body-content">
  <div class="edit-form">
    <form method="post" id="update_image" name="update_image" 
    action="<?= base_url('service-reports/update/'.$Upload_obj['upload_id']) ?>" enctype = "multipart/form-data">
      <input type="hidden" name="upload_id" id="id" value="<?php echo $Upload_obj['upload_id']; ?>">
      <h1>Edit Service Report Upload</h1>
      <div class="form-content long img">
      <div class="form-group">
        <label id="label1">Title</label>
        <input type="text" name="upload_title" class="form-control" value="<?php echo $Upload_obj['upload_title']; ?>">
      </div>
      <div class="form-group">
        <label>Description</label>
        <textarea name="upload_description" class="form-control" rows="3" cols="50"><?php echo $Upload_obj['upload_description']; ?></textarea>
      </div>

       <div class="form-group">
        <label>File</label>
        <input type="file" name="image" class="form-control">
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-success">Save</button>
      </div>
      <div class="form-group">
        <a href="<?= base_url('/service-reports');?>" class="btn btn-secondary back">Back</a>
      </div>
    </div>
    </form>
  </div>
  <div class="image_edit">
    <h3>Uploaded File:</h3>
    <?php $data = explode('.', $Upload_obj['image']);?>
               <?php if ($data[1] == 'pdf'):?> 
                 <a href="<?=base_url("uploads/".$Upload_obj['image']);?>" target="_blank"><img src="<?=base_url('uploads/pdf.png')?>" height="450px" width="450px"></a>
               <?php elseif ($data[1] == 'docx'):?> 
                 <a href="<?=base_url("uploads/".$Upload_obj['image']);?>" target="_blank"><img src="<?=base_url('uploads/docx.png')?>" height="450px" width="450px"></a>
               <?php else:?>
               <a href="<?=base_url("uploads/".$Upload_obj['image']);?>" target="_blank"><img src="<?=base_url("uploads/".$Upload_obj['image']);?>" height="450px" width="450px" alt="File"></a>
            <?php endif;?>
  </div>
</div>
</div>

