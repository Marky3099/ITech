<?php 
namespace App\Controllers;
use App\Models\Aircon;
use CodeIgniter\Controller;

class AirconCrud extends Controller
{

    public function index(){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Aircon = new Aircon();
        $data['device'] = $Aircon->orderBy('aircon_id', 'ASC')->findAll();
        $data['main'] = 'aircon/aircon_view';
        return view("dashboard/template",$data);

    }

    // add Client form
    public function create(){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
         $data['main'] = 'aircon/aircon_add';
          $data['error'] = null;
        return view("dashboard/template",$data);
    }
 
    // insert data
    public function store() {
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Aircon = new Aircon();
        $brandFirst = ucfirst(strtolower($this->request->getVar('device_brand')));
        $airconFirst = ucfirst(strtolower($this->request->getVar('aircon_type')));
        $aircon_create = [
            'device_brand' => $brandFirst,
            'aircon_type' => $airconFirst,
        ];
        $Aircon->insert($aircon_create);
        $session = session();
        $session->setFlashdata('add', 'value');
        return $this->response->redirect(site_url('/aircon'));
    }

    // show single Client
    public function singleAircon($aircon_id = null){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Aircon = new Aircon();
        $data['Aircon_obj'] = $Aircon->where('aircon_id', $aircon_id)->first();
        $data['main'] = 'aircon/aircon_edit';
        return view("dashboard/template",$data);
    }

    // update Client data
    public function update(){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Aircon = new Aircon();
        $aircon_id = $this->request->getVar('aircon_id');
        $brandFirst = ucfirst(strtolower($this->request->getVar('device_brand')));
        $airconFirst = ucfirst(strtolower($this->request->getVar('aircon_type')));
        $data = [
            'device_brand' => $brandFirst,
            'aircon_type' => $airconFirst,
        ];
        $Aircon->update($aircon_id, $data);
        $session = session();
        $session->setFlashdata('update', 'value');
        return $this->response->redirect(site_url('/aircon'));
    }
 
    // delete Client
    public function delete($aircon_id = null){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Aircon = new Aircon();
        $data['device'] = $Aircon->where('aircon_id', $aircon_id)->delete($aircon_id);
        $session = session();
        $session->setFlashdata('msg', 'value');
        return $this->response->redirect(site_url('/aircon'));
    }    
}