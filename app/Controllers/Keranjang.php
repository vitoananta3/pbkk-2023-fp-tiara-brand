<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Keranjang extends BaseController
{
    protected $keranjangModel;
    protected $itemKeranjangModel;
    protected $pakaianModel;

    public function __construct()
    {
        $this->keranjangModel = new \App\Models\KeranjangModel();
        $this->itemKeranjangModel = new \App\Models\ItemKeranjangModel();
        $this->pakaianModel = new \App\Models\PakaianModel();
    }

    public function index()
    {
        $user = session()->get('user');
        if (!$user || $user['isAdmin'] == '1') {
            return redirect()->to('/login');
        }

        $keranjang = $this->keranjangModel->getKeranjangActive($user['id']);

        if (!$keranjang) {
            $data = [
                'title' => 'Keranjang | Tiara Brand',
                'page' => 'keranjang',
                'keranjang' => [],
                'itemKeranjangAll' => [],
                'oakaianAll' => []
            ];
            return view('keranjang/index', $data);
        } else {
            $keranjang_id = $keranjang['id'];

            $keranjangItems = $this->itemKeranjangModel->getItemAll($keranjang_id);

            $itemIds = $this->itemKeranjangModel->getItemIdAll($keranjang_id);

            if (!$itemIds) {
                $data = [
                    'title' => 'Keranjang | Tiara Brand',
                    'page' => 'keranjang',
                    'keranjang' => $keranjang,
                    'itemKeranjangAll' => $keranjangItems,
                    'pakaianAll' => []
                ];
                return view('pakaian/index', $data);
            } else {
                $pakaianAll = $this->pakaianModel->getPakaianByIds($itemIds);

                $data = [
                    'title' => 'Keranjang | Tiara Brand',
                    'page' => 'keranjang',
                    'keranjang' => $keranjang,
                    'itemKeranjangAll' => $keranjangItems,
                    'pakaianAll' => $pakaianAll
                ];
                return view('pakaian/index', $data);
            }
        }
    }

    public function transactionsIndex()
    {
        $user = session()->get('user');
        if (!$user || $user['isAdmin'] == '1') {
            return redirect()->to('/login');
        }

        $keranjangAll = $this->keranjangModel->getKeranjangAllTidakActive($user['id']);

        $totalKeranjangAll = $this->keranjangModel->getTotalKeranjangAllTidakActive($user['id']);

        $data = [
            'title' => 'Transaksi | Tiara Brand',
            'page' => 'transaksi',
            'keranjangAll' => $keranjangAll,
            'totalKeranjangAll' => $totalKeranjangAll
        ];
        return view('transaksi/index', $data);
    }

    public function checkout()
    {
        $user = session()->get('user');
        if (!$user || $user['isAdmin'] == '1') {
            return redirect()->to('/login');
        }

        $keranjang = $this->keranjangModel->getKeranjangActive($user['id']);

        $keranjang_id = $keranjang['id'];


        $this->keranjangModel->save([
            'id' => $keranjang_id,
            'isActive' => false,
            'isDone' => false,
            'totalHarga' => $this->request->getVar('totalPrice')
        ]);

        session()->setFlashdata('message', 'Berhasil checkout');
        return redirect()->to('/transaksi');
    }

    public function detail($id)
    {
        $user = session()->get('user');
        if (!$user || $user['isAdmin'] == '1') {
            return redirect()->to('/login');
        }

        $keranjang = $this->keranjangModel->getKeranjangById($id);

        $keranjangItems = $this->itemKeranjangModel->getItemAll($id);

        $itemIds = $this->itemKeranjangModel->getItemIdAll($id);

        $pakaianAll = $this->pakaianModel->getBooksByIds($itemIds);

        $data = [
            'title' => 'Detail Transaksi | Tiara Brand',
            'page' => 'transaksi',
            'keranjang' => $keranjang,
            'itemKeranjangAll' => $keranjangItems,
            'pakaianAll' => $pakaianAll
        ];
        return view('transaksi/detail', $data);
    }
}
