<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MutasiStock extends Migration
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
            'tgl' => [
                'type' => 'DATE'
            ],
            'kode_brg' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'qtt_in' => [
                'type' => 'INT',
                'constraint' => 9,
                'null' => true,
            ],
            'qtt_out' => [
                'type' => 'INT',
                'constraint' => 9,
                'null' => true,
            ],
            'hpp' => [
                'type' => 'INT',
                'constraint' => 9,
                'null' => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('mutasi_stock');
    }

    public function down()
    {
        $this->forge->dropTable('mutasi_stock');
    }
}
