<?php

namespace App\Models;

use CodeIgniter\Model;

class Event extends Model
{
    protected $table      = 'events';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
  

    protected $allowedFields = ['title','event_code','log_code','appt_code','start_event','time','client_id','serv_id','status','repeatable'];

}