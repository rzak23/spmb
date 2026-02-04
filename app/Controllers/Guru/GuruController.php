<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use App\Models\Guru\GuruModel;
use App\Models\Sekolah\SekolahModel;
use CodeIgniter\HTTP\ResponseInterface;

class GuruController extends BaseController
{
    private GuruModel $guruModel;

    public function __construct(){
        $this->guruModel = new GuruModel();
    }

    public function index(): string
    {
        $guru = $this->guruModel->paginate(10, 'guru');

        $data = [
            'data' => $guru,
            'page' => $this->guruModel->pager
        ];
        return view('pages/dashboard/guru/guru_list', $data);
    }

    public function form_ae(?int $id = null): string|\CodeIgniter\HTTP\RedirectResponse
    {
        helper('form');
        $sekolahModel = new SekolahModel();

        $data = [];
        if(is_null($id)){
            $data['title']  = 'Tambah Guru / Petugas';
            $data['mode']   = 'add';
            $data['action'] = 'guru/save';
        }else{
            $guru = $this->guruModel->find($id);
            if(!isset($guru)){
                return redirect()->back()
                    ->with('error', 'Data tidak ditemukan');
            }

            $data['title']  = 'Edit Guru / Petugas';
            $data['mode']   = 'edit';
            $data['action'] = 'guru/save/'.$id;
            $data['data']   = $guru;
        }

        $sekolah = $sekolahModel->findAll();
        $data['sekolah'] = $sekolah;
        return view('pages/dashboard/guru/guru_ae', $data);
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
            $sekolah    = $this->request->getPost('sekolah');
            $nip        = $this->request->getPost('nip');
            $nama       = $this->request->getPost('nama');
            $telepon    = $this->request->getPost('telepon');
            $username   = $this->request->getPost('username');
            $password   = $this->request->getPost('pass');
            $alamat     = $this->request->getPost('alamat');

            $is_save = $this->guruModel->insert([
                'idsekolah' => $sekolah,
                'nip'       => $nip,
                'nama_guru' => $nama,
                'alamat'    => $alamat,
                'telepon'   => $telepon,
                'username'  => $username,
                'password'  => $password
            ]);
            if(!$is_save){
                return redirect()->back()
                    ->with('validasi', $this->guruModel->errors());
            }

            return redirect()->to('guru')
                ->with('success', 'Guru berhasil ditambahkan');
        }catch(\Exception $e){
            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }

    private function update_data(int $id): \CodeIgniter\HTTP\RedirectResponse
    {
        $guru = $this->guruModel->find($id);
        if(!isset($guru)){
            return redirect()->to('guru')
                ->with('error', 'Data tidak ditemukan, proses update dibatalkan');
        }

        try{
            $sekolah    = $this->request->getPost('sekolah');
            $nip        = $this->request->getPost('nip');
            $nama       = $this->request->getPost('nama');
            $telepon    = $this->request->getPost('telepon');
            $username   = $this->request->getPost('username');
            $password   = $this->request->getPost('pass');
            $alamat     = $this->request->getPost('alamat');

            $data = [
                'idsekolah' => $sekolah,
                'nip'       => $nip,
                'nama_guru' => $nama,
                'alamat'    => $alamat,
                'telepon'   => $telepon,
                'username'  => $username
            ];
            if($password != ''){
                $data['password'] = $password;
            }

            $is_update = $this->guruModel->update($guru->idguru, $data);
            if(!$is_update){
                return redirect()->back()
                    ->with('validasi', $this->guruModel->errors());
            }

            return redirect()->to('guru')
                ->with('success', 'Data guru berhasil diperbarui');
        }catch(\Exception $e){
            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }

    public function hapus_data(int $id): \CodeIgniter\HTTP\RedirectResponse
    {
        $guru = $this->guruModel->find($id);
        if(!isset($guru)){
            return redirect()->back()
                ->with('error', 'Data tidak ditemukan, proses hapus dibatalkan');
        }

        $this->guruModel->delete($guru->idguru);
        return redirect()->back()
            ->with('success', 'Data guru berhasil dihapus');
    }
}
