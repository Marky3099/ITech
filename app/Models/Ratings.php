<?php

namespace App\Models;

use CodeIgniter\Model;

class Ratings extends Model
{
    protected $table      = 'ratings';

    protected $returnType     = 'array';
  

    protected $allowedFields = ['id','rate_event','event_comments','emp_id','rate_emp','emp_comments'];

}