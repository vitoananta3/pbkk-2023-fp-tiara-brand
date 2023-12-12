<?php

namespace App\Models;

use CodeIgniter\Model;

class PakaianModel extends Model
{
    protected $table            = 'pakaian';
    protected $allowedFields    = ['title', 'slug', 'deskripsi', 'ukuran', 'harga', 'stok', 'gambar', 'kategori_id'];

    protected $useTimestamps = true;

    public function getPakaianAll()
    {
        return $this->findAll();
    }

    public function getPakaianById($id)
    {
        return $this->where(['id' => $id])->first();
    }

    public function getPakaianBySlug($slug)
    {
        return $this->where(['slug' => $slug])->first();
    }

    public function getPakaianByIds($ids)
    {
        return $this->whereIn('id', $ids)->findAll();
    }
}
