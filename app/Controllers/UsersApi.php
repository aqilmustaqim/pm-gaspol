<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UsersModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use CodeIgniter\Model;

use function PHPUnit\Framework\returnSelf;

class UsersApi extends ResourceController
{
    use ResponseTrait;

    protected $modelName = 'App\Models\UsersModel';
    protected $format = 'json';

    public function index()
    {
        $model = new UsersModel();
        $datauser['users'] = $model->findAll();

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
            'password' => md5($this->request->getVar('password')),
            'foto' => 'default.png',
            'role_id' => 3,
            'posisi_id' => 1,
            'is_active' => 0,
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
