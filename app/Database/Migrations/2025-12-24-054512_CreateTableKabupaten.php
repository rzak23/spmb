<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableKabupaten extends Migration
{
    public function up()
    {
        $fields = [
            'idkabupaten' => [
                'type' => 'int',
                'auto_increment' => true,
                'null' => false
            ],
            'kabupaten' => [
                'type' => 'varchar',
                'constraint' => 100,
                'null' => false
            ]
        ];
        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('idkabupaten');
        $this->forge->createTable('tbl_kabupaten');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_kabupaten');
    }
}
