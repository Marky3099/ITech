<?php

namespace App\Models;

use CodeIgniter\Model;

class Fcu_no extends Model
{
    protected $table      = 'fcu_no';
    protected $primaryKey = 'fcuno';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
  

    protected $allowedFields = ['fcu'];

}