<?php 
namespace App\Controllers;
use App\Models\Emp;
use App\Models\Serv;
use App\Models\Emp_expertise;
use App\Models\Emp_expertise_views;
use CodeIgniter\Controller;

class EmpCrud extends Controller
{
    // show employees list
    public function index(){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Emp = new Emp();
        $Expertise = new Emp_expertise_views();
        $data['employees'] = $Emp->orderBy('emp_id', 'ASC')->findAll();
        $data['expertise'] = $Expertise->orderBy('emp_id', 'ASC')->findAll();
        // dd($data['expertise']);
        $data['main'] = 'admin/emp/emp_view';
        return view("templates/template",$data);

    }

    // add Emp form
    public function create(){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $serv = new Serv();
        $data['service'] = $serv->groupBy('serv_name','ASC')->findAll();

        $data['main'] = 'admin/emp/emp_add';
        $data['error'] = null;
        return view("templates/template",$data);
    }
    
    // insert data
    public function store() {
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Emp = new Emp();
        $Expertise = new Emp_expertise();
        $session = session();
        $emp_data = $Emp->where('emp_email', $this->request->getVar('emp_email'))->first();
        $employeeName = ucwords(strtolower($this->request->getVar('emp_name')));
        if ($emp_data) {
            $session->setFlashdata('emailExist', 'value');
            return $this->response->redirect(site_url('/emp/create/view'));
        }
        $emp_create = [
            'emp_name' => $employeeName,
            'emp_email'  => $this->request->getVar('emp_email'),
            'emp_address' => $this->request->getVar('emp_address'),
            'emp_contact'  => $this->request->getVar('emp_contact'),
            'emp_position' => 'Employee',
            
        ];
        $success = $Emp->insert($emp_create);
        if($success){
            foreach($_POST['emp_expertise'] as $key => $value) {
                $Expertise->insert([
                    'serv_id'=> (int) $value,
                    'emp_id' => (int) $success,
                ]);
            }
        }
        
        $session->setFlashdata('add', 'value');
        return $this->response->redirect(site_url('/emp'));
    }

    // show single Emp
    public function singleEmp($emp_id = null){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Emp = new Emp();
        $serv = new Serv();
        $expertise = new Emp_expertise_views();
        $data['service'] = $serv->groupBy('serv_name','ASC')->findAll();
        $data['expertise'] = $expertise->where('emp_id',$emp_id)->findAll();
        // dd($data['service']);
        $data['Emp_obj'] = $Emp->where('emp_id', $emp_id)->first();
        $data['main'] = 'admin/emp/emp_edit';
        return view("templates/template",$data);
    }

    // update Emp data
    public function update(){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Emp = new Emp();
        $Expertise = new Emp_expertise();
        $emp_id = $this->request->getVar('emp_id');
        $employeeName = ucwords(strtolower($this->request->getVar('emp_name')));
        $data = [
            'emp_name' => $employeeName,
            'emp_email'  => $this->request->getVar('emp_email'),
            'emp_address' => $this->request->getVar('emp_address'),
            'emp_contact'  => $this->request->getVar('emp_contact'),
            // 'emp_position' => $this->request->getVar('emp_position'),
        ];
        $success = $Emp->update($emp_id, $data);
        if($success){
            foreach($_POST['emp_expertise'] as $key => $value) {
                $Expertise->insert([
                    'serv_id'=> (int) $value,
                    'emp_id' => (int) $emp_id,
                ]);
            }
        }
        $session = session();
        $session->setFlashdata('update', 'value');
        return $this->response->redirect(site_url('/emp'));
    }
    public function printEmp(){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Emp = new Emp();
        $data['emp'] = $Emp->orderBy('emp_id', 'ASC')->findAll();
        foreach ($data['emp'] as $key => $value) {
            $data['employee'][]=(object)[
                "emp_name"=>$value['emp_name'],
                "emp_email"=>$value['emp_email'],
                "emp_address"=>$value['emp_address'],
                "emp_contact"=>$value['emp_contact'],
                "emp_position"=>$value['emp_position'],
            ];
        }
        return view('admin/emp/empReports',$data);
        
    }
    // delete Emp
    public function delete($emp_id = null){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Emp = new Emp();
        $data['Emp'] = $Emp->where('emp_id', $emp_id)->delete($emp_id);
        $session = session();
        $session->setFlashdata('msg', 'value');
        return $this->response->redirect(site_url('/emp'));
    }    
}