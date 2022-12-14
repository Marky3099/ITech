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

        $datas['event'] = array();
        $datas['all_events'] = $event->orderBy('start_event', 'ASC')->where('status = "Done"')->findAll();
        // dd($data[0]['title']);
        $datas['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
        $datas['event_fcu'] = $event_fcu->orderBy('id', 'ASC')->orderBy('fcuno', 'ASC')->findAll();
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

$datas['main'] = 'admin/reports/accomplishedReports';
return view('templates/template',$datas);
}
public function getAccomplished(){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }
    $event = new All_events();
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

        $datas['event'] = array();
        $datas['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
        $datas['event_fcu'] = $event_fcu->orderBy('id', 'ASC')->orderBy('fcuno', 'ASC')->findAll();
        $datas['all_events'] = $event->orderBy('start_event', 'ASC')->where('status = "Done"')->findAll();
        // dd($data[0]['title']);
        
    
    if(isset($_GET['start_date']) && isset($_GET['to_date']))
    {
       $start_date = $_GET['start_date'];
       $to_date = $_GET['to_date'];

       $datas['all_events'] = $event->where('start_event BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($to_date)).'" and status = "Done"')->findAll();

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
public function printAccomplished($strt,$end){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }
    $session = session();
    $event = new All_events();
    $event_emp = new Event_emp_views();
    // $event_aircon = new Event_aircon_views();
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

    $datas['all_events'] = $event->where('start_event BETWEEN "'. date('Y-m-d', strtotime($strt)). '" and "'. date('Y-m-d', strtotime($end)).'"and status = "Done"')->findAll();

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
    // "aircon_id"=> $value['aircon_id'],
    "client_id"=>$value['client_id'],
    "area"=> $value['area'],
    "status"=> $value['STATUS'],
    "serv_name"=> $value['serv_name'],
    "serv_type"=>$value['serv_type'],
    // "aircon_array"=>$aircon_arr,
    // "device_array"=> $device_arr,
    // "quantity_array"=> $quantity_arr,
    // "total_quantity"=> array_sum($arr_quantity),
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
    $datas['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
    $datas['event_fcu'] = $event_fcu->orderBy('id', 'ASC')->orderBy('fcuno', 'ASC')->findAll();
    

    $datas['all_events'] = $event->orderBy('start_event', 'ASC')->where('status = "Pending"')->findAll();
        // dd($data[0]['title']);

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

    $db = \Config\Database::connect();
          $query   = $db->query('SELECT DISTINCT aircon_id,id,device_brand,aircon_type,quantity
            FROM event_fcu_views');
          $datas['distinct'] = $query->getResult();

    $db1 = \Config\Database::connect();
          $query   = $db1->query('SELECT DISTINCT id
            FROM event_fcu_views');
          $datas['distinct_event'] = $query->getResult();
    
    $datas['event'] = array();
    $datas['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
    $datas['event_fcu'] = $event_fcu->orderBy('id', 'ASC')->orderBy('fcuno', 'ASC')->findAll();
    //  $datas['event_aircon'] = $event_aircon->orderBy('id', 'ASC')->findAll();
    if(isset($_GET['start_date']) && isset($_GET['to_date']))
    {
        $start_date = $_GET['start_date'];
        $to_date = $_GET['to_date'];

        $datas['all_events'] = $event->where('start_event BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($to_date)).'" and status = "Pending"')->findAll();

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
public function printException($strt,$end){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }
    $session = session();
    $event = new All_events();
    $event_emp = new Event_emp_views();
    $event_fcu = new Event_fcu_views();
    // $event_aircon = new Event_aircon_views();
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
    $datas['all_events'] = $event->where('start_event BETWEEN "'. date('Y-m-d', strtotime($strt)). '" and "'. date('Y-m-d', strtotime($end)).'"and status = "Pending"')->findAll();

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
    "title"=> $value['title'],
    "event_code"=>$value['event_code'],
    "start_event"=> $value['start_event'],
    "time"=> $value['TIME'],
    "serv_id"=> $value['serv_id'],
    // "aircon_id"=> $value['aircon_id'],
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



return view('admin/reports/exceptionPrint',$datas);

}
}

?>