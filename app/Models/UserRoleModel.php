<?php

namespace App\Models;

use CodeIgniter\Model;

class UserRoleModel extends Model
{
    protected $table      = 'user_role';
    protected $allowedFields = ['nama', 'email', 'password', 'role_id', 'is_active'];
}
