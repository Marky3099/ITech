<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/print.css')?>">
<link rel="stylesheet" href="<?= base_url('assets/css/formstyle.css')?>">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
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
                    <th>Time:</th>
                    <td id="modal_time"></td>
                  </tr>
                  <tr>
                    <th>Task Code:</th>
                    <td id="modal_event_code"></td>
                  </tr>
                  <tr>
                    <th>Log Code:</th>
                    <td id="modal_log_code"></td>
                  </tr>
                  <tr>
                    <th>Appt Code:</th>
                    <td id="modal_appt_code"></td>
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
                    <th>Service Name:</th>
                    <td id="modal_serv_name"></td>
                  </tr>
              </table>
            </div>
           <div class="col-md-6">
            <table class="table-hover" style="width:100%">
                  <tr>
                    <th>Service Type:</th>
                    <td id="modal_serv_type"></td>
                  </tr>
                  <tr>
                    <th>Device Brand:</th>
                    <td id="modal_dev_brand"></td>
                  </tr>
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
                    <th>Employee:</th>
                    <td id="modal_emp"></td>
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
	<div class="title">
		<h3>Detailed Exception Report</h3>
		<h4>From <?php if(isset($_GET['start_date'])){echo $_GET['start_date'];} ?> to <?php if(isset($_GET['to_date'])){echo $_GET['to_date'];} ?> </h4>
	</div>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card mt-5 mb-5 card1">
					<div class="card-header">
						<h3>Detailed Exception Report (Pending Tasks)</h3>
					</div>				
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
      </div>
			</div>
			

			<div class="card mt-4 card2">
				<div class="card-body">
					<?php if($task):?>
						<table class="table table-bordered table-hover" id="table1">
							<thead>
								<tr>
									<th>Date</th>
					                <th>Time</th>
					                <th>Task Code</th>
					                <th>Branch Name</th>
					                <th>Service</th>
					                <th>Status</th>
					                <th>Action</th>
								</tr>
							</thead>
							<tbody>
								
								<?php if(isset($task)): ?>
									
									<?php foreach($task as $dat):  ?>
										<tr>
											<td><?php echo date('m-d-Y',strtotime($dat->start_event)); ?></td>
											<?php $time = explode(":",$dat->time);?>
                                             <?php if($time[0] == '00'):?>
                                                 <td>N/A</td>
                                              <?php elseif ($time[0]>=12):?>
                                                  <?php $hour = $time[0] - 12;?>
                                                  <?php $amPm = "PM";?>
                                                  <td><?php echo $hour . ":" . $time[1] . " " . $amPm;?></td>
                                              <?php else:?>
                                                  <?php $hour = $time[0]; ?>
                                                  <?php $amPm = "AM"; ?>
                                                  <td><?php echo  ltrim($hour, '0') . ":" . $time[1] . " " . $amPm;?></td>
                                              <?php endif;?>
											<td><?php echo $dat->event_code; ?></td>
                                            <td><?php echo $dat->client_branch ?></td>
											<!-- <?php if($dat->log_code != ""):?>
						                    <td><?php echo $dat->log_code; ?></td>
						                    <?php else: ?>
						                       <td>N/A</td>
						                    <?php endif;?> -->
                                            <td><?php echo $dat->serv_type ?></td>
						                    <!-- <?php if($dat->appt_code != ""):?>
						                       <td><?php echo $dat->appt_code; ?></td>
						                    <?php else: ?>
						                       <td>N/A</td>
						                    <?php endif;?> -->
											<td><?php echo $dat->status; ?></td>
											<td><a href="#" id="<?=$dat->id?>" class="btn btn-info btn-sm view">View</a></td>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>
								
							</tbody>
						</table>
					<?php else:?>
						<h5>No pending tasks.</h5>
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

<script type="text/javascript">

    $("#select-filter").on('change',function()
    {
        var filterVal = $(this).val();
        if(filterVal == "Daily"){
            window.location.href = "<?= base_url('/reports/exception/filtered-daily');?>";
        }
        else if(filterVal == "Weekly"){
            window.location.href = "<?= base_url('/reports/exception/filtered-weekly');?>";
        }
        else if(filterVal == "Monthly"){
            window.location.href = "<?= base_url('/reports/exception/filtered-monthly');?>";
        }
        else if(filterVal == "Quarterly"){
            window.location.href = "<?= base_url('/reports/exception/filtered-quarterly');?>";
        }
        else if(filterVal == "Yearly"){
            window.location.href = "<?= base_url('/reports/exception/filtered-yearly');?>";
        }
    });
    $("#filter_client").on('change',function(){
        $("#filter-client").submit();
    });
	$(document).ready( function () {
		$('#table1').DataTable({
			pageLength : 5,
			lengthMenu: [[5, 10, 15,20], [5, 10, 15, 20,]]
		});
	} );
</script>
<script type="text/javascript" src="<?= base_url('assets/js/view.js')?>"></script>
