 $.each(areas, function(key, v) {
           $.each(v, function(key, value) {
            $.each(value,function(key, dat){
               if(cBranch != ""){
                  if(cBranch.area === dat.area){
                     if(cId == dat.client_id){
                        console.log(dat.client_id);
                        $("#client_id").append('<option value='+dat.client_id+' selected>'+dat.client_branch+'</option>');
                     }else{
                        $("#client_id").append('<option value='+dat.client_id+'>'+dat.client_branch+'</option>');
                     }
                  }
               }
            });
          });
         });        

$("#area").change(function(){
  $("#client_id").empty();
  var current_value = document.getElementById("area").selectedIndex;
  $.each(areas[current_value-1], function(key, v) {
            // alert(value.client_id+" "+value.client_branch);
            console.log(v);
            $.each(v, function(key, value) {
              $("#client_id").append('<option value='+value.client_id+'>'+value.client_branch+'</option>')
            });
          });
      });