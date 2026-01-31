<?php

namespace App\Models\Sekolah;

use CodeIgniter\Model;

class SekolahModel extends Model
{
    protected $table            = 'tbl_sekolah';
    protected $primaryKey       = 'npsn';
    protected $useAutoIncrement = false;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'idkabupaten', 'idkecamatan', 'sekolah', 'alamat', 'status'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'sekolah'   => 'required|alpha_numeric_space',
        'alamat'    => 'required',
        'npsn'      => 'required|numeric'
    ];
    protected $validationMessages   = [
        'sekolah' => [
            'required'              => 'Wajib diisi',
            'alpha_numeric_space'   => "Hanya bisa diisi dengan huruf, angka dan spasi"
        ],
        'alamat' => [
            'required'  => 'Wajib diisi'
        ],
        'npsn' => [
            'required'  => 'Wajib diisi',
            'npsn'      => 'Hanya bisa diisi dengan angka'
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
