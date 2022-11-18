<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index()
    {
        # code...
        return view('login');
    }
    public function LoginAction(Request $request)
    {
        # code...
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required',
            ]
        );
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->status_user == 1) {
                if (Auth::user()->level == 1) {
                    $request->session()->regenerate();
                    return redirect()->intended('Admin/home');
                }
            } else {
                return redirect()->route('Login')->withErrors(['Akun Non-Aktif']);
            }
        } else {
            return redirect()->route('Login')->withErrors(['Email atau Password salah']);
        }
    }
}
