<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailProjectModel extends Model
{
    protected $table      = 'detail_project';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_project', 'id_users'];
}
