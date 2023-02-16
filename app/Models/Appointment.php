<?php

namespace App\Models;

use CodeIgniter\Model;

class Appointment extends Model
{
    protected $table      = 'appointments';
    protected $primaryKey = 'appt_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
  

    protected $allowedFields = ['appt_code','appt_date','appt_time','client_id','serv_id','appt_status','user_id','comments','rate'];

}