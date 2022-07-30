<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelanggotakeluar extends Model
{
    protected $table                = 'anggotakeluar';
    protected $primaryKey           = 'kodekel';
    protected $allowedFields        = [
        'kodekel','tglkeluar','tglmasuk','noanggotakel','jumlahsimpanan','sisapinjaman'
    ];
    public function cariData($cari)
    {
        return $this->table('anggotakeluar')->like('kodekel', $cari);
    }

    public function tampildata()
    {
        return $this->table('anggotakeluar')->join('anggota', 'noanggotakel=noanggota');
    }
    public function tampildata_cari($cari)
    {
       return $this->table('anggotakeluar')->join('anggota', 'noanggotakel=noanggota') ->orlike('kodekel', $cari)->orlike('noanggotakel', $cari);
    }
}