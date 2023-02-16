<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">

<div class="container" style="width: 100%">
  <div class="row">
    <div class="body-content" style="width: 100%">
      <div class="add-form">
        <form method="post" id="add_date" name="add_date" action="<?= base_url('/calendar/dates-add');?>">
          <div class="col-12 col-lg-5 col-md-5 col-sm-12 form-box" id="dateformbox">
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
                <a href='<?=base_url('/calendar/dates')?>' class="back-btn">Back</a>
                <button type="submit" class="btn btn-success">Submit</button>
              </div>
          </div>
        </form>
      </div>
    </div>
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