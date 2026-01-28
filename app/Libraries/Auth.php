<?php

namespace App\Libraries;
use App\Models\Admin\AdminModel;
use App\Models\Guru\GuruModel;

class Auth{
    public static function login_act(string $username, string $password): object
    {
        $admin_model    = new AdminModel();
        $guru_model     = new GuruModel();

        $admin  = $admin_model->where('username', $username)->first();
        $guru   = $guru_model->where('username', $username)->first();

        if(!isset($admin) && !isset($guru)){
            $res = [
                'status'    => false,
                'msg'       => 'Pengguna tidak terdaftar',
                'data'      => null
            ];
            return (object) $res;
        }

        if(isset($admin)){
            if(!password_verify($password, $admin->password)){
                $res = [
                    'status'    => false,
                    'msg'       => 'Kombinasi password dan username tidak sesuai',
                    'data'      => null
                ];
                return (object) $res;
            }

            $res = [
                'status'    => true,
                'msg'       => 'Verifikasi login berhasil',
                'data'      => [
                    'id'        => $admin->idadmin,
                    'is_admin'  => true
                ]
            ];
            return (object) $res;
        }

        if(!password_verify($password, $guru->password)){
            $res = [
                'status'    => false,
                'msg'       => 'Kombinasi password dan username tidak sesuai',
                'data'      => null
            ];
            return (object) $res;
        }

        $res = [
            'status'    => true,
            'msg'       => 'Verifikasi login berhasil',
            'data'      => [
                'id'        => $guru->idguru,
                'is_admin'  => false
            ]
        ];
        return (object) $res;
    }

    public function get_guru(int $id): array|object|null
    {
        $guru_model = new GuruModel();

        $guru = $guru_model->find($id);
        if(!isset($guru)){
            return null;
        }

        return $guru;
    }
}