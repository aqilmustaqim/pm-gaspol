<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $table      = 'project';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_team', 'nama_project', 'deskripsi_project', 'tanggal_mulai', 'batas_waktu', 'status_project'];
}
