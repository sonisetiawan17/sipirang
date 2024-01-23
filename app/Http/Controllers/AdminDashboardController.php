<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Permohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function dataPemohon()
    {
        $permohonan = DB::table('permohonan')
            ->join('users', 'users.id', '=', 'permohonan.id_user')
            ->join('instansi', 'instansi.id_instansi', '=', 'permohonan.id_instansi')
            ->get();

        return view('admin.data-pemohon', compact('permohonan'));
    }

    public function show($id_permohonan)
    {
        $permohonan = DB::table('permohonan')
            ->join('users', 'users.id', '=', 'permohonan.id_user')
            ->join('instansi', 'instansi.id_instansi', '=', 'permohonan.id_instansi')
            ->find($id_permohonan);

        return view('admin.lihat-data-pemohon', compact('permohonan'));
    }

    public function index_instansi()
    {
        $instansi = Instansi::get();

        return view('admin.data-instansi', compact('instansi'));
    }

    public function terima_permohonan(Request $request)
    {
        $id_permohonan = $request->id_permohonan;
        $data = Permohonan::find($id_permohonan);
        $data->status_permohonan = $request->status_permohonan;
        $data->catatan = $request->catatan;
        $simpan = $data->update();
        return redirect()
            ->back()
            ->with('sukses', 'Berhasil! Permohonan diterima');
    }

    public function tolak_permohonan(Request $request)
    {
        $id_permohonan = $request->id_permohonan;
        $data = Permohonan::find($id_permohonan);
        $data->status_permohonan = $request->status_permohonan;
        $data->catatan = $request->catatan;
        $simpan = $data->update();
        return redirect()
            ->back()
            ->with('sukses', 'Berhasil! Permohonan ditolak');
    }
}
