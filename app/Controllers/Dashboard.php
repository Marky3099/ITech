<?php

namespace App\Controllers;
use App\Libraries\Hash;
use App\Models\User;
use App\Models\User_bdo;
use App\Models\Emp;
use App\Models\Client;
use App\Models\All_events;
use App\Models\Event;
use App\Models\Serv;
use App\Models\Event_emp_views;
use App\Models\Call_logs;
use App\Models\Appointment;
use App\Models\View_appointment;
use App\Models\Event_fcu_views;
use App\Models\Fcu_no;
use App\Models\Event_emp;
use App\Models\Aircon;
use App\Models\Event_fcu;

class Dashboard extends BaseController
{   
    public function __construct(){
        helper(['url','form']);
    }
    public function index()
    {
        if($_SESSION['position'] == USER_ROLE_CLIENT){
            return $this->response->redirect(site_url('/profile-bdo/'.$_SESSION['user_id']));
        }
        $data['main'] = 'admin/dashboard/dashboard';
        return view('templates/template',$data);
    }
    
    public function dashboard()
    {
        if($_SESSION['position'] == USER_ROLE_CLIENT){
            return $this->response->redirect(site_url('/profile-bdo/'.$_SESSION['user_id']));
        }
        // dd(date('Y-m-d'));
        $allevent = new All_events();
        $event = new Event();
        $client = new Client();
        $serv = new Serv();
        $emp_event = new Event_emp();
        $event_emp = new Event_emp_views();
        $appt = new Appointment();
        $logs = new Call_logs();
        $bdo_user = new User_bdo();
        $emp = new Emp();
        $event_fcu = new Event_fcu_views();
        $fcu_event = new Event_fcu();
        $fcu_no = new Fcu_no();

        $aircon = new Aircon();
        $emp_id = '';

        date_default_timezone_set('Asia/Hong_Kong'); 
        $date = new \DateTime();
        $date->setTimezone(new \DateTimeZone('+0800'));
        $date1 = $date->format('Y-m-d');
        $data['pending_events'] = $event->where('status','Pending')->findAll();
        $data['events'] = $event->where('status','Pending')->where('start_event', $date1)->findAll();
        // dd($date);

        // -------------------------AUTO SCHEDULING GENERAL CLEANING----------------------------------
        $autoSched = $allevent->where('serv_name','General Cleaning')->where('area !=','Other')->groupBy('client_branch','ASC')->findAll();
        $autoSchedFcuData = '';
        $autoSchedEmpData = '';
        if(isset($autoSched)){
            for ($i=0; $i < count($autoSched); $i++) { 
               $autoSchedId = $autoSched[$i]['id'];
               $autoSched_startEvent = $autoSched[$i]['start_event'];
               $autoSched_servId = $autoSched[$i]['serv_id'];
               $autoSched_clientId = $autoSched[$i]['client_id'];
               $autoSched_title = $autoSched[$i]['title'];
               $autoSched_time = $autoSched[$i]['time'];
               $autoSched_endTime = $autoSched[$i]['end_time'];
               $autoSched_comments = $autoSched[$i]['comments'];
               $autoSchedFcuData= $event_fcu->where('id', $autoSchedId)->findAll();
               $autoSchedEmpData= $event_emp->where('id', $autoSchedId)->findAll();
               // dd($autoSchedEmpData);
               $autoSchedMonth = date('m',strtotime($autoSched_startEvent));
               $autoSchedDay = date('d',strtotime($autoSched_startEvent));
               $autoSched_date = ['01','02','04','05','07','08','10','11'];
               for ($j=0; $j < count($autoSched_date); $j++) { 
                   if($autoSchedMonth != $autoSched_date[$j]){
                    $dateNew = date('Y-'.$autoSched_date[$j].'-'.$autoSchedDay);
                    $checkAuto = $allevent->where('client_id', $autoSched_clientId)->where('serv_name','General Cleaning')->where('start_event',$dateNew)->first();
                    $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $code = substr(str_shuffle($set), 0, 6);
                        if(!isset($checkAuto)){
                            $success = $event->insert([
                                'title' => $autoSched_title,
                                'start_event' => date('Y-'.$autoSched_date[$j].'-'.$autoSchedDay),
                                'time' => $autoSched_time,
                                'end_time' => $autoSched_endTime,
                                'client_id' => $autoSched_clientId,
                                'serv_id' => $autoSched_servId,
                                'comments' =>$autoSched_comments,
                            ]);
                           if($success){
                                $event_code = ['event_code' => 'task-'.$code.'-'.(int)$success];
                                $event->update((int)$success,$event_code);

                                foreach ($autoSchedEmpData as $key => $value) {
                                    $emp_event->insert([
                                        'emp_id'=> (int) $value['emp_id'],
                                        'id' => (int) $success
                                    ]);
                                }

                                foreach ($autoSchedFcuData as $key => $value) {
                                    $fcu_event->insert([
                                        'id'=> (int) $success,
                                        'aircon_id'=> (int)$value['aircon_id'],
                                        'quantity'=> (int)$value['quantity'],
                                        'fcuno'=>$value['fcuno']
                                    ]);
                                }
                           }
                        }
                    }
               }
            }
        }
        // -------------------------AUTO SCHEDULING FILTER CLEANING----------------------------------
        // dd($value );
        $autoSchedFilter = $allevent->where('serv_name','Filter Cleaning')->where('area !=','Other')->groupBy('client_branch','ASC')->findAll();
        // dd($autoSchedFilter);
        $autoSchedFcuDataFilter = '';
        $autoSchedEmpDataFilter = '';
        if(isset($autoSched)){
            for ($i=0; $i < count($autoSchedFilter); $i++) { 
               $autoSchedIdFilter = $autoSchedFilter[$i]['id'];
               $autoSched_startEventFilter = $autoSchedFilter[$i]['start_event'];
               $autoSched_servIdFilter = $autoSchedFilter[$i]['serv_id'];
               $autoSched_clientIdFilter = $autoSchedFilter[$i]['client_id'];
               $autoSched_titleFilter = $autoSchedFilter[$i]['title'];
               $autoSched_timeFilter = $autoSchedFilter[$i]['time'];
               $autoSched_endTimeFilter = $autoSchedFilter[$i]['end_time'];
               $autoSched_commentsFilter = $autoSchedFilter[$i]['comments'];
               $autoSchedFcuDataFilter= $event_fcu->where('id', $autoSchedIdFilter)->findAll();
               $autoSchedEmpDataFilter= $event_emp->where('id', $autoSchedIdFilter)->findAll();
               // dd($autoSchedEmpData);
               $autoSchedMonthFilter = date('m',strtotime($autoSched_startEventFilter));
               $autoSchedDayFilter = date('d',strtotime($autoSched_startEventFilter));
               $autoSched_dateFilter = ['03','06','09','12'];
               for ($j=0; $j < count($autoSched_dateFilter); $j++) { 
                   if($autoSchedMonthFilter != $autoSched_dateFilter[$j]){
                    $dateNewFilter = date('Y-'.$autoSched_dateFilter[$j].'-'.$autoSchedDayFilter);
                    $checkAutoFilter = $allevent->where('client_id', $autoSched_clientIdFilter)->where('serv_name','Filter Cleaning')->where('start_event',$dateNewFilter)->first();
                    $setF = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $codeF = substr(str_shuffle($setF), 0, 6);
                        if(!isset($checkAutoFilter)){
                            $successF = $event->insert([
                                'title' => $autoSched_titleFilter,
                                'start_event' => date('Y-'.$autoSched_dateFilter[$j].'-'.$autoSchedDayFilter),
                                'time' => $autoSched_timeFilter,
                                'end_time' => $autoSched_endTimeFilter,
                                'client_id' => $autoSched_clientIdFilter,
                                'serv_id' => $autoSched_servIdFilter,
                                'comments' =>$autoSched_commentsFilter,
                            ]);
                           if($successF){
                                $event_codeF = ['event_code' => 'task-'.$codeF.'-'.(int)$successF];
                                $event->update((int)$successF,$event_codeF);

                                foreach ($autoSchedEmpDataFilter as $key => $value) {
                                    $emp_event->insert([
                                        'emp_id'=> (int) $value['emp_id'],
                                        'id' => (int) $successF
                                    ]);
                                }

                                foreach ($autoSchedFcuDataFilter as $key => $value) {
                                    $fcu_event->insert([
                                        'id'=> (int) $successF,
                                        'aircon_id'=> (int)$value['aircon_id'],
                                        'quantity'=> (int)$value['quantity'],
                                        'fcuno'=>$value['fcuno']
                                    ]);
                                }
                           }
                        }
                    }
               }
            }
        }

        // -------------------------END OF AUTO SCHEDULING -----------------------------------

        // dd($date1);
        $data['eventToday'] = array();
        $data['week1'] = array();
        $data['month'] = array();
        $data['completed'] = array();
        $data['notdone'] = array();
        $data['client'] = $client->orderBy('client_id', 'ASC')->findAll();
        $data['empDatas'] = $emp->orderBy('emp_id', 'ASC')->findAll();
        if($_SESSION['position'] == USER_ROLE_EMPLOYEE){
           $db = \Config\Database::connect();
            $query   = $db->query('SELECT DISTINCT aircon_id,id,device_brand,aircon_type,quantity
                FROM event_fcu_views');
            $data['distinct'] = $query->getResult();

            $db1 = \Config\Database::connect();
            $query   = $db1->query('SELECT DISTINCT id
                FROM event_fcu_views');
            $data['distinct_event'] = $query->getResult();
            $emp_id = $_SESSION['emp_id'];
            $data['branch'] = array();

            $data['area'] = $client->select('area')->groupBy('area')->findAll();
            
            // dd($data['emp']);
            $data['fcu_no'] = $fcu_no->orderBy('fcuno', 'ASC')->findAll();
            $data['event_fcu'] = $event_fcu->orderBy('id', 'ASC')->findAll();
            $data['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
            $data['serv'] = $serv->orderBy('serv_id', 'ASC')->findAll();
            $data['servName'] = $serv->select('serv_name, serv_color, serv_type')->groupBy('serv_name')->findAll();
            $data['servType'] = $serv->orderBy('serv_name','ASC')->findAll();
            $data['aircon'] = $aircon->orderBy('aircon_id', 'ASC')->findAll();
            $data['device_brand'] = $aircon->select('device_brand')->groupBy('device_brand')->findAll();

            foreach($data['area'] as $k => $val) {

                    $area = [];

                    foreach($data['client'] as $key => $value) {
                        if($val['area'] == $value['area']){
                          array_push($area , (object)[
                            'client_id' => (int)$value['client_id'],
                            'client_branch' =>$value['client_branch']
                        ]);
                      }

                  }

                  $data['client_area'][]= (object)[
                    $val['area'] => $area
                ];
                $data['client_area2'][]=$area;
            }
            $data['eventsForEmp'] = $event_emp ->where('emp_id', $emp_id)->findAll();
            foreach ($data['eventsForEmp'] as $key => $value) {
                $emp_arr = "";
                $fcu_arr =array();

                foreach ($data['event_emp'] as $key => $value_emps) {
                    if ( $value['id'] == $value_emps['id']) {
                       $emp_arr .= $data['event_emp'][$key]['emp_id'].",";
                   }
               }


               foreach ($data['event_fcu'] as $key => $value_fcu) {
                   if ($value['id'] == $value_fcu['id']) {
                       array_push($fcu_arr , (object)[
                        'id' => (int)$value_fcu['id'],
                        'aircon_id' => (int)$value_fcu['aircon_id'],
                        'fcuno' =>(int)$value_fcu['fcuno'],
                        'quantity' =>(int)$value_fcu['quantity'],
                        'device_brand' =>$value_fcu['device_brand'],
                        'aircon_type' =>$value_fcu['aircon_type'],
                        'fcu' =>$value_fcu['fcu'],
                    ]);

                   }   

               } 



               $data['event'][]= (object)[
                "id"=> $value['id'],
                "event_code"=> $value['event_code'],
                "title"=> $value['title'],
                "start"=> $value['start_event'],
                "time"=>$value['time'],
                "end_time"=>$value['end_time'],
                "serv_id"=> $value['serv_id'],
                "client_id"=> $value['client_id'],
                "serv_name"=> $value['serv_name'],
                "area"=> $value['area'],
                "client_branch"=> $value['client_branch'],
                "emp_array"=> $emp_arr,
                "fcu_array"=> $fcu_arr,
                "color" => $value['serv_color'],
                "comments" => $value['comments'],
            ];




            }
        }

        $data['eventsToday'] = $allevent->where('start_event', $date1)->where('notif',0)->findAll();
        if($data['eventsToday']){
            for ($i=0; $i < count($data['eventsToday']); $i++) { 
                // dd($data['eventsToday'][$i]['id']);
                $eventId = $data['eventsToday'][$i]['id'];
                $data['empDeploy'] = $event_emp->where('id', $eventId)->findAll();
                for ($j=0; $j < count($data['empDeploy']); $j++) { 
                    $empEmail = $data['empDeploy'][$j]['emp_email'];
                    $empName = $data['empDeploy'][$j]['emp_name'];
                    $taskCode = $data['eventsToday'][$i]['event_code'];
                    $servName = $data['eventsToday'][$i]['serv_type'];
                    $client = $data['eventsToday'][$i]['client_branch'];
                    $clientAddress = $data['eventsToday'][$i]['client_address'];
                    $eventTime = explode(":", $data['eventsToday'][$i]['time']);
                    $formatEventTime;
                    if($eventTime[0] == '00'){
                        $formatEventTime = 'Any time of the day';
                    }elseif ($eventTime[0]>12){
                        $hour = $eventTime[0] - 12;
                        $amPm = "PM";
                        $formatEventTime= $hour . ":" . $eventTime[1] . " " . $amPm;
                    }elseif ($eventTime[0]==12){
                        $hour = $eventTime[0];
                        $amPm = "PM";
                        $formatEventTime= $hour . ":" . $eventTime[1] . " " . $amPm;
                    }else{
                        $hour = $eventTime[0];
                        $amPm = "AM";
                        $formatEventTime = $hour . ":" . $eventTime[1] . " " . $amPm;
                    }

                    $subject = "TSMS - Service Scheduled Today";
                    $message = "<html>
                    <head>
                    <title>You have a work to do today!</title>
                    </head>
                    <body>
                    <h6>Dear ".$empName."</h6>
                    <p>You assigned to do a service named <b>".$servName."</b> to <b>".$client."</b> at <b>".$clientAddress."</b> at exactly <b>".$formatEventTime."</b>. Please be on time and have a safe travel.</p>
                    </body>
                    </html>";
                    $email = \Config\Services::email();
                    $email->setTo($empEmail);
                    $email->setFrom('Maylaflor@gmail.com','Maylaflor TSMS');
                    $email->setSubject($subject);
                    $email->setMessage($message);

                    if ($email->send()) {
                        // echo "Success";
                    }else{
                        $data = $email->printDebugger(['headers']);
                        print_r($data);
                    }
                }
                if($data['eventsToday'][$i]['client_email']){
                    $to = $data['eventsToday'][$i]['client_email'];
                    $taskCode = $data['eventsToday'][$i]['event_code'];

                    $subject = "TSMS - Service Scheduled Today";
                    $message = "<html>
                    <head>
                    <title>Service ".$taskCode."</title>
                    </head>
                    <body>
                    <h6>Dear Valued Customer</h6>
                    <p>.</p>
                    </body>
                    </html>";
                    $email = \Config\Services::email();
                    $email->setTo($to);
                    $email->setFrom('Maylaflor@gmail.com','Maylaflor TSMS');
                    $email->setSubject($subject);
                    $email->setMessage($message);

                    if ($email->send()) {
                        // echo "Success";
                    }else{
                        $data = $email->printDebugger(['headers']);
                        print_r($data);
                    }
                }
            $updateNotif = [
                'notif' => 1,
            ];
            $event->update((int)$eventId, $updateNotif);
            }
            

        }
        $data['serv'] = $serv->orderBy('serv_id', 'ASC')->findAll();
        $data['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();

        if($_SESSION['position'] == USER_ROLE_EMPLOYEE){
            $data['today'] = $event_emp->where('start_event', $date1)->where('emp_id', $emp_id)->findAll();
        }else{
            $data['today'] = $allevent->where('start_event', $date1)->findAll();
        }

        
        

        foreach ($data['today'] as $key => $value) {
            $emp_arr = "";
            foreach ($data['event_emp'] as $key => $value_emps) {
                if ( $value['id'] == $value_emps['id']) {
                 $emp_arr .= $data['event_emp'][$key]['emp_name'].",";
             }
         }

         $data['eventToday'][]= (object)[
          "id"=> $value['id'],
          "title"=>$value['title'],
          "event_code"=>$value['event_code'],
          "log_code"=>$value['log_code'],
          "appt_code"=>$value['appt_code'],
          "start_event"=> $value['start_event'],
          "time"=> $value['time'],
          "end_time"=>$value['end_time'],
          "serv_id"=> $value['serv_id'],
          "client_id"=>$value['client_id'],
          "serv_name"=>$value['serv_name'],
          "serv_type"=>$value['serv_type'],
          "area"=> $value['area'],
          "emp_array"=> $emp_arr,
          "client_branch"=> $value['client_branch'],
          "status"=> $value['status'],
        ];
    }

// chart data for total of tasks every month
  $db = \Config\Database::connect();
  $query   = $db->query('SELECT start_event,COUNT(start_event) as count
    FROM all_events
    GROUP BY YEAR(start_event), MONTH(start_event) ASC'
    );
  $data['data'] = $query->getResult();
  $data['label'][] ="";
  $data['linedata'][]="";
  $data['linedata'][]="";
  $data['taskDate']=[];
  $data['serviceData']=[];
  $data['servLabelColor']=[];

  json_encode($data['data']);
  foreach ($data['data'] as $key => $value) {

   $data['taskDate'][] = "['".date("M",strtotime($value->start_event))."', ".$value->count."],";
    }

     //chart data for services 
$servQuery   = $db->query('SELECT DISTINCT serv_name, serv_color, Count(serv_id) as count
    FROM all_events GROUP BY serv_name'
    );

$data['servData'] = $servQuery->getResult();
json_encode($data['servData']);
      // dd($data['servData']);
foreach ($data['servData'] as $key => $value) {
        // ['Work',     11]
   $data['serviceData'][] = "['".$value->serv_name."', ".$value->count."],";
   $data['servLabelColor'][]= $value->serv_color;

    }
// dd($data['serviceData']);

// rating chart
$ratings = array();
$ratings1 = array();
// $data['ratingsName'] = array();


$data['empPerformance'] = array();
$ratingsQuery   = $db->query('SELECT emp_id,start_event,serv_name, serv_color,rate_event,emp_name,rate_emp
    FROM ratings_view order by emp_id'
);

$data['ratingsData'] = $ratingsQuery->getResult();
json_encode($data['ratingsData']);
foreach ($data['ratingsData'] as $key => $value) {
    array_push($ratings, $value);
    // array_push($ratingsName,$value->serv_name);
}

$ratingsQuery1   = $db->query('SELECT start_event,rate_event
    FROM ratings_view group by id order by start_event'
);

$data['ratingsData1'] = $ratingsQuery1->getResult();
json_encode($data['ratingsData1']);
foreach ($data['ratingsData1'] as $key => $value) {
    array_push($ratings1, $value);
    // array_push($ratingsName,$value->serv_name);
}
// dd($ratings1);
$data['overallPerformance']=0;
$data['totality'] = 0;
$data['monthRate'] = array();
$data['monthlyAveRate'] = array();
if($ratings){
    $overall = 0;
    $totalRatings = 0;
    $countRate = 0;
    for ($i=0; $i < count($ratings1); $i++) { 
        $a = $i+1;
        $b = $i-1;
        
        $rateMonth = date('M',strtotime($ratings1[$i]->start_event));
        if($a<count($ratings1)){
            $rateMonthNext = date('M',strtotime($ratings1[$a]->start_event));
            if($b<0){
                
                if($rateMonth==$rateMonthNext){
                    $totalRatings = $ratings1[$i]->rate_event + $ratings1[$a]->rate_event;
                    $countRate++;
                }else{
                    array_push($data['monthRate'],["['".$rateMonth."',".$ratings1[$i]->rate_event."],"]);
                    $totalRatings=0;
                }
            }else{
                
                if($rateMonth==$rateMonthNext){
                    $totalRatings = $totalRatings + $ratings1[$a]->rate_event;
                    $countRate++;
                }elseif($totalRatings == 0){
                    array_push($data['monthRate'],["['".$rateMonth."',".$ratings1[$i]->rate_event."],"]);
                    $totalRatings=0;
                }else{
                    // $totalRatings = $ratings1[$i]->rate_event;
                    $countRate++;
                    $totalAve = number_format(($totalRatings/$countRate),1);
                    array_push($data['monthRate'],["['".$rateMonth."',".$totalAve."],"]);
                    $totalRatings=0;
                    $totalAve=0;
                }
            }
        }else{
            // dd($totalRatings);
            $rateMonthPast = date('M',strtotime($ratings1[$b]->start_event));
            if($rateMonthPast == $rateMonth){
                // $totalRatings = $ratings1[$i]->rate_event;
                $countRate++;
                $totalAve = number_format(($totalRatings/$countRate),1);
                array_push($data['monthRate'],["['".$rateMonth."',".$totalAve."],"]);
                $totalRatings=0;
                $totalAve=0;
            }
            elseif($totalRatings == 0){
                // dd($ratings1[$i]->rate_event);
                array_push($data['monthRate'],["['".$rateMonth."',".$ratings1[$i]->rate_event."],"]);
            }else{
                // $totalRatings = $ratings1[$i]->rate_event;
                $countRate++;
                $totalAve = number_format(($totalRatings/$countRate),1);
                array_push($data['monthRate'],["['".$rateMonth."',".$totalAve."],"]);
                $totalRatings=0;
                $totalAve=0;
            }
        }
    }
    // dd($data['monthRate']);
    for ($i=0; $i < count($data['monthRate']); $i++) { 
        for($j=0; $j < count($data['monthRate'][$i]); $j++){
            array_push($data['monthlyAveRate'],$data['monthRate'][$i][$j]);
        }
    }
    // dd($data['monthlyAveRate']);
    foreach ($ratings as $key => $value) {
        $overall += $value->rate_event;
    }
    $data['overallPerformance']=number_format($overall/count($ratings),1);
    // $data['totality'] = 5 - $data['overallPerformance'];
}

// dd($data['totality']);
$performEmp = array();
$aveRate = 0;
for ($i=0; $i < count($ratings); $i++) { 
    $c = $i;
    $d = $c+1;
    $e = $c-1;
    // $rate = 0;
    $empId = $ratings[$i]->emp_name;
    $rateEmp = $ratings[$i]->rate_emp;
    if($e<0){
        // dd('true');
        // $e = $c;
        if($d < count($ratings)){
            // dd($empId == $ratings[$d]->emp_name);
            if($empId == $ratings[$d]->emp_name){
                $aveRateDecimal = number_format((($rateEmp+$ratings[$c+1]->rate_emp)/2),1);
                $aveRate = $aveRateDecimal;
                // dd($aveRate);
            }elseif($aveRate==0){
                array_push($performEmp,["['".$empId."', ".$rateEmp."],"]);
                $aveRate = 0;
            }
            
        }
    }else{
        // dd($performEmp);
        if($d < count($ratings)){
            if($empId == $ratings[$d]->emp_name){
                $aveRateDecimal = number_format((($rateEmp+$ratings[$c+1]->rate_emp)/2),1);
                $aveRate = $aveRateDecimal;
                // dd($aveRate);
            }elseif($empId == $ratings[$e]->emp_name){
                array_push($performEmp,["['".$empId."', ".$aveRate."],"]);
                $aveRate = 0;
            }else{
                array_push($performEmp,["['".$empId."', ".$rateEmp."],"]);
            }
        }elseif($aveRate==0){
            array_push($performEmp,["['".$empId."', ".$rateEmp."],"]);
            $aveRate = 0;
        }else{
            array_push($performEmp,["['".$empId."', ".$aveRate."],"]);
            $aveRate = 0;
        }
    }   
}
$data['performEmp'] = array();
for ($i=0; $i < count($performEmp); $i++) { 
    for($j=0; $j < count($performEmp[$i]); $j++){
        array_push($data['performEmp'],$performEmp[$i][$j]);
    }
}
// dd($ratings);
// dd($ratings);

//count today's tasks
if($_SESSION['position'] == USER_ROLE_EMPLOYEE){
    $query = $db->query('SELECT COUNT(start_event) as count FROM event_emp_views WHERE emp_id ='.$emp_id.' and start_event = CURDATE()');
}else{
    $query = $db->query('SELECT COUNT(start_event) as count FROM all_events WHERE start_event = CURDATE()');
}
$data['event_today'] = $query->getResult();
json_encode($data['event_today']);
foreach ($data['event_today'] as $key => $value) {
    $data['today_event']= (int)$value->count;
}

$monday = date('Y-m-d', strtotime('monday this week'));
$sunday = date('Y-m-d', strtotime('sunday this week'));

if($_SESSION['position'] == USER_ROLE_EMPLOYEE){
    $data['weekly'] = $event_emp->where('start_event BETWEEN "'. date('Y-m-d', strtotime($monday)). '" and "'. date('Y-m-d', strtotime($sunday)).'" AND emp_id = "'.$emp_id.'"ORDER BY start_event ASC')->findAll();
}else{
    $data['weekly'] = $allevent->where('start_event BETWEEN "'. date('Y-m-d', strtotime($monday)). '" and "'. date('Y-m-d', strtotime($sunday)).'"ORDER BY start_event ASC')->findAll();
}

foreach ($data['weekly'] as $key => $value) {
    $emp_arr = "";
    foreach ($data['event_emp'] as $key => $value_emps) {
        if ( $value['id'] == $value_emps['id']) {
         $emp_arr .= $data['event_emp'][$key]['emp_name'].",";
     }
 }

 $data['week1'][]= (object)[
    "id"=> $value['id'],
    "title"=> $value['title'],
    "event_code"=>$value['event_code'],
    "log_code"=>$value['log_code'],
    "appt_code"=>$value['appt_code'],
    "start_event"=> $value['start_event'],
    "time"=> $value['time'],
    "end_time"=>$value['end_time'],
    "serv_id"=> $value['serv_id'],
    "client_id"=>$value['client_id'],
    "area"=> $value['area'],
    "status"=> $value['status'],
    "serv_name"=> $value['serv_name'],
    "serv_type"=>$value['serv_type'],
    "client_branch"=> $value['client_branch'],
    "emp_array"=> $emp_arr,
];
}

//count weekly tasks
$data['weekly_event']= count($data['weekly']);
        // Total
if($_SESSION['position'] == USER_ROLE_EMPLOYEE){
    $query = $db->query('SELECT COUNT(start_event) as count FROM event_emp_views WHERE emp_id ='.$emp_id);
}else{
    $query = $db->query('SELECT COUNT(start_event) as count FROM all_events');
}
$data['total_event'] = $query->getResult();
json_encode($data['total_event']);
foreach ($data['total_event'] as $key => $value) {
    $data['event_total']= (int)$value->count;
}
        //count monthly tasks
if($_SESSION['position'] == USER_ROLE_EMPLOYEE){
    $query = $db->query('SELECT COUNT(start_event) as count FROM event_emp_views WHERE MONTH(start_event) = MONTH(CURRENT_DATE()) AND emp_id ='.$emp_id);
}else{
    $query = $db->query('SELECT COUNT(start_event) as count FROM all_events WHERE MONTH(start_event) = MONTH(CURRENT_DATE())');
}
$data['event_month'] = $query->getResult();
if($_SESSION['position'] == USER_ROLE_EMPLOYEE){
    $data['monthly'] = $event_emp->where('MONTH(start_event) = MONTH(CURRENT_DATE()) AND emp_id = "'.$emp_id.'" ORDER BY start_event ASC')->findAll();
}else{
    $data['monthly'] = $allevent->where('MONTH(start_event) = MONTH(CURRENT_DATE()) ORDER BY start_event ASC')->findAll();
}

foreach ($data['monthly'] as $key => $value) {
    $emp_arr = "";
    foreach ($data['event_emp'] as $key => $value_emps) {
        if ( $value['id'] == $value_emps['id']) {
         $emp_arr .= $data['event_emp'][$key]['emp_name'].",";
     }
 }

 $data['month'][]= (object)[
    "id"=> $value['id'],
    "title"=> $value['title'],
    "event_code"=>$value['event_code'],
    "log_code"=>$value['log_code'],
    "appt_code"=>$value['appt_code'],
    "start_event"=> $value['start_event'],
    "time"=> $value['time'],
    "end_time"=>$value['end_time'],
    "serv_id"=> $value['serv_id'],
    "client_id"=>$value['client_id'],
    "area"=> $value['area'],
    "status"=> $value['status'],
    "serv_name"=> $value['serv_name'],
    "serv_type"=>$value['serv_type'],
    "client_branch"=> $value['client_branch'],
    "emp_array"=> $emp_arr,
];
}


json_encode($data['event_month']);
foreach ($data['event_month'] as $key => $value) {
    $data['monthly_event']= (int)$value->count;
}
        // Completed task
if($_SESSION['position'] == USER_ROLE_EMPLOYEE){
    $query = $db->query('SELECT COUNT(start_event) as count FROM event_emp_views WHERE status = "Done" AND emp_id ='.$emp_id);
}else{
    $query = $db->query('SELECT COUNT(start_event) as count FROM all_events WHERE status = "Done"');
}
$data['event_complete'] = $query->getResult();
if($_SESSION['position'] == USER_ROLE_EMPLOYEE){
    $data['complete'] = $event_emp->where('status = "Done" AND emp_id = "'. $emp_id.'" ORDER BY start_event ASC')->findAll();
}else{
    $data['complete'] = $allevent->where('status = "Done" ORDER BY start_event ASC')->findAll();
}

foreach ($data['complete'] as $key => $value) {
    $emp_arr = "";
    foreach ($data['event_emp'] as $key => $value_emps) {
        if ( $value['id'] == $value_emps['id']) {
         $emp_arr .= $data['event_emp'][$key]['emp_name'].",";
     }
 }

 $data['completed'][]= (object)[
    "id"=> $value['id'],
    "title"=> $value['title'],
    "event_code"=>$value['event_code'],
    "log_code"=>$value['log_code'],
    "appt_code"=>$value['appt_code'],
    "start_event"=> $value['start_event'],
    "time"=> $value['time'],
    "end_time"=>$value['end_time'],
    "serv_id"=> $value['serv_id'],
    "client_id"=>$value['client_id'],
    "area"=> $value['area'],
    "status"=> $value['status'],
    "serv_name"=> $value['serv_name'],
    "serv_type"=>$value['serv_type'],
    "client_branch"=> $value['client_branch'],
    "emp_array"=> $emp_arr,
];
}


json_encode($data['event_complete']);
foreach ($data['event_complete'] as $key => $value) {
    $data['complete_event']= (int)$value->count;
}
if($data['event_total'] > 0){
    $data['percent'] = round(($data['complete_event']/$data['event_total'])*100);
}

        // Pending task
if($_SESSION['position'] == USER_ROLE_EMPLOYEE){
    $query = $db->query('SELECT COUNT(start_event) as count FROM event_emp_views WHERE status = "Pending" AND emp_id ='.$emp_id);
}else{
    $query = $db->query('SELECT COUNT(start_event) as count FROM all_events WHERE status = "Pending"');
}
$data['event_pending'] = $query->getResult();

if($_SESSION['position'] == USER_ROLE_EMPLOYEE){
    $data['pending'] = $event_emp->where('status = "Pending" AND emp_id="'. $emp_id.'" ORDER BY start_event ASC')->findAll();
}else{
    $data['pending'] = $allevent->where('status = "Pending" ORDER BY start_event ASC')->findAll();
}

foreach ($data['pending'] as $key => $value) {
    $emp_arr = "";
    foreach ($data['event_emp'] as $key => $value_emps) {
        if ( $value['id'] == $value_emps['id']) {
         $emp_arr .= $data['event_emp'][$key]['emp_name'].",";
     }
 }
 // dd($data['pending']);
 $data['notdone'][]= (object)[
    "id"=> $value['id'],
    "title"=> $value['title'],
    "event_code"=>$value['event_code'],
    "log_code"=>$value['log_code'],
    "appt_code"=>$value['appt_code'],
    "start_event"=> $value['start_event'],
    "time"=> $value['time'],
    "end_time"=>$value['end_time'],
    "serv_id"=> $value['serv_id'],
    "client_id"=>$value['client_id'],
    "area"=> $value['area'],
    "status"=> $value['status'],
    "serv_name"=> $value['serv_name'],
    "serv_type"=>$value['serv_type'],
    "client_branch"=> $value['client_branch'],
    "emp_array"=> $emp_arr,
];
}

json_encode($data['event_pending']);
foreach ($data['event_pending'] as $key => $value) {
    $data['pending_event']= (int)$value->count;
}
$data['appt_pending'] = [];
// Pending Appointment
$data['pending_appt'] = $appt->where('appt_status = "Pending" ORDER BY appt_date ASC')->findAll();
$data['count_appt'] = count($data['pending_appt']);
// dd($data['count_appt']);
if($data['pending_appt'] != 0){
    foreach ($data['pending_appt'] as $key => $value) {
    
     // dd($data['pending']);
     $data['appt_pending'][]= (object)[
        "appt_id"=> $value['appt_id'],
        "appt_date"=> $value['appt_date'],
        "appt_code"=>$value['appt_code'],
        "appt_status"=>$value['appt_status'],
        
    ];
    }
}

// dd($data['pending_appt']);
// Pending Logs
$data['log_pending'] = [];
$data['pending_log'] = $logs->where('status = "Pending" ORDER BY date ASC')->findAll();
$data['count_log'] = count($data['pending_log']);
// dd($data['count_log']);

foreach ($data['pending_log'] as $key => $value) {
    
 // dd($data['pending']);
 $data['log_pending'][]= (object)[
    "cl_id"=> $value['cl_id'],
    "date"=> $value['date'],
    "log_code"=>$value['log_code'],
    "status"=>$value['status'],
    
];
}

$data['main'] = 'admin/dashboard/dashboard';
return view("templates/template",$data);
}


public function clientDashboard(){
    if($_SESSION['position'] == USER_ROLE_ADMIN && $_SESSION['position'] == USER_ROLE_SECRETARY){
            return $this->response->redirect(site_url('/dashboard'));
        }
    else if($_SESSION['position'] == USER_ROLE_EMPLOYEE){
        return $this->response->redirect(site_url('/appointment'));
    }
    $Appoint = new View_appointment();
    $event = new All_events();
    $emp = new Emp();
    $event_fcu = new Event_fcu_views();
    $fcu_no = new Fcu_no();
    $event_emp = new Event_emp();
    $client = new Client();
    $serv = new Serv();
    $aircon = new Aircon();
    $events = new Event();
    $event_emp_views = new Event_emp_views();
    $session = session();
    $id = $_SESSION['user_id'];
    $data['appoint'] = $Appoint->where('user_id', $id)->findAll();
    $appt_cal = $Appoint->where('user_id', $id)->where('appt_status !=','Cancelled')->findAll();
    $data['pending'] = $Appoint->where('appt_status', 'Pending')->where('user_id', $id)->findAll();
    // $data['approve'] = $Appoint->where('appt_status', 'Approved')->where('user_id', $id)->findAll();
    $data['complete'] = $Appoint->where('appt_status', 'Done')->where('user_id', $id)->findAll();
    // $data['reject'] = $Appoint->where('appt_status', 'Rejected')->where('user_id', $id)->findAll();
    $data['count_total'] = count($appt_cal);
    $data['count_pending'] = count($data['pending']);
    // $data['count_approve'] = count($data['approve']);
    $data['count_complete'] = count($data['complete']);
    // $data['count_reject'] = count($data['reject']);
    $data['events'] = $events->orderBy('id', 'ASC')->findAll();
    $data['event'] = array();
    $data['branch'] = array();
    $data['client'] = $client->orderBy('client_id', 'ASC')->findAll();
    $data['area'] = $client->select('area')->groupBy('area')->findAll();
    $data['emp'] = $emp->orderBy('emp_id', 'ASC')->findAll();
    $data['fcu_no'] = $fcu_no->orderBy('fcuno', 'ASC')->findAll();
    $data['event_fcu'] = $event_fcu->orderBy('id', 'ASC')->findAll();
    $data['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
    $data['serv'] = $serv->orderBy('serv_id', 'ASC')->findAll();
    $data['servName'] = $serv->select('serv_name, serv_color, serv_type')->groupBy('serv_name')->findAll();
    $data['servType'] = $serv->orderBy('serv_name','ASC')->findAll();
    $data['aircon'] = $aircon->orderBy('aircon_id', 'ASC')->findAll();
    $data['device_brand'] = $aircon->select('device_brand')->groupBy('device_brand')->findAll();
    if($data['count_total']!=0){
        $data['percent'] = round(($data['count_complete']/$data['count_total'])*100);
    }
    $db = \Config\Database::connect();
        $query   = $db->query('SELECT DISTINCT aircon_id,id,device_brand,aircon_type,quantity
            FROM event_fcu_views');
        $data['distinct'] = $query->getResult();

        $db1 = \Config\Database::connect();
        $query   = $db1->query('SELECT DISTINCT id
            FROM event_fcu_views');
        $data['distinct_event'] = $query->getResult();
        
    $set = $Appoint->where('user_id', $id)->where('appt_status !=','Cancelled')->findAll();
    // dd($set[0]['appt_code']);
    $appt_code = array();
    // dd($set);
    for ($i=0; $i < count($set); $i++) { 
        array_push($appt_code,$set[$i]['appt_code']);
    }
// dd($appt_code);
    foreach($data['area'] as $k => $val) {

        $area = [];

        foreach($data['client'] as $key => $value) {
            if($val['area'] == $value['area']){
              array_push($area , (object)[
                'client_id' => (int)$value['client_id'],
                'client_branch' =>$value['client_branch']
            ]);
          }

      }

      $data['client_area'][]= (object)[
        $val['area'] => $area
    ];
    $data['client_area2'][]=$area;
}
$data['all_events'] = array();
// dd($appt_code);
for ($a=0; $a < count($appt_code); $a++) { 
    $appt_event = $event->where('appt_code', $appt_code[$a])->first();
    array_push($data['all_events'],$appt_event);
}
// dd($data['all_events']);
foreach ($data['all_events'] as $key => $value) {
    $emp_arr = "";
    $fcu_arr =array();

    foreach ($data['event_emp'] as $key => $value_emps) {
        if ( $value['id'] == $value_emps['id']) {
           $emp_arr .= $data['event_emp'][$key]['emp_id'].",";
       }
   }


   foreach ($data['event_fcu'] as $key => $value_fcu) {
       if ($value['id'] == $value_fcu['id']) {
           array_push($fcu_arr , (object)[
            'id' => (int)$value_fcu['id'],
            'aircon_id' => (int)$value_fcu['aircon_id'],
            'fcuno' =>(int)$value_fcu['fcuno'],
            'quantity' =>(int)$value_fcu['quantity'],
            'device_brand' =>$value_fcu['device_brand'],
            'aircon_type' =>$value_fcu['aircon_type'],
            'fcu' =>$value_fcu['fcu'],
        ]);

       }   

   } 



   $data['event'][]= (object)[
    "id"=> $value['id'],
    "event_code"=> $value['event_code'],
    "title"=> $value['title'],
    "start"=> $value['start_event'],
    "time"=>$value['time'],
    "end_time"=>$value['end_time'],
    "serv_id"=> $value['serv_id'],
    "client_id"=> $value['client_id'],
    "serv_name"=> $value['serv_name'],
    "area"=> $value['area'],
    "client_branch"=> $value['client_branch'],
    "emp_array"=> $emp_arr,
    "fcu_array"=> $fcu_arr,
    "color" => $value['serv_color'],
    "comments" => $value['comments'],
];




}

    $data['main'] = 'client/dashboard/dashboard';
    return view("templates/template",$data);
}


public function profile($user_id)
{
    $User = new User();
    $session = session();
    $user_info = $User->where('user_id', $user_id)->first();
    
    $data['user_data'] = [

        'user_id' => $user_info['user_id'],
        'username' => $user_info['name'],
        'email' => $user_info['email'],
        'address' => $user_info['address'],
        'contact' => $user_info['contact'],
        'password' => $user_info['password'],
        'user_img' => $user_info['user_img'],
        'isLoggedIn' => TRUE,
    ];
    $data['main'] = 'admin/profile/profile';
    return view("templates/template",$data);
}
public function profileBdo($bdo_id)
{
    $User = new User_bdo();
    $session = session();
    $user_info = $User->where('bdo_id', $bdo_id)->first();
    
    $data['user_data'] = [

        'bdo_id' => $user_info['bdo_id'],
        'bdo_fname' => $user_info['bdo_fname'],
        'bdo_lname' => $user_info['bdo_lname'],
        'bdo_email' => $user_info['bdo_email'],
        'bdo_address' => $user_info['bdo_address'],
        'bdo_contact' => $user_info['bdo_contact'],
        'bdo_password' => $user_info['bdo_password'],
        'user_img' => $user_info['user_img'],
        'isLoggedIn' => TRUE,
    ];
    $data['main'] = 'client/profile/profile';
    return view("templates/template",$data);
}
public function update(){
    $User = new User();
    $user_id = $this->request->getVar('user_id');
    $user_obj = $User->find($user_id);
    $imageName= null;
    $old_img_name = $user_obj['user_img'];
    if($old_img_name == NULL){
       $file = $this->request->getFile('user_img');
       if ($file->isValid() && !$file->hasMoved()) {
        $imageName = $file->getRandomName();
        $file->move('uploads/',$imageName);
    }
}else{
    $file = $this->request->getFile('user_img');
    if ($file->isValid() && !$file->hasMoved()) {

        if (file_exists("uploads/".$old_img_name)) {
            unlink("uploads/".$old_img_name);
        }
        $imageName = $file->getRandomName();
        $file->move('uploads/',$imageName);
    }
    else{
        $imageName = $old_img_name;
    }
}

$session = session();
if($this->request->getVar('password') == NULL){
    $data = [
        'name' => $this->request->getVar('name'),
        'email'  => $this->request->getVar('email'),
        'address' => $this->request->getVar('address'),
        'contact'  => $this->request->getVar('contact'),
        'user_img' => $imageName,
    ];
}else{
    if($this->request->getVar('password') == $this->request->getVar('c_password')){
        $data = [
            'name' => $this->request->getVar('name'),
            'email'  => $this->request->getVar('email'),
            'address' => $this->request->getVar('address'),
            'contact'  => $this->request->getVar('contact'),
            'password'  =>password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'user_img' => $imageName,
        ];
    }else{
       session()->setFlashdata('error', 'Password didn\'t match, Please try again');
       return $this->response->redirect(site_url('/profile/'.$user_id));
   }
}
$User->update($user_id, $data);
if($User->update($user_id,$data)){
    session()->setFlashdata('message', 'Updated Successfully!');
}
$user_info = $User->where('user_id', $user_id)->first();

$getdata = [
    'user_id' => $user_info['user_id'],
    'username' => $user_info['name'],
    'email' => $user_info['email'],
    'address' => $user_info['address'],
    'contact' => $user_info['contact'],
    'user_img' => $user_info['user_img'],
    
    
    'isLoggedIn' => TRUE,
];

$session->set($getdata);

return $this->response->redirect(site_url('/profile/'.$user_id));
}
public function updateBdo(){
    $User = new User_bdo();
    $bdo_id = $this->request->getVar('bdo_id');
    $user_obj = $User->find($bdo_id);
    $imageName= null;
    $old_img_name = $user_obj['user_img'];
    if($old_img_name == NULL){
       $file = $this->request->getFile('user_img');
       if ($file->isValid() && !$file->hasMoved()) {
        $imageName = $file->getRandomName();
        $file->move('uploads/',$imageName);
    }
}else{
    $file = $this->request->getFile('user_img');
    if ($file->isValid() && !$file->hasMoved()) {

        if (file_exists("uploads/".$old_img_name)) {
            unlink("uploads/".$old_img_name);
        }
        $imageName = $file->getRandomName();
        $file->move('uploads/',$imageName);
    }
    else{
        $imageName = $old_img_name;
    }
}

$session = session();
if($this->request->getVar('bdo_password') == NULL){
    $data = [
        'bdo_fname' => $this->request->getVar('bdo_fname'),
        'bdo_lname' => $this->request->getVar('bdo_lname'),
        'bdo_email'  => $this->request->getVar('bdo_email'),
        'bdo_address' => $this->request->getVar('bdo_address'),
        'bdo_contact'  => $this->request->getVar('bdo_contact'),
        'user_img' => $imageName,
    ];
}else{
    if($this->request->getVar('bdo_password') == $this->request->getVar('c_password')){
        $data = [
            'bdo_fname' => $this->request->getVar('bdo_fname'),
            'bdo_lname' => $this->request->getVar('bdo_lname'),
            'bdo_email'  => $this->request->getVar('bdo_email'),
            'bdo_address' => $this->request->getVar('bdo_address'),
            'bdo_contact'  => $this->request->getVar('bdo_contact'),
            'bdo_password'  =>password_hash($this->request->getVar('bdo_password'), PASSWORD_DEFAULT),
            'user_img' => $imageName,
        ];
    }else{
       session()->setFlashdata('error', 'Password didn\'t match, Please try again');
       return $this->response->redirect(site_url('/profile-bdo/'.$bdo_id));
   }
}
$User->update($bdo_id, $data);
if($User->update($bdo_id,$data)){
    session()->setFlashdata('message', 'Updated Successfully!');
}
$user_info = $User->where('bdo_id', $bdo_id)->first();
// dd($user_info);
$getdata = [
    'bdo_id' => $user_info['bdo_id'],
    'bdo_fname' => $user_info['bdo_fname'],
    'bdo_lname' => $user_info['bdo_lname'],
    'bdo_email'  => $user_info['bdo_email'],
    'bdo_address' => $user_info['bdo_address'],
    'bdo_contact'  => $user_info['bdo_contact'],
    'user_img' => $user_info['user_img'],
    
    
    'isLoggedIn' => TRUE,
];

$session->set($getdata);

return $this->response->redirect(site_url('/profile-bdo/'.$bdo_id));
}
public function autoDone(){
    $Event = new Event();
    $Call_logs = new Call_logs();
    $Appt = new Appointment();
    $id = $this->request->getVar('id');
    $PendingEvents = $Event->where('id',$id)->findAll();

    $data = [
        'status' => "Done",
    ];
    $Event->update((int)$id, $data);
    if ($PendingEvents[0]['log_code'] != "") {
        $codeLog=explode("-",$PendingEvents[0]['log_code']);
        $cl_id = $codeLog[2];

        $data_log = [
            'status' => "Done",
        ];
        $Call_logs->update((int)$cl_id, $data_log);
    }
    if ($PendingEvents[0]['appt_code'] != "") {
        // dd("tru");
        $codeAppt=explode("-",$PendingEvents[0]['appt_code']);
        $appt_id = $codeAppt[2];
        $data_appt = [
            'appt_status' => "Done",
        ];
        $Appt->update((int)$appt_id, $data_appt);
    }
    return true;

}


public function logout()
{
    session()->destroy();
    return $this->response->redirect(site_url('/'));
}
}
?>
