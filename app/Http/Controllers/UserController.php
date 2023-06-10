<?php

namespace App\Http\Controllers;

use App\Http\Middleware\user;
use App\Models\User as ModelsUser;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->where('role', '=', '0')->get();

        return view('user', ['users' => $users]);
    }

    public function hapus($id)
    {
        $do = DB::connection('sqlsrv')->select("SELECT pencatat
        FROM catatan WHERE pencatat_id = $id");
        if (count($do)==0) {
            $delete = DB::delete("DELETE FROM users WHERE id = $id");

            if ($delete) {
                return redirect('/user')->with('success', 'data telah terhapus');
            }
        }
        else{
            return redirect('/user')->with('error', 'pengguna masih bertanggung jawab atas catatas pelanggaran');
        }
    }

    public function halamanUbahPassword()
    {
        return view('auth.ubahPassword');
    }

    public function ubahPassword(Request $request)
    {
        $id = Auth::user()->id;
        $user = ModelsUser::find($id);
        // dd($user->password);
        if (Hash::check($request->oldPassword, $user->password) == true) {
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            $user->password = Hash::make($request->password);
            $user->save();
            // return redirect('/ubahPassword')->with('success', 'Password telah diganti');
            return redirect()->back()->with('success', 'Password telah diganti');
        } else {
            return redirect()->back()->with('error', 'Password lama tidak sesuai');
            // return redirect('/ubahPassword')->with('error', 'Password lama tidak sesuai');
        }
    }
    
    public function edit(Request $request)
    {
        $user = ModelsUser::find($request->id);
        $user->name = $request->nama;
        $user->save();
        return redirect()->back()->with('success', 'Nama pengguna telah diganti');
    }
}
