<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table      = 'users';
    protected $allowedFields = ['nama', 'email', 'password', 'role_id', 'is_active'];
}
