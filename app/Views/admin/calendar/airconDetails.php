<!DOCTYPE html>
<html>
  <head>
    <title>Add Remove Dynamic Dependent Select Box using Ajax jQuery with PHP</title>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">

  </head>
  <body>
    <br />
    <div class="container">
      <h3 align="center">Add Remove Dynamic Dependent Select Box using Ajax jQuery with PHP</h3>
      <br />
      <h4 align="center">Enter Item Details</h4>
      <br />
      <form method="post" id="insert_form" action="<?= base_url('/calendar/add-aircon/add/'.$id) ?>">
        <div class="table-repsonsive">
          <span id="error"></span>
          <table class="table table-bordered" id="item_table">
            <thead>
              <tr>
                <th>Device Brand</th>
                <th>Aircon Type</th>
                <th>FCU No.</th>
                <th>Quantity</th>
                <th><button type="button" name="add" class="btn btn-success btn-xs add"><span class="fa fa-plus"></span></button></th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
          <div align="center">
            <input type="submit" name="submit" class="btn btn-info" value="Insert" />
          </div>
        </div>
      </form>
    </div>
  </body>
</html>
<script>
    $(document).ready(function(){
      
      var count = 0;

      $(document).on('click', '.add', function(){
        
        var html = '';
        html += '<tr>';
        html += `<td><select id="device_brand" name="device_brand[]" class="form-control " data-id="`+count+`"required>
          <option value=0>Select Brand</option>
                <?php foreach($device_brand as $d_b):  ?>
                    <option value=<?php echo $d_b['device_brand']; ?>><?php echo $d_b['device_brand'];?></option>
                <?php endforeach; ?>
              </select></td>`;

        html += `<td><select id="aircon_id_`+count+`" name="aircon_id[]" class="form-control aircon" required>
        <option value=0>Select Type</option>
              </select></td>`;


        html += `<td>
               <select id="fcuno" name="fcuno`+count+`[]" class="selectpicker" multiple data-selected-text-format="count > 3">
                <?php foreach($fcu_no as $f):  ?>
                  <option value="<?php echo $f['fcuno']; ?>"><p id="s2option"><?php echo $f['fcu'];?></p></option>
                <?php endforeach; ?>
              </select></td>
              <td>
              <input type="number" class="form-control" name="quantity[]" id="quantity" min="1" value="1" required>
              </td>';
        html += '<td><button type="button" name="remove" class="btn btn-danger btn-xs remove"><span class="fa fa-minus"></span></button></td>`;
        $('tbody').append(html);

         $('.selectpicker').selectpicker();
         count++;
      });


      $(document).on('click', '.remove', function(){
        $(this).closest('tr').remove();
      });

      $(document).on('change', '#device_brand', function(){
        var category_id = $(this).val();
        var aircon = $(this).data('id');
        $.ajax({
          url: 'http://localhost/tsms/aircon/brand/'+category_id,
          method:"GET",
          success:function(data)
          {
            var res = JSON.parse(data);
            console.log(res.options);
            var html = '';
            html += res.options;
            $('#aircon_id_'+aircon).html(html);

          },
          error:function(e){
            console.log(e);
          }
        })
      });

      $('select').selectpicker();
    });
</script>
<!-- ============================= -->
<!-- <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/select2.css');?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/airconDetails.css');?>">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css'>
</head>
<body>
	<form method="post">
	<h3>Aircon Details:</h3>
          
            <div class="form-row">
            <div class="form-group col-md-3">
              <label for="device_brand">Device Brand</label>
              
              <select id="device_brand" name="device_brand" class="form-control" data-id="0"required>
                <?php foreach($device_brand as $d_b):  ?>
                    <option value=<?php echo $d_b['device_brand']; ?>><?php echo $d_b['device_brand'];?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group col-md-3">
              
              <label for="aircon_id">Aircon Type</label>
              <select id="aircon_id" name="aircon_id" class="form-control" required>
              </select>
            </div>
            <div class="form-group col-md-4">
              
              <label for="fcuno">FCU No.</label>
              <select id="fcuno" name="fcuno[]" class="form-control selectpicker" multiple="multiple" required>
                <?php foreach($fcu_no as $f):  ?>
                  <option value="<?php echo $f['fcuno']; ?>"><p id="s2option"><?php echo $f['fcu'];?></p></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              
               <label for="quantity">Quantity</label>
              <input type="number" class="form-control" name="quantity" id="quantity" min="1" value="1" required>
            </div>  
            </div>       
          

          <div class="form-group" align="center">
            <button type="button" class="btn btn-lg addMore"><i class="fa-solid fa-circle-plus plus"></i></button>
          </div>

          <div class="form-group">
          		<button type="button" class="btn btn-secondary" onclick="location.href='<?= base_Url('admin/calendar/calendar.php')?>'">Back</button>
        		<button type="submit" class="btn btn-primary">Save changes</button>
          </div>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src = "https://kit.fontawesome.com/0df98348d7.js" crossorigin = "anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    	$('#fcuno').select2();
      var fcu_all = <?php echo json_encode($fcu_no); ?>
    	  var brand = <?php echo json_encode($device_brand); ?>;  
		  var dev_brand = <?php echo json_encode($brand2); ?> ;
		  var devbrand = <?php echo json_encode($brand); ?> ;
      $.each(devbrand[0], function(key, v) {
          // alert(value.client_id+" "+value.client_branch);
           // console.log(v);
           $.each(v, function(key, value) {
          $("#aircon_id").append('<option value='+value.aircon_id+'>'+value.aircon_type+'</option>');
          $("#aircon_id_update").append('<option value='+value.aircon_id+'>'+value.aircon_type+'</option>');
        });
      });



    $("#device_brand_update").change(function(){
      $("#aircon_id_update").empty();
        var current_value = document.getElementById("device_brand_update").selectedIndex;
        $.each(devbrand[current_value], function(key, v) {
          // alert(value.client_id+" "+value.client_branch);
           console.log(v);
           $.each(v, function(key, value) {
          $("#aircon_id_update").append('<option value='+value.aircon_id+'>'+value.aircon_type+'</option>')
        });
        });
        // $("#area").append('<option value='+'>My option</option>');
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
</body>
</html> -->