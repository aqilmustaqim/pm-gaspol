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

    public function create()
    {
        $model = new UsersModel();
        $data = [
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'foto' => $this->request->getVar('foto'),
            'role_id' => $this->request->getVar('role_id'),
            'posisi_id' => $this->request->getVar('posisi_id'),
            'is_active' => $this->request->getVar('is_active'),
            'role_id' => $this->request->getVar('role_id'),
            'created_at' => $this->request->getVar('created_at'),
            'updated_at' => $this->request->getVar('updated_at')
        ];
        $model->insert($data);
        $response = [
            'status' => '201',
            'error' => null,
            'message' => [
                'success' => 'Data Users Berhasil DiTambahkan'
            ]

        ];
        return $this->respondCreated($response);
    }
}
