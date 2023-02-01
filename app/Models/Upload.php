<?php

namespace App\Models;

use CodeIgniter\Model;

class Upload extends Model
{
    protected $table      = 'upload';
    protected $primaryKey = 'upload_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
  

    protected $allowedFields = ['id','upload_description','user_id','image','uploaded_at'];

}