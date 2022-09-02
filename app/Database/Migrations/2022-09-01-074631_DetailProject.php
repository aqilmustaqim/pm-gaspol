<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailProject extends Migration
{
    public function up()
    {

        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => TRUE
            ],
            'id_project'       => [
                'type'           => 'INT',
                'constraint'     => '11'
            ],
            'id_team'       => [
                'type'           => 'INT',
                'constraint'     => '11'
            ],
            'id_users'       => [
                'type'           => 'INT',
                'constraint'     => '11'
            ]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('detail_project');
    }

    public function down()
    {
        $this->forge->dropTable('detail_project');
    }
}
