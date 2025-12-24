<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTablePenugasan extends Migration
{
    public function up()
    {
        $fields = [
            'idpenugasan' => [
                'type' => 'int',
                'auto_increment' => true,
                'null' => false
            ],
            'idguru' => [
                'type' => 'int',
                'null' => false
            ],
            'npsn' => [
                'type' => 'varchar',
                'constraint' => 50,
                'null' => false
            ]
        ];
        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('idpenugasan');
        $this->forge->addForeignKey('idguru', 'tbl_guru', 'idguru', 'no action', 'cascade', 'fk_tugas_guru');
        $this->forge->addForeignKey('npsn', 'tbl_sekolah', 'npsn', 'no action', 'cascade', 'fk_sekolah_guru');
        $this->forge->createTable('tbl_penugasan');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_penugasan');
    }
}
