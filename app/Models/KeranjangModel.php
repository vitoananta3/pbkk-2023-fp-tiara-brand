<?php

namespace App\Models;

use CodeIgniter\Model;

class KeranjangModel extends Model
{
    protected $table            = 'keranjang';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['pengguna_id', 'isActive', 'isDone', 'totalHarga', 'transacionDate',];
    protected $useTimestamps = true;

    public function getKeranjangAll()
    {
        return $this->findAll();
    }

    public function getKeranjangById($id)
    {
        return $this->where(['id' => $id])->first();
    }

    public function getKeranjangActive($userId)
    {
        return $this->where(['pengguna_id' => $userId])->where(['isActive' => '1'])->first();
    }

    public function getKeranjangAllTidakActive($userId)
    {
        return $this->where(['pengguna_id' => $userId])->where(['isActive' => '0'])->findAll();
    }

    public function getTotalKeranjangAllTidakActive($userId)
    {
        return $this->where(['pengguna_id' => $userId])->where(['isActive' => '0'])->countAllResults();
    }

    public function getKeranjangAllTidakActiveAdmin()
    {
        return $this->where(['isActive' => '0'])->findAll();
    }

    public function getKeranjangAllDoneAdmin()
    {
        return $this->where(['isActive' => '0'])->where(['isDone' => '1'])->findAll();
    }
}
