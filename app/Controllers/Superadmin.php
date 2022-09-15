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
        $query = $builder->get();
        $team = $query->getResultArray();




        if (!session()->get('nama')) {
            return redirect()->to(base_url());
        }

        $data = [
            'title' => 'PM Gaspol || Dashboard',
            'bread' => 'Dashboard',
            'team' => $team
        ];

        return view('superadmin/index', $data);
    }
}
