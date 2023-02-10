<?php

namespace App\Models;

use CodeIgniter\Model;

class Appt_fcu extends Model
{
    protected $table      = 'appt_fcu';
    protected $returnType     = 'array';
    protected $allowedFields = ['appt_id','serv_id','aircon_id','fcuno','qty'];

}