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


    <!-- Custom styles for this template-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/dashstyle.css')?>">


</head>
<body>
     <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4" style="margin-top: 10px;">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>


                     <!-- Modal for displaying today's event -->

                    <div class="container">
                      <div class="modal fade" id="todayModal" role="dialog">
                        <div class="modal-dialog" style="max-width: 800px;">
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
                                    <th>Title</th>
                                    <th>Branch</th>
                                    <th>Service</th>
                                    <th>Service Type</th>
                                    <th>Employee</th>
                                    <th>Status</th>
                                    <?php if($_SESSION['position'] == USER_ROLE_ADMIN):?>
                                    <th>Action</th>
                                  <?php endif;?>
                                  </tr>
                                </thead>
                                <tbody>
                                  
                                  <?php foreach($event as $tday):  ?>
                                    <tr>
                                      <td><?php echo $tday->title; ?></td>
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
                                      <?php if($_SESSION['position'] == USER_ROLE_ADMIN):?>
                                      <td>
                                         <?php if($tday->status == "Pending" ):  ?>
                                          <a href="<?= base_url('/dashboard/task/update/'.$tday->id);?>" class="btn btn-primary btn-sm">Mark as Done</a>
                                          <?php else:  ?>
                                            <a href="<?= base_url('/dashboard/task/pending/'.$tday->id);?>" class="btn btn-secondary btn-sm">Mark as Pending</a>
                                          <?php endif;  ?>
                                          
                                      </td>
                                      <?php endif;?>
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
                        <div class="modal-dialog" style="max-width: 800px;">
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
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Branch</th>
                                    <th>Service</th>
                                    <th>Service Type</th>
                                    <th>Employee</th>
                                    <th>Status</th>
                                    
                                  </tr>
                                </thead>
                                <tbody>
                                  
                                  <?php foreach($week1 as $week):  ?>
                                    <tr>
                                      <td><?php echo $week->title; ?></td>
                                      <td><?php echo date('m-d-Y',strtotime($week->start_event)); ?></td>
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
                        <div class="modal-dialog" style="max-width: 800px;">
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
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Branch</th>
                                    <th>Service</th>
                                    <th>Service Type</th>
                                    <th>Employee</th>
                                    <th>Status</th>
                                    
                                  </tr>
                                </thead>
                                <tbody>
                                 
                                  <?php foreach($month as $m):  ?>
                                    <tr>
                                      <td><?php echo $m->title; ?></td>
                                      <td><?php echo date('m-d-Y',strtotime($m->start_event)); ?></td>
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
                        <div class="modal-dialog" style="max-width: 800px;">
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
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Branch</th>
                                    <th>Service</th>
                                    <th>Service Type</th>
                                    <th>Employee</th>
                                    <th>Status</th>
                                    
                                  </tr>
                                </thead>
                                <tbody>
                                 
                                  <?php foreach($completed as $cm):  ?>
                                    <tr>
                                      <td><?php echo $cm->title; ?></td>
                                      <td><?php echo date('m-d-Y',strtotime($cm->start_event)); ?></td>
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
                        <div class="modal-dialog" style="max-width: 800px;">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h4 class="modal-title">Pending Task</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              
                            </div>
                            <div class="modal-body">
                               <?php if($notdone):?>
                              <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Branch</th>
                                    <th>Service</th>
                                    <th>Service Type</th>
                                    <th>Employee</th>
                                    <th>Status</th>
                                    
                                  </tr>
                                </thead>
                                <tbody>
                                 
                                  <?php foreach($notdone as $nd):  ?>
                                    <tr>
                                      <td><?php echo $nd->title; ?></td>
                                      <td><?php echo date('m-d-Y',strtotime($nd->start_event)); ?></td>
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
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Number of task:&nbsp;<a href="#" data-toggle="modal" data-target="#todayModal" style="color: #344f21 ;"><?= json_encode($today_event);?></a></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300" style="color: #344f21;"></i>
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
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Number of task: <a href="#" data-toggle="modal" data-target="#weekModal" style="color: #4b6043;"><?= json_encode($weekly_event);?></a></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300" style="color: #4b6043;"></i>
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
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Number of task:&nbsp;<a href="#" data-toggle="modal" data-target="#monthModal" style="color: #4b6043;"><?= json_encode($monthly_event);?></a></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300" style="color: #4b6043;"></i>
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
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" ><a href="#" data-toggle="modal" data-target="#completeModal" style="color: #4b6043;">

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
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300" style="color: #4b6043;"></i>
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
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Number of task:&nbsp;<a href="#" data-toggle="modal" data-target="#pendingModal" style="color: #4b6043;"><?= json_encode($pending_event);?></a></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300" style="color: #4b6043;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                    <!-- Content Row -->

                    <div class="row">

                        <div class="col-xl-8 col-lg-7">

                            <!-- Area Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Area Chart</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <!-- <canvas id="myAreaChart"></canvas> -->
                                        <div class="chart-container">
                                          <canvas id="myAreaChart"></canvas>
                                        </div>
                                    </div>
                                    <hr>
                                    Styling for the area chart can be found in the
                                    <code>/js/demo/chart-area-demo.js</code> file.
                                </div>
                            </div>
                        </div>
                    </div>



    <!-- Bootstrap core JavaScript-->
    
    <div class="row justify-content-center">
    


  </div>
</div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
<script type="text/javascript">
  let label = <?= json_encode($label); ?>;
  let lineData = <?= json_encode($linedata); ?>;

  let done = ''; 
  let pending = '';
  <?php if(session()->has('done')){?>
   done = true;
  <?php }elseif(session()->has('pending')){?>
  pending = true;
  <?php } ?>;

</script>
<script type="text/javascript" src="<?=base_url('assets/js/dashboardjs.js')?>"></script>
</body>

