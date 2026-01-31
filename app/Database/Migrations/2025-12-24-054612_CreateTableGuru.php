<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableGuru extends Migration
{
    public function up()
    {
        $fields = [
            'idguru' => [
                'type' => 'int',
                'auto_increment' => true,
                'null' => false
            ],
            'nip' => [
                'type' => 'varchar',
                'constraint' => 20,
                'null' => true,
            ],
            'nama_guru' => [
                'type' => 'varchar',
                'constraint' => 150,
                'null' => false
            ],
            'alamat' => [
                'type' => 'text',
                'null' => false
            ],
            'telepon' => [
                'type' => 'varchar',
                'constraint' => 15,
                'null' => false
            ],
            'username' => [
                'type' => 'varchar',
                'constraint' => 15,
                'null' => false
            ],
            'password' => [
                'type' => 'varchar',
                'constraint' => 256,
                'null' => false
            ]
        ];
        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('idguru');
        $this->forge->createTable('tbl_guru');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_guru');
    }
}
