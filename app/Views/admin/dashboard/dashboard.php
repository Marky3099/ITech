<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Custom fonts for this template-->
  <link
  href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
  rel="stylesheet">

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  <!-- Custom styles for this template-->
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/dashstyle.css')?>">

</head>
<body>
 <!-- Begin Page Content -->
 <div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4" style="margin-top: 10px;">
    <h3 class="hfont">Dashboard</h3>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                          class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
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
                                  <?php if($event):?>
                                    <table class="table table-bordered">
                                      <thead>
                                        <tr>
                                          <th>Task Code</th>
                                          <th>Branch</th>
                                          <th>Service</th>
                                          <th>Service Type</th>
                                          <th>Technician</th>
                                          <th>Status</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        
                                        <?php foreach($event as $tday):  ?>
                                          <tr>
                                            <td><?php echo $tday->event_code; ?></td>
                                            <td><?php echo $tday->client_branch; ?></td>
                                            <td><?php echo $tday->serv_name; ?></td>
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
                                      <th>Service Type</th>
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
                                        <td><?php echo $week->serv_name; ?></td>
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
                                <th>Service Type</th>
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
                                  <td><?php echo $m->serv_name; ?></td>
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
            </div>
            <!-- Modal for displaying Completed event -->
            <div class="container">
              <div class="modal fade" id="completeModal" role="dialog">
                <div class="modal-dialog" style="max-width: 1000px;">
                  <div class="modal-content">

                    <div class="modal-header">
                      <h4 class="modal-title">Completed Tasks</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      
                    </div>
                    <div class="modal-body">
                     <?php if($completed):?>
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>Task Code</th>
                            <th>Branch</th>
                            <th>Service</th>
                            <th>Service Type</th>
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
                              <td><?php echo $cm->serv_name; ?></td>
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
      <!-- Modal for displaying Pending event -->
      <div class="container">
        <div class="modal fade" id="pendingModal" role="dialog">
          <div class="modal-dialog" style="max-width: 1000px;">
            <div class="modal-content">

              <div class="modal-header">
                <h4 class="modal-title">Pending Requests</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                
              </div>
              <div class="modal-body">
               <?php if($notdone):?>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Task Code</th>
                      <th>Branch</th>
                      <th>Service</th>
                      <th>Service Type</th>
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
                        <td><?php echo $nd->serv_name; ?></td>
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
      <!-- Modal for displaying Pending Appointments -->
      <div class="container">
        <div class="modal fade" id="apptModal" role="dialog">
          <div class="modal-dialog" style="max-width:700px;">
            <div class="modal-content">

              <div class="modal-header">
                <h4 class="modal-title">Pending Appointments</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                
              </div>
              <div class="modal-body">
               <?php if($appt_pending):?>
                <table class="table table-bordered">
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
      <!-- Modal for displaying Pending Call Logs -->
      <div class="container">
        <div class="modal fade" id="logModal" role="dialog">
          <div class="modal-dialog" style="max-width:700px;">
            <div class="modal-content">

              <div class="modal-header">
                <h4 class="modal-title">Pending Logs</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                
              </div>
              <div class="modal-body">
               <?php if($log_pending):?>
                <table class="table table-bordered">
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
      <!-- Modal for displaying Pending Users -->
      <div class="container">
        <div class="modal fade" id="userModal" role="dialog">
          <div class="modal-dialog" style="max-width:700px;">
            <div class="modal-content">

              <div class="modal-header">
                <h4 class="modal-title">Pending Users</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                
              </div>
              <div class="modal-body">
               <?php if($user_pending):?>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Full Name</th>
                      <th>Email</th>
                      <th>Company</th>
                      <th>Status</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                   
                    <?php foreach($user_pending as $p):  ?>
                      <tr>
                        <td><?php echo $p->bdo_fname; ?></td>
                        <td><?php echo $p->bdo_email; ?></td>
                        <td><?php echo $p->bdo_company; ?></td>
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


<!-- Content Row -->
<div class="row">

  <!-- Card for displaying the total count of today's event -->
  <div class="col-xl-3 col-md-6 mb-4">
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
    <div class="col-xl-3 col-md-6 mb-4">
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
      <div class="col-xl-3 col-md-6 mb-4">
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


      <div class="col-xl-3 col-md-6 mb-4">
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
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body1">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">
              Pending Requests</div>
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
    <div class="col-xl-3 col-md-6 mb-4">
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
    <div class="col-xl-3 col-md-6 mb-4">
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

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body1">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">
              Pending Users</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">Total:&nbsp;<a href="#" data-toggle="modal" data-target="#userModal" id="iconbox"><?= json_encode($count_user);?></a></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-gray-300" id="iconbox"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php }?>
  </div>

<div class="row">
  <div class="col-md-6" id="chart_div" style="width: 100%; height: 500px;"></div>
  <div class="col-md-6" id="piechart_3d" style="width: 100%; height: 500px;"></div>
  
</div>




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
             url:"http://localhost/tsms/dashboard/auto-done",
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
             url:"http://localhost/tsms/dashboard/auto-done",
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

        var taskData = google.visualization.arrayToDataTable([
          ['Task', 'Total Tasks'],
          // ['Checkup', 1],['General cleaning', 13],['Installation', 1]

          <?php
            foreach ($taskDate as $taskDate) {
              echo $taskDate;
            }
          ?>
         
        ]);

        var servOptions = {
          title: 'Services Trend',
          is3D: true,
          colors: servLabelColor
        };

        var taskOptions = {
          title: 'Task Summary per Month',
          hAxis: {title: 'Month',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        var chart2 = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(servData, servOptions);
        chart2.draw(taskData, taskOptions);
      };

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
</body>

