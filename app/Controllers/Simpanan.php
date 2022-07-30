<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modelsimpanan;
use App\Models\Modelanggota;

class Simpanan extends BaseController
{
    public function __construct()
    {
        $this->simpanan = new Modelsimpanan();
    }
    public function index()
    {
        $tombolcari = $this->request->getPost('tombolcari');
        if (isset($tombolcari)) {
            $cari = $this->request->getPost('cari');
            session()->set('cari_simpanan', $cari);
            redirect()->to('/barang/index');
        } else {
            $cari = session()->get('cari_simpanan');
        }

        $totaldata = $cari ? $this->simpanan->tampildata_cari($cari)->countAllResults() : $this->simpanan->tampildata()->countAllResults();

        $dataSimpanan = $cari ? $this->simpanan->tampildata_cari($cari)->paginate(10, 'simpanan') : $this->simpanan->tampildata()->paginate(10, 'simpanan');

        $nohalaman = $this->request->getVar('page_simpanan') ? $this->request->getVar('page_simpanan') : 1;


        $data = [
            'tampildata' => $dataSimpanan,
            'pager' => $this->simpanan->pager,
            'nohalaman' => $nohalaman,
            'totaldata' => $totaldata,
            'cari' => $cari

        ];
        return view('simpanan/viewsimpanan', $data);
    }
    public function tambah()
    {
        $modelanggota = new Modelanggota();

        $data = [
            'dataanggota' => $modelanggota->findAll()
        ];
        return view('simpanan/formtambah', $data);
    }

    public function simpandata()
    {
        $nosimpanan = $this->request->getVar('nosimpanan');
        $anggota = $this->request->getVar('anggota');
        $jenis = $this->request->getVar('jenis');
        $jml = $this->request->getVar('jml');
        $ket = $this->request->getVar('ket');
        $tglsimpan = $this->request->getVar('tglsimpan');

        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'nosimpanan' => [
                'rules' => 'required|is_unique[simpanan.nosimpanan]',
                'label' => 'No Simpanan',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada'
                ]
            ],
            'anggota' => [
                'rules' => 'required',
                'label' => 'Anggota',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',

                ]

            ],

            'jenis' => [
                'rules' => 'required',
                'label' => 'Jenis',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',

                ]

            ],

            'jml' => [
                'rules' => 'required|numeric',
                'label' => 'Jumlah',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} hanya dalam bentuk angka'

                ]

            ],

            'ket' => [
                'rules' => 'required',
                'label' => 'Keterangan',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]

            ],

            'tglsimpan' => [
                'rules' => 'required',
                'label' => 'Tgl Simpan',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
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
            return redirect()->to('/simpanan/tambah');
        } else {
            $this->simpanan->insert([
                'nosimpanan' => $nosimpanan,
                'simnoanggota' => $anggota,
                'jenis' => $jenis,
                'jml' => $jml,
                'ket' => $ket,
                'tglsimpan' => $tglsimpan

            ]);

            $pesan_sukses = [
                'sukses' => '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Berhasil</h5>
                Data Barang dengan Kode <strong>' . $nosimpanan . '</strong> berhasil disimpan
              </div>'
            ];

            session()->setFlashdata($pesan_sukses);
            return redirect()->to('simpanan/tambah');
        }
    }

    public function edit($kode)
    {
        $cekData = $this->simpanan->find($kode);

        if ($cekData) {

            $modelanggota = new Modelanggota();
            $data = [
                'nosimpanan' => $cekData['nosimpanan'],
                'simnoanggota' => $cekData['simnoanggota'],
                'jenis' => $cekData['jenis'],
                'jml' => $cekData['jml'],
                'ket' => $cekData['ket'],
                'tglsimpan' => $cekData['tglsimpan'],
                'dataanggota' => $modelanggota->findAll()
            ];
            return view('simpanan/formedit', $data);
        } else {
            $pesan_error = [
                'error' => '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i>Error</h5>
                Data Simpanan tidak ditemukan
              </div>'
            ];

            session()->setFlashdata($pesan_error);
            return redirect()->to('/composer.jsonsimpanan/index');
        }
    }
    public function updatedata()
    {
        $nosimpanan = $this->request->getVar('nosimpanan');
        $anggota = $this->request->getVar('anggota');
        $jenis = $this->request->getVar('jenis');
        $jml = $this->request->getVar('jml');
        $ket = $this->request->getVar('ket');
        $tglsimpan = $this->request->getVar('tglsimpan');

        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'anggota' => [
                'rules' => 'required',
                'label' => 'No Anggota',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',

                ]

            ],

            'jenis' => [
                'rules' => 'required',
                'label' => 'Jenis',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',

                ]

            ],

            'jml' => [
                'rules' => 'required|numeric',
                'label' => 'Jumlah',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} hanya dalam bentuk angka'

                ]

            ],

            'ket' => [
                'rules' => 'required',
                'label' => 'Keterangan',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]

            ],

            'tglsimpan' => [
                'rules' => 'date',
                'label' => 'Tgl Simpan',
                'errors' => [
                    'date' => '{field} hanya berupa tanggal'
                ]
            ]
            ]);

        if (!$valid) {
            $sess_Pesan = [
                'error' => '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i>Error</h5>
                ' . $validation->listErrors() . '
                </div>'
            ];

            session()->setFlashdata($sess_Pesan);
            return redirect()->to('/simpanan/tambah');
        } else {

            $cekData = $this->simpanan->find($nosimpanan);
            $this->simpanan->update($nosimpanan, [

                'simnoanggota' => $anggota,
                'jenis' => $jenis,
                'jml' => $jml,
                'ket' => $ket,
                'tglsimpan' => $tglsimpan

            ]);

            $pesan_sukses = [
                'sukses' => '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Berhasil</h5>
                Data Barang dengan Kode <strong>' . $nosimpanan . '</strong> berhasil diupdate
              </div>'
            ];

            session()->setFlashdata($pesan_sukses);
            return redirect()->to('simpanan/index');
        }
    }

    public function hapus($kode)
    {
        $cekData = $this->simpanan->find($kode);
        if ($cekData) {
            $this->simpanan->delete($kode);
            $pesan_sukses = [
                'sukses' => '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Berhasil</h5>
                Data Simpanan dengan Kode <strong>' . $kode . '</strong> berhasil dihapus
              </div>'
            ];

            session()->setFlashdata($pesan_sukses);
            return redirect()->to('/simpanan/index');
        } else {
            $pesan_error = [
                'error' => '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i>Error</h5>
                Data Simpanan tidak ditemukan
              </div>'
            ];

            session()->setFlashdata($pesan_error);
            return redirect()->to('/simpanan/index');
        }
    }
}