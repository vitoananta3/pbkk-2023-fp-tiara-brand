<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Pengguna extends BaseController
{
    protected $penggunaModel;

    public function __construct()
    {
        $this->penggunaModel = new \App\Models\PenggunaModel();
    }

    public function viewLogin()
    {
        $data = [
            'title' => 'Log In | Tiara Brand',
            'page' => 'log in'
        ];
        return view('pengguna/login', $data);
    }

    public function viewRegister()
    {
        $data = [
            'title' => 'Register | Tiara Brand',
            'page' => 'register'
        ];
        return view('pengguna/register', $data);
    }

    public function register()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'namaDepan' => [
                'rules' => 'required|alpha|max_length[32]',
                'errors' => [
                    'required' => 'Nama depan harus diisi',
                    'alpha' => 'Nama depan harus berupa huruf',
                    'max_length' => 'Nama depan harus kurang dari 32 karakter'
                ]
            ],
            'namaBelakang' => [
                'rules' => 'required|alpha|max_length[32]',
                'errors' => [
                    'required' => 'Nama belakang harus diisi',
                    'alpha' => 'Nama belakang harus berupa huruf',
                    'max_length' => 'Nama belakang harus kurang dari 32 karakter'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[pengguna.email]',
                'erros' => [
                    'required' => 'Email harus diisi',
                    'valid_email' => 'Email tidak valid',
                    'is_unique' => 'Email sudah terdaftar'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]|alpha_numeric',
                'errors' => [
                    'required' => 'Password harus diisi',
                    'min_length' => 'Password harus lebih dari 8 karakter',
                    'alpha_numeric' => 'Password harus berupa huruf dan angka'
                ]
            ],
            'repeatPassword' => [
                'rules' => 'required|matches[password]|alpha_numeric',
                'errors' => [
                    'required' => 'Repeat password harus diisi',
                    'matches' => 'Repeat password harus sama dengan password',
                    'alpha_numeric' => 'Repeat password harus berupa huruf dan angka'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('validation_errors', $validation->getErrors());
            return redirect()->to('/register')->withInput();
        }

        $this->penggunaModel->save([
            'namaDepan' => $this->request->getVar('namaDepan'),
            'namaBelakang' => $this->request->getVar('namaBelakang'),
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
            'isAdmin' => $this->request->getVar('isAdmin')
        ]);

        session()->setFlashdata('message', 'Register berhasil');
        return redirect()->to('/login');
    }

    public function login()
    {

        $validation = \Config\Services::validation();

        $rules = [
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'valid_email' => 'Email tidak valid'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Password harus diisi',
                    'min_length' => 'Password harus lebih dari 8 karakter',
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('validation_errors', $validation->getErrors());
            return redirect()->to('/login')->withInput();
        }

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $user = $this->penggunaModel->getUser($email);

        if ($user) {
            if ($user['password'] == $password) {
                session()->set('user', $user);
                session()->setFlashdata('message', 'Selamat datang di Tiara Brand');
                return redirect()->to('/pakaian');
            } else {
                session()->setFlashdata('error', 'Email atau Password salah');
                return redirect()->to('/login')->withInput();
            }
        } else {
            session()->setFlashdata('error', 'Email atau Password salah');
            return redirect()->to('/login')->withInput();
        }
    }

    public function logOut()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function logInFirst()
    {
        session()->setFlashdata('message', 'Anda harus login terlebih dahulu');
        return redirect()->to('/login');
    }
}
