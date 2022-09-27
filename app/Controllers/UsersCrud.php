<?php 
namespace App\Controllers;
use App\Models\User;
use App\Models\Emp;
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
        $data['main'] = 'user/user_view';
        return view("dashboard/template",$data);

    }

    // add User form
    public function create(){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Emp = new Emp();
        $data['emp'] = $Emp->orderBy('emp_id', 'ASC')->findAll();
         $data['main'] = 'user/user_add';
          $data['error'] = null;
        return view("dashboard/template",$data);
    }
 
    // insert data
    public function store() {
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $User = new User();

        $user_data = $User->where('email', $this->request->getVar('email'))->first();
        if ($user_data) {
            $data['error'] = "Email Already Registered, Please try another Email";
            $data['main'] = 'user/user_add';
            return view("dashboard/template",$data);
        }
        // Generate Random Password
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_?";
        $password = substr( str_shuffle( $chars ), 0, 8 );
        // Generate Random Code
        $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = substr(str_shuffle($set), 0, 12);
        $Username = ucfirst(strtolower($this->request->getVar('name')));
        $user_create = [
            'name' => $Username,
            'email'  => $this->request->getVar('email'),
            'address' => $this->request->getVar('address'),
            'contact'  => $this->request->getVar('contact'),
            'position' => $this->request->getVar('position'),
            'emp_id' => $this->request->getVar('emp_id'),
            'code' => $code,
            'active' => false,
            'password' => password_hash($password, PASSWORD_DEFAULT)
           
        ];
        // dd($user_create);
        if( $id = $User->insert($user_create)){
            session()->setFlashdata('message', 'User Added!');
        }
        $to = $this->request->getVar('email');

        $subject = "TSMS - Account Activation";
        $message = "<html>
                        <head>
                            <title>Activation of your Account</title>
                        </head>
                        <body>
                            <h2>You can now login to our system TSMS.</h2>
                            <p>Your Account:</p>
                            <h3>Email: <b>".$to."</h3>
                            <h3>Password: <b>".$password."</h3>
                            <p>Please click the \"Activate my Account\" to activate your Account to our system.</p>
                            <h4><a href='".base_url("/user/activate/".$id."/".$code)." '>Activate My Account</a></h4>
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
    public function activate($id,$code){
        // $id =  $this->uri->segment(3);
        // $code = $this->uri->segment(4);

        
        $User = new User();
        $User_obj = $User->where('user_id', $id)->first();
        if($User_obj['code'] == $code){
            //update user active status
            $data['active'] = true;
            $User->update($id, $data);
            
        }
        else{
           
           $data['success']= 'Cannot activate account. Code didnt match';
        }
        $data['success']='Activated Successfully!';
        if($User_obj['position'] == "Admin"){
            $data['main'] = 'pages/admin_login';
        }else if($User_obj['position'] == "Employee"){
            $data['main'] = 'pages/employee_login';
        }
        return view('pages/login_temp',$data); 
        // return $this->response->redirect(site_url('/login'));
    }
    // show single User
    public function singleUser($user_id = null){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $User = new User();
        $data['User_obj'] = $User->where('user_id', $user_id)->first();
        $data['main'] = 'user/user_edit';
        return view("dashboard/template",$data);
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
        return view('user/userReports',$data);
        
    }
    // delete User
    public function delete($user_id = null){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $User = new User();
        $data['User'] = $User->where('user_id', $user_id)->delete($user_id);
        return $this->response->redirect(site_url('/user'));
    }    
}