<?php 
namespace App\Controllers;
use App\Models\Serv;
use App\Models\Aircon;
use CodeIgniter\Controller;

class ServCrud extends Controller
{
    // show Service list
    public function index(){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Serv = new Serv();
        $Aircon = new Aircon();
        $data['services'] = $Serv->orderBy('serv_name', 'ASC')->findAll();
        $data['aircon'] = $Aircon->orderBy('device_brand', 'ASC')->findAll();
        $data['ServName'] = $Serv->select('serv_name')->groupBy('serv_name')->findAll();
        $data['main'] = 'admin/serv/serv_view';
        return view("templates/template",$data);

    }

    // add Service form
    public function create(){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Aircon = new Aircon();
        $data['aircon'] = $Aircon->groupBy('device_brand', 'ASC')->findAll();
        $data['main'] = 'admin/serv/serv_add';
        $data['error'] = null;
        return view("templates/template",$data);
    }
    
    // insert data
    public function store() {
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        // dd($_POST);
        $Serv = new Serv();
        $ServName = ucwords(strtolower($this->request->getVar('serv_name')));
        $service = $Serv->where('serv_name', $ServName)->findAll();
        // dd($service);
        if($service){
            foreach($service as $serv){
            if($ServName == $serv['serv_name']){
                $serv_create = [
                    'serv_name' => $ServName,
                    'serv_type' => $this->request->getVar('serv_type'),
                    'aircon_id' => $this->request->getVar('aircon_id'),
                    'serv_description' => $this->request->getVar('serv_description'),
                    'price' => $this->request->getVar('price'),
                    'serv_color' => $serv['serv_color'],
                ];
                $Serv->insert($serv_create);
                $session = session();
                $session->setFlashdata('add', 'value');
                return $this->response->redirect(site_url('/serv'));
            }else{
                // dd($ServName == $serv['serv_name']);
                $serv_create = [
                    'serv_name' => $ServName,
                    'serv_type' => $this->request->getVar('serv_type'),
                    'aircon_id' => $this->request->getVar('aircon_id'),
                    'serv_description' => $this->request->getVar('serv_description'),
                    'price' => $this->request->getVar('price'),
                    'serv_color' => $this->request->getVar('serv_color'),
                ];
            }
        }
        }else{
            // dd('napasok');
            $serv_create = [
                'serv_name' => $ServName,
                'serv_type' => $this->request->getVar('serv_type'),
                'aircon_id' => $this->request->getVar('aircon_id'),
                'serv_description' => $this->request->getVar('serv_description'),
                'price' => $this->request->getVar('price'),
                'serv_color' => $this->request->getVar('serv_color'),
            ];
        }
        
        $Serv->insert($serv_create);
        $session = session();
        $session->setFlashdata('add', 'value');
        return $this->response->redirect(site_url('/serv'));
    }

    // show single Service
    public function singleServ($serv_id = null){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Serv = new Serv();
        $Aircon = new Aircon();
        $data['Serv_obj'] = $Serv->where('serv_id', $serv_id)->first();
        // dd($data['Serv_obj']);
        $airconId = $data['Serv_obj']['aircon_id'];
        $data['aircon'] = $Aircon->orderBy('device_brand', 'ASC')->findAll();
        $data['device_brand'] = $Aircon->select('device_brand')->groupBy('device_brand')->findAll();
        $data['airconSelected'] = $Aircon->where('aircon_id', $airconId)->first();
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
        $data['main'] = 'admin/serv/serv_edit';
        return view("templates/template",$data);
    }

    // update Service data
    public function update(){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        // dd($_POST);
        $Serv = new Serv();
        $serv_id = $this->request->getVar('serv_id');
        $service = $Serv->orderBy('serv_name', 'ASC')->findAll();
        $ServName = ucfirst(strtolower($this->request->getVar('serv_name')));
        foreach($service as $serv){
            if($ServName == $serv['serv_name']){
                $data = [
                    'serv_name' => $ServName,
                    'serv_type' => $this->request->getVar('serv_type'),
                    'aircon_id' => $this->request->getVar('aircon_id'),
                    'serv_description' => $this->request->getVar('serv_description'),
                    'price' => $this->request->getVar('price'),
                    'serv_color' => $serv['serv_color'],
                ];
                $Serv->update($serv_id, $data);
                $session = session();
                $session->setFlashdata('update', 'value');
                return $this->response->redirect(site_url('/serv'));
            }else{
                $data = [
                    'serv_name' => $ServName,
                    'serv_type' => $this->request->getVar('serv_type'),
                    'aircon_id' => $this->request->getVar('aircon_id'),
                    'serv_description' => $this->request->getVar('serv_description'),
                    'price' => $this->request->getVar('price'),
                    'serv_color' => $this->request->getVar('serv_color'),
                ];
            }
        }
        $Serv->update($serv_id, $data);
        $session = session();
        $session->setFlashdata('update', 'value');
        return $this->response->redirect(site_url('/serv'));
    }
    public function printServ(){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Serv = new Serv();
        $Aircon = new Aircon();
        $data['serv'] = $Serv->orderBy('serv_name', 'ASC')->findAll();
        $data['aircon'] = $Aircon->orderBy('device_brand', 'ASC')->findAll();
        foreach ($data['serv'] as $key => $value) {
            foreach ($data['aircon'] as $k => $v) {
                if($v['aircon_id'] == $value['aircon_id'] ){
                    $data['service'][]=(object)[
                        "serv_name"=>$value['serv_name'],
                        "serv_type"=>$value['serv_type'],
                        "device_brand"=>$v['device_brand'],
                        "aircon_type"=>$v['aircon_type'],
                        "serv_description"=>$value['serv_description'],
                        "price"=>$value['price'],
                    ];
                } 
            }
        }
        return view('admin/serv/servReports',$data);
        
    }
    // delete Service
    public function delete($serv_id = null){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Serv = new Serv();
        $data['Serv'] = $Serv->where('serv_id', $serv_id)->delete($serv_id);
        $session = session();
        $session->setFlashdata('msg', 'value');
        return $this->response->redirect(site_url('/serv'));
    }
    public function airconType(){
        $Aircon = new Aircon();
        $brand = $_GET['brand'];

        $data['aircon'] = $Aircon->where('device_brand', $brand)->findAll();
        return $this->response->setJSON($data);
    }    
}