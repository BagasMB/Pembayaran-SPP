<?php

namespace App\Http\Controllers;

use App\Models\Spp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SppController extends Controller
{
    public function index()
    {
        $sppList = Spp::orderBy('tahun_ajaran', 'DESC')->get();
        return view('spp', ['title' => 'Page | SPP', 'sppList' => $sppList]);
    }

    public function simpan(Request $request)
    {
        $validated = $request->validate(
            [
                'tahun_ajaran' => 'required',
                'spp1' => 'required',
                'spp2' => 'required',
                'spp3' => 'required',
            ],
            [
                'tahun_ajaran.required' => 'Tahun Ajaran wajib Diisi',
                'spp1.required' => 'Data SPP Kelas X wajib Diisi',
                'spp2.required' => 'Data SPP Kelas XI wajib Diisi',
                'spp3.required' => 'Data SPP Kelas XII wajib Diisi',
            ]
        );

        $tahunAjaran = $request->input('tahun_ajaran');
        $cek = DB::table('spps')->where('tahun_ajaran', $tahunAjaran)->count();

        if ($cek <> 0) {
            flash()->warning('Tahun Ajaran yaitu ' . $request->input('tahun_ajaran') . ' sudah ada. Silahkan coba lagi');
            return back();
        }
        Spp::create($request->all());
        flash()->success('Data Berhasil Di Simpan 🎉');
        return redirect('/spp');
    }

    public function update(Request $request)
    {
        $validated = $request->validate(
            [
                'spp1' => 'required',
                'spp2' => 'required',
                'spp3' => 'required',
            ],
            [
                'spp1.required' => 'Data SPP Kelas X wajib Diisi',
                'spp2.required' => 'Data SPP Kelas XI wajib Diisi',
                'spp3.required' => 'Data SPP Kelas XII wajib Diisi',
            ]
        );

        Spp::findorfail($request->id)->update($request->all());
        flash()->success('Data Berhasil Di Ubah 🎉');
        return redirect('/spp');
    }

    public function hapus($id)
    {
        Spp::findorfail($id)->delete();
        flash()->success('Data Berhasil Di Hapus 🎉');
        return redirect('/spp');
    }
}
