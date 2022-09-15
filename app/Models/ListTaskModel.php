<?php

namespace App\Models;

use CodeIgniter\Model;

class ListTaskModel extends Model
{
    protected $table      = 'list_task';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_task', 'list', 'status_list'];
}
