<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UsersModel;
use Firebase\JWT\Key;
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

        $model = new UsersModel();

        $user = $model->where('email', $this->request->getVar('email'))->first();
        if (!$user) return $this->failNotFound('Email Tidak DiTemukan');


        if ($user['password'] == md5($this->request->getVar('password'))) {
            //JWT
            //1.Ambil Token Secret
            $key = getenv('JWT_SECRET_KEY');
            //2. ISI PAYLOAD
            $payload = array(
                "iat" => time(),
                "exp" => time() + 259600,
                "uid" => $user['id'],
                "nama" => $user['nama'],
                "role" => $user['role_id'],
                "email" => $user['email']
            );

            $token = JWT::encode($payload, $key, 'HS256');

            $response =  [
                'message' => 'Login Berhasil',
                'id' => $user['id'],
                "nama" => $user['nama'],
                'email' => $user['email'],
                'role' => $user['role_id'],
                'token' => $token
            ];
            return $this->respond($response);
        } else {
            return $this->fail('Password Salah');
        }
    }
}
