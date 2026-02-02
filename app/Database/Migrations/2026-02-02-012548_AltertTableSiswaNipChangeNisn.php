<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AltertTableSiswaNipChangeNisn extends Migration
{
    public function up(): void
    {
        $fields = [
            'nip' => [
                'name'          => 'nisn',
                'type'          => 'varchar',
                'constraint'    => 15,
                'null'          => true
            ]
        ];
        $this->forge->modifyColumn('tbl_siswa', $fields);
        $this->forge->modifyColumn('tbl_siswa_fail', $fields);
    }

    public function down(): void
    {
        $fields = [
            'nisn' => [
                'name'          => 'nip',
                'type'          => 'varchar',
                'constraint'    => 15,
                'null'          => true
            ]
        ];
        $this->forge->modifyColumn('tbl_siswa', $fields);
        $this->forge->modifyColumn('tbl_siswa_fail', $fields);
    }
}
