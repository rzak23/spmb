<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\Admin\AdminModel;
use CodeIgniter\HTTP\ResponseInterface;

class LoginController extends BaseController
{
    public function login_proses(): \CodeIgniter\HTTP\RedirectResponse
    {
        $admin_model = new AdminModel();

        try{
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $admin = $admin_model->where('username', $username)->first();
            if(!isset($admin)){
                return redirect()->back()
                    ->with('error', 'Pengguna tidak terdaftar');
            }

            if(!password_verify($password, $admin->password)){
                return redirect()->back()
                    ->with('error', 'Kombinasi password salah');
            }

            return redirect()->to('dashboard')
                ->with('success', 'Login berhasil');
        }catch(\Exception $e){
            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }

    public function logout_proses(): \CodeIgniter\HTTP\RedirectResponse
    {
        return redirect()->to('/')
            ->with('success', 'Berhasil keluar dari sistem');
    }
}
