<?php

namespace App\Controllers;

use App\Models\ListTaskModel;
use App\Models\ProjectModel;
use App\Models\TaskModel;
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
        //$model = new UsersModel();

        // Query CI Untuk Menampilkan Semua Member
        //$datauser['users'] = $model->where('is_active', 1)->findAll();

        $db      = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('users.id,nama,email,password,foto,role_id,posisi,is_active');
        $builder->join('position', 'users.posisi_id = position.id');
        //$builder->join('user_role', 'users.role_id = user_role.id');
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

        return $this->respond($datateam);
    }

    public function listTeamById($idUsers = null)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_team');
        $builder->select('team.id,team,deskripsi_team');
        $builder->join('team', 'detail_team.id_team = team.id');
        $builder->where('id_users', $idUsers);
        $query = $builder->get();
        $hasil = $listTeamById['teams'] = $query->getResultArray();

        if ($hasil) {
            return $this->respond($listTeamById);
        } else {
            return $this->failNotFound('User Belum Ada Team');
        }
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


    public function createTask()
    {
        $model = new TaskModel();

        $data = [
            'id_project' => $this->request->getVar('id_project'),
            'nama_task' => $this->request->getVar('nama_task'),
            'deskripsi_task' => $this->request->getVar('deskripsi_task'),
            'tanggal_task' => $this->request->getVar('tanggal_task'),
            'batas_task' => $this->request->getVar('batas_task'),
            'status_task' => 0
        ];

        $model->insert($data);

        $this->respondCreated($data, 'Berhasil Menambahkan Task');
    }

    public function updateTask($idTask)
    {
        $model = new TaskModel();

        // $data = [
        //     'nama_task' => $this->request->getVar('nama_task'),
        //     'deskripsi_task' => $this->request->getVar('deskripsi_task'),
        //     'tanggal_task' => $this->request->getVar('tanggal_task'),
        //     'batas_task' => $this->request->getVar('batas_task')
        // ];
        $data = $this->request->getJSON();
        if ($model->update($idTask, $data)) {
            $response = [
                'status' => '200',
                'error' => null,
                'message' => [
                    'success' => 'Task Berhasil Di Update'
                ]

            ];
            return $this->respondCreated($response);
        }
    }

    public function listTaskById($idUser)
    {
        //Mengambil Data Task Yang Ada Project
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_task');
        $builder->select('task.id,nama_task,deskripsi_task,tanggal_task,batas_task,status_task,nama_project,id_project');
        $builder->join('task', 'detail_task.id_task = task.id');
        $builder->join('project', 'task.id_project = project.id');
        $builder->where('id_users', $idUser);
        $query = $builder->get();
        $hasil = $listTaskById['task'] = $query->getResultArray();

        if ($hasil) {
            return $this->respond($listTaskById);
        } else {
            return $this->failNotFound('User Belum Ada Task');
        }
    }

    public function project()
    {
        //Mengambil Data Team Yang Ada Project
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_project');
        $builder->select('nama_project,status_project,team,id_team');
        $builder->join('project', 'detail_project.id_project = project.id');
        $builder->distinct();
        $builder->join('team', 'project.id_team = team.id');
        $query = $builder->get();
        $teamproject['project'] = $query->getResultArray();

        return $this->respond($teamproject);
    }

    public function createProject()
    {
        $model = new ProjectModel();

        $data = [
            'id_team' => $this->request->getVar('id_team'),
            'nama_project' => $this->request->getVar('nama_project'),
            'deskripsi_project' => $this->request->getVar('deskripsi_project'),
            'tanggal_mulai' => $this->request->getVar('tanggal_mulai'),
            'batas_waktu' => $this->request->getVar('batas_waktu'),
            'status_project' => 0
        ];

        if ($model->insert($data)) {
            $response = [
                'status' => '201',
                'error' => null,
                'message' => [
                    'success' => 'Project Berhasil DiTambahkan'
                ]
            ];
            return $this->respondCreated($response);
        }
    }

    public function listProjectById($idUser)
    {
        //Mengambil Data Team Yang Ada Project
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_project');
        $builder->select('project.id,nama_project,deskripsi_project,tanggal_mulai,batas_waktu,status_project,team,id_team');
        $builder->join('project', 'detail_project.id_project = project.id');
        $builder->join('team', 'project.id_team = team.id');
        $builder->where('id_users', $idUser);
        $query = $builder->get();
        $hasil = $listProjectById['project'] = $query->getResultArray();

        if ($hasil) {
            return $this->respond($listProjectById);
        } else {
            return $this->failNotFound('User Belum Ada Project');
        }
    }

    public function update($id = null)
    {
        $model = new UsersModel();


        $data = $this->request->getJSON();
        //Update Aktifnya
        // $data = [
        //     'id' => $id,
        //     'nama' => $this->request->getVar('nama')
        // ];
        $model->update($id, $data);
        $response = [
            'status' => '200',
            'error' => null,
            'message' => [
                'success' => 'Data User Berhasil Di Update'
            ]

        ];
        return $this->respondCreated($response);
    }

    public function detailTeam($idUser)
    {

        // Cek User nya
        $model = new UsersModel();
        $cekUser = $model->where('id', $idUser)->first();

        if ($cekUser['role_id'] == 3) {

            $db = \Config\Database::connect();
            $builder = $db->table('detail_team');
            $builder->select('team.id as id,team,deskripsi_team');
            $builder->join('team', 'detail_team.id_team = team.id');
            $builder->where('id_users', $idUser);
            $query = $builder->get();
            $hasil = $query->getResultArray();

            foreach ($hasil as &$team) {

                // SEGMENT TEAM ( TOTAL PROJECT DAN TOTAL MEMBER )
                helper('my_helper');
                $totalproject = totalProjectTeam($team['id'])['id'];
                $jumlahMemberTeam = jumlahMemberTeam($team['id'])['id'];
                $team["total_project"] = $totalproject;
                $team["total_member"] = $jumlahMemberTeam;



                // SEGMENT LIST_PROJECT
                $team["list_project"] = [];
                $db = \Config\Database::connect();
                $builder = $db->table('project');
                $builder->select('project.id as id_project,nama_project, deskripsi_project, tanggal_mulai, batas_waktu, status_project');
                $builder->where('id_team', $team['id']);
                $query = $builder->get();
                $project = $query->getResultArray();

                foreach ($project as &$projects) {

                    $totalTaskProject = totalTaskProject($projects['id_project'])['id'];
                    $passedTaskProject = passedTaskProject($projects['id_project']);
                    $totalMemberProject = jumlahMemberProject($projects['id_project'])['id'];
                    $projects["total_task"] = $totalTaskProject;
                    $projects["complete_task"] = $passedTaskProject;
                    $projects["total_member"] = $totalMemberProject;

                    // SEGMENT TASK
                    $projects["task"] = [];
                    $db = \Config\Database::connect();
                    $builder = $db->table('task');
                    $builder->select('task.id as id_task,nama_task,deskripsi_task,tanggal_task,batas_task,status_task');
                    $builder->where('id_project', $projects['id_project']);
                    $query = $builder->get();
                    $task = $query->getResultArray();

                    foreach ($task as &$tasks) {
                        // SEGMENT TASK ( BATAS WAKTU )
                        helper('my_helper');
                        $batasTask = hitungSelisihBatasWaktu($tasks['batas_task']);
                        $tasks['due_date'] = $batasTask;

                        // SEGMENT TASK ( TOTAL CHECKLIST )
                        $totalListTask = totalListTask($tasks['id_task'])['id'];
                        $passedListTask = passedListTask($tasks['id_task']);
                        $tasks['total_list_task'] = $totalListTask;
                        $tasks['passed_list_task'] = $passedListTask;

                        // SEGMENT TASK ( TOTAL MEMBER )
                        $totalMemberTask = jumlahMemberTask($tasks['id_task'])['id'];
                        $tasks['total_member_task'] = $totalMemberTask;


                        // SEGMENT CHECKLIST TASK
                        $tasks["checklist_task"] = [];
                        $db = \Config\Database::connect();
                        $builder = $db->table('list_task');
                        $builder->select('list_task.id as id,list,status_list');
                        $builder->where('id_task', $tasks['id_task']);
                        $query = $builder->get();
                        $checklist = $query->getResultArray();

                        $tasks["checklist_task"][] = $checklist;
                    }
                    $projects["task"][] = $task;
                }
                $team["list_project"][] = $project;


                // SEGMENT LIST MEMBER
                $team["list_member"] = [];
                //Query Untuk Mengambil Foto Member Team
                $db      = \Config\Database::connect();
                $builder = $db->table('detail_team');
                $builder->select('users.id as id,nama,posisi');
                $builder->join('users', 'detail_team.id_users = users.id');
                // $builder->join('user_role', 'users.role_id = user_role.id');
                $builder->join('user_role', 'users.role_id = user_role.id');
                $builder->join('position', 'users.posisi_id = position.id');
                $builder->where('id_team', $team['id']);
                $query = $builder->get();
                $listMember = $query->getResultArray();
                $team["list_member"][] = $listMember;
            }
            if ($hasil) {
                $detailTeam['teams'] = $hasil;
                return $this->respond($detailTeam);
            } else {
                return $this->failNotFound('User Belum Ada Team');
            }
        } else {
            // Selain Member Bisa Ambil Semua Data
            $db = \Config\Database::connect();
            $builder = $db->table('detail_team');
            $builder->select('team.id as id,team,deskripsi_team');
            $builder->join('team', 'detail_team.id_team = team.id');
            $builder->distinct();
            $query = $builder->get();
            $hasil = $query->getResultArray();

            foreach ($hasil as &$team) {

                // SEGMENT TEAM ( TOTAL PROJECT DAN TOTAL MEMBER )
                helper('my_helper');
                $totalproject = totalProjectTeam($team['id'])['id'];
                $jumlahMemberTeam = jumlahMemberTeam($team['id'])['id'];
                $team["total_project"] = $totalproject;
                $team["total_member"] = $jumlahMemberTeam;



                // SEGMENT LIST_PROJECT
                $team["list_project"] = [];
                $db = \Config\Database::connect();
                $builder = $db->table('project');
                $builder->select('project.id as id_project,nama_project, deskripsi_project, tanggal_mulai, batas_waktu, status_project');
                $builder->where('id_team', $team['id']);
                $query = $builder->get();
                $project = $query->getResultArray();

                foreach ($project as &$projects) {

                    $totalTaskProject = totalTaskProject($projects['id_project'])['id'];
                    $passedTaskProject = passedTaskProject($projects['id_project']);
                    $totalMemberProject = jumlahMemberProject($projects['id_project'])['id'];
                    $projects["total_task"] = $totalTaskProject;
                    $projects["complete_task"] = $passedTaskProject;
                    $projects["total_member"] = $totalMemberProject;

                    // SEGMENT TASK
                    $projects["task"] = [];
                    $db = \Config\Database::connect();
                    $builder = $db->table('task');
                    $builder->select('task.id as id_task,nama_task,deskripsi_task,tanggal_task,batas_task,status_task');
                    $builder->where('id_project', $projects['id_project']);
                    $query = $builder->get();
                    $task = $query->getResultArray();

                    foreach ($task as &$tasks) {
                        // SEGMENT TASK ( BATAS WAKTU )
                        helper('my_helper');
                        $batasTask = hitungSelisihBatasWaktu($tasks['batas_task']);
                        $tasks['due_date'] = $batasTask;

                        // SEGMENT TASK ( TOTAL CHECKLIST )
                        $totalListTask = totalListTask($tasks['id_task'])['id'];
                        $passedListTask = passedListTask($tasks['id_task']);
                        $tasks['total_list_task'] = $totalListTask;
                        $tasks['passed_list_task'] = $passedListTask;

                        // SEGMENT TASK ( TOTAL MEMBER )
                        $totalMemberTask = jumlahMemberTask($tasks['id_task'])['id'];
                        $tasks['total_member_task'] = $totalMemberTask;


                        // SEGMENT CHECKLIST TASK
                        $tasks["checklist_task"] = [];
                        $db = \Config\Database::connect();
                        $builder = $db->table('list_task');
                        $builder->select('list_task.id as id,list,status_list');
                        $builder->where('id_task', $tasks['id_task']);
                        $query = $builder->get();
                        $checklist = $query->getResultArray();

                        $tasks["checklist_task"][] = $checklist;
                    }
                    $projects["task"][] = $task;
                }
                $team["list_project"][] = $project;


                // SEGMENT LIST MEMBER
                $team["list_member"] = [];
                //Query Untuk Mengambil Foto Member Team
                $db      = \Config\Database::connect();
                $builder = $db->table('detail_team');
                $builder->select('users.id as id,nama,posisi');
                $builder->join('users', 'detail_team.id_users = users.id');
                // $builder->join('user_role', 'users.role_id = user_role.id');
                $builder->join('user_role', 'users.role_id = user_role.id');
                $builder->join('position', 'users.posisi_id = position.id');
                $builder->where('id_team', $team['id']);
                $query = $builder->get();
                $listMember = $query->getResultArray();
                $team["list_member"][] = $listMember;
            }
            if ($hasil) {
                $detailTeam['teams'] = $hasil;
                return $this->respond($detailTeam);
            } else {
                return $this->failNotFound('User Belum Ada Team');
            }
        }
    }

    public function detailTask($idUser)
    {
        // Cek User
        $model = new UsersModel();
        $cekUser = $model->where('id', $idUser)->first();

        if ($cekUser['role_id'] == 3) {
            $db = \Config\Database::connect();
            $builder = $db->table('detail_task');
            $builder->select('task.id as id,nama_task,deskripsi_task,tanggal_task,batas_task,status_task,team');
            $builder->join('task', 'detail_task.id_task = task.id');
            $builder->join('project', 'task.id_project = project.id');
            $builder->join('team', 'project.id_team = team.id');
            $builder->where('id_users', $idUser);
            $query = $builder->get();
            $hasil = $query->getResultArray();

            foreach ($hasil as &$task) {

                // SEGMENT TASK ( BATAS WAKTU )
                helper('my_helper');
                $batasTask = hitungSelisihBatasWaktu($task['batas_task']);
                $task['due_date'] = $batasTask;

                // SEGMENT TASK ( TOTAL CHECKLIST )
                $totalListTask = totalListTask($task['id'])['id'];
                $passedListTask = passedListTask($task['id']);
                $task['total_list_task'] = $totalListTask;
                $task['passed_list_task'] = $passedListTask;

                // SEGMENT TASK ( TOTAL MEMBER )
                $totalMemberTask = jumlahMemberTask($task['id'])['id'];
                $task['total_member_task'] = $totalMemberTask;


                // SEGMENT CHECKLIST TASK
                $task["checklist_task"] = [];
                $db = \Config\Database::connect();
                $builder = $db->table('list_task');
                $builder->select('list_task.id as id,list,status_list');
                $builder->where('id_task', $task['id']);
                $query = $builder->get();
                $checklist = $query->getResultArray();

                $task["checklist_task"][] = $checklist;
            }

            if ($hasil) {
                $detailTask['task'] = $hasil;
                return $this->respond($detailTask);
            } else {
                return $this->failNotFound('User Belum Ada Task');
            }
        } else {
            $db = \Config\Database::connect();
            $builder = $db->table('detail_task');
            $builder->select('task.id as id,nama_task,deskripsi_task,tanggal_task,batas_task,status_task,team');
            $builder->join('task', 'detail_task.id_task = task.id');
            $builder->join('project', 'task.id_project = project.id');
            $builder->join('team', 'project.id_team = team.id');
            $builder->distinct();
            $query = $builder->get();
            $hasil = $query->getResultArray();

            foreach ($hasil as &$task) {

                // SEGMENT TASK ( BATAS WAKTU )
                helper('my_helper');
                $batasTask = hitungSelisihBatasWaktu($task['batas_task']);
                $task['due_date'] = $batasTask;

                // SEGMENT TASK ( TOTAL CHECKLIST )
                $totalListTask = totalListTask($task['id'])['id'];
                $passedListTask = passedListTask($task['id']);
                $task['total_list_task'] = $totalListTask;
                $task['passed_list_task'] = $passedListTask;

                // SEGMENT TASK ( TOTAL MEMBER )
                $totalMemberTask = jumlahMemberTask($task['id'])['id'];
                $task['total_member_task'] = $totalMemberTask;


                // SEGMENT CHECKLIST TASK
                $task["checklist_task"] = [];
                $db = \Config\Database::connect();
                $builder = $db->table('list_task');
                $builder->select('list_task.id as id,list,status_list');
                $builder->where('id_task', $task['id']);
                $query = $builder->get();
                $checklist = $query->getResultArray();

                $task["checklist_task"][] = $checklist;
            }

            if ($hasil) {
                $detailTask['task'] = $hasil;
                return $this->respond($detailTask);
            } else {
                return $this->failNotFound('User Belum Ada Task');
            }
        }
    }

    public function createChecklist()
    {
        $model = new ListTaskModel();

        $data = [
            'id_task' => $this->request->getVar('id_task'),
            'list' => $this->request->getVar('list'),
            'status_list' => 0
        ];
        //$data = $this->request->getJSON();

        if ($model->insert($data)) {
            $response = [
                'status' => '201',
                'error' => null,
                'message' => [
                    'success' => 'Checklist Berhasil DiTambahkan'
                ]
            ];
            return $this->respondCreated($response);
        }
    }

    public function updateChecklist($id = null)
    {
        $model = new ListTaskModel();
        $data = $this->request->getJSON();
        if ($model->update($id, $data)) {
            $response = [
                'status' => '200',
                'error' => null,
                'message' => [
                    'success' => 'Checklist Berhasil Di Update'
                ]
            ];
            return $this->respondCreated($response);
        }
    }
}
