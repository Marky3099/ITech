<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/select2.css');?>">
<div class="body-content">
  <div class="add-form"> 
    <form method="post" id="add_create" name="add_create" >
      
    <?php if($error) {?>
                  <div class='alert alert-danger mt-2' align="center">
                    <?= $error ?>
                  </div>
              <?php }?>
             
    <h1>Add Log Information</h1>
    <div class="form-content">
      <div class="form-group">
        <label id="label1">Date</label>
        <input type="date" name="date" class="form-control" required>
      </div>

     <div class="form-group">
        <label>Branch Area</label>
       <select id="area" name="area" class="form-control">
              <?php foreach($area as $cl):  ?>
                  <option value=<?php echo $cl['area']; ?>><?php echo $cl['area'];?></option>
              <?php endforeach; ?>
            </select>
      </div>

      <div class="form-group">
        <label>Branch Name</label>
        <select id="client_id" name="client_id" class="form-control" >

            </select>
      </div>

      <div class="form-group">
        <label>Caller</label>
        <input type="text" name="caller" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Particulars</label>
        <input type="text" name="particulars" class="form-control" size="50" required>
      </div>

      <div class="form-group">
        <label>Device Brand</label>
        <select id="device_brand" name="device_brand" class="form-control">
              <?php foreach($device_brand as $d_b):  ?>
                  <option value=<?php echo $d_b['device_brand']; ?>><?php echo $d_b['device_brand'];?></option>
              <?php endforeach; ?>
            </select>
      </div>

      <div class="form-group">
        <label>Aircon Type</label>
        <select id="aircon_id" name="aircon_id" class="form-control">

        </select>
      </div>

      <div class="form-group">
        <label>Quantity</label>
        <input type="number" name="qty" class="form-control" min="1" required>
      </div>

      <div class="form-group">
        <label>FCU Number</label>
        <select id="fcuno" name="fcuno[]" class="form-control" multiple="multiple">
               <?php foreach($fcu_no as $f):  ?>
                  <option value="<?php echo $f['fcuno']; ?>"><p id="s2option"><?php echo $f['fcu'];?></p></option>
              <?php endforeach; ?>
            </select>
      </div>

      <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control">
          <option value="Pending">Pending</option>
          <option value="Done">Done</option>
        </select>
      </div>
      
      <div class="form-group">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#schedModal">Add Data</button>
      </div>
      <div class="form-group">
        <a href="<?= base_url('/calllogs');?>" class="btn btn-secondary back">Back</a>
      </div>
    </div>
    </form>
  </div>
</div>
</div>
<div class="modal"  id="schedModal" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Schedule Task</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Schedule this task on Calendar?</p>
            </div>
            <div class="modal-footer">
              <button type="submit" id="submit1" class="btn btn-primary">Yes</button>
              <button type="submit" id="submit2" class="btn btn-secondary" data-dismiss="modal" >No</button>
            </div>
          </div>
        </div>
      </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
      <script type="text/javascript">
        // -----------------
        
        var getUrl = window.location;
        $('#fcuno').select2();

        $("#submit1").click(function(e) {
        var form = $('#add_create').serializeArray(); 
        console.log(form);
        console.log("yes");
        $.ajax({
             type: "POST",
             url: "/tsms/calllogs/add",
             data: form, // serializes form input
             success: function(data){
                 window.location.href = '/tsms/calendar'; 
                }
            });
         });

    $("#submit2").click(function(e) {
        
        var form = $('#add_create').serializeArray(); 
        $.ajax({
             type: "POST",
             url: "/tsms/calllogs/add",
             data: form ,// serializes form input
             success: function(data){
                 window.location.href = '/tsms/calllogs'; 
             }
        });
    });


// ---------------------------------
  var areas = <?php echo json_encode($client_area); ?> ;
          $.each(areas[0], function(key, v) {
          // alert(value.client_id+" "+value.client_branch);
           // console.log(v);
           $.each(v, function(key, value) {
          $("#client_id").append('<option value='+value.client_id+'>'+value.client_branch+'</option>');
        });
      });        
  $("#area").change(function(){
      $("#client_id").empty();
          var current_value = document.getElementById("area").selectedIndex;
          $.each(areas[current_value], function(key, v) {
            // alert(value.client_id+" "+value.client_branch);
             console.log(v);
             $.each(v, function(key, value) {
            $("#client_id").append('<option value='+value.client_id+'>'+value.client_branch+'</option>')
          });
        });
        // $("#area").append('<option value='+'>My option</option>');
    });

  // ------------------------------------------------
    var devbrand = <?php echo json_encode($brand); ?> ;
      // console.log(areas);
   

      $.each(devbrand[0], function(key, v) {
          // alert(value.client_id+" "+value.client_branch);
           // console.log(v);
           $.each(v, function(key, value) {
          $("#aircon_id").append('<option value='+value.aircon_id+'>'+value.aircon_type+'</option>');
          $("#aircon_id_update").append('<option value='+value.aircon_id+'>'+value.aircon_type+'</option>');
        });
      });
 $("#device_brand").change(function(){
      $("#aircon_id").empty();
        var current_value = document.getElementById("device_brand").selectedIndex;
        $.each(devbrand[current_value], function(key, v) {
          // alert(value.client_id+" "+value.client_branch);
           console.log(v);
           $.each(v, function(key, value) {
          $("#aircon_id").append('<option value='+value.aircon_id+'>'+value.aircon_type+'</option>')
        });
        });
        // $("#area").append('<option value='+'>My option</option>');
    });
      </script>

 
