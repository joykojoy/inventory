<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetilBrgmasuk extends Migration
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
            'no_faktur' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'tgl_faktur' => [
                'type' => 'DATE'
            ],
            'supplier' => [
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
            'hpp' => [
                'type' => 'INT',
                'constraint' => 9,
            ],
            'subtotal' => [
                'type' => 'INT',
                'constraint' => 11,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('detil_brgmasuk');
    }

    public function down()
    {
        $this->forge->dropTable('detil_brgmasuk');
    }
}
