<?php

namespace App\Models;

use CodeIgniter\Model;

class Event_aircon extends Model
{
    protected $table      = 'event_aircon';
    protected $returnType     = 'array';
    protected $allowedFields = ['id','aircon_id','quantity'];

}