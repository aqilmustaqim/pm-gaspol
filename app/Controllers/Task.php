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

        $db = \Config\Database::connect();
        $builder = $db->table('list_task');
        $builder->select('id_project');
        $builder->join('task', 'list_task.id_task = task.id');
        $builder->where('id_task', $idTask);
        $query = $builder->get();
        $dataListJoinProject = $query->getRowArray();
        // Periksa apakah hasil query memiliki data atau tidak
        if ($dataListJoinProject) {
            $hasilListTaskJoinProject = $dataListJoinProject['id_project'];
            // Lakukan sesuatu dengan $dataListJoinProject
        } else {
            // Tidak ada data yang ditemukan, tidak perlu melakukan apa-apa
            $hasilListTaskJoinProject = 'Kosong';
        }


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

        // ROUTE BUAT BREADCRUMBS
        $db = \Config\Database::connect();
        $builder = $db->table('task');
        $builder->select('task.id as id,id_project,id_team');
        $builder->join('project', 'task.id_project = project.id');
        $builder->where('task.id', $idTask);
        $query = $builder->get();
        $dataroute = $query->getRowArray();

        $breadcrumb = [
            'Team' => base_url('team'),
            'Detail Team' => base_url("team/detailTeam/" . $dataroute['id_team']),
            'Detail Project' => base_url("project/detailProject/" . $dataroute['id_project']),
            'Detail Tasks' => base_url("task/detailTask/" . $idTask)
        ];

        $data = [
            'title' => 'PM Gaspol || Detail Task',
            'bread' => generate_breadcrumb($breadcrumb),
            'task' => $datatask,
            'membertask' => $memberTask,
            'list' => $datalist,
            'idTask' => $idTask,
            'idProject' => $hasilListTaskJoinProject,
            'totalchecklist' => $totalchecklist,
            'totalchecklistdone' => $totalchecklistdone
        ];

        return view('task/detailTask', $data);
    }

    public function deleteTask($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url());
        } else {
            //Kalau Ada Session
            //Cek yang login Admin gak , Kalau Bukan Tendang
            if (session()->get('role_id') != 1) {
                return redirect()->to(base_url());
            }
        }

        $task = $this->taskModel->where('id', $id)->first();

        // Lakukan Delete Tabel Task
        if ($this->taskModel->delete($id)) {
            // Hapus juga yang ada di detail task yang id projectnya sama
            $detailtask = $this->detailTaskModel->where('id_task', $id)->findAll();
            if ($detailtask) {
                foreach ($detailtask as $dt) {
                    $this->detailTaskModel->delete($dt['id']);
                }
            }

            // Hapus Juga yang ada di list task ( Checklist )
            $listtask = $this->listTaskModel->where('id_task', $id)->findAll();
            if ($listtask) {
                foreach ($listtask as $lt) {
                    $this->listTaskModel->delete($lt['id']);
                }
            }

            //FlashDatanya
            session()->setFlashdata('project', 'Menghapus Data Task');
            return redirect()->to(base_url('project/detailProject/' . $task['id_project']));
        }
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
