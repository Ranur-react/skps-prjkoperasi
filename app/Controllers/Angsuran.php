<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modelangsuran;
use App\Models\Modelanggota;
use App\Models\Modelpinjaman;

class Angsuran extends BaseController
{
    public function index()
    {
        return view('angsuran/forminput');
    }

    function ambilDataPinjaman()
    {

        if ($this->request->isAJAX()) {
            $nopinjam = $this->request->getPost('nopinjam');
            $noanggota = $this->request->getPost('noanggota');

            $modelpinjaman = new Modelpinjaman();
            $ambilData = $modelpinjaman->find($nopinjam);


            if ($ambilData == NULL) {
                $json = [
                    'error' => 'Data pinjaman tidak ditemukan...'
                ];
            } else {
                $data = [
                    'pinnoanggota' => $ambilData['pinnoanggota'],
                    'angsuran' => $ambilData['angsuran']
                ];

                $json = [
                    'sukses' => $data
                ];
            }

            echo json_encode($json);
        } else {
            exit('Maaf tidak bisa dipanggil');
        }
    }

    function hapus()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');

            $json = [
                'sukses' => 'Item berhasil dihapus'
            ];

            echo json_encode($json);
        } else {
            exit('Maaf tidak bisa dipanggil');
        }
    }

    function cariDataPinjaman()
    {
        if ($this->request->isAJAX()) {
            $json = [
                'data' => view('angsuran/modalcaripinjaman')
            ];

            echo json_encode($json);
        } else {
            exit('Maaf tidak bisa dipanggil');
        }
    }

    function detailCariPinjaman()
    {
        if ($this->request->isAJAX()) {
            $cari = $this->request->getPost('cari');

            $modelpinjaman = new Modelpinjaman();
            $data = $modelpinjaman->tampildata_cari($cari)->get();
            $json = [
                'data' => view('angsuran/detaildatapinjaman', [
                    'tampildata' => $data
                ])
            ];

            echo json_encode($json);
        } else {
            exit('Maaf tidak bisa dipanggil');
        }
    }

    function selesaiTransaksi()
    {
        if ($this->request->isAJAX()) {
            $noangsuran = $this->request->getPost('noangsuran');
            $tglangsuran = $this->request->getPost('tglangsuran');

        }
                }
    

    public function data()
    {
        $tombolcari = $this->request->getPost('tombolcari');
        if (isset($tombolcari)) {
            $cari = $this->request->getPost('cari');
            session()->set('cari_faktur', $cari);
            redirect()->to('/barangmasuk/data');
        } else {
            $cari = session()->get('cari_faktur');
        }

        $modelBarangMasuk = new Modelbarangmasuk();

        $totaldata = $cari ? $modelBarangMasuk->tampildata_cari($cari)->countAllResults() : $modelBarangMasuk->countAllResults();

        $databarangmasuk = $cari ? $modelBarangMasuk->tampildata_cari($cari)->paginate(10, 'barangmasuk') : $modelBarangMasuk->paginate(10, 'barangmasuk');

        $nohalaman = $this->request->getVar('page_barangmasuk') ? $this->request->getVar('page_barangmasuk') : 1;


        $data = [
            'tampildata' => $databarangmasuk,
            'pager' => $modelBarangMasuk->pager,
            'nohalaman' => $nohalaman,
            'totaldata' => $totaldata,
            'cari' => $cari

        ];
        return view('barangmasuk/viewdata', $data);
    }

    function detailItem()
    {
        if ($this->request->isAJAX()) {
            $faktur = $this->request->getPost('faktur');

            $modelDetail = new Modeldetail();

            $data = [
                'tampildatadetail' =>  $modelDetail->dataDetail($faktur)
            ];

            $json = [
                'data' => view('barangmasuk/modaldetailitem', $data)
            ];

            echo json_encode($json);
        }
    }

    function edit($faktur)
    {
        $modelBarangMasuk = new Modelbarangmasuk();
        $cekFaktur = $modelBarangMasuk->cekFaktur($faktur);

        if ($cekFaktur->getNumRows() > 0) {
            $row = $cekFaktur->getRowArray();

            $data = [
                'nofaktur' => $row['faktur1710026'],
                'tanggal' => $row['tglfaktur1710026']
            ];
            return view('barangmasuk/formedit', $data);
        } else {
            exit('Data tidak ditemukan');
        }
    }

    function dataDetail()
    {
        if ($this->request->isAJAX()) {
            $faktur = $this->request->getPost('faktur');

            $modelDetail = new Modeldetail();


            $data = [
                'datadetail' => $modelDetail->dataDetail($faktur),

            ];

            $totalHargaFaktur = number_format($modelDetail->ambilTotalHarga($faktur), 0, ",", ".");

            $json = [
                'data' => view('barangmasuk/datadetail', $data),
                'totalharga' => $totalHargaFaktur
            ];
            echo json_encode($json);
        }
    }

    function editItem()
    {
        if ($this->request->isAJAX()) {
            $iddetail = $this->request->getPost('iddetail');

            $modelDetail = new Modeldetail();
            $ambilData = $modelDetail->ambilDetailBerdasarkanID($iddetail);

            $row = $ambilData->getRowArray();

            $data = [
                'kodebarang' => $row['detbrgkode1710026'],
                'namabarang' => $row['brgnama1710026'],
                'hargajual' => $row['dethargajual1710026'],
                'hargabeli' => $row['dethargamasuk1710026'],
                'jumlah' => $row['detjml1710026'],
            ];

            $json = [
                'sukses' => $data
            ];

            echo json_encode($json);
        }
    }

    function simpanDetail()
    {
        if ($this->request->isAJAX()) {
            $faktur = $this->request->getPost('faktur');
            $hargajual = $this->request->getPost('hargajual');
            $hargabeli = $this->request->getPost('hargabeli');
            $kodebarang = $this->request->getPost('kodebarang');
            $jumlah = $this->request->getPost('jumlah');

            $modelDetail = new Modeldetail();
            $modelBarangMasuk = new Modelbarangmasuk();

            $modelDetail->insert([
                'detfaktur1710026' => $faktur,
                'detbrgkode1710026' => $kodebarang,
                'dethargamasuk1710026' => $hargabeli,
                'dethargajual1710026' => $hargajual,
                'detjml1710026' => $jumlah,
                'detsubtotal1710026' => intval($jumlah) * intval($hargabeli)
            ]);

            $ambilTotalHarga = $modelDetail->ambilTotalHarga($faktur);

            $modelBarangMasuk->update($faktur, [
                'totalharga1710026' => $ambilTotalHarga
            ]);

            $json = [
                'sukses' => 'Item berhasil ditambahkan'
            ];
            echo json_encode($json);
        } else {
            exit('Maaf tidak bisa dipanggil');
        }
    }

    function updateItem()
    {
        if ($this->request->isAJAX()) {
            $faktur = $this->request->getPost('faktur');
            $hargajual = $this->request->getPost('hargajual');
            $hargabeli = $this->request->getPost('hargabeli');
            $kodebarang = $this->request->getPost('kodebarang');
            $jumlah = $this->request->getPost('jumlah');
            $iddetail = $this->request->getPost('iddetail');

            $modelDetail = new Modeldetail();
            $modelBarangMasuk = new Modelbarangmasuk();

            $modelDetail->update($iddetail, [
                'dethargamasuk1710026' => $hargabeli,
                'dethargajual1710026' => $hargajual,
                'detjml1710026' => $jumlah,
                'detsubtotal1710026' => intval($jumlah) * intval($hargabeli)
            ]);

            $ambilTotalHarga = $modelDetail->ambilTotalHarga($faktur);

            $modelBarangMasuk->update($faktur, [
                'totalharga1710026' => $ambilTotalHarga
            ]);


            $json = [
                'sukses' => 'Item berhasil diupdate'
            ];
            echo json_encode($json);
        }
    }

    function hapusItemDetail()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $faktur = $this->request->getPost('faktur');

            $modelDetail = new Modeldetail();

            $modelBarangMasuk = new Modelbarangmasuk();
            $modelDetail->delete($id);

            $ambilTotalHarga = $modelDetail->ambilTotalHarga($faktur);

            $modelBarangMasuk->update($faktur, [
                'totalharga1710026' => $ambilTotalHarga
            ]);



            $json = [
                'sukses' => 'Item berhasil dihapus'
            ];

            echo json_encode($json);
        } else {
            exit('Maaf tidak bisa dipanggil');
        }
    }

    public function hapusTransaksi()
    {
        $faktur = $this->request->getPost('faktur');

        $db = \Config\Database::connect();

        $modelBarangMasuk = new Modelbarangmasuk();

        $db->table('detailmasuk1710026')->delete(['detfaktur1710026' => $faktur]);
        $modelBarangMasuk->delete($faktur);

        $json = [
            'sukses' => "Transaksi dengan Faktur : $faktur berhasil dihapus"
        ];

        echo json_encode($json);
    }
}