<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Configuration SPP',
            'config' => Configuration::find(1),
        ];
        return view('config', $data);
    }

    public function update(Request $request)
    {
        Configuration::findorfail($request->id)->update($request->all());
        flash()->success('Data Berhasil Di Ubah 🎉');
        return back();
    }
}
