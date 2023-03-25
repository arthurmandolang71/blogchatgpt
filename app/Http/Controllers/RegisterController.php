<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            'title' => 'registrasi',
            'active' => 'registrasi'
        ]);
    }

    public function store(Request $request)
    {
           $data = $request->validate([
                'name' => ['required','max:255'],
                'username' => ['required', 'min:3', 'max:255', 'unique:users'],
                'email' => ['required', 'email:dns', 'unique:users'],
                'password' => ['required','min:5','max:255']
           ]); 

           $data['password'] = Hash::make($data['password']);
           
           User::create($data);
           
           return redirect('login')->with('pesan', 'berhasil registrasi!');
    }
}
