<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TuntutanController extends Controller
{
    public function borangTuntutanYuran()
    {
        return view('pages.tuntutan.borangtuntutanyuran');
    }
}
