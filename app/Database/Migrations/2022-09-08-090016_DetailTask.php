<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailTask extends Migration
{
    public function up()
    {

        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => TRUE
            ],
            'id_task'       => [
                'type'           => 'INT',
                'constraint'     => '11'
            ],
            'id_users'       => [
                'type'           => 'INT',
                'constraint'     => '11'
            ]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('detail_task');
    }

    public function down()
    {
        $this->forge->dropTable('detail_task');
    }
}
