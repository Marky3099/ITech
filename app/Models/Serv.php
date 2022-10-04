<?php

namespace App\Models;

use CodeIgniter\Model;

class Serv extends Model
{
    protected $table      = 'services';
    protected $primaryKey = 'serv_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
  

    protected $allowedFields = ['serv_name','serv_type','serv_description','price','serv_color'];

}