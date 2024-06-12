<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $userList = User::all();
        return view('user', ['title' => 'Page | User', 'userList' => $userList]);
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

    public function update(Request $request)
    {
        User::findorfail($request->id)->update($request->all());
        flash()->success('Data Berhasil Di Ubah 🎉');
        return redirect('/user');
    }

    public function hapus($id)
    {
        User::findorfail($id)->delete();
        flash()->success('Data Berhasil Di Hapus 🎉');
        return redirect('/user');
    }
}
