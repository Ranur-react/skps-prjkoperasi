<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modelpegawai;
use App\Models\Modeljabatan;

class Pegawai extends BaseController
{
    public function __construct()
    {
        $this->pegawai = new Modelpegawai();
    }
    public function index()
    {
        $tombolcari = $this->request->getPost('tombolcari');

        if (isset($tombolcari)) {
            $cari = $this->request->getPost('cari');
            session()->set('cari_pegawai', $cari);
            redirect()->to('/pegawai/index');
        } else {
            $cari = session()->get('cari_pegawai');
        }

        $dataPegawai = $cari ? $this->pegawai->cariData($cari)->paginate(5, 'pegawai') : $this->pegawai->paginate(5, 'pegawai');

        $nohalaman = $this->request->getVar('page_pegawai') ? $this->request->getVar('page_pegawai') : 1;
        $data = [
            'tampildata' => $dataPegawai,
            'pager' => $this->pegawai->pager,
            'nohalaman' => $nohalaman,
            'cari' => $cari
        ];
        return view('pegawai/viewpegawai', $data);
    }
    public function formtambah()
    {
        return view('pegawai/formtambah');
    }
    public function simpandata()
    {
        $nik = $this->request->getVar('nik');
        $namaPegawai = $this->request->getVar('namapegawai');
        $jabatan = $this->request->getVar('jabatan');
        $gajiPokok = $this->request->getVar('gajipokok');
        $status = $this->request->getVar('status');


        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'nik' => [
                'rules' => 'required|is_unique[pegawai.nik]',
                'label' => 'Nik',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada'
                ]
            ],
            'namapegawai' => [
                'rules' => 'required',
                'label' => 'Nama Pegawai',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            'jabatan' => [
                'rules' => 'required',
                'label' => 'Jabatan',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            'gajipokok' => [
                'rules' => 'required|numeric',
                'label' => 'Gaji Pokok',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} hanya dalam bentuk angka'
                ]
            ],
            'status' => [
                'rules' => 'required',
                'label' => 'Status',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
                ]
        ]);

        if (!$valid) {
            $pesan = [
                'error' => '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i>Error</h5>
                ' . $validation->listErrors() . '
                </div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/pegawai/formtambah');
        } else {
            $this->pegawai->insert([
                'nik' => $nik,
                'namapegawai' => $namaPegawai,
                'jabatan' => $jabatan,
                'gajipokok' => $gajiPokok,
                'status' => $status

            ]);

            $pesan = [
                'sukses' => '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Berhasil</h5>
                Data Pegawai dengan Kode <strong>' . $nik . '</strong> berhasil disimpan
              </div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/pegawai/index');
        }
    }

    public function formedit($nik)
    {
        $rowData = $this->pegawai->find($nik);

        if ($rowData) {

            $data = [
                'nik' => $nik,
                'namaPegawai' => $rowData['namapegawai'],
                'jabatan' => $rowData['jabatan'],
                'gajiPokok' => $rowData['gajipokok'],
                'status' => $rowData['status']
            ];
            return view('/pegawai/formedit', $data);
        } else {
            exit('Data tidak ditemukan');
        }
    }
    public function updatedata()
    {
        $nik = $this->request->getVar('nik');
        $namaPegawai = $this->request->getVar('namapegawai');
        $jabatan = $this->request->getVar('jabatan');
        $gajiPokok = $this->request->getVar('gajipokok');
        $status = $this->request->getVar('status');
        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'namapegawai' => [
                'rules' => 'required',
                'label' => 'Nama Pegawai',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            'jabatan' => [
                'rules' => 'required',
                'label' => 'Jabatan',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            'gajipokok' => [
                'rules' => 'required|numeric',
                'label' => 'Gaji Pokok',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} hanya dalam bentuk angka'
                ]
            ],
            'status' => [
                'rules' => 'required',
                'label' => 'Status',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ]
        ]);

        if (!$valid) {
            $pesan = [
                'errorNamaPegawai' => '<br><div class="alert alert-danger">' . $validation->getError() . '</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/pegawai/formedit/' . $nik);
        } else {
            $this->pegawai->update(
                $nik,
                [
                    'namapegawai' => $namaPegawai,
                    'jabatan' => $jabatan,
                    'gajipokok' => $gajiPokok,
                    'status' => $status
                ]
            );

            $pesan = [
                'sukses' => '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h5><i class="icon fas fa-check"></i> Berhasil !</h5>
                Data pegawai berhasil diupdate</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/pegawai/index');
        }
    }
    public function hapus($nik)
    {
        $rowData = $this->pegawai->find($nik);

        if ($rowData) {

            $this->pegawai->delete($nik);

            $pesan = [
                'sukses' => '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h5><i class="icon fas fa-check"></i> Berhasil !</h5>
                Data pegawai berhasil dihapus</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/pegawai/index');
        } else {
            exit('Data tidak ditemukan');
        }
    }
}