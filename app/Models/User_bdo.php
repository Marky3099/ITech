<?php

namespace App\Models;

use CodeIgniter\Model;

class User_bdo extends Model
{
    protected $table      = 'users_bdo';
    protected $primaryKey = 'bdo_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
  

    protected $allowedFields = ['bdo_fname','bdo_lname','bdo_email','bdo_contact','bdo_company','bdo_address','bdo_unique_code','bdo_password','client_id','status'];

}