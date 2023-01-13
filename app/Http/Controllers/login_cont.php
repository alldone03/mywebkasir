<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class login_cont extends Controller
{
    public function index()
    {
        return view('pages.login');
    }
    public function checklogin()
    {

        $validate = request()->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'required' => 'Perlu diisi!!!',
        ]);


        if (Auth::attempt($validate)) {
            request()->session()->regenerate();
            return redirect()->intended('dashboard.index');
        }
        return redirect()->back()->withErrors(['msg' => 'Kombinasi Salah']);
    }
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('login.index');
    }
}
