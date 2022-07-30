<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modelanggotakeluar;
use App\Models\Modelanggota;

class Anggotakeluar extends BaseController
{
    public function __construct()
    {
        $this->anggotakeluar = new Modelanggotakeluar();
    }
    public function index()
    {
        $tombolcari = $this->request->getPost('tombolcari');
        if (isset($tombolcari)) {
            $cari = $this->request->getPost('cari');
            session()->set('cari_anggotakeluar', $cari);
            redirect()->to('/anggotakeluar/index');
        } else {
            $cari = session()->get('cari_anggotakeluar');
        }

        $totaldata = $cari ? $this->anggotakeluar->tampildata_cari($cari)->countAllResults() : $this->anggotakeluar->tampildata()->countAllResults();

        $dataAnggotakeluar = $cari ? $this->anggotakeluar->tampildata_cari($cari)->paginate(10, 'anggotakeluar') : $this->anggotakeluar->tampildata()->paginate(10, 'anggotakeluar');

        $nohalaman = $this->request->getVar('page_anggotakeluar') ? $this->request->getVar('page_anggotakeluar') : 1;


        $data = [
            'tampildata' => $dataAnggotakeluar,
            'pager' => $this->anggotakeluar->pager,
            'nohalaman' => $nohalaman,
            'totaldata' => $totaldata,
            'cari' => $cari

        ];
        return view('anggotakeluar/viewanggotakeluar', $data);
    }
    public function tambah()
    {
        $modelanggota = new Modelanggota();

        $data = [
            'dataanggota' => $modelanggota->findAll()
        ];
        return view('anggotakeluar/formtambah', $data);
    }

    public function simpandata()
    {
        $kodekel = $this->request->getVar('kodekel');
        $tglkeluar = $this->request->getVar('tglkeluar');
        $tglmasuk = $this->request->getVar('tglmasuk');
        $anggota = $this->request->getVar('anggota');
        $jumlahsimpanan = $this->request->getVar('jumlahsimpanan');
        $sisapinjaman = $this->request->getVar('sisapinjaman');

        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'kodekel' => [
                'rules' => 'required|is_unique[anggotakeluar.kodekel]',
                'label' => 'Kode Anggota Keluar',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada'
                ]
            ],
            'tglkeluar' => [
                'rules' => 'required',
                'label' => 'Tgl Keluar',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],

            'tglmasuk' => [
                'rules' => 'required',
                'label' => 'Tgl Keluar',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],

            'anggota' => [
                'rules' => 'required',
                'label' => 'Anggota',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],

            'jumlahsimpanan' => [
                'rules' => 'required',
                'label' => 'Jumlah Simpanan',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],

            'sisapinjaman' => [
                'rules' => 'required',
                'label' => 'Sisa Pinjaman',
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
            return redirect()->to('/anggotakeluar/tambah');
        } else {
            $this->anggotakeluar->insert([
                'kodekel' => $kodekel,
                'tglkeluar' => $tglkeluar,
                'tglmasuk' => $tglmasuk,
                'noanggotakel' => $anggota,
                'jumlahsimpanan' => $jumlahsimpanan,
                'sisapinjaman' => $sisapinjaman

            ]);

            $pesan_sukses = [
                'sukses' => '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Berhasil</h5>
                Data Barang dengan Kode <strong>' . $kodekel . '</strong> berhasil disimpan
              </div>'
            ];

            session()->setFlashdata($pesan_sukses);
            return redirect()->to('anggotakeluar/index');
        }
    }

    public function formedit($kode)
    {
        $cekData = $this->anggotakeluar->find($kode);

        if ($cekData) {

            $modelanggota = new Modelanggota();
            $data = [
                'kodekel' => $cekData['kodekel'],
                'tglkeluar' => $cekData['tglkeluar'],
                'tglmasuk' => $cekData['tglmasuk'],
                'noanggotakel' => $cekData['noanggotakel'],
                'jumlahsimpanan' => $cekData['jumlahsimpanan'],
                'sisapinjaman' => $cekData['sisapinjaman'],
                'dataanggota' => $modelanggota->findAll()
            ];
            return view('anggotakeluar/formedit', $data);
        } else {
            $pesan_error = [
                'error' => '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i>Error</h5>
                Data Simpanan tidak ditemukan
              </div>'
            ];

            session()->setFlashdata($pesan_error);
            return redirect()->to('/composer.jsonanggotakeluar/index');
        }
    }
    public function updatedata()
    {
        $kodekel = $this->request->getVar('kodekel');
        $tglkeluar = $this->request->getVar('tglkeluar');
        $tglmasuk = $this->request->getVar('tglmasuk');
        $anggota = $this->request->getVar('anggota');
        $jumlahsimpanan = $this->request->getVar('jumlahsimpanan');
        $sisapinjaman = $this->request->getVar('sisapinjaman');

        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'tglkeluar' => [
                'rules' => 'required',
                'label' => 'Tgl Keluar',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],

            'tglmasuk' => [
                'rules' => 'required',
                'label' => 'Tgl Keluar',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],

            'anggota' => [
                'rules' => 'required',
                'label' => 'Anggota',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],

            'jumlahsimpanan' => [
                'rules' => 'required',
                'label' => 'Jumlah Simpanan',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],

            'sisapinjaman' => [
                'rules' => 'required',
                'label' => 'Sisa Pinjaman',
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
            return redirect()->to('/anggotakeluar/tambah');
        } else {

            $cekData = $this->anggotakeluar->find($kodekel);
            $this->anggotakeluar->update($kodekel, [

                'tglkeluar' => $tglkeluar,
                'tglmasuk' => $tglmasuk,
                'noanggotakel' => $anggota,
                'jumlahsimpanan' => $jumlahsimpanan,
                'sisapinjaman' => $sisapinjaman

            ]);

            $pesan_sukses = [
                'sukses' => '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Berhasil</h5>
                Data Barang dengan Kode <strong>' . $kodekel . '</strong> berhasil diupdate
              </div>'
            ];

            session()->setFlashdata($pesan_sukses);
            return redirect()->to('anggotakeluar/index');
        }
    }

    public function hapus($kode)
    {
        $cekData = $this->anggotakeluar->find($kode);
        if ($cekData) {
            $this->anggotakeluar->delete($kode);
            $pesan_sukses = [
                'sukses' => '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Berhasil</h5>
                Data Simpanan dengan Kode <strong>' . $kode . '</strong> berhasil dihapus
              </div>'
            ];

            session()->setFlashdata($pesan_sukses);
            return redirect()->to('/anggotakeluar/index');
        } else {
            $pesan_error = [
                'error' => '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i>Error</h5>
                Data Anggota Keluar tidak ditemukan
              </div>'
            ];

            session()->setFlashdata($pesan_error);
            return redirect()->to('/anggotakeluar/index');
        }
    }
}