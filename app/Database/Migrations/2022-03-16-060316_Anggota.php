<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class anggota extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'noanggota' => [
                'type' => 'char',
                'constraint' => '50'
            ],
            'namaanggota' => [
                'type' => 'varchar',
                'constraint' => '150'
            ],
            'pekerjaan' => [
                'type' => 'varchar',
                'constraint' => '50'
            ],
            'alamat' => [
                'type' => 'varchar',
                'constraint' => '150'
            ],
            'telepon' => [
                'type' => 'int',
                'constraint' => '15'
            ],
            'tglmasuk' => [
                'type' => 'date'
            ]
        ]);
        $this->forge->addKey('noanggota');
        $this->forge->createTable('anggota');
    }

    public function down()
    {
        $this->forge->dropTable('anggota');
    }
}