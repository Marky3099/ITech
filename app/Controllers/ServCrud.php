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
        $data['services'] = $Serv->orderBy('serv_id', 'ASC')->findAll();
        $data['main'] = 'serv/serv_view';
        return view("dashboard/template",$data);

    }

    // add Service form
    public function create(){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
         $data['main'] = 'serv/serv_add';
          $data['error'] = null;
        return view("dashboard/template",$data);
    }
 
    // insert data
    public function store() {
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Serv = new Serv();
        $ServName = ucfirst(strtolower($this->request->getVar('serv_name')));
        $serv_create = [
            'serv_name' => $ServName,
            'serv_description' => $this->request->getVar('serv_description'),
            'price' => $this->request->getVar('price'),
            'serv_color' => $this->request->getVar('serv_color'),
        ];
        $Serv->insert($serv_create);
        $data['success'] ="Service added";
        return $this->response->redirect(site_url('/serv'));
    }

    // show single Service
    public function singleServ($serv_id = null){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Serv = new Serv();
        $data['Serv_obj'] = $Serv->where('serv_id', $serv_id)->first();
        $data['main'] = 'serv/serv_edit';
        return view("dashboard/template",$data);
    }

    // update Service data
    public function update(){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Serv = new Serv();
        $serv_id = $this->request->getVar('serv_id');
        $ServName = ucfirst(strtolower($this->request->getVar('serv_name')));
        $data = [
            'serv_name' => $ServName,
            'serv_description' => $this->request->getVar('serv_description'),
            'price' => $this->request->getVar('price'),
            'serv_color' => $this->request->getVar('serv_color'),
        ];
        $Serv->update($serv_id, $data);
        return $this->response->redirect(site_url('/serv'));
    }
    public function printServ(){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Serv = new Serv();
        $data['serv'] = $Serv->orderBy('serv_id', 'ASC')->findAll();
        foreach ($data['serv'] as $key => $value) {
            $data['service'][]=(object)[
                "serv_name"=>$value['serv_name'],
                "serv_description"=>$value['serv_description'],
                "price"=>$value['price'],
            ];
        }
        return view('serv/servReports',$data);
        
    }
    // delete Service
    public function delete($serv_id = null){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Serv = new Serv();
        $data['Serv'] = $Serv->where('serv_id', $serv_id)->delete($serv_id);
        return $this->response->redirect(site_url('/serv'));
    }    
}