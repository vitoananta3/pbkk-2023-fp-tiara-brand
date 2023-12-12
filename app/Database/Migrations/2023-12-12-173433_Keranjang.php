<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Keranjang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true
            ],
            'isActive' => [
                'type'              => 'INT',
                'constraint'        => 11
            ],
            'isDone' => [
                'type'              => 'INT',
                'constraint'        => 11
            ],
            'totalHarga' => [
                'type'              => 'DECIMAL',
                'constraint'        => 10, 0
            ],
            'pengguna_id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true
            ],
            'created_at' => [
                'type'              => 'DATETIME',
                'null'              => true
            ],
            'updated_at' => [
                'type'              => 'DATETIME',
                'null'              => true
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('pengguna_id', 'pengguna', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('keranjang');
    }

    public function down()
    {
        $this->forge->dropTable('keranjang');
    }
}
