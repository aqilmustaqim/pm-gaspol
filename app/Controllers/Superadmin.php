<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Superadmin extends BaseController
{

    public function index()
    {

        //Mengambil Data Seluruh Team
        $db      = \Config\Database::connect();
        $builder = $db->table('project');
        $builder->select('team,id_team');
        $builder->distinct();
        $builder->join('team', 'project.id_team = team.id');
        $builder->groupBy('team.id');
        $query = $builder->get();
        $team = $query->getResultArray();

        $db      = \Config\Database::connect();
        $builder = $db->table('project');
        $builder->select('COUNT(project.nama_project) as jumlah_project');
        $builder->join('team', 'project.id_team = team.id');
        $builder->groupBy('team.id');
        $query = $builder->get();
        $jumlahProjectTeam = $query->getResultArray();

        //Mengambil Data Team Yang Ada Project
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_project');
        $builder->select('nama_project,status_project,team,id_team');
        $builder->join('project', 'detail_project.id_project = project.id');
        $builder->distinct();
        $builder->join('team', 'project.id_team = team.id');
        $query = $builder->get();
        $teamproject = $query->getResultArray();





        if (!session()->get('nama')) {
            return redirect()->to(base_url());
        }

        $data = [
            'title' => 'PM Gaspol || Dashboard',
            'bread' => 'Dashboard',
            'team' => $team,
            'jumlahProject' => $jumlahProjectTeam,
            'teamproject' => $teamproject
        ];

        return view('superadmin/index', $data);
    }
}
