document.getElementById('fcuno_update').innerHTML='';

      var arr1 = info.event.extendedProps.fcu_array.split(',');

      var fcu_all = <?php echo json_encode($fcu_no); ?>;
      fcu_all.map((all_fcu)=>{
        let a = 0;
         while(arr1) {
             if(parseInt(arr1[a]) == all_fcu.fcuno){
              $("#fcuno_update").append(`
                  <option value="`+ all_fcu.fcuno+`" selected>`+all_fcu.fcu+`</option>`
                );
              break;
             }

             if (fcu_all.length == a) {
              $("#fcuno_update").append(`
                  <option value="`+ all_fcu.fcuno+`">`+all_fcu.fcu+`</option>`
                );
              break;
             }
            
            a++;
          }

      });


 $('#fcuno').select2({
        dropdownParent: $('#mymodal')
    });
var areas = <?php echo json_encode($client_area); ?> ;
          $.each(areas[0], function(key, v) {
          // alert(value.client_id+" "+value.client_branch);
           // console.log(v);
           $.each(v, function(key, value) {
          $("#client_id").append('<option value='+value.client_id+'>'+value.client_branch+'</option>');
        });
      });



    $("#area_update").change(function(){
      $("#client_id_update").empty();
        var current_value = document.getElementById("area_update").selectedIndex;

        $.each(areas[current_value], function(key, v) {
          // alert(value.client_id+" "+value.client_branch);
          
           $.each(v, function(key, value) {
             console.log(value.client_branch);
          $("#client_id_update").append('<option value='+value.client_id+'>'+value.client_branch+'</option>')
          });
        });
        // $("#area").append('<option value='+'>My option</option>');
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