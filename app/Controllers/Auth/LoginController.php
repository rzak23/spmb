<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Libraries\Auth;
use App\Models\Admin\AdminModel;
use App\Models\Guru\GuruModel;
use CodeIgniter\HTTP\ResponseInterface;

class LoginController extends BaseController
{
    public function login_proses(): \CodeIgniter\HTTP\RedirectResponse
    {
        $admin_model = new AdminModel();
        $guru_model = new GuruModel();

        try{
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $login = Auth::login_act($username, $password);
            if(!$login->status){
                return redirect()->back()
                    ->with('error', $login->msg);
            }

            $sess_data = $login->data;
            session()->set('id', $sess_data['id']);
            session()->set('is_admin', $sess_data['is_admin']);
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
