<?php

namespace App\Controllers;

use App\Database\Migrations\DetailProject;
use App\Models\UsersModel;
use App\Models\ProjectModel;
use App\Models\DetailProjectModel;
use App\Models\TaskModel;
use App\Models\DetailTaskModel;
use App\Models\ListTaskModel;

use function PHPSTORM_META\map;

class Task extends BaseController
{

    protected $usersModel;
    protected $projectModel;
    protected $detailProjectModel;
    protected $detailTaskModel;
    protected $taskModel;
    protected $listTaskModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->projectModel = new ProjectModel();
        $this->detailProjectModel = new DetailProjectModel();
        $this->detailTaskModel = new DetailTaskModel();
        $this->taskModel = new TaskModel();
        $this->listTaskModel = new ListTaskModel();
    }

    public function detailTask($idTask)
    {
        //Ambil Data Yang Login
        $usersTask = $this->usersModel->where('email', session()->get('email'))->first();

        //Validasi Login
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url());
        }

        if (session()->get('role_id') != 1) {
            //Cek Apakah Users Ada Di Dalam Task Ini
            $db      = \Config\Database::connect();
            $builder = $db->table('detail_task');
            $builder->select('*');
            $builder->where('id_task', $idTask);
            $builder->where('id_users', $usersTask['id']);
            $query = $builder->get();
            $taskUsers = $query->getRowArray();

            if ($taskUsers == null) {
                return redirect()->to(base_url('team'));
            }
        }
        //Akhir Validasi 

        //Tampilkan Data Detail Task Nya
        $datatask = $this->taskModel->where('id', $idTask)->first();

        //Menampilkan Data Users Yang Ada Di Dalam Tasknya ( FOTO NAMA DLL )
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_task');
        $builder->select('detail_task.id as id_detail_task,users.id as id,nama,foto');
        $builder->join('users', 'detail_task.id_users = users.id');
        $builder->where('id_task', $idTask);
        $query = $builder->get();
        $memberTask = $query->getResultArray();

        //Menampilkan Data List Task ( ADMIN DAN LEADER )
        $datalist = $this->listTaskModel->where('id_task', $idTask)->findAll();

        //Menampilkan semua Total Checklist
        $db      = \Config\Database::connect();
        $builder = $db->table('list_task');
        $builder->selectCount('id');
        $builder->where('id_task', $idTask);
        $query = $builder->get();
        $totalchecklist = $query->getRowArray();

        //Menampilkan Semua Total Checklist Yang Udah Selesai
        $db      = \Config\Database::connect();
        $builder = $db->table('list_task');
        $builder->selectCount('id');
        $builder->where('id_task', $idTask);
        $builder->where('status_list', 1);
        $query = $builder->get();
        $totalchecklistdone = $query->getRowArray();

        $data = [
            'title' => 'PM Gaspol || Detail Task',
            'bread' => 'Detail Task',
            'task' => $datatask,
            'membertask' => $memberTask,
            'list' => $datalist,
            'totalchecklist' => $totalchecklist,
            'totalchecklistdone' => $totalchecklistdone
        ];

        return view('task/detailTask', $data);
    }

    public function addList()
    {
        //Tangkap Inputan 
        $idTask = $this->request->getVar('idTask');
        $namaList = $this->request->getVar('namaList');

        //Masukkan Database
        if ($this->listTaskModel->save([
            'id_task' => $idTask,
            'list' => $namaList,
            'status_list' => 0
        ])) {
            echo 'berhasil';
        }
    }

    public function addStatusList()
    {
        //Tangkap Inputannya
        $idList = $this->request->getPost('idList');

        //cek apakah datanya ada 
        $db      = \Config\Database::connect();
        $builder = $db->table('list_task');
        $builder->select('*');
        $builder->where('id', $idList);
        $builder->where('status_list', 0);
        $query = $builder->get();
        $statuslist = $query->getRowArray();

        //Kalau Datanya Gak Ada Berarti Status nya jadi 0
        if ($statuslist == null) {
            //Masukan
            //Masukkan Ke Database Dong
            if ($this->listTaskModel->save([
                'id' => $idList,
                'status_list' => 0
            ])) {
                echo 'tidakselesai';
            }
        } else {
            //Kalau ada berarti statusnya mau diubah ke 1
            if ($this->listTaskModel->save([
                'id' => $idList,
                'status_list' => 1
            ])) {
                echo 'selesai';
            }
        }
    }
}
