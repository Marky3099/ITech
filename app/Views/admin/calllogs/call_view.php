<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<link rel="stylesheet" href="<?= base_url('assets/css/style.css')?>">
<link rel="stylesheet" href="<?= base_url('assets/css/main.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/select2.css')?>">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">



<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
           <div class="col-md-6">
            
               <table class="table-hover" style="width:100%">
                  <tr>
                    <th>Date:</th>
                    <td id="modal_start_event"></td>
                  </tr>
                  <tr>
                    <th>Log Code:</th>
                    <td id="modal_log_code"></td>
                  </tr>
                  <tr>
                    <th>Branch Area:</th>
                    <td id="modal_area"></td>
                  </tr>
                  <tr>
                    <th>Branch Name:</th>
                    <td id="modal_branch"></td>
                  </tr>
                  <tr>
                    <th>Device Brand:</th>
                    <td id="modal_dev_brand"></td>
                  </tr>
              </table>
            </div>
           <div class="col-md-6">
            <table class="table-hover" style="width:100%">
                  <tr>
                    <th>Aircon Type:</th>
                    <td id="modal_aircon_type"></td>
                  </tr>
                  <tr>
                    <th>FCU #:</th>
                    <td id="modal_fcu"></td>
                  </tr>
                  <tr>
                    <th>Quantity:</th>
                    <td id="modal_qty"></td>
                  </tr>
                  <tr>
                    <th>Status:</th>
                    <td id="modal_status"></td>
                  </tr>
                  
              </table>
           </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="body-content">
    <div class="crud-text"><h3>Daily Call Logs</h3></div>
    <div class="d-flex">
        <!-- <a href="<?= base_url('calllogs/create/view') ?>" class="btn">Add Log</a> -->
    </div>
    <div class="event-header">

      <div class="card-body filter">
         <div class="row">
            <div class="col-lg-5">
                <select id="select-filter" class="form-control selectpicker">
                    <option disabled selected>Filter</option>
                    <?php $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];?>
                    <?php if(strpos($url,'filtered-daily')):?>
                        <option selected>Daily</option>
                        <option>Weekly</option>
                        <option>Monthly</option>
                        <option>Quarterly</option>
                        <option>Yearly</option>
                    <?php elseif(strpos($url,'filtered-weekly')):?>
                        <option>Daily</option>
                        <option selected>Weekly</option>
                        <option>Monthly</option>
                        <option>Quarterly</option>
                        <option>Yearly</option>
                    <?php elseif(strpos($url,'filtered-monthly')):?>
                        <option>Daily</option>
                        <option>Weekly</option>
                        <option selected>Monthly</option>
                        <option>Quarterly</option>
                        <option>Yearly</option>
                    <?php elseif(strpos($url,'filtered-quarterly')):?>
                        <option>Daily</option>
                        <option>Weekly</option>
                        <option>Monthly</option>
                        <option selected>Quarterly</option>
                        <option>Yearly</option>
                    <?php elseif(strpos($url,'filtered-yearly')):?>
                        <option>Daily</option>
                        <option>Weekly</option>
                        <option>Monthly</option>
                        <option>Quarterly</option>
                        <option selected>Yearly</option>
                    <?php else:?>
                        <option>Daily</option>
                        <option>Weekly</option>
                        <option>Monthly</option>
                        <option>Quarterly</option>
                        <option>Yearly</option>
                <?php endif;?>
                </select>
            </div>
            <div class="col-lg-5">
                <?php $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];?>
                <?php if(strpos($url,'filtered')):?>
                    <form method="Get" id="filter-client" action="<?php base_url($url)?>">
                    <select name="filter_client" id="filter_client" class="form-control selectpicker".<?=$url;?> data-live-search="true" data-clear-button="true" data-filter="true">
                        <option selected disabled value="">Branch Name</option>
                        <?php if($client):?>
                            <?php foreach($client as $c):?>
                                <?php if(isset($_GET['filter_client'])):?>
                                    <?php if($_GET['filter_client'] == $c['client_id']):?>
                                        <option value="<?= $c['client_id']?>" selected><?= $c['client_branch']?></option>
                                    <?php else:?>
                                        <option value="<?= $c['client_id']?>"><?= $c['client_branch']?></option>
                                    <?php endif;?>
                                <?php else:?>
                                    <option value="<?= $c['client_id']?>"><?= $c['client_branch']?></option>
                                <?php endif;?>
                            <?php endforeach;?>
                        <?php endif;?>
                    </select>
                    </form>
                <?php endif;?>
            </div>
            <div class="col-lg-2">
                <?php $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];?>
                <?php if(strpos($url,'filtered')):?>
                    <form method="get" action="<?= $url;?>" target="_blank">
                        <input type="hidden" name="print" value="print">
                        <?php if(isset($_GET['filter_client'])):?>
                            <input type="hidden" name="filter_client" value="<?=$_GET['filter_client']?>">
                        <?php endif;?>
                        
                        <button type="submit" class="btn btn-primary">Print</button>
                    </form>
                <?php endif;?>
            </div>
        </div>
   </form>
</div>   

</div>
<div class="mt-3 mr-5">
    <?php if($view_calllogs):?>
       <table class="table table-bordered table-hover" serv_id="users-list" id="event-table" style="font-size: 1rem;">
         <thead>
          <tr>
           <th>Date</th>
           <th>Log Code</th>
           <th>Status</th>
           <th>Action</th>
       </tr>
   </thead>
   <tbody>
       
      <?php foreach($view_calllogs as $call_log):  ?>
          <tr>
           <td><?php echo $call_log->date; ?></td>
           <td><?php echo $call_log->log_code; ?></td>
      
          <td><?php echo $call_log->status; ?></td>
         <td>
             <a href="#" id="<?php echo $call_log->cl_id;?>" class="btn btn-info btn-sm view">View</a>
          </td>
          </tr>
      <?php endforeach; ?>

</tbody>
</table>
<?php else: ?>
    <h1>No Call Logs</h1>
<?php endif; ?>
</div>
</div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">

$("#select-filter").on('change',function()
    {
        var filterVal = $(this).val();
        if(filterVal == "Daily"){
            window.location.href = "<?= base_url('/calllogs/filtered-daily');?>";
        }
        else if(filterVal == "Weekly"){
            window.location.href = "<?= base_url('/calllogs/filtered-weekly');?>";
        }
        else if(filterVal == "Monthly"){
            window.location.href = "<?= base_url('/calllogs/filtered-monthly');?>";
        }
        else if(filterVal == "Quarterly"){
            window.location.href = "<?= base_url('/calllogs/filtered-quarterly');?>";
        }
        else if(filterVal == "Yearly"){
            window.location.href = "<?= base_url('/calllogs/filtered-yearly');?>";
        }
    });
    $("#filter_client").on('change',function(){
        $("#filter-client").submit();
    });


 var msg = ''; 
 var del = '';
 var add = '';
 var update = '';
 <?php if(session()->has('msg')){?>
     msg = true;
     del = 'Log is Deleted Successfully';
 <?php }elseif(session()->has('add')){?>
     add = true;
     del = 'New Log is Added Successfully';
 <?php }elseif(session()->has('update')){?>
     update = true;
     del = 'Log Details are Updated Successfully';
     <?php }?>;

$('#mymodal .selectpicker').selectpicker();

      //cancel
      $(document).on('click','.cancel', function(e){
        var logCode = e.target.id;
        console.log(logCode);

        Swal.fire({
          title: 'Cancel the schedule of this Log??',
          // showDenyButton: true,
          showCancelButton: true,
          confirmButtonText: 'Yes',
          // denyButtonText: `Don't Cancel`,
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            // Swal.fire('Saved!', '', 'success')
            // alert(logCode);
            $.ajax({
             type: "POST",
             url:"http://localhost/tsms/calllogs/cancel",
             data: {
                'log_code': logCode
             },
             dataType: 'json',
              success: function(response){
                console.log(response);

              },
            });
            location.reload();
          }
        })
      })

      $(document).on('click','.view',function(e){
      // console.log(e.target.id);
      var id = e.target.id;
      // console.log(id);
      var options = { year: 'numeric', month: 'long', day: 'numeric' };

      var myModal = new bootstrap.Modal(document.getElementById('viewModal'));
      $.ajax({
         method: 'Post',
         url: 'http://localhost/tsms/calllogs/view',
         data:{
            'cl_id': id
         },
         success: function(response){
          console.log(response);
            var date = new Date(response.cl_data.date);
            var startEvent = date.toLocaleDateString("en-US",(options));
            var apptCode = response.cl_data.log_code;
            var clientId = response.cl_data.client_id;
            var clientData = response.client_data;
            var area;
            var branch;
            var fcuNoArr = new Array();
            var fcuData = response.fcu_data;
            var dis = response.distinct;
            var fcuNo;
            var dBrandArr = new Array();
            var airconTypeArr = new Array();
            var devBrand;
            var airconType;
            var qty = new Array();
            var quantity;

            // var qtyArr
            var statusData = response.cl_data.status;

            $('#modalTitle').html("["+apptCode+"] Schedule");
            $('#modal_start_event').html(startEvent);
            $('#modal_log_code').html(apptCode);

             for (var a = 0; a < clientData.length; a++) {
                if(clientId == clientData[a].client_id){
                  area = clientData[a].area;
                  branch = clientData[a].client_branch;
                }
             }
             $('#modal_area').html(area);
             $('#modal_branch').html(branch);

            for (var i = 0; i < dis.length; i++) {
              dBrandArr.push(response.distinct[i].device_brand);
              airconTypeArr.push(response.distinct[i].aircon_type);
            }
            
            devBrand = dBrandArr.toString();
            airconType = airconTypeArr.toString();

            $('#modal_dev_brand').html(devBrand);
            $('#modal_aircon_type').html(airconType);

            for (var i = 0; i < fcuData.length; i++) {
              if(id == fcuData[i].cl_id){
               fcuNoArr.push(response.fcu_data[i].fcu);
              }
            }
            var pre = 0;
            for (var i = 0; i < fcuData.length; i++) {
                if(id == fcuData[i].cl_id){
                    if(fcuData[i].aircon_id!=pre){
                        // console.log(response.fcu_data[i].qty);
                        qty.push(response.fcu_data[i].qty);
                        pre = fcuData[i].aircon_id;
                    }
                }
            }
            fcuNo = fcuNoArr.toString();
            quantity = qty.toString();
            $('#modal_fcu').html(fcuNo);
            $('#modal_qty').html(quantity);
            $('#modal_status').html(statusData);
            // console.log(response);
            myModal.show();
         }
      })
   })

var areas = <?php echo json_encode($client_area); ?> ;


 </script>
 <script type="text/javascript" src="<?= base_url('assets/js/crud.js')?>"></script>