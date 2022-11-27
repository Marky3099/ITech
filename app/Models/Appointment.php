<?php

namespace App\Models;

use CodeIgniter\Model;

class Appointment extends Model
{
    protected $table      = 'appointments';
    protected $primaryKey = 'appt_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
  

    protected $allowedFields = ['appt_date','bdo_id','appt_time','client_id','serv_id','aircon_id','fcuno','qty','appt_status'];

}