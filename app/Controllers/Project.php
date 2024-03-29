<?php

namespace App\Controllers;

use App\Modules\Breadcrumbs\Breadcrumbs;
use App\Database\Migrations\DetailProject;
use App\Models\TeamModel;
use App\Models\UsersModel;
use App\Models\DetailTeamModel;
use App\Models\ProjectModel;
use App\Models\DetailProjectModel;
use App\Models\TaskModel;
use App\Models\DetailTaskModel;
use App\Models\ListTaskModel;
use App\libraries\Breadcrumb;


use function PHPSTORM_META\map;

class Project extends BaseController
{

    protected $teamModel;
    protected $usersModel;
    protected $detailTeamModel;
    protected $projectModel;
    protected $detailProjectModel;
    protected $detailTaskModel;
    protected $taskModel;
    protected $listTaskModel;
    protected $breadcrumbs;

    public function __construct()
    {
        $this->teamModel = new TeamModel();
        $this->usersModel = new UsersModel();
        $this->detailTeamModel = new DetailTeamModel();
        $this->projectModel = new ProjectModel();
        $this->detailProjectModel = new DetailProjectModel();
        $this->detailTaskModel = new DetailTaskModel();
        $this->taskModel = new TaskModel();
        $this->listTaskModel = new ListTaskModel();
    }

    public function listProject()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url());
        }

        if (session()->get('role_id') != 1) {
            return redirect()->to(base_url('team'));
        }

        // Foto Member yang terlibat dalam project
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_project');
        $builder->select('id_users,nama,foto');
        $builder->join('users', 'detail_project.id_users = users.id');
        $builder->distinct();
        $query = $builder->get();
        $fotoMemberProject = $query->getResultArray();

        // List All Project Join Team
        $db      = \Config\Database::connect();
        $builder = $db->table('project');
        $builder->select('project.id as id,nama_project,deskripsi_project,tanggal_mulai,batas_waktu,status_project,team');
        $builder->join('team', 'project.id_team = team.id');
        $query = $builder->get();
        $allproject = $query->getResultArray();

        // Ambil Data Team
        $team = $this->teamModel->findAll();

        $breadcrumb = [
            'List Project' => base_url("project/listProject")
        ];



        $data = [
            'title' => 'PM Gaspol || List Project',
            'bread' => generate_breadcrumb($breadcrumb),
            'fotoMemberProject' => $fotoMemberProject,
            'project' => $allproject,
            'team' => $team
        ];

        return view('project/listproject', $data);
    }

    public function addProject()
    {
        //Masukkan Ke Database
        if ($this->projectModel->save([
            'id_team' => $this->request->getPost('idTeam'),
            'nama_project' => $this->request->getPost('namaProject'),
            'deskripsi_project' => $this->request->getPost('deskripsiProject'),
            'tanggal_mulai' => $this->request->getPost('tanggalMulai'),
            'batas_waktu' => $this->request->getPost('batasWaktu'),
            'status_project' => 1
        ])) {
            //Kalau Berhasil
            echo 'berhasil';
        }
    }
    public function editProject()
    {
        //Masukkan Ke Database
        if ($this->projectModel->save([
            'id' => $this->request->getPost('id'),
            'id_team' => $this->request->getPost('idTeam'),
            'nama_project' => $this->request->getPost('namaProject'),
            'deskripsi_project' => $this->request->getPost('deskripsiProject'),
            'tanggal_mulai' => $this->request->getPost('tanggalMulai'),
            'batas_waktu' => $this->request->getPost('batasWaktu'),
            'status_project' => 1
        ])) {
            //Kalau Berhasil
            echo 'berhasil';
        }
    }

    public function addMemberProject()
    {

        //Tangkap Inputan
        $idProject = $this->request->getPost('idProject');
        $idUser = $this->request->getPost('idUser');

        //cek apakah datanya ada 
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_project');
        $builder->select('*');
        $builder->where('id_project', $idProject);
        $builder->where('id_users', $idUser);
        $query = $builder->get();
        $detailproject = $query->getRowArray();

        //Masukkan Database

        if ($detailproject == null) {
            //Kalau Datanya Kosong Berarti Datanya mau di insert
            if ($this->detailProjectModel->save([
                'id_project' => $idProject,
                'id_users' => $idUser
            ])) {
                echo 'berhasil';
            }
        } else {
            //Kalau Datanya Ada Berarti Datanya Mau Di Hapus
            if ($this->detailProjectModel->delete($detailproject['id'])) {
                echo 'hapus';
            }
        }
    }

    public function deleteProject($id)
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
        $project = $this->projectModel->where('id', $id)->first();
        //Hapus Project
        if ($this->projectModel->delete($id)) {
            //Kalau Berhasil Hapus
            //Hapus Juga Yang Ada Di Detail Project Yang Id Projectnya sama
            $detailproject = $this->detailProjectModel->where('id_project', $id)->findAll();
            if ($detailproject) {
                foreach ($detailproject as $dp) {
                    $this->detailProjectModel->delete($dp['id']);
                }
            }

            // Hapus juga yang ada di task yang id projectnya sama
            $task = $this->taskModel->where('id_project', $id)->findAll();
            if ($task) {
                foreach ($task as $t) {
                    $this->taskModel->delete($t['id']);

                    // Hapus juga yang ada di detail task yang id projectnya sama
                    $detailtask = $this->detailTaskModel->where('id_task', $t['id'])->findAll();
                    if ($detailtask) {
                        foreach ($detailtask as $dt) {
                            $this->detailTaskModel->delete($dt['id']);
                        }
                    }

                    // Hapus Juga yang ada di list task ( Checklist )
                    $listtask = $this->listTaskModel->where('id_task', $t['id'])->findAll();
                    if ($listtask) {
                        foreach ($listtask as $lt) {
                            $this->listTaskModel->delete($lt['id']);
                        }
                    }
                }
            }




            //FlashDatanya
            session()->setFlashdata('team', 'Menghapus Data Project');
            return redirect()->to(base_url('team/detailTeam/' . $project['id_team']));
        }
    }

    public function detailProject($id)
    {
        $usersProject = $this->usersModel->where('email', session()->get('email'))->first();

        //Validasi Login
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url());
        }

        if (session()->get('role_id') != 1) {
            //Cek Apakah Users Ada Di Dalam Project Ini
            $db      = \Config\Database::connect();
            $builder = $db->table('detail_project');
            $builder->select('*');
            $builder->where('id_project', $id);
            $builder->where('id_users', $usersProject['id']);
            $query = $builder->get();
            $projectUsers = $query->getRowArray();

            if ($projectUsers == null) {
                return redirect()->to(base_url('team'));
            }
        }
        //Akhir Validasi 

        //Tampilkan Data Detail Project Nya
        $dataProject = $this->projectModel->where('id', $id)->first();

        //Tampilkan Data Tasknya Untuk ( ADMIN DAN LEADER )
        $dataTask = $this->taskModel->where('id_project', $id)->findAll();

        //Tampilkan Data Task Untuk ( MEMBER )

        $users = $this->usersModel->where('email', session()->get('email'))->first();

        $db      = \Config\Database::connect();
        $builder = $db->table('detail_task');
        $builder->select('id_task,nama_task,deskripsi_task,tanggal_task,batas_task');
        $builder->join('task', 'detail_task.id_task = task.id');
        $builder->join('users', 'detail_task.id_users = users.id');
        $builder->where('id_project', $id);
        $builder->where('id_users', $users['id']);
        $query = $builder->get();
        $dataTaskMember = $query->getResultArray();

        //Menghitung Total Task
        $db      = \Config\Database::connect();
        $builder = $db->table('task');
        $builder->selectCount('id');
        $builder->where('id_project', $id);
        $query = $builder->get();
        $hasil = $query->getRowArray();
        $totalTask = $hasil['id'];

        //Menampilkan Data Users Yang Ada Di Dalam Projectnya
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_project');
        $builder->select('detail_project.id as id_detail_project,users.id as id,nama,foto');
        $builder->join('users', 'detail_project.id_users = users.id');
        $builder->where('id_project', $id);
        $builder->where('is_active', '1');
        $query = $builder->get();
        $datausers = $query->getResultArray();

        $breadcrumb = [
            'Team' => base_url('team'),
            'Detail Team' => base_url("team/detailTeam/" . $dataProject['id_team']),
            'Detail Project' => base_url("project/detailProject/" . $id)
        ];

        $data = [
            'title' => 'PM Gaspol || Detail Project',
            'bread' => generate_breadcrumb($breadcrumb),
            'project' => $dataProject,
            'task' => $dataTask,
            'taskmember' => $dataTaskMember,
            'totalTask' => $totalTask,
            'datausers' => $datausers
        ];

        return view('project/detailProject', $data);
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
