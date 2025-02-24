<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Appointment;
use App\Models\View_appointment;
use App\Models\Client;
use App\Models\Aircon;
use App\Models\Fcu_no;
use App\Models\Serv;
use App\Models\Emp;
use App\Models\Event;
use App\Models\Event_emp;
use App\Models\Event_emp_views;
use App\Models\Event_fcu;
use App\Models\Appt_fcu;
use App\Models\Appt_fcu_views;
use App\Models\User_bdo;
use App\Models\Restrict_date;
use App\Models\All_events;
use App\Models\Emp_expertise_views;
use App\Models\Ratings;

class AppointmentCrud extends Controller
{

    public function index(){
        if($_SESSION['position'] == USER_ROLE_ADMIN && $_SESSION['position'] == USER_ROLE_SECRETARY){
            return $this->response->redirect(site_url('/dashboard'));
        }
        // dd("hello");
        $Client = new Client();
        $Aircon = new Aircon();
        $fcu_no = new Fcu_no();
        $Serv = new Serv();
        $Appoint = new View_appointment();
        // $Apptfcu = new Appt_fcu();
        $Appt_fcu_views = new Appt_fcu_views();
        $session = session();
        $session_id = $_SESSION['user_id'];

        $data['view_appoint'] =[];
        $data['fcu_no'] = $fcu_no->orderBy('fcuno', 'ASC')->findAll();
        $data['fcu_appt'] = $Appt_fcu_views->orderBy('appt_id', 'ASC')->findAll();
        $data['appoint'] = $Appoint->where('user_id',$session_id)->orderBy('appt_id', 'DESC')->findAll();
        $data['client'] = $Client->orderBy('client_id', 'ASC')->findAll();
        $data['area'] = $Client->select('area')->groupBy('area')->findAll();
        $data['aircon'] = $Aircon->orderBy('aircon_id', 'ASC')->findAll();
        $data['serv'] = $Serv->orderBy('serv_id', 'ASC')->findAll();
        $data['device_brand'] = $Aircon->select('device_brand')->groupBy('device_brand')->findAll();

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

    foreach ($data['appoint'] as $key => $value) {
        $fcu_arr = array();
        foreach ($data['fcu_appt'] as $key => $value_fcu) {
            if ( $value['appt_id'] == $value_fcu['appt_id']) {
             array_push($fcu_arr , (object)[
                'appt_id' => (int)$value_fcu['appt_id'],
                'aircon_id' => (int)$value_fcu['aircon_id'],
                'fcuno' =>(int)$value_fcu['fcuno'],
                'qty' =>(int)$value_fcu['qty'],
                'device_brand' =>$value_fcu['device_brand'],
                'aircon_type' =>$value_fcu['aircon_type'],
                'fcu' =>$value_fcu['fcu'],
            ]);
         }
     }    
     $data['view_appoint'][]= (object)[
        "appt_id"=> $value['appt_id'],
        "user_id"=> $value['user_id'],
        "appt_code"=> $value['appt_code'],
        "appt_date"=> $value['appt_date'],
        "appt_time"=> $value['appt_time'],
        "client_id"=> $value['client_id'],
        "serv_name" =>$value['serv_name'],
        "area"=> $value['area'],
        "client_branch"=> $value['client_branch'],
        "appt_status"=> $value['appt_status'],
        "fcu_arr"=> $fcu_arr,
        "rate"=> $value['rate'],
    ];
}

$data['main'] = 'client/appointment/appointment_view';
return view("templates/template",$data);

}

public function adminAppointment(){
        if($_SESSION['position'] != USER_ROLE_ADMIN && $_SESSION['position'] != USER_ROLE_SECRETARY){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Client = new Client();
        $Aircon = new Aircon();
        $fcu_no = new Fcu_no();
        $Serv = new Serv();
        $Emp = new Emp();
        $Appoint = new View_appointment();
        // $Apptfcu = new Appt_fcu();
        $Appt_fcu_views = new Appt_fcu_views();

        $data['view_appoint'] =[];
        $data['now'] = date('Y-m-d');
        $data['fcu_no'] = $fcu_no->orderBy('fcuno', 'ASC')->findAll();
        $data['fcu_appt'] = $Appt_fcu_views->orderBy('appt_id', 'ASC')->findAll();
        $data['appoint'] = $Appoint->orderBy('appt_id', 'DESC')->findAll();
        $data['client'] = $Client->orderBy('client_id', 'ASC')->findAll();
        $data['area'] = $Client->select('area')->groupBy('area')->findAll();
        $data['aircon'] = $Aircon->orderBy('aircon_id', 'ASC')->findAll();
        $data['serv'] = $Serv->orderBy('serv_id', 'ASC')->findAll();
        $data['servName'] = $Serv->select('serv_name, serv_color, serv_type')->groupBy('serv_name')->findAll();
        $data['servType'] = $Serv->orderBy('serv_name','ASC')->findAll();
        $data['emp'] = $Emp->orderBy('emp_id', 'ASC')->findAll();
        $data['device_brand'] = $Aircon->select('device_brand')->groupBy('device_brand')->findAll();

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

    foreach ($data['appoint'] as $key => $value) {
        $fcu_arr = array();
        foreach ($data['fcu_appt'] as $key => $value_fcu) {
            if ( $value['appt_id'] == $value_fcu['appt_id']) {
             array_push($fcu_arr , (object)[
                'appt_id' => (int)$value_fcu['appt_id'],
                'aircon_id' => (int)$value_fcu['aircon_id'],
                'fcuno' =>(int)$value_fcu['fcuno'],
                'qty' =>(int)$value_fcu['qty'],
                'device_brand' =>$value_fcu['device_brand'],
                'aircon_type' =>$value_fcu['aircon_type'],
                'fcu' =>$value_fcu['fcu'],
            ]);
         }
     }    
     // dd($fcu_arr);
     $data['view_appoint'][]= (object)[
        "appt_id"=> $value['appt_id'],
        "user_id"=> $value['user_id'],
        "appt_code"=> $value['appt_code'],
        "appt_date"=> $value['appt_date'],
        "appt_time"=> $value['appt_time'],
        "client_id"=> $value['client_id'],
        "serv_name" =>$value['serv_name'],
        "area"=> $value['area'],
        "client_branch"=> $value['client_branch'],
        "appt_status"=> $value['appt_status'],
        "fcu_arr"=> $fcu_arr,
    ];
}

// dd($data['view_appoint']);
$data['main'] = 'admin/appointment/appointment';
return view("templates/template",$data);

}

public function create(){
    $Client = new Client();
    $Aircon = new Aircon();
    $fcu_no = new Fcu_no();
    $resDate = new Restrict_date;
    $Serv = new Serv();
    $session = session();
    $client_id = $_SESSION['client_id'];
    $data['fcu_no'] = $fcu_no->orderBy('fcuno', 'ASC')->findAll();
    $data['date'] = $resDate->select('date')->findAll();
    $data['client'] = $Client->orderBy('client_id', 'ASC')->findAll();
    $data['area'] = $Client->select('area')->where('client_id', $client_id)->groupBy('area')->findAll();
    $data['client_name'] = $Client->where('client_id', $client_id)->first();
    // dd($data['client_name']);
    $data['aircon'] = $Aircon->orderBy('aircon_id', 'ASC')->findAll();
    $data['serv'] = $Serv->orderBy('serv_id', 'ASC')->findAll();
    $data['servName'] = $Serv->select('serv_name, serv_color, serv_type')->groupBy('serv_name')->findAll();
    $data['servType'] = $Serv->orderBy('serv_name','ASC')->findAll();
    $data['device_brand'] = $Aircon->select('device_brand')->groupBy('device_brand')->findAll();

foreach($data['device_brand'] as $k => $val) {
    
    $device_brand = [];

    foreach($data['aircon'] as $key => $value) {
        if($val['device_brand'] == $value['device_brand']){
          array_push($device_brand , (object)[
            'aircon_id' => (int)$value['aircon_id'],
            'aircon_type' =>$value['aircon_type']
        ]);
      }

  }
  $data['brand'][]= (object)[
    $val['device_brand'] => $device_brand
];

$data['brand2'][]=$device_brand;
}


$data['main'] = 'client/appointment/appointment_add';
return view("templates/template",$data);
}
public function store() {
    
    // dd($_POST);
    $Appoint = new Appointment();
    $Appt_fcu = new Appt_fcu();
    $Client = new Client();
    $Emp =  new Emp();
    $Event = new Event();
    $Event_emp = new Event_emp();
    $event_fcu = new Event_fcu();
    $Expertise = new Emp_expertise_views();
    $Aircon = new Aircon();
    $fcu_no = new Fcu_no();
    $Serv = new Serv();
    $operatingTime = ['8:00 AM','9:00 AM','10:00 AM','11:00 AM','1:00 PM','2:00 PM','3:00 PM','4:00 PM','5:00 PM','6:00 PM'];
    // dd($operatingTime);
    $client_branch = $Client->where('client_id',$this->request->getVar('client_id'))->first();
    $aircon_brand = $Aircon->where('aircon_id', $this->request->getVar('aircon_id')[0])->first();
    $aircon_details = $Aircon->where('device_brand', $aircon_brand['device_brand'])->findAll();
    // dd($aircon_details);
    // dd($client_branch);
    $start_date = explode('/',$this->request->getVar('appt_date'));
    $session = session();
    $user_id =$_SESSION['user_id'];
    $servId =$this->request->getVar('serv_id');
    $service = $Serv->where('serv_id',$servId)->first();
    $serviceName = $service['serv_name'];
    $date = $start_date[2].'-'.$start_date[0].'-'.$start_date[1];
    // dd($date);
    $time =$this->request->getVar('appt_time');
    // dd($time);
    $end_time = strtotime($time) + 60*60*2;
    
    $timeMinus = strtotime($time) - 60*60;
    $startTime= date('H:i', $timeMinus);
    // $timestamp = strtotime($end_time) + 60*60;
    $endTime = date('H:i', $end_time);
    // dd($endTime);

    $db1 = \Config\Database::connect();
     $query   = $db1->query('SELECT DISTINCT emp_name FROM event_emp_views where start_event = "'.$date.'" AND time >= "'.$startTime.'" AND end_time <= "'.$endTime.'"');
    if ($query->getResult()) {
       
         $data['distinct'] = $query->getResult();

         $sql_string = "Select * from employees where emp_name NOT IN('";
         foreach ($data['distinct'] as $key => $value) {
             $sql_string = $sql_string.$value->emp_name."','";

         }

         $final = substr($sql_string, 0, -2);

    $final2 = $final.")";

    $db2 = \Config\Database::connect();

    $query2   = $db2->query($final2);

    $available_emp = $query2->getResult();


    }else{
        $available_emp = $Emp->orderBy('emp_name','ASC')->findAll();

    }
    $available_emp= json_decode(json_encode($available_emp), true);
    // dd($available_emp);
    $expertEmp = array();
    for($a = 0; $a < count($available_emp); $a++){
      $availEmp = $available_emp[$a]['emp_id'];
      $expert = $Expertise->where('emp_id', $availEmp)->findAll();
      array_push($expertEmp, $expert);
    }
    // dd($expertEmp);
    $chosenEmp = array();
    for($b = 0; $b < count($expertEmp); $b++){
        for($c = 0; $c < count($expertEmp[$b]); $c++){
            if($expertEmp[$b][$c]['serv_name'] == $serviceName){
                array_push($chosenEmp, $expertEmp[$b][$c]);
            }
        }
    }
    
    $selectEmp = array();
    for($d=0; $d<2; $d++){
        for($e = 0; $e < count($expertEmp[$d]); $e++){
            array_push($selectEmp, $expertEmp[$d][$e]['emp_id']);
        }
    }
    $selected= array_unique($selectEmp);
    // dd($selected);
    $restrictTime = $this->request->getVar('availTime');
    // dd($restrictTime);
    $timeArr = explode(",", $restrictTime);
    $unavailDate = $this->request->getVar('unavailDate');
    $time = $this->request->getVar('appt_time').":00";

    // $selectedTime = $this->request->getVar('appt_time');

     $selectedTime = explode(":",$this->request->getVar('appt_time'));
     $displayTime;
     if ($selectedTime[0]>=12){
         $hour = $selectedTime[0] - 12;
         $amPm = "PM";
         $displayTime = $hour . ":" . $selectedTime[1] . " " . $amPm;
     }
    else{
        $hour = $selectedTime[0];
        $amPm = "AM";
        $displayTime = ltrim($hour, '0') . ":" . $selectedTime[1] . " " . $amPm;
     }
     // dd($displayTime);

    $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = substr(str_shuffle($set), 0, 5);
    $allow = 0;

    for($b=0;$b<count($operatingTime);$b++){
        if($displayTime ==$operatingTime[$b]){
            $allow=1;
        }
    }
    // dd($unavailDate);
    if($allow>0)
    {
        for($a=0;$a<count($operatingTime);$a++){
            // dd($operatingTime[$a]);
            if($displayTime == $operatingTime[$a]){
                for($i=0;$i<count($timeArr);$i++)
                {
                    
                    if($time == $timeArr[$i]){
                        $session = session();
                        $session->setFlashdata('errorTime', 'Selected Time is not Available, Please choose another time');
                        $session->setFlashdata('date', $_POST['appt_date']);
                        $session->setFlashdata('serv', $_POST['serv_id']);
                        $session->setFlashdata('device_brand', $_POST['device_brand']);
                        $session->setFlashdata('aircon_id', $_POST['aircon_id']);
                        $session->setFlashdata('fcuno', $_POST['fcuno']);
                        $session->setFlashdata('qty', $_POST['qty']);
                        $session->setFlashdata('availTime', $restrictTime);
                        $session->setFlashdata('unavailDate', $unavailDate);
                        $session->setFlashdata('aircon_brand', $aircon_details);
                        return $this->response->redirect(site_url('/appointment/create'));
                    }
                }
            
            
                if($unavailDate != "Unavailable"){
                    $appoint_create = [
                        'appt_date' =>$start_date[2].'-'.$start_date[0].'-'.$start_date[1],
                        // 'bdo_id' => $this->request->getVar('bdo_id'),
                        'appt_time' => $this->request->getVar('appt_time'),
                        'area' => $this->request->getVar('area'),
                        'serv_id' => $this->request->getVar('serv_id'),
                        'client_id' => $this->request->getVar('client_id'),
                        // 'status' => $this->request->getVar('status'),
                        'user_id' => $user_id,
                        'comments' => $this->request->getVar('comments'),
                    ];
                    // dd($appoint_create);
                    $success = $Appoint->insert($appoint_create);
                
                    if($success){
                        // dd("here");
                            $appt_code = ['appt_code' => 'appt-'.$code.'-'.(int)$success];
                            $success2 = $Appoint->update((int)$success,$appt_code);
                            if($success2){
                                // dd("here2");
                                $success3=$Event->insert([
                                    'title' => date("g:ia",strtotime($this->request->getVar('appt_time')))." ".$client_branch['client_branch'],
                                    // 'log_code' => $log_code,
                                    'start_event' => $start_date[2].'-'.$start_date[0].'-'.$start_date[1],
                                    'appt_code' => $appt_code,
                                    'time' => $this->request->getVar('appt_time'),
                                    'end_time' => $endTime,
                                    'client_id' => $this->request->getVar('client_id'),
                                    'serv_id' => $this->request->getVar('serv_id'),
                                    'comments' => $this->request->getVar('comments'),

                                ]);
                                
                                if($success3){
                                    // dd("here3");
                                    $event_code = ['event_code' => 'task-'.$code.'-'.(int)$success3];
                                    $Event->update((int)$success3,$event_code);
                                }

                                foreach($selected as $key => $value) {
                                    $Event_emp->insert([
                                        'emp_id'=> (int) $value,
                                        'id' => (int) $success3
                                    ]);
                                }

                                foreach ($_POST['aircon_id'] as $index => $aircon) {
                                    foreach ($_POST['fcuno'.$index] as $key => $floor_num) {
                                        $event_fcu->insert([
                                            'id'=> (int) $success3,
                                            'aircon_id'=> (int)$aircon,
                                            'quantity'=> (int)$_POST['quantity'][$index],
                                            'fcuno'=>$floor_num
                                        ]);
                                    }

                                }
                            }
                        }
                    foreach ($_POST['aircon_id'] as $index => $aircon) {
                        foreach ($_POST['fcuno'.$index] as $key => $floor_num) {
                            $Appt_fcu->insert([
                                'appt_id' => (int) $success,
                                'aircon_id' => (int)$aircon,
                                'qty' => (int)$_POST['quantity'][$index],
                                'fcuno'=>$floor_num
                            ]);
                        }
                    }
                    $session = session();
                    $session->setFlashdata('add', 'value');
                    return $this->response->redirect(site_url('/appointment'));
                }else{
                    $session = session();
                    $session->setFlashdata('errorDate', 'Date is fully Booked, Please Choose another date');
                    return $this->response->redirect(site_url('/appointment/create'));
                }
            }
        }
    }else{
        $session = session();
        $session->setFlashdata('errorOpTime', $displayTime.' is outside operating hours');
        $session->setFlashdata('data', $_POST);
        return $this->response->redirect(site_url('/appointment/create'));
    }

}
public function singleAppt($appt_id){
    
    $db = \Config\Database::connect();
        $query   = $db->query('SELECT DISTINCT aircon_id,appt_id,device_brand,aircon_type,qty
            FROM appt_fcu_views');
        $data['distinct'] = $query->getResult();

        $db1 = \Config\Database::connect();
        $query   = $db1->query('SELECT DISTINCT appt_id
            FROM appt_fcu_views');
        $data['distinct_event'] = $query->getResult();

    $Appoint = new Appointment();
    $Appoint_view = new View_appointment();
    $Client = new Client();
    $Aircon = new Aircon();
    $fcu_no = new Fcu_no();
    $Appt_fcu = new Appt_fcu();
    $Serv = new Serv();
    $Appt_fcu_views = new Appt_fcu_views();

    $data['fcu_no'] = $fcu_no->orderBy('fcuno', 'ASC')->findAll();
    $data['serv'] = $Serv->orderBy('serv_id', 'ASC')->findAll();
    $data['servName'] = $Serv->select('serv_name, serv_color, serv_type')->groupBy('serv_name')->findAll();
    $data['servType'] = $Serv->orderBy('serv_name','ASC')->findAll();
    $data['appt_fcu'] = $Appt_fcu->orderBy('appt_id', 'ASC')->findAll();
    $data['fcu_select'] = $Appt_fcu->where('appt_id', $appt_id)->findAll();
    $data['aircon'] = $Aircon->orderBy('aircon_id', 'ASC')->findAll();
    $data['device_brand'] = $Aircon->select('device_brand')->groupBy('device_brand')->findAll();
    $data['appt'] = $Appoint->where('appt_id', $appt_id)->first();
    $data['area'] = $Client->select('area')->groupBy('area')->findAll();
    $data['client'] = $Client->orderBy('client_id', 'ASC')->findAll();
    $data['view_appoint'] = $Appoint_view->where('appt_id', $appt_id)->first();
    $data['fcu_views'] = $Appt_fcu_views->where('appt_id', $appt_id)->findAll();
    $data['date_format'] = explode('-',$data['appt']['appt_date']);
    $data['new_date'] = $data['date_format'][1].'-'.$data['date_format'][2].'-'.$data['date_format'][0];
    // dd($data['new_date']);
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
}

foreach($data['device_brand'] as $k => $val) {
    
    $device_brand = [];

    foreach($data['aircon'] as $key => $value) {
        if($val['device_brand'] == $value['device_brand']){
          array_push($device_brand , (object)[
            'aircon_id' => (int)$value['aircon_id'],
            'aircon_type' =>$value['aircon_type']
        ]);
      }

  }
  $data['brand'][]= (object)[
    $val['device_brand'] => $device_brand
];

}

$data['main'] = 'client/appointment/appointment_edit';
return view("templates/template",$data);
}
public function update(){
    
    // dd($_POST);
    $Appoint = new Appointment();
    
    $Appt_fcu = new Appt_fcu();
    $Client = new Client();
    $Aircon = new Aircon();
    $Event = new Event();
    $event_fcu = new Event_fcu();
    $appt_id = $this->request->getVar('appt_id');
    $start_date = explode('/',$this->request->getVar('appt_date'));
    $client_branch = $Client->where('client_id',$this->request->getVar('client_id_update'))->first();
    $time =$this->request->getVar('appt_time');
    // dd($time);
    $end_time = strtotime($time) + 60*60*2;
    $event_data = $Event->where('appt_code', $_POST['appt_code'])->first();
    // dd($event_data['id']);
    $timeMinus = strtotime($time) - 60*60;
    $startTime= date('H:i', $timeMinus);
    // $timestamp = strtotime($end_time) + 60*60;
    $endTime = date('H:i', $end_time);
    if(count($start_date) == 1){
        $start_date = explode('-',$this->request->getVar('appt_date'));
        $data = [
            'appt_date' => $start_date[2].'-'.$start_date[0].'-'.$start_date[1],
            // 'appt_date' => $this->request->getVar('appt_date'),
            'appt_time' => $this->request->getVar('appt_time'),
            'area' => $this->request->getVar('area'),
            'serv_id'=> $this->request->getVar('serv_id'),
            'client_id'  => (int)($this->request->getVar('client_id_update')),
            'comments' => $this->request->getVar('comments'),
            'status' => $this->request->getVar('status')
        ];
    }else{
        $data = [
            'appt_date' => $start_date[2].'-'.$start_date[0].'-'.$start_date[1],
            // 'appt_date' => $this->request->getVar('appt_date'),
            'appt_time' => $this->request->getVar('appt_time'),
            'area' => $this->request->getVar('area'),
            'serv_id'=> $this->request->getVar('serv_id'),
            'client_id'  => (int)($this->request->getVar('client_id_update')),
            'comments' => $this->request->getVar('comments'),
            'status' => $this->request->getVar('status')
        ];
    }
    
    $success=$Appoint->update($appt_id, $data);
    if($success){
        // dd("here2");
        $success2=$Event->update($event_data['id'],[
            'title' => date("g:ia",strtotime($this->request->getVar('appt_time')))." ".$client_branch['client_branch'],
            // 'log_code' => $log_code,
            'start_event' => $start_date[2].'-'.$start_date[0].'-'.$start_date[1],
            // 'appt_code' => $appt_code,
            'time' => $this->request->getVar('appt_time'),
            'end_time' => $endTime,
            'client_id' => $this->request->getVar('client_id_update'),
            'serv_id' => $this->request->getVar('serv_id'),
            'comments' => $this->request->getVar('comments'),

        ]);
        $event_fcu->where('id', $event_data['id'])->delete();
        foreach ($_POST['aircon_update_id'] as $index => $aircon) {
            foreach ($_POST['fcuno_update_'.$aircon] as $key => $floor_num) {
                // dd($floor_num);
                $event_fcu->insert([
                    'id'=> (int) $event_data['id'],
                    'aircon_id'=> (int)$aircon,
                    'quantity'=> (int)$_POST['quantity'][$index],
                    'fcuno'=>$floor_num
                ]);
            }
        }
    }
    $Appt_fcu->where('appt_id', $appt_id)->delete();
    foreach ($_POST['aircon_update_id'] as $index => $aircon) {
        foreach ($_POST['fcuno_update_'.$aircon] as $key => $floor_num) {
            $Appt_fcu->insert([
                'fcuno'=>(int)$floor_num,
                'aircon_id'=> (int)$aircon,
                'qty'=> (int)$_POST['quantity'][$index],
                'appt_id' => $appt_id
            ]);
        }
    }
    $session = session();
    $session->setFlashdata('update', 'value');
    return $this->response->redirect(site_url('/appointment'));
    
}
public function delete($appt_id = null){
    
    $Appoint = new Appointment();
    $event = new Event();
    
    $data['Appoint'] = $Appoint->where('appt_id', $appt_id)->first();
    $apptCode = $data['Appoint']['appt_code'];
    $eventAppt = $event->where('appt_code', $apptCode)->delete();
    if($eventAppt){
      $update_set = ['appt_status' => 'Cancelled'];
      $Appoint->update((int)$appt_id,$update_set);
    }
    return $this->response->redirect(site_url('/appointment'));
}

public function cancelAppt(){
    $Appoint = new Appointment();
    $event = new Event();
    $Bdo = new User_bdo();
    $appt_id = $this->request->getPost('appt_id');
    $user_id = $this->request->getPost('user_id');
    $reason = $this->request->getPost('reason');
    $data['appt']=$Appoint->find($appt_id);
    $data['eventAppt'] = $event->where('appt_code',$data['appt']['appt_code'])->delete();
    $data['user_data'] = $Bdo->where('bdo_id',$user_id)->first();
    $user_email =  $data['user_data']['bdo_email'];
    $user =  $data['user_data']['bdo_lname'];
    $appt_code = $data['appt']['appt_code'];
    $update_set = ['appt_status' => 'Cancelled'];
    $Appoint->update((int)$appt_id,$update_set);

    $data['rejected'] = 'The Appointment has been [CANCELLED!]';


    $to = $user_email;

        $subject = "TSMS - Appointment Cancelled";
        $message = "<html>
        <head>
        <title>Appointment ".$appt_code."</title>
        </head>
        <body>
        <h6>Dear, Mr/Ms. ".$user."</h6>
        <p>Your Appointment ".$appt_code." has been CANCELLED due to the reason \"".$reason."\".</p>
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


    return $this->response->setJSON($data);
}

public function view(){
    $Appoint = new View_appointment();
    $Fcu = new Appt_fcu_views();
    $Client = new Client();
    // $Emp = new Event_emp_views();
    $Serv = new Serv();
    $id = $this->request->getPost('appt_id');
    $data['appt_data'] = $Appoint->where('appt_id',$id)->first();
    $data['fcu_data'] = $Fcu->where('appt_id',$id)->findAll();
    $data['client_data'] = $Client->orderBy('client_id','ASC')->findAll();
    $data['serv_data'] = $Serv->orderBy('serv_id','ASC')->findAll();
    $data['id'] = $id;
    return $this->response->setJSON($data);
}
public function getEmp(){
    $event = new Event_emp_views();
    $id = $this->request->getVar('appt_id');
    $data['eventEmp'] = $event->where('appt_code !=', '')->findAll();
    // $data['appt_data'] = $Appoint->where('appt_id',$id)->first();
    // $data['fcu_data'] = $Fcu->where('appt_id',$id)->findAll();
    // $data['client_data'] = $Client->orderBy('client_id','ASC')->findAll();
    // $data['serv_data'] = $Serv->orderBy('serv_id','ASC')->findAll();

    return $this->response->setJSON($data);
}
public function rateService(){
    // dd($_POST);
    $rate = new Ratings();
    $Appoint = new Appointment();
    $event = new Event();
    $apptId = $_POST['appt_id'];
    if(isset($_POST['rate'])){
        foreach($_POST['emp_id'] as $k => $val){
            // dd($_POST['techComments'][$k]);
            $rate->insert([
                'id'=> $_POST['event_id'],
                'rate_event'=> $_POST['rate'],
                'event_comments'=> $_POST['comments'],
                'emp_id'=> $val,
                'rate_emp'=> $_POST['rate_'.$val],
                'emp_comments'=> $_POST['techComments'][$k],
            ]);
        }
        $update_rate = ['rate' => 1];
        $Appoint->update($apptId,$update_rate);
    }
    else{
        $session = session();
        $session->setFlashdata('Error','Please rate correctly');
    }
    return $this->response->redirect(site_url('/appointment'));
}
public function checkDate(){
    $events = new All_events();
    $date = $this->request->getPost('date');
    $format = explode("/", $date);
    $newDate = $format[2]."-".$format[0]."-".$format[1];
    $data['events_data'] = $events->where('start_event',$newDate)->orderBy("TIME", "ASC")->findAll();
    
    return $this->response->setJSON($data);
}
public function viewRatings(){
    $rate = new Ratings();
    $emp = new Event_emp_views();
    $event = new Event();
    $appt_code = $_GET['id'];

    $id = $event->select('id')->where('appt_code',$appt_code)->first();

    if($_SESSION['position'] == USER_ROLE_EMPLOYEE){
       $emp_id = $_SESSION['emp_id']; 
       $data['rate'] = $rate->where('id',$id)->where('emp_id',$emp_id )->findAll();
       $data['emp'] = $emp->where('id',$id)->where('emp_id',$emp_id )->findAll();
    }else{
       $data['rate'] = $rate->where('id',$id)->findAll();
       $data['emp'] = $emp->where('id',$id)->findAll();
    }

    return $this->response->setJSON($data);
}
}
