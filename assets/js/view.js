$(document).on('click','.view',function(e){
      // console.log(e.target.id);
      var id = e.target.id;
      var options = { year: 'numeric', month: 'long', day: 'numeric' };

      var myModal = new bootstrap.Modal(document.getElementById('viewModal'));
      $.ajax({
         method: 'Post',
         url: '<?= base_url('/events/view')?>',
         data:{
            'id': id
         },
         success: function(response){
            var date = new Date(response.event_data.start_event);
            var startEvent = date.toLocaleDateString("en-US",(options));
            var eventCode = response.event_data.event_code;
            var logCode = response.event_data.log_code;
            var apptCode = response.event_data.appt_code;
            var clientId = response.event_data.client_id;
            var clientData = response.client_data;
            var area;
            var branch;
            var servId = response.event_data.serv_id;
            var servData = response.serv_data;
            var servName;
            var servType;
            var time = response.event_data.time.split(":");
            var endTime = response.event_data.end_time.split(":");
            var formatTime;
            var formatEndTime;
            var dBrandArr = new Array();
            var airconTypeArr = new Array();
            var devBrand;
            var airconType;
            var fcuArr = response.distinct;
            var fcuNoArr = new Array();
            var fcuData = response.fcu_data;
            var fcuNo;
            var qty = new Array();
            var quantity;
            var empArr = response.emp_data;
            var emp = new Array();
            var empData;
            var statusData = response.event_data.status;
            // var date = 

            $('#modalTitle').html("["+eventCode+"] Schedule");
            $('#modal_start_event').html(startEvent);
            $('#modal_event_code').html(eventCode);
            if(logCode == ''){
               $('#modal_log_code').html("N/A");
            }else{
               $('#modal_log_code').html(logCode);
            }
            
            if(apptCode == ''){
               $('#modal_appt_code').html("N/A");
            }else{
                $('#modal_appt_code').html(apptCode);
            }
            
            if(time[0] == '00'){
               formatTime = 'N/A';
            }else if (time[0]>12){
                var hour = time[0] - 12;
                var amPm = "PM";
                formatTime = hour + ":" + time[1] + " " + amPm;
            }else if (time[0]==12){
                var hour = time[0];
                var amPm = "PM";
                formatTime = hour + ":" + time[1] + " " + amPm;
            } else {
                var hour = time[0]; 
                var amPm = "AM";
                formatTime = parseInt(hour) + ":" + time[1] + " " + amPm;
            }

            if(endTime[0] == '00'){
               formatEndTime = 'N/A';
            }else if (endTime[0]>12){
                var hour = endTime[0] - 12;
                var amPm = "PM";
                formatEndTime = hour + ":" + endTime[1] + " " + amPm;
            }else if (endTime[0]==12){
                var hour = endTime[0];
                var amPm = "PM";
                formatEndTime = hour + ":" + endTime[1] + " " + amPm;
            } else {
                var hour = endTime[0]; 
                var amPm = "AM";
                formatEndTime = parseInt(hour) + ":" + endTime[1] + " " + amPm;
            }
            
             $('#modal_time').html(formatTime+" - "+formatEndTime);

             for (var a = 0; a < clientData.length; a++) {
                if(clientId == clientData[a].client_id){
                  area = clientData[a].area;
                  branch = clientData[a].client_branch;
                }
             }
             // console.log(area + " "+branch);
             $('#modal_area').html(area);
             $('#modal_branch').html(branch);

             for (var b = 0; b < servData.length; b++) {
                if(servId == servData[b].serv_id){
                  servName = servData[b].serv_name;
                  servType = servData[b].serv_type;
                }
             }
             $('#modal_serv_name').html(servName);
             $('#modal_serv_type').html(servType);
            for (var i = 0; i < fcuArr.length; i++) {
              dBrandArr.push(response.distinct[i].device_brand);
              airconTypeArr.push(response.distinct[i].aircon_type);
            }
            
            devBrand = dBrandArr.toString();
            airconType = airconTypeArr.toString();
            $('#modal_dev_brand').html(devBrand);
            $('#modal_aircon_type').html(airconType);
            // console.log(devBrand +" "+ airconType);

            for (var i = 0; i < fcuData.length; i++) {
              if(id == fcuData[i].id){
               fcuNoArr.push(response.fcu_data[i].fcu);
              }
              
            }
            var pre = 0;
            for (var i = 0; i < fcuData.length; i++) {
                if(id == fcuData[i].id){
                    if(fcuData[i].aircon_id!=pre){
                        qty.push(response.fcu_data[i].quantity);
                        pre = fcuData[i].aircon_id;
                    }
                }
            }
            fcuNo = fcuNoArr.toString();
            quantity = qty.toString();
            $('#modal_fcu').html(fcuNo);
            $('#modal_qty').html(quantity);

            for (var i = 0; i < empArr.length; i++) {
               emp.push(response.emp_data[i].emp_name);
            }
            empData = emp.toString();
            $('#modal_emp').html(empData);
            $('#modal_status').html(statusData);
            // console.log();
            console.log(response);
            myModal.show();
         }
      })
   });
