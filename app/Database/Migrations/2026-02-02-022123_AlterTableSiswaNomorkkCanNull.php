<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTableSiswaNomorkkCanNull extends Migration
{
    public function up(): void
    {
        $fields = [
            'nomor_kk' => [
                'type' => 'varchar',
                'constraint' => 20,
                'null' => true
            ]
        ];
        $this->forge->modifyColumn('tbl_siswa', $fields);
        $this->forge->modifyColumn('tbl_siswa_fail', $fields);
    }

    public function down(): void
    {
        $fields = [
            'nomor_kk' => [
                'type' => 'varchar',
                'constraint' => 20,
                'null' => false
            ]
        ];
        $this->forge->modifyColumn('tbl_siswa', $fields);
        $this->forge->modifyColumn('tbl_siswa_fail', $fields);
    }
}
