<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableSiswa extends Migration
{
    public function up()
    {
        $fields = [
            'idsiswa' => [
                'type' => 'int',
                'auto_increment' => true,
                'null' => false
            ],
            'nip' => [
                'type' => 'varchar',
                'constraint' => 15,
                'null' => true
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
            'nama_siswa' => [
                'type' => 'varchar',
                'constraint' => 150,
                'null' => false
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
            'siswa_created' => [
                'type' => 'timestamp',
                'null' => false
            ],
            'siswa_updated' => [
                'type' => 'timestamp',
                'null' => false
            ]
        ];
        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('idsiswa');
        $this->forge->addForeignKey('npsn', 'tbl_sekolah', 'npsn', 'no action', 'no action', 'fk_siswa_asal');
        $this->forge->createTable('tbl_siswa');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_siswa');
    }
}
