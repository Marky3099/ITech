<?php

namespace App\Models;

use CodeIgniter\Model;

class Call_fcu extends Model
{
    protected $table      = 'call_fcu';
    protected $returnType     = 'array';
    protected $allowedFields = ['cl_id','aircon_id','fcuno','qty'];

}