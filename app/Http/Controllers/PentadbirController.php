<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Tahap;

class PentadbirController extends Controller
{
    public function daftar()
    {
        $user = User::leftjoin('roles','roles.id','=','users.tahap')
        ->orderBy('users.created_at', 'desc')
        ->get(['users.*', 'roles.name']);

        $tahap = Tahap::all()->sortBy('id');
        return view('pages.pentadbir.daftarpengguna', compact('user','tahap'));
    }

    public function store(Request $request)
    {   
       

        $user = User::where('nokp', '=', $request->nokp)->first();
        if ($user === null) {
            $user = User::create([
                'nokp' => $request->nokp,
                'email' => $request->email,
                'tahap' => $request->tahap,
                'password' => Hash::make($request->password),
                'status' => '1',
        
            ]);
        }else {

        User::table('users')->where('nokp' ,$request->nokp)
            ->update([
                'nokp' => $request->nokp,
                'email' => $request->email,
                'tahap' => $request->tahap,
                'password' => Hash::make($request->password),
                'status' => '1',
            
        ]);
        }

        $user->save();
        //return redirect()->route('daftarpengguna');


    }

}