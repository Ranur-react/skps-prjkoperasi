<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class angsuran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'noangsuran' => [
                'type' => 'char',
                'constraint' => '20'
            ],
            'tglangsuran' => [
                'type' => 'date'
            ],
            'angnopinjam' => [
                'type' => 'char',
                'constraint' => '20'
            ],
            'angnoanggota' => [
                'type' => 'char',
                'constraint' => '20'
            ],
            'jmlangsuran' => [
                'type' => 'double'
            ],
            'angnamaanggota' => [
                'type' => 'varchar',
                'constraint' => '150'
            ],
            'angsuranke' => [
                'type' => 'int'
            ],
            'sisapinjaman' => [
                'type' => 'double'
            ],
        ]);
        $this->forge->addPrimaryKey('noangsuran');
        $this->forge->addForeignKey('angnopinjam', 'pinjaman', 'nopinjam');
        $this->forge->addForeignKey('angnoanggota', 'anggota', 'noanggota');

        $this->forge->createTable('angsuran');
    }
    public function down()
    {
        $this->forge->dropTable('angsuran');
    }
}