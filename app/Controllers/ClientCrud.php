<?php 
namespace App\Controllers;
use App\Models\Client;
use App\Models\User_bdo;
use CodeIgniter\Controller;
use App\Libraries\Phpmailer_lib;

class ClientCrud extends Controller
{
    // show Client list
    public function index(){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Client = new Client();
        $data['clients'] = $Client->orderBy('client_id', 'ASC')->findAll();
        $data['main'] = 'admin/client/client_view';
        return view("templates/template",$data);

    }

    // add Client form
    public function create(){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $data['main'] = 'admin/client/client_add';
        return view("templates/template",$data);
    }
    
    // insert data
    public function store() {
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Client = new Client();
        $session = session();
        $cBranch = $Client->where('client_branch', $this->request->getVar('client_branch'))->first();
        $cEmail = $Client->where('client_email', $this->request->getVar('client_email'))->first();
        if ($cBranch) {
            $session->setFlashdata('branchError', 'value');
            // return $this->response->redirect(site_url('/client/create/view'));
            $data['main'] = 'admin/client/client_add';
            $data['error'] = '';
            return view("templates/template",$data);
        }else if($cEmail){ 
            if ($cEmail['client_email'] != ""){
            
                $session->setFlashdata('emailExist', 'value');
                // return $this->response->redirect(site_url('/client/create/view'));
                $data['main'] = 'admin/client/client_add';
                $data['error'] = '';
                return view("templates/template",$data);
            }
        }
        // $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = $this->request->getVar('code');
        $areaUpper = strtoupper($this->request->getVar('area'));
        $branchUpper = strtoupper($this->request->getVar('client_branch'));
        $client_create = [
            'area' => $areaUpper,
            'client_branch' => $branchUpper,
            'client_address' => $this->request->getVar('client_address'),
            'client_email'  => $this->request->getVar('client_email'),
            'client_contact'  => $this->request->getVar('client_contact'),
            'code'  => $code,
        ];
        $Client->insert($client_create);

        $to = $this->request->getVar('client_email');

        $subject = "MARSI: Appointment System - Complete Account Registration";
        $message = "<html>
        <head>
        <title>Verification Code</title>
        </head>
        <body>
        <h2>Welcome to MARSI: Appointment System!</h2>
        <br>
        <p>Please enter this confirmation code in the window where you started creating your account</p>
        <br>
        <h3>".$code."</h3>
        <br>
        <p>or click this link to continue your account registration</p>
        <br>
        <h4><a href='".base_url("/bdo-register")."'>Register Account</a></h4>
        <br>
        <p>Thank You!</p>
        <br>
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

        
        $session->setFlashdata('add', 'value');
        return $this->response->redirect(site_url('/client'));
    }

    // show single Client
    public function singleClient($client_id = null){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Client = new Client();
        $data['Client_obj'] = $Client->where('client_id', $client_id)->first();
        $data['main'] = 'admin/client/client_edit';
        return view("templates/template",$data);
    }

    // update Client data
    public function update(){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Client = new Client();
        $client_id = $this->request->getVar('client_id');
        $areaUpper = strtoupper($this->request->getVar('area'));
        $branchUpper = strtoupper($this->request->getVar('client_branch'));
        $data = [
            'area' => $areaUpper,
            'client_branch' => $branchUpper,
            'client_address' => $this->request->getVar('client_address'),
            'client_email' => $this->request->getVar('client_email'),
            'client_contact'  => $this->request->getVar('client_contact'),
            'code'  => $this->request->getVar('code'),
        ];
        $Client->update($client_id, $data);
        $session = session();
        $session->setFlashdata('update', 'value');
        return $this->response->redirect(site_url('/client'));
    }
    public function printClient(){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Client = new Client();
        $data['client'] = $Client->orderBy('client_id', 'ASC')->findAll();
        foreach ($data['client'] as $key => $value) {
            $data['clients'][]=(object)[
                "area"=>$value['area'],
                "client_branch"=>$value['client_branch'],
                "client_address"=>$value['client_address'],
                "client_email"=>$value['client_email'],
                "client_contact"=>$value['client_contact'],
            ];
        }
        return view('admin/client/clientReports',$data);
        
    }
    
    // delete Client
    public function delete($client_id = null){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Client = new Client();
        $session = session();
        $data['Client'] = $Client->where('client_id', $client_id)->delete($client_id);
        $session->setFlashdata('msg', 'value');
        return $this->response->redirect(site_url('/client'));
    }    
}