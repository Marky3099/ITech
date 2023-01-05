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

        $datas['event'] = array();
        $datas['cId'] ="";
        $datas['cbranch']="";
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

     $datas['event'][]= (object)[
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
public function getAccomplished(){
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

        $datas['event'] = array();
        $datas['cId'] ="";
        $datas['cbranch'] ="";
        $datas['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
        $datas['servName'] = $serv->select('serv_name, serv_color, serv_type')->groupBy('serv_name')->findAll();
        $datas['servType'] = $serv->orderBy('serv_name','ASC')->findAll();
        $datas['client'] = $client->orderBy('client_id', 'ASC')->findAll();
        $datas['area'] = $client->select('area, client_id')->groupBy('area')->findAll();
        $datas['event_fcu'] = $event_fcu->orderBy('id', 'ASC')->orderBy('fcuno', 'ASC')->findAll();
        $datas['all_events'] = $event->orderBy('start_event', 'ASC')->where('status = "Done"')->findAll();
        // dd($data[0]['title']);
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
            $datas['all_events'] = $event->where('start_event BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($to_date)).'" AND serv_id = "'.$serv_id.'" AND status = "Done"')->findAll();
        }elseif(isset($_GET['client_id']) && !isset($_GET['serv'])){
            $client_id = $_GET['client_id'];
            $datas['cId'] = $_GET['client_id'];
            $datas['cbranch'] = $client->where('client_id', $client_id)->first();
            $datas['all_events'] = $event->where('start_event BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($to_date)).'" AND client_id = "'.$client_id.'" AND status = "Done"')->findAll();
            
        }elseif(isset($_GET['serv']) && isset($_GET['client_id'])){
            $serv_id = $_GET['serv'];
            $client_id = $_GET['client_id'];
            $datas['cId'] = $_GET['client_id'];
            $datas['cbranch'] = $client->where('client_id', $client_id)->first();
            $datas['all_events'] = $event->where('start_event BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($to_date)).'" AND client_id = "'.$client_id.'" AND serv_id = "'.$serv_id.'" AND status = "Done"')->findAll();
            
        }else{
            $datas['all_events'] = $event->where('start_event BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($to_date)).'" AND status = "Done"')->findAll();
        }

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
                // "aircon_array"=>$aircon_arr,
                // "device_array"=> $device_arr,
                // "quantity_array"=> $quantity_arr,
                "area"=> $value['area'],
                "emp_array"=> $emp_arr,
                "fcu_array"=> $fcu_arr,
                "client_branch"=> $value['client_branch'],
                "price"=> $value['price'],
                "status"=> $value['STATUS'],
            ];
        }


    }
    $datas['main'] = 'admin/reports/accomplishedReports';
    return view('templates/template',$datas);
}
public function printAccomplished($strt,$end,$serv,$client_id){
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
    $datas['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
    $datas['event_fcu'] = $event_fcu->orderBy('id', 'ASC')->orderBy('fcuno', 'ASC')->findAll();
    // $datas['event_aircon'] = $event_aircon->orderBy('id', 'ASC')->findAll();

    if($client_id != '""' && $serv !='""'){
        $datas['all_events'] = $event->where('start_event BETWEEN "'. date('Y-m-d', strtotime($strt)). '" and "'. date('Y-m-d', strtotime($end)).'" AND client_id = "'.$client_id.'" AND serv_id = "'.$serv.'" AND status = "Done"')->findAll();
        // dd($datas['all_events']);
    }elseif($serv !='""'){
        $datas['all_events'] = $event->where('start_event BETWEEN "'. date('Y-m-d', strtotime($strt)). '" and "'. date('Y-m-d', strtotime($end)).'" AND serv_id = "'.$serv.'" AND status = "Done"')->findAll();
        // dd($datas['all_events']);
    }elseif($client_id !='""'){
        $datas['all_events'] = $event->where('start_event BETWEEN "'. date('Y-m-d', strtotime($strt)). '" and "'. date('Y-m-d', strtotime($end)).'" AND client_id = "'.$client_id.'" AND status = "Done"')->findAll();
        // dd($datas['all_events']);
    }else{
        $datas['all_events'] = $event->where('start_event BETWEEN "'. date('Y-m-d', strtotime($strt)). '" and "'. date('Y-m-d', strtotime($end)).'"  AND status = "Done" order By start_event')->findAll();
    }

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



return view('admin/reports/accomplishedPrint',$datas);

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
    
    $datas['event'] = array();
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

  $datas['event'][]= (object)[
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