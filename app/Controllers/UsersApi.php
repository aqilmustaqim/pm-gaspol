<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UsersModel;

class UsersApi extends ResourceController
{
    use ResponseTrait;

    protected $modelName = 'App\Models\UsersModel';
    protected $format = 'json';

    public function index()
    {
        $model = new UsersModel();
        $datauser = $model->findAll();

        return $this->respond($datauser);
    }

    public function show($id = null)
    {
        $model = new UsersModel();
        $data = $model->where('id', $id)->first();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Tidak ditemukan data user');
        }
    }
}
