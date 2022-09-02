<?php

namespace App\Controllers;

use App\Models\TeamModel;
use App\Models\UsersModel;
use App\Models\DetailTeamModel;
use App\Models\ProjectModel;

use function PHPSTORM_META\map;

class Team extends BaseController
{

    protected $teamModel;
    protected $usersModel;
    protected $detailTeamModel;
    protected $projectModel;

    public function __construct()
    {
        $this->teamModel = new TeamModel();
        $this->usersModel = new UsersModel();
        $this->detailTeamModel = new DetailTeamModel();
        $this->projectModel = new ProjectModel();
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
        $data = [
            'title' => 'PM Gaspol || Team',
            'bread' => 'Team',
            'datateam' => $datateam,
            'datausers' => $datausers,
            'datateamuser' => $dataTeamUser,
            'userposition' => $userPosition
        ];

        return view('team/index', $data);
    }

    public function addTeam()
    {
        //Masukkan Database
        if ($this->teamModel->save([
            'team' => $this->request->getPost('namateam'),
            'deskripsi_team' => $this->request->getPost('deskripsiteam')
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
            session()->setFlashdata('team', 'Menghapus Team Dan Member');
            return redirect()->to(base_url('team'));
        }
    }

    public function detailTeam($idTeam)
    {

        if (!session()->get('logged_in')) {
            return redirect()->to(base_url());
        }

        //Menampilkan Semua Users Yang Status Nya Aktif
        $datausers = $this->usersModel->where('is_active', '1')->findAll();

        //Menampilkan Semua Data DetailTeam yang ID Team Nya Sama Dengan ID
        $detailteam = $this->teamModel->where('id', $idTeam)->first();

        //Menampilkan Semua Data Project Yang ID TEAM NYA SAMA 
        $project = $this->projectModel->where('id_team', $idTeam)->findAll();

        //Query Untuk Mengambil Foto Member Team
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_team');
        $builder->select('nama,foto');
        $builder->join('team', 'detail_team.id_team = team.id');
        $builder->join('users', 'detail_team.id_users = users.id');
        $builder->where('id_team', $idTeam);
        $query = $builder->get();
        $fotoMemberTeam = $query->getResultArray();

        $data = [
            'title' => 'PM Gaspol || Detail Team',
            'bread' => 'Detail Team',
            'detailTeam' => $detailteam,
            'fotoMemberTeam' => $fotoMemberTeam,
            'idTeam' => $idTeam,
            'project' => $project,
            'datausers' => $datausers
        ];

        return view('team/detailTeam', $data);
    }
}
