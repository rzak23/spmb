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

    public function form_ae(?int $id = null): string|\CodeIgniter\HTTP\RedirectResponse
    {
        helper('form');

        $data = [];
        if(is_null($id)){
            $data['mode']   = 'add';
            $data['action'] = 'kabupaten/save';
            $data['title']  = 'Tambah Kabupaten';
        }else{
            $kabupaten = $this->kabupatenModel->find($id);
            if(!isset($kabupaten)){
                return redirect()->back()
                    ->with('error', 'Data tidak ditemukan');
            }

            $data['mode']   = 'edit';
            $data['action'] = "kabupaten/save/{$id}";
            $data['title']  = 'Edit Kabupaten';
            $data['data']   = $kabupaten;
        }

        return view('pages/dashboard/kabupaten/kabupaten_ae', $data);
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
            $is_add = $this->kabupatenModel->insert([
                'kabupaten' => $kab
            ]);
            if(!$is_add){
                return redirect()->back()
                    ->with('validasi', $this->kabupatenModel->errors());
            }

            return redirect()->to('kabupaten')
                ->with('success', 'Kabupaten berhasil ditambahkan');
        }catch(\Exception $e){
            return redirect()->back()
                ->with('errror', $e->getMessage());
        }
    }

    private function update_data(int $id): \CodeIgniter\HTTP\RedirectResponse
    {
        $kabupaten = $this->kabupatenModel->find($id);
        if(!isset($kabupaten)){
            return redirect()->to('kabupaten')
                ->with('error', 'Data tidak ditemukan, proses update dibatalkan');
        }

        try{
            $kab = $this->request->getPost('kabupaten');
            $is_update = $this->kabupatenModel->update($kabupaten->idkabupaten, [
                'kabupaten' => $kab
            ]);
            if(!$is_update){
                return redirect()->back()
                    ->with('validasi', $this->kabupatenModel->errors());
            }

            return redirect()->to('kabupaten')
                ->with('success', 'Kabupaten berhasil diperbarui');
        }catch(\Exception $e){
            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }

    public function hapus_data(int $id): \CodeIgniter\HTTP\RedirectResponse
    {
        $kabupaten = $this->kabupatenModel->find($id);
        if(!isset($kabupaten)){
            return redirect()->back()
                ->with('error', 'Data tidak ditemukan, proses hapus dibatalkan');
        }

        $this->kabupatenModel->delete($kabupaten->idkabupaten);
        return redirect()->back()
            ->with('success', "Kabupaten {$kabupaten->kabupaten} berhasil dihapus");
    }
}
