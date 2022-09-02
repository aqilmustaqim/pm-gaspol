<?php

namespace App\Controllers;

use App\Database\Migrations\DetailProject;
use App\Models\TeamModel;
use App\Models\UsersModel;
use App\Models\DetailTeamModel;
use App\Models\ProjectModel;
use App\Models\DetailProjectModel;

use function PHPSTORM_META\map;

class Project extends BaseController
{

    protected $teamModel;
    protected $usersModel;
    protected $detailTeamModel;
    protected $projectModel;
    protected $detailProjectModel;

    public function __construct()
    {
        $this->teamModel = new TeamModel();
        $this->usersModel = new UsersModel();
        $this->detailTeamModel = new DetailTeamModel();
        $this->projectModel = new ProjectModel();
        $this->detailProjectModel = new DetailProjectModel();
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
}
