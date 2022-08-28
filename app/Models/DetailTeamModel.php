<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailTeamModel extends Model
{
    protected $table      = 'detail_team';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_team', 'id_project', 'id_users'];
}
