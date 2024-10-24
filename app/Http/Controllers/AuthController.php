<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        //validasi login
        if (Auth::attempt($credentials)) {
            if(Auth::user()->status != 'active'){
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                Session::flash('alert', 'gagal');
                Session::flash('message', 'Akun anda belum diaktifkan Admin');
                return redirect('login');
         };
            if (Auth::user()->roles->role_name == 'admin') {
                return redirect('admin/dashboard');
            }else{
                return redirect('member/dashboard');
            }
        }
        Session::flash('alert', 'gagal');
        Session::flash('message', 'Login invalid');
        return redirect('login');
    }
    public function register()
    {
        return view('register');
    }
    public function register_process(Request $request)
    {
        $validate =$request->validate([
        'name' => 'required|max:255',
        'username' => 'required|max:255',
        'password' => 'required|max:255',
        'no_telepon' => 'required|max:255',
        ]);
        $request["password"] = Hash::make($request->password);
        $user = User::create($request->all());
        Session::flash('status','Sukses');
        Session::flash('message','Registrasi berhasil,Silahkan login');
        return redirect('login');
    }
    public function logout(Request $request)
   {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('login');
   }
}
