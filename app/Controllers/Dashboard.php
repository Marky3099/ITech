<?php

namespace App\Controllers;
use App\Libraries\Hash;
use App\Models\User;
use App\Models\Emp;
use App\Models\Client;
use App\Models\All_events;
use App\Models\Event;
use App\Models\Serv;
use App\Models\Event_emp_views;



class Dashboard extends BaseController
{   
    public function __construct(){
        helper(['url','form']);
    }
    public function index()
    {
      
        $data['main'] = 'dashboard/dashboard';
        return view('dashboard/template',$data);
    }
    
    public function dashboard()
    {
        $allevent = new All_events();
        $event = new Event();
        $client = new Client();
        $serv = new Serv();
        $event_emp = new Event_emp_views();

        date_default_timezone_set('Asia/Hong_Kong'); 

        $date = new \DateTime();
        $date->setTimezone(new \DateTimeZone('+0800'));
        
        $data['events'] = $event->where('status','Pending')->where('start_event', date('Y-m-d'))->findAll();

        
       // 
        $data['event'] = array();
        $data['week1'] = array();
        $data['month'] = array();
        $data['completed'] = array();
        $data['notdone'] = array();
        $data['client'] = $client->orderBy('client_id', 'ASC')->findAll();
      
        $data['serv'] = $serv->orderBy('serv_id', 'ASC')->findAll();
        $data['event_emp'] = $event_emp->orderBy('id', 'ASC')->findAll();
        $data['today'] = $allevent->where('start_event', date('Y-m-d'))->findAll();
       

        foreach ($data['today'] as $key => $value) {
        $emp_arr = "";
            foreach ($data['event_emp'] as $key => $value_emps) {
                if ( $value['id'] == $value_emps['id']) {
                   $emp_arr .= $data['event_emp'][$key]['emp_name'].",";
                }
            }

            $data['event'][]= (object)[
                  "id"=> $value['id'],
                 "title"=>$value['title'],
                 "start_event"=> $value['start_event'],
                 "time"=> $value['TIME'],
                 "serv_id"=> $value['serv_id'],
                 "client_id"=>$value['client_id'],
                  "serv_name"=>$value['serv_name'],
                  "area"=> $value['area'],
                   "emp_array"=> $emp_arr,
                 "client_branch"=> $value['client_branch'],
                 "status"=> $value['STATUS'],
             ];
     }

       // 
        $db = \Config\Database::connect();
        $query   = $db->query('SELECT start_event,COUNT(start_event) as count
                FROM All_events
                GROUP BY YEAR(start_event), MONTH(start_event) ASC'
        );
        $data['data'] = $query->getResult();

        json_encode($data['data']);
        foreach ($data['data'] as $key => $value) {
             
                 $data['label'][]= date("M",strtotime($value->start_event));
                  $data['linedata'][]= (int)$value->count;
            }
        
        
        //count today's tasks
        $query = $db->query('SELECT COUNT(start_event) as count FROM All_events WHERE start_event = curdate()');
        $data['event_today'] = $query->getResult();
        json_encode($data['event_today']);
        foreach ($data['event_today'] as $key => $value) {
            $data['today_event']= (int)$value->count;
        }
        //count weekly tasks

        $query = $db->query('SELECT COUNT(start_event) as count FROM All_events WHERE WEEK(start_event,1) = WEEK(CURRENT_DATE(),1)');

        $data['event_week'] = $query->getResult();
        $monday = date('Y-m-d', strtotime('monday this week'));
        $sunday = date('Y-m-d', strtotime('sunday this week'));

        $data['weekly'] = $allevent->where('start_event BETWEEN "'. date('Y-m-d', strtotime($monday)). '" and "'. date('Y-m-d', strtotime($sunday)).'"ORDER BY start_event ASC')->findAll();
       

         foreach ($data['weekly'] as $key => $value) {
        $emp_arr = "";
            foreach ($data['event_emp'] as $key => $value_emps) {
                if ( $value['id'] == $value_emps['id']) {
                   $emp_arr .= $data['event_emp'][$key]['emp_name'].",";
                }
            }

            $data['week1'][]= (object)[
                "id"=> $value['id'],
                 "title"=> $value['title'],
                 "start_event"=> $value['start_event'],
                 "time"=> $value['TIME'],
                 "serv_id"=> $value['serv_id'],
                 "client_id"=>$value['client_id'],
                  "area"=> $value['area'],
                  "status"=> $value['STATUS'],
                 "serv_name"=> $value['serv_name'],
                 "client_branch"=> $value['client_branch'],
                 "emp_array"=> $emp_arr,
             ];
     }
           



        json_encode($data['event_week']);
        foreach ($data['event_week'] as $key => $value) {
            $data['weekly_event']= (int)$value->count;
        }
        //count monthly tasks
        $query = $db->query('SELECT COUNT(start_event) as count FROM All_events WHERE MONTH(start_event) = MONTH(CURRENT_DATE())');
        $data['event_month'] = $query->getResult();

         $data['monthly'] = $allevent->where('MONTH(start_event) = MONTH(CURRENT_DATE()) ORDER BY start_event ASC')->findAll();
        
        
         foreach ($data['monthly'] as $key => $value) {
        $emp_arr = "";
            foreach ($data['event_emp'] as $key => $value_emps) {
                if ( $value['id'] == $value_emps['id']) {
                   $emp_arr .= $data['event_emp'][$key]['emp_name'].",";
                }
            }

            $data['month'][]= (object)[
                "id"=> $value['id'],
                 "title"=> $value['title'],
                 "start_event"=> $value['start_event'],
                 "time"=> $value['TIME'],
                 "serv_id"=> $value['serv_id'],
                 "client_id"=>$value['client_id'],
                  "area"=> $value['area'],
                  "status"=> $value['STATUS'],
                 "serv_name"=> $value['serv_name'],
                 "client_branch"=> $value['client_branch'],
                 "emp_array"=> $emp_arr,
             ];
     }
           

        json_encode($data['event_month']);
        foreach ($data['event_month'] as $key => $value) {
            $data['monthly_event']= (int)$value->count;
        }
        // Completed task
          $query = $db->query('SELECT COUNT(start_event) as count FROM All_events WHERE status = "Done"');
        $data['event_complete'] = $query->getResult();

         $data['complete'] = $allevent->where('status = "Done" ORDER BY start_event ASC')->findAll();
        
        
         foreach ($data['complete'] as $key => $value) {
        $emp_arr = "";
            foreach ($data['event_emp'] as $key => $value_emps) {
                if ( $value['id'] == $value_emps['id']) {
                   $emp_arr .= $data['event_emp'][$key]['emp_name'].",";
                }
            }

            $data['completed'][]= (object)[
                "id"=> $value['id'],
                 "title"=> $value['title'],
                 "start_event"=> $value['start_event'],
                 "time"=> $value['TIME'],
                 "serv_id"=> $value['serv_id'],
                 "client_id"=>$value['client_id'],
                  "area"=> $value['area'],
                  "status"=> $value['STATUS'],
                 "serv_name"=> $value['serv_name'],
                 "client_branch"=> $value['client_branch'],
                 "emp_array"=> $emp_arr,
             ];
     }
           

        json_encode($data['event_complete']);
        foreach ($data['event_complete'] as $key => $value) {
            $data['complete_event']= (int)$value->count;
        }
        // Pending task
          $query = $db->query('SELECT COUNT(start_event) as count FROM All_events WHERE status = "Pending"');
        $data['event_pending'] = $query->getResult();

         $data['pending'] = $allevent->where('status = "Pending" ORDER BY start_event ASC')->findAll();
        
        
         foreach ($data['pending'] as $key => $value) {
        $emp_arr = "";
            foreach ($data['event_emp'] as $key => $value_emps) {
                if ( $value['id'] == $value_emps['id']) {
                   $emp_arr .= $data['event_emp'][$key]['emp_name'].",";
                }
            }

            $data['notdone'][]= (object)[
                "id"=> $value['id'],
                 "title"=> $value['title'],
                 "start_event"=> $value['start_event'],
                 "time"=> $value['TIME'],
                 "serv_id"=> $value['serv_id'],
                 "client_id"=>$value['client_id'],
                  "area"=> $value['area'],
                  "status"=> $value['STATUS'],
                 "serv_name"=> $value['serv_name'],
                 "client_branch"=> $value['client_branch'],
                 "emp_array"=> $emp_arr,
             ];
     }
           

        json_encode($data['event_pending']);
        foreach ($data['event_pending'] as $key => $value) {
            $data['pending_event']= (int)$value->count;
        }

        // $query = $db->query('SELECT * FROM All_events WHERE start_event = curdate()');
        // $data['today'] = $query->getResult();
        $data['main'] = 'dashboard/dashboard';
        return view("dashboard/template",$data);
    }
 

    public function profile($user_id)
    {
        $User = new User();
        $session = session();
        $user_info = $User->where('user_id', $user_id)->first();
      
         $data['user_data'] = [

                        'user_id' => $user_info['user_id'],
                        'username' => $user_info['name'],
                        'email' => $user_info['email'],
                        'address' => $user_info['address'],
                        'contact' => $user_info['contact'],
                        'password' => $user_info['password'],
                        'user_img' => $user_info['user_img'],
                        'isLoggedIn' => TRUE,
                    ];
        $data['main'] = 'dashboard/profile';
        // $data['success'] = 'Profile Updated!';

        return view("dashboard/temp_profile",$data);
    }
    public function update(){
        $User = new User();
        $user_id = $this->request->getVar('user_id');
        $user_obj = $User->find($user_id);
        $imageName= null;
        $old_img_name = $user_obj['user_img'];
        if($old_img_name == NULL){
             $file = $this->request->getFile('user_img');
             if ($file->isValid() && !$file->hasMoved()) {
                $imageName = $file->getRandomName();
                $file->move('uploads/',$imageName);
             }
        }else{
            $file = $this->request->getFile('user_img');
             if ($file->isValid() && !$file->hasMoved()) {
                
                if (file_exists("uploads/".$old_img_name)) {
                    unlink("uploads/".$old_img_name);
                }
                $imageName = $file->getRandomName();
                $file->move('uploads/',$imageName);
            }
            else{
                $imageName = $old_img_name;
            }
        }
        
        $session = session();
       if($this->request->getVar('password') == NULL){
            $data = [
                'name' => $this->request->getVar('name'),
                'email'  => $this->request->getVar('email'),
                'address' => $this->request->getVar('address'),
                'contact'  => $this->request->getVar('contact'),
                'user_img' => $imageName,
            ];
        }else{
            if($this->request->getVar('password') == $this->request->getVar('c_password')){
                $data = [
                    'name' => $this->request->getVar('name'),
                    'email'  => $this->request->getVar('email'),
                    'address' => $this->request->getVar('address'),
                    'contact'  => $this->request->getVar('contact'),
                    'password'  =>password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'user_img' => $imageName,
                ];
            }else{
                 session()->setFlashdata('error', 'Password didn\'t match, Please try again');
                 return $this->response->redirect(site_url('/profile/'.$user_id));
            }
        }
        $User->update($user_id, $data);
        if($User->update($user_id,$data)){
            session()->setFlashdata('message', 'Updated Successfully!');
        }
        $user_info = $User->where('user_id', $user_id)->first();

        $getdata = [
                        'user_id' => $user_info['user_id'],
                        'username' => $user_info['name'],
                        'email' => $user_info['email'],
                        'address' => $user_info['address'],
                        'contact' => $user_info['contact'],
                        'user_img' => $user_info['user_img'],
                        
                        
                        'isLoggedIn' => TRUE,
                    ];
                        
                    $session->set($getdata);

        return $this->response->redirect(site_url('/profile/'.$user_id));
    }
    public function fpass(){
       
        return view('dashboard/forgot_pass');
    }
    public function fpass_send(){
        $User = new User();
         $to = $this->request->getVar('email');
        $user_info= $User->where('email',$to)->findAll();

        if($user_info){

            $subject = "TSMS - Reset Password";
            $message = "<html>
                            <head>
                                <title>Reset Password</title>
                            </head>
                            <body>
                                <h2>Here is the link to Reset your Password.</h2>
                                <p>Kindly click the \"Reset Password\" and fill the necessary information</p> 
                                <h4><a href='".base_url("/forgot_password/".$to)." '>Reset Password</a></h4>
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
            session()->setFlashdata('message', 'Email Sent');
        }else{
            session()->setFlashdata('error', 'Error! Email is not registered');
        }
        return $this->response->redirect(site_url('/forgot_password'));
    }

    public function change_pass_form($email){
        $User = new User();
        $data['user_obj'] = $User->where('email', $email)->first();

        return view('dashboard/change_pass',$data);
    }
     public function change_pass($email){

        $User = new User();
        $data['user_obj'] = $User->where('email', $email)->first();
        $User_obj = $User->where('email', $email)->first();
        $pass = $this->request->getVar('password');
        $c_pass =  $this->request->getVar('c_password');
        $id = $User_obj['user_id'];
        if($this->request->getVar('password') == $this->request->getVar('c_password')){
            
            //update user active status
            $data['password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
            
            
        }
        else{
           
            session()->setFlashdata('error', 'Password didn\'t match');
             return $this->response->redirect(site_url('/forgot_password/'.$email));
        }
        if($User->update($id, $data)){
         session()->setFlashdata('message','Changed Password Successfully!');
        }
        
        return $this->response->redirect(site_url('/forgot_password/'.$email));
        
    }
    public function update_task($id){
        $Event = new Event();
    
        $session = session();
        $data = [
            'status' => "Done",
        ];
        $Event->update((int)$id, $data);
        return $this->response->redirect(site_url('/dashboard/'));
    }
    public function pending_task($id){
        $Event = new Event();
    
        $session = session();
        $data = [
            'status' => "Pending",
        ];
        $Event->update((int)$id, $data);
        return $this->response->redirect(site_url('/dashboard/'));
    }


    public function logout()
    {
        session()->destroy();
        return $this->response->redirect(site_url('/'));
    }
}
?>