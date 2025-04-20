<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tempbarangkeluar extends Migration
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
            'kode_brg' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'qtt' => [
                'type' => 'INT',
                'constraint' => 9,
            ],
            'hrg' => [
                'type' => 'INT',
                'constraint' => 9,
            ],
            'subtotal' => [
                'type' => 'INT',
                'constraint' => 11,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('temp_barangkeluar');
    }

    public function down()
    {
        $this->forge->dropTable('temp_barangkeluar');
    }
}
