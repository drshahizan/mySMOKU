<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\InfoIpt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailDaftarPengguna;


class PentadbirController extends Controller
{
    public function daftar()
    {
        $user = User::leftjoin('roles','roles.id','=','users.tahap')
        ->orderBy('users.created_at', 'desc')
        ->get(['users.*', 'roles.name']);

        $tahap = Role::all()->sortBy('id');
        $infoipt = InfoIpt::all()->where('jenis_institusi','IPTA')->sortBy('nama_institusi');
        return view('pages.pentadbir.daftarpengguna', compact('user','tahap','infoipt'));
    }

    public function store(Request $request)
    {   
       

        $user = User::where('no_kp', '=', $request->no_kp)->first();
        if ($user === null) {
            $user = User::create([
                'nama' => $request->nama,
                'no_kp' => $request->no_kp,
                'email' => $request->email,
                'tahap' => $request->tahap,
                'jawatan' => $request->jawatan,
                'id_institusi' => $request->id_institusi,
                'password' => Hash::make($request->password),
                'status' => '1',
        
            ]);
        }else {

        User::where('no_kp' ,$request->no_kp)
            ->update([
                'nama' => $request->nama,
                'no_kp' => $request->no_kp,
                'email' => $request->email,
                'tahap' => $request->tahap,
                'jawatan' => $request->jawatan,
                'id_institusi' => $request->id_institusi,
                'password' => Hash::make($request->password),
                'status' => $request->status,
            
        ]);
        }

        
        

        $user->save();

        $email = $request->email;
        $no_kp = $request->no_kp;

        Mail::to($email)->send(new mailDaftarPengguna($email,$no_kp));
        return redirect()->route('daftarpengguna')->with('message', 'Emel notifikasi telah dihantar kepada ' .$request->nama);


    }
    

}
