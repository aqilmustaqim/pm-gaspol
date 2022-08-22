<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url());
        }
        $data = [
            'title' => 'PM Gaspol || Dashboard',
            'bread' => 'Dashboard'
        ];

        return view('dashboard/index', $data);
    }
}
