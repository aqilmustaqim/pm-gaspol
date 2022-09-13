<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\PositionModel;

class Auth extends BaseController
{

    protected $usersModel;
    protected $positionModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->positionModel = new PositionModel();
    }

    public function index()
    {

        if (session()->get('logged_in')) {
            if (session()->get('role_id') == 1) {
                return redirect()->to(base_url('superadmin'));
            } else {
                return redirect()->to(base_url('dashboard'));
            }
        }

        $data = [
            'title' => 'PM-GASPOL || Login',
            'validation' => \Config\Services::validation()
        ];
        return view('auth/login', $data);
    }

    public function register()
    {
        $data = [
            'title' => 'PM-GASPOL || Register',
            'validation' => \Config\Services::validation()
        ];
        return view('auth/register', $data);
    }

    public function registerSave()
    {
        //Cek Data Input
        //Validasi Form Terlebih Dahulu
        if (!$this->validate([
            //Field Yang mau divalidasi
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Wajib Diisi ! '
                ]
            ],
            'email' => [
                'rules' => 'required|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email Wajib Diisi ! ',
                    'is_unique' => 'Email Sudah Terdaftar !'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Password Wajib Diisi ! ',
                    'min_length' => 'Password Minimal 8 Karakter !'
                ]
            ]
        ])) {
            //Kalau tidak tervalidasi
            return redirect()->to(base_url('/auth/register'))->withInput();
        }

        //Input Database
        if ($this->usersModel->save([
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
            'password' => md5($this->request->getVar('password')),
            'role_id' => 3,
            'is_active' => 0,
            'posisi_id' => 1,
            'foto' => 'default.png'
        ])) {
            session()->setFlashdata('register', 'Akun Berhasil Dibuat, Harap hubungi admin untuk aktivasi ! ');
            return redirect()->to(base_url());
        }
    }

    public function loginSave()
    {
        //Validasi Form Terlebih Dahulu
        if (!$this->validate([
            //Field Yang mau divalidasi
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi ! '
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi ! '
                ]
            ]
        ])) {
            //Kalau tidak tervalidasi
            return redirect()->to(base_url())->withInput();
        }
        //Kalau Lolos Validasi
        //Ambil Inputan Dan Cek
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        //Cek Database Apakah Ada
        $user = $this->usersModel->where(['email' => $email])->first();
        if ($user) {
            //Kalau ada user nya cek passwordnya sama atau tidak dengan inputan 
            //$user['password'] === md5($password) => MD5
            //password_verify($password, $user['password']) => PASSWORD DEFAULT
            if ($user['password'] === md5($password)) {
                //Kalau Password Nya sama maka cek apakah usernya aktif ?
                if ($user['is_active'] == 1) {
                    //Kalau usernya aktif maka login berhasil
                    //1.Simpan session usernya
                    $dataSession = [
                        'nama' => $user['nama'],
                        'email' => $user['email'],
                        'role_id' => $user['role_id'],
                        'foto' => $user['foto'],
                        'logged_in' => TRUE
                    ];
                    session()->set($dataSession);
                    //2. Redirect Kehalaman Role id masing masing
                    if ($user['role_id'] == 1) {
                        return redirect()->to(base_url('superadmin'));
                    } else {
                        return redirect()->to(base_url('dashboard'));
                    }
                } else {
                    //litertly wicis if user tidak aktif
                    session()->setFlashdata('login', 'Akun anda Belum Aktif, harap hubungi admin ! ');
                    return redirect()->to(base_url());
                }
            } else {
                //Kalau Passwordnya gak sama , kasih pesan error
                session()->setFlashdata('login', 'Password yang di masukkan salah ! ');
                return redirect()->to(base_url());
            }
        } else {
            //Kalau user nya gak ada
            session()->setFlashdata('login', 'Email Belum Terdaftar ! ');
            return redirect()->to(base_url());
        }
    }

    public function logout()
    {
        //Hapus Session
        $dataSession = [
            'nama',
            'email',
            'role_id',
            'foto',
            'logged_in'
        ];
        session()->remove($dataSession);
        return redirect()->to(base_url());
    }

    public function settings()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url());
        }

        $user = $this->usersModel->where('email', session()->get('email'))->first();

        $db      = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('*,position.id as id_position,users.id as id');
        $builder->join('position', 'users.posisi_id = position.id');
        $builder->where('email', session()->get('email'));
        $query = $builder->get();
        $users = $query->getRowArray();

        $posisi = $this->positionModel->findAll();

        $data = [
            'title' => 'PM-GASPOL || Account Settings',
            'bread' => 'Account Setting',
            'user' => $users,
            'posisi' => $posisi,
            'validation' => \Config\Services::validation()
        ];
        return view('auth/settings', $data);
    }

    public function editProfile()
    {
        //1. Cek Foto Di Ubah Atau Tidak
        $fileFoto = $this->request->getFile('foto');
        $fotoLama = $this->request->getVar('fotoLama');
        if ($fileFoto->getError() == 4) { //Kalau Fotonya Kosong Berarti ga di ubah 
            //Ambil Nama Foto Lamanya
            $namaFoto = $fotoLama;
        } else {
            //Kalau Foto Nya Diubah
            //Ambil Nama File Foto Barunya
            $namaFoto = $fileFoto->getRandomName();
            //Masukkan Ke Dalam Folder Image
            $fileFoto->move('assets/img', $namaFoto);
            //Hapus File Foto Lama
            if ($fotoLama != 'default.png') {
                unlink("assets/img/$fotoLama");
            }
        }

        //2. Update Database
        $user = $this->usersModel->where('email', session()->get('email'))->first();
        if ($this->usersModel->save([
            'id' => $user['id'],
            'nama' => $this->request->getVar('nama'),
            'posisi_id' => $this->request->getVar('posisi'),
            'foto' => $namaFoto
        ])) {
            session()->setFlashdata('profile', 'Update Profile, Silahkan Login Ulang !');
            return redirect()->to(base_url('auth/settings'));
        }
    }

    public function changePassword()
    {
        $passwordlama = $this->request->getPost('passwordlama');
        $passwordbaru = $this->request->getPost('passwordbaru');
        $passwordkonfirmasi = $this->request->getPost('passwordkonfirmasi');

        //Ambil Dlu Data Usersnya
        $user = $this->usersModel->where('email', session()->get('email'))->first();
        //cek dlu apakah password lama bener
        if (password_verify($passwordlama, $user['password'])) {

            //Kalau Bener Masukkan Database Password Barunya
            if ($this->usersModel->save([
                'id' => $user['id'],
                'password' => md5($passwordbaru)
            ])) {
                echo 'berhasil';
            }
        } else {
            echo 'passwordsalah';
        }
    }
}
