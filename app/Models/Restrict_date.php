<?php

namespace App\Models;

use CodeIgniter\Model;

class Restrict_date extends Model
{
    protected $table      = 'restrict_dates';
    protected $primaryKey = 'date_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
  

    protected $allowedFields = ['date','description'];

}