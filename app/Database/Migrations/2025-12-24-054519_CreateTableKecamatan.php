<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableKecamatan extends Migration
{
    public function up()
    {
        $fields = [
            'idkecamatan' => [
                'type' => 'int',
                'auto_increment' => true,
                'null' => false
            ],
            'idkabupaten' => [
                'type' => 'int',
                'null' => false
            ],
            'kecamatan' => [
                'type' => 'varchar',
                'constraint' => 100,
                'null' => false
            ]
        ];
        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('idkecamatan');
        $this->forge->addForeignKey('idkabupaten', 'kabupaten', 'idkabupaten', 'no action', 'cascade', 'fk_kecamatan_kab');
        $this->forge->createTable('tbl_kecamatan');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_kecamatan');
    }
}
