<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenyelarasController extends Controller
{
    public function tuntutanWangSaku()
    {
        return view('pages.penyelaras.tuntutan.wangSaku');
    }

    public function tuntutanYuranPengajian()
    {
        return view('pages.penyelaras.tuntutan.yuranPengajian');
    }

    public function sejarahTuntutan()
    {
        return view('pages.penyelaras.tuntutan.sejarah');
    }

}
