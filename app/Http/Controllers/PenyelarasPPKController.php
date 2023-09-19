<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Smoku;


class PenyelarasPPKController extends Controller
{
    public function index()
    {
        $smoku = Smoku::orderBy('smoku.id','desc')
            ->join('smoku_penyelaras','smoku_penyelaras.smoku_id','=','smoku.id')
            ->leftJoin('permohonan','permohonan.smoku_id','=','smoku.id')
            ->get(['smoku.*', 'smoku_penyelaras.*', 'permohonan.*'])
            ->where('penyelaras_id','=', Auth::user()->id)
            ->where('status','!=', '2');
        //dd($smoku);    

        return view('dashboard.penyelaras_ppk.dashboard', compact('smoku'));

    }
}
