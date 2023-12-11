<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table            = 'carts';
    protected $primaryKey       = 'id';
    // protected $useAutoIncrement = true;
    // protected $returnType       = 'array';
    // protected $useSoftDeletes   = false;
    // protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'isActive', 'transacionDate', 'totalPrice'];

    // Dates
    protected $useTimestamps = true;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

    // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert   = [];
    // protected $afterInsert    = [];
    // protected $beforeUpdate   = [];
    // protected $afterUpdate    = [];
    // protected $beforeFind     = [];
    // protected $afterFind      = [];
    // protected $beforeDelete   = [];
    // protected $afterDelete    = [];

    public function getCarts()
    {
        return $this->findAll();
    }

    public function getCartById($id)
    {
        return $this->where(['id' => $id])->first();
    }

    public function getActiveCart($userId)
    {
        return $this->where(['user_id' => $userId])->where(['isActive' => '1'])->first();
    }

    public function getInactiveCarts($userId)
    {
        return $this->where(['user_id' => $userId])->where(['isActive' => '0'])->findAll();
    }

    public function getTotalInactiveCarts($userId)
    {
        return $this->where(['user_id' => $userId])->where(['isActive' => '0'])->countAllResults();
    }
}
