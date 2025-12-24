<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableAdmin extends Migration
{
    public function up()
    {
        $fields = [
            'idadmin' => [
                'type' => 'int',
                'auto_increment' => true,
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
        $this->forge->addPrimaryKey('idadmin');
        $this->forge->createTable('tbl_admin');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_admin');
    }
}
