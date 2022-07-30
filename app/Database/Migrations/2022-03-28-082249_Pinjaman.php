<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class pinjaman extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'nopinjam' => [
                'type' => 'char',
                'constraint' => '20'
            ],
            'tglpinjam' => [
                'type' => 'date'
            ],
            'pinnoanggota' => [
                'type' => 'char',
                'constraint' => '20'
            ],
            'jmlpinjam' => [
                'type' => 'double'
            ],
            'lamapinjam' => [
                'type' => 'int'
            ],
            'angsuran' => [
                'type' => 'double'
            ],
            'jasa' => [
                'type' => 'double'
            ],
            'askes' => [
                'type' => 'double'
            ],
            'respin' => [
                'type' => 'double'
            ],
            'sw' => [
                'type' => 'double'
            ],
            'sl' => [
                'type' => 'double'
            ],
            'hutang' => [
                'type' => 'double'
            ],
            'jumlahpotongan' => [
                'type' => 'double'
            ],
            'pinjamanbersih' => [
                'type' => 'double'
            ]
            ]);
            $this->forge->addPrimaryKey('nopinjam');
            $this->forge->addForeignKey('pinnoanggota', 'anggota', 'noanggota');
    
            $this->forge->createTable('pinjaman');
        }
            public function down()
    {
        $this->forge->dropTable('pinjaman');
    }
}