<?php

namespace App\Controllers\Siswa;

use App\Controllers\BaseController;
use App\Models\Siswa\SiswaModel;
use CodeIgniter\HTTP\ResponseInterface;

class SiswaController extends BaseController
{
    private SiswaModel $siswaModel;

    public function __construct(){
        $this->siswaModel = new SiswaModel();
    }

    public function index(): string
    {
        helper('format_string');
        if(!session()->get('is_admin')){
            $guru = auth()->get_guru(session()->get('id'));
            $siswa = $this->siswaModel->join('tbl_sekolah', 'tbl_sekolah.npsn = tbl_siswa.npsn', 'left')
                ->where('tbl_siswa.npsn', $guru->idsekolah)
                ->where('is_verify', 0)
                ->findAll();
        }else{
            $siswa = $this->siswaModel->findAll();
        }

        $data = [
            'data' => $siswa
        ];
        return view('pages/dashboard/siswa/siswa_list', $data);
    }

    public function form_ae(?int $id = null){
        helper('form');

        $guru = auth()->get_guru(session()->get('id'));
        $data = [];

        $data['title'] = 'Tambah Siswa';
        $data['action'] = 'siswa/save';
        $data['npsn'] = $guru->idsekolah;
        return view('pages/dashboard/siswa/siswa_ae', $data);
    }

    public function save(?int $id = null){
        if(is_null($id)){
            return $this->add_data();
        }
    }

    private function add_data(): \CodeIgniter\HTTP\RedirectResponse
    {
        $npsn   = $this->request->getPost('sekolah');
        $kk     = $this->request->getPost('kk');
        $pkh    = $this->request->getPost('pkh');
        $pip    = $this->request->getPost('pip');
        $nip    = $this->request->getPost('nip');
        $nama   = $this->request->getPost('nama');
        $tempat = $this->request->getPost('tempat');
        $tgl    = $this->request->getPost('tgl');
        $jk     = $this->request->getPost('jk');
        $status = $this->request->getPost('status');
        $alamat = $this->request->getPost('alamat');

        try{
            $data = [
                'nip'           => $nip,
                'npsn'          => $npsn,
                'nomor_kk'      => $kk,
                'nomor_pkh'     => ($pkh == "") ? null : $pkh,
                'nomor_pip'     => ($pip == "") ? null : $pip,
                'nama_siswa'    => $nama,
                'tempat_lahir'  => $tempat,
                'tanggal_lahir' => $tgl,
                'alamat'        => $alamat,
                'jk'            => $jk,
                'status'        => $status,
            ];
            $is_save = $this->siswaModel->insert($data);
            if(!$is_save){
                return redirect()->back()
                    ->with('validasi', $this->siswaModel->errors());
            }

            return redirect()->to('siswa')
                ->with('success', 'Data Siswa berhasil ditambahkan');
        }catch(\Exception $e){
            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }
}
