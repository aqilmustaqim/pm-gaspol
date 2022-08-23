<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Position extends Migration
{
    public function up()
    {

        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'posisi'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100'
            ],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('position');
    }

    public function down()
    {
        $this->forge->dropTable('position');
    }
}
