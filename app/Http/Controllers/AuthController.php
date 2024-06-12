<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth/login');
    }

    public function login_student()
    {
        return view('auth.login-student');
    }

    public function auth(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Passwors wajib diisi',
        ]);

        // $infologin = [
        //     'username' => $request->username,
        //     'password' => $request->password,
        // ];

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            flash()->success('Selamat Datang 🎉');
            return redirect()->intended('');
        } else {
            $request->session()->flash('status', 'Username dan Password tidak sesuai');
            return redirect('auth');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('auth');
    }

    public function error404()
    {
        return view('auth.pages-error404');
    }
}
