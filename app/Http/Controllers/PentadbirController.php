<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Tahap;
use App\Models\Infoipt;
use Illuminate\Support\Facades\DB;

class PentadbirController extends Controller
{
    public function daftar()
    {
        $user = User::leftjoin('roles','roles.id','=','users.tahap')
        ->orderBy('users.created_at', 'desc')
        ->get(['users.*', 'roles.name']);

        $tahap = Tahap::all()->sortBy('id');
        $infoipt = Infoipt::all()->where('jenis_ipt','IPTA')->sortBy('namaipt');
        return view('pages.pentadbir.daftarpengguna', compact('user','tahap','infoipt'));
    }

    public function store(Request $request)
    {   
       

        $user = User::where('nokp', '=', $request->nokp)->first();
        if ($user === null) {
            $user = User::create([
                'nama' => $request->nama,
                'nokp' => $request->nokp,
                'email' => $request->email,
                'tahap' => $request->tahap,
                'jawatan' => $request->jawatan,
                'id_institusi' => $request->id_institusi,
                'password' => Hash::make($request->password),
                'status' => '1',
        
            ]);
        }else {

        DB::table('users')->where('nokp' ,$request->nokp)
            ->update([
                'nama' => $request->nama,
                'nokp' => $request->nokp,
                'email' => $request->email,
                'tahap' => $request->tahap,
                'jawatan' => $request->jawatan,
                'id_institusi' => $request->id_institusi,
                'password' => Hash::make($request->password),
                'status' => $request->status,
            
        ]);
        }

        $user->save();
        return redirect()->route('daftarpengguna');


    }
    

}
