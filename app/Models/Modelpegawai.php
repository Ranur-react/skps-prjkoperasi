<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelpegawai extends Model
{
    protected $table                = 'pegawai';
    protected $primaryKey           = 'nik';
    protected $allowedFields        = [
        'nik','namapegawai','jabatan','gajipokok','status'
    ];
    public function cariData($cari)
    {
        return $this->table('pegawai')->like('namapegawai', $cari);
    }
}