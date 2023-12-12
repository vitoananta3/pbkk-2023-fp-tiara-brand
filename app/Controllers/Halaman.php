<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Halaman extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Home | Tiara Brand',
            'page' => 'home'
        ];
        return view('pages\home', $data);
    }
}
