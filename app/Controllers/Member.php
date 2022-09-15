<?php

namespace App\Controllers;

use App\Database\Migrations\DetailTeam;
use App\Models\UsersModel;
use App\Models\UserRoleModel;
use App\Models\PositionModel;
use App\Models\DetailProjectModel;
use App\Models\DetailTeamModel;
use App\Models\DetailTaskModel;

class Member extends BaseController
{

    protected $usersModel;
    protected $userRoleModel;
    protected $positionModel;
    protected $detailProjectModel;
    protected $detailTeamModel;
    protected $detailTaskModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->userRoleModel = new UserRoleModel();
        $this->positionModel = new PositionModel();
        $this->detailProjectModel = new DetailProjectModel();
        $this->detailTeamModel = new DetailTeamModel();
        $this->detailTaskModel = new DetailTaskModel();
    }

    public function index()
    {

        if (!session()->get('logged_in')) {
            return redirect()->to(base_url());
        } else if (session()->get('role_id') != 1) {
            return redirect()->to(base_url('dashboard'));
        }

        //Ambil Data User Yang Belum Di Aktivasi
        $db      = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('*');
        $builder->where('is_active', '0');
        $query = $builder->get();
        $approvelist = $query->getResultArray();

        //Ambil Data User Yang Belum Di Aktivasi
        $db      = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->selectCount('id');
        $builder->where('is_active', '0');
        $query = $builder->get();
        $hasil = $query->getRowArray();

        if ($hasil == null) {
            $approve = '0';
        } else {
            $approve = $hasil['id'];
        }
        //Ambil Data User

        //Join Tabel
        $db      = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('*,position.id as id_position,users.id as id');
        $builder->join('position', 'users.posisi_id = position.id');
        $builder->join('user_role', 'users.role_id = user_role.id');
        $builder->where('role_id !=', '1');
        $builder->where('is_active', '1');
        $query = $builder->get();
        $users = $query->getResultArray();

        //Data Role
        $role = $this->userRoleModel->findAll();

        $data = [
            'title' => 'List Member',
            'validation' => \Config\Services::validation(),
            'bread' => 'List Member',
            'users' => $users,
            'role' => $role,
            'approve' => $approve,
            'approvelist' => $approvelist
        ];

        return view('member/listmember', $data);
    }

    public function updateMember($id)
    {
        if ($this->usersModel->save([
            'id' => $id,
            'role_id' => $this->request->getVar('role')
        ])) {
            session()->setFlashdata('member', 'Update Member');
            return redirect()->to(base_url('member'));
        }
    }

    public function deleteMember($id)
    {
        if ($this->usersModel->delete($id)) {

            //Hapus Juga Member Itu Dari Team Dan Project Dan Task
            $projectMember = $this->detailProjectModel->where('id_users', $id)->findAll();
            $teamMember = $this->detailTeamModel->where('id_users', $id)->findAll();
            $taskMember = $this->detailTaskModel->where('id_users', $id)->findAll();

            if ($projectMember) {
                foreach ($projectMember as $pm) {
                    $this->detailProjectModel->delete($pm['id']);
                }
            } else if ($teamMember) {
                foreach ($teamMember as $tm) {
                    $this->detailTeamModel->delete($tm['id']);
                }
            } else if ($taskMember) {
                foreach ($taskMember as $tm) {
                    $this->detailTeamModel->delete($tm['id']);
                }
            }

            session()->setFlashdata('member', 'Menghapus Member');
            return redirect()->to(base_url('member'));
        }
    }

    public function approveMember($id)
    {
        //Update Database
        if ($this->usersModel->save([
            'id' => $id,
            'is_active' => '1'
        ])) {
            session()->setFlashdata('member', 'Approve Member');
            return redirect()->to(base_url('member'));
        }
    }

    public function position()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url());
        } else if (session()->get('role_id') != 1) {
            return redirect()->to(base_url('dashboard'));
        }

        $position = $this->positionModel->findAll();

        $data = [
            'title' => 'List Member',
            'validation' => \Config\Services::validation(),
            'bread' => 'List Member',
            'position' => $position
        ];

        return view('member/position', $data);
    }
}
