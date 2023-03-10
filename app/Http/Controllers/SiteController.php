<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Rules\CheckEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SiteController extends Controller
{
    public function home(Request $request)
    {
        return view('client.home');
    }
    public function login(Request $request)
    {
        if(!isLogin())return view('site.login');
        return redirect()->back();
    }
    public function dologin(Request $request)
    {
        $credential = [
            "email" => $request->email,
            "password" => $request->password,
        ];
        if (Auth::guard('web')->attempt($credential)) {
            $cekRole = Auth::guard('web')->user()->role;
            if($cekRole == "admin"){
                return redirect('admin/user');
            }else{
                return redirect('home');
            }
        } else {
            return redirect('login')->with(['pesan' => ['tipe' => 0, 'isi' => 'Gagal Login Brow']]);
        }
    }
    public function register(Request $request)
    {
        if(!isLogin())return view('site.register');
        return redirect()->back();
    }
    public function doregister(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:4|max:25',
            'email' => ['required', 'email', new CheckEmail],
            'password' => 'required|confirmed',
            'alamat' => 'required'
        ]);
        $data = $request->all();
        $data["password"] = Hash::make($request->password);
        if (Users::create($data)) {
            return redirect('login')->with(
                ['pesan' => ['tipe' => 1, 'isi' => 'Berhasil Register']]
            );
        } else {
            return redirect('register')->with(
                ['pesan' => ['tipe' => 0, 'isi' => 'Gagal Register']]
            );
        }
    }
    public function doLogout(Request $request)
    {
        Auth::guard("web")->logout();
        return redirect('login')->with(['pesan' => ['tipe' => 1, 'isi' => 'Berhasil Logout']]);
    }
}
