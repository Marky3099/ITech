<?php 
namespace App\Controllers;
use App\Models\User;
use App\Models\Emp;
use App\Models\User_bdo;
use CodeIgniter\Controller;
use App\Libraries\Phpmailer_lib;

class UsersCrud extends Controller
{
    // show User list
    public function index(){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $User = new User();
        $data['users'] = $User->orderBy('user_id', 'ASC')->findAll();

        $UserClient = new User_bdo();
        $data['usersClient'] = $UserClient->orderBy('bdo_id', 'ASC')->findAll();
        
        $data['main'] = 'admin/user/user_view';
        return view("templates/template",$data);
    }

    // add User form
    public function create(){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Emp = new Emp();
        $data['emp'] = $Emp->orderBy('emp_id', 'ASC')->findAll();
        $data['main'] = 'admin/user/user_add';
        $data['error'] = null;
        return view("templates/template",$data);
    }
    
    // insert data
    public function store() {
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $User = new User();
        $session = session();
        $user_data = $User->where('email', $this->request->getVar('email'))->first();
        if ($user_data) {
            $session->setFlashdata('emailExist', 'value');
            return $this->response->redirect(site_url('/user/create/view'));
        }
        // Generate Random Password
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_?";
        $password = substr( str_shuffle( $chars ), 0, 8 );
        $Username = ucfirst(strtolower($this->request->getVar('name')));
        $user_create = [
            'name' => $Username,
            'email'  => $this->request->getVar('email'),
            'address' => $this->request->getVar('address'),
            'contact'  => $this->request->getVar('contact'),
            'position' => $this->request->getVar('position'),
            'emp_id' => $this->request->getVar('emp_id'),
            // 'code' => $code,
            'active' => false,
            'password' => password_hash($password, PASSWORD_DEFAULT)
            
        ];
        // dd($user_create);
        $id = $User->insert($user_create);
        $session->setFlashdata('add', 'value');
        
        $to = $this->request->getVar('email');

        $subject = "MARSI: Task and Schedule Monitoring System - Account Activation";
        $message = "<html>
        <head>
        <title>Welcome to MARSI: Task and Schedule Monitoring System!</title>
        </head>
        <body><br>
        <p>You may now login to your account using the following.</p><br>
        <h3><b>Email: ".$to."</h3>
        <h3><b>Password: ".$password."</h3><br>
        <h3><a href=".base_url('/user-type').">Login Now</a></h3>
        <br>
        <p>Thank you!</p>
        <br>
        <p>Regards,</p>
        <p>Management</p>
        <p>Maylaflor Air-Conditioning and Refrigeration Service, Inc.</p>
        </body>
        </html>";
        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom('Maylaflor@gmail.com','Maylaflor TSMS');
        $email->setSubject($subject);
        $email->setMessage($message);

        if ($email->send()) {
            echo "Success";
        }else{
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }
        // $User->insert($user_create);
        // $data['success'] ="emloyee added";
        
        return $this->response->redirect(site_url('/user'));
    }
    // show single User
    public function singleUser($user_id = null){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $User = new User();
        $Emp = new Emp();
        $data['emp'] = $Emp->orderBy('emp_id', 'ASC')->findAll();
        $data['User_obj'] = $User->where('user_id', $user_id)->first();
        $data['main'] = 'admin/user/user_edit';
        return view("templates/template",$data);
    }

    // update User data
    public function update($id){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $User = new User();
        $Username = ucfirst(strtolower($this->request->getVar('name')));
        $data = [
            'name' => $Username,
            'email'  => $this->request->getVar('email'),
            'address' => $this->request->getVar('address'),
            'contact'  => $this->request->getVar('contact'),
            'position' => $this->request->getVar('position'),
            'user_img' => $this->request->getVar('user_img'),
        ];
        $User->update($id, $data);
        $session = session();
        $session->setFlashdata('update', 'value');
        return $this->response->redirect(site_url('/user'));
    }
    
    public function printUser(){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $User = new User();
        $data['user'] = $User->orderBy('user_id', 'ASC')->findAll();
        foreach ($data['user'] as $key => $value) {
            $data['user_data'][]=(object)[
                "name"=>$value['name'],
                "email"=>$value['email'],
                "address"=>$value['address'],
                "contact"=>$value['contact'],
                "position"=>$value['position'],
            ];
        }
        return view('admin/user/userReports',$data);
        
    }
    // delete User
    public function delete($user_id = null){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $User = new User();
        $session = session();
        $data['User'] = $User->where('user_id', $user_id)->delete($user_id);
        $session->setFlashdata('msg', 'value');
        return $this->response->redirect(site_url('/user'));
    }    
}