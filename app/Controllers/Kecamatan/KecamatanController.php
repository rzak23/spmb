<?php

namespace App\Controllers\Kecamatan;

use App\Controllers\BaseController;
use App\Models\Kabupaten\KabupatenModel;
use App\Models\Kecamatan\KecamatanModel;
use CodeIgniter\HTTP\ResponseInterface;

class KecamatanController extends BaseController
{
    private KecamatanModel $kecamatanModel;

    public function __construct(){
        $this->kecamatanModel = new KecamatanModel();
    }

    public function index(): string
    {
        $kecamatan = $this->kecamatanModel->join('tbl_kabupaten', 'tbl_kecamatan.idkabupaten = tbl_kabupaten.idkabupaten', 'left')
            ->findAll();

        $data = [
            'data' => $kecamatan
        ];
        return view('pages/dashboard/kecamatan/kecamatan_list', $data);
    }

    public function form_ae(?int $id = null): string|\CodeIgniter\HTTP\RedirectResponse
    {
        helper('form');
        $kabupatenModel = new KabupatenModel();

        $data = [];
        if(is_null($id)){
            $data['action'] = 'kecamatan/save';
            $data['mode']   = 'add';
            $data['title']  = 'Tambah Kecamatan';
        }else{
            $kecamatan = $this->kecamatanModel->find($id);
            if(!isset($kecamatan)){
                return redirect()->back()
                    ->with('error', 'Data tidak ditemukan');
            }

            $data['action'] = 'kecamatan/save/'.$id;
            $data['mode']   = 'edit';
            $data['title']  = 'Edit Kecamatan';
            $data['data']   = $kecamatan;
        }

        $kabupaten = $kabupatenModel->findAll();
        $data['kabupaten'] = $kabupaten;
        return view('pages/dashboard/kecamatan/kecamatan_ae', $data);
    }

    public function save(?int $id = null): \CodeIgniter\HTTP\RedirectResponse
    {
        if(is_null($id)){
            return $this->add_data();
        }

        return $this->update_data($id);
    }

    private function add_data(): \CodeIgniter\HTTP\RedirectResponse
    {
        try{
            $kab = $this->request->getPost('kabupaten');
            $kec = $this->request->getPost('kecamatan');

            $is_save = $this->kecamatanModel->insert([
                'idkabupaten'   => $kab,
                'kecamatan'     => $kec
            ]);
            if(!$is_save){
                return redirect()->back()
                    ->with('validasi', $this->kecamatanModel->errors());
            }

            return redirect()->to('kecamatan')
                ->with('success', 'Kecamatan berhasil ditambahkan');
        }catch(\Exception $e){
            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }

    private function update_data(int $id): \CodeIgniter\HTTP\RedirectResponse
    {
        $kecamatan = $this->kecamatanModel->find($id);
        if(!isset($kecamatan)){
            return redirect()->to('kecamatan')
                ->with('error', 'Data tidak ditemukan, proses update dibatalkan');
        }

        try{
            $kab = $this->request->getPost('kabupaten');
            $kec = $this->request->getPost('kecamatan');

            $is_update = $this->kecamatanModel->update($kecamatan->idkecamatan, [
                'idkabupaten'   => $kab,
                'kecamatan'     => $kec
            ]);
            if(!$is_update){
                return redirect()->back()
                    ->with('validasi', $this->kecamatanModel->errors());
            }

            return redirect()->to('kecamatan')
                ->with('success', 'Kecamatan berhasil diperbarui');
        }catch(\Exception $e){
            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }

    public function hapus_data(int $id): \CodeIgniter\HTTP\RedirectResponse
    {
        $kecamatan = $this->kecamatanModel->find($id);
        if(!isset($kecamatan)){
            return redirect()->back()
                ->with('error', 'Data tidak ditemukan, proses hapus dibatalkan');
        }

        $this->kecamatanModel->delete($kecamatan->idkecamatan);
        return redirect()->back()
            ->with('success', "Kecamatan {$kecamatan->kecamatan} berhasil dihapus");
    }
}
