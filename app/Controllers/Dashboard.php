<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('nama')) {
            return redirect()->to(base_url());
        }
        $data = [
            'title' => 'PM Gaspol || Dashboard'
        ];

        return view('dashboard/index', $data);
    }
}
