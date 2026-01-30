<?php

namespace App\Controllers\Siswa;

use App\Controllers\BaseController;
use App\Models\Siswa\SiswaFailModel;
use App\Models\Siswa\SiswaModel;
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
                    $nip                = $row['A'];
                    $no_kk              = $row['B'];
                    $no_pkh             = $row['C'];
                    $no_pip             = $row['D'];
                    $nama_siswa         = $row['E'];
                    $tempat_lahir       = $row['F'];
                    $tanggal_lahir      = $row['G'];
                    $alamat             = $row['H'];
                    $jk                 = strtolower($row['I']);
                    $status_warganegara = strtolower($row['J']);

                    $data = [
                        'nip'           => $nip,
                        'npsn'          => $guru_data->idsekolah,
                        'nomor_kk'      => $no_kk,
                        'nomor_pkh'     => ($no_pkh == '') ? null : $no_pkh,
                        'nomor_pip'     => ($no_pip == '') ? null : $no_pip,
                        'nama_siswa'    => $nama_siswa,
                        'tempat_lahir'  => $tempat_lahir,
                        'tanggal_lahir' => $tanggal_lahir,
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

            unlink($file_path);

            $msg = "Data berhasil diimport";
            if($total_fail > 0){
                $msg = "Data berhasil diimport, namun ada beberapa data yang tidak valid, cek dan perbaiki data yang tidak valid";
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
