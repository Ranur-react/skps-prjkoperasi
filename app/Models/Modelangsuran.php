<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelangsuran extends Model
{
    protected $table                = 'angsuran';
    protected $primaryKey           = 'noangsuran';
    protected $allowedFields        = [
        'noangsuran','tglangsuran','angnopinjam','angnoanggota','jmlangsuran','angnamaanggota','angsuranke','sisapinjam'];

    public function tampildata()
        {
            return $this->table('angsuran')->join('pinjaman', 'angnopinjam=nopinjam')->join('anggota', 'angnoanggota=noanggota');
        }
        
    public function tampildata_cari($cari)
    {
        return $this->table('angsuran')->join('pinjaman', 'angnopinjam=nopinjam')->join('anggota', 'angnoanggota=noanggota')->orlike('noangsuran', $cari)->orlike('angnopinjam', $cari)->orlike('angnoanggota', $cari);
    }
}