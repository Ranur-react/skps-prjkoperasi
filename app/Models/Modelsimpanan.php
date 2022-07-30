<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelsimpanan extends Model
{
    protected $table                = 'simpanan';
    protected $primaryKey           = 'nosimpanan';
    protected $allowedFields        = [
        'nosimpanan','simnoanggota','jenis','jml','ket','tglsimpan'
    ];

    public function tampildata()
    {
        return $this->table('simpanan')->join('anggota', 'simnoanggota=noanggota');
    }

    public function tampildata_cari($cari)
    {
       return $this->table('simpanan')->join('anggota', 'simnoanggota=noanggota') ->orlike('nosimpanan', $cari)->orlike('simnoanggota', $cari);
    }
}