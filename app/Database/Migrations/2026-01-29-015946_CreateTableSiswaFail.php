<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableSiswaFail extends Migration
{
    public function up(): void
    {
        $fields = [
            'idfail' => [
                'type' => 'int',
                'auto_increment' => true,
                'null' => false
            ],
            'nip' => [
                'type' => 'varchar',
                'constraint' => 20,
                'null' => false
            ],
            'nama_siswa' => [
                'type' => 'varchar',
                'constraint' => 150,
                'null' => false
            ],
            'npsn' => [
                'type' => 'varchar',
                'constraint' => 50,
                'null' => false
            ],
            'nomor_kk' => [
                'type' => 'varchar',
                'constraint' => 20,
                'null' => false
            ],
            'nomor_pkh' => [
                'type' => 'varchar',
                'constraint' => 20,
                'null' => true
            ],
            'nomor_pip' => [
                'type' => 'varchar',
                'constraint' => 20,
                'null' => true
            ],
            'tempat_lahir' => [
                'type' => 'varchar',
                'constraint' => 100,
                'null' => false
            ],
            'tanggal_lahir' => [
                'type' => 'date',
                'null' => false
            ],
            'alamat' => [
                'type' => 'text',
                'null' => false
            ],
            'jk' => [
                'type' => 'varchar',
                'constraint' => 1,
                'null' => false
            ],
            'status' => [
                'type' => 'varchar',
                'constraint' => 3,
                'null' => false
            ],
            'json_fail' => [
                'type' => 'json',
                'null' => false
            ]
        ];
        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('idfail');
        $this->forge->createTable('tbl_siswa_fail');
    }

    public function down(): void
    {
        $this->forge->dropTable('tbl_siswa_fail');
    }
}
