<?php

namespace App\Models;

use CodeIgniter\Model;

class Emp_expertise extends Model
{
    protected $table      = 'emp_expertise';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['emp_id','serv_id'];

}