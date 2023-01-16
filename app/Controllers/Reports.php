<?php

namespace App\Controllers;
use App\Models\User;
use App\Models\Emp;
use App\Models\Client;
use App\Models\All_events;
use App\Models\Event;
use App\Models\Serv;
use App\Libraries\Pdf;
use App\Models\Event_emp_views;
use App\Models\Aircon;
use App\Models\Event_fcu_views;


class Reports extends BaseController
{   
	public function index(){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $event = new All_events();
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

        $datas['task'] = array();
        $datas['client'] = $client->orderBy('client_id', 'ASC')->findAll();
        $datas['all_events'] = $event->orderBy('start_event', 'ASC')->where('status = "Done"')->findAll();
        $datas['servName'] = $serv->select('serv_name, serv_color, serv_type')->groupBy('serv_name')->findAll();
        $datas['servType'] = $serv->orderBy('serv_name','ASC')->findAll();
        $datas['area'] = $client->select('area')->groupBy('area')->findAll();
        $datas['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
        $datas['event_fcu'] = $event_fcu->orderBy('id', 'ASC')->orderBy('fcuno', 'ASC')->findAll();
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
        
        foreach($datas['all_events'] as $key => $value) {

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

     $datas['task'][]= (object)[
        "id"=> $value['id'],
        "title"=>$value['title'],
        "event_code"=>$value['event_code'],
        "log_code"=> $value['log_code'],
        "appt_code"=> $value['appt_code'],
        "start_event"=> $value['start_event'],
        "time"=> $value['TIME'],
        "serv_id"=> $value['serv_id'],
        "client_id"=>$value['client_id'],
        "serv_name"=>$value['serv_name'],
        "serv_type"=>$value['serv_type'],
        "area"=> $value['area'],
        "emp_array"=> $emp_arr,
        "fcu_array"=> $fcu_arr,
        "client_branch"=> $value['client_branch'],
        "price"=> $value['price'],
        "status"=> $value['STATUS'],
    ];

}

$datas['main'] = 'admin/reports/accomplishedReports';
return view('templates/template',$datas);
}
public function dailyAccomplish(){
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

    $datas['task'] = array();
    $datas['areas'] = array();
    $datas['cBranch']="";
    $datas['client'] = $client->orderBy('client_id', 'ASC')->findAll();
        // $datas['emp'] = $emp->orderBy('emp_id', 'ASC')->findAll();
    $datas['serv'] = $serv->orderBy('serv_id', 'ASC')->findAll();
    $datas['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
    $datas['event_fcu'] = $event_fcu->orderBy('id', 'ASC')->orderBy('fcuno', 'ASC')->findAll();
    if($this->request->getVar('filter_client')){
        $cBranch = $this->request->getVar('filter_client');
        // $url = $this->request->getVar('url');
        $datas['today'] = $event->where('start_event', date('Y-m-d'))->where('status', 'Done')->where('client_id',$cBranch)->orderBy('start_event', 'ASC')->findAll();
        if(count($datas['today'])>0){
            $datas['cBranch'] = $datas['today'][0]['client_branch'];
        }
    }else{
        $datas['today'] = $event->where('start_event', date('Y-m-d'))->where('status', 'Done')->orderBy('start_event', 'ASC')->findAll();
    }
    foreach ($datas['today'] as $key => $value) {
        array_push($datas['areas'],$value['area']);
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
       $datas['task'][]= (object)[
          "id"=> $value['id'],
          "title"=>$value['title'],
          "event_code"=>$value['event_code'],
          "log_code"=> $value['log_code'],
          "appt_code"=> $value['appt_code'],
          "start_event"=> $value['start_event'],
          "time"=> $value['TIME'],
          "serv_id"=> $value['serv_id'],
          "client_id"=>$value['client_id'],
          "serv_name"=>$value['serv_name'],
          "serv_type"=>$value['serv_type'],
          "area"=> $value['area'],
          "emp_array"=> $emp_arr,
          "fcu_array"=> $fcu_arr,
          "client_branch"=> $value['client_branch'],
          "status"=> $value['STATUS'],
          "price"=> $value['price'],
      ];
  }
  if($this->request->getVar('print')){
    $datas['uniq_area'] = array_unique($datas['areas']);
    return view('admin/reports/accDailyPrint',$datas);
 }else{
      $datas['main'] = 'admin/reports/accomplishedReports';
      return view("templates/template",$datas);
 }
}
public function weeklyAccomplish(){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }
    $event = new All_events();
        // $emp = new Emp();
    // $client = new Client();
    // $serv = new Serv();
    $event_emp = new Event_emp_views();
    $event_fcu = new Event_fcu_views();
    $client = new Client();

    date_default_timezone_set('Asia/Hong_Kong'); 

    $date = new \DateTime();
    $date->setTimezone(new \DateTimeZone('+0800'));

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

    $datas['task'] = array();
    $datas['areas'] = array();
    $datas['cBranch']="";
    // $datas['client'] = $client->orderBy('client_id', 'ASC')->findAll();
        // $datas['emp'] = $emp->orderBy('emp_id', 'ASC')->findAll();
    // $datas['serv'] = $serv->orderBy('serv_id', 'ASC')->findAll();
    $datas['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
    $datas['event_fcu'] = $event_fcu->orderBy('id', 'ASC')->orderBy('fcuno', 'ASC')->findAll();
    $datas['client'] = $client->orderBy('client_id', 'ASC')->findAll();

    if($this->request->getVar('filter_client')){
        $cBranch = $this->request->getVar('filter_client');
        $datas['weekly'] = $event->where('start_event BETWEEN "'. date('Y-m-d', strtotime($monday)). '" and "'. date('Y-m-d', strtotime($sunday)).'" AND status = "Done" AND client_id = "'.$cBranch.'" ORDER BY start_event ASC')->findAll();
        if(count($datas['weekly'])>0){
            $datas['cBranch'] = $datas['weekly'][0]['client_branch'];
        }
    }else{
        $datas['weekly'] = $event->where('start_event BETWEEN "'. date('Y-m-d', strtotime($monday)). '" and "'. date('Y-m-d', strtotime($sunday)).'" AND status = "Done" ORDER BY start_event ASC')->findAll();
    }
    foreach ($datas['weekly'] as $key => $value) {
        array_push($datas['areas'],$value['area']);
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
     $datas['task'][]= (object)[
      "id"=> $value['id'],
      "title"=>$value['title'],
      "event_code"=>$value['event_code'],
      "log_code"=> $value['log_code'],
      "appt_code"=> $value['appt_code'],
      "start_event"=> $value['start_event'],
      "time"=> $value['TIME'],
      "serv_id"=> $value['serv_id'],
      "client_id"=>$value['client_id'],
      "serv_name"=>$value['serv_name'],
      "serv_type"=>$value['serv_type'],
      "area"=> $value['area'],
      "emp_array"=> $emp_arr,
      "fcu_array"=> $fcu_arr,
      "client_branch"=> $value['client_branch'],
      "status"=> $value['STATUS'],
      "price"=> $value['price'],
  ];
}
if($this->request->getVar('print')){
    $datas['uniq_area'] = array_unique($datas['areas']);
    return view('admin/reports/accWeeklyPrint',$datas);
 }else{
    $datas['main'] = 'admin/reports/accomplishedReports';
    return view("templates/template",$datas);
 }
}
public function monthlyAccomplish(){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }
    $event = new All_events();
        // $emp = new Emp();
    $client = new Client();
    // $serv = new Serv();
    $event_emp = new Event_emp_views();
    $event_fcu = new Event_fcu_views();
    // $aircon = new Aircon();

    date_default_timezone_set('Asia/Hong_Kong'); 

    $date = new \DateTime();
    $date->setTimezone(new \DateTimeZone('+0800'));

    $db = \Config\Database::connect();
    $query   = $db->query('SELECT DISTINCT aircon_id,id,device_brand,aircon_type,quantity
        FROM event_fcu_views');
    $datas['distinct'] = $query->getResult();

    $db1 = \Config\Database::connect();
    $query   = $db1->query('SELECT DISTINCT id
        FROM event_fcu_views');
    $datas['distinct_event'] = $query->getResult();

    $datas['task'] = array();
    $datas['areas'] = array();
    $datas['cBranch']="";
    $datas['client'] = $client->orderBy('client_id', 'ASC')->findAll();
        // $datas['emp'] = $emp->orderBy('emp_id', 'ASC')->findAll();
    // $datas['serv'] = $serv->orderBy('serv_id', 'ASC')->findAll();
    $datas['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
    $datas['event_fcu'] = $event_fcu->orderBy('id', 'ASC')->orderBy('fcuno', 'ASC')->findAll();
    if($this->request->getVar('filter_client')){
        $cBranch = $this->request->getVar('filter_client');
        $datas['monthly'] = $event->where('MONTH(start_event) = MONTH(CURRENT_DATE()) && YEAR(start_event) = YEAR(CURRENT_DATE()) AND status = "Done" AND client_id = "'.$cBranch.'" ORDER BY start_event ASC')->findAll();
        if(count($datas['monthly'])>0){
            $datas['cBranch'] = $datas['monthly'][0]['client_branch'];
        }
    }else{
        $datas['monthly'] = $event->where('MONTH(start_event) = MONTH(CURRENT_DATE()) && YEAR(start_event) = YEAR(CURRENT_DATE()) AND status = "Done" ORDER BY start_event ASC')->findAll();
    }
    foreach ($datas['monthly'] as $key => $value) {
        array_push($datas['areas'],$value['area']);
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
     $datas['task'][]= (object)[
         "id"=> $value['id'],
         "title"=>$value['title'],
         "start_event"=> $value['start_event'],
         "log_code"=> $value['log_code'],
         "appt_code"=> $value['appt_code'],
         "event_code"=>$value['event_code'],
         "time"=> $value['TIME'],
         "serv_id"=> $value['serv_id'],
         "client_id"=>$value['client_id'],
         "serv_name"=>$value['serv_name'],
         "serv_type"=>$value['serv_type'],
         "area"=> $value['area'],
         "emp_array"=> $emp_arr,
         "fcu_array"=> $fcu_arr,
         "client_branch"=> $value['client_branch'],
         "status"=> $value['STATUS'],
         "price"=> $value['price'],
     ];
 }
 if($this->request->getVar('print')){
    $datas['uniq_area'] = array_unique($datas['areas']);
    return view('admin/reports/accMonthlyPrint',$datas);
 }else{
     $datas['main'] = 'admin/reports/accomplishedReports';
     return view("templates/template",$datas);
 }
}
public function quarterlyAccomplish(){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }
    $event = new All_events();
        // $emp = new Emp();
    $client = new Client();
    // $serv = new Serv();
    $event_emp = new Event_emp_views();
    $event_fcu = new Event_fcu_views();
    // $aircon = new Aircon();

    date_default_timezone_set('Asia/Hong_Kong'); 

    $date = new \DateTime();
    $date->setTimezone(new \DateTimeZone('+0800'));

    $db = \Config\Database::connect();
    $query   = $db->query('SELECT DISTINCT aircon_id,id,device_brand,aircon_type,quantity
        FROM event_fcu_views');
    $datas['distinct'] = $query->getResult();

    $db1 = \Config\Database::connect();
    $query   = $db1->query('SELECT DISTINCT id
        FROM event_fcu_views');
    $datas['distinct_event'] = $query->getResult();

    $month = date('n');
    $datas['quarter'] = "";
    if($month <= 3){ 
        $datas['quarter'] = "1st";
    }
    else if($month <= 6){ 
        $datas['quarter'] = "2nd";
    }
    else if($month <= 9){ 
        $datas['quarter'] = "3rd";
    }else{
        $datas['quarter'] = "4th";
    };
    // dd($quarter);

    $datas['task'] = array();
    $datas['areas'] = array();
    $datas['cBranch'] = "";
    // $datas['client'] = $client->orderBy('client_id', 'ASC')->findAll();
        // $datas['emp'] = $emp->orderBy('emp_id', 'ASC')->findAll();
    // $datas['serv'] = $serv->orderBy('serv_id', 'ASC')->findAll();
    $datas['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
    $datas['event_fcu'] = $event_fcu->orderBy('id', 'ASC')->orderBy('fcuno', 'ASC')->findAll();
    $datas['client'] = $client->orderBy('client_id', 'ASC')->findAll();
    if($this->request->getVar('filter_client')){
        $cBranch = $this->request->getVar('filter_client');
        $datas['quarterly'] = $event->where('Quarter(start_event) = Quarter(CURDATE()) AND status = "Done" AND client_id = "'.$cBranch.'" ORDER BY start_event ASC')->findAll();
        if(count($datas['quarterly'])>0){
            $datas['cBranch'] = $datas['quarterly'][0]['client_branch'];
        }
    }else{
        $datas['quarterly'] = $event->where('Quarter(start_event) = Quarter(CURDATE()) AND status = "Done" ORDER BY start_event ASC')->findAll();
    }
    foreach ($datas['quarterly'] as $key => $value) {
        array_push($datas['areas'],$value['area']);
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
     $datas['task'][]= (object)[
         "id"=> $value['id'],
         "title"=>$value['title'],
         "start_event"=> $value['start_event'],
         "log_code"=> $value['log_code'],
         "appt_code"=> $value['appt_code'],
         "event_code"=>$value['event_code'],
         "time"=> $value['TIME'],
         "serv_id"=> $value['serv_id'],
         "client_id"=>$value['client_id'],
         "serv_name"=>$value['serv_name'],
         "serv_type"=>$value['serv_type'],
         "area"=> $value['area'],
         "emp_array"=> $emp_arr,
         "fcu_array"=> $fcu_arr,
         "client_branch"=> $value['client_branch'],
         "status"=> $value['STATUS'],
         "price"=> $value['price'],
     ];
 }
 if($this->request->getVar('print')){
    $datas['uniq_area'] = array_unique($datas['areas']);
    return view('admin/reports/accQuarterlyPrint',$datas);
 }else{
     $datas['main'] = 'admin/reports/accomplishedReports';
     return view("templates/template",$datas);
 }
}
public function yearlyAccomplish(){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }
    $event = new All_events();
        // $emp = new Emp();
    $client = new Client();
    // $serv = new Serv();
    $event_emp = new Event_emp_views();
    $event_fcu = new Event_fcu_views();
    // $aircon = new Aircon();

    date_default_timezone_set('Asia/Hong_Kong'); 

    $date = new \DateTime();
    $date->setTimezone(new \DateTimeZone('+0800'));

    $db = \Config\Database::connect();
    $query   = $db->query('SELECT DISTINCT aircon_id,id,device_brand,aircon_type,quantity
        FROM event_fcu_views');
    $datas['distinct'] = $query->getResult();

    $db1 = \Config\Database::connect();
    $query   = $db1->query('SELECT DISTINCT id
        FROM event_fcu_views');
    $datas['distinct_event'] = $query->getResult();

    $datas['task'] = array();
    $datas['areas'] = array();
    $datas['cBranch']="";
    // $datas['year'] = date("Y");
    // $datas['client'] = $client->orderBy('client_id', 'ASC')->findAll();
        // $datas['emp'] = $emp->orderBy('emp_id', 'ASC')->findAll();
    // $datas['serv'] = $serv->orderBy('serv_id', 'ASC')->findAll();
    $datas['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
    $datas['event_fcu'] = $event_fcu->orderBy('id', 'ASC')->orderBy('fcuno', 'ASC')->findAll();
    $datas['client'] = $client->orderBy('client_id', 'ASC')->findAll();
    if($this->request->getVar('filter_client')){
        $cBranch = $this->request->getVar('filter_client');
        $datas['yearly'] = $event->where('YEAR(start_event) = YEAR(CURDATE()) AND status = "Done" AND client_id = "'.$cBranch.'" ORDER BY start_event ASC')->findAll();
        if(count($datas['yearly'])>0){
            $datas['cBranch'] = $datas['yearly'][0]['client_branch'];
        }
    }else{
        $datas['yearly'] = $event->where('YEAR(start_event) = YEAR(CURDATE()) AND status = "Done" ORDER BY start_event ASC')->findAll();
    }
    foreach ($datas['yearly'] as $key => $value) {
        array_push($datas['areas'],$value['area']);
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
     $datas['task'][]= (object)[
         "id"=> $value['id'],
         "title"=>$value['title'],
         "start_event"=> $value['start_event'],
         "log_code"=> $value['log_code'],
         "appt_code"=> $value['appt_code'],
         "event_code"=>$value['event_code'],
         "time"=> $value['TIME'],
         "serv_id"=> $value['serv_id'],
         "client_id"=>$value['client_id'],
         "serv_name"=>$value['serv_name'],
         "serv_type"=>$value['serv_type'],
         "area"=> $value['area'],
         "emp_array"=> $emp_arr,
         "fcu_array"=> $fcu_arr,
         "client_branch"=> $value['client_branch'],
         "status"=> $value['STATUS'],
         "price"=> $value['price'],
     ];
 }
 if($this->request->getVar('print')){
    $datas['uniq_area'] = array_unique($datas['areas']);
    return view('admin/reports/accYearlyPrint',$datas);
 }else{
    $datas['main'] = 'admin/reports/accomplishedReports';
    return view("templates/template",$datas);
 }
}
public function showException(){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }
    $event = new All_events();
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
    
    $datas['task'] = array();
    $datas['cId'] ="";
    $datas['cbranch']="";
    $datas['client'] = $client->orderBy('client_id', 'ASC')->findAll();
    $datas['servName'] = $serv->select('serv_name, serv_color, serv_type')->groupBy('serv_name')->findAll();
    $datas['servType'] = $serv->orderBy('serv_name','ASC')->findAll();
    $datas['area'] = $client->select('area')->groupBy('area')->findAll();
    $datas['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
    $datas['event_fcu'] = $event_fcu->orderBy('id', 'ASC')->orderBy('fcuno', 'ASC')->findAll();
    

    $datas['all_events'] = $event->orderBy('start_event', 'ASC')->where('status = "Pending"')->findAll();
        // dd($data[0]['title']);
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
    foreach($datas['all_events'] as $key => $value) {

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

  $datas['task'][]= (object)[
        "id"=> $value['id'],
        "title"=>$value['title'],
        "event_code"=>$value['event_code'],
        "log_code"=> $value['log_code'],
        "appt_code"=> $value['appt_code'],
        "start_event"=> $value['start_event'],
        "time"=> $value['TIME'],
        "serv_id"=> $value['serv_id'],
        "client_id"=>$value['client_id'],
        "serv_name"=>$value['serv_name'],
        "serv_type"=>$value['serv_type'],
        "area"=> $value['area'],
        "emp_array"=> $emp_arr,
        "fcu_array"=> $fcu_arr,
        "client_branch"=> $value['client_branch'],
        "price"=> $value['price'],
        "status"=> $value['STATUS'],
    ];

}

$datas['main'] = 'admin/reports/exceptionReports';
return view('templates/template',$datas);
}
public function dailyException(){
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

    $datas['task'] = array();
    $datas['areas'] = array();
    $datas['cBranch']="";
    $datas['client'] = $client->orderBy('client_id', 'ASC')->findAll();
        // $datas['emp'] = $emp->orderBy('emp_id', 'ASC')->findAll();
    $datas['serv'] = $serv->orderBy('serv_id', 'ASC')->findAll();
    $datas['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
    $datas['event_fcu'] = $event_fcu->orderBy('id', 'ASC')->orderBy('fcuno', 'ASC')->findAll();
    if($this->request->getVar('filter_client')){
        $cBranch = $this->request->getVar('filter_client');
        // $url = $this->request->getVar('url');
        $datas['today'] = $event->where('start_event', date('Y-m-d'))->where('status', 'Pending')->where('client_id',$cBranch)->orderBy('start_event', 'ASC')->findAll();
        if(count($datas['today'])>0){
            $datas['cBranch'] = $datas['today'][0]['client_branch'];
        }
    }else{
        $datas['today'] = $event->where('start_event', date('Y-m-d'))->where('status', 'Pending')->orderBy('start_event', 'ASC')->findAll();
    }
    foreach ($datas['today'] as $key => $value) {
        array_push($datas['areas'],$value['area']);
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
       $datas['task'][]= (object)[
          "id"=> $value['id'],
          "title"=>$value['title'],
          "event_code"=>$value['event_code'],
          "log_code"=> $value['log_code'],
          "appt_code"=> $value['appt_code'],
          "start_event"=> $value['start_event'],
          "time"=> $value['TIME'],
          "serv_id"=> $value['serv_id'],
          "client_id"=>$value['client_id'],
          "serv_name"=>$value['serv_name'],
          "serv_type"=>$value['serv_type'],
          "area"=> $value['area'],
          "emp_array"=> $emp_arr,
          "fcu_array"=> $fcu_arr,
          "client_branch"=> $value['client_branch'],
          "status"=> $value['STATUS'],
          "price"=> $value['price'],
      ];
  }
  if($this->request->getVar('print')){
    $datas['uniq_area'] = array_unique($datas['areas']);
    return view('admin/reports/excepDailyPrint',$datas);
 }else{
      $datas['main'] = 'admin/reports/exceptionReports';
      return view("templates/template",$datas);
 }
}
public function weeklyException(){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }
    $event = new All_events();
        // $emp = new Emp();
    // $client = new Client();
    // $serv = new Serv();
    $event_emp = new Event_emp_views();
    $event_fcu = new Event_fcu_views();
    $client = new Client();

    date_default_timezone_set('Asia/Hong_Kong'); 

    $date = new \DateTime();
    $date->setTimezone(new \DateTimeZone('+0800'));

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
    // dd($monday);
    $datas['task'] = array();
    $datas['areas'] = array();
    $datas['cBranch']="";
    $datas['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
    $datas['event_fcu'] = $event_fcu->orderBy('id', 'ASC')->orderBy('fcuno', 'ASC')->findAll();
    $datas['client'] = $client->orderBy('client_id', 'ASC')->findAll();

    if($this->request->getVar('filter_client')){
        $cBranch = $this->request->getVar('filter_client');
        $datas['weekly'] = $event->where('start_event BETWEEN "'. date('Y-m-d', strtotime($monday)). '" and "'. date('Y-m-d', strtotime($sunday)).'" AND status = "Pending" AND client_id = "'.$cBranch.'" ORDER BY start_event ASC')->findAll();
        if(count($datas['weekly'])>0){
            $datas['cBranch'] = $datas['weekly'][0]['client_branch'];
        }

    }else{
        $datas['weekly'] = $event->where('start_event BETWEEN "'. date('Y-m-d', strtotime($monday)). '" and "'. date('Y-m-d', strtotime($sunday)).'" AND status = "Pending" ORDER BY start_event ASC')->findAll();
    }
    // dd($datas['weekly']);
    foreach ($datas['weekly'] as $key => $value) {
        array_push($datas['areas'],$value['area']);
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
     $datas['task'][]= (object)[
      "id"=> $value['id'],
      "title"=>$value['title'],
      "event_code"=>$value['event_code'],
      "log_code"=> $value['log_code'],
      "appt_code"=> $value['appt_code'],
      "start_event"=> $value['start_event'],
      "time"=> $value['TIME'],
      "serv_id"=> $value['serv_id'],
      "client_id"=>$value['client_id'],
      "serv_name"=>$value['serv_name'],
      "serv_type"=>$value['serv_type'],
      "area"=> $value['area'],
      "emp_array"=> $emp_arr,
      "fcu_array"=> $fcu_arr,
      "client_branch"=> $value['client_branch'],
      "status"=> $value['STATUS'],
      "price"=> $value['price'],
  ];
}
if($this->request->getVar('print')){
    $datas['uniq_area'] = array_unique($datas['areas']);
    return view('admin/reports/excepWeeklyPrint',$datas);
 }else{
    $datas['main'] = 'admin/reports/exceptionReports';
    return view("templates/template",$datas);
 }
}
public function monthlyException(){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }
    $event = new All_events();
        // $emp = new Emp();
    $client = new Client();
    // $serv = new Serv();
    $event_emp = new Event_emp_views();
    $event_fcu = new Event_fcu_views();
    // $aircon = new Aircon();

    date_default_timezone_set('Asia/Hong_Kong'); 

    $date = new \DateTime();
    $date->setTimezone(new \DateTimeZone('+0800'));

    $db = \Config\Database::connect();
    $query   = $db->query('SELECT DISTINCT aircon_id,id,device_brand,aircon_type,quantity
        FROM event_fcu_views');
    $datas['distinct'] = $query->getResult();

    $db1 = \Config\Database::connect();
    $query   = $db1->query('SELECT DISTINCT id
        FROM event_fcu_views');
    $datas['distinct_event'] = $query->getResult();

    $datas['task'] = array();
    $datas['areas'] = array();
    $datas['cBranch']="";
    $datas['client'] = $client->orderBy('client_id', 'ASC')->findAll();
        // $datas['emp'] = $emp->orderBy('emp_id', 'ASC')->findAll();
    // $datas['serv'] = $serv->orderBy('serv_id', 'ASC')->findAll();
    $datas['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
    $datas['event_fcu'] = $event_fcu->orderBy('id', 'ASC')->orderBy('fcuno', 'ASC')->findAll();
    if($this->request->getVar('filter_client')){
        $cBranch = $this->request->getVar('filter_client');
        $datas['monthly'] = $event->where('MONTH(start_event) = MONTH(CURRENT_DATE()) && YEAR(start_event) = YEAR(CURRENT_DATE()) AND status = "Pending" AND client_id = "'.$cBranch.'" ORDER BY start_event ASC')->findAll();
        if(count($datas['monthly'])>0){
            $datas['cBranch'] = $datas['monthly'][0]['client_branch'];
        }
    }else{
        $datas['monthly'] = $event->where('MONTH(start_event) = MONTH(CURRENT_DATE()) && YEAR(start_event) = YEAR(CURRENT_DATE()) AND status = "Pending" ORDER BY start_event ASC')->findAll();
    }
    foreach ($datas['monthly'] as $key => $value) {
        array_push($datas['areas'],$value['area']);
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
     $datas['task'][]= (object)[
         "id"=> $value['id'],
         "title"=>$value['title'],
         "start_event"=> $value['start_event'],
         "log_code"=> $value['log_code'],
         "appt_code"=> $value['appt_code'],
         "event_code"=>$value['event_code'],
         "time"=> $value['TIME'],
         "serv_id"=> $value['serv_id'],
         "client_id"=>$value['client_id'],
         "serv_name"=>$value['serv_name'],
         "serv_type"=>$value['serv_type'],
         "area"=> $value['area'],
         "emp_array"=> $emp_arr,
         "fcu_array"=> $fcu_arr,
         "client_branch"=> $value['client_branch'],
         "status"=> $value['STATUS'],
         "price"=> $value['price'],
     ];
 }
 if($this->request->getVar('print')){
    $datas['uniq_area'] = array_unique($datas['areas']);
    return view('admin/reports/excepMonthlyPrint',$datas);
 }else{
     $datas['main'] = 'admin/reports/exceptionReports';
     return view("templates/template",$datas);
 }
}
public function quarterlyException(){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }
    $event = new All_events();
        // $emp = new Emp();
    $client = new Client();
    // $serv = new Serv();
    $event_emp = new Event_emp_views();
    $event_fcu = new Event_fcu_views();
    // $aircon = new Aircon();

    date_default_timezone_set('Asia/Hong_Kong'); 

    $date = new \DateTime();
    $date->setTimezone(new \DateTimeZone('+0800'));

    $db = \Config\Database::connect();
    $query   = $db->query('SELECT DISTINCT aircon_id,id,device_brand,aircon_type,quantity
        FROM event_fcu_views');
    $datas['distinct'] = $query->getResult();

    $db1 = \Config\Database::connect();
    $query   = $db1->query('SELECT DISTINCT id
        FROM event_fcu_views');
    $datas['distinct_event'] = $query->getResult();

    $month = date('n');
    $datas['quarter'] = "";
    if($month <= 3){ 
        $datas['quarter'] = "1st";
    }
    else if($month <= 6){ 
        $datas['quarter'] = "2nd";
    }
    else if($month <= 9){ 
        $datas['quarter'] = "3rd";
    }else{
        $datas['quarter'] = "4th";
    };
    // dd($quarter);

    $datas['task'] = array();
    $datas['areas'] = array();
    $datas['cBranch'] = "";
    // $datas['client'] = $client->orderBy('client_id', 'ASC')->findAll();
        // $datas['emp'] = $emp->orderBy('emp_id', 'ASC')->findAll();
    // $datas['serv'] = $serv->orderBy('serv_id', 'ASC')->findAll();
    $datas['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
    $datas['event_fcu'] = $event_fcu->orderBy('id', 'ASC')->orderBy('fcuno', 'ASC')->findAll();
    $datas['client'] = $client->orderBy('client_id', 'ASC')->findAll();
    if($this->request->getVar('filter_client')){
        $cBranch = $this->request->getVar('filter_client');
        $datas['quarterly'] = $event->where('Quarter(start_event) = Quarter(CURDATE()) AND status = "Pending" AND client_id = "'.$cBranch.'" ORDER BY start_event ASC')->findAll();
        if(count($datas['quarterly'])>0){
            $datas['cBranch'] = $datas['quarterly'][0]['client_branch'];
        }
    }else{
        $datas['quarterly'] = $event->where('Quarter(start_event) = Quarter(CURDATE()) AND status = "Pending" ORDER BY start_event ASC')->findAll();
    }
    foreach ($datas['quarterly'] as $key => $value) {
        array_push($datas['areas'],$value['area']);
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
     $datas['task'][]= (object)[
         "id"=> $value['id'],
         "title"=>$value['title'],
         "start_event"=> $value['start_event'],
         "log_code"=> $value['log_code'],
         "appt_code"=> $value['appt_code'],
         "event_code"=>$value['event_code'],
         "time"=> $value['TIME'],
         "serv_id"=> $value['serv_id'],
         "client_id"=>$value['client_id'],
         "serv_name"=>$value['serv_name'],
         "serv_type"=>$value['serv_type'],
         "area"=> $value['area'],
         "emp_array"=> $emp_arr,
         "fcu_array"=> $fcu_arr,
         "client_branch"=> $value['client_branch'],
         "status"=> $value['STATUS'],
         "price"=> $value['price'],
     ];
 }
 if($this->request->getVar('print')){
    $datas['uniq_area'] = array_unique($datas['areas']);
    return view('admin/reports/excepQuarterlyPrint',$datas);
 }else{
     $datas['main'] = 'admin/reports/exceptionReports';
     return view("templates/template",$datas);
 }
}
public function yearlyException(){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }
    $event = new All_events();
        // $emp = new Emp();
    $client = new Client();
    // $serv = new Serv();
    $event_emp = new Event_emp_views();
    $event_fcu = new Event_fcu_views();
    // $aircon = new Aircon();

    date_default_timezone_set('Asia/Hong_Kong'); 

    $date = new \DateTime();
    $date->setTimezone(new \DateTimeZone('+0800'));

    $db = \Config\Database::connect();
    $query   = $db->query('SELECT DISTINCT aircon_id,id,device_brand,aircon_type,quantity
        FROM event_fcu_views');
    $datas['distinct'] = $query->getResult();

    $db1 = \Config\Database::connect();
    $query   = $db1->query('SELECT DISTINCT id
        FROM event_fcu_views');
    $datas['distinct_event'] = $query->getResult();

    $datas['task'] = array();
    $datas['areas'] = array();
    $datas['cBranch']="";
    // $datas['year'] = date("Y");
    // $datas['client'] = $client->orderBy('client_id', 'ASC')->findAll();
        // $datas['emp'] = $emp->orderBy('emp_id', 'ASC')->findAll();
    // $datas['serv'] = $serv->orderBy('serv_id', 'ASC')->findAll();
    $datas['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
    $datas['event_fcu'] = $event_fcu->orderBy('id', 'ASC')->orderBy('fcuno', 'ASC')->findAll();
    $datas['client'] = $client->orderBy('client_id', 'ASC')->findAll();
    if($this->request->getVar('filter_client')){
        $cBranch = $this->request->getVar('filter_client');
        $datas['yearly'] = $event->where('YEAR(start_event) = YEAR(CURDATE()) AND status = "Pending" AND client_id = "'.$cBranch.'" ORDER BY start_event ASC')->findAll();
        if(count($datas['yearly'])>0){
            $datas['cBranch'] = $datas['yearly'][0]['client_branch'];
        }
    }else{
        $datas['yearly'] = $event->where('YEAR(start_event) = YEAR(CURDATE()) AND status = "Pending" ORDER BY start_event ASC')->findAll();
    }
    foreach ($datas['yearly'] as $key => $value) {
        array_push($datas['areas'],$value['area']);
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
     $datas['task'][]= (object)[
         "id"=> $value['id'],
         "title"=>$value['title'],
         "start_event"=> $value['start_event'],
         "log_code"=> $value['log_code'],
         "appt_code"=> $value['appt_code'],
         "event_code"=>$value['event_code'],
         "time"=> $value['TIME'],
         "serv_id"=> $value['serv_id'],
         "client_id"=>$value['client_id'],
         "serv_name"=>$value['serv_name'],
         "serv_type"=>$value['serv_type'],
         "area"=> $value['area'],
         "emp_array"=> $emp_arr,
         "fcu_array"=> $fcu_arr,
         "client_branch"=> $value['client_branch'],
         "status"=> $value['STATUS'],
         "price"=> $value['price'],
     ];
 }
 if($this->request->getVar('print')){
    $datas['uniq_area'] = array_unique($datas['areas']);
    return view('admin/reports/excepYearlyPrint',$datas);
 }else{
    $datas['main'] = 'admin/reports/exceptionReports';
    return view("templates/template",$datas);
 }
}
public function getException(){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }
    $event = new All_events();
    $event_emp = new Event_emp_views();
    $event_fcu = new Event_fcu_views();
    $client = new Client();
    $serv = new Serv();

    $db = \Config\Database::connect();
          $query   = $db->query('SELECT DISTINCT aircon_id,id,device_brand,aircon_type,quantity
            FROM event_fcu_views');
          $datas['distinct'] = $query->getResult();

    $db1 = \Config\Database::connect();
          $query   = $db1->query('SELECT DISTINCT id
            FROM event_fcu_views');
          $datas['distinct_event'] = $query->getResult();
    
    $datas['event'] = array();
    $datas['cId'] ="";
    $datas['cbranch'] ="";
    $datas['servName'] = $serv->select('serv_name, serv_color, serv_type')->groupBy('serv_name')->findAll();
    $datas['servType'] = $serv->orderBy('serv_name','ASC')->findAll();
    $datas['client'] = $client->orderBy('client_id', 'ASC')->findAll();
    $datas['area'] = $client->select('area, client_id')->groupBy('area')->findAll();
    $datas['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
    $datas['event_fcu'] = $event_fcu->orderBy('id', 'ASC')->orderBy('fcuno', 'ASC')->findAll();
    foreach($datas['area'] as $k => $val) {

        $area = [];

        foreach($datas['client'] as $key => $value) {
            if($val['area'] == $value['area']){
              array_push($area , (object)[
                'client_id' => (int)$value['client_id'],
                'client_branch' =>$value['client_branch'],
                "area" =>$value['area']
            ]);
          }

      }

        $datas['client_area'][]= (object)[
            $val['area'] => $area
        ];
        // $datas['client_area2'][]=$area;
    }
    if(isset($_GET['start_date']) && isset($_GET['to_date']))
    {
        $start_date = $_GET['start_date'];
        $to_date = $_GET['to_date'];

        if(isset($_GET['serv']) && !isset($_GET['client_id'])){
            $serv_id = $_GET['serv'];
            $datas['all_events'] = $event->where('start_event BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($to_date)).'" AND serv_id = "'.$serv_id.'" AND status = "Pending"')->findAll();
        }elseif(isset($_GET['client_id']) && !isset($_GET['serv'])){
            $client_id = $_GET['client_id'];
            $datas['cId'] = $_GET['client_id'];
            $datas['cbranch'] = $client->where('client_id', $client_id)->first();
            $datas['all_events'] = $event->where('start_event BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($to_date)).'" AND client_id = "'.$client_id.'" AND status = "Pending"')->findAll();
            
        }elseif(isset($_GET['serv']) && isset($_GET['client_id'])){
            $serv_id = $_GET['serv'];
            $client_id = $_GET['client_id'];
            $datas['cId'] = $_GET['client_id'];
            $datas['cbranch'] = $client->where('client_id', $client_id)->first();
            $datas['all_events'] = $event->where('start_event BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($to_date)).'" AND client_id = "'.$client_id.'" AND serv_id = "'.$serv_id.'" AND status = "Pending"')->findAll();
            
        }else{
            $datas['all_events'] = $event->where('start_event BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($to_date)).'" AND status = "Pending"')->findAll();
        }

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
        "event_code"=>$value['event_code'],
        "log_code"=> $value['log_code'],
        "appt_code"=> $value['appt_code'],
        "start_event"=> $value['start_event'],
        "time"=> $value['TIME'],
        "serv_id"=> $value['serv_id'],
        //"aircon_id"=> $value['aircon_id'],
        "client_id"=>$value['client_id'],
        "serv_name"=>$value['serv_name'],
        "serv_type"=>$value['serv_type'],
        "area"=> $value['area'],
        "emp_array"=> $emp_arr,
        "fcu_array"=> $fcu_arr,
        "client_branch"=> $value['client_branch'],
        "price"=> $value['price'],
        "status"=> $value['STATUS'],
    ];
}


}
$datas['main'] = 'admin/reports/exceptionReports';
return view('templates/template',$datas);
}
public function printException($strt,$end,$serv,$client_id){
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

    $datas['date'] = [$strt,$end];
    $datas['event'] = array();
    $datas['areas'] = array();
    $datas['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
    $datas['event_fcu'] = $event_fcu->orderBy('id', 'ASC')->orderBy('fcuno', 'ASC')->findAll();
    if($client_id != '""' && $serv !='""'){
        $datas['all_events'] = $event->where('start_event BETWEEN "'. date('Y-m-d', strtotime($strt)). '" and "'. date('Y-m-d', strtotime($end)).'" AND client_id = "'.$client_id.'" AND serv_id = "'.$serv.'" AND status = "Pending"')->findAll();
    }elseif($serv !='""'){
        $datas['all_events'] = $event->where('start_event BETWEEN "'. date('Y-m-d', strtotime($strt)). '" and "'. date('Y-m-d', strtotime($end)).'" AND serv_id = "'.$serv.'" AND status = "Pending"')->findAll();
    }elseif($client_id !='""'){
        $datas['all_events'] = $event->where('start_event BETWEEN "'. date('Y-m-d', strtotime($strt)). '" and "'. date('Y-m-d', strtotime($end)).'" AND client_id = "'.$client_id.'" AND status = "Pending"')->findAll();
    }else{
        $datas['all_events'] = $event->where('start_event BETWEEN "'. date('Y-m-d', strtotime($strt)). '" and "'. date('Y-m-d', strtotime($end)).'"  AND status = "Pending" order By start_event')->findAll();
    }

    foreach ($datas['all_events'] as $key => $value) {
        array_push($datas['areas'],$value['area']);
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
    "title"=> $value['title'],
    "event_code"=>$value['event_code'],
    "start_event"=> $value['start_event'],
    "time"=> $value['TIME'],
    "serv_id"=> $value['serv_id'],
    "client_id"=>$value['client_id'],
    "area"=> $value['area'],
    "status"=> $value['STATUS'],
    "serv_name"=> $value['serv_name'],
    "serv_type"=>$value['serv_type'],
    "client_branch"=> $value['client_branch'],
    "emp_array"=> $emp_arr,
    "fcu_array"=> $fcu_arr,
    "price"=> $value['price'],
];
}

$datas['uniq_area'] = array_unique($datas['areas']);
// dd($datas['uniq_area']);

return view('admin/reports/exceptionPrint',$datas);

}
}

?>