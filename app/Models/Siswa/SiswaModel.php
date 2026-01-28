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
        'nip', 'npsn', 'nomor_kk', 'nomor_pkh', 'nomor_pip', 'nama_siswa', 'tempat_lahir',
        'tanggal_lahir', 'alamat', 'jk', 'status', 'is_verify', 'siswa_created', 'siswa_updated'
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
        'nomor_kk' => 'required|numeric|min_length[16]'
    ];
    protected $validationMessages   = [];
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
