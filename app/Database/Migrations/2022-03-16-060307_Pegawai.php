<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class pegawai extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'nik' => [
                'type' => 'char',
                'constraint' => '150'
            ],
            'namapegawai' => [
                'type' => 'varchar',
                'constraint' => '150'
            ],
            'jabatan' => [
                'type' => 'varchar',
                'constraint' => '50'
            ],
            'gajipokok' => [
                'type' => 'double'
            ],
            'status' => [
                'type' => 'varchar',
                'constraint' => '50'
            ]
        ]);
        $this->forge->addKey('nik');
        $this->forge->createTable('pegawai');
    }

    public function down()
    {
        $this->forge->dropTable('pegawai');
    }
}