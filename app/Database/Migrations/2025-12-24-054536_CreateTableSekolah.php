<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableSekolah extends Migration
{
    public function up()
    {
        $fields = [
            'npsn' => [
                'type' => 'varchar',
                'constraint' => 50,
                'null' => false
            ],
            'idkabupaten' => [
                'type' => 'int',
                'null' => false
            ],
            'idkecamatan' => [
                'type' => 'int',
                'null' => false
            ],
            'sekolah' => [
                'type' => 'varchar',
                'constraint' => '150',
                'null' => false
            ],
            'alamat' => [
                'type' => 'text',
                'null' => false
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('npsn');
        $this->forge->addForeignKey('idkabupaten', 'tbl_kabupaten', 'idkabupaten', 'no action', 'cascade', 'fk_sekolah_kab');
        $this->forge->addForeignKey('idkecamatan', 'tbl_kecamatan', 'idkecamatan', 'no action', 'cascade', 'fk_sekolah_kec');
        $this->forge->createTable('tbl_sekolah');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_sekolah');
    }
}
