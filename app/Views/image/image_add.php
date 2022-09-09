<div class="body-content">
  <div class="add-form">
    <form method="post" id="add_image" name="add_image" 
    action="<?= base_url('service-reports/add') ?>" enctype = "multipart/form-data">
  <!--   <?php //if($error) {?>
                  <div class='alert alert-danger mt-2' align="center">
                    <?//= $error ?>
                  </div>
              <?php //}?> -->
  
    <h1>Upload Service Report</h1>
    <div class="form-content long">
      <div class="form-group">
        <label id="label1">Title</label>
        <input type="text" name="upload_title" class="form-control" >
      </div>

      <div class="form-group">
        <label>Description</label>
        <textarea rows="3" cols="50" name="upload_description" class="form-control" placeholder="Enter Description" ></textarea> 
      </div>

      <div class="form-group">
        <label>File</label>
        <input type="file" name="image" class="form-control" required>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-success">Upload</button>
      </div>
      <div class="form-group">
        <a href="<?= base_url('/service-reports');?>" class="btn btn-secondary back">Back</a>
      </div>
    </div>
    </form>
  </div>
</div>
</div>
 
