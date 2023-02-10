<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
<div class="body-content">
  <div class="add-form"> 
    <form method="post" id="add_create" name="add_create" action="<?=base_url("/appointment/add")?>">
      
      <!--  -->
      
      
      <div class="form-box">
        <h3>Add Appointment</h3>
        <div class="user-box">
          <input type="hidden" name="availTime" id="availTime" value="<?php if(session()->has('availTime')){ echo session()->getFlashdata('availTime');}?>">
          <input type="hidden" name="unavailDate" id="unavailDate" value="<?php if(session()->has('unavailDate')){ echo session()->getFlashdata('unavailDate');}?>">
          <label id="label1">Date</label>
          <label class="ttime">Time</label>
          <input type="text" name="appt_date" id="appt_date" class="datepicker dateee" placeholder="mm-dd-yyyy" value="<?php if(session()->has('date')) { echo session()->getFlashdata('date'); } ?>"required>
          <input type="time" name="appt_time" class="timee" step="3600" required>
        </div><br><br>

        <div class="user-box">
          <label>Branch Area</label>
          <label class="bname">Branch Name</label>
          <div class="select-dropdown" style="width: 41%;">
            <select id="area" name="area">
              <?php foreach($area as $cl):  ?>
                <option value=<?php echo $cl['area']; ?>><?php echo $cl['area'];?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="select-dropdown" id="cid">
             <select id="client_id" name="client_id">
              <option value=<?php echo $client_name['client_id']; ?>><?php echo $client_name['client_branch'];?></option>
            </select>
          </div>
        </div>

        <div class="user-box">
          <label>Service</label>
          <div class="select-dropdown" style="width: 90%;">
            <select id="serv_id" name="serv_id" required>
            <?php foreach($servName as $s):  ?>
              <optgroup label="<?= $s['serv_name']; ?>">
                <?php foreach($servType as $st):  ?>
                  
                    <?php if(session()->has('serv')):?>
                      <?php if(session()->getFlashdata('serv')== $st['serv_id']):?>
                        <?php if($st['serv_name'] == $s['serv_name']):?>
                          <option value=<?= $st['serv_id'];?> selected><?= $st['serv_type'];?></option>
                        <?php endif;?>
                      <?php else:?>
                        <?php if($st['serv_name'] == $s['serv_name']):?>
                          <option value=<?= $st['serv_id'];?>><?= $st['serv_type'];?></option>
                        <?php endif;?>
                      <?php endif;?>
                    <?php else:?>
                      <?php if($st['serv_name'] == $s['serv_name']):?>
                        <option value=<?= $st['serv_id'];?>><?= $st['serv_type'];?></option>
                      <?php endif;?>
                    <?php endif;?>
                  
                <?php endforeach; ?>
              </optgroup>
            <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="user-box" style="margin-bottom: -30px">
          <label>Device Brand</label>
          <label class="bname">Aircon Type</label>
          <div class="select-dropdown" style="width: 40%;">
            <select id="device_brand" name="device_brand">
            <?php foreach($device_brand as $d_b):  ?>
              <?php if(session()->has('device_brand')):?>
                <?php if(session()->getFlashdata('device_brand')== $d_b['device_brand']):?>
              <option value=<?php echo $d_b['device_brand']; ?> selected><?php echo $d_b['device_brand'];?></option>
                <?php else:?>
                <option value=<?php echo $d_b['device_brand']; ?>><?php echo $d_b['device_brand'];?></option>
                <?php endif;?>
              <?php else:?>
                <option value=<?php echo $d_b['device_brand']; ?>><?php echo $d_b['device_brand'];?></option>
              <?php endif;?>
            <?php endforeach; ?>
          </select>
          </div>
           <div class="select-dropdown" style="width: 40%;" id="cid">
            <select id="aircon_id" name="aircon_id">
              <?php if(session()->has('aircon_brand')):?>
              <?php foreach(session()->getFlashdata('aircon_brand') as $aircon):?>
                <?php if($aircon['aircon_id'] == session()->getFlashdata('aircon_id')):?>
                  <option value="<?=$aircon['aircon_id']?>" selected><?=$aircon['aircon_type']?></option>
                <?php else:?>
                  <option value="<?=$aircon['aircon_id']?>"><?=$aircon['aircon_type']?></option>
                <?php endif;?>
              <?php endforeach;?>
              <?php endif;?>
            </select>
          </div>
        </div>

        <div class="user-box">
          <input class="number" type="number" name="qty" placeholder="Quantity" min="1" value="<?php if(session()->has('qty')){ echo session()->getFlashdata('qty');};?>" required></input>
          <label class="fcunum">FCU Number</label>
          <select id="fcuno" name="fcuno[]" class="selectpicker" multiple data-selected-text-format="count > 3" required>
            <?php foreach($fcu_no as $f):  ?>
              <?php if(session()->has('fcuno')):?>
              <?php foreach(session()->getFlashdata('fcuno') as $postFcu): ?>
                <?php if($postFcu == $f['fcuno']):?>
                  <option value="<?php echo $f['fcuno']; ?>" selected><p id="s2option"><?php echo $f['fcu'];?></p></option>
                <?php else:?>
                  <option value="<?php echo $f['fcuno']; ?>"><p id="s2option"><?php echo $f['fcu'];?></p></option>
                <?php endif;?>
                <?php endforeach; ?>
              <?php else:?>
                <option value="<?php echo $f['fcuno']; ?>"><p id="s2option"><?php echo $f['fcu'];?></p></option>
              <?php endif;?>
            <?php endforeach; ?>
          </select>
        </div><br>

        <div class="container1">
          <button type="submit" class="btn btn-success">Submit</button>
          <a href="<?= base_url('/appointment');?>" class="back-btn">Back</a>
        </div>

      </div>
  </form>
</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
<script type="text/javascript">

  $("#aircon_id option").each(function() {
    if($(this).attr('selected')){
      $(this).siblings('[value="'+ this.value +'"]').remove();
    }
  });
  $(".aircon_id option").each(function() {
    $(this).siblings('[value="'+ this.value +'"]').remove();
  });
  $("#aircon_id").html($("#aircon_id option").sort(function (a, b) {
    return a.text == b.text ? 0 : a.text < b.text ? -1 : 1
  }));
  $('#fcuno .selectpicker').selectpicker();
// ---------------------------------

  // ------------------------------------------------
  var devbrand = <?php echo json_encode($brand); ?> ;
      // console.log(areas);
      

      $.each(devbrand[0], function(key, v) {
          // alert(value.client_id+" "+value.client_branch);
           // console.log(v);
           $.each(v, function(key, value) {
            <?php if(!session()->has('aircon_brand')):?>
            $("#aircon_id").append('<option value='+value.aircon_id+'>'+value.aircon_type+'</option>');
          <?php endif;?>
          });
         });
      $("#device_brand").change(function(){
        $("#aircon_id").empty();
        var current_value = document.getElementById("device_brand").selectedIndex;
        $.each(devbrand[current_value], function(key, v) {
          // alert(value.client_id+" "+value.client_branch);
          $.each(v, function(key, value) {
            $("#aircon_id").append('<option value="'+value.aircon_id+'" >'+value.aircon_type+'</option>')
          });
        });
        // $("#area").append('<option value='+'>My option</option>');
      });


var disableDates = <?php echo json_encode($date);?>;
var availTime = ['8:00 AM','9:00 AM','10:00 AM','11:00 AM','1:00 PM','2:00 PM','3:00 PM','4:00 PM','5:00 PM','6:00 PM'];

$("#appt_date").on("change", function() {
    var date = $(this).val();
    console.log(date);
     $.ajax({
         method: 'Post',
         url: 'http://localhost/tsms/appointment/check-date',
         data:{
            'date': date
         },
         success: function(response){
          var availableTime =[];
          // var result = [];
          var time = [];
          var timee = [];

          for (var i = 0; i < response.events_data.length; i++) {
            var resTime = response.events_data[i].TIME;
            timee.push(response.events_data[i].TIME);
            var formatTime = resTime.split(":");
            var timeFormatted;
            if(formatTime[0]>=12){
              var hour = formatTime[0] - 12;
              var amPm = "PM";
              timeFormatted = hour + ":" + formatTime[1] + " " + amPm;
            }else{
              var hour = formatTime[0];
              var amPm = "AM";
              timeFormatted = parseInt(hour) + ":" + formatTime[1] + " " + amPm;
            }

            time.push(timeFormatted);
          }
          availableTime = availTime.concat(time);
          const result = availableTime
        .filter(value=>{
              var count=0;
              for(var i=0;i<availableTime.length;i++)
              {
                  if(availableTime[i]===value)
                    count++;
              }
              return count===1;
          });

            var splitDate = date.split("/");
            var formatDate = splitDate[2]+"-"+splitDate[0]+"-"+splitDate[1];
            var dateFormatted = new Date(formatDate).toDateString();

          if(result.length<10){

            $("#availTime").val(timee.toString());
            
            Swal.fire(
              dateFormatted,
              '<b>Available Time:</b> ['+result+']',
              'question'
            )

            // alert("For "+dateFormatted+" the available time are "+result);
          }else if(result.length==0){
            $("#unavailDate").val('Unavailable');
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: dateFormatted+' is fully Booked, Please Choose another date',
            })
            // alert("Date is fully Booked, Please Choose another date");
          }
         },
         error: function(){
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong!',
          })
         }
       })

  });

  <?php if(session()->has('errorTime')){?>
    Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: '<?=session()->getFlashdata('errorTime');?>',
        });
  <?php }?>
  <?php if(session()->has('errorDate')){?>
    Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: '<?=session()->getFlashdata('errorDate');?>',
        });
  <?php }?>
  <?php if(session()->has('errorOpTime')){?>
    Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: '<?=session()->getFlashdata('errorOpTime');?>',
          footer: '<center>Allowed Time: ['+availTime+']',
        });
  <?php }?>
    </script>
<script type="text/javascript" src="<?= base_url('assets/js/resDate.js') ?>"></script>