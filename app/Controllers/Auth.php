<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Auth extends BaseController
{

    protected $usersModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }

    public function index()
    {
        $data = [
            'title' => 'PM-GASPOL || Login',
            'validation' => \Config\Services::validation()
        ];
        return view('auth/login', $data);
    }

    public function register()
    {
        $data = [
            'title' => 'PM-GASPOL || Register'
        ];
        return view('auth/register', $data);
    }

    public function registerSave()
    {
        //Cek Data Input
        //Input Database
        if ($this->usersModel->save([
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'role_id' => 3,
            'is_active' => 1
        ])) {
            dd('berhasil');
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
            if (password_verify($password, $user['password'])) {
                //Kalau Password Nya sama maka cek apakah usernya aktif ?
                if ($user['is_active'] == 1) {
                    //Kalau usernya aktif maka login berhasil
                    //1.Simpan session usernya
                    $dataSession = [
                        'nama' => $user['nama'],
                        'email' => $user['email'],
                        'role_id' => $user['role_id'],
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
                    session()->setFlashdata('login', 'Akun anda dinonaktifkan, harap hubungi admin ! ');
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
}
