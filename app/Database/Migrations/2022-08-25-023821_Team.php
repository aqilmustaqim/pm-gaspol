<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Team extends Migration
{
    public function up()
    {

        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => TRUE
            ],
            'team'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '50'
            ],
            'deskripsi_team'       => [
                'type'           => 'TEXT',
                'constraint'     => '500'
            ]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('team');
    }

    public function down()
    {
        $this->forge->dropTable('team');
    }
}
