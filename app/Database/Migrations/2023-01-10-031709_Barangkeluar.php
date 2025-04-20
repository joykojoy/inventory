<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Barangkeluar extends Migration
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
            'no_do' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'tgl_do' => [
                'type' => 'DATE'
            ],
            'customer' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'total' => [
                'type' => 'INT',
                'constraint' => 9,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('barangkeluar');
    }

    public function down()
    {
        $this->forge->dropTable('barangkeluar');
    }
}
