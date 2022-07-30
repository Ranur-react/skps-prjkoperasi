<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelpinjaman extends Model
{
    protected $table                = 'pinjaman';
    protected $primaryKey           = 'nopinjam';
    protected $allowedFields        = [
        'nopinjam','tglpinjam','pinnoanggota','jmlpinjam','lamapinjam','angsuran','jasa','askes','respin','sw','sl','hutang','jumlahpotongan','pinjamanbersih'];
        
    public function tampildata()
        {
            return $this->table('pinjaman')->join('anggota', 'pinnoanggota=noanggota');
        }
        
    public function tampildata_cari($cari)
    {
       return $this->table('pinjaman')->join('anggota', 'pinnoanggota=noanggota') ->orlike('nopinjam', $cari)->orlike('pinnoanggota', $cari);
    }
}