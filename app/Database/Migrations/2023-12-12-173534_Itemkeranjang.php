<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Itemkeranjang extends Migration
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
            'kuantitas' => [
                'type'              => 'INT',
                'constraint'        => 11
            ],
            'keranjang_id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true
            ],
            'pakaian_id' => [
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
        $this->forge->addForeignKey('keranjang_id', 'keranjang', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('pakaian_id', 'pakaian', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('itemkeranjang');
    }

    public function down()
    {
        $this->forge->dropTable('itemkeranjang');
    }
}
