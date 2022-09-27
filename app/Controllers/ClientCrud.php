<?php 
namespace App\Controllers;
use App\Models\Client;
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
        $data['main'] = 'client/client_view';
        return view("dashboard/template",$data);

    }

    // add Client form
    public function create(){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
         $data['main'] = 'client/client_add';
          $data['error'] = null;
        return view("dashboard/template",$data);
    }
 
    // insert data
    public function store() {
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Client = new Client();
        $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = substr(str_shuffle($set), 0, 12);
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

        $subject = "TSMS - Verification";
        $message = "<html>
                        <head>
                            <title>Verification Code</title>
                        </head>
                        <body>
                            <h2>Welcome to TSMS!</h2>
                            <p>You need to use the code below to register to our system.</p>
                            <h4>Code: <b>".$code."</b></h4>
                            <h4><a href='".base_url("/client-type")."'>Register my Account</a></h4>
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

        $data['success'] ="Client added";
        return $this->response->redirect(site_url('/client'));
    }

    // show single Client
    public function singleClient($client_id = null){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Client = new Client();
        $data['Client_obj'] = $Client->where('client_id', $client_id)->first();
        $data['main'] = 'client/client_edit';
        return view("dashboard/template",$data);
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
        ];
        $Client->update($client_id, $data);
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
        return view('client/clientReports',$data);
        
    }
 
    // delete Client
    public function delete($client_id = null){
        if($_SESSION['position'] != USER_ROLE_ADMIN){
            return $this->response->redirect(site_url('/dashboard'));
        }
        $Client = new Client();
        $data['Client'] = $Client->where('client_id', $client_id)->delete($client_id);
        return $this->response->redirect(site_url('/client'));
    }    
}