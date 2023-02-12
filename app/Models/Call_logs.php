<?php

namespace App\Models;

use CodeIgniter\Model;

class Call_logs extends Model
{
    protected $table      = 'call_logs';
    protected $primaryKey = 'cl_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['date','client_id','serv_id','time','end_time','log_code','status'];

}