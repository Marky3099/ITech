<?php

namespace App\Models;

use CodeIgniter\Model;

class Event_emp extends Model
{
    protected $table      = 'event_emp';
    protected $returnType     = 'array';
    protected $allowedFields = ['id', 'emp_id'];
}