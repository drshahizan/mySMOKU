<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenyelarasController extends Controller
{
    public function tuntutanWangSaku()
    {
        return view('pages.penyelaras.tuntutan.wangSaku');
    }

    public function maklumatTuntutanWangSaku()
    {
        return view('pages.penyelaras.tuntutan.maklumatWangSaku');
    }

    public function tuntutanYuranPengajian()
    {
        return view('pages.penyelaras.tuntutan.yuranPengajian');
    }

    public function maklumatTuntutanYuranPengajian()
    {
        return view('pages.penyelaras.tuntutan.maklumatYuranPengajian');
    }

    public function sejarahTuntutan()
    {
        return view('pages.penyelaras.tuntutan.sejarah');
    }

}
