<?php

namespace App\Controllers\Siswa;

use App\Controllers\BaseController;
use App\Models\Siswa\SiswaFailModel;
use App\Models\Siswa\SiswaModel;
use Carbon\Carbon;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

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
            $siswa = $this->siswaModel->select('tbl_siswa.*, tbl_sekolah.sekolah')
                ->join('tbl_sekolah', 'tbl_sekolah.npsn = tbl_siswa.npsn', 'left')
                ->where('tbl_siswa.npsn', $guru->idsekolah)
                ->where('is_verify', 0)
                ->findAll();
        }else{
            $siswa = $this->siswaModel->select('tbl_siswa.*, tbl_sekolah.sekolah')
                ->join('tbl_sekolah', 'tbl_sekolah.npsn = tbl_siswa.npsn', 'left')
                ->where('is_verify', 0)
                ->findAll();
        }

        $data = [
            'data' => $siswa
        ];
        return view('pages/dashboard/siswa/siswa_list', $data);
    }

    public function form_ae(?int $id = null, ?string $fixed = null): string|\CodeIgniter\HTTP\RedirectResponse
    {
        helper('form');
        $fail_model = new SiswaFailModel();

        $guru = auth()->get_guru(session()->get('id'));
        $data = [];

        if(is_null($id)){
            $data['title']  = 'Tambah Siswa';
            $data['action'] = 'siswa/save';
            $data['npsn']   = $guru->idsekolah;
            $data['mode']   = 'add';
        }else{
            if(!is_null($fixed)){
                $siswa_fail = $fail_model->find($id);
                if(!isset($siswa_fail)){
                    return redirect()->back()
                        ->with('error', 'Data tidak ditemukan');
                }

                $data['title']  = 'Perbaikan Data Siswa';
                $data['action'] = 'siswa/save?fixed=true';
                $data['npsn']   = $siswa_fail->npsn;
                $data['mode']   = 'fixed';
                $data['data']   = $siswa_fail;
            }else{
                $siswa = $this->siswaModel->find($id);
                if(!isset($siswa)){
                    return redirect()->back()
                        ->with('error', 'Data tidak ditemukan');
                }

                $data['title']  = 'Edit Data Siswa';
                $data['action'] = 'siswa/save/'.$id;
                $data['npsn']   = $siswa->npsn;
                $data['mode']   = 'edit';
                $data['data']   = $siswa;
            }
        }

        return view('pages/dashboard/siswa/siswa_ae', $data);
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
        $npsn   = $this->request->getPost('sekolah');
        $nik    = $this->request->getPost('nik');
        $kk     = $this->request->getPost('kk');
        $pkh    = $this->request->getPost('pkh');
        $pip    = $this->request->getPost('pip');
        $nisn   = $this->request->getPost('nisn');
        $nama   = $this->request->getPost('nama');
        $ibu    = $this->request->getPost('ibu-kandung');
        $tempat = $this->request->getPost('tempat');
        $tgl    = $this->request->getPost('tgl');
        $jk     = $this->request->getPost('jk');
        $status = $this->request->getPost('status');
        $alamat = $this->request->getPost('alamat');
        $desa   = $this->request->getPost('desa');
        $kab    = $this->request->getPost('kabupaten');
        $kec    = $this->request->getPost('kecamatan');

        try{
            $data = [
                'nisn'          => ($nisn == "") ? null : $nisn,
                'npsn'          => $npsn,
                'nik'           => ($nik == "") ? null : $nik,
                'nomor_kk'      => ($kk == "") ? null : $kk,
                'nomor_pkh'     => ($pkh == "") ? null : $pkh,
                'nomor_pip'     => ($pip == "") ? null : $pip,
                'nama_siswa'    => $nama,
                'ibu_kandung'   => $ibu,
                'tempat_lahir'  => $tempat,
                'tanggal_lahir' => $tgl,
                'alamat'        => $alamat,
                'jk'            => $jk,
                'status'        => $status,
                'desa'          => $desa,
                'kabupaten'     => $kab,
                'kecamatan'     => $kec
            ];
            $is_save = $this->siswaModel->insert($data);
            if(!$is_save){
                return redirect()->back()
                    ->with('validasi', $this->siswaModel->errors());
            }

            // jika hasil fixed dari import
            // setelah berhasil data dihapus
            $param_fixed = $this->request->getGet('fixed');
            $fixed = filter_var($param_fixed, FILTER_VALIDATE_BOOLEAN);
            if($fixed){
                $fail_nisn = request()->getPost('nisn-fail');
                (new SiswaFailModel())->where('nisn', $fail_nisn)->delete();
            }

            return redirect()->to('siswa')
                ->with('success', 'Data Siswa berhasil ditambahkan');
        }catch(\Exception $e){
            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }

    public function update_data(int $id): \CodeIgniter\HTTP\RedirectResponse
    {
        $siswa = $this->siswaModel->find($id);
        if(!isset($siswa)){
            return redirect()->to('siswa')
                ->with('error', 'Data tidak ditemukan, proses update dibatalkan');
        }

        $npsn   = $this->request->getPost('sekolah');
        $nik    = $this->request->getPost('nik');
        $kk     = $this->request->getPost('kk');
        $pkh    = $this->request->getPost('pkh');
        $pip    = $this->request->getPost('pip');
        $nisn   = $this->request->getPost('nisn');
        $nama   = $this->request->getPost('nama');
        $ibu    = $this->request->getPost('ibu-kandung');
        $tempat = $this->request->getPost('tempat');
        $tgl    = $this->request->getPost('tgl');
        $jk     = $this->request->getPost('jk');
        $status = $this->request->getPost('status');
        $alamat = $this->request->getPost('alamat');
        $desa   = $this->request->getPost('desa');
        $kab    = $this->request->getPost('kabupaten');
        $kec    = $this->request->getPost('kecamatan');

        try{
            $data = [
                'nisn'          => ($nisn == "") ? null : $nisn,
                'npsn'          => $npsn,
                'nik'           => ($nik == "") ? null : $nik,
                'nomor_kk'      => ($kk == "") ? null : $kk,
                'nomor_pkh'     => ($pkh == "") ? null : $pkh,
                'nomor_pip'     => ($pip == "") ? null : $pip,
                'nama_siswa'    => $nama,
                'ibu_kandung'   => $ibu,
                'tempat_lahir'  => $tempat,
                'tanggal_lahir' => $tgl,
                'alamat'        => $alamat,
                'jk'            => $jk,
                'status'        => $status,
                'desa'          => $desa,
                'kabupaten'     => $kab,
                'kecamatan'     => $kec
            ];

            $is_update = $this->siswaModel->update($siswa->idsiswa, $data);
            if(!$is_update){
                return redirect()->back()
                    ->with('validasi', $this->siswaModel->errors());
            }

            return redirect()->to('siswa')
                ->with('success', 'Data Siswa berhasil diperbarui');
        }catch(\Exception $e){
            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }

    public function hapus_data(int $id): \CodeIgniter\HTTP\RedirectResponse
    {
        $siswa = $this->siswaModel->find($id);
        if(!isset($siswa)){
            return redirect()->back()
                ->with('error', 'Data tidak ditemukan, proses hapus dibatalkan');
        }

        $this->siswaModel->delete($siswa->idsiswa);
        return redirect()->back()
            ->with('success', 'Data berhasil dihapus');
    }

    public function page_import(): string
    {
        helper('form');
        $fail_model = new SiswaFailModel();

        $guru = auth()->get_guru(session('id'));
        $fail = $fail_model->where('npsn', $guru->idsekolah)
            ->findAll();
        $data = [
            'data' => $fail
        ];
        return view('pages/dashboard/siswa/siswa_batch', $data);
    }

    public function download_template(): ?\CodeIgniter\HTTP\DownloadResponse
    {
        $file_path = WRITEPATH.'/uploads/template/form_import_siswa.xlsx';
        return $this->response->download($file_path, null);
    }

    public function proses_import(): \CodeIgniter\HTTP\RedirectResponse
    {
        $validation_rule = [
            'filesiswa'    => [
                'label'     => 'File Excel',
                'rules'     => [
                    'uploaded[filesiswa]',
                    'ext_in[filesiswa,xls,xlsx]'
                ]
            ]
        ];
        if(!$this->validateData([], $validation_rule)){
            return redirect()->back()
                ->with('validasi', $this->validator->getErrors());
        }

        try{
            $guru_data = auth()->get_guru(session()->get('id'));

            $file = $this->request->getFile('filesiswa');
            $new_file_name = "{$guru_data->idsekolah}_{$file->getRandomName()}";
            if(!$file->hasMoved()){
                $file->move(WRITEPATH.'uploads/siswa', $new_file_name);
            }

            $reader_excel = new Xlsx();

            $file_path      = WRITEPATH."uploads/siswa/{$new_file_name}";
            $spread_sheet   = $reader_excel->load($file_path);
            $sheet          = $spread_sheet->getActiveSheet()->toArray(null, true, true, true);
            $num_row        = 1;
            $total_fail     = 0;
            foreach($sheet as $row){
                // lewatkan baris pertama
                if($num_row > 1){
                    $nisn               = $row['A'];
                    $nik                = $row['B'];
                    $no_kk              = $row['C'];
                    $no_pkh             = $row['D'];
                    $no_pip             = $row['E'];
                    $nama_siswa         = $row['F'];
                    $ibu_kandung        = $row['G'];
                    $tempat_lahir       = $row['H'];
                    $tanggal_lahir      = $row['I'];
                    $alamat             = $row['J'];
                    $desa               = $row['K'];
                    $kabupaten          = $row['L'];
                    $kecamatan          = $row['M'];
                    $jk                 = strtolower($row['N']);
                    $status_warganegara = strtolower($row['O']);

                    $data = [
                        'nik'           => ($nik == '') ? null : $nik,
                        'nisn'          => ($nisn == '') ? null : $nisn,
                        'npsn'          => $guru_data->idsekolah,
                        'nomor_kk'      => ($no_kk == '') ? null : $no_kk,
                        'nomor_pkh'     => ($no_pkh == '') ? null : $no_pkh,
                        'nomor_pip'     => ($no_pip == '') ? null : $no_pip,
                        'nama_siswa'    => $nama_siswa,
                        'ibu_kandung'   => ($ibu_kandung == '') ? null : $ibu_kandung,
                        'tempat_lahir'  => $tempat_lahir,
                        'desa'          => ($desa == '') ? null : $desa,
                        'kabupaten'     => ($kabupaten == '') ? null : $kabupaten,
                        'kecamatan'     => ($kecamatan == '') ? null : $kecamatan,
                        'tanggal_lahir' => Carbon::parse($tanggal_lahir)->toDateString(),
                        'alamat'        => $alamat,
                        'jk'            => $jk,
                        'status'        => $status_warganegara
                    ];
                    $is_insert = $this->siswaModel->insert($data);
                    if(!$is_insert){
                        $data['json_fail'] = json_encode($this->siswaModel->errors());
                        $total_fail++;
                        $this->insert_fail_import($data);
                    }
                }

                $num_row++;
            }

            unlink($file_path); // hapus file jika import selesai
            $msg = "Data berhasil diimport";
            if($total_fail > 0){
                $msg = "Data berhasil diimport, ada {$total_fail} data tidak valid, cek dan perbaiki data yang tidak valid";
            }

            return redirect()->to('siswa/batch')
                ->with('success', $msg);
        }catch(\Exception $e){
            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }

    private function insert_fail_import(array $data): void
    {
        try{
            $fail_model = new SiswaFailModel();

            $fail_model->insert($data);
        }catch(\Exception $e){}
    }

    public function get_detail_error(int $id): ResponseInterface
    {
        $fail_model = new SiswaFailModel();

        $fail = $fail_model->find($id);
        if(!isset($fail)){
            return $this->response->setJSON([
                'msg'   => 'Data tidak ditemukan',
                'data'  => null
            ]);
        }

        return $this->response->setJSON([
            'msg'   => 'Data ditemukan',
            'data'  => $fail
        ]);
    }
}
