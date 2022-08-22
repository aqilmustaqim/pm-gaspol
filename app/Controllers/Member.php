<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Member extends BaseController
{

    protected $usersModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }

    public function index()
    {

        //Ambil Data User
        $users = $this->usersModel->findAll();

        $data = [
            'title' => 'List Member',
            'validation' => \Config\Services::validation(),
            'bread' => 'List Member',
            'users' => $users
        ];

        return view('member/listmember', $data);
    }
}
