<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<div class="body-content">
  <div class="add-form">
    <form method="post" id="add_date" name="add_date" 
    action="<?= base_url('/calendar/dates-add');?>">
    <div class="form-box">
      <h3>Restrict Date</h3><br>
      <div class="user-box">
       <label for="date"><b>Date</b></label>
       <input type="date" name="date" id="date" required>
     </div>

     <div class="user-box">
       <label for="desc"><b>Description</b></label>
       <textarea name="desc" id="desc" rows="4" cols="50" required></textarea>
     </div><br>

     <div class="container1">
      <button type="submit" class="btn btn-success">Submit</button>
      <a href='<?=base_url('/calendar/dates')?>' class="back-btn">Back</a>
    </div>
  </div>

</form>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
  if('<?= $err;?>'.length!= ""){
    Swal.fire({
      icon: 'error',
      title: 'ERROR',
      text: '<?= $err;?>',
    })
  }
</script>