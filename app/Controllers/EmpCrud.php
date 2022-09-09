<?php 
namespace App\Controllers;
use App\Models\Emp;
use CodeIgniter\Controller;

class EmpCrud extends Controller
{
    // show employees list
    public function index(){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Emp = new Emp();
        $data['employees'] = $Emp->orderBy('emp_id', 'ASC')->findAll();
        $data['main'] = 'emp/emp_view';
        return view("dashboard/template",$data);

    }

    // add Emp form
    public function create(){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
         $data['main'] = 'emp/emp_add';
          $data['error'] = null;
        return view("dashboard/template",$data);
    }
 
    // insert data
    public function store() {
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Emp = new Emp();
        $emp_data = $Emp->where('emp_email', $this->request->getVar('emp_email'))->first();
        $employeeName = ucfirst(strtolower($this->request->getVar('emp_name')));
        if ($emp_data) {
            $data['error'] = "email existed!";
            $data['main'] = 'emp/emp_add';
            return view("dashboard/template",$data);
        }
        $emp_create = [
            'emp_name' => $employeeName,
            'emp_email'  => $this->request->getVar('emp_email'),
            'emp_address' => $this->request->getVar('emp_address'),
            'emp_contact'  => $this->request->getVar('emp_contact'),
            'emp_position' => $this->request->getVar('emp_position'),
            
        ];
        if($Emp->insert($emp_create)){
            session()->setFlashdata('message', 'Employee Added!');
        }
        return $this->response->redirect(site_url('/emp'));
    }

    // show single Emp
    public function singleEmp($emp_id = null){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Emp = new Emp();
        $data['Emp_obj'] = $Emp->where('emp_id', $emp_id)->first();
        $data['main'] = 'emp/emp_edit';
        return view("dashboard/template",$data);
    }

    // update Emp data
    public function update(){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Emp = new Emp();
        $emp_id = $this->request->getVar('emp_id');
        $employeeName = ucfirst(strtolower($this->request->getVar('emp_name')));
        $data = [
            'emp_name' => $employeeName,
            'emp_email'  => $this->request->getVar('emp_email'),
            'emp_address' => $this->request->getVar('emp_address'),
            'emp_contact'  => $this->request->getVar('emp_contact'),
            'emp_position' => $this->request->getVar('emp_position'),
        ];
        $Emp->update($emp_id, $data);
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
        return view('emp/empReports',$data);
        
    }
    // delete Emp
    public function delete($emp_id = null){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Emp = new Emp();
        $data['Emp'] = $Emp->where('emp_id', $emp_id)->delete($emp_id);
        return $this->response->redirect(site_url('/emp'));
    }    
}