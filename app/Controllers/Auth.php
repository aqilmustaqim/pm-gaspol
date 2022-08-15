<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'PM-GASPOL || Login'
        ];
        return view('auth/login', $data);
    }

    public function register()
    {
        $data = [
            'title' => 'PM-GASPOL || Register'
        ];
        return view('auth/register', $data);
    }
}
