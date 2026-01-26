<?php

namespace App\Controllers\Sekolah;

use App\Controllers\BaseController;
use App\Models\Kabupaten\KabupatenModel;
use App\Models\Sekolah\SekolahModel;
use CodeIgniter\HTTP\ResponseInterface;

class SekolahController extends BaseController
{
    private SekolahModel $sekolahModel;

    public function __construct(){
        $this->sekolahModel = new SekolahModel();
    }

    public function index(): string
    {
        $sekolah = $this->sekolahModel
            ->join('tbl_kabupaten', 'tbl_sekolah.idkabupaten = tbl_kabupaten.idkabupaten', 'left')
            ->join('tbl_kecamatan', 'tbl_sekolah.idkecamatan = tbl_kecamatan.idkecamatan', 'left')
            ->findAll();

        $data = [
            'data' => $sekolah
        ];
        return view('pages/dashboard/sekolah/sekolah_list', $data);
    }

    public function form_ae(?string $id = null): string|\CodeIgniter\HTTP\RedirectResponse
    {
        helper('form');
        $kabupatenModel = new KabupatenModel();

        $data = [];
        if(is_null($id)){
            $data['title']  = 'Tambah Sekolah';
            $data['action'] = 'sekolah/save';
            $data['mode']   = 'add';
        }else{
            $sekolah = $this->sekolahModel->find($id);
            if(!isset($sekolah)){
                return redirect()->back()
                    ->with('error', 'Data tidak ditemukan');
            }

            $data['title']  = 'Edit Sekolah';
            $data['action'] = 'sekolah/save/'.$id;
            $data['mode']   = 'edit';
            $data['data']   = $sekolah;
        }

        $data['kabupaten'] = $kabupatenModel->findAll();
        return view('pages/dashboard/sekolah/sekolah_ae', $data);
    }

    public function save(?string $id = null){
        if(is_null($id)){
            return $this->add_data();
        }
    }

    private function add_data(){
        try{
            $kab        = $this->request->getPost('kabupaten');
            $kec        = $this->request->getPost('kecamatan');
            $npsn       = $this->request->getPost('npsn');
            $sekolah    = $this->request->getPost('sekolah');
            $alamat     = $this->request->getPost('alamat');

            $is_save = $this->sekolahModel->insert();
        }catch(\Exception $e){
            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }
}
