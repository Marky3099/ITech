<?php
namespace App\Controllers;
use App\Models\Call_logs;
use CodeIgniter\Controller;
use App\Models\Client;
use App\Models\Aircon;
use App\Models\Calllogs_views;
use App\Models\Fcu_no;
use App\Models\Call_fcu;
use App\Models\Emp;
use App\Models\Serv;
use App\Models\Call_fcu_views;
use App\Models\Event;
use App\Models\Restrict_date;

class CalllogsCrud extends Controller{

	// show Call log list
    public function index(){
        if($_SESSION['position'] != USER_ROLE_ADMIN && $_SESSION['position'] != USER_ROLE_SECRETARY){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Call_logs = new Calllogs_views();
        $Client = new Client();
        $Aircon = new Aircon();
        $fcu_no = new Fcu_no();
        $Call_fcu = new Call_fcu_views();
        $Emp = new Emp();
        $serv = new Serv();

        $data['view_calllogs'] = [];
        $data['cId'] ="";
        $data['cbranch']="";
        $data['now'] = date('Y-m-d');
        $data['client'] = $Client->orderBy('client_id', 'ASC')->findAll();
        $data['area'] = $Client->select('area')->groupBy('area')->findAll();
        $data['call_logs'] = $Call_logs->orderBy('cl_id', 'DESC')->findAll();
        // dd($data['caller']);
        $data['fcu_no'] = $fcu_no->orderBy('fcuno', 'ASC')->findAll();
        $data['call_fcu'] = $Call_fcu->orderBy('cl_id', 'ASC')->findAll();
        $data['emp'] = $Emp->orderBy('emp_id', 'ASC')->findAll();
        $data['serv'] = $serv->orderBy('serv_id', 'ASC')->findAll();
        $data['servName'] = $serv->select('serv_name, serv_color, serv_type')->groupBy('serv_name')->findAll();
        $data['servType'] = $serv->orderBy('serv_name','ASC')->findAll();
        $data['aircon'] = $Aircon->orderBy('aircon_id', 'ASC')->findAll();
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

    foreach ($data['call_logs'] as $key => $value) {
        $fcu_arr = "";
        foreach ($data['call_fcu'] as $key => $value_fcu) {
            if ( $value['cl_id'] == $value_fcu['cl_id']) {
             $fcu_arr .= $data['call_fcu'][$key]['fcu'].",";
         }
     }    
     $data['view_calllogs'][]= (object)[
        "cl_id"=> $value['cl_id'],
        "date"=> $value['date'],
        "log_code"=> $value['log_code'],
        "client_id"=> $value['client_id'],
        "area"=> $value['area'],
        "client_branch"=> $value['client_branch'],
        "serv_id"=> $value['serv_id'],
        "serv_name"=> $value['serv_name'],
        "serv_type"=> $value['serv_type'],
        "time"=> $value['time'],
        "end_time"=> $value['end_time'],
        // "aircon_id"=> $value['aircon_id'],
        // "aircon_type"=> $value['aircon_type'],
        // "device_brand"=> $value['device_brand'],
        // "caller"=> $value['caller'],
        // "particulars"=> $value['particulars'],
        // "qty"=> $value['qty'],
        "status"=> $value['status'],
        // "set_status"=> $value['set_status'],
        "fcu_arr"=> $fcu_arr,
    ];
}

$data['main'] = 'admin/calllogs/call_view';
return view("templates/template",$data);
}
    // add Call log form
public function create(){
    if($_SESSION['position'] != USER_ROLE_ADMIN && $_SESSION['position'] != USER_ROLE_SECRETARY){
            return $this->response->redirect(site_url('/dashboard'));
        }
    $Client = new Client();
    $Aircon = new Aircon();
    $fcu_no = new Fcu_no();
    $resDate = new Restrict_date();
    $emp = new Emp();
    $serv = new Serv();

    $data['fcu_no'] = $fcu_no->orderBy('fcuno', 'ASC')->findAll();
    $data['client'] = $Client->orderBy('client_id', 'ASC')->findAll();
    $data['area'] = $Client->select('area')->groupBy('area')->findAll();
    $data['emp'] = $emp->orderBy('emp_id', 'ASC')->findAll();
    $data['serv'] = $serv->orderBy('serv_id', 'ASC')->findAll();
    $data['servName'] = $serv->select('serv_name, serv_color, serv_type')->groupBy('serv_name')->findAll();
        $data['servType'] = $serv->orderBy('serv_name','ASC')->findAll();
    $data['aircon'] = $Aircon->orderBy('aircon_id', 'ASC')->findAll();
    $data['device_brand'] = $Aircon->select('device_brand')->groupBy('device_brand')->findAll();
    $data['date'] = $resDate->select('date')->findAll();
    // dd($data['date']);
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

$data['main'] = 'admin/calllogs/call_add';
return view("templates/template",$data);
}
public function dailyLogs(){
    if($_SESSION['position'] != USER_ROLE_ADMIN && $_SESSION['position'] != USER_ROLE_SECRETARY){
            return $this->response->redirect(site_url('/dashboard'));
        }

    date_default_timezone_set('Asia/Hong_Kong'); 

    $date = new \DateTime();
    $date->setTimezone(new \DateTimeZone('+0800'));
    $Call_logs = new Calllogs_views();
    $Client = new Client();
    $Aircon = new Aircon();
    $fcu_no = new Fcu_no();
    $Call_fcu = new Call_fcu_views();
    $Emp = new Emp();
    $serv = new Serv();

    $db = \Config\Database::connect();
    $query   = $db->query('SELECT DISTINCT aircon_id,cl_id,device_brand,aircon_type,qty
        FROM call_fcu_views');
    $data['distinct'] = $query->getResult();

    $db1 = \Config\Database::connect();
    $query   = $db1->query('SELECT DISTINCT cl_id
        FROM call_fcu_views');
    $data['distinct_event'] = $query->getResult();

    $data['view_calllogs'] = [];
    $data['areas'] = array();
    $data['cBranch']="";
    $data['now'] = date('Y-m-d');
    $data['client'] = $Client->orderBy('client_id', 'ASC')->findAll();
    $data['area'] = $Client->select('area')->groupBy('area')->findAll();
    // $data['caller'] = $Call_logs->select('caller')->groupBy('caller', 'asc')->findAll();
    // dd($data['caller']);
    $data['fcu_no'] = $fcu_no->orderBy('fcuno', 'ASC')->findAll();
    $data['call_fcu'] = $Call_fcu->orderBy('cl_id', 'ASC')->findAll();
    $data['emp'] = $Emp->orderBy('emp_id', 'ASC')->findAll();
    $data['serv'] = $serv->orderBy('serv_id', 'ASC')->findAll();
    $data['servName'] = $serv->select('serv_name, serv_color, serv_type')->groupBy('serv_name')->findAll();
    $data['servType'] = $serv->orderBy('serv_name','ASC')->findAll();
    $data['aircon'] = $Aircon->orderBy('aircon_id', 'ASC')->findAll();
    $data['device_brand'] = $Aircon->select('device_brand')->groupBy('device_brand')->findAll();
    if($this->request->getVar('filter_client')){
        $cBranch = $this->request->getVar('filter_client');
        // $url = $this->request->getVar('url');
        $data['call_logs'] = $Call_logs->where('date', date('Y-m-d'))->where('client_id',$cBranch)->orderBy('date', 'ASC')->findAll();
        if(count($data['call_logs'])>0){
            $data['cBranch'] = $data['call_logs'][0]['client_branch'];
        }
    }else{
        $data['call_logs'] = $Call_logs->where('date', date('Y-m-d'))->findAll();
    }

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

foreach ($data['call_logs'] as $key => $value) {
    array_push($data['areas'],$value['area']);
    $fcu_arr =array();
    foreach ($data['call_fcu'] as $key => $value_fcu) {
        if ( $value['cl_id'] == $value_fcu['cl_id']) {
         array_push($fcu_arr , (object)[
                'cl_id' => (int)$value_fcu['cl_id'],
                'aircon_id' => (int)$value_fcu['aircon_id'],
                'fcuno' =>(int)$value_fcu['fcuno'],
                'qty' =>(int)$value_fcu['qty'],
                'device_brand' =>$value_fcu['device_brand'],
                'aircon_type' =>$value_fcu['aircon_type'],
                'fcu' =>$value_fcu['fcu'],
            ]);
     }
 }    
 $data['view_calllogs'][]= (object)[
    "cl_id"=> $value['cl_id'],
        "date"=> $value['date'],
        "log_code"=> $value['log_code'],
        "client_id"=> $value['client_id'],
        "area"=> $value['area'],
        "client_branch"=> $value['client_branch'],
        "serv_id"=> $value['serv_id'],
        "serv_name"=> $value['serv_name'],
        "serv_type"=> $value['serv_type'],
        "time"=> $value['time'],
        "end_time"=> $value['end_time'],
        // "aircon_id"=> $value['aircon_id'],
        // "aircon_type"=> $value['aircon_type'],
        // "device_brand"=> $value['device_brand'],
        // "caller"=> $value['caller'],
        // "particulars"=> $value['particulars'],
        // "qty"=> $value['qty'],
        "status"=> $value['status'],
        // "set_status"=> $value['set_status'],
        "fcu_arr"=> $fcu_arr,
];
}
if($this->request->getVar('print')){
    $data['uniq_area'] = array_unique($data['areas']);
    return view('admin/calllogs/logDailyPrint',$data);
}else{
    $data['main'] = 'admin/calllogs/call_view';
    return view("templates/template",$data);
}

}
public function WeeklyLogs(){
    if($_SESSION['position'] != USER_ROLE_ADMIN && $_SESSION['position'] != USER_ROLE_SECRETARY){
            return $this->response->redirect(site_url('/dashboard'));
        }

    date_default_timezone_set('Asia/Hong_Kong'); 

    $date = new \DateTime();
    $date->setTimezone(new \DateTimeZone('+0800'));
    $Call_logs = new Calllogs_views();
    $Client = new Client();
    $Aircon = new Aircon();
    $fcu_no = new Fcu_no();
    $Call_fcu = new Call_fcu_views();
    $Emp = new Emp();
    $serv = new Serv();

    $db = \Config\Database::connect();
    $query   = $db->query('SELECT DISTINCT aircon_id,cl_id,device_brand,aircon_type,qty
        FROM call_fcu_views');
    $data['distinct'] = $query->getResult();

    $db1 = \Config\Database::connect();
    $query   = $db1->query('SELECT DISTINCT cl_id
        FROM call_fcu_views');
    $data['distinct_event'] = $query->getResult();

    $monday = date('Y-m-d', strtotime('monday this week'));
    $sunday = date('Y-m-d', strtotime('sunday this week'));
    $data['view_calllogs'] = [];
    $data['areas'] = array();
    $data['cBranch']="";
    $data['now'] = date('Y-m-d');
    $data['client'] = $Client->orderBy('client_id', 'ASC')->findAll();
    $data['area'] = $Client->select('area')->groupBy('area')->findAll();
    // dd($data['caller']);
    $data['fcu_no'] = $fcu_no->orderBy('fcuno', 'ASC')->findAll();
    $data['call_fcu'] = $Call_fcu->orderBy('cl_id', 'ASC')->findAll();
    $data['emp'] = $Emp->orderBy('emp_id', 'ASC')->findAll();
    $data['serv'] = $serv->orderBy('serv_id', 'ASC')->findAll();
    $data['servName'] = $serv->select('serv_name, serv_color, serv_type')->groupBy('serv_name')->findAll();
    $data['servType'] = $serv->orderBy('serv_name','ASC')->findAll();
    $data['aircon'] = $Aircon->orderBy('aircon_id', 'ASC')->findAll();
    $data['device_brand'] = $Aircon->select('device_brand')->groupBy('device_brand')->findAll();
    if($this->request->getVar('filter_client')){
        $cBranch = $this->request->getVar('filter_client');
        // $url = $this->request->getVar('url');
        $data['call_logs'] = $Call_logs->where('date BETWEEN "'. date('Y-m-d', strtotime($monday)). '" and "'. date('Y-m-d', strtotime($sunday)).'"')->where('client_id',$cBranch)->orderBy('date', 'ASC')->findAll();
        if(count($data['call_logs'])>0){
            $data['cBranch'] = $data['call_logs'][0]['client_branch'];
        }
    }else{
        $data['call_logs'] = $Call_logs->where('date BETWEEN "'. date('Y-m-d', strtotime($monday)). '" and "'. date('Y-m-d', strtotime($sunday)).'"')->findAll();
    }

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

foreach ($data['call_logs'] as $key => $value) {
    array_push($data['areas'],$value['area']);
    $fcu_arr =array();
    foreach ($data['call_fcu'] as $key => $value_fcu) {
        if ( $value['cl_id'] == $value_fcu['cl_id']) {
         array_push($fcu_arr , (object)[
                'cl_id' => (int)$value_fcu['cl_id'],
                'aircon_id' => (int)$value_fcu['aircon_id'],
                'fcuno' =>(int)$value_fcu['fcuno'],
                'qty' =>(int)$value_fcu['qty'],
                'device_brand' =>$value_fcu['device_brand'],
                'aircon_type' =>$value_fcu['aircon_type'],
                'fcu' =>$value_fcu['fcu'],
            ]);
     }
 }    
 $data['view_calllogs'][]= (object)[
    "cl_id"=> $value['cl_id'],
        "date"=> $value['date'],
        "log_code"=> $value['log_code'],
        "client_id"=> $value['client_id'],
        "area"=> $value['area'],
        "client_branch"=> $value['client_branch'],
        "serv_id"=> $value['serv_id'],
        "serv_name"=> $value['serv_name'],
        "serv_type"=> $value['serv_type'],
        "time"=> $value['time'],
        "end_time"=> $value['end_time'],
        // "aircon_id"=> $value['aircon_id'],
        // "aircon_type"=> $value['aircon_type'],
        // "device_brand"=> $value['device_brand'],
        // "caller"=> $value['caller'],
        // "particulars"=> $value['particulars'],
        // "qty"=> $value['qty'],
        "status"=> $value['status'],
        // "set_status"=> $value['set_status'],
        "fcu_arr"=> $fcu_arr,
];
}
if($this->request->getVar('print')){
    $data['uniq_area'] = array_unique($data['areas']);
    return view('admin/calllogs/logWeeklyPrint',$data);
}else{
    $data['main'] = 'admin/calllogs/call_view';
    return view("templates/template",$data);
}

}
public function monthlyLogs(){
    if($_SESSION['position'] != USER_ROLE_ADMIN && $_SESSION['position'] != USER_ROLE_SECRETARY){
            return $this->response->redirect(site_url('/dashboard'));
        }

    date_default_timezone_set('Asia/Hong_Kong'); 

    $date = new \DateTime();
    $date->setTimezone(new \DateTimeZone('+0800'));
    $Call_logs = new Calllogs_views();
    $Client = new Client();
    $Aircon = new Aircon();
    $fcu_no = new Fcu_no();
    $Call_fcu = new Call_fcu_views();
    $Emp = new Emp();
    $serv = new Serv();

    $db = \Config\Database::connect();
    $query   = $db->query('SELECT DISTINCT aircon_id,cl_id,device_brand,aircon_type,qty
        FROM call_fcu_views');
    $data['distinct'] = $query->getResult();

    $db1 = \Config\Database::connect();
    $query   = $db1->query('SELECT DISTINCT cl_id
        FROM call_fcu_views');
    $data['distinct_event'] = $query->getResult();

    $data['view_calllogs'] = [];
    $data['areas'] = array();
    $data['cBranch']="";
    $data['now'] = date('Y-m-d');
    $data['client'] = $Client->orderBy('client_id', 'ASC')->findAll();
    $data['area'] = $Client->select('area')->groupBy('area')->findAll();
    // dd($data['caller']);
    $data['fcu_no'] = $fcu_no->orderBy('fcuno', 'ASC')->findAll();
    $data['call_fcu'] = $Call_fcu->orderBy('cl_id', 'ASC')->findAll();
    $data['emp'] = $Emp->orderBy('emp_id', 'ASC')->findAll();
    $data['serv'] = $serv->orderBy('serv_id', 'ASC')->findAll();
    $data['servName'] = $serv->select('serv_name, serv_color, serv_type')->groupBy('serv_name')->findAll();
    $data['servType'] = $serv->orderBy('serv_name','ASC')->findAll();
    $data['aircon'] = $Aircon->orderBy('aircon_id', 'ASC')->findAll();
    $data['device_brand'] = $Aircon->select('device_brand')->groupBy('device_brand')->findAll();
    if($this->request->getVar('filter_client')){
        $cBranch = $this->request->getVar('filter_client');
        // $url = $this->request->getVar('url');
        $data['call_logs'] = $Call_logs->where('MONTH(date) = MONTH(CURRENT_DATE()) && YEAR(date) = YEAR(CURRENT_DATE())')->where('client_id',$cBranch)->orderBy('date', 'ASC')->findAll();
        if(count($data['call_logs'])>0){
            $data['cBranch'] = $data['call_logs'][0]['client_branch'];
        }
    }else{
        $data['call_logs'] = $Call_logs->where('MONTH(date) = MONTH(CURRENT_DATE()) && YEAR(date) = YEAR(CURRENT_DATE())')->findAll();
    }

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

foreach ($data['call_logs'] as $key => $value) {
    array_push($data['areas'],$value['area']);
    $fcu_arr =array();
    foreach ($data['call_fcu'] as $key => $value_fcu) {
        if ( $value['cl_id'] == $value_fcu['cl_id']) {
         array_push($fcu_arr , (object)[
                'cl_id' => (int)$value_fcu['cl_id'],
                'aircon_id' => (int)$value_fcu['aircon_id'],
                'fcuno' =>(int)$value_fcu['fcuno'],
                'qty' =>(int)$value_fcu['qty'],
                'device_brand' =>$value_fcu['device_brand'],
                'aircon_type' =>$value_fcu['aircon_type'],
                'fcu' =>$value_fcu['fcu'],
            ]);
     }
 }       
 $data['view_calllogs'][]= (object)[
    "cl_id"=> $value['cl_id'],
    "date"=> $value['date'],
    "log_code"=> $value['log_code'],
    "client_id"=> $value['client_id'],
    "area"=> $value['area'],
    "client_branch"=> $value['client_branch'],
    "serv_id"=> $value['serv_id'],
    "serv_name"=> $value['serv_name'],
    "serv_type"=> $value['serv_type'],
    "time"=> $value['time'],
    "end_time"=> $value['end_time'],
    // "aircon_id"=> $value['aircon_id'],
    // "aircon_type"=> $value['aircon_type'],
    // "device_brand"=> $value['device_brand'],
    // "caller"=> $value['caller'],
    // "particulars"=> $value['particulars'],
    // "qty"=> $value['qty'],
    "status"=> $value['status'],
    // "set_status"=> $value['set_status'],
    "fcu_arr"=> $fcu_arr,
];
}
if($this->request->getVar('print')){
    $data['uniq_area'] = array_unique($data['areas']);
    return view('admin/calllogs/logMonthlyPrint',$data);
}else{
    $data['main'] = 'admin/calllogs/call_view';
    return view("templates/template",$data);
}

}
public function quarterlyLogs(){
    if($_SESSION['position'] != USER_ROLE_ADMIN && $_SESSION['position'] != USER_ROLE_SECRETARY){
            return $this->response->redirect(site_url('/dashboard'));
        }

    date_default_timezone_set('Asia/Hong_Kong'); 

    $date = new \DateTime();
    $date->setTimezone(new \DateTimeZone('+0800'));
    $Call_logs = new Calllogs_views();
    $Client = new Client();
    $Aircon = new Aircon();
    $fcu_no = new Fcu_no();
    $Call_fcu = new Call_fcu_views();
    $Emp = new Emp();
    $serv = new Serv();

    $db = \Config\Database::connect();
    $query   = $db->query('SELECT DISTINCT aircon_id,cl_id,device_brand,aircon_type,qty
        FROM call_fcu_views');
    $data['distinct'] = $query->getResult();

    $db1 = \Config\Database::connect();
    $query   = $db1->query('SELECT DISTINCT cl_id
        FROM call_fcu_views');
    $data['distinct_event'] = $query->getResult();

    $month = date('n');
    $data['quarter'] = "";
    if($month <= 3){ 
        $data['quarter'] = "1st";
    }
    else if($month <= 6){ 
        $data['quarter'] = "2nd";
    }
    else if($month <= 9){ 
        $data['quarter'] = "3rd";
    }else{
        $data['quarter'] = "4th";
    };

    $data['view_calllogs'] = [];
    $data['areas'] = array();
    $data['cBranch']="";
    $data['now'] = date('Y-m-d');
    $data['client'] = $Client->orderBy('client_id', 'ASC')->findAll();
    $data['area'] = $Client->select('area')->groupBy('area')->findAll();
    // dd($data['caller']);
    $data['fcu_no'] = $fcu_no->orderBy('fcuno', 'ASC')->findAll();
    $data['call_fcu'] = $Call_fcu->orderBy('cl_id', 'ASC')->findAll();
    $data['emp'] = $Emp->orderBy('emp_id', 'ASC')->findAll();
    $data['serv'] = $serv->orderBy('serv_id', 'ASC')->findAll();
    $data['servName'] = $serv->select('serv_name, serv_color, serv_type')->groupBy('serv_name')->findAll();
    $data['servType'] = $serv->orderBy('serv_name','ASC')->findAll();
    $data['aircon'] = $Aircon->orderBy('aircon_id', 'ASC')->findAll();
    $data['device_brand'] = $Aircon->select('device_brand')->groupBy('device_brand')->findAll();
    if($this->request->getVar('filter_client')){
        $cBranch = $this->request->getVar('filter_client');
        // $url = $this->request->getVar('url');
        $data['call_logs'] = $Call_logs->where('Quarter(date) = Quarter(CURDATE())')->where('client_id',$cBranch)->orderBy('date', 'ASC')->findAll();
        if(count($data['call_logs'])>0){
            $data['cBranch'] = $data['call_logs'][0]['client_branch'];
        }
    }else{
        $data['call_logs'] = $Call_logs->where('Quarter(date) = Quarter(CURDATE())')->findAll();
    }

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

foreach ($data['call_logs'] as $key => $value) {
    array_push($data['areas'],$value['area']);
    $fcu_arr =array();
    foreach ($data['call_fcu'] as $key => $value_fcu) {
        if ( $value['cl_id'] == $value_fcu['cl_id']) {
         array_push($fcu_arr , (object)[
                'cl_id' => (int)$value_fcu['cl_id'],
                'aircon_id' => (int)$value_fcu['aircon_id'],
                'fcuno' =>(int)$value_fcu['fcuno'],
                'qty' =>(int)$value_fcu['qty'],
                'device_brand' =>$value_fcu['device_brand'],
                'aircon_type' =>$value_fcu['aircon_type'],
                'fcu' =>$value_fcu['fcu'],
            ]);
     }
 }    
 $data['view_calllogs'][]= (object)[
    "cl_id"=> $value['cl_id'],
    "date"=> $value['date'],
    "log_code"=> $value['log_code'],
    "client_id"=> $value['client_id'],
    "area"=> $value['area'],
    "client_branch"=> $value['client_branch'],
    "serv_id"=> $value['serv_id'],
    "serv_name"=> $value['serv_name'],
    "serv_type"=> $value['serv_type'],
    "time"=> $value['time'],
    "end_time"=> $value['end_time'],
    // "aircon_id"=> $value['aircon_id'],
    // "aircon_type"=> $value['aircon_type'],
    // "device_brand"=> $value['device_brand'],
    // "caller"=> $value['caller'],
    // "particulars"=> $value['particulars'],
    // "qty"=> $value['qty'],
    "status"=> $value['status'],
    // "set_status"=> $value['set_status'],
    "fcu_arr"=> $fcu_arr,
];
}
if($this->request->getVar('print')){
    $data['uniq_area'] = array_unique($data['areas']);
    return view('admin/calllogs/logQuarterlyPrint',$data);
}else{
    $data['main'] = 'admin/calllogs/call_view';
    return view("templates/template",$data);
}

}
public function yearlyLogs(){
    if($_SESSION['position'] != USER_ROLE_ADMIN && $_SESSION['position'] != USER_ROLE_SECRETARY){
            return $this->response->redirect(site_url('/dashboard'));
        }

    date_default_timezone_set('Asia/Hong_Kong'); 

    $date = new \DateTime();
    $date->setTimezone(new \DateTimeZone('+0800'));
    $Call_logs = new Calllogs_views();
    $Client = new Client();
    $Aircon = new Aircon();
    $fcu_no = new Fcu_no();
    $Call_fcu = new Call_fcu_views();
    $Emp = new Emp();
    $serv = new Serv();

    $db = \Config\Database::connect();
    $query   = $db->query('SELECT DISTINCT aircon_id,cl_id,device_brand,aircon_type,qty
        FROM call_fcu_views');
    $data['distinct'] = $query->getResult();

    $db1 = \Config\Database::connect();
    $query   = $db1->query('SELECT DISTINCT cl_id
        FROM call_fcu_views');
    $data['distinct_event'] = $query->getResult();

    $data['view_calllogs'] = [];
    $data['areas'] = array();
    $data['cBranch']="";
    $data['now'] = date('Y-m-d');
    $data['client'] = $Client->orderBy('client_id', 'ASC')->findAll();
    $data['area'] = $Client->select('area')->groupBy('area')->findAll();
    // dd($data['caller']);
    $data['fcu_no'] = $fcu_no->orderBy('fcuno', 'ASC')->findAll();
    $data['call_fcu'] = $Call_fcu->orderBy('cl_id', 'ASC')->findAll();
    $data['emp'] = $Emp->orderBy('emp_id', 'ASC')->findAll();
    $data['serv'] = $serv->orderBy('serv_id', 'ASC')->findAll();
    $data['servName'] = $serv->select('serv_name, serv_color, serv_type')->groupBy('serv_name')->findAll();
    $data['servType'] = $serv->orderBy('serv_name','ASC')->findAll();
    $data['aircon'] = $Aircon->orderBy('aircon_id', 'ASC')->findAll();
    $data['device_brand'] = $Aircon->select('device_brand')->groupBy('device_brand')->findAll();
    if($this->request->getVar('filter_client')){
        $cBranch = $this->request->getVar('filter_client');
        // $url = $this->request->getVar('url');
        $data['call_logs'] = $Call_logs->where('YEAR(date) = YEAR(CURDATE())')->where('client_id',$cBranch)->orderBy('date', 'ASC')->findAll();
        if(count($data['call_logs'])>0){
            $data['cBranch'] = $data['call_logs'][0]['client_branch'];
        }
    }else{
        $data['call_logs'] = $Call_logs->where('YEAR(date) = YEAR(CURDATE())')->findAll();
    }

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

foreach ($data['call_logs'] as $key => $value) {
    array_push($data['areas'],$value['area']);
   $fcu_arr =array();
    foreach ($data['call_fcu'] as $key => $value_fcu) {
        if ( $value['cl_id'] == $value_fcu['cl_id']) {
         array_push($fcu_arr , (object)[
                'cl_id' => (int)$value_fcu['cl_id'],
                'aircon_id' => (int)$value_fcu['aircon_id'],
                'fcuno' =>(int)$value_fcu['fcuno'],
                'qty' =>(int)$value_fcu['qty'],
                'device_brand' =>$value_fcu['device_brand'],
                'aircon_type' =>$value_fcu['aircon_type'],
                'fcu' =>$value_fcu['fcu'],
            ]);
     }
 }    
 $data['view_calllogs'][]= (object)[
    "cl_id"=> $value['cl_id'],
    "date"=> $value['date'],
    "log_code"=> $value['log_code'],
    "client_id"=> $value['client_id'],
    "area"=> $value['area'],
    "client_branch"=> $value['client_branch'],
    "serv_id"=> $value['serv_id'],
    "serv_name"=> $value['serv_name'],
    "serv_type"=> $value['serv_type'],
    "time"=> $value['time'],
    "end_time"=> $value['end_time'],
    // "aircon_id"=> $value['aircon_id'],
    // "aircon_type"=> $value['aircon_type'],
    // "device_brand"=> $value['device_brand'],
    // "caller"=> $value['caller'],
    // "particulars"=> $value['particulars'],
    // "qty"=> $value['qty'],
    "status"=> $value['status'],
    // "set_status"=> $value['set_status'],
    "fcu_arr"=> $fcu_arr,
];
}
if($this->request->getVar('print')){
    $data['uniq_area'] = array_unique($data['areas']);
    return view('admin/calllogs/logYearlyPrint',$data);
}else{
    $data['main'] = 'admin/calllogs/call_view';
    return view("templates/template",$data);
}

}
    // delete Call log info
public function delete($cl_id = null){
    if($_SESSION['position'] != USER_ROLE_ADMIN && $_SESSION['position'] != USER_ROLE_SECRETARY){
            return $this->response->redirect(site_url('/dashboard'));
        }
    $Call_logs = new Call_logs();
    $data['Call_logs'] = $Call_logs->where('cl_id', $cl_id)->delete($cl_id);
    $session = session();
    $session->setFlashdata('msg', 'value');
    return $this->response->redirect(site_url('/calllogs'));
}
public function setLog(){
    $Call_logs = new Call_logs();
    $Call_fcu = new Call_fcu();
    $Client = new Client();
    $Serv = new Serv();
    $Aircon = new Aircon();
    // $Fcu_no = new Fcu_no();
    // $Appoint_view = new view_appointment();
    $cl_id = $this->request->getPost('cl_id');
    $data['cl_data']=$Call_logs->find($cl_id);
    $data['fcu']=$Call_fcu->where('cl_id',$cl_id)->findAll();
    $data['client']=$Client->orderBy('client_id','asc')->findAll();
    $data['serv']=$Serv->orderBy('serv_id','asc')->findAll();
    $data['aircon']=$Aircon->orderBy('aircon_id','asc')->findAll();
    // $data['fcu_no']=$Aircon->orderBy('aircon_id','asc')->findAll();
    return $this->response->setJSON($data);
}

public function cancel(){
    $Call_logs = new Call_logs();
    $Event = new Event();
    $log_code = $this->request->getPost('log_code');

    $cl_data = $Call_logs->where('log_code',$log_code)->first();
    $event_data= $Event->where('log_code',$log_code)->first();
    $event_id = $event_data['id'];
    $success = $Event->where('id', $event_id)->delete($event_id);

    if($success){
        $update_status = ['set_status' => 0];
        $Call_logs->update($cl_data['cl_id'],$update_status);
    }
    // $data['HEllo'] = $event_id;
    return $this->response->setJSON($data);
}

public function view(){
    $Call_logs = new Calllogs_views();
    $Fcu = new Call_fcu_views();
    $Client = new Client();
    $Serv = new Serv();
    // $Emp = new Event_emp_views();
    $Serv = new Serv();
    $id = $this->request->getPost('cl_id');
    $data['cl_data'] = $Call_logs->where('cl_id',$id)->first();
    $data['fcu_data'] = $Fcu->where('cl_id',$id)->findAll();
    $data['client_data'] = $Client->orderBy('client_id','ASC')->findAll();
    $data['serv_data'] = $Serv->orderBy('serv_id','ASC')->findAll();
     $db = \Config\Database::connect();
      $query   = $db->query('SELECT DISTINCT aircon_id,cl_id,device_brand,aircon_type,qty
        FROM call_fcu_views where cl_id = '.$id);
      $data['distinct'] = $query->getResult();

    return $this->response->setJSON($data);

}

}


?>