<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pakaian extends Migration
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
            'title' => [
                'type'              => 'VARCHAR',
                'constraint'        => 255
            ],
            'slug' => [
                'type'              => 'VARCHAR',
                'constraint'        => 255
            ],
            'deskripsi' => [
                'type'              => 'VARCHAR',
                'constraint'        => 255
            ],
            'ukuran' => [
                'type'              => 'VARCHAR',
                'constraint'        => 255
            ],
            'harga' => [
                'type'              => 'DECIMAL',
                'constraint'        => 10, 0
            ],
            'stok' => [
                'type'              => 'INT',
                'constraint'        => 11
            ],
            'gambar' => [
                'type'              => 'VARCHAR',
                'constraint'        => 255
            ],
            'kategori_id' => [
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
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('kategori_id', 'kategori', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pakaian');
    }

    public function down()
    {
        $this->forge->dropTable('pakaian');
    }
}
