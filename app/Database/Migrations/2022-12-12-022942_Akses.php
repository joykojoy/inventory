<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Akses extends Migration
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
            'level_id' => [
                'type' => 'INT',
                'constraint' => 5,
            ],
            'akses_menu_id' => [
                'type' => 'INT',
                'constraint' => 5,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('akses');
    }

    public function down()
    {
        $this->forge->dropTable('akses');
    }
}
