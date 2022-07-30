<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class simpanan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'nosimpanan' => [
                'type' => 'char',
                'constraint' => '20'
            ],
            'simnoanggota' => [
                'type' => 'char',
                'constraint' => '50'
            ],
            'jenis' => [
                'type' => 'varchar',
                'constraint' => '50'
            ],
            'jml' => [
                'type' => 'double'
            ],
            'ket' => [
                'type' => 'varchar',
                'constraint' => '150'
            ],
            'tglsimpan' => [
                'type' => 'date'
            ]
        ]);
        $this->forge->addPrimaryKey('nosimpanan');
        $this->forge->addForeignKey('simnoanggota', 'anggota', 'noanggota');

        $this->forge->createTable('simpanan');
    }

    public function down()
    {
        $this->forge->dropTable('simpanan');
    }
}