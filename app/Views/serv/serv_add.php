<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<div class="body-content">
  <div class="add-form"> 
    <form method="post" id="add_create" name="add_create" 
    action="<?= base_url('serv/add') ?>">
    <?php if($error) {?>
                  <div class='alert alert-danger mt-2' align="center">
                    <?= $error ?>
                  </div>
              <?php }?>
             
    <div class="form-box">
        <h3>Add Service</h3><br>
        <div class="user-box">
           <div class="icon-box"><i class="fas fa-wrench"></i></div>
          <input type="text" name="serv_name" placeholder="Service Name" class="serv-name" required>
        </div>

        <div class="user-box">
          <div class="icon-box"><i class="fas fa-wrench"></i></div>
          <input type="text" name="serv_description" placeholder="Service Description" class="serv-desc" required>
        </div>

        <div class="user-box">
          <div class="icon-box"><i class="fas fa-tags"></i></div>
          <input type="number" name="price" placeholder="Price" class="price" required>
        </div>

        <div class="container">
          <input type="color" name="serv_color" id="color-picker" required>
          <label for="color-picker">Color</label>
        </div><br>
        
        <div class="container1">
          <button type="submit" class="btn btn-success">Add Data</button>
          <button onclick="history.back()" class="back-btn">Back</button>
        </div>
    </div>
    </form>
  </div>
</div>

 
