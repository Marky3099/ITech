<?php

namespace App\Models;

use CodeIgniter\Model;

class Emp extends Model
{
    protected $table      = 'employees';
    protected $primaryKey = 'emp_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
  

    protected $allowedFields = ['emp_name', 'emp_email','emp_address','emp_contact','emp_position'];

    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;
}