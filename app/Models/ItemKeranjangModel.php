<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemKeranjangModel extends Model
{
    protected $table            = 'itemkeranjang';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['keranjang_id', 'pakaian_id', 'kuantitas'];
    protected $useTimestamps = true;

    public function getItemAll($keranjangId)
    {
        return $this->where(['keranjang_id' => $keranjangId])->findAll();
    }

    public function isItemExist($keranjangId, $bookId)
    {
        return $this->where(['keranjang_id' => $keranjangId])->where(['pakaian_id' => $bookId])->first();
    }

    public function getItemIdAll($keranjangId)
    {
        $items = $this->where(['keranjang_id' => $keranjangId])->findAll();
        $itemsId = array_column($items, 'pakaian_id');

        return $itemsId;
    }
}
