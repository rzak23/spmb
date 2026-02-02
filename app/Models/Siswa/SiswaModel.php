<?php

namespace App\Models\Siswa;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table            = 'tbl_siswa';
    protected $primaryKey       = 'idsiswa';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nisn', 'npsn', 'nik', 'nomor_kk', 'nomor_pkh', 'nomor_pip', 'nama_siswa', 'ibu_kandung', 'tempat_lahir',
        'tanggal_lahir', 'alamat', 'desa', 'kabupaten', 'kecamatan', 'jk', 'status', 'is_verify',
        'siswa_created', 'siswa_updated'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'siswa_created';
    protected $updatedField  = 'siswa_updated';
    protected $deletedField  = '';

    // Validation
    protected $validationRules      = [
        'nik'           => 'permit_empty|numeric|min_length[16]',
        'nomor_kk'      => 'permit_empty|numeric|min_length[16]',
        'nisn'          => 'permit_empty|numeric|min_length[10]',
        'nomor_pkh'     => 'permit_empty|numeric',
        'nomor_pip'     => 'permit_empty|numeric',
        'nama_siswa'    => 'required',
    ];
    protected $validationMessages   = [
        'nik' => [
            'numeric' => 'Hanya bisa diisi dengan angka',
            'min_length' => 'Minimal ada 16 digit angka'
        ],
        'nomor_kk' => [
            'numeric' => 'Hanya bisa diisi dengan angka',
            'min_length' => 'Minimal ada 16 digit angka'
        ],
        'nisn' => [
            'required' => 'Wajib diisi',
            'numeric' => 'Hanya bisa diisi dengan angka',
            'min_length' => 'Minimal ada 10 digit angka'
        ],
        'nomor_pkh' => [
            'numeric' => 'Hanya bisa diisi dengan angka'
        ],
        'nomor_pip' => [
            'numeric' => 'Hanya bisa diisi dengan angka'
        ],
        'nama_siswa' => [
            'required' => 'Wajib diisi'
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
