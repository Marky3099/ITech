<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Appointment;
use App\Models\view_appointment;
use App\Models\Client;
use App\Models\Aircon;
use App\Models\Fcu_no;
use App\Models\Serv;
use App\Models\Appt_fcu;

class AppointmentCrud extends Controller
{

    public function index(){
        $Client = new Client();
        $Aircon = new Aircon();
        $fcu_no = new Fcu_no();
        $Serv = new Serv();
        $Appoint = new view_appointment();
        $Apptfcu = new Appt_fcu();

        $data['view_appoint'] =[];
        $data['fcu_no'] = $fcu_no->orderBy('fcuno', 'ASC')->findAll();
        $data['appoint'] = $Appoint->orderBy('appt_id', 'ASC')->findAll();
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
            $fcu_arr = "";
                foreach ($data['appoint'] as $key => $value_fcu) {
                    if ( $value['appt_id'] == $value_fcu['appt_id']) {
                       $fcu_arr .= $data['appoint'][$key]['fcu'].",";
                    }
                }    
            $data['view_appoint'][]= (object)[
                "appt_date"=> $value['appt_date'],
                "appt_time"=> $value['appt_time'],
                "client_id"=> $value['client_id'],
                "serv_name" =>$value['serv_name'],
                "area"=> $value['area'],
                "client_branch"=> $value['client_branch'],
                "aircon_id"=> $value['aircon_id'],
                "aircon_type"=> $value['aircon_type'],
                "device_brand"=> $value['device_brand'],
                "qty"=> $value['qty'],
                "appt_status"=> $value['appt_status'],
                "fcu_arr"=> $fcu_arr,
            ];
        }

        $data['main'] = 'appointment/appointment_view';
        return view("dashboard/template",$data);

    }

    public function create(){
        $Client = new Client();
        $Aircon = new Aircon();
        $fcu_no = new Fcu_no();
        $Serv = new Serv();

        $data['fcu_no'] = $fcu_no->orderBy('fcuno', 'ASC')->findAll();
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

        
        $data['main'] = 'appointment/appointment_add';
        return view("dashboard/template",$data);
    }
    public function store() {
        
        $Appoint = new Appointment();
        $Appt_fcu = new Appt_fcu();
        $Client = new Client();
        $Aircon = new Aircon();
        $fcu_no = new Fcu_no();
        $Serv = new Serv();

        $appoint_create = [
            'appt_date' => $this->request->getVar('appt_date'),
            'appt_time' => $this->request->getVar('appt_time'),
            'area' => $this->request->getVar('area'),
            'serv_id' => $this->request->getVar('serv_id'),
            'client_id' => $this->request->getVar('client_id'),
            'device_brand' => $this->request->getVar('device_brand'),
            'aircon_id' => $this->request->getVar('aircon_id'),
            'qty' => $this->request->getVar('qty'),
            'status' => $this->request->getVar('status')
        ];
        
        $success = $Appoint->insert($appoint_create);
        foreach($this->request->getVar('fcuno') as $key => $value) {
            $Appt_fcu->insert([
                'fcuno'=>(int) $value,
                'appt_id' => (int) $success
            ]);
        }

           return $this->response->redirect(site_url('/appointment'));

    }
}