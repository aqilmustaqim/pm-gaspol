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

        if (session()->get('nama')) {
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

        $data = [
            'title' => 'PM-GASPOL || Account Settings',
            'bread' => 'Account Setting',
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
            'foto' => $namaFoto
        ])) {
            session()->setFlashdata('profile', 'Update Profile, Silahkan Login Ulang !');
            return redirect()->to(base_url('auth/settings'));
        }
    }
}
