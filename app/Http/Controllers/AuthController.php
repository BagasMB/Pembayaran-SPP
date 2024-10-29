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

    public function auth(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        // Cek apakah username ada di database
        $user = User::where('username', $validated['username'])->first();

        if ($user) {
            // Jika username ditemukan, cek apakah password sesuai
            if (Auth::attempt($validated)) {
                $request->session()->regenerate();
                flash()->success('Selamat Datang 🎉');
                return redirect()->intended('');
            } else {
                // Jika password salah
                flash()->error('Password yang Anda masukkan salah.');
                return redirect()->back()->withInput();
            }
        } else {
            // Jika username tidak ditemukan
            flash()->error('Username yang Anda masukkan salah.');
            return redirect()->back()->withInput();
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
