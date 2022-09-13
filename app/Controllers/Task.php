<?php

namespace App\Controllers;

use App\Database\Migrations\DetailProject;
use App\Models\UsersModel;
use App\Models\ProjectModel;
use App\Models\DetailProjectModel;
use App\Models\TaskModel;
use App\Models\DetailTaskModel;

use function PHPSTORM_META\map;

class Task extends BaseController
{

    protected $usersModel;
    protected $projectModel;
    protected $detailProjectModel;
    protected $detailTaskModel;
    protected $taskModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->projectModel = new ProjectModel();
        $this->detailProjectModel = new DetailProjectModel();
        $this->detailTaskModel = new DetailTaskModel();
        $this->taskModel = new TaskModel();
    }

    public function detailTask($idTask)
    {
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

        //Tampilkan Data Detail Project Nya
        $datatask = $this->taskModel->where('id', $idTask)->first();
        //Menampilkan Data Users Yang Ada Di Dalam Tasknya
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_task');
        $builder->select('detail_task.id as id_detail_task,users.id as id,nama,foto');
        $builder->join('users', 'detail_task.id_users = users.id');
        $builder->where('id_task', $idTask);
        $query = $builder->get();
        $memberTask = $query->getResultArray();

        $data = [
            'title' => 'PM Gaspol || Detail Task',
            'bread' => 'Detail Task',
            'task' => $datatask,
            'membertask' => $memberTask
        ];

        return view('task/detailTask', $data);
    }

    public function addTask()
    {
        //Masukkan Ke Database Dong
        if ($this->taskModel->save([
            'id_project' => $this->request->getPost('idProject'),
            'nama_task' => $this->request->getPost('namaTask'),
            'deskripsi_task' => $this->request->getPost('deskripsiTask'),
            'tanggal_task' => $this->request->getPost('tanggalTask'),
            'batas_task' => $this->request->getPost('batasTask'),
            'status_task' => 0
        ])) {
            echo 'berhasil';
            //Kalau Berhasil Jalankan Session 
            //session()->getFlashdata('project', 'Menambahkan Task');
            //return redirect()->to(base_url('project/detailProject/' . $this->request->getPost('idProject')));
        }
    }

    public function addMemberTask()
    {

        //Tangkap Inputan
        $idTask = $this->request->getPost('idTask');
        $idUser = $this->request->getPost('idUser');

        //cek apakah datanya ada 
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_task');
        $builder->select('*');
        $builder->where('id_task', $idTask);
        $builder->where('id_users', $idUser);
        $query = $builder->get();
        $detailTask = $query->getRowArray();

        //Masukkan Database

        if ($detailTask == null) {
            //Kalau Datanya Kosong Berarti Datanya mau di insert
            if ($this->detailTaskModel->save([
                'id_task' => $idTask,
                'id_users' => $idUser
            ])) {
                echo 'berhasil';
            }
        } else {
            //Kalau Datanya Ada Berarti Datanya Mau Di Hapus
            if ($this->detailTaskModel->delete($detailTask['id'])) {
                echo 'hapus';
            }
        }
    }
}
