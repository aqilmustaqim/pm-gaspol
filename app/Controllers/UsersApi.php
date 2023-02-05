<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UsersModel;
use App\Models\TeamModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use CodeIgniter\Model;

use function PHPUnit\Framework\returnSelf;

class UsersApi extends ResourceController
{
    use ResponseTrait;

    protected $modelName = 'App\Models\UsersModel';
    protected $format = 'json';

    //Show Member
    public function index()
    {
        // Instansiasi Model
        $model = new UsersModel();

        // Query CI Untuk Menampilkan Semua Member
        //$datauser['users'] = $model->where('is_active', 1)->findAll();

        $db      = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('nama,email,password,foto,role_id,posisi,is_active');
        $builder->join('position', 'users.posisi_id = position.id');
        $builder->join('user_role', 'users.role_id = user_role.id');
        $builder->where('is_active', '1');
        $query = $builder->get();
        $datauser['users'] = $query->getResultArray();

        return $this->respond($datauser);
    }
    //Show Approve Member
    public function userApprove()
    {
        $model = new UsersModel();
        $datauser['users'] = $model->where('is_active', 0)->findAll();

        //
        return $this->respond($datauser);
    }

    public function approve($id = null)
    {
        $model = new UsersModel();

        //Update Aktifnya
        $data = [
            'is_active' => 1
        ];

        $model->update($id, $data);
        $response = [
            'status' => '200',
            'error' => null,
            'message' => [
                'success' => 'Data User Berhasil Di Aktivasi'
            ]

        ];
        return $this->respondCreated($response);
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

    public function register()
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

    public function createTeam()
    {
        $model = new TeamModel();
        $data = [
            'team' => $this->request->getVar('team'),
            'deskripsi_team' => $this->request->getVar('deskripsi')
        ];
        $model->insert($data);
        $response = [
            'status' => '201',
            'error' => null,
            'message' => [
                'success' => 'Berhasil Menambahkan Data Team'
            ]

        ];
        return $this->respondCreated($data, 'Created');
    }

    public function listTeam()
    {
        $model = new TeamModel();

        // Query CI Untuk Menampilkan Semua Team
        $datateam['team'] = $model->findAll();
        // $db      = \Config\Database::connect();
        // $builder = $db->table('team');
        // $builder->select('id,team,deskripsi_team');
        // $query = $builder->get();
        // $datateam = $query->getResultArray();


        // $db      = \Config\Database::connect();
        // $builder = $db->table('project');
        // $builder->selectCount('project.id');
        // $builder->where('id_team', $datateam['id']);
        // $query = $builder->get();
        // $totalProjectTeam = $query->getResultArray();

        return $this->respond($datateam);
    }

    public function deleteTeam($id = null)
    {
        $model = new TeamModel();
        $data = $model->delete($id);

        if ($data) {
            $response = [
                'status' => '200',
                'error' => null,
                'message' => [
                    'success' => 'Berhasil Menghapus Team'
                ]
            ];
            return $this->respondDeleted($response);
        }
    }
}
