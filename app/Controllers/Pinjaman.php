<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modelpinjaman;
use App\Models\Modelanggota;

class Pinjaman extends BaseController
{
public function __construct()
{
    $this->pinjaman = new Modelpinjaman();
}
public function index()
{
    $tombolcari = $this->request->getPost('tombolcari');
    if (isset($tombolcari)) {
        $cari = $this->request->getPost('cari');
        session()->set('cari_pinjaman', $cari);
        redirect()->to('/barang/index');
    } else {
        $cari = session()->get('cari_pinjaman');
    }

    $totaldata = $cari ? $this->pinjaman->tampildata_cari($cari)->countAllResults() : $this->pinjaman->tampildata()->countAllResults();

    $dataPinjaman = $cari ? $this->pinjaman->tampildata_cari($cari)->paginate(10, 'pinjaman') : $this->pinjaman->tampildata()->paginate(10, 'pinjaman');

    $nohalaman = $this->request->getVar('page_pinjaman') ? $this->request->getVar('page_pinjaman') : 1;


    $data = [
        'tampildata' => $dataPinjaman,
        'pager' => $this->pinjaman->pager,
        'nohalaman' => $nohalaman,
        'totaldata' => $totaldata,
        'cari' => $cari

    ];
    return view('pinjaman/viewpinjaman', $data);
}
public function tambah()
{
    $modelanggota = new Modelanggota();
    $modelPinjaman = new Modelpinjaman();

    $data = [
        'dataanggota' => $modelanggota->findAll()
    ];
    return view('pinjaman/formtambah', $data);
}

public function simpandata()
{
    $nopinjam = $this->request->getVar('nopinjam');
    $tglpinjam = $this->request->getVar('tglpinjam');
    $anggota = $this->request->getVar('anggota');
    $jmlpinjam = $this->request->getVar('jmlpinjam');
    $lamapinjam = $this->request->getVar('lamapinjam');
    $jasa = $this->request->getVar('jasa');
    $askes = $this->request->getVar('askes');
    $respin = $this->request->getVar('respin');
    $sw = $this->request->getVar('sw');
    $sl = $this->request->getVar('sl');
    $hutang = $this->request->getVar('hutang');
    $jumlahpotongan = $this->request->getVar('jumlahpotongan');
    $pinjamanbersih = $this->request->getVar('pinjamanbersih');
    
    $validation = \Config\Services::validation();

    $valid = $this->validate([
        'nopinjam' => [
            'rules' => 'required|is_unique[pinjaman.nopinjam]',
            'label' => 'No Pinjam',
            'errors' => [
                'required' => '{field} tidak boleh kosong',
                'is_unique' => '{field} sudah ada'
            ]
        ],
        
        'tglpinjam' => [
            'rules' => 'date',
            'label' => 'Tgl Pinjam',
            'errors' => [
                'date' => '{field} tidak boleh kosong',

            ]
        ],

        'anggota' => [
            'rules' => 'required',
            'label' => 'Anggota',
            'errors' => [
                'required' => '{field} tidak boleh kosong',

            ]
        ],

        'jmlpinjam' => [
            'rules' => 'numeric',
            'label' => 'Jml Pinjam',
            'errors' => [
                'numeric' => '{field} hanya dalam bentuk angka',
            ]
        ],

        'lamapinjam' => [
            'rules' => 'numeric',
            'label' => 'Lama Pinjam',
            'errors' => [
                'numeric' => '{field} hanya dalam bentuk angka',
            ]
        ],

        'angsuran' => [
            'rules' => 'numeric',
            'label' => 'Angsuran',
            'errors' => [
                'numeric' => '{field} hanya dalam bentuk angka',
            ]
        ],
        
        'jasa' => [
            'rules' => 'numeric',
            'label' => 'Jasa',
            'errors' => [
                'numeric' => '{field} hanya dalam bentuk angka',
            ]
        ],
        
        'askes' => [
            'rules' => 'numeric',
            'label' => 'Askes',
            'errors' => [
                'numeric' => '{field} hanya dalam bentuk angka',
            ]
        ],
        
        'respin' => [
            'rules' => 'numeric',
            'label' => 'Respin',
            'errors' => [
                'numeric' => '{field} hanya dalam bentuk angka',
            ]
        ],

        'sw' => [
            'rules' => 'numeric',
            'label' => 'Sw',
            'errors' => [
                'numeric' => '{field} hanya dalam bentuk angka',
            ]
        ],

        'sl' => [
            'rules' => 'numeric',
            'label' => 'Sl',
            'errors' => [
                'numeric' => '{field} hanya dalam bentuk angka',
            ]
        ],

        'hutang' => [
            'rules' => 'numeric',
            'label' => 'Hutang',
            'errors' => [
                'numeric' => '{field} hanya dalam bentuk angka',
            ]
        ],

        'jumlahpotongan' => [
            'rules' => 'numeric',
            'label' => 'Jumlah Potongan',
            'errors' => [
                'numeric' => '{field} hanya dalam bentuk angka',
            ]
        ],
        
        'pinjamanbersih' => [
            'rules' => 'numeric',
            'label' => 'Pinjaman Bersih',
            'errors' => [
                'numeric' => '{field} hanya dalam bentuk angka',
            ],
    ]]);

    if (!$valid) {
        $sess_Pesan = [
            'error' => '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i>Error</h5>
            ' . $validation->listErrors() . '
            </div>'
        ];

        session()->setFlashdata($sess_Pesan);
        return redirect()->to('/pinjaman/tambah');
    } else {
        $this->pinjaman->insert([
            'nopinjam' => $nopinjam,
            'tglpinjam' => $tglpinjam,
            'pinnoanggota' => $anggota,
            'jmlpinjam' => $jmlpinjam,
            'lamapinjam' => $lamapinjam,
            'angsuran' => $angsuran,
            'jasa' => $jasa,
            'askes' => $askes,
            'respin' => $respin,
            'sw' => $sw,
            'sl' => $sl,
            'hutang' => $hutang,
            'jumlahpotongan' => $jumlahpotongan,
            'pinjamanbersih' => $pinjamanbersih

        ]);

        $pesan_sukses = [
            'sukses' => '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Berhasil</h5>
            Data Barang dengan Kode <strong>' . $nopinjam . '</strong> berhasil disimpan
          </div>'
        ];

        session()->setFlashdata($pesan_sukses);
        return redirect()->to('pinjaman/tambah');
    }
}

public function edit($kode)
{
    $cekData = $this->pinjaman->find($kode);

    if ($cekData) {

        $modelanggota = new Modelanggota();
        $data = [
            'nopinjam' => $cekData['nopinjam'],
            'tglpinjam' => $cekData['tglpinjam'],
            'pinnoanggota' => $cekData['pinnoanggota'],
            'jmlpinjam' => $cekData['jmlpinjam'],
            'lamapinjam' => $cekData['lamapinjam'],
            'angsuran' => $cekData['angsuran'],
            'jasa' => $cekData['jasa'],
            'askes' => $cekData['askes'],
            'respin' => $cekData['respin'],
            'sw' => $cekData['sw'],
            'sl' => $cekData['sl'],
            'hutang' => $cekData['hutang'],
            'jumlahpotongan' => $cekData['jumlahpotongan'],
            'pinjamanbersih' => $cekData['pinjamanbersih'],
            'dataanggota' => $modelanggota->findAll()
        ];
        return view('pinjaman/formedit', $data);
    } else {
        $pesan_error = [
            'error' => '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i>Error</h5>
            Data Pinjaman tidak ditemukan
          </div>'
        ];

        session()->setFlashdata($pesan_error);
        return redirect()->to('/composer.jsonpinjaman/index');
    }
}
public function updatedata()
{
    $nopinjam = $this->request->getVar('nopinjam');
    $tglpinjam = $this->request->getVar('tglpinjam');
    $anggota = $this->request->getVar('anggota');
    $jmlpinjam = $this->request->getVar('jmlpinjam');
    $lamapinjam = $this->request->getVar('lamapinjam');
    $angsuran = $this->request->getVar('angsuran');
    $jasa = $this->request->getVar('jasa');
    $askes = $this->request->getVar('askes');
    $respin = $this->request->getVar('respin');
    $sw = $this->request->getVar('sw');
    $sl = $this->request->getVar('sl');
    $hutang = $this->request->getVar('hutang');
    $jumlahpotongan = $this->request->getVar('jumlahpotongan');
    $pinjamanbersih = $this->request->getVar('pinjamanbersih');

    $validation = \Config\Services::validation();

    $valid = $this->validate([
        'tglpinjam' => [
            'rules' => 'date',
            'label' => 'Tgl Pinjam',
            'errors' => [
                'date' => '{field} tidak boleh kosong',
            ]
        ],

        'anggota' => [
            'rules' => 'required',
            'label' => 'Anggota',
            'errors' => [
                'required' => '{field} tidak boleh kosong',
            ]
        ],

        'jmlpinjam' => [
            'rules' => 'numeric',
            'label' => 'Jml Pinjam',
            'errors' => [
                'numeric' => '{field} hanya dalam bentuk angka',
            ]
        ],

        'lamapinjam' => [
            'rules' => 'numeric',
            'label' => 'Lama',
            'errors' => [
                'numeric' => '{field} hanya dalam bentuk angka',
            ]
        ],

        'angsuran' => [
            'rules' => 'numeric',
            'label' => 'Angsuran',
            'errors' => [
                'numeric' => '{field} hanya dalam bentuk angka',
            ]
        ],
        
        'jasa' => [
            'rules' => 'numeric',
            'label' => 'Jasa',
            'errors' => [
                'numeric' => '{field} hanya dalam bentuk angka',
            ]
        ],
        
        'askes' => [
            'rules' => 'numeric',
            'label' => 'Askes',
            'errors' => [
                'numeric' => '{field} hanya dalam bentuk angka',
            ]
        ],
        
        'respin' => [
            'rules' => 'numeric',
            'label' => 'Respin',
            'errors' => [
                'numeric' => '{field} hanya dalam bentuk angka',
            ]
        ],

        'sw' => [
            'rules' => 'numeric',
            'label' => 'Sw',
            'errors' => [
                'numeric' => '{field} hanya dalam bentuk angka',
            ]
        ],
        
        'sl' => [
            'rules' => 'numeric',
            'label' => 'Sl',
            'errors' => [
                'numeric' => '{field} hanya dalam bentuk angka',
            ]
        ],
        
        'hutang' => [
            'rules' => 'numeric',
            'label' => 'Hutang',
            'errors' => [
                'numeric' => '{field} hanya dalam bentuk angka',
            ]
        ],
        
        'jumlahpotongan' => [
            'rules' => 'numeric',
            'label' => 'Jumlah Potongan',
            'errors' => [
                'numeric' => '{field} hanya dalam bentuk angka',
            ]
        ],
        
        'pinjamanbersih' => [
            'rules' => 'numeric',
            'label' => 'Pinjaman Bersih',
            'errors' => [
                'numeric' => '{field} hanya dalam bentuk angka',
            ],
        ]]);

    if (!$valid) {
        $sess_Pesan = [
            'error' => '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i>Error</h5>
            ' . $validation->listErrors() . '
            </div>'
        ];

        session()->setFlashdata($sess_Pesan);
        return redirect()->to('/pinjaman/tambah');
    } else {

        $cekData = $this->pinjaman->find($nopinjam);
        $this->pinjaman->update($nopinjam, [

            'tglpinjam' => $tglpinjam,
            'pinnoanggota' => $anggota,
            'jmlpinjam' => $jmlpinjam,
            'lamapinjam' => $lamapinjam,
            'angsuran' => $angsuran,
            'jasa' => $jasa,
            'askes' => $askes,
            'respin' => $respin,
            'sw' => $sw,
            'sl' => $sl,
            'hutang' => $hutang,
            'jumlahpotongan' => $jumlahpotongan,
            'pinjamanbersih' => $pinjamanbersih

        ]);

        $pesan_sukses = [
            'sukses' => '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Berhasil</h5>
            Data Barang dengan Kode <strong>' . $nopinjam . '</strong> berhasil diupdate
          </div>'
        ];

        session()->setFlashdata($pesan_sukses);
        return redirect()->to('pinjaman/index');
    }
}

public function hapus($kode)
{
    $cekData = $this->pinjaman->find($kode);
    if ($cekData) {
        $this->pinjaman->delete($kode);
        $pesan_sukses = [
            'sukses' => '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Berhasil</h5>
            Data Pinjaman dengan Kode <strong>' . $kode . '</strong> berhasil dihapus
          </div>'
        ];

        session()->setFlashdata($pesan_sukses);
        return redirect()->to('/pinjaman/index');
    } else {
        $pesan_error = [
            'error' => '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i>Error</h5>
            Data Pinjaman tidak ditemukan
          </div>'
        ];

        session()->setFlashdata($pesan_error);
        return redirect()->to('/pinjaman/index');
    }
}
}