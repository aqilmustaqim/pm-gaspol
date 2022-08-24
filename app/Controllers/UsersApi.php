<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class UsersApi extends ResourceController
{
    protected $modelName = 'App\Models\UsersModel';
    protected $format = 'json';

    public function index()
    {
        $datauser = $this->model->findAll();

        return $this->respond($datauser);
    }
}
