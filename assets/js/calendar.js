// Calendar JS ------------------------------------------

  document.addEventListener('DOMContentLoaded', function() {

  var calendarEl = document.getElementById('calendar');
  var count = 0;
  var holidays = ["01-01","01-02","25-02","09-04","14-04","16-04","01-05","09-05","12-06","29-08","21-08","31-10","01-11","02-11","30-11","08-12","24-12","25-12","30-12","31-12"];
  // var today = new Date().toISOString().slice(0,10);
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    handleWindowResize: false,
    selectable: true,
    eventOrder: false,
    // validRange: {
    //   start: today
    // },
    // weekends: false,
    // selectAllow: function (select) {
    //                 return JudgeWeekDay(select.start, [1,2,3,4,5]);
    //             },
    // dayRender: function (date, cell) {
    //                 if (!JudgeWeekDay(date, [1,2,3,4,5])) {
    //                     cell.css("background-color", "rgb(204, 204, 204)");
    //                 }
    //             },
    // editable: true,
    headerToolbar: {
      left: 'prev,next',
      center: 'title',
      right: 'today',
    },
     
    events: event,
    dateClick: function(info) {
      var myModal = new bootstrap.Modal(document.getElementById('mymodal'));
           var ad = document.getElementById('start_event');
           ad.value = info.dateStr;
           var formatDate;
           var disable=[];
           
           for (var i = 0; i < disableDates.length; i++) {
             var splitDate = disableDates[i].date.split("-");
             var formatDate = splitDate[2]+"-"+splitDate[1];
             disable.push(formatDate);
           }
           var disDate =  disable.concat(holidays);
           var dateFormat = info.dateStr.split("-");
           var dateDisable = dateFormat[2]+"-"+dateFormat[1];
           // console.log(dateDisable);
           var counter = 0;
           // console.log(dateDisable);
           // console.log(info);
           for (var i = 0; i < disDate.length; i++) {
             if(dateDisable == disDate[i]){
                counter=1;
             }
           }
           // console.log(counter);
          if(counter == 0){
            myModal.show();
          }
      // console.log();
          var em = document.getElementById('emp_id');

  $(document).on('change','#end_time', function(){
    var timeee = $(this).val();
    var startTime = $('#time').val();
    $.ajax({
           type: "POST",
           url: "http://localhost/tsms/calendar/checkEmp",
             data: {
                'start_event' : info.dateStr,
                'time' : startTime,
                'end_time' : timeee
             } ,// serializes form input
             success: function(data){
               // window.location.href = '/tsms/calllogs'; 
              // console.log(data);
              // $("#emp_id").appe
              console.log(data.startTime);
              console.log(data.endTime);
              console.log(data.end_time);
              // var count = 0;
              em.innerHTML="";
              data.available_emp.map((emp)=>{
                 var opt_one = document.createElement('option');
                  opt_one.value = emp.emp_id;
                  opt_one.innerHTML = emp.emp_name;
                  em.appendChild(opt_one);
                  // if (emp.area == info.event.extendedProps.area ) {
                  //   s1.value = emp.area;
                  //   int_index_area = count;
                  // }
                  
              });
              $('#mymodal .selectpicker').selectpicker("refresh");

             }
           });

  });

    // alert('Date: ' + info.dateStr);
     

    },
    eventClick: function(info) {

     var myModal = new bootstrap.Modal(document.getElementById('mymodal2'));
     var tt = document.getElementById('start_event');
     // var i = document.getElementById('time');
     var ad = document.getElementById('id');
     var ecode = document.getElementById('event_code');
     var lcode = document.getElementById('log_code');
     var acode = document.getElementById('appt_code');
     var t = document.getElementById('title_update');
     var ti = document.getElementById('time_update');
     var eti = document.getElementById('end_time_update');
     var s = document.getElementById('serv_id_update');
     // var a = document.getElementById('aircon_id_update');
     // var q = document.getElementById('quantity_update');
    var r = document.getElementById('start_event_update');
    var dt = document.getElementById('date');
    
      // console.log(ecode);
      
    // console.log(acode);

      // select cliend and branch
      var s1 = document.getElementById('area_update');
      var s2 = document.getElementById('client_id_update');
      s1.innerHTML='';
      s2.innerHTML='';
      
      var int_index_area = 0;
      var count = 0;

      areas.map((one_by_one_area)=>{
         var opt_one = document.createElement('option');
          opt_one.value = one_by_one_area.area;
          opt_one.innerHTML = one_by_one_area.area;
          s1.appendChild(opt_one);
          if (one_by_one_area.area == info.event.extendedProps.area ) {
            s1.value = one_by_one_area.area;
            int_index_area = count;
          }
          count +=1;
      });
    

     c_area.forEach((one, index_here)=>{

        

        if (int_index_area == index_here) {


          one.forEach((value, index)=>{

            var opt_client = document.createElement('option');
                      opt_client.value = value.client_id;
                      opt_client.innerHTML = value.client_branch;
                      s2.append(opt_client);

                      if (value.client_branch == info.event.extendedProps.client_branch ) {
                        s2.value = value.client_id;
                      }
          })

        }
         
      });
      s2.value = info.event.extendedProps.client_id;
      // -------------------------------------------------------------------------
      // select brand and aircon type
     //  var s3 = document.getElementById('device_brand_update');
     //  var s4 = document.getElementById('aircon_id_update');
      
     //  var int_index_area1 = 0;
     //  var count1 = 0;
     $('#auth-rows-edit').html('');
    // console.log(distinctEvent);
     distinctEvent.forEach((disEvent, index)=>{
      
          var concut = '';
          // console.log(disEvent,distinct);
        distinct.forEach((dis, index)=>{
    if ( info.event.id == dis.id &&  dis.id == disEvent.id) {
        // console.log(info.event.id +'='+ dis.id +' '+  dis.id +'='+  disEvent.id);
         concut = `<div class="form-row" id="row" style="background-color:lightblue;">
    <div class="form-group col-md-3">
    <label for="dbrand">Device Brand</label>
    <select id="device_brand_update" name="device_brand[]" class="form-control " data-id="`+dis.aircon_id+`"required>`;
      
      deviceBrand.forEach((dbrand, index)=>{
        if (dis.device_brand == dbrand.device_brand) {
          concut = concut + `<option value="`+dbrand.device_brand+`" selected>`+dbrand.device_brand+`</option>`;
        }else{
          concut = concut + `<option value="`+dbrand.device_brand+`">`+dbrand.device_brand+`</option>`;
        }
         
      });
        
    concut = concut + ` </select>
    </div> 
    <div class="form-group col-md-3">
    
    <label for="aircont">Aircon Type</label>
    <select id="aircon_update_id_`+dis.aircon_id+`" name="aircon_update_id[]" class="form-control aircon" data-id="`+dis.aircon_id+`" required>
    <option value="`+dis.aircon_id+`">`+dis.aircon_type+`</option>
    </select>
    </div>
    <div class="form-group col-md-3">
    
    <label for="fcunos">Fcuno</label>

    

    <select id="fcuno_update_`+dis.aircon_id+`" name="fcuno_update_`+dis.aircon_id+`[]" class="selectpicker" data-width="100%" multiple data-selected-text-format="count > 2">
    <option value="1">FCU 1</option>
    <option value="2">FCU 2</option>
    <option value="3">FCU 3</option>
    <option value="4">FCU 4</option>
    <option value="5">FCU 5</option>
    <option value="6">FCU 6</option>
    <option value="7">FCU 7</option>
    <option value="8">FCU 8</option>
    <option value="9">FCU 9</option>
    <option value="10">FCU 10</option>
    </select>
    </div> 

    <div class="form-group col-md-2">
    
    <label for="fcunos">Quantity</label>
    <input type="number" class="form-control" name="quantity[]" id="quantity_update" min="1" value="`+dis.quantity+`" required>
    </div> 
    <div class="form-group col-md-1"><br>
    <span id="auth-del-edit" class="btn"><i class="fas fa-minus"></i></span>
    </div>
    </div>`;
    $('#auth-rows-edit').append(concut);
    }
    
          info.event.extendedProps.fcu_array.forEach((fcuData, index)=>{
          if (disEvent.id == dis.id) {
            if (dis.id == fcuData.id && dis.aircon_id == fcuData.aircon_id) {
              


                for(let i=1;i<=10;i++){
                    if (fcuData.fcuno == i) {
                       
                       $("#fcuno_update_"+dis.aircon_id +" option[value='" + fcuData.fcuno + "']").prop("selected", true);
                      
                    }
                    
                
    
                
              } 
            }


          }
        });
          
         
          $('#auth-rows-edit').on('click', '#auth-del-edit', function(E){

            $(this).parents('#row').remove();

          });


      $('#mymodal2 .selectpicker').selectpicker();
          
        });
          


      });
     var date = new Date(info.event.start),mnth = ("0" + (date.getMonth() + 1)).slice(-2),
    day = ("0" + date.getDate()).slice(-2);
      var dateFormat = [ mnth,day, date.getFullYear()].join("/");


      tt.value = info.event.start_event;
      ad.value = info.event.id;
      ecode.value = info.event.extendedProps.event_code;
      acode.value = info.event.extendedProps.appt_code;
      lcode.value = info.event.extendedProps.log_code;
      r.value = dateFormat;
      t.value = info.event.title;
      ti.value = info.event.extendedProps.time;
      eti.value = info.event.extendedProps.end_time;
      s.value = info.event.extendedProps.serv_id;
      $("#frmdate").datepicker('update', dateFormat);
     
      // var disableDates = ["01-01","01-02","25-02","09-04","14-04","16-04","01-05","09-05","12-06","29-08","21-08","31-10","01-11","02-11","30-11","08-12","24-12","25-12","30-12","31-12"];
      var formatDate;
      var disable=[];
           
      for (var i = 0; i < disableDates.length; i++) {
        var splitDate = disableDates[i].date.split("-");
        var formatDate = parseInt(splitDate[2])+"-"+parseInt(splitDate[1]);
        disable.push(formatDate);
      }

      $('.datepicker').datepicker({
            format: 'mm/dd/yyyy',
            beforeShowDay: function(date = dateFormat){
                dmy = date.getDate() + "-" + (date.getMonth() + 1);
                // console.log(disable);
                if(disable.indexOf(dmy) != -1 || date.getDay() == 0 || date.getDay() == 6){
                    return false;
                }
                else{
                    return true;
                }
            }
        });
      $(".datepicker").datepicker('update', dateFormat);
// console.log("here"+ dateFormat);
      // console.log("here"+date.getMonth());

// ---------------------------------------------------------------------
       document.getElementById('emp_id_update').innerHTML='';
              var arr = info.event.extendedProps.emp_array.split(',');

      emp_all.map((all_emp)=>{
        let i = 0;
         while(arr) {
             if(parseInt(arr[i]) == all_emp.emp_id){
              $("#emp_id_update").append(`
                  <option value="`+ all_emp.emp_id+`" selected>`+all_emp.emp_name+`</option>`
                );
              break;
             }

             if (emp_all.length == i) {
              $("#emp_id_update").append(`
                  <option value="`+ all_emp.emp_id+`">`+all_emp.emp_name+`</option>`
                );
              break;
             }
            
            i++;
          }

      });

      // // $('#emp_id_update').select2({
      // //   dropdownParent: $('#mymodal2')
      // // });
      $("#emp_id_update").selectpicker("refresh");
    
      // ---------------------------------------------------
     myModal.show();

   
    },
  });



  calendar.render();
});



// ------------------------------------------------
 // $('#emp_id').select2({
 //        dropdownParent: $('#mymodal')
 //    });

          $.each(areas1[0], function(key, v) {
          // alert(value.client_id+" "+value.client_branch);
           // console.log(v);
           $.each(v, function(key, value) {
          $("#client_id").append('<option value='+value.client_id+'>'+value.client_branch+'</option>');
        });
      });



    $("#area_update").change(function(){
      $("#client_id_update").empty();
        var current_value = document.getElementById("area_update").selectedIndex;

        $.each(areas1[current_value], function(key, v) {
          // alert(value.client_id+" "+value.client_branch);
          
           $.each(v, function(key, value) {
             // console.log(value.client_branch);
          $("#client_id_update").append('<option value='+value.client_id+'>'+value.client_branch+'</option>')
          });
        });
        // $("#area").append('<option value='+'>My option</option>');
    });


    $("#area").change(function(){
      $("#client_id").empty();
          var current_value = document.getElementById("area").selectedIndex;
          $.each(areas1[current_value], function(key, v) {
            // alert(value.client_id+" "+value.client_branch);
             // console.log(v);
             $.each(v, function(key, value) {
            $("#client_id").append('<option value='+value.client_id+'>'+value.client_branch+'</option>')
          });
        });
        // $("#area").append('<option value='+'>My option</option>');
    });

    


    $("#mymodal2").on('hidden.bs.modal', function(e){
      alert('here');
      document.getElementById("auth-rows-edit").innerHTML = '';
  });
