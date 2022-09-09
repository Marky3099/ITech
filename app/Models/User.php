<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'user_id';
 
    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
  
    protected $allowedFields = ['name', 'email','address','contact','user_img','password','position','code','active'];

  
}