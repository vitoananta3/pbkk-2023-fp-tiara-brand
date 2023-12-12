<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table            = 'kategori';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nama', 'slug'];
    protected $useTimestamps = true;

    public function getCategories()
    {
        return $this->findAll();
    }

    public function getCategoryIds()
    {
        $categories = $this->findAll();
        $categoryIds = array_column($categories, 'id');

        return $categoryIds;
    }

    public function getCategory($slug)
    {
        return $this->where(['slug' => $slug])->first();
    }

    public function getCategoryById($id)
    {
        return $this->where(['id' => $id])->first();
    }   
}
