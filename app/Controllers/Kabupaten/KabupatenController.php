<?php

namespace App\Controllers\Kabupaten;

use App\Controllers\BaseController;
use App\Models\Kabupaten\KabupatenModel;
use CodeIgniter\HTTP\ResponseInterface;

class KabupatenController extends BaseController
{
    private KabupatenModel $kabupatenModel;

    public function __construct(){
        $this->kabupatenModel = new KabupatenModel();
    }

    public function index(): string
    {
        $data = [
            'data' => $this->kabupatenModel->findAll()
        ];
        return view('pages/dashboard/kabupaten/kabupaten_list', $data);
    }

    public function form_ae(?String $id = null){
        helper('form');

        return view('pages/dashboard/kabupaten/kabupaten_ae');
    }
}
