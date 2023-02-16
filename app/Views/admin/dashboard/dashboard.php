<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/dashstyle.css')?>">
<?php if($_SESSION['position'] == USER_ROLE_EMPLOYEE):?>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/main.min.css')?>">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<link rel="stylesheet" href="<?= base_url('assets/css/style.css')?>">
<?php endif;?>

</head>
<body>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4" style="margin-top: 10px;">
    <h3 class="hfont">Dashboard</h3>
  </div>
                        <!-- Modal for displaying today's event -->

                        <div class="container">
                          <div class="modal fade" id="todayModal" role="dialog">
                            <div class="modal-dialog" style="max-width: 1000px;">
                              <div class="modal-content">

                                <div class="modal-header">
                                  <h4 class="modal-title">Today's Scheduled Task</h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                  <?php if($eventToday):?>
                                    <table class="table table-bordered">
                                      <thead>
                                        <tr>
                                          <th>Task Code</th>
                                          <th>Branch</th>
                                          <th>Service</th>
                                          <th>Technician</th>
                                          <th>Status</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        
                                        <?php foreach($eventToday as $tday):  ?>
                                          <tr>
                                            <td><?php echo $tday->event_code; ?></td>
                                            <td><?php echo $tday->client_branch; ?></td>
                                            <td><?php echo $tday->serv_type; ?></td>
                                            <td>
                                             <?php $data = explode(',',$tday->emp_array);
                                             $count = 0;
                                             ?>
                                             <?php foreach($data as $emp):  ?>
                                               <?php if($count < (count($data) - 1) ):  ?>
                                                 ` <?php echo $emp; $count+=1; ?> <br>
                                               <?php endif;  ?>
                                             <?php endforeach; ?>
                                           </td> 
                                           <td><?php echo $tday->status;?></td>
                                      </tr>
                                    <?php endforeach;?>
                                  </tbody>
                                </table>
                                
                              <?php else:?>
                                <div class="Nowork">
                                  <p class="noworkstatement"><i class="fa-solid text-success fa-circle-exclamation"></i>&nbsp;Relax.. No work for Today!</p>
                                </div>
                              <?php endif;?>
                              
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>


                    <!-- Modal for displaying Week's event -->
                    <div class="container">
                      <div class="modal fade" id="weekModal" role="dialog">
                        <div class="modal-dialog" style="max-width: 1000px;">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h4 class="modal-title">Weekly Scheduled Task</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              
                            </div>
                            <div class="modal-body">
                              <?php if($week1):?>
                                <table class="table table-bordered">
                                  <thead>
                                    <tr>
                                      <th>Date</th>
                                      <th>Task Code</th>
                                      <th>Branch</th>
                                      <th>Service</th>
                                      <th>Technician</th>
                                      <th>Status</th>
                                      
                                    </tr>
                                  </thead>
                                  <tbody>
                                    
                                    <?php foreach($week1 as $week):  ?>
                                      <tr>
                                        <td><?php echo date('m-d-Y',strtotime($week->start_event)); ?></td>
                                        <td><?php echo $week->event_code; ?></td>
                                        <td><?php echo $week->client_branch; ?></td>
                                        <td><?php echo $week->serv_type; ?></td>
                                        <td>
                                         <?php $data = explode(',',$week->emp_array);
                                         $count = 0;
                                         ?>
                                         <?php foreach($data as $emp):  ?>
                                           <?php if($count < (count($data) - 1) ):  ?>
                                             ` <?php echo $emp; $count+=1; ?> <br>
                                           <?php endif;  ?>
                                         <?php endforeach; ?>
                                       </td> 
                                       <td><?php echo $week->status;?></td>
                                       
                                     </tr>
                                   <?php endforeach;?>
                                   
                                   
                                 </tbody>
                               </table>
                             <?php else:?>
                              <div class="Nowork">
                               <p class="noworkstatement"><i class="fa-solid text-success fa-circle-exclamation"></i>&nbsp;Relax.. No work for this week!</p>
                             </div>
                           <?php endif;?>
                         </div>
                         <div class="modal-footer">
                          <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Modal for displaying Month's event -->
                <div class="container">
                  <div class="modal fade" id="monthModal" role="dialog">
                    <div class="modal-dialog" style="max-width: 1000px;">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title">Monthly Scheduled Task</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          
                        </div>
                        <div class="modal-body">
                         <?php if($month):?>
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th>Date</th>
                                <th>Task Code</th>
                                <th>Branch</th>
                                <th>Service</th>
                                <th>Technician</th>
                                <th>Status</th>
                                
                              </tr>
                            </thead>
                            <tbody>
                             
                              <?php foreach($month as $m):  ?>
                                <tr>
                                  <td><?php echo date('m-d-Y',strtotime($m->start_event)); ?></td>
                                  <td><?php echo $m->event_code; ?></td>
                                  <td><?php echo $m->client_branch; ?></td>
                                  <td><?php echo $m->serv_type; ?></td>
                                  <td>
                                   <?php $data = explode(',',$m->emp_array);
                                   $count = 0;
                                   ?>
                                   <?php foreach($data as $emp):  ?>
                                     <?php if($count < (count($data) - 1) ):  ?>
                                       ` <?php echo $emp; $count+=1; ?> <br>
                                     <?php endif;  ?>
                                   <?php endforeach; ?>
                                 </td> 
                                 <td><?php echo $m->status;?></td>
                                 
                               </tr>
                             <?php endforeach;?>

                           </tbody>
                         </table>
                       <?php else:?>
                        <div class="Nowork">
                          <p class="noworkstatement"><i class="fa-solid text-success fa-circle-exclamation"></i>&nbsp;Relax.. No work for this month!</p>
                        </div>
                      <?php endif;?>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
  <!-- Modal for displaying today's event -->
<!--   <div class="container">
    <div class="modal fade" id="todayModal" role="dialog">
      <div class="col-12 col-lg-12 col-md-12 col-sm-12 overflow-auto">
        <div class="modal-dialog" style="max-width: 1000px;">
          <div class="modal-content"  style="width: 100%">
            <div class="modal-header">
              <h4 class="modal-title">Today's Scheduled Task</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button> -->


  <!-- Modal for displaying Completed event -->
  <div class="container">
    <div class="modal fade" id="completeModal" role="dialog">
      <div class="col-12 col-lg-12 col-md-12 col-sm-12 overflow-auto">
        <div class="modal-dialog" style="max-width: 1000px;">
          <div class="modal-content" style="width: 100%">
            <div class="modal-header">
              <h4 class="modal-title">Completed Tasks</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>                      
            </div>

            <div class="modal-body">
              <?php if($completed):?>
                <table class="display" id="example3" style="width: 100%">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Task Code</th>
                      <th>Branch</th>
                      <th>Service</th>
                      <th>Technician</th>
                      <th>Status</th>        
                    </tr>
                  </thead>
                  <tbody>                         
                    <?php foreach($completed as $cm):  ?>
                      <tr>
                        <td><?php echo date('m-d-Y',strtotime($cm->start_event)); ?></td>
                        <td><?php echo $cm->event_code; ?></td>
                        <td><?php echo $cm->client_branch; ?></td>
                        <td><?php echo $cm->serv_type; ?></td>
                        <td>
                         <?php $data = explode(',',$cm->emp_array);
                         $count = 0;
                         ?>
                         <?php foreach($data as $emp):  ?>
                           <?php if($count < (count($data) - 1) ):  ?>
                             ` <?php echo $emp; $count+=1; ?> <br>
                           <?php endif;  ?>
                         <?php endforeach; ?>
                        </td> 
                        <td><?php echo $cm->status;?></td>  
                      </tr>
                    <?php endforeach;?>
                  </tbody>
                </table>
                <?php else:?>
                  <div class="Nowork">
                    <p class="noworkstatement"><i class="fa-solid text-success fa-circle-exclamation"></i>&nbsp;No completed tasks so far.</p>
                  </div>
                <?php endif;?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal for displaying Pending event -->
  <div class="container">
    <div class="modal fade" id="pendingModal" role="dialog">
      <div class="col-12 col-lg-12 col-md-12 col-sm-12 overflow-auto">
        <div class="modal-dialog" style="max-width: 1000px;">
          <div class="modal-content"  style="width: 100%">
            <div class="modal-header">
              <h4 class="modal-title">Pending Tasks</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
              <?php if($notdone):?>
                <table class="display" id="example4" style="width: 100%">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Task Code</th>
                      <th>Branch Name</th>
                      <th>Service</th>
                      <th>Technician</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>                   
                    <?php foreach($notdone as $nd):  ?>
                      <tr>
                        <td><?php echo date('m-d-Y',strtotime($nd->start_event)); ?></td>
                        <td><?php echo $nd->event_code; ?></td>
                        <td><?php echo $nd->client_branch; ?></td>
                        <td><?php echo $nd->serv_type; ?></td>
                        <td>
                         <?php $data = explode(',',$nd->emp_array);
                         $count = 0;
                         ?>
                         <?php foreach($data as $emp):  ?>
                           <?php if($count < (count($data) - 1) ):  ?>
                             ` <?php echo $emp; $count+=1; ?> <br>
                           <?php endif;  ?>
                         <?php endforeach; ?>
                       </td> 
                       <td><?php echo $nd->status;?></td>
                      </tr>
                    <?php endforeach;?>
                  </tbody>
                </table>
                <?php else:?>
                  <div class="Nowork">
                    <p class="noworkstatement"><i class="fa-solid text-success fa-circle-exclamation"></i>&nbsp;Hoorayyy!!.. All Tasks are Complete!</p>
                  </div>
                <?php endif;?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal for displaying Pending Appointments -->
  <div class="container">
    <div class="modal fade" id="apptModal" role="dialog">
      <div class="col-12 col-lg-12 col-md-12 col-sm-12 overflow-auto">
        <div class="modal-dialog" style="max-width: 700px;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Pending Appointments</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <?php if($appt_pending):?>
                <table class="display" id="example5" style="width: 100%">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Appt Code</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($appt_pending as $p):  ?>
                      <tr>
                        <td><?php echo date('m-d-Y',strtotime($p->appt_date)); ?></td>
                        <td><?php echo $p->appt_code; ?></td>
                        <td><?php echo $p->appt_status;?></td>
                      </tr>
                    <?php endforeach;?>
                  </tbody>
                </table>
                <?php else:?>
                  <div class="Nowork">
                    <p class="noworkstatement"><i class="fa-solid text-success fa-circle-exclamation"></i>&nbsp;No Pending Appointments!</p>
                  </div>
                <?php endif;?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal for displaying Pending Call Logs -->
  <div class="container">
    <div class="modal fade" id="logModal" role="dialog">
      <div class="col-12 col-lg-12 col-md-12 col-sm-12 overflow-auto">
        <div class="modal-dialog" style="max-width:700px;">
          <div class="modal-content" style="width: 100%">
            <div class="modal-header">
              <h4 class="modal-title">Pending Logs</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <?php if($log_pending):?>
                <table class="display" id="example6" style="width: 100%">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Log Code</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($log_pending as $p):  ?>
                      <tr>
                        <td><?php echo date('m-d-Y',strtotime($p->date)); ?></td>
                        <td><?php echo $p->log_code; ?></td>
                        <td><?php echo $p->status;?></td>
                      </tr>
                    <?php endforeach;?>
                  </tbody>
                </table>
                <?php else:?>
                  <div class="Nowork">
                    <p class="noworkstatement"><i class="fa-solid text-success fa-circle-exclamation"></i>&nbsp;No Pending Appointments!</p>
                  </div>
               <?php endif;?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- Content Row -->
<div class="row">

  <!-- Card for displaying the total count of today's event -->
  <div class="col-12 col-lg-3 col-md-6 col-sm-12 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body1">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1">
              Daily: <?= date('F j, Y');?></div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">Number of task:&nbsp;<a href="#" data-toggle="modal" data-target="#todayModal" id="iconbox"><?= json_encode($today_event);?></a></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300" id="iconbox"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Weekly -->
    <div class="col-12 col-lg-3 col-md-6 col-sm-12 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body1">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">
                Weekly: <?php 
                $monday = strtotime('last monday', strtotime('tomorrow'));

                $sunday = strtotime('+6 days', $monday);
                echo date('F j', $monday) . " - " . date('F j, Y', $sunday);?></div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Number of task: <a href="#" data-toggle="modal" data-target="#weekModal" id="iconbox"><?= json_encode($weekly_event);?></a></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-gray-300" id="iconbox"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Monthly -->
      <div class="col-12 col-lg-3 col-md-6 col-sm-12 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body1">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">
                 Monthly: <?= date('F Y');?></div>
                 <div class="h5 mb-0 font-weight-bold text-gray-800">Number of task:&nbsp;<a href="#" data-toggle="modal" data-target="#monthModal" id="iconbox"><?= json_encode($monthly_event);?></a></div>
               </div>
               <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-gray-300" id="iconbox"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--Completed -->
      <div class="col-12 col-lg-3 col-md-6 col-sm-12 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body1">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Completed: <?= json_encode($complete_event);?> out of <?= json_encode($event_total);?>
              </div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" ><a href="#" data-toggle="modal" data-target="#completeModal" id="iconbox">

                    <?php if(json_encode($event_total) > 0):?>
                      <?= json_encode($percent);?>%
                      <?php else:?>0%
                    <?php endif;?>
                  </a></div>
                </div>
                <div class="col">
                  <div class="progress progress-sm mr-2">
                    <div class="progress-bar bg-success" role="progressbar"
                    style="width: <?php if(json_encode($event_total) > 0):?>
                    <?= json_encode($percent);?>%
                    <?php else:?>0%
                    <?php endif;?>;" aria-valuenow="<?= json_encode($complete_event);?>" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300" id="iconbox"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-12 col-lg-3 col-md-6 col-sm-12 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body1">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">
              Pending Tasks</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">Number of task:&nbsp;<a href="#" data-toggle="modal" data-target="#pendingModal" id="iconbox"><?= json_encode($pending_event);?></a></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-gray-300" id="iconbox"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Pending Appointments -->
    <?php if($_SESSION['position'] == USER_ROLE_ADMIN){?>
    <div class="col-12 col-lg-3 col-md-6 col-sm-12 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body1">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">
              Pending Appointments</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">Number of task:&nbsp;<a href="#" data-toggle="modal" data-target="#apptModal" id="iconbox"><?= json_encode($count_appt);?></a></div>
            </div>
            <div class="col-auto">
            <i class="fas fa-comments fa-2x text-gray-300" id="iconbox"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Pending Call logs -->
    <div class="col-12 col-lg-3 col-md-6 col-sm-12 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body1">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">
              Pending Logs</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">Number of task:&nbsp;<a href="#" data-toggle="modal" data-target="#logModal" id="iconbox"><?= json_encode($count_log);?></a></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-phone-alt fa-2x text-gray-300" id="iconbox"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php }?>
  </div>
<?php if($_SESSION['position'] == USER_ROLE_ADMIN || $_SESSION['position'] == USER_ROLE_SECRETARY):?>
<div class="row">
  <div class="col-12 col-lg-6 col-md-6 col-sm-12 col-xss-12" id="chart_div" style="width: 100%; height: 500px;"></div>
  <div class="col-12 col-lg-6 col-md-6 col-sm-12 col-xss-12" id="piechart_3d" style="width: 100%; height: 500px;"></div>
  <div class="col-12 col-lg-6 col-md-6 col-sm-12 col-xss-12" id="barchart_material" style="width: 100%; height: 500px;"></div>
  <div class="col-12 col-lg-6 col-md-6 col-sm-12 col-xss-12" id="piechart1_3d" style="width: 100%; height: 500px;"></div>

</div>
<?php else:?>
  <div class="body-content">
  <div class="col-sm-8">
    <div class="crud-text"><h3>Calendar</h3></div>
 </div>
 <br><br>
<div class="row justify-content-end">
  <div class="col-12 col-lg-4 col-md-4 col-sm-12">
    <div class="card legend-box" id="cal1">
    <div class="card-header">Legend</div>
    <div class="card-body">
      <ul class="legend-list">
        <?php foreach ($servName as $s): ?>
          <li ><i class="fas fa-circle" style="color: <?=$s['serv_color'];?>"></i><?=$s['serv_name'];?></li>
        <?php endforeach ?>
      </ul>
    </div>
    </div>
  </div>
</div>

<div id='calendar' class="col-lg-12 col-md-10" style="width:100%;"></div>
<div id='datepicker'></div>
</div>
</div>

<!-- update -->
<div class="modal fade" id="mymodal2" tabindex="-1" role="dialog">
  <div class="modal-dialog" id="dialog2" role="document">
    <div class="modal-content">
     
      <div class="modal-header">
        <h3 class="modal-title">Your Schedule</h3>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('/calendar/update');?>" method="POST"> 
        <div class="modal-body" id="adata">
          <input type="hidden" name="id" id="id" value="">
          
          <!-- <div class="crud-text"><button class="btn btn-info clientMap" style="float: right;">View Client Location</button><h5>Client Details:</h5> </div> -->
          <input type="hidden" name="title_update" id="title_update" placeholder="Title">
          
          <div class="form-row">
          <div class="form-group col-md-4">
              <label for="event_code">Event Code: </label>
              <input type="text" name="event_code" id="event_code" value="" disabled>
            </div>
            <div class="form-group col-md-4">
             <label for="start_event_update">Date</label><br>
             <input type="date" name="start_event_update" id="start_event_update" disabled>
           </div>
           <div class="form-group col-md-4">
            <label for="time_update">Time</label><br>
            <input type="time" name="time_update" id="time_update" disabled>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="area_update">Branch Area</label><br>
            <div class="select-dropdown">
              <select id="area_update" name="area_update" class="form-control" disabled>
            </select>
            </div>
          </div>
          <div class="form-group col-md-6">
            <label for="client_id_update">Branch Name</label><br>
            <div class="select-dropdown">
              <select id="client_id_update" name="client_id_update" class="form-control" disabled>
            </select>
            </div>
          </div>
        </div>
        
        <div class="form-group" id="serv-form">
          <label for="serv_id_update" id="serv_id1">Service</label><br>
          <div class="select-dropdown" id="serv-select">
          <select class="form-control" id="serv_id_update" name="serv_id_update" disabled>
            <?php foreach($servName as $s):  ?>
              <optgroup label="<?= $s['serv_name']; ?>">
                <?php foreach($servType as $st):  ?>
                  <?php if($st['serv_name'] == $s['serv_name']):?>
                    <option value=<?= $st['serv_id'];?>><?= $st['serv_type'];?></option>
                  <?php endif;?>
                <?php endforeach; ?>
              </optgroup>
            <?php endforeach; ?>
          </select>
        </div> 
      </div><br>

         <div class="crud-text"><h5>Aircon Details:</h5></div>

        <!-- =================================================== -->
        <div id="auth-rows-edit"></div>


        <!-- <div class="form-row" >
          <div class="form-group col-md-12" align="center" style="background-color:lightgreen;">
            <span id="add_aut_update" class="btn btn-primary"><i class="fa-solid fa-plus"></i></span>
          </div> 
        </div> -->

        <div class="form-group">
          <label class="ml-5 mt-3" for="emp_id_update">Technician</label><br>
          <select id="emp_id_update" name="emp_id_update[]" class="form-control w-75 ml-5 selectpicker border border-dark" multiple data-selected-text-format="count > 8" disabled>
            <!--  -->
          </select>
        </div>    
        <div class="form-group">
          <label class="emp_idlbll" for="comments">Comments/Suggestions</label><br>
          <textarea name="comments_update" id="comments_update" class="form-control w-75 ml-5 selectpicker border border-dark" cols="50" rows="4" disabled></textarea>
        </div> 
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn py-2 btn-secondary" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
<div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Location</h5>
        <button type="button" class="close closeMap" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3263.240532433746!2d120.99173841427947!3d14.565696581837399!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c978cf8fa931%3A0x49d18a0954259306!2sBDO%20Taft%20-%20Vito%20Cruz%20Branch!5e1!3m2!1sen!2sph!4v1675578495936!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary closeMap">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<?php endif;?>



  <!-- Bootstrap core JavaScript-->
  
  <div class="row justify-content-center">
  </div>

  </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>

<script>
$(document).ready(function() {
   var table = $('#example').DataTable( {
         responsive: true
   } );
} );

$(document).ready(function() {
   var table = $('#example1').DataTable( {
         responsive: true
   } );
} );

$(document).ready(function() {
   var table = $('#example2').DataTable( {
         responsive: true
   } );
} );

$(document).ready(function() {
   var table = $('#example3').DataTable( {
         responsive: true
   } );
} );

$(document).ready(function() {
   var table = $('#example4').DataTable( {
         responsive: true
   } );
} );

$(document).ready(function() {
   var table = $('#example5').DataTable( {
         responsive: true
   } );
} );

$(document).ready(function() {
   var table = $('#example6').DataTable( {
         responsive: true
   } );
} );
</script>

<script type="text/javascript">
  // var eventsToday = <?= json_encode($eventsToday); ?>;
  var pendingEvents = <?= json_encode($pending_events); ?>;
  var date = new Date($.now());
  var dateMonth = date.getMonth()+1;
  if(dateMonth < 10){
    dateMonth = "0"+dateMonth;
  }
  var dateDay = date.getDate();
  if(dateDay < 10){
    dateDay = "0"+dateDay;
  }
  var dateYear = date.getFullYear();
  var dateHour = date.getHours();
  if(dateHour < 10){
    dateHour = "0"+dateHour;
  }
  var fullDate = dateYear+"-"+dateMonth+"-"+dateDay;
  //Automating emailing the client for today's tasks
  // console.log(eventsToday.length);
  // setInterval(function () {

  // },1000);
  //Automating MArking as Done Tasks
  setInterval(function () {
    for (var i = 0; i < pendingEvents.length; i++) {
      var pendingTime = pendingEvents[i].end_time;
      var splitt = pendingTime.split(":");
      // console.log(splitt[0]);
      if(pendingEvents[i].start_event <= fullDate){
        if(pendingEvents[i].start_event == fullDate){
          if(splitt[0] <= dateHour){
            $.ajax({
             method:"POST",
             url:'<?=base_url("/dashboard/auto-done")?>',
             data: {
                'id': pendingEvents[i].id
             },
             success: function(response){
              // console.log(response);
             }
            })
          }
        }else{
          if(splitt[0] <= dateHour){
            $.ajax({
             method:"POST",
             url:'<?=base_url("/dashboard/auto-done")?>',
             data: {
                'id': pendingEvents[i].id
             },
             success: function(response){
              // console.log(response);
             }
            })
          }
        }
      }
    }
  }, 1000);
<?php if($_SESSION['position'] == USER_ROLE_ADMIN || $_SESSION['position'] == USER_ROLE_SECRETARY):?>
  let servLabelColor = <?= json_encode($servLabelColor); ?>;

  google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var servData = google.visualization.arrayToDataTable([
          ['Service', 'Service total'],
          // ['Checkup', 1],['General cleaning', 13],['Installation', 1]
          <?php
            foreach ($serviceData as $serviceData) {
              echo $serviceData;
            }
          ?>
        ]);
        var overallData = google.visualization.arrayToDataTable([
          ['Name', 'Ratings'],
          // ['Checkup', 1],['General cleaning', 13],['Installation', 1]
          ['Positive Ratings',<?php
              echo $overallPerformance;
          ?>],
          ['Negative Ratings',<?php
              echo $totality;
          ?>],
        ]);

        var taskData = google.visualization.arrayToDataTable([
          ['Task', 'Total Tasks'],
          // ['Checkup', 1],['General cleaning', 13],['Installation', 1]

          <?php
            foreach ($taskDate as $taskDate) {
              echo $taskDate;
            }
          ?>
         
        ]);

        var empData = google.visualization.arrayToDataTable([
          ['Name','Ratings'],
          <?php
            foreach ($performEmp as $perEmp) {
              echo $perEmp;
            }
          ?>
          
        ]);


        var servOptions = {
          title: 'Services Trend',
          is3D: true,
          colors: servLabelColor
        };
        var overallOptions = {
          title: 'Company Ratings',
          is3D: true,
          colors: ['#1AEF17','#EC0D03']
        };

        var taskOptions = {
          title: 'Task Summary per Month',
          hAxis: {title: 'Month',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var empOptions = {
          title: 'Technician\'s Performance',
          // isStacked: 'percent',
          bars: 'horizontal', // Required for Material Bar Charts.
           // vAxis: { 
           //    title: "Ratings on Performance", 
           //    viewWindowMode:'explicit',
           //    viewWindow:{
           //      max:100,
           //      min:0
           //    }
           //  }

          // colors: servLabelColor
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        var chart2 = new google.visualization.AreaChart(document.getElementById('chart_div'));
        var chart3 = new google.visualization.BarChart(document.getElementById('barchart_material'));
        var chart4 = new google.visualization.PieChart(document.getElementById('piechart1_3d'));
        chart4.draw(overallData, overallOptions);
        chart3.draw(empData,empOptions);
        chart.draw(servData, servOptions);
        chart2.draw(taskData, taskOptions);
      };
  <?php endif;?>

  let done = ''; 
  let pending = '';
  <?php if(session()->has('done')){?>
   done = true;
 <?php }elseif(session()->has('pending')){?>
  pending = true;
  <?php } ?>;

<?php if($_SESSION['position'] == USER_ROLE_EMPLOYEE):?>
  <?php if(session()->has('assignCount')):?>
    var assignCount = <?=session()->getFlashdata('assignCount')?>;
    if(assignCount > 0){
      Swal.fire({
        title: 'You have '+assignCount+' work to do today',
        showClass: {
          popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
          popup: 'animate__animated animate__fadeOutUp'
        }
      })
    }
  <?php endif;?>
<?php endif;?>
</script>
<script type="text/javascript" src="<?=base_url('assets/js/dashboardjs.js')?>"></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment-with-locales.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.0.1/fullcalendar.js"></script>
<!-- Time Picker -->
<!-- <script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>   -->
<script src = "https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>  
<!-- <script src = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>   -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
<!--  -->

<!-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js"></script> -->
<script src="<?=base_url("assets/js/main.min.js")?>"></script>


<script type="text/javascript">
// Calendar Variables--------------------
<?php if($_SESSION['position'] == USER_ROLE_EMPLOYEE):?>
var event = <?php echo json_encode($event); ?>;

var areas = <?php echo json_encode($area); ?>;
var c_area = <?php echo json_encode($client_area2); ?> ;

var emp_all = <?php echo json_encode($empDatas); ?>;
// console.log();
var areas1 = <?php echo json_encode($client_area); ?> ;
var airconD = <?php echo json_encode($client_area); ?> ;
var distinct = <?php echo json_encode($distinct); ?> ;
var distinctEvent = <?php echo json_encode($distinct_event); ?> ;
var deviceBrand = <?php echo json_encode($device_brand); ?> ;
 
 // console.log(distinct);
 //  console.log(deviceBrand);


var count = 1;
var count_update = 1;

  // console.log(event);

  $("#add_aut").click(function(e){
    var html3 = `<div class="form-row" id="row">
    <div class="form-group col-md-3">
    
    <label for="dbrand">Device Brand</label>
    <select id="device_brand" name="device_brand[]" class="form-control " data-id="`+count+`"required>
    <option value="0">Select Brand</option>
    <?php foreach($device_brand as $d_b):  ?>
      <option value=<?php echo $d_b['device_brand']; ?>><?php echo $d_b['device_brand'];?></option>
    <?php endforeach; ?>
    </select>
    </div> 
    <div class="form-group col-md-3">
    
    <label for="aircont">Aircon Type</label>
    <select id="aircon_id_`+count+`" name="aircon_id[]" class="form-control aircon" required>
    <option value="0">Select Type</option>
    </select>
    </div> 
    <div class="form-group col-md-3">
    
    <label for="fcunos">Fcuno</label>
    <select id="fcuno" name="fcuno`+count+`[]" class="selectpicker" data-width="100%" multiple data-selected-text-format="count > 2">
    <?php foreach($fcu_no as $f):  ?>
      <option value="<?php echo $f['fcuno']; ?>"><p id="s2option"><?php echo $f['fcu'];?></p></option>
    <?php endforeach; ?>
    </select>
    </div> 
    <div class="form-group col-md-2">
    
    <label for="fcunos">Quantity</label>
    <input type="number" class="form-control" name="quantity[]" id="quantity" min="1" value="1" required>
    </div> 
    <div class="form-group col-md-1"><br>
    <span id="auth-del" class="btn"><i class="fas fa-minus"></i></span>
    </div>
    </div>`;



    
    count++;
    $('#auth-rows').append(html3);
    
    $('#mymodal .selectpicker').selectpicker();

  });

// ------------------------------------

   $("#add_aut_update").click(function(e){
    var html3 = `<div class="form-row" id="row" style="background-color:lightgreen;">
    <div class="form-group col-md-3">
    
    <label for="dbrand">Device Brand</label>
    <select id="device_brand_update" name="device_brand[]" class="form-control " data-id="`+count_update+`"required>
    <option value="0">Select Brand</option>
    <?php foreach($device_brand as $d_b):  ?>
      <option value=<?php echo $d_b['device_brand']; ?>><?php echo $d_b['device_brand'];?></option>
    <?php endforeach; ?>
    </select>
    </div> 
    <div class="form-group col-md-3">
    
    <label for="aircont">Aircon Type</label>
    <select id="aircon_update_id_`+count_update+`" name="aircon_update_id[]" class="form-control aircon" data-id="`+count_update+`" required>
    <option value="0">Select Type</option>
    </select>
    </div> 

    <div class="form-group col-md-3">
    
    <label for="fcunos">Fcuno</label>
    <select id="fcuno_update_`+count_update+`"  class="selectpicker" data-width="100%" multiple data-selected-text-format="count > 2">
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
    <input type="number" class="form-control" name="quantity[]" id="quantity" min="1" value="1" required>
    </div> 
    <div class="form-group col-md-1"><br>
    <span id="auth-del-edit" class="btn"><i class="fas fa-minus"></i></span>
    </div>
    </div>`;



    count_update++;
    $('#auth-rows-edit').append(html3);
    
    $('#mymodal2 .selectpicker').selectpicker();

  });



  $('#auth-rows').on('click', '#auth-del', function(E){

    $(this).parents('#row').remove();

  });
  $('#auth-rows-edit').on('click', '#auth-del-edit', function(E){

    $(this).parents('#row').remove();

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

  $(document).on('change', '#device_brand_update', function(){
    var category_id = $(this).val();
    var aircon = $(this).data('id');
    alert(aircon+' '+category_id);
    $.ajax({
      url: 'http://localhost/tsms/aircon/brand/'+category_id,
      method:"GET",
      success:function(data)
      {
        var res = JSON.parse(data);
        
        var html = '';
        html += res.options;
        $('#aircon_update_id_'+aircon).html(html);

      },
      error:function(e){
        console.log(e);
      }
    })
  });

  $(document).on('change','.aircon', function(){
    var aircon_id = $(this).val();
    var count_aircon = $(this).data('id');
    // document.getElementById('fcuno_update_'+aircon).id = 'fcuno_update_';
    $('#fcuno_update_'+count_aircon).attr('name','fcuno_update_'+aircon_id+'[]');
    alert(aircon_id);
   
  });

  $('#mymodal .selectpicker').selectpicker();
var mapModal = new bootstrap.Modal(document.getElementById('mapModal'));
var yourModal = new bootstrap.Modal(document.getElementById('mymodal2'));

<?php endif;?>
      </script>
<?php if($_SESSION['position'] == USER_ROLE_EMPLOYEE):?>
<script type="text/javascript" src="<?=base_url('assets/js/empCalendar.js')?>"></script>
<?php endif;?>


</body>

