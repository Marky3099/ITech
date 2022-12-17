<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/dashstyle.css')?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/print.css')?>">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">


<div class="body-content">
	<!-- <div class="header-img">
		<img src="<?= base_url('assets/image/imgicon.png');?>">
		<h2>MAYLAFLOR AIRCONDITIONING & REF. SVCS INC.</h2>
		<h4>  A. Dominguez  St., Malibay,  Pasay City,       1300 2958
			Telefax #:  8851-1005 / 8425-9958 /  8697-4066  / 8806-4790 
			Email Add:   maylaflorairconditioningref27@gmail.com
		</h4>
	</div> -->
	<div class="title">
		<h3>Detailed Preventive Maintenance Service Report</h3>
		<h4>From <?php if(isset($_GET['start_date'])){echo $_GET['start_date'];} ?> to <?php if(isset($_GET['to_date'])){echo $_GET['to_date'];} ?> </h4>
	</div>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card mt-5 card1">
					<div class="card-header">
						<h3>Detailed Preventive Maintenance Service Report (Accomplished Tasks)</h3>
					</div>				
					<div class="card-body py-2">
						<form action="<?= base_url('/reports/accomplished/filtered');?>" method="GET">
							
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Start Date:</label><br>
										<input type="date" name="start_date" class="form-control" value="<?php if(isset($_GET['start_date'])){echo $_GET['start_date'];} ?>">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>To Date:</label><br>
										<input type="date" name="to_date" class="form-control" value="<?php if(isset($_GET['to_date'])){echo $_GET['to_date'];} ?>">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<button type="submit" class="btn btn-success" id="sub">Generate</button>
									</div>
									<div class="form-group">
										<?php if(isset($_GET['start_date']) && isset($_GET['to_date'])): ?>
										<a href="<?= base_url('/reports/accomplished/filtered/print/'.$_GET['start_date']."/".$_GET['to_date'])?>" target="_blank" class="btn btn-success" id="print">Print</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
						
					</form>
				</div>	
			</div>
			

			<div class="card mt-4 card2">
				<div class="card-body">
					<?php if($event):?>
						<table class="table table-bordered" id="table1">
							<thead>
								<tr>
									<th>Date</th>
									<th>Task Code</th>
									<th>Branch Area</th>
									<th>Branch Name</th>
									<th>Service/Task</th> 
									<th>Service Type</th> 
									<th>Device Brand/Type</th> 
									<th>Aircon Type</th>
									<th>FCU No.</th>
									<th>Quantity</th> 
									<th>Assigned Person</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								
								<?php if(isset($event)): ?>
									
									<?php foreach($event as $dat):  ?>
										<tr>
											<td><?php echo date('m-d-Y',strtotime($dat->start_event)); ?></td>
											<td><?php echo $dat->event_code; ?></td>
											<td><?php echo $dat->area; ?></td>
											<td><?php echo $dat->client_branch; ?></td>
											<td><?php echo $dat->serv_name; ?></td>
											<td><?php echo $dat->serv_type; ?></td>
											<td>
											<?php $current =''; ?>

											<?php foreach($distinct as $data):  ?>
											<?php if($dat->id ==  $data->id): ?>
												<?php if($current !=  $data->device_brand):  ?>
												<?php echo  $data->device_brand;  ?> <hr>
												<?php $current =$data->device_brand; ?>
											<?php endif;  ?>
											<?php endif;  ?>
											<?php endforeach; ?>
								              </td>
								              <td>
											  <?php $current_aircon_type =''; ?>
												<?php foreach($distinct as $data):  ?>
													<?php if($dat->id ==  $data->id): ?>
													<?php if($current_aircon_type !=  $data->aircon_type):  ?>
														<?php echo $data->aircon_type;  ?> <hr>
														<?php $current_aircon_type =$data->aircon_type; ?>
													<?php endif;  ?>
													<?php endif;  ?>
												<?php endforeach; ?>
								           </td>
											<td>
												
											<?php foreach($distinct_event as $dis_event):  ?>  
                        
											<!--  -->
											<?php foreach($distinct as $dis):  ?>
											<?php $current_fcu =0; $concut = ''; ?> 
											<?php foreach($dat->fcu_array as $fcu_data):  ?> 
											

											<?php if( (int) $dis_event->id == $dis->id):  ?>

												<?php if( (int) $dis->id == $fcu_data->id):  ?>
													<?php if( (int) $dis->aircon_id == $fcu_data->aircon_id):  ?>

													<?php   $concut.= $fcu_data->fcu.' ' ?>

												<?php endif;  ?> 
												<?php endif;  ?> 
											<?php endif;  ?>

											<?php endforeach; ?>
											<?php if( $concut != ''):  ?>
											<?php echo  $concut;  ?> <hr> 
											<?php endif;  ?>    
										<?php endforeach; ?>
											<!--  -->
											
									<?php endforeach; ?>

											</td> 
											<td>
											<?php $current =''; ?>
											<?php foreach($distinct as $data):  ?>
												<?php if($dat->id ==  $data->id): ?>
												<?php if($current !=  $data->device_brand):  ?>
													<?php echo  $data->quantity;  ?> <hr>
													<?php $current =$data->device_brand; ?>
												<?php endif;  ?>
												<?php endif;  ?>
											<?php endforeach; ?>
										     </td> 
											<td>
												<?php $data = explode(',',$dat->emp_array);
												$count = 0;
												?>
												<?php foreach($data as $emp):  ?>
													<?php if($count < (count($data) - 1) ):  ?>
														* <?php echo $emp; $count+=1; ?> <br>
													<?php endif;  ?>
												<?php endforeach; ?>
											</td> 
											<td><?php echo $dat->status; ?></td>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>
								
							</tbody>
						</table>
					<?php else:?>
						<h5>No completed tasks yet.</h5>
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

<script type="text/javascript">
	$(document).ready( function () {
		$('#table1').DataTable({
			pageLength : 5,
			lengthMenu: [[5, 10, 15,20], [5, 10, 15, 20,]]
		});
	} );
</script>
