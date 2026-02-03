<?php

namespace App\Controllers\Profil;

use App\Controllers\BaseController;
use App\Models\Admin\AdminModel;
use App\Models\Guru\GuruModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Model;

class ProfilController extends BaseController
{
    public function page_ganti_pass(): string
    {
        helper('form');

        return view('pages/dashboard/profil/ganti_pass');
    }

    public function update_pass(): \CodeIgniter\HTTP\RedirectResponse
    {
        $admin_model = new AdminModel();
        $guru_model = new GuruModel();

        try{
            $new_pass   = $this->request->getPost('new-pass');
            $re_pass    = $this->request->getPost('re-pass');
            $old_pass   = $this->request->getPost('old-pass');

            $rule = (new Model())->setValidationRules([
                'old_pass'  => 'required|min_length[8]',
                'new_pass'  => 'required|min_length[8]',
                're_pass'   => 'required|min_length[8]|matches[new_pass]'
            ])->setValidationMessages([
                'old_pass' => [
                    'required'      => 'Wajib diisi',
                    'min_length'    => 'Minimal 8 karakter'
                ],
                'new_pass' => [
                    'required'      => 'Wajib diisi',
                    'min_length'    => 'Minimal 8 karakter'
                ],
                're_pass' => [
                    'required'      => 'Wajib diisi',
                    'min_length'    => 'Minimal 8 karakter',
                    'matches'       => 'Konfirmasi tidak sama dengan password baru'
                ]
            ]);

            $is_valid = $rule->validate([
                'old_pass'  => $old_pass,
                'new_pass'  => $new_pass,
                're_pass'   => $re_pass
            ]);
            if(!$is_valid){
                return redirect()->back()
                    ->with('validasi', $rule->errors());
            }

            if(session('is_admin')){
                $admin = $admin_model->find(session('id'));
                if(!isset($admin)){
                    return redirect()->back()
                        ->with('error', 'Kredential tidak sesuai, update password dibatalkan');
                }

                $is_update = $admin_model->update($admin->idadmin, [
                    'password' => $new_pass
                ]);
                if(!$is_update){
                    return redirect()->back()
                        ->with('error', $admin_model->errors()['password']);
                }

                return redirect()->back()
                    ->with('success', 'Password berhasil diperbarui');
            }

            $guru = $guru_model->find(session('id'));
            if(!isset($guru)){
                return redirect()->back()
                    ->with('error', 'Kredential tidak sesuai, update password dibatalkan');
            }

            $is_update = $guru_model->update($guru->idguru, [
                'password' => $new_pass
            ]);
            if(!$is_update){
                return redirect()->back()
                    ->with('error', $guru_model->errors()['password']);
            }

            return redirect()->back()
                ->with('success', 'Password berhasil diperbarui');
        }catch(\Exception $e){
            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }
}
