

<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/dashstyle.css')?>">

  <!-- Modal for displaying today's event -->

<div class="container">
  <div class="modal fade" id="todayModal" role="dialog">
    <div class="modal-dialog" style="max-width: 600px;">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Today's Scheduled Task/s</h4>
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
              <h2 style="text-align: center; ">Oops.. No Work for Today!</h2>
            </div>
            <?php endif;?>
          
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
  <!-- Modal for displaying Week's event -->
<div class="container">
  <div class="modal fade" id="weekModal" role="dialog">
    <div class="modal-dialog" style="max-width: 600px;">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Weekly Scheduled Task/s</h4>
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
              <h2 style="text-align: center; ">Oops.. No Work for this Week!</h2>
            </div>
            <?php endif;?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal for displaying Month's event -->
<div class="container">
  <div class="modal fade" id="monthModal" role="dialog">
    <div class="modal-dialog" style="max-width: 600px;">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Monthly Scheduled Task/s</h4>
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
              <h2 style="text-align: center; ">Oops.. No Work for this Month!</h2>
            </div>
            <?php endif;?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal for displaying Completed event -->
<div class="container">
  <div class="modal fade" id="completeModal" role="dialog">
    <div class="modal-dialog" style="max-width: 600px;">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Completed Task/s</h4>
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
              <h2 style="text-align: center; ">Oops.. No Complete Task/s Yet!</h2>
            </div>
            <?php endif;?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal for displaying Pending event -->
<div class="container">
  <div class="modal fade" id="pendingModal" role="dialog">
    <div class="modal-dialog" style="max-width: 600px;">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Pending Task/s</h4>
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
              <h2 style="text-align: center; ">Hoorayyy!!.. All Task/s are Complete!</h2>
            </div>
            <?php endif;?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="body-content">
<!-- Card for displaying the total count of today's event -->

<div class="card bg-primary text-white card1" style="top: 10px; left: -70px; width: 12rem; height: 200px; float: left;">
  <div class="card-header">
      <h5><center>Daily: <?= date('F j Y');?></center></h5>
    </div>
  <div class="card-body" style="padding: 0 0;">
    <p><center>Task/s:<a href="#" data-toggle="modal" data-target="#todayModal" style=" text-decoration: none; color: white; font-size: 50px; align-text: center; "><?= json_encode($today_event);?></a> 
    </center></p>
  </div>
</div>


 <!--  <div class="card bg-primary text-white card1" style="top: 10px; left: -70px; width: 20rem; float: left;">
    <div class="card-header">
      <h4><center>Daily: <?= date('F j Y');?></center></h4>
    </div>
    <div class="card-body">
            <p><center>Task/s: <a href="#" data-toggle="modal" data-target="#todayModal" style=" text-decoration: none; color: white; font-size: 50px; align-text: center; "><?= json_encode($today_event);?></a> </center></p>
   </div>
  </div>
 -->
  <!-- Weekly -->
  
  <div class="card bg-secondary text-white card2" style="top: 10px; left: -60px; width: 12rem; height: 200px; float: left;">
    <div class="card-header">
     <h5><center>
      Weekly: <?php 
                  $monday = strtotime('last monday', strtotime('tomorrow'));

                  $sunday = strtotime('+6 days', $monday);
                  echo date('F j', $monday) . " to " . date('j Y', $sunday);?></center></h5>
    </div>
  <div class="card-body" style="padding: 0 0;">
     <p><center>Task/s: <a href="#" data-toggle="modal" data-target="#weekModal" style=" text-decoration: none; color: white; font-size: 50px; align-text: center; "><?= json_encode($weekly_event);?></a> </center></p>
  </div>
</div>

  <!-- Monthly -->

  <div class="card bg-warning text-white card3" style="top: 10px; left: -50px; width: 12rem; height: 200px; float: left;">
    <div class="card-header">
      <h5><center>Monthly: <?= date('F Y');?></center></h5>
    </div>
  <div class="card-body" style="padding: 0 0;">
     <p><center>Task/s: <a href="#" data-toggle="modal" data-target="#monthModal" style=" text-decoration: none; color: white; font-size: 50px; align-text: center; "><?= json_encode($monthly_event);?></a> </center></p>
  </div>
</div>

  <!-- Completed Tasks -->

  <div class="card bg-success text-white card4" style="top: 10px; left: -40px; height: 200px; width: 12rem; float: left;">
    <div class="card-header">
      <h5><center>Completed</center></h5>
    </div>
  <div class="card-body">
    <p><center>Task/s: <a href="#" data-toggle="modal" data-target="#completeModal" style=" text-decoration: none; color: white; font-size: 50px; align-text: center; "><?= json_encode($complete_event);?></a> </center></p>
  </div>
</div>

  <!-- <div class="card bg-success text-white card4" style="top: 10px; left: -40px; height: 193px; width: 20rem; float: left;">
    <div class="card-header">
      <h4><center>Completed</center></h4>
    </div>
    <div class="card-body">
            <p><center>Task/s: <a href="#" data-toggle="modal" data-target="#completeModal" style=" text-decoration: none; color: white; font-size: 50px; align-text: center; "><?= json_encode($complete_event);?></a> </center></p>
   </div>
  </div> -->
  <!-- Pending Tasks -->

  <div class="card bg-danger text-white card5" style="top: 10px; left: -30px; height: 200px; width: 12rem;">
    <div class="card-header">
      <h5><center>Pending</center></h5>
    </div>
  <div class="card-body">
    <p><center>Task/s: <a href="#" data-toggle="modal" data-target="#pendingModal" style=" text-decoration: none; color: white; font-size: 50px; align-text: center; "><?= json_encode($pending_event);?></a> </center></p>
  </div>
</div>

  <!-- <div class="card bg-danger text-white card5" style="top: 10px; left: -30px; height: 193px; width: 20rem;">
    <div class="card-header">
      <h4><center>Pending</center></h4>
    </div>
    <div class="card-body">
            <p><center>Task/s: <a href="#" data-toggle="modal" data-target="#pendingModal" style=" text-decoration: none; color: white; font-size: 50px; align-text: center; "><?= json_encode($pending_event);?></a> </center></p>
   </div>
  </div> -->
	<div class="row justify-content-center">
		
      <div class="chart-container">
          <canvas id="chart"></canvas>
      </div>

	</div>
</div>
</div>
<!-- , "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

<?php if(isset($label)):  ?>
  <script type="text/javascript">


  $(document).ready( function () {
      $('.table').DataTable();
  } );


  var data = {
  labels: <?= json_encode($label); ?>,
  datasets: [{
    label: "total events",
    backgroundColor: "rgba(255,99,132,0.2)",
    borderColor: "rgba(255,99,132,1)",
    borderWidth: 2,
    hoverBackgroundColor: "rgba(255,99,132,0.4)",
    hoverBorderColor: "rgba(255,99,132,1)",
    data: <?= json_encode($linedata); ?>,
  }]
};

var options = {
  animations: {
      radius: {
        duration: 400,
        easing: 'linear',
        loop: (context) => context.active
      }
    },
    hoverRadius: 12,
    hoverBackgroundColor: 'yellow',
    interaction: {
      mode: 'nearest',
      intersect: false,
      axis: 'x'
    },
  maintainAspectRatio: false,
  title: {
        display: true,
        text: 'Chart.js Line Chart'
      },
       responsive: true,
  scales: {
    y: {
      stacked: true,
      ticks: {
          // forces step size to be 50 units
          stepSize: 1
        },
      grid: {
        display: true,
        color: "rgba(255,99,132,0.2)"
      }
    },
    x: {
      grid: {
        display: false
      }
    }
  }
};

new Chart('chart', {
  type: 'line',
  options: options,
  data: data
}); 
</script>
 <?php else: ?> 

  <?php endif; ?> 
