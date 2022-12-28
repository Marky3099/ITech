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

class CalllogsCrud extends Controller{

	// show Call log list
    public function index(){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
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
        $data['call_logs'] = $Call_logs->orderBy('cl_id', 'ASC')->findAll();
        $data['caller'] = $Call_logs->select('caller')->groupBy('caller', 'asc')->findAll();
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
        "aircon_id"=> $value['aircon_id'],
        "aircon_type"=> $value['aircon_type'],
        "device_brand"=> $value['device_brand'],
        "caller"=> $value['caller'],
        "particulars"=> $value['particulars'],
        "qty"=> $value['qty'],
        "status"=> $value['status'],
        "set_status"=> $value['set_status'],
        "fcu_arr"=> $fcu_arr,
    ];
}

$data['main'] = 'admin/calllogs/call_view';
return view("templates/template",$data);
}
public function getfilter(){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
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
    $data['cbranch'] ="";
    $data['client'] = $Client->orderBy('client_id', 'ASC')->findAll();
    $data['area'] = $Client->select('area')->groupBy('area')->findAll();
    $data['call_logs'] = $Call_logs->orderBy('cl_id', 'ASC')->findAll();
    $data['caller'] = $Call_logs->select('caller')->groupBy('caller', 'asc')->findAll();
    $data['fcu_no'] = $fcu_no->orderBy('fcuno', 'ASC')->findAll();
    $data['call_fcu'] = $Call_fcu->orderBy('cl_id', 'ASC')->findAll();
    $data['emp'] = $Emp->orderBy('emp_id', 'ASC')->findAll();
    $data['serv'] = $serv->orderBy('serv_id', 'ASC')->findAll();
    $data['servName'] = $serv->select('serv_name, serv_color, serv_type')->groupBy('serv_name')->findAll();
    $data['servType'] = $serv->orderBy('serv_name','ASC')->findAll();
    $data['aircon'] = $Aircon->orderBy('aircon_id', 'ASC')->findAll();
    $data['device_brand'] = $Aircon->select('device_brand')->groupBy('device_brand')->findAll();


    $date = new \DateTime();
    $date->setTimezone(new \DateTimeZone('+0800'));

    foreach($data['area'] as $k => $val) {

            $area = [];

            foreach($data['client'] as $key => $value) {
                if($val['area'] == $value['area']){
                  array_push($area , (object)[
                    'client_id' => (int)$value['client_id'],
                    'client_branch' =>$value['client_branch'],
                    "area" =>$value['area']
                ]);
              }

          }

          $data['client_area'][]= (object)[
            $val['area'] => $area
        ];
        // $datas['client_area2'][]=$area;
    }
    
    if(isset($_GET['start_date']) && isset($_GET['to_date']))
    {
        $start_date = $_GET['start_date'];
        $to_date = $_GET['to_date'];

        if(isset($_GET['caller_filter']) && !isset($_GET['client_id'])){
            $caller_filter = $_GET['caller_filter'];
            // $client_id = $_GET['client_id'];
            $data['calllogs_data'] = $Call_logs->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($to_date)).'" AND caller = "'.$caller_filter.'"')->findAll();
            // dd($data['calllogs_data']);
        }elseif(isset($_GET['client_id']) && !isset($_GET['caller_filter'])){
            $client_id = $_GET['client_id'];
            $data['cId'] = $_GET['client_id'];
            $data['cbranch'] = $Client->where('client_id', $client_id)->first();
            $data['calllogs_data'] = $Call_logs->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($to_date)).'" AND client_id = "'.$client_id.'"')->findAll();
            
        }elseif(isset($_GET['caller_filter']) && isset($_GET['client_id'])){
            $caller_filter = $_GET['caller_filter'];
            $client_id = $_GET['client_id'];
            $data['cId'] = $_GET['client_id'];
            $data['cbranch'] = $Client->where('client_id', $client_id)->first();
            $data['calllogs_data'] = $Call_logs->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($to_date)).'" AND client_id = "'.$client_id.'" AND caller = "'.$caller_filter.'"')->findAll();
        }else{
            $data['calllogs_data'] = $Call_logs->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($to_date)).'"')->findAll();
        }

        foreach ($data['calllogs_data'] as $key => $value) {
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
            "aircon_id"=> $value['aircon_id'],
            "aircon_type"=> $value['aircon_type'],
            "device_brand"=> $value['device_brand'],
            "caller"=> $value['caller'],
            "particulars"=> $value['particulars'],
            "qty"=> $value['qty'],
            "status"=> $value['status'],
            "set_status"=> $value['set_status'],
            "fcu_arr"=> $fcu_arr,
        ];
    }


}
$data['main'] = 'admin/calllogs/call_view';
return view('templates/template',$data);
}
public function printpdf($strt,$end,$call,$client_id){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }
    $session = session();
    $Call_logs = new Calllogs_views();
    $Client = new Client();
    $Aircon = new Aircon();
    $fcu_no = new Fcu_no();
    $Call_fcu = new Call_fcu_views();

    
    $data['date'] = [$strt,$end];

    $data['view_calllogs'] = [];
    $data['client'] = $Client->orderBy('client_id', 'ASC')->findAll();
    $data['area'] = $Client->select('area')->groupBy('area')->findAll();
    $data['call_logs'] = $Call_logs->orderBy('cl_id', 'ASC')->findAll();
    $data['fcu_no'] = $fcu_no->orderBy('fcuno', 'ASC')->findAll();
    $data['call_fcu'] = $Call_fcu->orderBy('cl_id', 'ASC')->findAll();
    $data['aircon'] = $Aircon->orderBy('aircon_id', 'ASC')->findAll();
    $data['device_brand'] = $Aircon->select('device_brand')->groupBy('device_brand')->findAll();

    if($client_id != '""' && $call !='""'){
        $data['calllogs_data'] = $Call_logs->where('date BETWEEN "'. date('Y-m-d', strtotime($strt)). '" and "'. date('Y-m-d', strtotime($end)).'" AND client_id = "'.$client_id.'" AND caller = "'.$call.'"')->findAll();
        // dd($datas['all_events']);
    }elseif($call !='""'){
        $data['calllogs_data'] = $Call_logs->where('date BETWEEN "'. date('Y-m-d', strtotime($strt)). '" and "'. date('Y-m-d', strtotime($end)).'" AND caller = "'.$call.'"')->findAll();
        // dd($datas['all_events']);
    }elseif($client_id !='""'){
        $data['calllogs_data'] = $Call_logs->where('date BETWEEN "'. date('Y-m-d', strtotime($strt)). '" and "'. date('Y-m-d', strtotime($end)).'" AND client_id = "'.$client_id.'"')->findAll();
        // dd($datas['all_events']);
    }else{
        $data['calllogs_data'] = $Call_logs->where('date BETWEEN "'. date('Y-m-d', strtotime($strt)). '" and "'. date('Y-m-d', strtotime($end)).'"')->findAll();
    }

    foreach ($data['calllogs_data'] as $key => $value) {
        $fcu_arr = "";
        foreach ($data['call_fcu'] as $key => $value_fcu) {
            if ( $value['cl_id'] == $value_fcu['cl_id']) {
             $fcu_arr .= $data['call_fcu'][$key]['fcu'].",";
         }
     }    
     $data['view_calllogs'][]= (object)[
        "cl_id"=> $value['cl_id'],
        "log_code"=> $value['log_code'],
        "date"=> $value['date'],
        "client_id"=> $value['client_id'],
        "area"=> $value['area'],
        "client_branch"=> $value['client_branch'],
        "aircon_id"=> $value['aircon_id'],
        "aircon_type"=> $value['aircon_type'],
        "device_brand"=> $value['device_brand'],
        "caller"=> $value['caller'],
        "particulars"=> $value['particulars'],
        "qty"=> $value['qty'],
        "status"=> $value['status'],
        "fcu_arr"=> $fcu_arr,
    ];
}



return view('admin/calllogs/callPrint',$data);

}
    // add Call log form
public function create(){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }
    $Client = new Client();
    $Aircon = new Aircon();
    $fcu_no = new Fcu_no();
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

    // insert data
public function store() {
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }
    $Call_logs = new Call_logs();
    $Client = new Client();
    $Aircon = new Aircon();
    $Call_fcu = new Call_fcu();
    $fcu_no = new Fcu_no();
    // dd($_POST);
    $start_date = explode('/',$_POST['date']);
    $calllog_create = [
        'date' => $start_date[2].'-'.$start_date[0].'-'.$start_date[1],
        'area' => $this->request->getVar('area'),
        'client_id' => $this->request->getVar('client_id'),
        'caller' => $this->request->getVar('caller'),
        'particulars' => $this->request->getVar('particulars'),
        'device_brand' => $this->request->getVar('device_brand'),
        'aircon_id' => $this->request->getVar('aircon_id'),
        'qty' => $this->request->getVar('qty'),
        'status' => $this->request->getVar('status')
    ];
    
    $success = $Call_logs->insert($calllog_create);

    foreach($this->request->getVar('fcuno') as $key => $value) {
        $Call_fcu->insert([
            'fcuno'=>(int) $value,
            'cl_id' => (int) $success
        ]);
    }
    $session = session();
    $session->setFlashdata('add', 'value');
    return "success" ;
    
}

    // show single call logs
public function singleCL($cl_id = null){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }
    $Call_logs = new Call_logs();
    $Client = new Client();
    $Aircon = new Aircon();
    $fcu_no = new Fcu_no();
    $Call_logs_view = new Calllogs_views();
    $Callfcu = new Call_fcu();
    $Call_fcu = new Call_fcu_views();
    $data['fcu_no'] = $fcu_no->orderBy('fcuno', 'ASC')->findAll();
    $data['call_fcu'] = $Call_fcu->orderBy('cl_id', 'ASC')->findAll();
    $data['aircon'] = $Aircon->orderBy('aircon_id', 'ASC')->findAll();
    $data['device_brand'] = $Aircon->select('device_brand')->groupBy('device_brand')->findAll();
    $data['cl_obj'] = $Call_logs->where('cl_id', $cl_id)->first();
    $data['area'] = $Client->select('area')->groupBy('area')->findAll();
    $data['client'] = $Client->orderBy('client_id', 'ASC')->findAll();
    $data['cl_views'] = $Call_logs_view->where('cl_id', $cl_id)->first();
    $data['fcu_views'] = $Call_fcu->where('cl_id', $cl_id)->findAll();
    $data['date_format'] = explode('-',$data['cl_obj']['date']);
    $data['new_date'] = $data['date_format'][1].'-'.$data['date_format'][2].'-'.$data['date_format'][0];
    // dd($data['new_date'] );
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

$data['main'] = 'admin/calllogs/call_edit';
return view("templates/template",$data);
}

    // update Call log data
public function update(){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
        return $this->response->redirect(site_url('/dashboard'));
    }
    
    $Call_logs = new Call_logs();
    
    $Call_fcu = new Call_fcu();
    $Client = new Client();
    $Aircon = new Aircon();

    $cl_id = $this->request->getVar('cl_id');
    $start_date = explode('/',$_POST['date']);
        // $data['aircon'] = $Aircon->orderBy('aircon_id', 'ASC')->findAll();
        // $data['device_brand'] = $Aircon->select('device_brand')->groupBy('device_brand')->findAll();
    $data = [
        'date' => $start_date[2].'-'.$start_date[0].'-'.$start_date[1],
        'area' => $this->request->getVar('area'),
        'aircon_id' => (int)($this->request->getVar('aircon_id_update')),
        'client_id'  => (int)($this->request->getVar('client_id_update')),
        'caller' => $this->request->getVar('caller'),
        'particulars' => $this->request->getVar('particulars'),
        'device_brand' => $this->request->getVar('device_brand'),
        'qty' => $this->request->getVar('qty'),
        // 'status' => $this->request->getVar('status')
    ];
    // dd($data);
    $Call_logs->update($cl_id, $data);
    $Call_fcu->where('cl_id', $cl_id)->delete();
    if (isset($_POST['fcuno_update'])) {
        foreach($_POST['fcuno_update'] as $key => $value) {
            $Call_fcu->insert([
                'fcuno'=>(int)$value,
                'cl_id' => $cl_id
            ]);
        }
    }
    $session = session();
    $session->setFlashdata('update', 'value');
    return $this->response->redirect(site_url('/calllogs'));
}

    // delete Call log info
public function delete($cl_id = null){
    if($_SESSION['position'] != USER_ROLE_ADMIN){
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
    // $Emp = new Event_emp_views();
    $Serv = new Serv();
    $id = $this->request->getPost('cl_id');
    $data['cl_data'] = $Call_logs->where('cl_id',$id)->first();
    $data['fcu_data'] = $Fcu->where('cl_id',$id)->findAll();
    $data['client_data'] = $Client->orderBy('client_id','ASC')->findAll();
    // $data['serv_data'] = $Serv->orderBy('serv_id','ASC')->findAll();

    return $this->response->setJSON($data);

}

}


?>