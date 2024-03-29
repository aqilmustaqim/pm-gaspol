<?php

namespace App\Controllers;

use App\Models\TeamModel;
use App\Models\UsersModel;
use App\Models\DetailTeamModel;
use App\Models\ProjectModel;
use App\Models\DetailProjectModel;
use App\Models\TaskModel;
use App\Models\ListTaskModel;
use App\Models\DetailTaskModel;

use function PHPSTORM_META\map;

class Team extends BaseController
{

    protected $teamModel;
    protected $usersModel;
    protected $detailTeamModel;
    protected $projectModel;
    protected $detailProjectModel;
    protected $taskModel;
    protected $detailTaskModel;
    protected $listTaskModel;


    public function __construct()
    {
        $this->teamModel = new TeamModel();
        $this->usersModel = new UsersModel();
        $this->detailTeamModel = new DetailTeamModel();
        $this->projectModel = new ProjectModel();
        $this->detailProjectModel = new DetailProjectModel();
        $this->taskModel = new TaskModel();
        $this->detailTaskModel = new DetailTaskModel();
        $this->listTaskModel = new ListTaskModel();
    }

    public function index()
    {

        if (!session()->get('logged_in')) {
            return redirect()->to(base_url());
        }

        //Data Team Untuk Admin
        $datateam = $this->teamModel->findAll();

        //Posisi User
        $db      = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('*');
        $builder->join('position', 'users.posisi_id = position.id');
        $query = $builder->get();
        $userPosition = $query->getRowArray();

        //Data Team Untuk Masing2 User
        //1. ID user Dari Session
        $users = $this->usersModel->where('email', session()->get('email'))->first();

        $db      = \Config\Database::connect();
        $builder = $db->table('detail_team');
        $builder->select('team.id as id_team,team,deskripsi_team,nama,foto');
        $builder->join('team', 'detail_team.id_team = team.id');
        $builder->join('users', 'detail_team.id_users = users.id');
        $builder->where('id_users', $users['id']);
        $query = $builder->get();
        $dataTeamUser = $query->getResultArray();

        $datausers = $this->usersModel->where('is_active', '1')->findAll();

        // Set breadcrumb data
        $breadcrumb = [
            'Team' => base_url('team')
        ];
        $data = [
            'title' => 'PM Gaspol || Team',
            'bread' => generate_breadcrumb($breadcrumb),
            'datateam' => $datateam,
            'datausers' => $datausers,
            'datateamuser' => $dataTeamUser,
            'userposition' => $userPosition
        ];

        return view('team/index', $data);
    }

    public function addTeam()
    {

        if (!session()->get('logged_in')) {
            return redirect()->to(base_url());
        }
        //Masukkan Database
        if ($this->teamModel->save([
            'team' => $this->request->getPost('namateam'),
            'deskripsi_team' => $this->request->getPost('deskripsiteam')
        ])) {
            echo 'berhasil';
        }
    }

    public function editTeam()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url());
        }
        // Update Databasenya
        if ($this->teamModel->save([
            'id' => $this->request->getPost('id'),
            'team' => $this->request->getPost('namaTeam'),
            'deskripsi_team' => $this->request->getPost('deskripsiTeam')
        ])) {
            echo 'berhasil';
        }
    }

    public function addMemberTeam()
    {
        //Tangkap Inputannya
        $idTeam = $this->request->getPost('idTeam');
        $idUser = $this->request->getPost('idUser');

        //cek apakah datanya ada 
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_team');
        $builder->select('*');
        $builder->where('id_team', $idTeam);
        $builder->where('id_users', $idUser);
        $query = $builder->get();
        $detailteam = $query->getRowArray();

        //Kalau Datanya Gak Ada Berarti Di Insert
        if ($detailteam == null) {
            //Masukan
            //Masukkan Ke Database Dong
            if ($this->detailTeamModel->save([
                'id_team' => $idTeam,
                'id_users' => $idUser
            ])) {
                echo 'berhasil';
            }
        } else {
            //Hapus
            if ($this->detailTeamModel->delete($detailteam['id'])) {
                echo 'hapus';
            }
        }
    }

    public function leaveTeam($idTeam)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url());
        }

        $users = $this->usersModel->where('email', session()->get('email'))->first();

        $db      = \Config\Database::connect();
        $builder = $db->table('detail_team');
        $builder->select('*');
        $builder->where('id_team', $idTeam);
        $builder->where('id_users', $users['id']);
        $query = $builder->get();
        $leavemember = $query->getRowArray();

        //Cek Apakah Ada Member Yang Mau Leave
        if ($leavemember) {
            if ($this->detailTeamModel->delete($leavemember['id'])) {
                session()->setFlashdata('team', 'Leave Team');
                return redirect()->to(base_url('team'));
            }
        }
    }

    public function deleteTeam($idTeam)
    {

        if (!session()->get('logged_in')) {
            return redirect()->to(base_url());
        } else {
            //Kalau Ada Session
            //Cek Apakah Admin Kalau Bukan Tendang
            if (session()->get('role_id') != 1) {
                return redirect()->to(base_url());
            }
        }
        //Hapus Team Dari Database
        if ($this->teamModel->delete($idTeam)) {
            //Kalau Berhasil Maka Cek Lagi Apakah Team yang dihapus ada membernya
            $db      = \Config\Database::connect();
            $builder = $db->table('detail_team');
            $builder->select('*');
            $builder->where('id_team', $idTeam);
            $query = $builder->get();
            $memberteam = $query->getResultArray();

            //Cek apakah ada membernya 
            if ($memberteam) {
                //Kalau Ada Hapus Semua 
                //Lakukan Pake Foreach
                foreach ($memberteam as $mt) {
                    $this->detailTeamModel->delete($mt['id']);
                }
            }

            // Cek Juga Apakah Team nya udah ada project ? Kalau udah hapus project nya juga
            $project = $this->projectModel->where('id_team', $idTeam)->findAll();
            if ($project) {
                // Hapus Semua Project yang teamnya sama
                foreach ($project as $p) {
                    $this->projectModel->delete($p['id']);

                    // Cek apakah di project sudah ada member nya jika sudah ada hapus juga detail projectnya
                    $detailproject = $this->detailProjectModel->where('id_project', $p['id'])->findAll();
                    if ($detailproject) {
                        foreach ($detailproject as $dp) {
                            $this->detailProjectModel->delete($dp['id']);
                        }
                    }

                    // cek juga apakah didalem project ada task jika ada hapus juga tasknya
                    $task = $this->taskModel->where('id_project', $p['id'])->findAll();
                    if ($task) {
                        foreach ($task as $t) {
                            $this->taskModel->delete($t['id']);


                            // Cek Apakah didalam task ada detail task ?
                            $detailtask = $this->detailTaskModel->where('id_task', $t['id'])->findAll();
                            if ($detailtask) {
                                foreach ($detailtask as $dt) {
                                    $this->detailTaskModel->delete($dt['id']);
                                }
                            }

                            // cek juga apakah ada list task nya
                            $listtask = $this->listTaskModel->where('id_task', $t['id'])->findAll();
                            if ($listtask) {
                                foreach ($listtask as $lt) {
                                    $this->listTaskModel->delete($lt['id']);
                                }
                            }
                        }
                    }
                }
            }

            session()->setFlashdata('team', 'Menghapus Team Dan Seluruh isinya');
            return redirect()->to(base_url('team'));
        }
    }

    public function detailTeam($idTeam)
    {

        if (!session()->get('logged_in')) {
            return redirect()->to(base_url());
        }

        if (session()->get('role_id') != 1) {

            //USERS
            $users = $this->usersModel->where('email', session()->get('email'))->first();

            //Cek Apakah Dia Ada Di Team Yang Benar
            $db      = \Config\Database::connect();
            $builder = $db->table('detail_team');
            $builder->select('*');
            $builder->where('id_team', $idTeam);
            $builder->where('id_users', $users['id']);
            $query = $builder->get();
            $cekusers = $query->getResultArray();

            if (!$cekusers) {
                return redirect()->to(base_url('team'));
            }
        }

        //Menampilkan Semua Users Yang Status Nya Aktif
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_team');
        $builder->select('detail_team.id as id_detail_team,users.id as id,nama,foto');
        $builder->join('users', 'detail_team.id_users = users.id');
        $builder->where('id_team', $idTeam);
        $builder->where('is_active', '1');
        $query = $builder->get();
        $datausers = $query->getResultArray();
        //$datausers = $this->usersModel->where('is_active', '1')->findAll();

        //Menampilkan Semua Data DetailTeam yang ID Team Nya Sama Dengan ID
        $detailteam = $this->teamModel->where('id', $idTeam)->first();

        //Menampilkan Semua Data Project Yang ID TEAM NYA SAMA 
        $project = $this->projectModel->where('id_team', $idTeam)->findAll();

        //Menampilkan Semua Data Project Sesuai Dengan User Yg Login
        $users = $this->usersModel->where('email', session()->get('email'))->first();

        $db      = \Config\Database::connect();
        $builder = $db->table('detail_project');
        $builder->select('project.id as id_project,nama_project,tanggal_mulai,batas_waktu');
        $builder->join('project', 'detail_project.id_project = project.id');
        $builder->join('users', 'detail_project.id_users = users.id');
        $builder->where('id_team', $idTeam);
        $builder->where('id_users', $users['id']);
        $query = $builder->get();
        $projectUsers = $query->getResultArray();

        //Query Untuk Mengambil Foto Member Team
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_team');
        $builder->select('nama,foto,role');
        $builder->join('team', 'detail_team.id_team = team.id');
        $builder->join('users', 'detail_team.id_users = users.id');
        $builder->join('user_role', 'users.role_id = user_role.id');
        $builder->where('id_team', $idTeam);
        $query = $builder->get();
        $fotoMemberTeam = $query->getResultArray();

        $breadcrumb = [
            'Team' => base_url('team'),
            'Detail Team' => base_url("team/detailTeam/" . $idTeam)
        ];

        $data = [
            'title' => 'PM Gaspol || Detail Team',
            'bread' => generate_breadcrumb($breadcrumb),
            'detailTeam' => $detailteam,
            'fotoMemberTeam' => $fotoMemberTeam,
            'idTeam' => $idTeam,
            'project' => $project,
            'datausers' => $datausers,
            'projectUsers' => $projectUsers
        ];

        return view('team/detailTeam', $data);
    }
}
