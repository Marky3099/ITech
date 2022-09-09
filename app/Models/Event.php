<?php

namespace App\Models;

use CodeIgniter\Model;

class Event extends Model
{
    protected $table      = 'events';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
  

    protected $allowedFields = ['title','start_event','time','end_event','client_id','serv_id','aircon_id','quantity','status','repeatable'];

}