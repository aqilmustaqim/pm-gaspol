<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table      = 'task';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_project', 'nama_task', 'deskripsi_task', 'tanggal_task', 'batas_task', 'status_task'];
}
