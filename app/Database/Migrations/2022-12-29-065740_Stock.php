<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Stock extends Migration
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
            'kode_brg' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'qtt' => [
                'type' => 'INT',
                'constraint' => 9,
            ],
            'hpp' => [
                'type' => 'INT',
                'constraint' => 9,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('stock');
    }

    public function down()
    {
        $this->forge->dropTable('stock');
    }
}
