<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Task extends Migration
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
            'nama_task'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '225'
            ],
            'deskripsi_task'       => [
                'type'           => 'TEXT',
                'constraint'     => '225'
            ],
            'tanggal_task'       => [
                'type'           => 'DATE'
            ],
            'batas_task'       => [
                'type'           => 'DATE'
            ],
            'status_task'       => [
                'type'           => 'INT',
                'constraint'     => '11'
            ]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('task');
    }

    public function down()
    {
        $this->forge->dropTable('task');
    }
}
