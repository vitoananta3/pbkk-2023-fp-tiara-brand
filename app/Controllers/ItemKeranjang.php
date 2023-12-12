<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ItemKeranjang extends BaseController
{
    protected $itemKeranjangModel;
    protected $keranjangModel;
    protected $pakaianModel;

    public function __construct()
    {
        $this->itemKeranjangModel = new \App\Models\ItemKeranjangModel();
        $this->keranjangModel = new \App\Models\KeranjangModel();
        $this->pakaianModel = new \App\Models\PakaianModel();
    }

    public function saveItem($id)
    {
        $pakaian = $this->pakaianModel->getPakaianById($id);

        if ($pakaian['stok'] < 1) {
            session()->setFlashdata('message', 'Stok pakaian kosong');
            return redirect()->to('/pakaian/' . $id);
        } else {

            $this->pakaianModel->save([
                'id' => $pakaian['id'],
                'stok' => $pakaian['stok'] - 1
            ]);

            $keranjangActive = $this->keranjangModel->getKeranjangActive($this->request->getVar('pengguna_id'));

            if (!$keranjangActive) {
                $this->keranjangModel->save([
                    'pengguna_id' => $this->request->getVar('pengguna_id'),
                    'isActive' => true,
                ]);

                $keranjangActive = $this->keranjangModel->getKeranjangActive($this->request->getVar('pengguna_id'));

                $this->itemKeranjangModel->save([
                    'keranjang_id' => $keranjangActive['id'],
                    'pakaian_id' => $this->request->getVar('pakaian_id'),
                    'kuantitas' => $this->request->getVar('kuantitas')
                ]);

                session()->setFlashdata('message', 'Item berhasil ditambahkan ke keranjang');
                return redirect()->to('/keranjang');
            } else {

                $isItemExist = $this->itemKeranjangModel->isItemExist($keranjangActive['id'], $this->request->getVar('pakaian_id'));

                if ($isItemExist) {
                    $this->itemKeranjangModel->save([
                        'id' => $isItemExist['id'],
                        'kuantitas' => $isItemExist['kuantitas'] + $this->request->getVar('kuantitas')
                    ]);

                    session()->setFlashdata('message', 'Item berhasil ditambahkan ke keranjang');
                    return redirect()->to('/keranjang');
                } else {
                    $this->itemKeranjangModel->save([
                        'keranjang_id' => $keranjangActive['id'],
                        'pakaian_id' => $this->request->getVar('pakaian_id'),
                        'kuantitas' => $this->request->getVar('kuantitas')
                    ]);

                    session()->setFlashdata('message', 'Item berhasil ditambahkan ke keranjang');
                    return redirect()->to('/keranjang');
                }
            }
        }
    }

    public function updateItemDecrement($id)
    {
        $item = $this->itemKeranjangModel->find($id);
        $pakaian = $this->pakaianModel->getPakaianById($item['pakaian_id']);

        if ($item['kuantitas'] > 1) {
            $this->itemKeranjangModel->save([
                'id' => $id,
                'kuantitas' => $item['kuantitas'] - 1
            ]);
            $this->pakaianModel->save([
                'id' => $item['pakaian_id'],
                'stok' => $pakaian['stok'] + 1
            ]);
        } else if ($item['kuantitas'] == 1) {
            session()->setFlashdata('message', 'Tekan tombol hapus untuk menghapus item');
            return redirect()->to('/keranjang');
        }

        session()->setFlashdata('message', 'Kuantitas item berhasil diubah');
        return redirect()->to('/keranjang');
    }

    public function updateItemIncrement($id)
    {
        $item = $this->itemKeranjangModel->find($id);

        $pakaian = $this->pakaianModel->find($item['pakaian_id']);

        if ($pakaian['stok'] <= 0) {
            session()->setFlashdata('message', 'Kuantitas item melebihi stok');
            return redirect()->to('/keranjang');
        }

        $this->itemKeranjangModel->save([
            'id' => $id,
            'kuantitas' => $item['kuantitas'] + 1
        ]);

        $this->pakaianModel->save([
            'id' => $item['pakaian_id'],
            'stok' => $pakaian['stok'] - 1
        ]);

        session()->setFlashdata('message', 'Kuantitas item berhasil diubah');
        return redirect()->to('/keranjang');
    }

    public function updatestokBeforeDeleteItem($id)
    {
        $item = $this->itemKeranjangModel->find($id);

        if (!$item) {
            return redirect()->to('/keranjang')->with('error', 'Item tidak ditemukan');
        }

        $pakaian = $this->pakaianModel->getPakaianById($item['pakaian_id']);

        if (!$pakaian) {
            return redirect()->to('/keranjang')->with('error', 'Pakaian tidak ditemukan');
        }

        $stokKeranjang = $item['kuantitas'];
        $stok = $pakaian['stok'] + $stokKeranjang;

        $this->pakaianModel->save([
            'id' => $pakaian['id'],
            'stok' => (string)$stok
        ]);

        return $this->deleteItem($id);
    }

    public function deleteItem($id)
    {
        $this->itemKeranjangModel->delete($id);
        return redirect()->to('/keranjang')->with('message', 'Item berhasil dihapus');
    }
}
