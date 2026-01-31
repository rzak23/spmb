<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        helper('form');
        return view('pages/auth/login');
    }

    public function halaman_dashboard(): string
    {
        return view('pages/dashboard/index');
    }
}
