<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Project extends Migration
{
    public function up()
    {

        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => TRUE
            ],
            'id_team'       => [
                'type'           => 'INT',
                'constraint'     => '11'
            ],
            'nama_project'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '225'
            ],
            'deskripsi_project'       => [
                'type'           => 'TEXT',
                'constraint'     => '225'
            ],
            'tanggal_mulai'       => [
                'type'           => 'DATE'
            ],
            'batas_waktu'       => [
                'type'           => 'DATE'
            ],
            'status_project'       => [
                'type'           => 'INT',
                'constraint'     => '11'
            ]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('project');
    }

    public function down()
    {
        $this->forge->dropTable('project');
    }
}
