<?php

namespace App\Controllers;
use App\Libraries\Hash;
use App\Models\User;
use App\Models\Client;
use App\Models\User_bdo;
use App\Models\Event_emp_views;

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
    public function userType()
    {
        return view("pages/user");
    }
    public function adminLogin()
    {
        return view("pages/admin_login");
    }
    public function secretaryLogin()
    {
        return view("pages/secretary_login");
    }
    public function employeeLogin()
    {
        return view("pages/employee_login");
    }
    public function clientType()
    {
        return view("pages/client");
    }
    public function bdoLogin(){
        return view("pages/bdo_login");
    }
    public function nonBdoLogin(){
        return view("pages/nonbdo_login");
    }
    public function bdoRegister(){
        return view("pages/bdo_register");
    }

    public function nonBdoRegister(){
        return view("pages/nonbdo_register");
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
            // $data['main'] = 'pages/employee_login';
            return view('pages/admin_login',['validation1' => $this->validator]);
            
        }else {
            $user = new User();
            
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $user_info = $user->where('email', $email)->first();
            // if($user_info['position'] === "Admin"){
            // if($user_info['active'] == 1){ 
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
                                // 'active' => $user_info['active'],
                        'isLoggedIn' => TRUE,
                    ];
                    
                    $session->set($getdata);
                    return redirect()->to('dashboard');
                }else{
                   
                  $data['errorMessage'] = "Wrong Password";
                  return view('pages/admin_login',$data);    
              }
          }else{
              
            $data['errorAcc'] = "Account is not registered as Admin";
            return view('pages/admin_login',$data);  
        }
        
            // } else{
            //    $data['errorAcc'] = "Account Not Activated";
            //     return view('pages/admin_login',$data);  
            // }
        
    }
}public function checkSecretary()
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
            return view('pages/secretary_login',['validation1' => $this->validator]);
            
        }else {
            $user = new User();
            
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $user_info = $user->where('email', $email)->first();
            if ($user_info['position'] === "Secretary") {
                
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
                        'isLoggedIn' => TRUE,
                    ];
                    
                    $session->set($getdata);
                    return redirect()->to('dashboard');
                }else{
                   
                  $data['errorMessage'] = "Wrong Password";
                  return view('pages/secretary_login',$data);    
              }
          }else{
              
            $data['errorAcc'] = "Account is not registered as Secretary";
            return view('pages/secretary_login',$data);  
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
                    // if($user_info['active'] == 1){ 
            $pass = $user_info['password'];

            $check_password = password_verify($password,$pass);
            
            if ($check_password) {
                $event_emp = new Event_emp_views();

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
                                // 'active' => $user_info['active'],
                    'isLoggedIn' => TRUE,
                ];

                $session->set($getdata);
                date_default_timezone_set('Asia/Hong_Kong'); 
                $assign = $event_emp->where('emp_id',$_SESSION['emp_id'])->where('start_event', date("Y/m/d"))->findAll();
                $session->setFlashdata('assignCount', count($assign));
                // $data['assignCount'] = count($data['assign']);

                return redirect()->to('dashboard');
            }else{
               
              $data['errorMessage'] = "Wrong Password";
              return view('pages/employee_login',$data);    
          }
          
                    // }else{
          
                    //    $data['errorAcc'] = "Account Not Activated";
                    //     return view('pages/employee_login',$data);  
                    // }
      }else{
          
        $data['errorAcc'] = "Account is not registered as Technician";
        return view('pages/employee_login',$data);  
    }
}
}
public function checkClient()
{
    helper(['form']);
    
    $validation =  \Config\Services::validation();
    $session = session();
        // login Validation
    $validation = $this->validate([
        'email'    => [
            'rules'=>'required|valid_email|is_not_unique[users_bdo.bdo_email]',
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
        
        return view('pages/bdo_login',['validation1' => $this->validator]);
        
    }else {
        $user = new User_bdo();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        // dd($user_info['bdo_id']);
        $user_info = $user->where('bdo_email', $email)->first();
            // dd($user_info);
            // if($user_info['position'] === "Admin"){
        if($user_info['bdo_unique_code'] != ""){
            if ($user_info['position'] === "Client") {
                    $pass = $user_info['bdo_password'];

                    $check_password = password_verify($password,$pass);
                    
                    if ($check_password) {
                        $getdata = [
                            'user_id' => $user_info['bdo_id'],
                            'client_id' => $user_info['client_id'],
                            'username' => $user_info['bdo_fname'],
                            'bdo_fname' => $user_info['bdo_fname'],
                            'bdo_lname' => $user_info['bdo_lname'],
                            'bdo_email' => $user_info['bdo_email'],
                            'bdo_address' => $user_info['bdo_address'],
                            'bdo_contact' => $user_info['bdo_contact'],
                            'position' => $user_info['position'],
                            'user_img' => $user_info['user_img'],
                            'bdo_password' => $user_info['bdo_password'],
                            'isLoggedIn' => TRUE,
                        ];
                        
                    }else{
                                  // $data['main'] = 'pages/admin_login';
                      $data['errorMessage'] = "Wrong Password";
                      return view('pages/bdo_login',$data);   
                  }
                  $session->set($getdata);
                  return redirect()->to('appointment');
                
            }else{
                              // $data['main'] = 'pages/admin_login';
              $data['errorAcc'] = "Account is not registered as Client";
              return view('pages/bdo_login',$data);   
            }
        }else{
            $data['errorAcc'] = "Account is not registered as Partnered";
            return view('pages/bdo_login',$data);  
        }
            
}
}
public function checkClientNonBdo()
{
    helper(['form']);
    
    $validation =  \Config\Services::validation();
    $session = session();
        // login Validation
    $validation = $this->validate([
        'email'    => [
            'rules'=>'required|valid_email|is_not_unique[users_bdo.bdo_email]',
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
        
        return view('pages/bdo_login',['validation1' => $this->validator]);
        
    }else {
        $user = new User_bdo();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        // dd($user_info['bdo_id']);
        $user_info = $user->where('bdo_email', $email)->first();
            // dd($user_info);
            // if($user_info['position'] === "Admin"){
        if($user_info['bdo_unique_code'] == ""){
            if ($user_info['position'] === "Client") {
                    $pass = $user_info['bdo_password'];

                    $check_password = password_verify($password,$pass);
                    
                    if ($check_password) {
                        $getdata = [
                            'user_id' => $user_info['bdo_id'],
                            'client_id' => $user_info['client_id'],
                            'username' => $user_info['bdo_fname'],
                            'bdo_fname' => $user_info['bdo_fname'],
                            'bdo_lname' => $user_info['bdo_lname'],
                            'bdo_email' => $user_info['bdo_email'],
                            'bdo_address' => $user_info['bdo_address'],
                            'bdo_contact' => $user_info['bdo_contact'],
                            'position' => $user_info['position'],
                            'user_img' => $user_info['user_img'],
                            'bdo_password' => $user_info['bdo_password'],
                            'isLoggedIn' => TRUE,
                        ];
                        
                    }else{
                                  // $data['main'] = 'pages/admin_login';
                      $data['errorMessage'] = "Wrong Password";
                      return view('pages/nonbdo_login',$data);   
                  }
                  $session->set($getdata);
                  return redirect()->to('appointment');
            }else{
                              // $data['main'] = 'pages/admin_login';
              $data['errorAcc'] = "Account is not registered as Client";
              return view('pages/nonbdo_login',$data);   
            }
        }else{
            $data['errorAcc'] = "Account is not registered as Non-Partnered";
            return view('pages/nonbdo_login',$data);  
        }
            
}
}
public function registerBdo(){
    $userBdo = new User_bdo();
    $Client = new Client();

    $client = $Client->orderBy('client_id', 'ASC')->findAll();
    $pattern = '/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).{8,20}$/';
    // dd(preg_match($pattern, $this->request->getVar('password'))." ".$this->request->getVar('password'));
    $code = $Client->where('code', $this->request->getVar('code'))->first();
    $uniqueCode = $userBdo->where('bdo_unique_code',$this->request->getVar('code'))->findAll();
    // dd($uniqueCode);
    if($code){
        if(!$uniqueCode>0){
            if(preg_match($pattern, $this->request->getVar('password')))
            {
                if($this->request->getVar('password') == $this->request->getVar('c_password')){
                    $userBdo_create = [
                        'bdo_fname' => $this->request->getVar('fname'),
                        'bdo_lname' => $this->request->getVar('lname'),
                        'bdo_email'  => $this->request->getVar('email'),
                        'bdo_address' => $this->request->getVar('address'),
                        'bdo_contact'  => $this->request->getVar('contact'),
                        'bdo_company' => $this->request->getVar('company'),
                        'bdo_unique_code' => $this->request->getVar('code'),
                        'bdo_password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                        'client_id' => $code['client_id'],
                        
                    ];
                }else{
                    $data['error'] = 'Password didn\'t match, Please try again';
                    return view("pages/bdo_register",$data);
                }
                if($userBdo->insert($userBdo_create)){
                    $data['success'] = 'Sign up successful.';
                    return view("pages/bdo_register",$data);
                }
            }else{
                $data['error_pass'] = 'Password must have atleast 1 Uppercase, 1 lowercase, 1 number and 1 special character';
                return view("pages/bdo_register",$data);
            }
        }else{
            $data['error'] = 'Code is already registered';
            return view("pages/bdo_register",$data);
        }
    }else{
        $data['error'] = 'Code is not Valid, try again with a valid code';
        return view("pages/bdo_register",$data);
    }
    
}
public function registerNonBdo(){
    $userBdo = new User_bdo();
    $Client = new Client();
    $pattern = '/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).{8,20}$/';
    if(preg_match($pattern, $this->request->getVar('password'))){
        if($this->request->getVar('password') == $this->request->getVar('c_password')){
            $userBdo_create = [
                'bdo_fname' => $this->request->getVar('fname'),
                'bdo_lname' => $this->request->getVar('lname'),
                'bdo_email'  => $this->request->getVar('email'),
                'bdo_address' => $this->request->getVar('address'),
                'bdo_contact'  => $this->request->getVar('contact'),
                'bdo_company' => $this->request->getVar('company'),
                // 'bdo_unique_code' => $this->request->getVar('code'),
                'bdo_password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                // 'client_id' => $code['client_id'],

            ];
        }else{
            $data['error'] = 'Password didn\'t match, Please try again';
            return view("pages/nonbdo_register",$data);
        }
        $success = $userBdo->insert($userBdo_create);
        if($success){

            $areaUpper = strtoupper('other');
            $branchUpper = strtoupper($this->request->getVar('company'));
            $client_create = [
                'area' => $areaUpper,
                'client_branch' => $branchUpper,
                'client_address' => $this->request->getVar('address'),
                'client_email'  => $this->request->getVar('email'),
                'client_contact'  => $this->request->getVar('contact'),
                // 'code'  => $code,
            ];
            $success1 = $Client->insert($client_create);
            if($success1){
              // 
                $update_data = ['client_id' => (int)$success1];
                $userBdo->update((int)$success,$update_data);
                $data['success'] = 'Sign up successful.';
                
            }else{
                $data['error'] = 'There is a problem, Please Try again later.';
            }
            return view("pages/nonbdo_register",$data);
        }
    }else{
        $data['error_pass'] = 'Password must have atleast 1 Uppercase, 1 lowercase, 1 number and 1 special character';
        return view("pages/nonbdo_register",$data);
    }
}
public function fpass(){

    return view('pages/forgot_pass');
}
public function fpass_client(){

    return view('pages/forgot_pass_client');
}
public function fpass_send(){
    $User = new User();
    // $User_bdo = new User_bdo();
    $to = $this->request->getVar('email');
    // $Bdo_obj = $User_bdo->where('bdo_email', $to)->first();
    $user_info= $User->where('email',$to)->findAll();
    // $bdo_info= $User_bdo->where('bdo_email',$to)->findAll();
    // dd($bdo_info);
    if($user_info){

        $subject = "TSMS - Reset Password";
        $message = "<html>
        <head>
        <title>Reset Password</title>
        </head>
        <body>
        <h2>Here is the link to Reset your Password.</h2>
        <p>Kindly click the \"Reset Password\" and fill the necessary information</p> 
        <h4><a href='".base_url("/forgot-password/".$to)." '>Reset Password</a></h4>
        </body>
        </html>";
        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom('Maylaflorairconditioningref27@gmail.com','Maylaflor TSMS');
        $email->setSubject($subject);
        $email->setMessage($message);

        if ($email->send()) {
            echo "Success";
        }else{
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }
        session()->setFlashdata('message', 'Email Sent');
    }
    return $this->response->redirect(site_url('/forgot-password'));
}
public function fpass_send_client(){
    $User_bdo = new User_bdo();
    $to = $this->request->getVar('email');
    $bdo_info= $User_bdo->where('bdo_email',$to)->findAll();


    if($bdo_info){

        $subject = "TSMS - Reset Password";
        $message = "<html>
        <head>
        <title>Reset Password</title>
        </head>
        <body>
        <h2>Here is the link to Reset your Password.</h2>
        <p>Kindly click the \"Reset Password\" and fill the necessary information</p> 
        <h4><a href='".base_url("/forgot-password-client/".$to)." '>Reset Password</a></h4>
        </body>
        </html>";
        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom('Maylaflorairconditioningref27@gmail.com','Maylaflor TSMS');
        $email->setSubject($subject);
        $email->setMessage($message);

        if ($email->send()) {
            echo "Success";
        }else{
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }
        session()->setFlashdata('message', 'Email Sent');
    }else{
        session()->setFlashdata('error', 'Error! Email is not registered');
    }
    return $this->response->redirect(site_url('/forgot-password-client'));
}

public function change_pass_form($email){
    $User = new User();
    $User_bdo = new User_bdo();
    $data['user_obj'] = $User->where('email', $email)->first();
    $data['bdo_obj'] = $User_bdo->where('bdo_email', $email)->first();

    return view('pages/change_pass',$data);
}
public function change_pass_form_client($email){
    $User_bdo = new User_bdo();
    $data['bdo_obj'] = $User_bdo->where('bdo_email', $email)->first();

    return view('pages/client_change_pass',$data);
}
public function change_pass($email){

    $User = new User();
    $User_bdo = new User_bdo();
    $data['bdo_obj'] = $User_bdo->where('bdo_email', $email)->first();
    $data['user_obj'] = $User->where('email', $email)->first();
    $User_obj = $User->where('email', $email)->first();
    $Bdo_obj = $User_bdo->where('bdo_email', $email)->first();
    $pattern = '/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).{8,20}$/';
    // dd($Bdo_obj);
    if($User_obj){
        $pass = $this->request->getVar('password');
        $c_pass =  $this->request->getVar('c_password');
        $id = $User_obj['user_id'];
        
        if(preg_match($pattern, $this->request->getVar('password'))){
            if($this->request->getVar('password') == $this->request->getVar('c_password')){

                //update user active status
            $data['password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);

            }
            else{

                session()->setFlashdata('error', 'Password didn\'t match');
                return $this->response->redirect(site_url('/forgot-password/'.$email));
            }
        }else{
            session()->setFlashdata('error', 'Password must have atleast 1 Uppercase, 1 lowercase, 1 number and 1 special character');
            return $this->response->redirect(site_url('/forgot-password/'.$email));
        }
        
        if($User->update($id, $data)){
           session()->setFlashdata('message','Changed Password Successfully!');
       }
   }else if($Bdo_obj){
        $pass = $this->request->getVar('password');
        $c_pass =  $this->request->getVar('c_password');
        $id = $Bdo_obj['bdo_id'];
        if(preg_match($pattern, $this->request->getVar('password'))){
            if($this->request->getVar('password') == $this->request->getVar('c_password')){

                //update user active status
            $data['bdo_password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
            }
            else{

                session()->setFlashdata('error', 'Password didn\'t match');
                return $this->response->redirect(site_url('/forgot-password-client/'.$email));
            }
        }else{
            session()->setFlashdata('error', 'Password must have atleast 1 Uppercase, 1 lowercase, 1 number and 1 special character');
            return $this->response->redirect(site_url('/forgot-password-client/'.$email));
        }
        
        if($User_bdo->update($id, $data)){
           session()->setFlashdata('message','Changed Password Successfully!');
       }
   }
    
   if($User_obj){
   return $this->response->redirect(site_url('/forgot-password/'.$email));
   }else if($Bdo_obj){
    return $this->response->redirect(site_url('/forgot-password-client/'.$email));
    }

}
}

