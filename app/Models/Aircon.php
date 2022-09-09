<?php

namespace App\Models;

use CodeIgniter\Model;

class Aircon extends Model
{
    protected $table      = 'aircon';
    protected $primaryKey = 'aircon_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
  

    protected $allowedFields = ['device_brand','aircon_type'];

}