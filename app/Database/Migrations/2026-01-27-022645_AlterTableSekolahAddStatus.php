<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTableSekolahAddStatus extends Migration
{
    public function up(): void
    {
        $fields = [
            'status' => [
                'type' => 'int',
                'null' => false
            ]
        ];
        $this->forge->addColumn('tbl_sekolah', $fields);
    }

    public function down(): void
    {
        $this->forge->dropColumn('tbl_sekolah', 'status');
    }
}
