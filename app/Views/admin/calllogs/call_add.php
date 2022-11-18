<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/select2.css')?>">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<div class="body-content" style="height: 100%;">
  <div class="add-form"> 
    <form method="post" id="add_create" name="add_create" >
      <div class="form-box" style="height: 600px; top: 45%;">
        <h3>Add Log Information</h3>
        <div class="user-box">
          <label>Branch Area</label>
          <label class="tdate">Date</label><br>
          <input type="date" name="date" id="myDate" class="datee" required>
          <div class="select-dropdown" style="width: 40%;">
            <select id="area" name="area">
              <?php foreach($area as $cl):  ?>
                <option value=<?php echo $cl['area']; ?>><?php echo $cl['area'];?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <label>Branch Name</label>
        <div class="select-dropdown">
          <select id="client_id" name="client_id"></select>
        </div>

        <div class="user-box">
          <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
          <input type="text" name="caller" placeholder="Caller" required>
        </div>

        <div class="user-box">
          <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
          <input type="text" name="particulars" placeholder="Particulars" size="50" required>
        </div>
        
        <div class="user-box" style="height: 75px">
          <label>Device Brand</label>
          <label id="Atype">Aircon Type</label>
          <div class="select-dropdown" style="width: 40%; position: relative;">
            <select id="device_brand" name="device_brand">
              <?php foreach($device_brand as $d_b):  ?>
                <option value=<?php echo $d_b['device_brand']; ?>><?php echo $d_b['device_brand'];?></opti>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="select-dropdown" style="width: 40%; margin-left: 257px; top: -46px;">
              <select id="aircon_id" name="aircon_id">
              </select>
            </div>
          </div>

          <div class="user-box" style="margin-bottom: -10px;">
            <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
            <input type="number" name="qty" placeholder="Quantity" min="1" required>
          </div>
          <div class="user-box" >
            <label>FCU Number</label>
            <select id="fcuno" name="fcuno[]" class="selectpicker" multiple data-selected-text-format="count > 3" required>
              <?php foreach($fcu_no as $f):  ?>
                <option value="<?php echo $f['fcuno']; ?>"><p id="s2option"><?php echo $f['fcu'];?></p></option>
              <?php endforeach; ?>
            </select>
            <label>Status</label>
            <div class="select-dropdown" style="width: 40%; margin-left: 257px; top: -36px;">
              <select name="status">
                <option value="Pending">Pending</option>
                <option value="Done">Done</option>
              </select>
            </div>
          </div>

          <div class="container1">
            <button type="button" id="sub" class="btn btn-success" data-toggle="modal" data-target="#schedModal">Submit</button>
            <a href='<?= base_url('/calllogs');?>' class="back-btn">Back</a>
          </div> 
        </div>
      </form>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
  <script type="text/javascript">
        // -----------------
        var getUrl = window.location;
        // $('#fcuno').select2();
        $('#fcuno .selectpicker').selectpicker();

        $("#submit1").click(function(e) {
          e.preventDefault();
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
          e.preventDefault();
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

    
