<?php

namespace App\Controllers;

use App\Models\Siswa\SiswaModel;

class Home extends BaseController
{
    public function index(): string
    {
        helper('form');
        return view('pages/auth/login');
    }

    public function halaman_dashboard(): string
    {
        $siswa_model = new SiswaModel();

        $data = [
            'total_nonverif'    => $siswa_model->where('is_verify', 0)->countAllResults(),
            'total_verif'       => $siswa_model->where('is_verify', 1)->countAllResults(),
            'total_male'        => $siswa_model->where('jk', 'l')->countAllResults(),
            'total_female'      => $siswa_model->where('jk', 'p')->countAllResults()
        ];
        return view('pages/dashboard/index', $data);
    }
}
