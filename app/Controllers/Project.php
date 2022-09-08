<?php

namespace App\Controllers;

use App\Database\Migrations\DetailProject;
use App\Models\TeamModel;
use App\Models\UsersModel;
use App\Models\DetailTeamModel;
use App\Models\ProjectModel;
use App\Models\DetailProjectModel;

use function PHPSTORM_META\map;

class Project extends BaseController
{

    protected $teamModel;
    protected $usersModel;
    protected $detailTeamModel;
    protected $projectModel;
    protected $detailProjectModel;

    public function __construct()
    {
        $this->teamModel = new TeamModel();
        $this->usersModel = new UsersModel();
        $this->detailTeamModel = new DetailTeamModel();
        $this->projectModel = new ProjectModel();
        $this->detailProjectModel = new DetailProjectModel();
    }

    public function addProject()
    {
        //Masukkan Ke Database
        if ($this->projectModel->save([
            'id_team' => $this->request->getPost('idTeam'),
            'nama_project' => $this->request->getPost('namaProject'),
            'deskripsi_project' => $this->request->getPost('deskripsiProject'),
            'tanggal_mulai' => $this->request->getPost('tanggalMulai'),
            'batas_waktu' => $this->request->getPost('batasWaktu'),
            'status_project' => 1
        ])) {
            //Kalau Berhasil
            echo 'berhasil';
        }
    }
    public function editProject()
    {
        //Masukkan Ke Database
        if ($this->projectModel->save([
            'id' => $this->request->getPost('id'),
            'id_team' => $this->request->getPost('idTeam'),
            'nama_project' => $this->request->getPost('namaProject'),
            'deskripsi_project' => $this->request->getPost('deskripsiProject'),
            'tanggal_mulai' => $this->request->getPost('tanggalMulai'),
            'batas_waktu' => $this->request->getPost('batasWaktu'),
            'status_project' => 1
        ])) {
            //Kalau Berhasil
            echo 'berhasil';
        }
    }

    public function addMemberProject()
    {

        //Tangkap Inputan
        $idProject = $this->request->getPost('idProject');
        $idUser = $this->request->getPost('idUser');

        //cek apakah datanya ada 
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_project');
        $builder->select('*');
        $builder->where('id_project', $idProject);
        $builder->where('id_users', $idUser);
        $query = $builder->get();
        $detailproject = $query->getRowArray();

        //Masukkan Database

        if ($detailproject == null) {
            //Kalau Datanya Kosong Berarti Datanya mau di insert
            if ($this->detailProjectModel->save([
                'id_project' => $idProject,
                'id_users' => $idUser
            ])) {
                echo 'berhasil';
            }
        } else {
            //Kalau Datanya Ada Berarti Datanya Mau Di Hapus
            if ($this->detailProjectModel->delete($detailproject['id'])) {
                echo 'hapus';
            }
        }
    }

    public function deleteProject($id)
    {

        if (!session()->get('logged_in')) {
            return redirect()->to(base_url());
        } else {
            //Kalau Ada Session
            //Cek yang login Admin gak , Kalau Bukan Tendang
            if (session()->get('role_id') != 1) {
                return redirect()->to(base_url());
            }
        }
        $project = $this->projectModel->where('id', $id)->first();
        //Hapus Project
        if ($this->projectModel->delete($id)) {
            //Kalau Berhasil Hapus
            //Hapus Juga Yang Ada Di Detail Project Yang Id Projectnya sama
            $detailproject = $this->detailProjectModel->where('id_project', $id)->findAll();
            if ($detailproject) {
                foreach ($detailproject as $dp) {
                    $this->detailProjectModel->delete($detailproject['id']);
                }
            }

            //FlashDatanya
            session()->setFlashdata('team', 'Menghapus Data Project');
            return redirect()->to(base_url('team/detailTeam/' . $project['id_team']));
        }
    }

    public function detailProject($id)
    {
        $usersProject = $this->usersModel->where('email', session()->get('email'))->first();

        //Validasi Login
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url());
        }

        if (session()->get('role_id') != 1) {
            //Cek Apakah Users Ada Di Dalam Project Ini
            $db      = \Config\Database::connect();
            $builder = $db->table('detail_project');
            $builder->select('*');
            $builder->where('id_project', $id);
            $builder->where('id_users', $usersProject['id']);
            $query = $builder->get();
            $projectUsers = $query->getRowArray();

            if ($projectUsers == null) {
                return redirect()->to(base_url('team'));
            }
        }
        //Akhir Validasi 

        //Tampilkan Data Detail Project Nya
        $dataProject = $this->projectModel->where('id', $id)->first();


        $data = [
            'title' => 'PM Gaspol || Detail Project',
            'bread' => 'Detail Project',
            'project' => $dataProject
        ];

        return view('project/detailProject', $data);
    }
}
