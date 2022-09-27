<?php

namespace App\Controllers;
use App\Libraries\Hash;
use App\Models\User;


class Pages extends BaseController
{
    public function __construct(){
        helper(['url','form']);
    }
    public function index()
    {
        
        $data['main'] = 'pages/homep';
        return view("pages/home",$data);
    }
   
   
    public function about()
    {
        $data['main'] = 'pages/about';
        return view("pages/home",$data);
    }

    public function adminLogin()
    {
        return view("pages/admin_login",$data);
    }
    public function employeeLogin()
    {
        return view("pages/employee_login");
    }

    public function register_bdo(){
        return view("pages/register_bdo");
    }

    public function register_nonbdo(){
        return view("pages/register_nonbdo");
    }

    public function userType()
    {
        return view("pages/user");
    }

    public function clientType()
    {
        return view("pages/client");
    }

    public function check()
    {
        helper(['form']);
        
        $validation =  \Config\Services::validation();
        $session = session();
        // login Validation
        $validation = $this->validate([
            'email'    => [
                'rules'=>'required|valid_email|is_not_unique[users.email]',
                'errors'=>[
                    'required'=>'Email is Required',
                    'valid_email'=>'Enter a valid Email',
                    'is_not_unique'=>'Email does not exist'
                ]
            ],
            'password' => [
                'rules'=>'required|min_length[3]',
                'errors'=>[
                    'required'=>'Password is Required',
                    'min_length'=>'Password must have at least 3 characters'
                ]
            ]
        ]);
        if (!$validation) {
            //  session()->setFlashdata(['validation1' => $this->validator] );
            // return $this->response->redirect(site_url('/admin-login'));
            // $data['main'] = 'pages/admin_login';
            return view('pages/admin_login',['validation1' => $this->validator]);
            
        }else {
            $user = new User();
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $user_info = $user->where('email', $email)->first();
            // if($user_info['position'] === "Admin"){
                if ($user_info['position'] === "Admin") {
                    $pass = $user_info['password'];

                    $check_password = password_verify($password,$pass);
                   
                    if ($check_password) {
                        $getdata = [
                            'user_id' => $user_info['user_id'],
                            'username' => $user_info['name'],
                            'email' => $user_info['email'],
                            'address' => $user_info['address'],
                            'contact' => $user_info['contact'],
                            'position' => $user_info['position'],
                            'user_img' => $user_info['user_img'],
                            'password' => $user_info['password'],
                            'active' => $user_info['active'],
                            'isLoggedIn' => TRUE,
                        ];
                         if($user_info['active'] == 1){ 
                        $session->set($getdata);
                        return redirect()->to('dashboard');
                        }  else{
                            // $data['main'] = 'pages/admin_login';
                          $data['errorAcc'] = "Account Not Activated";
                          return view('pages/admin_login',$data);  
                        }
                    }else{
                          // $data['main'] = 'pages/admin_login';
                          $data['errorMessage'] = "Wrong Password";
                          return view('pages/admin_login',$data);   
                    }
                }else{
                          // $data['main'] = 'pages/admin_login';
                          $data['errorAcc'] = "Account is not registered as Admin";
                          return view('pages/admin_login',$data);   
                    }
        }
    }
    public function checkEmployee()
    {
        helper(['form']);
        
        $validation =  \Config\Services::validation();
        $session = session();
        // login Validation
        $validation = $this->validate([
            'email'    => [
                'rules'=>'required|valid_email|is_not_unique[users.email]',
                'errors'=>[
                    'required'=>'Email is Required',
                    'valid_email'=>'Enter a valid Email',
                    'is_not_unique'=>'Email does not exist'
                ]
            ],
            'password' => [
                'rules'=>'required|min_length[3]',
                'errors'=>[
                    'required'=>'Password is Required',
                    'min_length'=>'Password must have at least 3 characters'
                ]
            ]
        ]);

        if (!$validation) {
            // $data['main'] = 'pages/employee_login';
            return view('pages/employee_login',['validation1' => $this->validator]);
            
        }else {
            $user = new User();
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $user_info = $user->where('email', $email)->first();
            // if($user_info['position'] === "Admin"){
                if ($user_info['position'] === "Employee") {
                    $pass = $user_info['password'];

                    $check_password = password_verify($password,$pass);
                   
                    if ($check_password) {
                        $getdata = [
                            'user_id' => $user_info['user_id'],
                            'username' => $user_info['name'],
                            'email' => $user_info['email'],
                            'address' => $user_info['address'],
                            'contact' => $user_info['contact'],
                            'position' => $user_info['position'],
                            'emp_id' => $user_info['emp_id'],
                            'user_img' => $user_info['user_img'],
                            'password' => $user_info['password'],
                            'active' => $user_info['active'],
                            'isLoggedIn' => TRUE,
                        ];
                         if($user_info['active'] == 1){ 
                        $session->set($getdata);
                        return redirect()->to('dashboard');
                        }  else{
                            
                          $data['errorAcc'] = "Account Not Activated";
                          return view('pages/employee_login',$data);  
                        }
                    }else{
                         
                          $data['errorMessage'] = "Wrong Password";
                          return view('pages/employee_login',$data);    
                    }
                }else{
                          
                          $data['errorAcc'] = "Account is not registered as Employee";
                          return view('pages/employee_login',$data);  
                    }
        }
    }
}

