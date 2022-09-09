<?php
namespace App\Controllers;
use App\Models\Call_logs;
use CodeIgniter\Controller;
use App\Models\Client;
use App\Models\Aircon;
use App\Models\Calllogs_views;
use App\Models\Fcu_no;
use App\Models\Call_fcu;
use App\Models\Call_fcu_views;

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

        $data['view_calllogs'] = [];
        $data['client'] = $Client->orderBy('client_id', 'ASC')->findAll();
        $data['area'] = $Client->select('area')->groupBy('area')->findAll();
        $data['call_logs'] = $Call_logs->orderBy('cl_id', 'ASC')->findAll();
        $data['fcu_no'] = $fcu_no->orderBy('fcuno', 'ASC')->findAll();
        $data['call_fcu'] = $Call_fcu->orderBy('cl_id', 'ASC')->findAll();
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
        
        $data['main'] = 'calllogs/call_view';
        return view("dashboard/template",$data);
    }

    // add Call log form
    public function create(){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Client = new Client();
        $Aircon = new Aircon();
        $fcu_no = new Fcu_no();

        $data['fcu_no'] = $fcu_no->orderBy('fcuno', 'ASC')->findAll();
        $data['client'] = $Client->orderBy('client_id', 'ASC')->findAll();
        $data['area'] = $Client->select('area')->groupBy('area')->findAll();
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

         $data['main'] = 'calllogs/call_add';
          $data['error'] = null;
        return view("dashboard/template",$data);
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

        $calllog_create = [
            'date' => $this->request->getVar('date'),
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

        $data['main'] = 'calllogs/call_edit';
        return view("dashboard/template",$data);
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

        // $data['aircon'] = $Aircon->orderBy('aircon_id', 'ASC')->findAll();
        // $data['device_brand'] = $Aircon->select('device_brand')->groupBy('device_brand')->findAll();
        $data = [
            'date' => $this->request->getVar('date'),
            'area' => $this->request->getVar('area'),
            'aircon_id' => (int)($this->request->getVar('aircon_id_update')),
            'client_id'  => (int)($this->request->getVar('client_id_update')),
            'caller' => $this->request->getVar('caller'),
            'particulars' => $this->request->getVar('particulars'),
            'device_brand' => $this->request->getVar('device_brand'),
            'qty' => $this->request->getVar('qty'),
            'status' => $this->request->getVar('status')
        ];
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
        return $this->response->redirect(site_url('/calllogs'));
    }

    // delete Call log info
    public function delete($cl_id = null){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Call_logs = new Call_logs();
        $data['Call_logs'] = $Call_logs->where('cl_id', $cl_id)->delete($cl_id);
        return $this->response->redirect(site_url('/calllogs'));
    }
}


?>