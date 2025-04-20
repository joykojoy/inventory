<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Submenu extends Migration
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
            'id_menu_induk' => [
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
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('submenu');
    }

    public function down()
    {
        $this->forge->dropTable('submenu');
    }
}
