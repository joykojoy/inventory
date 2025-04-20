<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Menu extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_level_id' => [
                'type' => 'INT',
                'constraint' => 5,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'url' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'icon' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'urutan' => [
                'type' => 'INT',
                'constraint' => 5,
            ],
            'aktif' => [
                'type' => 'INT',
                'constraint' => 1,
            ],
            'submenu' => [
                'type' => 'INT',
                'constraint' => 1,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('menu');
    }

    public function down()
    {
        $this->forge->dropTable('menu');
    }
}
