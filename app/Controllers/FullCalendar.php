<?php

namespace App\Controllers;
use App\Models\All_events;
use App\Models\Appointment;
use App\Models\Emp;
use App\Models\Client;
use App\Models\Serv;
use App\Models\Event_emp;
use App\Models\Event_emp_views;
use App\Models\Aircon;
use App\Models\Event_fcu;
use App\Models\Fcu_no;
use App\Models\Event_fcu_views;
use App\Models\Event;
use App\Models\Call_logs;
use App\Models\Call_fcu;
use App\Models\User_bdo;

class FullCalendar extends BaseController
{

    public function index()
    {
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            if($_SESSION['position'] == USER_ROLE_EMPLOYEE){
                return $this->response->redirect(site_url('/calendar/emp'));
            }
            else{
                return $this->response->redirect(site_url('/appointment'));
            }
        }

        $db = \Config\Database::connect();
        $query   = $db->query('SELECT DISTINCT aircon_id,id,device_brand,aircon_type,quantity
            FROM event_fcu_views');
        $datas['distinct'] = $query->getResult();

        $db1 = \Config\Database::connect();
        $query   = $db1->query('SELECT DISTINCT id
            FROM event_fcu_views');
        $datas['distinct_event'] = $query->getResult();
          // dd($datas['distinct'] );



        $event = new All_events();
        $emp = new Emp();
        $event_fcu = new Event_fcu_views();
        $fcu_no = new Fcu_no();
        $event_emp = new Event_emp();
        $client = new Client();
        $serv = new Serv();
        $aircon = new Aircon();
        $events = new Event();
        
        $datas['events'] = $events->orderBy('id', 'ASC')->findAll();
        $datas['event'] = array();
        $datas['branch'] = array();
        $datas['client'] = $client->orderBy('client_id', 'ASC')->findAll();
        $datas['area'] = $client->select('area')->groupBy('area')->findAll();
        $datas['emp'] = $emp->orderBy('emp_id', 'ASC')->findAll();
        $datas['fcu_no'] = $fcu_no->orderBy('fcuno', 'ASC')->findAll();
        $datas['event_fcu'] = $event_fcu->orderBy('id', 'ASC')->findAll();
        $datas['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
        $datas['serv'] = $serv->orderBy('serv_id', 'ASC')->findAll();
        $datas['servName'] = $serv->select('serv_name, serv_color, serv_type')->groupBy('serv_name')->findAll();
        $datas['servType'] = $serv->orderBy('serv_name','ASC')->findAll();
        $datas['aircon'] = $aircon->orderBy('aircon_id', 'ASC')->findAll();
        $datas['device_brand'] = $aircon->select('device_brand')->groupBy('device_brand')->findAll();
        // dd($datas['event_aircon']);
        foreach($datas['area'] as $k => $val) {

            $area = [];

            foreach($datas['client'] as $key => $value) {
                if($val['area'] == $value['area']){
                  array_push($area , (object)[
                    'client_id' => (int)$value['client_id'],
                    'client_branch' =>$value['client_branch']
                ]);
              }

          }

          $datas['client_area'][]= (object)[
            $val['area'] => $area
        ];
        $datas['client_area2'][]=$area;
    }

    $datas['all_events'] = $event->orderBy('id', 'ASC')->findAll();
    // dd($datas['all_events'] );
        // $datas['all_events'] = $event->where('STATUS', 'Done')->findAll();
        // dd($data[0]['title']);
    foreach ($datas['all_events'] as $key => $value) {
        $emp_arr = "";
        $fcu_arr =array();

        foreach ($datas['event_emp'] as $key => $value_emps) {
            if ( $value['id'] == $value_emps['id']) {
               $emp_arr .= $datas['event_emp'][$key]['emp_id'].",";
           }
       }


       // dd($datas['event_fcu']);
       foreach ($datas['event_fcu'] as $key => $value_fcu) {
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



       $datas['event'][]= (object)[
        "id"=> $value['id'],
        "title"=> $value['title'],
        "event_code"=> $value['event_code'],
        "log_code"=> $value['log_code'],
        "appt_code"=> $value['appt_code'],
        "start"=> $value['start_event'],
                 // "repeatable"=> $value['repeatable'],
        "time"=>$value['TIME'],
        "serv_id"=> $value['serv_id'],
                 // "aircon_id"=> $value['aircon_id'],
        "client_id"=> $value['client_id'],
        "serv_name"=> $value['serv_name'],
                 // "device_brand"=> $value['device_brand'],
                 // "aircon_type"=> $value['aircon_type'],
                 // "quantity"=> $value['quantity'],
        "area"=> $value['area'],
        "client_branch"=> $value['client_branch'],
        "emp_array"=> $emp_arr,
        "fcu_array"=> $fcu_arr,
        "color" => $value['serv_color'],
    ];
// dd($datas['event']);
    
    

}


$datas['main'] = 'admin/calendar/calendar';
return view("templates/template",$datas);
}
public function index1()
{

    if($_SESSION['position'] == USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/calendar'));
    }
    else if($_SESSION['position'] == USER_ROLE_CLIENT){
        return $this->response->redirect(site_url('/appointment'));
    }


    $db = \Config\Database::connect();
    $query   = $db->query('SELECT DISTINCT aircon_id,id,device_brand,aircon_type,quantity
        FROM event_fcu_views');
    $datas['distinct'] = $query->getResult();

    $db1 = \Config\Database::connect();
    $query   = $db1->query('SELECT DISTINCT id
        FROM event_fcu_views');
    $datas['distinct_event'] = $query->getResult();
          // dd($datas['distinct'] );
    


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
    $emp_id = $_SESSION['emp_id'];
        // dd($emp_id);

    $datas['events'] = $events->orderBy('id', 'ASC')->findAll();
    $datas['event'] = array();
    $datas['branch'] = array();
    $datas['client'] = $client->orderBy('client_id', 'ASC')->findAll();
    $datas['area'] = $client->select('area')->groupBy('area')->findAll();
    $datas['emp'] = $emp->orderBy('emp_id', 'ASC')->findAll();
    $datas['fcu_no'] = $fcu_no->orderBy('fcuno', 'ASC')->findAll();
    $datas['event_fcu'] = $event_fcu->orderBy('id', 'ASC')->findAll();
    $datas['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
    $datas['serv'] = $serv->orderBy('serv_id', 'ASC')->findAll();
    $datas['servName'] = $serv->select('serv_name, serv_color, serv_type')->groupBy('serv_name')->findAll();
    $datas['servType'] = $serv->orderBy('serv_name','ASC')->findAll();
    $datas['aircon'] = $aircon->orderBy('aircon_id', 'ASC')->findAll();
    $datas['device_brand'] = $aircon->select('device_brand')->groupBy('device_brand')->findAll();
        // dd($datas['event_aircon']);
    foreach($datas['area'] as $k => $val) {

        $area = [];

        foreach($datas['client'] as $key => $value) {
            if($val['area'] == $value['area']){
              array_push($area , (object)[
                'client_id' => (int)$value['client_id'],
                'client_branch' =>$value['client_branch']
            ]);
          }

      }

      $datas['client_area'][]= (object)[
        $val['area'] => $area
    ];
    $datas['client_area2'][]=$area;
}
$datas['all_events'] = $event_emp_views->where('emp_id', $emp_id)->findAll();
foreach ($datas['all_events'] as $key => $value) {
    $emp_arr = "";
    $fcu_arr =array();

    foreach ($datas['event_emp'] as $key => $value_emps) {
        if ( $value['id'] == $value_emps['id']) {
           $emp_arr .= $datas['event_emp'][$key]['emp_id'].",";
       }
   }


   foreach ($datas['event_fcu'] as $key => $value_fcu) {
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



   $datas['event'][]= (object)[
    "id"=> $value['id'],
    "event_code"=> $value['event_code'],
    "title"=> $value['title'],
    "start"=> $value['start_event'],
    "time"=>$value['time'],
    "serv_id"=> $value['serv_id'],
    "client_id"=> $value['client_id'],
    "serv_name"=> $value['serv_name'],
    "area"=> $value['area'],
    "client_branch"=> $value['client_branch'],
    "emp_array"=> $emp_arr,
    "fcu_array"=> $fcu_arr,
    "color" => $value['serv_color'],
];




}


         // dd($datas['event']);

$datas['main'] = 'employee/calendar/calendar';
return view("templates/template",$datas);
}

public function event(){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }
    $event = new All_events();
        // $emp = new Emp();
    $client = new Client();
    $serv = new Serv();
    $event_emp = new Event_emp_views();
    $event_fcu = new Event_fcu_views();
    // $aircon = new Aircon();

    $db = \Config\Database::connect();
    $query   = $db->query('SELECT DISTINCT aircon_id,id,device_brand,aircon_type,quantity
        FROM event_fcu_views');
    $datas['distinct'] = $query->getResult();

    $db1 = \Config\Database::connect();
    $query   = $db1->query('SELECT DISTINCT id
        FROM event_fcu_views');
    $datas['distinct_event'] = $query->getResult();
          // dd($datas['distinct'] );

    $datas['event'] = array();
    $datas['client'] = $client->orderBy('client_id', 'ASC')->findAll();
        // $datas['emp'] = $emp->orderBy('emp_id', 'ASC')->findAll();
    $datas['serv'] = $serv->orderBy('serv_id', 'ASC')->findAll();
    $datas['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
    $datas['event_fcu'] = $event_fcu->orderBy('id', 'ASC')->orderBy('fcuno', 'ASC')->findAll();
    // $datas['aircon'] = $aircon->orderBy('aircon_id', 'ASC')->findAll();
    $datas['all_events'] = $event->orderBy('start_event', 'ASC')->findAll();
        // dd($datas['groupby_fcu']);
    foreach ($datas['all_events'] as $key => $value) {

        $emp_arr = "";
        foreach ($datas['event_emp'] as $key => $value_emps) {
            if ( $value['id'] == $value_emps['id']) {
             $emp_arr .= $datas['event_emp'][$key]['emp_name'].",";
         }
     }
     $fcu_arr = array();

       // dd($datas['event_fcu']);
     foreach ($datas['event_fcu'] as $key => $value_fcu) {
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
   $datas['event'][]= (object)[
      "id"=> $value['id'],
      "title"=>$value['title'],
      "event_code"=> $value['event_code'],
      "log_code"=> $value['log_code'],
      "appt_code"=> $value['appt_code'],
      "start_event"=> $value['start_event'],
      "time"=> $value['TIME'],
      "serv_id"=> $value['serv_id'],
      "client_id"=>$value['client_id'],
  // "aircon_array"=>$aircon_arr,
      "serv_name"=>$value['serv_name'],
      "serv_type"=>$value['serv_type'],
      "area"=> $value['area'],
      "emp_array"=> $emp_arr,
      "fcu_array"=> $fcu_arr,
      "client_branch"=> $value['client_branch'],
      "status"=> $value['STATUS'],
  ];
}
            // dd( $datas['event']);
$datas['main'] = 'admin/calendar/events';
return view("templates/template",$datas);

}

public function getfilter(){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }
    $event = new All_events();
        // $emp = new Emp();
    $client = new Client();
    $serv = new Serv();
    $event_emp = new Event_emp_views();
    $event_fcu = new Event_fcu_views();
    // $aircon = new Aircon();

    $db = \Config\Database::connect();
    $query   = $db->query('SELECT DISTINCT aircon_id,id,device_brand,aircon_type,quantity
        FROM event_fcu_views');
    $datas['distinct'] = $query->getResult();

    $db1 = \Config\Database::connect();
    $query   = $db1->query('SELECT DISTINCT id
        FROM event_fcu_views');
    $datas['distinct_event'] = $query->getResult();
          // dd($datas['distinct'] );

    
    $datas['event'] = array();
    $datas['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
    $datas['event_fcu'] = $event_fcu->orderBy('id', 'ASC')->orderBy('fcuno', 'ASC')->findAll();

    if(isset($_GET['start_date']) && isset($_GET['to_date']))
    {
        $start_date = $_GET['start_date'];
        $to_date = $_GET['to_date'];

        $datas['all_events'] = $event->where('start_event BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($to_date)).'"')->findAll();
        foreach ($datas['all_events'] as $key => $value) {
            $emp_arr = "";
            foreach ($datas['event_emp'] as $key => $value_emps) {
                if ( $value['id'] == $value_emps['id']) {
                   $emp_arr .= $datas['event_emp'][$key]['emp_name'].",";
               }
           }
           $fcu_arr = array();
           foreach ($datas['event_fcu'] as $key => $value_fcu) {
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


         $datas['event'][]= (object)[
            "id"=> $value['id'],
            "title"=>$value['title'],
            "event_code"=> $value['event_code'],
            "log_code"=> $value['log_code'],
            "appt_code"=> $value['appt_code'],
            "start_event"=> $value['start_event'],
            "time"=> $value['TIME'],
            "serv_id"=> $value['serv_id'],
            "client_id"=>$value['client_id'],
        // "aircon_array"=>$aircon_arr,
            "serv_name"=>$value['serv_name'],
            "serv_type"=>$value['serv_type'],
            "area"=> $value['area'],
            "emp_array"=> $emp_arr,
            "fcu_array"=> $fcu_arr,
            "client_branch"=> $value['client_branch'],
            "status"=> $value['STATUS'],
        ];
    }


}
$datas['main'] = 'admin/calendar/events';
return view('templates/template',$datas);
}
public function printpdf($strt,$end){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }
    $session = session();
    $event = new All_events();
    $event_emp = new Event_emp_views();
    $event_fcu = new Event_fcu_views();

    $db = \Config\Database::connect();
    $query   = $db->query('SELECT DISTINCT aircon_id,id,device_brand,aircon_type,quantity
        FROM event_fcu_views');
    $datas['distinct'] = $query->getResult();

    $db1 = \Config\Database::connect();
    $query   = $db1->query('SELECT DISTINCT id
        FROM event_fcu_views');
    $datas['distinct_event'] = $query->getResult();
          // dd($datas['distinct'] );

    $datas['date'] = [$strt,$end];
    $datas['event'] = array();
    $datas['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
    $datas['event_fcu'] = $event_fcu->orderBy('id', 'ASC')->orderBy('fcuno', 'ASC')->findAll();

    $datas['all_events'] = $event->where('start_event BETWEEN "'. date('Y-m-d', strtotime($strt)). '" and "'. date('Y-m-d', strtotime($end)).'"')->findAll();

    foreach ($datas['all_events'] as $key => $value) {
        $emp_arr = "";
        foreach ($datas['event_emp'] as $key => $value_emps) {
            if ( $value['id'] == $value_emps['id']) {
               $emp_arr .= $datas['event_emp'][$key]['emp_name'].",";
           }
       }
       $fcu_arr = array();

       // dd($datas['event_fcu']);
       foreach ($datas['event_fcu'] as $key => $value_fcu) {
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


       $datas['event'][]= (object)[
        "id"=> $value['id'],
        "title"=>$value['title'],
        "start_event"=> $value['start_event'],
        "time"=> $value['TIME'],
        "serv_id"=> $value['serv_id'],
        "client_id"=>$value['client_id'],
            // "aircon_array"=>$aircon_arr,
        "serv_name"=>$value['serv_name'],
        "serv_type"=>$value['serv_type'],
            // "device_array"=> $device_arr,
                            // "aircon_type"=> $value['aircon_type'],
            // "quantity_array"=> $quantity_arr,
        "area"=> $value['area'],
        "emp_array"=> $emp_arr,
        "fcu_array"=> $fcu_arr,
        "client_branch"=> $value['client_branch'],
        "status"=> $value['STATUS'],
    ];
}



return view('admin/calendar/eventPrint',$datas);

}

public function insert(){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }
// dd($_POST);
    $Event = new Event();
    $Event_emp = new Event_emp();
    $event_fcu = new Event_fcu();
    $Client = new Client();
        // $event_fcu = new Event_fcu();
    $fcu_no = new Fcu_no();
    $aircon = new Aircon();
    
    $client_name = $_POST["client_id"];
    $client_branch = $Client->where('client_id',$client_name)->first();
    
    $weeklyEvent = [];
    $monthlyEvent = [];
    $disableDates = ["01-01","01-02","25-02","09-04","14-04","16-04","01-05","09-05","12-06","29-08","21-08","31-10","01-11","02-11","30-11","08-12","24-12","25-12","30-12","31-12"];
    $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = substr(str_shuffle($set), 0, 6);
    // dd($disableDates);
    if(isset($_POST["title"]))
    {

        if($_POST['repeatable'] == "Weekly"){
            function getWeekly($y) {
                return new \DatePeriod(
                    new \DateTime("first ".date("l", strtotime($_POST['start_event']))." of $y"),
                    \DateInterval::createFromDateString('next '.date("l", strtotime($_POST['start_event']))),
                    new \DateTime("last day of december $y"),
                    
                );
            }

                // Usage:
            foreach (getWeekly(date("Y",strtotime($_POST['start_event']))) as $getw) {
                array_push($weeklyEvent, $getw->format("Y-m-d"));
            }

            // REPEAT WEEKLY ------------------------------------------------------------------------------------------
            
            
            for ($i=0; $i < count($weeklyEvent); $i++) { 
                $formatWeekly = explode("-",$weeklyEvent[$i]);
                $currDate = $formatWeekly[2]."-".$formatWeekly[1];
                $counter = 0;
                for ($a=0; $a < count($disableDates); $a++) { 
                    if ($currDate == $disableDates[$a]) {
                        $counter = 1;
                    }
                    
                }
                    // dd($counter);
                if($counter == 0){
                    $_POST['start_event'] = $weeklyEvent[$i];

                    $_POST["title"] = date("g:ia",strtotime($_POST["time"]))." ".$client_branch['client_branch'];

                    $success = $Event->insert($_POST);
                    if($success){
                        $event_code = ['event_code' => 'task-'.$code.'-'.(int)$success];

                        $Event->update((int)$success,$event_code);
                    }
                    foreach($_POST['emp_id'] as $key => $value) {
                        $Event_emp->insert([
                            'emp_id'=> (int) $value,
                            'id' => (int) $success
                        ]);
                    }

                    foreach ($_POST['aircon_id'] as $index => $aircon) {
                        foreach ($_POST['fcuno'.$index] as $key => $floor_num) {
                            $event_fcu->insert([
                                'id'=> (int) $success,
                                'aircon_id'=> (int)$aircon,
                                'quantity'=> (int)$_POST['quantity'][$index],
                                'fcuno'=>$floor_num
                            ]);

                        }

                    }
                }

            }
                // dd($i);
        } else if($_POST['repeatable'] == "Monthly"){
            function getMonthly($y) {
                return new \DatePeriod(
                    new \DateTime(date("Y-m-d", strtotime($_POST['start_event']))),
                    \DateInterval::createFromDateString('next month'),
                    new \DateTime("last day of december $y"),

                );
            }

                    // Usage:
            foreach (getMonthly(date("Y",strtotime($_POST['start_event']))) as $getm) {
                array_push($monthlyEvent, $getm->format("Y-m-d"));
            }
        // REPEAT MONTHLY ------------------------------------------------------------------------------------------
            for ($i=0; $i < count($monthlyEvent); $i++) { 
                $formatMonthly = explode("-",$monthlyEvent[$i]);
                $currDate = $formatMonthly[2]."-".$formatMonthly[1];
                $counter = 0;
                $date1 = strtotime($monthlyEvent[$i]);
                $date2 = date("l", $date1);
                $date3 = strtolower($date2);
                for ($a=0; $a < count($disableDates); $a++) { 
                    if (($currDate == $disableDates[$a]) || ($date3 == "saturday" )|| ($date3 == "sunday")) {
                        $counter = 1;
                    }
                    
                }
                if($counter == 0){
                    $_POST['start_event'] = $monthlyEvent[$i];
                    $_POST["title"] = date("g:ia",strtotime($_POST["time"]))." ".$client_branch['client_branch'];
                    $success = $Event->insert($_POST);
                    if($success){
                        $event_code = ['event_code' => 'task-'.$code.'-'.(int)$success];

                        $Event->update((int)$success,$event_code);
                    }
                    foreach($_POST['emp_id'] as $key => $value) {
                        $Event_emp->insert([
                            'emp_id'=> (int) $value,
                            'id' => (int) $success
                        ]);
                    }
                    foreach ($_POST['aircon_id'] as $index => $aircon) {
                        foreach ($_POST['fcuno'.$index] as $key => $floor_num) {
                         $event_fcu->insert([
                            'id'=> (int) $success,
                            'aircon_id'=> (int)$aircon,
                            'quantity'=> (int)$_POST['quantity'][$index],
                            'fcuno'=>$floor_num
                        ]);

                     }

                 }
             }
         }

     }

     else{
    // NO REPEAT ------------------------------------------------------------------------------------------
        $_POST["title"] = date("g:ia",strtotime($_POST["time"]))." ".$client_branch['client_branch'];
    // $_POST["cl_id"]= 0;
    // dd($_POST);
        $success = $Event->insert($_POST);

        if($success){
            $event_code = ['event_code' => 'task-'.$code.'-'.(int)$success];

            $Event->update((int)$success,$event_code);
        }

        foreach($_POST['emp_id'] as $key => $value) {
            $Event_emp->insert([
                'emp_id'=> (int) $value,
                'id' => (int) $success
            ]);
        }
    // dd($_POST);
        foreach ($_POST['aircon_id'] as $index => $aircon) {
            foreach ($_POST['fcuno'.$index] as $key => $floor_num) {
             $event_fcu->insert([
                'id'=> (int) $success,
                'aircon_id'=> (int)$aircon,
                'quantity'=> (int)$_POST['quantity'][$index],
                'fcuno'=>$floor_num
            ]);

         }

     }

 }            

            // $eId = (int)$success;

        // return $this->response->redirect(site_url('/calendar/add-aircon/'.$eId));
 return $this->response->redirect(site_url('/calendar'));

}

return json_encode(["error"=>"error"],412);
}


// insert to Calendar from call logs
public function insertCal(){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }
    // dd($_POST);
    $Event = new Event();
    $Event_emp = new Event_emp();
    $event_fcu = new Event_fcu();
    $Client = new Client();
        // $event_fcu = new Event_fcu();
    $fcu_no = new Fcu_no();
    $aircon = new Aircon();
    $Call_logs = new Call_logs();
    $Call_fcu = new Call_fcu();
    
    $client_name = $_POST["client_id_modal"];
    $client_branch = $Client->where('client_id',$client_name)->first();
    
    $weeklyEvent = [];
    $monthlyEvent = [];
    $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = substr(str_shuffle($set), 0, 6);
    // dd($_POST);
    if(isset($_POST["title"]))
    {


        $start_date = explode('/',$_POST['date']);

    // Call_logs
    // $start_date = explode('/',$_POST['date']);
        $codeC = substr(str_shuffle($set), 0, 4);
        $calllog_create = [
            'date' => $start_date[2].'-'.$start_date[0].'-'.$start_date[1],
            'area' => $this->request->getVar('area'),
            'client_id' => $this->request->getVar('client_id_modal'),
            'caller' => $this->request->getVar('caller'),
            'particulars' => $this->request->getVar('particulars'),
            'device_brand' => $this->request->getVar('device_brand'),
            'aircon_id' => $this->request->getVar('aircon_id_modal'),
            'qty' => $this->request->getVar('quantity'),
        // 'status' => $this->request->getVar('status')
        ];

        $successC = $Call_logs->insert($calllog_create);
        $log_code = ['log_code' => 'log-'.$codeC.'-'.(int)$successC];
        if($successC){


            $Call_logs->update((int)$successC,$log_code);
        }
// 


        $success = $Event->insert([
            'title' => date("g:ia",strtotime($_POST["time"]))." ".$client_branch['client_branch'],
            'log_code' => $log_code,
            'start_event' => $start_date[2].'-'.$start_date[0].'-'.$start_date[1],
            'time' => $_POST['time'],
            'client_id' => $_POST['client_id_modal'],
            'serv_id' => $_POST['serv_id'],

        ]);

        if($success){
            $event_code = ['event_code' => 'task-'.$code.'-'.(int)$success];
            $Event->update((int)$success,$event_code);

            $update_set = ['set_status' => 1];
            $Call_logs->update((int)$successC,$update_set);
        }

        foreach($_POST['emp_id'] as $key => $value) {
            $Event_emp->insert([
                'emp_id'=> (int) $value,
                'id' => (int) $success
            ]);
        }
    // dd($_POST);

        foreach ($_POST['fcuno'] as $key => $floor_num) {
            $Call_fcu->insert([
                'fcuno'=>(int) $floor_num,
                'cl_id' => (int) $successC
            ]);
            $event_fcu->insert([
                'id'=> (int) $success,
                'aircon_id'=> (int) $_POST['aircon_id_modal'],
                'quantity'=> (int)$_POST['quantity'],
                'fcuno'=>$floor_num
            ]);



        }

            // $eId = (int)$success;

        // return $this->response->redirect(site_url('/calendar/add-aircon/'.$eId));
        return $this->response->redirect(site_url('/calendar'));

    }

    return json_encode(["error"=>"error"],412);
}


//set call logs to calendar

public function setCal(){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }
    // dd($_POST);
    $fcu_data = implode(",",$_POST['fcu']);
    $fcu_array= explode(",",$fcu_data);
    $Event = new Event();
    $Event_emp = new Event_emp();
    $event_fcu = new Event_fcu();
    $Client = new Client();
        // $event_fcu = new Event_fcu();
    $fcu_no = new Fcu_no();
    $aircon = new Aircon();
    $Call_logs = new Call_logs();
    $Call_fcu = new Call_fcu();
    
    $client_name = $_POST["client_id_modal"];
    $client_branch = $Client->where('client_id',$client_name)->first();
    
    $weeklyEvent = [];
    $monthlyEvent = [];
    $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = substr(str_shuffle($set), 0, 6);
    // dd($_POST);
    if(isset($_POST["title"]))
    {

    // $start_date = explode('/',$_POST['date']);

        $success = $Event->insert([
            'title' => date("g:ia",strtotime($_POST["time"]))." ".$client_branch['client_branch'],
            'log_code' => $_POST['log_code'],
            'start_event' => $_POST['date'],
            'time' => $_POST['time'],
            'client_id' => $_POST['client_id_modal'],
            'serv_id' => $_POST['serv_id'],

        ]);

        if($success){
            $event_code = ['event_code' => 'task-'.$code.'-'.(int)$success];
            $Event->update((int)$success,$event_code);

            $update_set = ['set_status' => 1];
            $Call_logs->update((int)$_POST['cl_id'],$update_set);
        }

        foreach($_POST['emp_id'] as $key => $value) {
            $Event_emp->insert([
                'emp_id'=> (int) $value,
                'id' => (int) $success
            ]);
        }
    // dd($_POST);

        foreach ($fcu_array as $key => $floor_num) {

         $event_fcu->insert([
            'id'=> (int) $success,
            'aircon_id'=> (int) $_POST['aircon_id_modal'],
            'quantity'=> (int)$_POST['quantity'],
            'fcuno'=>$floor_num
        ]);



     }

            // $eId = (int)$success;

        // return $this->response->redirect(site_url('/calendar/add-aircon/'.$eId));
     return $this->response->redirect(site_url('/calendar'));

 }

 return json_encode(["error"=>"error"],412);
}


//set appointment to calendar
public function insertAppt(){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }
    // dd($_POST);
    $fcu_data = implode(",",$_POST['fcu']);
    // dd($fcu_data );
    $fcu_array= explode(",",$fcu_data);
    $Event = new Event();
    $User_bdo = new User_bdo();
    $Event_emp = new Event_emp();
    $event_fcu = new Event_fcu();
    $Client = new Client();
        // $event_fcu = new Event_fcu();
    $fcu_no = new Fcu_no();
    $aircon = new Aircon();
    $Call_logs = new Call_logs();
    $Call_fcu = new Call_fcu();
    $Appoint = new Appointment();
    $user_id = $_POST["user_id"];
    $client_name = $_POST["client_id_modal"];
    $client_branch = $Client->where('client_id',$client_name)->first();
    $user_data = $User_bdo->where('bdo_id',$user_id)->first();
    // dd();

    $user_email = $user_data['bdo_email'];
    $user = $user_data['bdo_lname'];
    $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = substr(str_shuffle($set), 0, 6);

    if(isset($_POST["title"]))
    {

        $success = $Event->insert([
            'title' => date("g:ia",strtotime($_POST["time"]))." ".$client_branch['client_branch'],
            // 'log_code' => $log_code,
            'start_event' => $_POST['date'],
            'appt_code' => $_POST['appt_code'],
            'time' => $_POST['time'],
            'client_id' => $_POST['client_id_modal'],
            'serv_id' => $_POST['serv_id_modal'],

        ]);
        
        if($success){
            $event_code = ['event_code' => 'task-'.$code.'-'.(int)$success];
            $Event->update((int)$success,$event_code);

            $update_set = ['set_status' => 1];
            $Appoint->update((int)$_POST['appt_id'],$update_set);
        }

        foreach($_POST['emp_id'] as $key => $value) {
            $Event_emp->insert([
                'emp_id'=> (int) $value,
                'id' => (int) $success
            ]);
        }


        foreach ( $fcu_array as $key => $floor_num) {
            $event_fcu->insert([
                'id'=> (int) $success,
                'aircon_id'=> (int) $_POST['aircon_id_modal'],
                'quantity'=> (int)$_POST['quantity'],
                'fcuno'=>$floor_num
            ]);
        }



        $to = $user_email;

        $subject = "TSMS - Appointment Scheduled";
        $message = "<html>
        <head>
        <title>Appointment ".$_POST['appt_code']."</title>
        </head>
        <body>
        <h6>Dear, Mr/Ms. ".$user."</h6>
        <p>Your Appointment ".$_POST['appt_code']." has been scheduled on ". $_POST['date'] .", please make sure you are available on the said date. Thank You and have a great day!</p>
        </body>
        </html>";
        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom('Maylaflor@gmail.com','Maylaflor TSMS');
        $email->setSubject($subject);
        $email->setMessage($message);

        if ($email->send()) {
            echo "Success";
        }else{
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }

    }


    return $this->response->redirect(site_url('/calendar'));
}

public function update(){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }
        // dd($this->request->getVar('emp_id_update'));
    // dd($_POST);

    $Event = new Event();
    $Client = new Client();
    $Event_emp = new Event_emp();
    $Event_fcu = new Event_fcu();
    $event_id = $this->request->getVar('id');
    $client_name = $this->request->getVar('client_id_update');

    $client_branch = $Client->where('client_id',$client_name)->first();
    $start_date = explode('/',$this->request->getVar('start_event_update'));

    $event_update = [
        'start_event' => $start_date[2].'-'.$start_date[0].'-'.$start_date[1],
        'title' => date("g:ia",strtotime($this->request->getVar('time_update')))." ".$client_branch['client_branch'],
        'time' => $this->request->getVar('time_update'),
            // 'aircon_id' => (int)($this->request->getVar('aircon_id_update')),
        'client_id'  => (int)($this->request->getVar('client_id_update')),
            // 'fcuno' => (int)($this->request->getVar('fcuno_update')),
        'serv_id' => (int)($this->request->getVar('serv_id_update')),
        
        
            // 'quantity' => $this->request->getVar('quantity_update'),
    ];

    $Event->update($event_id,$event_update);
    $Event_emp->where('id', $event_id)->delete();


    if (isset($_POST['emp_id_update'])) {
        foreach($_POST['emp_id_update'] as $key => $value) {
            $Event_emp->insert([
                'emp_id'=> (int) $value,
                'id' => $event_id
            ]);
        }
    }

    $Event_fcu->where('id', $event_id)->delete();

    foreach ($_POST['aircon_update_id'] as $index => $aircon) {
        foreach ($_POST['fcuno_update_'.$aircon] as $key => $floor_num) {
         $Event_fcu->insert([
            'id'=> (int) $event_id,
            'aircon_id'=> (int)$aircon,
            'quantity'=> (int)$_POST['quantity'][$index],
            'fcuno'=>$floor_num
        ]);


     }

 }



 return $this->response->redirect(site_url('/calendar'));

 return json_encode(["error"=>"error"],412);
}
public function delete($id){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }
    $Event = new Event();
    $Appoint = new Appointment();
    $Call_logs = new Call_logs();
    $event_data = $Event->where('id', $id)->first();
    $appt_code = $event_data['appt_code'];
    $log_code = $event_data['log_code'];
    $appt_data = $Appoint->where('appt_code',$appt_code)->first();
    $cl_data = $Call_logs->where('log_code',$log_code)->first();
    
    
    if($appt_code){
        $update_status = ['set_status' => 0];
        $Appoint->update($appt_data['appt_id'],$update_status);
        // dd();
    }
    if($log_code){
        $update_status = ['set_status' => 0];
        $Call_logs->update($cl_data['cl_id'],$update_status);
        // dd($cl_data);
    }
    $success = $Event->where('id', $id)->delete($id);
    // if ($success) {
    //     // code...
    // }

    $session = session();
    $session->setFlashdata('msg', 'value');
    return $this->response->redirect(site_url('/calendar/events'));
}

public function load(){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }
    $event = new Event();

    $event->orderBy('id', 'ASC')->findAll();

    if ($event) {
        return json_encode(["data"=>$event],200);
    }
}

public function daily(){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }

    date_default_timezone_set('Asia/Hong_Kong'); 

    $date = new \DateTime();
    $date->setTimezone(new \DateTimeZone('+0800'));

    $event = new All_events();
        // $emp = new Emp();
    $client = new Client();
    $serv = new Serv();
    $event_emp = new Event_emp_views();
    $event_fcu = new Event_fcu_views();
    // $aircon = new Aircon();

    $db = \Config\Database::connect();
    $query   = $db->query('SELECT DISTINCT aircon_id,id,device_brand,aircon_type,quantity
        FROM event_fcu_views');
    $datas['distinct'] = $query->getResult();

    $db1 = \Config\Database::connect();
    $query   = $db1->query('SELECT DISTINCT id
        FROM event_fcu_views');
    $datas['distinct_event'] = $query->getResult();

    $datas['day'] = array();
    $datas['client'] = $client->orderBy('client_id', 'ASC')->findAll();
        // $datas['emp'] = $emp->orderBy('emp_id', 'ASC')->findAll();
    $datas['serv'] = $serv->orderBy('serv_id', 'ASC')->findAll();
    $datas['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
    $datas['event_fcu'] = $event_fcu->orderBy('id', 'ASC')->orderBy('fcuno', 'ASC')->findAll();
    // $datas['aircon'] = $aircon->orderBy('aircon_id', 'ASC')->findAll();
    $datas['today'] = $event->where('start_event', date('Y-m-d'))->findAll();
        // dd($data[0]['title']);
    foreach ($datas['today'] as $key => $value) {

        $emp_arr = "";
        foreach ($datas['event_emp'] as $key => $value_emps) {
            if ( $value['id'] == $value_emps['id']) {
               $emp_arr .= $datas['event_emp'][$key]['emp_name'].",";
           }
       }
       $fcu_arr = array();

       // dd($datas['event_fcu']);
       foreach ($datas['event_fcu'] as $key => $value_fcu) {
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
       $datas['day'][]= (object)[
          "id"=> $value['id'],
          "title"=>$value['title'],
          "event_code"=>$value['event_code'],
          "start_event"=> $value['start_event'],
          "time"=> $value['TIME'],
          "serv_id"=> $value['serv_id'],
          "client_id"=>$value['client_id'],
//   "aircon_array"=>$aircon_arr,
          "serv_name"=>$value['serv_name'],
          "serv_type"=>$value['serv_type'],
//   "device_array"=> $device_arr,
//   "quantity_array"=> $quantity_arr,
          "area"=> $value['area'],
          "emp_array"=> $emp_arr,
          "fcu_array"=> $fcu_arr,
          "client_branch"=> $value['client_branch'],
          "status"=> $value['STATUS'],
      ];
  }
  $datas['main'] = 'admin/calendar/today';
  return view("templates/template",$datas);
}
public function printDaily(){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }

    date_default_timezone_set('Asia/Hong_Kong'); 

    $date = new \DateTime();
    $date->setTimezone(new \DateTimeZone('+0800'));

    $event = new All_events();
        // $emp = new Emp();
    $client = new Client();
    $serv = new Serv();
    $event_emp = new Event_emp_views();
    $event_fcu = new Event_fcu_views();
    
    $db = \Config\Database::connect();
    $query   = $db->query('SELECT DISTINCT aircon_id,id,device_brand,aircon_type,quantity
        FROM event_fcu_views');
    $datas['distinct'] = $query->getResult();

    $db1 = \Config\Database::connect();
    $query   = $db1->query('SELECT DISTINCT id
        FROM event_fcu_views');
    $datas['distinct_event'] = $query->getResult();


    $datas['day'] = array();
    $datas['client'] = $client->orderBy('client_id', 'ASC')->findAll();
        // $datas['emp'] = $emp->orderBy('emp_id', 'ASC')->findAll();
    $datas['serv'] = $serv->orderBy('serv_id', 'ASC')->findAll();
    $datas['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
    $datas['event_fcu'] = $event_fcu->orderBy('id', 'ASC')->orderBy('fcuno', 'ASC')->findAll();

    $datas['today'] = $event->where('start_event', date('Y-m-d'))->findAll();
        // dd($data[0]['title']);
    foreach ($datas['today'] as $key => $value) {

        $emp_arr = "";
        foreach ($datas['event_emp'] as $key => $value_emps) {
            if ( $value['id'] == $value_emps['id']) {
               $emp_arr .= $datas['event_emp'][$key]['emp_name'].",";
           }
       }
       $fcu_arr = array();

         // dd($datas['event_fcu']);
       foreach ($datas['event_fcu'] as $key => $value_fcu) {
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
     $datas['day'][]= (object)[
      "id"=> $value['id'],
      "title"=>$value['title'],
      "event_code"=>$value['event_code'],
      "start_event"=> $value['start_event'],
      "time"=> $value['TIME'],
      "serv_id"=> $value['serv_id'],
      "client_id"=>$value['client_id'],
//   "aircon_array"=>$aircon_arr,
      "serv_name"=>$value['serv_name'],
      "serv_type"=>$value['serv_type'],
//   "device_array"=> $device_arr,
//   "quantity_array"=> $quantity_arr,
      "area"=> $value['area'],
      "emp_array"=> $emp_arr,
      "fcu_array"=> $fcu_arr,
      "client_branch"=> $value['client_branch'],
      "status"=> $value['STATUS'],
  ];
}

return view("admin/calendar/dailyPrint",$datas);
}
public function weekly(){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }
    $event = new All_events();
        // $emp = new Emp();
    // $client = new Client();
    // $serv = new Serv();
    $event_emp = new Event_emp_views();
    $event_fcu = new Event_fcu_views();

    $db = \Config\Database::connect();
    $query   = $db->query('SELECT DISTINCT aircon_id,id,device_brand,aircon_type,quantity
        FROM event_fcu_views');
    $datas['distinct'] = $query->getResult();

    $db1 = \Config\Database::connect();
    $query   = $db1->query('SELECT DISTINCT id
        FROM event_fcu_views');
    $datas['distinct_event'] = $query->getResult();

    $monday = date('Y-m-d', strtotime('monday this week'));
    $sunday = date('Y-m-d', strtotime('sunday this week'));

    $datas['week'] = array();
    // $datas['client'] = $client->orderBy('client_id', 'ASC')->findAll();
        // $datas['emp'] = $emp->orderBy('emp_id', 'ASC')->findAll();
    // $datas['serv'] = $serv->orderBy('serv_id', 'ASC')->findAll();
    $datas['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
    $datas['event_fcu'] = $event_fcu->orderBy('id', 'ASC')->orderBy('fcuno', 'ASC')->findAll();

    $datas['weekly'] = $event->where('start_event BETWEEN "'. date('Y-m-d', strtotime($monday)). '" and "'. date('Y-m-d', strtotime($sunday)).'"ORDER BY start_event ASC')->findAll();
        // dd($datas['weekly']);
    foreach ($datas['weekly'] as $key => $value) {

        $emp_arr = "";
        foreach ($datas['event_emp'] as $key => $value_emps) {
            if ( $value['id'] == $value_emps['id']) {
               $emp_arr .= $datas['event_emp'][$key]['emp_name'].",";
           }
       }
       $fcu_arr = array();

    //  dd($datas['event_fcu']);
       foreach ($datas['event_fcu'] as $key => $value_fcu) {
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
     $datas['week'][]= (object)[
      "id"=> $value['id'],
      "title"=>$value['title'],
      "event_code"=>$value['event_code'],
      "start_event"=> $value['start_event'],
      "time"=> $value['TIME'],
      "serv_id"=> $value['serv_id'],
      "client_id"=>$value['client_id'],
//   "aircon_array"=>$aircon_arr,
      "serv_name"=>$value['serv_name'],
      "serv_type"=>$value['serv_type'],
//   "device_array"=> $device_arr,
//   "quantity_array"=> $quantity_arr,
      "area"=> $value['area'],
      "emp_array"=> $emp_arr,
      "fcu_array"=> $fcu_arr,
      "client_branch"=> $value['client_branch'],
      "status"=> $value['STATUS'],
  ];
}
// dd($datas['week']);
$datas['main'] = 'admin/calendar/week';
return view("templates/template",$datas);
}
public function printWeekly(){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }
    $event = new All_events();
        // $emp = new Emp();
    // $client = new Client();
    // $serv = new Serv();
    $event_emp = new Event_emp_views();
    $event_fcu = new Event_fcu_views();
    // $aircon = new Aircon();
    $db = \Config\Database::connect();
    $query   = $db->query('SELECT DISTINCT aircon_id,id,device_brand,aircon_type,quantity
        FROM event_fcu_views');
    $datas['distinct'] = $query->getResult();

    $db1 = \Config\Database::connect();
    $query   = $db1->query('SELECT DISTINCT id
        FROM event_fcu_views');
    $datas['distinct_event'] = $query->getResult();

    $monday = date('Y-m-d', strtotime('monday this week'));
    $sunday = date('Y-m-d', strtotime('sunday this week'));

    $datas['week'] = array();
    // $datas['client'] = $client->orderBy('client_id', 'ASC')->findAll();
        // $datas['emp'] = $emp->orderBy('emp_id', 'ASC')->findAll();
    // $datas['serv'] = $serv->orderBy('serv_id', 'ASC')->findAll();
    $datas['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
    $datas['event_fcu'] = $event_fcu->orderBy('id', 'ASC')->orderBy('fcuno', 'ASC')->findAll();
    // $datas['aircon'] = $aircon->orderBy('aircon_id', 'ASC')->findAll();
    $datas['weekly'] = $event->where('start_event BETWEEN "'. date('Y-m-d', strtotime($monday)). '" and "'. date('Y-m-d', strtotime($sunday)).'"ORDER BY start_event ASC')->findAll();
        // dd($data[0]['title']);
    foreach ($datas['weekly'] as $key => $value) {

        $emp_arr = "";
        foreach ($datas['event_emp'] as $key => $value_emps) {
            if ( $value['id'] == $value_emps['id']) {
               $emp_arr .= $datas['event_emp'][$key]['emp_name'].",";
           }
       }
       $fcu_arr = array();

     // dd($datas['event_fcu']);
       foreach ($datas['event_fcu'] as $key => $value_fcu) {
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
     $datas['week'][]= (object)[
      "id"=> $value['id'],
      "title"=>$value['title'],
      "event_code"=>$value['event_code'],
      "start_event"=> $value['start_event'],
      "time"=> $value['TIME'],
      "serv_id"=> $value['serv_id'],
      "client_id"=>$value['client_id'],
//   "aircon_array"=>$aircon_arr,
      "serv_name"=>$value['serv_name'],
      "serv_type"=>$value['serv_type'],
//   "device_array"=> $device_arr,
//   "quantity_array"=> $quantity_arr,
      "area"=> $value['area'],
      "emp_array"=> $emp_arr,
      "fcu_array"=> $fcu_arr,
      "client_branch"=> $value['client_branch'],
      "status"=> $value['STATUS'],
  ];
}

return view("admin/calendar/weeklyPrint",$datas);
}
public function monthly(){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }
    $event = new All_events();
        // $emp = new Emp();
    // $client = new Client();
    // $serv = new Serv();
    $event_emp = new Event_emp_views();
    $event_fcu = new Event_fcu_views();
    // $aircon = new Aircon();
    $monday = date('Y-m-d', strtotime('monday this week'));
    $sunday = date('Y-m-d', strtotime('sunday this week'));

    $db = \Config\Database::connect();
    $query   = $db->query('SELECT DISTINCT aircon_id,id,device_brand,aircon_type,quantity
        FROM event_fcu_views');
    $datas['distinct'] = $query->getResult();

    $db1 = \Config\Database::connect();
    $query   = $db1->query('SELECT DISTINCT id
        FROM event_fcu_views');
    $datas['distinct_event'] = $query->getResult();

    $datas['month'] = array();
    // $datas['client'] = $client->orderBy('client_id', 'ASC')->findAll();
        // $datas['emp'] = $emp->orderBy('emp_id', 'ASC')->findAll();
    // $datas['serv'] = $serv->orderBy('serv_id', 'ASC')->findAll();
    $datas['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
    $datas['event_fcu'] = $event_fcu->orderBy('id', 'ASC')->orderBy('fcuno', 'ASC')->findAll();
    // $datas['aircon'] = $aircon->orderBy('aircon_id', 'ASC')->findAll();
    $datas['monthly'] = $event->where('MONTH(start_event) = MONTH(CURRENT_DATE()) && YEAR(start_event) = YEAR(CURRENT_DATE()) ORDER BY start_event ASC')->findAll();
        // dd($data[0]['title']);
    foreach ($datas['monthly'] as $key => $value) {

        $emp_arr = "";
        foreach ($datas['event_emp'] as $key => $value_emps) {
            if ( $value['id'] == $value_emps['id']) {
               $emp_arr .= $datas['event_emp'][$key]['emp_name'].",";
           }
       }
       $fcu_arr = array();

     // dd($datas['event_fcu']);
       foreach ($datas['event_fcu'] as $key => $value_fcu) {
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
     $datas['month'][]= (object)[
         "id"=> $value['id'],
         "title"=>$value['title'],
         "start_event"=> $value['start_event'],
         "event_code"=>$value['event_code'],
         "time"=> $value['TIME'],
         "serv_id"=> $value['serv_id'],
         "client_id"=>$value['client_id'],
//   "aircon_array"=>$aircon_arr,
         "serv_name"=>$value['serv_name'],
         "serv_type"=>$value['serv_type'],
//   "device_array"=> $device_arr,
//   "quantity_array"=> $quantity_arr,
         "area"=> $value['area'],
         "emp_array"=> $emp_arr,
         "fcu_array"=> $fcu_arr,
         "client_branch"=> $value['client_branch'],
         "status"=> $value['STATUS'],
     ];
 }
 $datas['main'] = 'admin/calendar/month';
 return view("templates/template",$datas);
}
public function printMonthly(){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }
    $event = new All_events();
        // $emp = new Emp();
    // $client = new Client();
    // $serv = new Serv();
    $event_emp = new Event_emp_views();
    $event_fcu = new Event_fcu_views();
    // $aircon = new Aircon();
    $db = \Config\Database::connect();
    $query   = $db->query('SELECT DISTINCT aircon_id,id,device_brand,aircon_type,quantity
        FROM event_fcu_views');
    $datas['distinct'] = $query->getResult();

    $db1 = \Config\Database::connect();
    $query   = $db1->query('SELECT DISTINCT id
        FROM event_fcu_views');
    $datas['distinct_event'] = $query->getResult();

    $monday = date('Y-m-d', strtotime('monday this week'));
    $sunday = date('Y-m-d', strtotime('sunday this week'));

    $datas['month'] = array();
    // $datas['client'] = $client->orderBy('client_id', 'ASC')->findAll();
        // $datas['emp'] = $emp->orderBy('emp_id', 'ASC')->findAll();
    // $datas['serv'] = $serv->orderBy('serv_id', 'ASC')->findAll();
    $datas['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
    $datas['event_fcu'] = $event_fcu->orderBy('id', 'ASC')->orderBy('fcuno', 'ASC')->findAll();
    // $datas['aircon'] = $aircon->orderBy('aircon_id', 'ASC')->findAll();
    $datas['monthly'] = $event->where('MONTH(start_event) = MONTH(CURRENT_DATE()) && YEAR(start_event) = YEAR(CURRENT_DATE()) ORDER BY start_event ASC')->findAll();
        // dd($data[0]['title']);
    foreach ($datas['monthly'] as $key => $value) {

        $emp_arr = "";
        foreach ($datas['event_emp'] as $key => $value_emps) {
            if ( $value['id'] == $value_emps['id']) {
               $emp_arr .= $datas['event_emp'][$key]['emp_name'].",";
           }
       }
       $fcu_arr = array();

     // dd($datas['event_fcu']);
       foreach ($datas['event_fcu'] as $key => $value_fcu) {
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
     $datas['month'][]= (object)[
         "id"=> $value['id'],
         "title"=>$value['title'],
         "event_code"=>$value['event_code'],
         "start_event"=> $value['start_event'],
         "time"=> $value['TIME'],
         "serv_id"=> $value['serv_id'],
         "client_id"=>$value['client_id'],
//   "aircon_array"=>$aircon_arr,
         "serv_name"=>$value['serv_name'],
         "serv_type"=>$value['serv_type'],
//   "device_array"=> $device_arr,
//   "quantity_array"=> $quantity_arr,
         "area"=> $value['area'],
         "emp_array"=> $emp_arr,
         "fcu_array"=> $fcu_arr,
         "client_branch"=> $value['client_branch'],
         "status"=> $value['STATUS'],
     ];
 }

 return view("admin/calendar/monthlyPrint",$datas);
}

// public function view(){
//     $Event = new Event();
//     $Fcu = new Event_fcu_views();
//     $Client = new Client();
//     $Serv = new Serv();
//     $id = $this->request->getPost('id');
//     $data['event_data'] = $Event->where('id',$id)->first();
//     $data['fcu_data'] = $Fcu->where('id',$id)->findAll();
//     $data['client_data'] = $Client->orderBy('client_id','ASC')->findAll();
//     $data['serv_data'] = $Serv->orderBy('serv_id','ASC')->findAll();

//     $db = \Config\Database::connect();
//           $query   = $db->query('SELECT DISTINCT aircon_id,id,device_brand,aircon_type,quantity
//             FROM event_fcu_views where id = '.$id);
//           $data['distinct'] = $query->getResult();

//     return $this->response->setJSON($data);

// }

public function checkEmp(){
    $Emp = new Emp();
    // $date = $this->request->getPost('start_event');
    $start_date = explode('-',$this->request->getVar('start_event'));
    $date = $start_date[0].'/'.$start_date[1].'/'.$start_date[2];
    $db1 = \Config\Database::connect();
     $query   = $db1->query('SELECT DISTINCT emp_name FROM event_emp_views where start_event = "'.$date.'"');
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

    $data['available_emp'] = $query2->getResult();

    }else{
        $data['available_emp'] = $Emp->orderBy('emp_name','ASC')->findAll();

    }
    return $this->response->setJSON($data);
}
}
?>