<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTableGuruAddIdsekolah extends Migration
{
    public function up(): void
    {
        $fields = [
            'idsekolah' => [
                'type'          => 'varchar',
                'constraint'    => 50,
                'null'          => false,
                'after'         => 'idguru'
            ]
        ];
        $this->forge->addColumn('tbl_guru', $fields);
    }

    public function down(): void
    {
        $this->forge->dropColumn('tbl_guru', 'idsekolah');
    }
}
