<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modelanggota;

class Anggota extends BaseController
{
public function __construct()
{
    $this->anggota = new Modelanggota();
}
public function index()
{
    $tombolcari = $this->request->getPost('tombolcari');

    if (isset($tombolcari)) {
        $cari = $this->request->getPost('cari');
        session()->set('cari_anggota', $cari);
        redirect()->to('/anggota/index');
    } else {
        $cari = session()->get('cari_anggota');
    }

    $dataAnggota = $cari ? $this->anggota->cariData($cari)->paginate(5, 'anggota') : $this->anggota->paginate(5, 'anggota');

    $nohalaman = $this->request->getVar('page_anggota') ? $this->request->getVar('page_anggota') : 1;
    $data = [
        'tampildata' => $dataAnggota,
        'pager' => $this->anggota->pager,
        'nohalaman' => $nohalaman,
        'cari' => $cari
    ];
    return view('anggota/viewanggota', $data);
}
public function formtambah()
{
    return view('anggota/formtambah');
}
public function simpandata()
{
    $noAnggota = $this->request->getVar('noanggota');
    $namaAnggota = $this->request->getVar('namaanggota');
    $pekerjaan = $this->request->getVar('pekerjaan');
    $alamat = $this->request->getVar('alamat');
    $telepon = $this->request->getVar('telepon');
    $tglMasuk = $this->request->getVar('tglmasuk');

    $validation = \Config\Services::validation();

    $valid = $this->validate([
        'noanggota' => [
            'rules' => 'required',
            'label' => 'No Anggota',
            'errors' => [
                'required' => '{field} tidak boleh kosong'
            ]
        ],
        'namaanggota' => [
            'rules' => 'required',
            'label' => 'Nama Anggota',
            'errors' => [
                'required' => '{field} tidak boleh kosong',
            ]
        ],
        'pekerjaan' => [
            'rules' => 'required',
            'label' => 'Pekerjaan',
            'errors' => [
                'required' => '{field} tidak boleh kosong',
            ]
        ],
        'alamat' => [
            'rules' => 'required',
            'label' => 'Alamat',
            'errors' => [
                'required' => '{field} tidak boleh kosong'
            ]
        ],
        'telepon' => [
            'rules' => 'required|numeric',
            'label' => 'Telepon',
            'errors' => [
                'required' => '{field} tidak boleh kosong',
                'numeric' => '{field} hanya dalam bentuk angka'
            ]
            ],
            'tglmasuk' => [
                'rules' => 'date',
                'label' => 'Tanggal Masuk',
                'errors' => [
                    'date' => '{field} tidak berupa angka',
                ]
                ]
    ]);

    if (!$valid) {
        $pesan = [
            'errorNamaAnggota' =>
            '<br><div class="alert alert-danger">'
                . $validation->getError() . '</div>'
        ];

        session()->setFlashdata($pesan);
        return redirect()->to('/anggota/formtambah');
    } else {
        $this->anggota->insert([
            'noanggota' => $noAnggota,
            'namaanggota' => $namaAnggota,
            'pekerjaan' => $pekerjaan,
            'alamat' => $alamat,
            'telepon' => $telepon,
            'tglmasuk' => $tglMasuk

        ]);

        $pesan = [
            'sukses' =>
            '<div class="alert alert-success">Data Anggota Berhasi Ditambah</div>'
        ];

        session()->setFlashdata($pesan);
        return redirect()->to('/anggota/index');
    }
}

public function formedit($noAnggota)
{
    $rowData = $this->anggota->find($noAnggota);

    if ($rowData) {

        $data = [
            'noanggota' => $noAnggota,
            'namaAnggota' => $rowData['namaanggota'],
            'pekerjaan' => $rowData['pekerjaan'],
            'alamat' => $rowData['alamat'],
            'telepon' => $rowData['telepon'],
            'tglMasuk' => $rowData['tglmasuk']
        ];
        return view('/anggota/formedit', $data);
    } else {
        exit('Data tidak ditemukan');
    }
}
public function updatedata()
{
    $noAnggota = $this->request->getVar('noanggota');
    $namaAnggota = $this->request->getVar('namaanggota');
    $pekerjaan = $this->request->getVar('pekerjaan');
    $alamat = $this->request->getVar('alamat');
    $telepon = $this->request->getVar('telepon');
    $tglMasuk = $this->request->getVar('tglmasuk');
    $validation = \Config\Services::validation();

    $valid = $this->validate([
        'namaanggota' => [
            'rules' => 'required',
            'label' => 'Nama Anggota',
            'errors' => [
                'required' => '{field} tidak boleh kosong',
            ]
        ],
        'pekerjaan' => [
            'rules' => 'required',
            'label' => 'Pekerjaan',
            'errors' => [
                'required' => '{field} tidak boleh kosong',
            ]
        ],
        'alamat' => [
            'rules' => 'required',
            'label' => 'Alamat',
            'errors' => [
                'required' => '{field} tidak boleh kosong',
            ]
        ],
        'telepon' => [
            'rules' => 'required|numeric',
            'label' => 'Telepon',
            'errors' => [
                'required' => '{field} tidak boleh kosong',
                'numeric' => '{field} hanya dalam bentuk angka'
            ]
        ],
        'tglmasuk' => [
            'rules' => 'date',
            'label' => 'Tgl Masuk',
            'errors' => [
                'date' => '{field} hanya tanggal'
            ]
        ]
    ]);

    if (!$valid) {
        $pesan = [
            'errorNamaAnggota' => '<br><div class="alert alert-danger">' . $validation->getError() . '</div>'
        ];

        session()->setFlashdata($pesan);
        return redirect()->to('/anggota/formedit/' . $noAnggota);
    } else {
        $this->anggota->update(
            $noAnggota,
            [
                'namaanggota' => $namaAnggota,
                'pekerjaan' => $pekerjaan,
                'alamat' => $alamat,
                'telepon' => $telepon,
                'tglmasuk' => $tglMasuk
            ]
        );

        $pesan = [
            'sukses' => '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <h5><i class="icon fas fa-check"></i> Berhasil !</h5>
            Data Anggota berhasil diupdate</div>'
        ];

        session()->setFlashdata($pesan);
        return redirect()->to('/anggota/index');
    }
}
public function hapus($noAnggota)
{
    $rowData = $this->anggota->find($noAnggota);

    if ($rowData) {

        $this->anggota->delete($noAnggota);

        $pesan = [
            'sukses' => '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <h5><i class="icon fas fa-check"></i> Berhasil !</h5>
            Data Anggota berhasil dihapus</div>'
        ];

        session()->setFlashdata($pesan);
        return redirect()->to('/anggota/index');
    } else {
        exit('Data tidak ditemukan');
    }
}
}