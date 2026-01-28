<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTableSiswaAddIsVerify extends Migration
{
    public function up(): void
    {
        $fields = [
            'is_verify' => [
                'type'      => 'int',
                'null'      => false,
                'default'   => 0,
                'after'     => 'status'
            ]
        ];
        $this->forge->addColumn('tbl_siswa', $fields);
    }

    public function down(): void
    {
        $this->forge->dropColumn('tbl_siswa', 'is_verify');
    }
}
