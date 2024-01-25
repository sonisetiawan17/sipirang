<?php

namespace App\Http\Controllers;

use App\Models\AlatPendukung;
use App\Models\BidangKegiatan;
use App\Models\BlokRuangan;
use App\Models\Fasilitas;
use App\Models\Instansi;
use App\Models\Jadwal;
use App\Models\Permohonan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserDashboardController extends Controller
{
    public function index()
    {
        $date = Carbon::now()->format('Y-m-d');

        $jam_mulai = DB::table('jadwal')->select('jam_mulai')->get();
        $jam_mulai_arr = array();

        foreach ($jam_mulai as $jam) {
            $currJam[] = $jam->jam_mulai;
        }

        $tanggal_mulai = DB::table('jadwal')->select('tgl_mulai')->get();
        $tanggal_mulai_arr = array();

        foreach ($tanggal_mulai as $tanggal) {
            $currDate[] = $tanggal->tgl_mulai;
        }

        $jam_selesai = DB::table('jadwal')->select('jam_selesai')->get();
        $jam_selesai_arr = array();

        foreach ($jam_selesai as $jam) {
            $currJamSelesai[] = $jam->jam_selesai;
        }

        $tanggal_selesai = DB::table('jadwal')->select('tgl_selesai')->get();
        $tanggal_selesai_arr = array();

        foreach ($tanggal_selesai as $tanggal) {
            $currDateSelesai[] = $tanggal->tgl_selesai;
        }

        return view('user.dashboard', compact('date', 'jam', 'currJam', 'currDate', 'currJamSelesai', 'currDateSelesai'));
    }

    public function buatPermohonan()
    {
        $bidang = BidangKegiatan::get();
        $instansi = Instansi::get();
        $fasilitas = Fasilitas::get();
        $alat = AlatPendukung::get();
        $blok = BlokRuangan::get();

        $date = Carbon::now()->format('m/d/Y');

        $jadwal = DB::table('jadwal')
            ->join('permohonan', 'permohonan.id_permohonan', '=', 'jadwal.permohonan_id')
            ->select('tgl_mulai', 'tgl_selesai', 'jam_mulai', 'jam_selesai', 'id_fasilitas', 'id_alat')
            ->get();

        return view('user.buat-permohonan', compact('bidang', 'instansi', 'fasilitas', 'alat', 'jadwal', 'blok'));
    }

    public function editPermohonan($id_permohonan)
    {
        $fasilitas = DB::table('fasilitas')->get();
        $alat = DB::table('alat_pendukung')->get();
        $user_id = Auth::user()->id;

        $data = Permohonan::find($id_permohonan);
        
        $permohonan = DB::table('permohonan')
            ->join('users', 'users.id', '=', 'permohonan.user_id')
            ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
            ->join('instansi', 'instansi.id_instansi', '=', 'permohonan.instansi_id')
            ->join('fasilitas', 'fasilitas.id_fasilitas', '=', 'permohonan.id_fasilitas')
            ->join('alat_pendukung', 'alat_pendukung.id_alat_pendukung', '=', 'permohonan.id_alat')
            ->where('users.id', '=', $user_id)
            ->where('permohonan.id_permohonan', '=', $id_permohonan)
            ->first();

        return view('user.edit-permohonan', compact('permohonan', 'fasilitas', 'alat', 'data'));
    }

    public function updatePermohonan(Request $request, $id_permohonan)
    {
        $user_id = Auth::user()->id;

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
                $permohonan = Permohonan::find($id_permohonan);
                $permohonan->skpd = $request->skpd;
                $permohonan->bidang_id = $request->bidang_id;
                $permohonan->instansi_id = $request->instansi_id;
                $permohonan->user_id = $user_id;
                $permohonan->status_instansi = $request->status_instansi;
                $permohonan->bidang_instansi = $request->bidang_instansi;
                $permohonan->nama_kegiatan = $request->nama_kegiatan;
                $permohonan->jumlah_peserta = $request->jumlah_peserta;
                $permohonan->narasumber = $request->narasumber;
                $permohonan->output = $request->output;
                $permohonan->outcome = $request->outcome;
                $permohonan->ringkasan = $request->ringkasan;
                $permohonan->status_permohonan = 'Menunggu';

                $permohonan->surat_permohonan = $rename_surat;
                $permohonan->rundown_acara = $rename_acara;

                $permohonan->id_fasilitas = $id_fasilitas;
                $permohonan->id_alat = $id_alat;
                $permohonan->update();

                if (isset($permohonan['id_permohonan'])) {
                    $cekData = [
                        'permohonan_id' => $permohonan['id_permohonan'],
                    ];
                }

                $jadwal = Jadwal::find($cekData['permohonan_id']);
                $jadwal->user_id = $user_id;
                $jadwal->permohonan_id = $cekData['permohonan_id'];
                $jadwal->tgl_mulai = $request->tgl_mulai;
                $jadwal->jam_mulai = $request->jam_mulai;
                $jadwal->tgl_selesai = $request->tgl_selesai;
                $jadwal->jam_selesai = $request->jam_selesai;
                $jadwal->update();

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

    public function lihatPermohonan($id_permohonan)
    {
        $permohonan = Permohonan::find($id_permohonan);
        $data = DB::table('permohonan')
            ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
            ->join('alat_pendukung', 'alat_pendukung.id_alat_pendukung', '=', 'permohonan.id_alat')
            ->where('permohonan.id_permohonan', '=', $id_permohonan)
            ->first();

        return view('user.lihat-permohonan', compact('permohonan', 'data'));
    }

    public function historiPermohonan()
    {
        $user_id = Auth::user()->id;

        $permohonan = DB::table('permohonan')
            ->join('users', 'users.id', '=', 'permohonan.user_id')
            ->join('bidang_kegiatan', 'bidang_kegiatan.id_bidang_kegiatan', '=', 'permohonan.bidang_id')
            ->join('instansi', 'instansi.id_instansi', '=', 'permohonan.instansi_id')
            ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
            ->join('fasilitas', 'fasilitas.id_fasilitas', '=', 'permohonan.id_fasilitas')
            ->join('alat_pendukung', 'alat_pendukung.id_alat_pendukung', '=', 'permohonan.id_alat')
            ->where('users.id', '=', $user_id)
            ->get();

        $user = Auth::user()->name;

        return view('user.histori-permohonan', compact('permohonan'));
    }

    public function cekJadwal(Request $request)
    {
        $tgl_mulai = $request->tgl_mulai;
        $jam_mulai = $request->jam_mulai;
        $tgl_selesai = $request->tgl_selesai;
        $jam_selesai = $request->jam_selesai;

        dd($tgl_mulai, $jam_mulai, $tgl_selesai, $jam_selesai);
    }
}