<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class Kategori extends BaseController
{
    protected $kategoriModel;

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Kategori | Tiara Brand',
            'page' => 'kategori',
            'kategori' => $this->kategoriModel->getCategories()
        ];
        
        return view('kategori/index', $data);
    }

    public function detail($slug)
    {
        $user = session()->get('user');
        if (!$user) {
            return redirect()->to('/register');
        }

        $data = [
            'title' => 'Detail Kategori | Tiara Brand',
            'page' => 'kategori',
            'kategori' => $this->kategoriModel->getCategory($slug),
        ];


        if (empty($data['kategori'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kategori ' . $slug . ' tidak ditemukan');
        }

        // dd($data['category']);
        return view('kategori/detail', $data);
    }

    public function create()
    {
        $user = session()->get('user');
        if (!$user || $user['isAdmin'] != '1') {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Tambah Kategori | Tiara Brand',
            'page' => 'kategori',
            'validation' => session('data') ? session('data')['validation'] : \Config\Services::validation()
        ];
        return view('kategori/create', $data);
    }

    public function save()
    {
        $user = session()->get('user');
        if (!$user || $user['isAdmin'] != '1') {
            return redirect()->to('/login');
        }

        $validation = \Config\Services::validation();

        $rules = [
            'nama' => [
                'rules' => 'required|is_unique[kategori.nama]|max_length[32]',
                'errors' => [
                    'required' => 'Nama kategori harus diisi.',
                    'is_unique' => 'Nama kategori sudah ada.',
                    'max_length' => 'Nama kategori terlalu panjang (maks 32 karakter).'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $data = [
                'title' => 'Tambah Kategori | Tiara Brand',
                'page' => 'kategori',
                'validation' => $validation
            ];
            return redirect()->to('/kategori/create')->withInput()->with('data', $data);
        }

        $this->kategoriModel->save([
            'nama' => $this->request->getVar('nama'),
            'slug' => url_title($this->request->getVar('nama'), '-', true)
        ]);

        session()->setFlashdata('message', 'Kategori berhasil ditambahkan');
        return redirect()->to('/kategori');
    }

    public function edit($slug)
    {
        $user = session()->get('user');
        if (!$user || $user['isAdmin'] != '1') {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Edit Kategori | Tiara Brand',
            'page' => 'kategori',
            'validation' => session('data') ? session('data')['validation'] : \Config\Services::validation(),
            'kategori' => $this->kategoriModel->getCategory($slug)
        ];

        return view('kategori/edit', $data);
    }

    public function update($id) {
        $user = session()->get('user');
        if (!$user || $user['isAdmin'] != '1') {
            return redirect()->to('/login');
        }

        $validation = \Config\Services::validation();

        $rules = [
            'nama' => [
                'rules' => 'required|is_unique[kategori.nama]|max_length[32]',
                'errors' => [
                    'required' => 'Nama kategori harus diisi',
                    'is_unique' => 'Nama kategori sudah ada',
                    'max_length' => 'Nama kategori terlalu panjang (maks 32 karakter)'
                ]
            ]
        ];

        // nama checking
        // $oldCategory = $this->kategoriModel->getCategory($this->request->getVar('slug'));
        // if ($oldCategory['nama'] == $this->request->getVar('nama')) {
        //     unset($rules['nama']['rules'][1]);
        // }

        if (!$this->validate($rules)) {
            $data = [
                'title' => 'Update Kategori | Tiara Brand',
                'page' => 'kategori',
                'validation' => $validation
            ];
            return redirect()->to('/kategori/edit/'. $this->request->getVar('slug'))->withInput()->with('data', $data);
        }

        $this->kategoriModel->save([
            'id' => $id,
            'nama' => $this->request->getVar('nama'),
            'slug' => url_title($this->request->getVar('nama'), '-', true)
        ]);

        session()->setFlashdata('message', 'Kategori berhasil diupdate');
        return redirect()->to('/kategori');
    }

    public function delete($id)
    {
        $user = session()->get('user');
        if (!$user || $user['isAdmin'] != '1') {
            return redirect()->to('/login');
        }

        $this->kategoriModel->delete($id);
        session()->setFlashdata('message', 'Kategori berhasil dihapus');
        return redirect()->to('/kategori');
    }
}
