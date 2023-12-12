<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use App\Models\PakaianModel;

class Pakaian extends BaseController
{
    protected $pakaianModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->pakaianModel = new PakaianModel();
        $this->kategoriModel = new KategoriModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Pakaian | Tiara Brand',
            'page' => 'pakaian',
            'pakaian' => $this->pakaianModel->getPakaianAll()
        ];

        return view('pakaian/index', $data);
    }

    public function detail($id)
    {
        $pakaian = $this->pakaianModel->getPakaianById($id);
        $kategori_id = $pakaian['kategori_id'];

        $data = [
            'title' => 'Detail Pakaian | Tiara Brand',
            'page' => 'pakaian',
            'pakaian' => $pakaian,
            'kategori' => $this->kategoriModel->getKategoriById($kategori_id)
        ];

        if (empty($data['pakaian'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data pakaian ' . $id . ' tidak ditemukan');
        }

        return view('pakaian/detail', $data);
    }

    public function create()
    {
        $user = session()->get('user');
        if (!$user || $user['isAdmin'] != '1') {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Tambah Pakaian | Tiara Brand',
            'page' => 'pakaian',
            'validation' => session('validation_errors'),
            'kategori' => $this->kategoriModel->getKategoriAll()
        ];
        return view('pakaian/create', $data);
    }

    public function save()
    {
        $user = session()->get('user');
        if (!$user || $user['isAdmin'] != '1') {
            return redirect()->to('/login');
        }

        $kategoriIds = $this->kategoriModel->getKategoriIdAll();

        $validation = \Config\Services::validation();

        $rules = [
            'title' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Title harus diisi',
                ]
            ],
            'deskripsi' => [
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => 'Deskripsi harus diisi',
                    'max_length' => 'Deskripsi terlalu panjang (maks 255 karakter)'
                ]
            ],
            'ukuran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Ukuran harus diisi',
                ]
            ],
            'harga' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga harus diisi',
                    'numeric' => 'Harga berupa angka'
                ]
            ],
            'stok' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Stok harus diisi',
                    'numeric' => 'Stok harus berupa angka'
                ]
            ],
            'gambar' => [
                'rules' => 'max_size[gambar,1024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]|max_dims[gambar,510,784]',
                'errors' => [
                    'max_size' => 'Ukuran file gambar terlalu besar. (maks 1MB)',
                    'is_image' => 'Gambar bukan bertipe gambar',
                    'mime_in' => 'Gambar bukan bertipe gambar',
                    'max_dims' => 'Dimensi gambar terlalu besar (maks 510x784)'
                ]
            ],
            'kategori_id' => [
                'rules' => 'required|in_list[' . implode(',', $kategoriIds) . ']',
                'errors' => [
                    'required' => 'Kategori id harus diisi',
                    'in_list' => 'Kategori harus diisi'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('validation_errors', $validation->getErrors());
            return redirect()->to('/pakaian/create')->withInput();
        }

        $gambarFile = $this->request->getFile('gambar');
        // dd($gambarFile);

        if ($gambarFile->getError() == 4) {
            $gambarFileName = 'no-gambar.jpg';
        } else {
            $editedGambarFile = \Config\Services::image();
            $gambarFile->move('assets/gambar-pakaian');

            $imageSize = getimagesize('assets/gambar-pakaian/' . $gambarFile->getName());
            $width = $imageSize[0]; // Get width
            $height = $imageSize[1]; // Get height

            if (($width > 255 || $width < 255) || ($height > 392 || $height < 392)) {
                // Resize and fit the image to 255x392
                $editedGambarFile->withFile('assets/gambar-pakaian/' . $gambarFile->getName())
                    ->fit(255, 392, 'center')
                    ->save('assets/gambar-pakaian/' . $gambarFile->getName());
                $gambarFileName = $gambarFile->getName();
            } else {
                $gambarFileName = $gambarFile->getName();
            }
        }

        $this->pakaianModel->save([
            'title' => $this->request->getVar('title'),
            'slug' => url_title($this->request->getVar('title'), '-', true),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'ukuran' => $this->request->getVar('ukuran'),
            'harga' => $this->request->getVar('harga'),
            'stok' => $this->request->getVar('stok'),
            'gambar' => $gambarFileName,
            'kategori_id' => $this->request->getVar('kategori_id'),
        ]);

        session()->setFlashdata('message', 'Pakaian berhasil ditambahkan');
        return redirect()->to('/pakaian');
    }

    public function edit($slug)
    {
        $user = session()->get('user');
        if (!$user || $user['isAdmin'] != '1') {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Edit Pakaian | Tiara Brand',
            'page' => 'pakaian',
            'validation' => session('validation_errors'),
            'pakaian' => $this->pakaianModel->getPakaianBySlug($slug),
            'kategori' => $this->kategoriModel->getKategoriAll(),
        ];

        return view('pakaian/edit', $data);
    }

    public function update($id)
    {
        $user = session()->get('user');
        if (!$user || $user['isAdmin'] != '1') {
            return redirect()->to('/login');
        }

        $kategoriIds = $this->kategoriModel->getKategoriIdAll();

        $validation = \Config\Services::validation();

        $rules = [
            'title' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Title harus diisi',
                ]
            ],
            'deskripsi' => [
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => 'deskripsi harus diisi',
                    'max_length' => 'Deskripsi te (maks 255 karakter)'
                ]
            ],
            'ukuran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Ukuran harus diisi',
                ]
            ],
            'harga' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga harus diisi',
                    'numeric' => 'Harga berupa angka'
                ]
            ],
            'stok' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Stok harus diisi',
                    'numeric' => 'Stok harus berupa angka'
                ]
            ],
            'gambar' => [
                'rules' => 'max_size[cover,1024]|is_image[cover]|mime_in[cover,image/jpg,image/jpeg,image/png]|max_dims[cover,510,784]',
                'errors' => [
                    'max_size' => 'Cover file size is too big. (max 1MB)',
                    'is_image' => 'Cover bukan bertipe gambar',
                    'mime_in' => 'Cover bukan bertipe gambar',
                    'max_dims' => 'Cover dimension is too big. (max 510x784)'
                ]
            ],
            'kategori_id' => [
                'rules' => 'required|in_list[' . implode(',', $kategoriIds) . ']',
                'errors' => [
                    'required' => 'Kategori id harus diisi',
                    'in_list' => 'Kategori harus diisi'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('validation_errors', $validation->getErrors());
            return redirect()->to('/pakaian/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $gambarFile = $this->request->getFile('gambar');

        if ($gambarFile->getError() == 4) {
            $gambarFileName = $this->request->getVar('oldGambar');
        } else {
            $editedGambarFile = \Config\Services::image();
            $gambarFile->move('assets/gambar-pakaian');

            $imageSize = getimagesize('assets/gambar-pakaian/' . $gambarFile->getName());
            $width = $imageSize[0]; // Get width
            $height = $imageSize[1]; // Get height

            if (($width > 255 || $width < 255) || ($height > 392 || $height < 392)) {
                $editedGambarFile->withFile('assets/gambar-pakaian/' . $gambarFile->getName())
                    ->fit(255, 392, 'center')
                    ->save('assets/gambar-pakaian/' . $gambarFile->getName());
                $gambarFileName = $gambarFile->getName();
                if ($this->request->getVar('oldGambar') != 'no-gambar.jpg') {
                    unlink('assets/gambar-pakaian/' . $this->request->getVar('oldGambar'));
                }
            } else {
                $gambarFileName = $gambarFile->getName();
                if ($this->request->getVar('oldGambar') != 'no-gambar.jpg') {
                    unlink('assets/gambar-pakaian/' . $this->request->getVar('oldGambar'));
                }
            }
        }

        $this->pakaianModel->save([
            'id' => $id,
            'title' => $this->request->getVar('title'),
            'slug' => url_title($this->request->getVar('title'), '-', true),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'ukuran' => $this->request->getVar('ukuran'),
            'harga' => $this->request->getVar('harga'),
            'stok' => $this->request->getVar('stok'),
            'gambar' => $gambarFileName,
            'kategori_id' => $this->request->getVar('kategori_id'),
        ]);

        session()->setFlashdata('message', 'Pakaian berhasil diubah');
        return redirect()->to('/pakaian');
    }

    public function delete($id)
    {

        $user = session()->get('user');
        if (!$user || $user['isAdmin'] != '1') {
            return redirect()->to('/login');
        }

        if ($this->pakaianModel->getPakaianById($id)['cover'] != 'no-gambar.jpg') {
            unlink('assets/gambar-pakaian/' . $this->pakaianModel->getPakaianById($id)['cover']);
        }

        $this->pakaianModel->delete($id);
        session()->setFlashdata('message', 'Pakaian berhasil dihapus');
        return redirect()->to('/pakaian');
    }
}
