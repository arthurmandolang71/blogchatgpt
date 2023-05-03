<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'active' => 'login',
            'title' => 'Login'
        ]);
    }

    public function auth(Request $request)
    {
        $cridentials = $request->validate(
                [
                    'username' => ['required'],
                    'password' => ['required']
                ]
            );
        
        if(Auth::attempt($cridentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->with('pesan_error','login gagal');
        
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect('/login')->with('pesan','anda berhasil logout');
    }
}
