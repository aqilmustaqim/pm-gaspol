<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UsersModel;
use Firebase\JWT\JWT;

class AuthApi extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */

    public function login()
    {


        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required'
        ];
        //validasi
        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        $model = new UsersModel();

        $user = $model->where('email', $this->request->getVar('email'))->first();
        if (!$user) return $this->failNotFound('Email Tidak DiTemukan');


        if ($user['password'] == md5($this->request->getVar('password'))) {
            return $this->respond('OK NANTI TOKETNYA DISINI');
        } else {
            return $this->fail('Password Salah');
        }
    }
}
