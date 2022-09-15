<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ListTask extends Migration
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
            'list'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '225'
            ],
            'status_list'       => [
                'type'           => 'INT',
                'constraint'     => '11'
            ]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('list_task');
    }

    public function down()
    {
        $this->forge->dropTable('list_task');
    }
}
