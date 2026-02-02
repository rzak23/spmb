<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTableSiswaAddMoreField extends Migration
{
    public function up(): void
    {
        $fields = [
            'nik' => [
                'type' => 'varchar',
                'constraint' => 20,
                'null' => true,
                'after' => 'npsn'
            ],
            'ibu_kandung' => [
                'type' => 'varchar',
                'constraint' => 150,
                'null' => true,
                'after' => 'nama_siswa'
            ],
            'desa' => [
                'type' => 'varchar',
                'constraint' => 50,
                'null' => true,
                'after' => 'alamat'
            ],
            'kabupaten' => [
                'type' => 'varchar',
                'constraint' => 50,
                'null' => true,
                'after' => 'desa'
            ],
            'kecamatan' => [
                'type' => 'varchar',
                'constraint' => 50,
                'null' => true,
                'after' => 'kabupaten'
            ]
        ];
        $this->forge->addColumn('tbl_siswa', $fields);
        $this->forge->addColumn('tbl_siswa_fail', $fields);
    }

    public function down(): void
    {
        $this->forge->dropColumn('tbl_siswa', 'nik');
        $this->forge->dropColumn('tbl_siswa', 'ibu_kandung');
        $this->forge->dropColumn('tbl_siswa', 'desa');
        $this->forge->dropColumn('tbl_siswa', 'kabupaten');
        $this->forge->dropColumn('tbl_siswa', 'kecamatan');

        $this->forge->dropColumn('tbl_siswa_fail', 'nik');
        $this->forge->dropColumn('tbl_siswa_fail', 'ibu_kandung');
        $this->forge->dropColumn('tbl_siswa_fail', 'desa');
        $this->forge->dropColumn('tbl_siswa_fail', 'kabupaten');
        $this->forge->dropColumn('tbl_siswa_fail', 'kecamatan');
    }
}
