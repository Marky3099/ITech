<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<div class="body-content">
  <div class="add-form">
    <form method="post" id="add_image" name="add_image" 
    action="<?= base_url('service-reports/add') ?>" enctype = "multipart/form-data">
  <!--   <?php //if($error) {?>
                  <div class='alert alert-danger mt-2' align="center">
                    <?//= $error ?>
                  </div>
                  <?php //}?> -->
                  
                  <div class="form-box">
                    <h3>Upload Service Report</h3><br>
                    <div class="user-box">
                      <div class="icon-box"><i class="fas fa-file-image"></i></div>
                      <input type="text" name="upload_title" placeholder="Title">
                    </div>

                    <div class="user-box">
                      <textarea rows="3" cols="50" name="upload_description" placeholder="Enter Description" ></textarea>
                    </div>

                    <div class="user-box">
                      <div class="icon-box"><i class="fas fa-file-image"></i></div>
                      <input class="upimg" type="file" name="image" required>
                    </div><br>

                    <div class="container1">
                      <button type="submit" class="btn btn-success">Submit</button>
                      <a href='<?=base_url('/service-reports')?>' class="back-btn">Back</a>
                    </div>
                  </div>

                </form>
              </div>
            </div>
