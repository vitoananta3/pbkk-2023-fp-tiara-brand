<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $table            = 'pengguna';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['namaDepan', 'namaBelakang', 'email', 'password', 'repeatPassword', 'isAdmin'];
    protected $useTimestamps = true;

    public function getUser($email){
        return $this->where(['email' => $email])->first();
    }
}
