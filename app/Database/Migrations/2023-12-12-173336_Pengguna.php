<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pengguna extends Migration
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
            'namaDepan' => [
                'type'              => 'VARCHAR',
                'constraint'        => 255
            ],
            'namaBelakang' => [
                'type'              => 'VARCHAR',
                'constraint'        => 255
            ],
            'email' => [
                'type'              => 'VARCHAR',
                'constraint'        => 255
            ],
            'password' => [
                'type'              => 'VARCHAR',
                'constraint'        => 255
            ],
            'isAdmin' => [
                'type'              => 'INT',
                'constraint'        => 11
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
        $this->forge->createTable('pengguna');
    }

    public function down()
    {
        $this->forge->dropTable('pengguna');
    }
}
