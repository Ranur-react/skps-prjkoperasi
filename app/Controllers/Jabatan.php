<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modeljabatan;
use Config\Services;
use App\Models\Modeldatajabatan;

class Jabatan extends BaseController
{
    public function formtambah()
    {
        $json = ['data' => view('jabatan/modaltambah')];
        echo json_encode($json);
    }

    public function simpan()
    {
        $namajabatan = $this->request->getPost('namajabatan');
        $gajijabatan = $this->request->getPost('gajijabatan');

        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'namajabatan' => [
                'rules' => 'required',
                'label' => 'Nama Jabatan',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
                ], 

                'gajijabatan' => [
                    'rules' => 'required|is_unique[jabatan.gajijabatan]',
                    'label' => 'Gaji Pokok Jabatan',
                    'errors' => [
                        'required' => '{field} Tidak boleh kosong',
                        'is_unique' => '{field} Tidak boleh sama'
                    ]
                    ]
        ]);

        if(!$valid){
            $json = [
                'error' => [
                    'errNamaJabatan'=> $validation->getError('namajabatan'),
                    'errGajiJabatan'=> $validation->getError('gajijabatan'),
                ]
                ];
        } else{
            $modelJabatan = new Modeljabatan();

            $modelJabatan->insert([
                'namajabatan' => $namajabatan,
                'gajijabatan' => $gajijabatan
            ]);

            $rowData = $modelJabatan->ambilDataTerakhir()->getRowArray();

            $json = [
                'sukses' => 'Data Jabatan Berhasil Disimpan, ambil data terakhir? ',
                'namajabatan' => $rowData['namajabatan'],
                'gajijabatan' => $rowData['gajijabatan']
            ];
        }

        echo json_encode($json);
    }

    public function modalData(){
        if ($this->request->isAJAX()){
            $json = [
                'data' => view('jabatan/modaldata')
            ];
            echo json_encode($json);
        }
    }

    public function listData(){
        $request = Services::request();
        $datamodel = new ModelDataJabatan($request);
        if ($request->getMethod(true) == 'POST') {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];

                $tombolPilih = "<button type=\"button\" class=\"btn btn-sm btn-info\" onclick=\"pilih('".$list->idjabatan."','".$list->namajabatan."')\">Pilih</button>";
                $tombolHapus = "<button type=\"button\" class=\"btn btn-sm btn-danger\" onclick=\"hapus('".$list->idjabatan."','".$list->namajabatan."')\">Hapus</button>";

                $row[] = $no;
                $row[] = $list->namajabatan;
                $row[] = $list->gajijabatan;
                $row[] = $tombolPilih."".$tombolHapus;
                $data[] = $row;
            }
            $output = [
                "draw" => $request->getPost('draw'),
                "recordsTotal" => $datamodel->count_all(),
                "recordsFiltered" => $datamodel->count_filtered(),
                "data" => $data
            ];
            echo json_encode($output);
        }
    }

   function hapus(){
        if ($this->request->isAJAX()){
            $id = $this->request->getPost('id');

            $modelJabatan = new Modeljabatan();

            $modelJabatan->delete($id);

            $json =[
                'sukses' => "Data Jabatan berhasil dihapus"
            ];

            echo json_encode($json);
        }
    }
}