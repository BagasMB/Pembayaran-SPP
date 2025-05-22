<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.user', ['title' => 'Page | User']);
    }

    public function edit($id)
    {
        return view('pages.edituser', [
            'title' => 'Page | Edit User',
            'id' => $id,
        ]);
    }

    public function simpan(Request $request)
    {
        User::create([
            'username' => $request->username,
            'password' => $request->password,
            'name' => $request->name,
            'role' => $request->role,
            'email' => $request->email,
        ]);

        flash()->success('Data Berhasil Di Simpan 🎉');
        return redirect('/user');
    }

    public function hapus($id)
    {
        User::findorfail($id)->delete();
        flash()->success('Data Berhasil Di Hapus 🎉');
        return redirect('/user');
    }
}
