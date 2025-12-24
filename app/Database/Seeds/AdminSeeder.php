<?php

namespace App\Database\Seeds;

use App\Models\Admin\AdminModel;
use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admin_model = new AdminModel();

        try{
            $data = [
                'username' => 'admin',
                'password' => '123456789'
            ];
            $admin_model->insert($data);
        }catch(\Exception $e){}
    }
}
