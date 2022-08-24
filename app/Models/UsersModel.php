<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $returnType = 'App\Entities\UsersApi';
    protected $allowedFields = ['nama', 'email', 'password', 'role_id', 'posisi_id', 'is_active', 'foto'];
}
