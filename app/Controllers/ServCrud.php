<?php 
namespace App\Controllers;
use App\Models\Serv;
use CodeIgniter\Controller;

class ServCrud extends Controller
{
    // show Service list
    public function index(){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Serv = new Serv();
        $data['services'] = $Serv->orderBy('serv_name', 'ASC')->findAll();
        $data['ServName'] = $Serv->select('serv_name')->groupBy('serv_name')->findAll();
        $data['main'] = 'admin/serv/serv_view';
        return view("templates/template",$data);

    }

    // add Service form
    public function create(){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $data['main'] = 'admin/serv/serv_add';
        $data['error'] = null;
        return view("templates/template",$data);
    }
    
    // insert data
    public function store() {
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Serv = new Serv();
        $service = $Serv->orderBy('serv_name', 'ASC')->findAll();
        $ServName = ucfirst(strtolower($this->request->getVar('serv_name')));
        foreach($service as $serv){
            if($ServName == $serv['serv_name']){
                $serv_create = [
                    'serv_name' => $ServName,
                    'serv_type' => $this->request->getVar('serv_type'),
                    'serv_description' => $this->request->getVar('serv_description'),
                    'price' => $this->request->getVar('price'),
                    'serv_color' => $serv['serv_color'],
                ];
            }else{
                $serv_create = [
                    'serv_name' => $ServName,
                    'serv_type' => $this->request->getVar('serv_type'),
                    'serv_description' => $this->request->getVar('serv_description'),
                    'price' => $this->request->getVar('price'),
                    'serv_color' => $this->request->getVar('serv_color'),
                ];
            }
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
        $data['Serv_obj'] = $Serv->where('serv_id', $serv_id)->first();
        $data['main'] = 'admin/serv/serv_edit';
        return view("templates/template",$data);
    }

    // update Service data
    public function update(){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Serv = new Serv();
        $serv_id = $this->request->getVar('serv_id');
        $service = $Serv->orderBy('serv_name', 'ASC')->findAll();
        $ServName = ucfirst(strtolower($this->request->getVar('serv_name')));
        foreach($service as $serv){
            if($ServName == $serv['serv_name']){
                $data = [
                    'serv_name' => $ServName,
                    'serv_type' => $this->request->getVar('serv_type'),
                    'serv_description' => $this->request->getVar('serv_description'),
                    'price' => $this->request->getVar('price'),
                    'serv_color' => $serv['serv_color'],
                ];
            }else{
                $data = [
                    'serv_name' => $ServName,
                    'serv_type' => $this->request->getVar('serv_type'),
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
        $data['serv'] = $Serv->orderBy('serv_name', 'ASC')->findAll();
        foreach ($data['serv'] as $key => $value) {
            $data['service'][]=(object)[
                "serv_name"=>$value['serv_name'],
                "serv_type"=>$value['serv_type'],
                "serv_description"=>$value['serv_description'],
                "price"=>$value['price'],
            ];
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
}