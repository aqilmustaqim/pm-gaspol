<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailTaskModel extends Model
{
    protected $table      = 'detail_task';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_task', 'id_users'];
}
