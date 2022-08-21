<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Superadmin extends BaseController
{

    public function index()
    {

        if (!session()->get('nama')) {
            return redirect()->to(base_url());
        }

        $data = [
            'title' => 'PM Gaspol || Dashboard',
            'bread' => 'Dashboard'
        ];

        return view('superadmin/index', $data);
    }
}
