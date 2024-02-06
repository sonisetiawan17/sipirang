<?php

namespace App\Http\Controllers;

use App\Models\AlatPendukung;
use App\Models\BidangKegiatan;
use App\Models\Fasilitas;
use App\Models\Instansi;
use App\Models\Jadwal;
use App\Models\Permohonan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SuperAdminDashboardController extends Controller
{
    public function index()
    {
        $data = [
            'labels' => ['January', 'February', 'March', 'April', 'May'],
            'data' => [65, 59, 80, 81, 56],
        ];

        return view('super-admin.dashboard', compact('data'));
    }

    public function buatPermohonan()
    {
        $bidang = BidangKegiatan::get();
        $instansi = Instansi::get();
        $fasilitas = Fasilitas::get();
        $alat = AlatPendukung::get();
        $users = User::whereNotIn('name', ['Admin', 'Super Admin'])->get();

        return view('super-admin.buat-permohonan', compact('bidang', 'instansi', 'fasilitas', 'alat', 'users'));
    }

    public function simpanPermohonan(Request $request)
    {
        $request->validate([
            'surat_permohonan' => 'required|mimes:doc,docx,xls,xlsx,pdf,jpg,jpeg,png,bmp',
            'rundown_acara' => 'required|mimes:doc,docx,xls,xlsx,pdf,jpg,jpeg,png,bmp',
        ]);

        if ($request->hasFile('surat_permohonan') && $request->hasFile('rundown_acara')) {
            $uploadPath = public_path('file_upload');

            if (!File::isDirectory($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true, true);
            }

            $file_surat = $request->file('surat_permohonan');
            $file_acara = $request->file('rundown_acara');

            $extension_surat = $file_surat->getClientOriginalExtension();
            $extension_acara = $file_acara->getClientOriginalExtension();

            $rename_surat = 'surat_' . date('YmdHis') . '.' . $extension_surat;
            $rename_acara = 'acara_' . date('YmdHis') . '.' . $extension_acara;

            $id_fasilitas = implode(',', (array) $request->input('id_fasilitas', []));
            $id_alat = implode(',', (array) $request->input('id_alat', []));

            if ($file_surat->move($uploadPath, $rename_surat) && $file_acara->move($uploadPath, $rename_acara)) {
                $data = new Permohonan();
                $data->skpd = $request->skpd;
                $data->bidang_id = $request->bidang_id;
                $data->user_id = $request->user_id;
                $data->instansi_id = $request->instansi_id;
                $data->status_instansi = $request->status_instansi;
                $data->bidang_instansi = $request->bidang_instansi;
                $data->nama_kegiatan = $request->nama_kegiatan;
                $data->jumlah_peserta = $request->jumlah_peserta;
                $data->narasumber = $request->narasumber;
                $data->output = $request->output;
                $data->outcome = $request->outcome;
                $data->ringkasan = $request->ringkasan;

                $data->surat_permohonan = $rename_surat;
                $data->rundown_acara = $rename_acara;

                $data->id_fasilitas = $id_fasilitas;
                $data->id_alat = $id_alat;
                $data->save();

                if (isset($data['id_permohonan'])) {
                    $cekData = [
                        'permohonan_id' => $data['id_permohonan'],
                    ];
            
                }

                $jadwal = new Jadwal();
                $jadwal->user_id = $request->user_id;
                $jadwal->permohonan_id = $cekData['permohonan_id'];
                $jadwal->tgl_mulai = $request->tgl_mulai;
                $jadwal->jam_mulai = $request->jam_mulai;
                $jadwal->tgl_selesai = $request->tgl_selesai;
                $jadwal->jam_selesai = $request->jam_selesai;
                $jadwal->save();

                //  return $data;
                return redirect()
                    ->back()
                    ->with('sukses', 'Berhasil, file telah di upload');
            }
            //  return $data;
            return redirect()
                ->back()
                ->with('sukses', 'Error, file tidak dapat di upload');
        }
        //  return "Gagal";
        return redirect()
            ->back()
            ->with('sukses', 'Error, tidak ada file ditemukan');
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
