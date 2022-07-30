<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelanggota extends Model
{
    protected $table                = 'anggota';
    protected $primaryKey           = 'noanggota';
    protected $allowedFields        = [
        'noanggota','namaanggota','pekerjaan','alamat','telepon','tglmasuk'
    ];
    public function cariData($cari)
    {
        return $this->table('anggota')->like('namaanggota', $cari);
    }
}