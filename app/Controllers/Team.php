<?php

namespace App\Controllers;

use App\Models\TeamModel;
use App\Models\UsersModel;
use App\Models\DetailTeamModel;

class Team extends BaseController
{

    protected $teamModel;
    protected $usersModel;
    protected $detailTeamModel;

    public function __construct()
    {
        $this->teamModel = new TeamModel();
        $this->usersModel = new UsersModel();
        $this->detailTeamModel = new DetailTeamModel();
    }

    public function index()
    {

        $datateam = $this->teamModel->findAll();
        $datausers = $this->usersModel->findAll();
        $data = [
            'title' => 'PM Gaspol || Team',
            'bread' => 'Team',
            'datateam' => $datateam,
            'datausers' => $datausers
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
}
