<?php

namespace App\Models\Guru;

use CodeIgniter\Model;

class GuruModel extends Model
{
    protected $table            = 'tbl_guru';
    protected $primaryKey       = 'idguru';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'idsekolah', 'nip', 'nama_guru', 'alamat', 'telepon',
        'username', 'password'
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
        'idsekolah' => 'required',
        'nip'       => 'permit_empty|numeric',
        'nama_guru' => 'required|alpha_numeric_punct',
        'telepon'   => 'required|numeric',
        'username'  => 'required|min_length[4]|max_length[15]',
        'password'  => 'required|min_length[8]|max_length[20]',
        'alamat'    => 'required'
    ];
    protected $validationMessages   = [
        'idsekolah' => [
            'required'  => 'Wajib diisi'
        ],
        'nip'       => [
            'numeric'   => 'Hanya bisa diisi dengan angka'
        ],
        'nama_guru' => [
            'required'              => 'Wajib diisi',
            'alpha_numeric_punct'   => 'Hanya bisa diisi dengan huruf, karakter spasi, titik'
        ],
        'telepon'   => [
            'required'  => 'Wajib diisi',
            'numeric'   => 'Hanya bisa diisi dengan angka'
        ],
        'username'  => [
            'required'      => 'Wajib diisi',
            'min_length'    => 'Minimal 4 karakter',
            'max_length'    => 'Maksimal 15 karakter'
        ],
        'password'  => [
            'required'      => 'Wajib diisi',
            'min_length'    => 'Minimal 8 karakter',
            'max_length'    => 'Maksimal 20 karakter'
        ],
        'alamat'    => [
            'required'  => 'Wajib diisi'
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['hash_password'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ['hash_password'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected  function hash_password(array $data): array
    {
        if(isset($data['data']['password'])){
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }

        return $data;
    }
}
