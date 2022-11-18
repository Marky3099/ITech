<?php

namespace App\Models;

use CodeIgniter\Model;

class Event_fcu extends Model
{
    protected $table      = 'event_fcu';
    protected $returnType     = 'array';
    protected $allowedFields = ['id','fcuno','aircon_id','quantity'];

}