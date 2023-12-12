<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table            = 'kategori';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nama', 'slug'];
    protected $useTimestamps = true;

    public function getKategoriAll()
    {
        return $this->findAll();
    }

    public function getKategoriIdAll()
    {
        $kategori = $this->findAll();
        $kategoriIds = array_column($kategori, 'id');

        return $kategoriIds;
    }

    public function getKategori($slug)
    {
        return $this->where(['slug' => $slug])->first();
    }

    public function getKategoriById($id)
    {
        return $this->where(['id' => $id])->first();
    }   
}
