<?php

namespace App\Http\Controllers;

use App\Models\AlatPendukung;
use App\Models\BidangKegiatan;
use App\Models\BlokRuangan;
use App\Models\Fasilitas;
use App\Models\Instansi;
use App\Models\Jadwal;
use App\Models\Jam;
use App\Models\Permohonan;
use App\Models\User;
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
        $fasilitas = DB::table('fasilitas')->get();
        // $curr = "2024-01-24";
        // $arr = [["2024-01-24", "10", "13"], ["2024-01-29", "09", "11"]];

        // $filteredData = [];

        // foreach ($arr as $data) {
        //     if ($data[0] === $curr) {
        //         $start = intval($data[1]);
        //         $end = intval($data[2]);

        //         $filteredData[] = array_map('strval', range($start, $end));
        //     }
        // }

        // $filteredData = array_merge(...$filteredData);
        // dd($filteredData);

        // $jadwals = Jadwal::all();

        // $jadwalArray = [];

        // foreach ($jadwals as $jadwal) {
        //     $jadwalArray[] = [
        //         $jadwal->tgl_mulai,
        //         $jadwal->jam_mulai,
        //         $jadwal->jam_selesai,
        //     ];
        // }

        // dd($jadwalArray);

        $date = Carbon::now()->format('Y-m-d');

        $jam_mulai = DB::table('jadwal')->get();
        $jadwalArray = [];

        if ($jam_mulai->count() > 0) {
            foreach ($jam_mulai as $jam) {
                $currJam[] = $jam->jam_mulai;
            }
            foreach ($jam_mulai as $jadwal) {
                $jadwalArray[] = [$jadwal->tgl_mulai, $jadwal->jam_mulai, $jadwal->jam_selesai];
            }
        } else {
            $jadwalArray = [];
        }

        // $tanggal_mulai = DB::table('jadwal')->select('tgl_mulai')->get();
        // $tanggal_mulai_arr = array();

        // if ($tanggal_mulai->count() > 0) {
        //     foreach ($tanggal_mulai as $tanggal) {
        //         $currDate[] = $tanggal->tgl_mulai;
        //     }
        // } else {
        //     $currDate = [];
        // }

        $jam_selesai = DB::table('jadwal')->select('jam_selesai')->get();
        $jam_selesai_arr = [];

        foreach ($jam_selesai as $jam) {
            $currJamSelesai[] = $jam->jam_selesai;
        }

        $tanggal_selesai = DB::table('jadwal')->select('tgl_selesai')->get();
        $tanggal_selesai_arr = [];

        foreach ($tanggal_selesai as $tanggal) {
            $currDateSelesai[] = $tanggal->tgl_selesai;
        }

        return view('user.dashboard', compact('date', 'jadwalArray', 'fasilitas'));
    }

    public function buatPermohonan()
    {
        $bidang = BidangKegiatan::get();
        $instansi = Instansi::get();
        $fasilitas = DB::table('fasilitas')->get();
        $alat = AlatPendukung::get();
        $blok = BlokRuangan::get();

        $date = Carbon::now()->format('m/d/Y');

        $jadwal = DB::table('jadwal')->join('permohonan', 'permohonan.id_permohonan', '=', 'jadwal.permohonan_id')->select('tgl_mulai', 'tgl_selesai', 'jam_mulai', 'jam_selesai', 'id_fasilitas', 'id_alat')->get();

        return view('user.buat-permohonan', compact('bidang', 'instansi', 'fasilitas', 'alat', 'jadwal', 'blok'));
    }

    public function buatPermohonanForm(Request $request)
    {
        // dd($request->id_fasilitas, $request->nama_fasilitas, $request->tgl_mulai, $request->jam_mulai, $request->tgl_selesai, $request->jam_selesai);

        $id_fasilitas = $request->id_fasilitas;
        $nama_fasilitas = $request->nama_fasilitas;
        $tgl_mulai = $request->tgl_mulai;
        $tgl_selesai = $request->tgl_selesai;
        $jam_mulai = $request->jam_mulai;
        $jam_selesai = $request->jam_selesai;

        $tgl_mulai_convert = Carbon::createFromFormat('Y-m-d', $tgl_mulai)->format('d M Y');
        $tgl_mulai_date_format = Carbon::createFromFormat('Y-m-d', $tgl_mulai);
        $tgl_mulai_day = $tgl_mulai_date_format->format('D');
        
        $tgl_selesai_convert = Carbon::createFromFormat('Y-m-d', $tgl_selesai)->format('d M Y');
        $tgl_selesai_date_format = Carbon::createFromFormat('Y-m-d', $tgl_selesai);
        $tgl_selesai_day = $tgl_selesai_date_format->format('D');

        if ($tgl_mulai_day === 'Mon') {
            $start_day = 'Sen';
        } elseif ($tgl_mulai_day === 'Tue') {
            $start_day = 'Sel';
        } elseif ($tgl_mulai_day === 'Wed') {
            $start_day = 'Rab';
        } elseif ($tgl_mulai_day === 'Thu') {
            $start_day = 'Kam';
        } elseif ($tgl_mulai_day === 'Fri') {
            $start_day = 'Jum';
        } elseif ($tgl_mulai_day === 'Sat') {
            $start_day = 'Sab';
        } elseif ($tgl_mulai_day === 'Sun') {
            $start_day = 'Ming';
        }

        if ($tgl_selesai_day === 'Mon') {
            $end_day = 'Sen';
        } elseif ($tgl_selesai_day === 'Tue') {
            $end_day = 'Sel';
        } elseif ($tgl_selesai_day === 'Wed') {
            $end_day = 'Rab';
        } elseif ($tgl_selesai_day === 'Thu') {
            $end_day = 'Kam';
        } elseif ($tgl_selesai_day === 'Fri') {
            $end_day = 'Jum';
        } elseif ($tgl_selesai_day === 'Sat') {
            $end_day = 'Sab';
        } elseif ($tgl_selesai_day === 'Sun') {
            $end_day = 'Ming';
        }

        $bidang = BidangKegiatan::get();
        $instansi = Instansi::get();
        $fasilitas = Fasilitas::get();
        $alat = AlatPendukung::get();
        $blok = BlokRuangan::get();

        $date = Carbon::now()->format('m/d/Y');

        $jadwal = DB::table('jadwal')->join('permohonan', 'permohonan.id_permohonan', '=', 'jadwal.permohonan_id')->select('tgl_mulai', 'tgl_selesai', 'jam_mulai', 'jam_selesai', 'id_fasilitas', 'id_alat')->get();

        return view('user.buat-permohonan-form', compact('bidang', 'instansi', 'fasilitas', 'alat', 'jadwal', 'blok', 'id_fasilitas', 'nama_fasilitas', 'tgl_mulai', 'tgl_selesai', 'tgl_mulai_day', 'tgl_mulai_convert', 'tgl_selesai_day', 'tgl_selesai_convert', 'jam_mulai', 'jam_selesai', 'start_day', 'end_day'));
    }

    public function editPermohonan($id_permohonan)
    {
        $fasilitas = DB::table('fasilitas')->get();
        $alat = DB::table('alat_pendukung')->get();
        $bidang = DB::table('bidang_kegiatan')->get();
        $instansi = DB::table('instansi')->get();

        $user_id = Auth::user()->id;

        $data = Permohonan::find($id_permohonan);

        $permohonan = DB::table('permohonan')->join('users', 'users.id', '=', 'permohonan.user_id')->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')->join('instansi', 'instansi.id_instansi', '=', 'permohonan.instansi_id')->join('fasilitas', 'fasilitas.id_fasilitas', '=', 'permohonan.id_fasilitas')->join('alat_pendukung', 'alat_pendukung.id_alat_pendukung', '=', 'permohonan.id_alat')->where('users.id', '=', $user_id)->where('permohonan.id_permohonan', '=', $id_permohonan)->first();

        return view('user.edit-permohonan', compact('permohonan', 'fasilitas', 'alat', 'data', 'bidang', 'instansi'));
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
                return redirect()->back()->with('sukses', 'Berhasil, file telah di upload');
            }
            //  return $data;
            return redirect()->back()->with('sukses', 'Error, file tidak dapat di upload');
        }
        //  return "Gagal";
        return redirect()->back()->with('sukses', 'Error, tidak ada file ditemukan');
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
                return redirect()->back()->with('sukses', 'Berhasil, file telah di upload');
            }
            //  return $data;
            return redirect()->back()->with('sukses', 'Error, file tidak dapat di upload');
        }
        //  return "Gagal";
        return redirect()->back()->with('sukses', 'Error, tidak ada file ditemukan');
    }

    public function lihatPermohonan($id_permohonan)
    {
        $permohonan = Permohonan::find($id_permohonan);
        $data = DB::table('permohonan')->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')->join('alat_pendukung', 'alat_pendukung.id_alat_pendukung', '=', 'permohonan.id_alat')->where('permohonan.id_permohonan', '=', $id_permohonan)->first();

        return view('user.lihat-permohonan', compact('permohonan', 'data'));
    }

    public function historiPermohonan()
    {
        $user_id = Auth::user()->id;

        $permohonan = DB::table('permohonan')->join('users', 'users.id', '=', 'permohonan.user_id')->join('bidang_kegiatan', 'bidang_kegiatan.id_bidang_kegiatan', '=', 'permohonan.bidang_id')->join('instansi', 'instansi.id_instansi', '=', 'permohonan.instansi_id')->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')->join('fasilitas', 'fasilitas.id_fasilitas', '=', 'permohonan.id_fasilitas')->join('alat_pendukung', 'alat_pendukung.id_alat_pendukung', '=', 'permohonan.id_alat')->where('users.id', '=', $user_id)->get();

        $user = Auth::user()->name;

        return view('user.histori-permohonan', compact('permohonan'));
    }

    public function lihatJadwal()
    {
        $firstDate = '1';
        $endDate = '29';

        $daysArray = [
            'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'
        ];

        $datesArray = range((int)$firstDate, (int)$endDate);

        $dates = [];
        foreach ($datesArray as $day) {
            $dayOfWeek = $daysArray[$day % 7];
            $dates[] = [
                'hari' => $dayOfWeek,
                'tanggal' => str_pad($day, 2, '0', STR_PAD_LEFT)
            ];
        }

        return view('user.lihat-jadwal', compact('dates'));
    }

    public function ambilJadwal($tanggal)
    {
        $data = DB::table('jadwal')->whereDay('tgl_mulai', $tanggal)->whereMonth('tgl_mulai', '02')->get();

        return view('user.lihat-jadwal', ['data' => $data]);
    }

    public function cekJadwal(Request $request)
    {
        $tgl_mulai = $request->tgl_mulai;
        $jam_mulai = $request->jam_mulai;
        $tgl_selesai = $request->tgl_selesai;
        $jam_selesai = $request->jam_selesai;

        dd($tgl_mulai, $jam_mulai, $tgl_selesai, $jam_selesai);
    }

    public function test() 
    {
        $currentMonth = Carbon::now()->format('m');
        $user_id = Auth::user()->id;
        $instansi = Instansi::get();

        $status_diterima = DB::table('permohonan')
                             ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                             ->where('status_permohonan', 'Diterima')
                             ->where('permohonan.user_id', $user_id)
                             ->count();
        
        $status_menunggu = DB::table('permohonan')
                            ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                            ->where('status_permohonan', 'Menunggu')
                            ->where('permohonan.user_id', $user_id)
                            ->count();
            
        $status_ditolak = DB::table('permohonan')
                            ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                            ->where('status_permohonan', 'Ditolak')
                            ->where('permohonan.user_id', $user_id)
                            ->count();
        
        $permohonan = DB::table('permohonan')
                          ->join('users', 'users.id', '=', 'permohonan.user_id')
                          ->join('bidang_kegiatan', 'bidang_kegiatan.id_bidang_kegiatan', '=', 'permohonan.bidang_id')
                          ->join('instansi', 'instansi.id_instansi', '=', 'permohonan.instansi_id')
                          ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                          ->join('fasilitas', 'fasilitas.id_fasilitas', '=', 'permohonan.id_fasilitas')
                          ->join('alat_pendukung', 'alat_pendukung.id_alat_pendukung', '=', 'permohonan.id_alat')
                          ->where('users.id', '=', $user_id)
                          ->get();
        
        $semua_permohonan = DB::table('permohonan')
                                ->join('users', 'users.id', '=', 'permohonan.user_id')
                                ->join('bidang_kegiatan', 'bidang_kegiatan.id_bidang_kegiatan', '=', 'permohonan.bidang_id')
                                ->join('instansi', 'instansi.id_instansi', '=', 'permohonan.instansi_id')
                                ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                                ->join('fasilitas', 'fasilitas.id_fasilitas', '=', 'permohonan.id_fasilitas')
                                ->join('alat_pendukung', 'alat_pendukung.id_alat_pendukung', '=', 'permohonan.id_alat')
                                ->where('users.id', '=', $user_id)
                                ->count();
        
        $permohonan_bulan_ini = DB::table('permohonan')
                                    ->join('users', 'users.id', '=', 'permohonan.user_id')
                                    ->join('bidang_kegiatan', 'bidang_kegiatan.id_bidang_kegiatan', '=', 'permohonan.bidang_id')
                                    ->join('instansi', 'instansi.id_instansi', '=', 'permohonan.instansi_id')
                                    ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                                    ->join('fasilitas', 'fasilitas.id_fasilitas', '=', 'permohonan.id_fasilitas')
                                    ->join('alat_pendukung', 'alat_pendukung.id_alat_pendukung', '=', 'permohonan.id_alat')
                                    ->whereMonth('permohonan.created_at', '=', $currentMonth)
                                    ->count();
        
        return view('user.test', compact('permohonan', 'permohonan_bulan_ini', 'semua_permohonan', 'status_diterima', 'status_menunggu', 'status_ditolak', 'instansi'));
    }

    public function ubahProfileSaya(Request $request)
    {
        $id = $request->id;
        $data = User::find($id);

        $data->name = $request->name;
        $data->instansi_id = $request->instansi_id;
        $data->update();

        return back()->with('sukses', 'Data Berhasil diubah!');
    }

    public function ubahPersonalInformation(Request $request)
    {
        $id = $request->id;
        $data = User::find($id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->no_telp = $request->no_telp;
        $data->alamat = $request->alamat;
        $data->update();

        return back()->with('sukses', 'Data Berhasil diubah!');
    }

    public function ubahInstansi(Request $request)
    {
        $id = $request->id;
        $data = User::find($id);

        $data->instansi_id = $request->instansi_id;
        $data->nama_organisasi = $request->nama_organisasi;
        $data->update();

        return back()->with('sukses', 'Data berhasil diubah!');
    }

    public function lihatJadwals()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $currentMonth = Carbon::now()->format('M');
        $currentMonthFullName = Carbon::now()->format('F');
        $currentMonthNum = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');

        if ($currentMonthFullName === 'January') {
            $month = 'Januari';
        } elseif ($currentMonthFullName === 'February') {
            $month = 'Februari';
        } elseif ($currentMonthFullName === 'March') {
            $month = 'Maret';
        } elseif ($currentMonthFullName === 'April') {
            $month = 'April';
        } elseif ($currentMonthFullName === 'May') {
            $month = 'Mei';
        } elseif ($currentMonthFullName === 'June') {
            $month = 'Juni';
        } elseif ($currentMonthFullName === 'July') {
            $month = 'Juli';
        } elseif ($currentMonthFullName === 'August') {
            $month = 'Agustus';
        } elseif ($currentMonthFullName === 'September') {
            $month = 'September';
        } elseif ($currentMonthFullName === 'October') {
            $month = 'Oktober';
        } elseif ($currentMonthFullName === 'November') {
            $month = 'November';
        } elseif ($currentMonthFullName === 'December') {
            $month = 'Desember';
        }

        $jadwal = DB::table('permohonan')
                    ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                    ->join('users', 'users.id', '=', 'permohonan.user_id')
                    ->join('fasilitas', 'fasilitas.id_fasilitas', '=', 'permohonan.id_fasilitas')
                    ->whereDate('tgl_mulai', '>=', $currentDate)
                    ->get();

        $startDate = Carbon::now()->format('d');
        $endDate = Carbon::now()->endOfMonth()->format('d');

        $day = array_map('strval', range($startDate, $endDate));

        $currentJadwal = DB::table('permohonan')
                            ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                            ->join('users', 'users.id', '=', 'permohonan.user_id')
                            ->join('fasilitas', 'fasilitas.id_fasilitas', '=', 'permohonan.id_fasilitas')
                            ->where('tgl_mulai', '=', $currentDate)
                            ->get();

        // =========================================== MULTIMEDIA ===========================================
        $room = 'Multimedia';

        $resultArray = $currentJadwal->map(function ($jadwal) {
            return [
                $jadwal->nama_fasilitas,
                $jadwal->tgl_mulai,
                $jadwal->tgl_selesai,
                $jadwal->jam_mulai,
                $jadwal->jam_selesai,
            ];
        })->toArray();
                    
        $matchingDateItems = collect($resultArray)->filter(function ($item) use ($room, $currentDate) {
            return $item[0] === $room && ($item[1] === $currentDate || $item[2] === $currentDate);
        });
                    
        $uniqueValues = collect();
                    
        if ($matchingDateItems->count() > 0) {
            $matchingDateItems->each(function ($item) use ($currentDate, &$uniqueValues) {
                $index1 = (int)$item[3];
                $index2 = (int)$item[4];
                    
                if ($item[1] === $currentDate && $item[2] === $currentDate) {
                    for ($i = $index1; $i <= $index2; $i++) {
                        $uniqueValues->add(str_pad($i, 2, "0", STR_PAD_LEFT));
                    }
                } elseif ($item[1] === $currentDate) {
                    for ($i = $index1; $i <= 17; $i++) {
                        $uniqueValues->add(str_pad($i, 2, "0", STR_PAD_LEFT));
                    }
                } elseif ($item[2] === $currentDate) {
                    for ($i = 8; $i <= $index2; $i++) {
                        $uniqueValues->add(str_pad($i, 2, "0", STR_PAD_LEFT));
                    }
                }
            });
                    
            $newArray = $uniqueValues->sort()->values()->toArray();
        } else {
            $newArray = [];
        }
        
        // =========================================== AULA ===========================================
        $roomAula = 'Aula';

        $resultArrayAula = $currentJadwal->map(function ($jadwal) {
            return [
                $jadwal->nama_fasilitas,
                $jadwal->tgl_mulai,
                $jadwal->tgl_selesai,
                $jadwal->jam_mulai,
                $jadwal->jam_selesai,
            ];
        })->toArray();
                    
        $matchingDateItemsAula = collect($resultArrayAula)->filter(function ($item) use ($roomAula, $currentDate) {
            return $item[0] === $roomAula && ($item[1] === $currentDate || $item[2] === $currentDate);
        });
                    
        $uniqueValuesAula = collect();
                    
        if ($matchingDateItemsAula->count() > 0) {
            $matchingDateItemsAula->each(function ($item) use ($currentDate, &$uniqueValuesAula) {
                $index1Aula = (int)$item[3];
                $index2Aula = (int)$item[4];
                    
                if ($item[1] === $currentDate && $item[2] === $currentDate) {
                    for ($i = $index1Aula; $i <= $index2Aula; $i++) {
                        $uniqueValuesAula->add(str_pad($i, 2, "0", STR_PAD_LEFT));
                    }
                } elseif ($item[1] === $currentDate) {
                    for ($i = $index1Aula; $i <= 17; $i++) {
                        $uniqueValuesAula->add(str_pad($i, 2, "0", STR_PAD_LEFT));
                    }
                } elseif ($item[2] === $currentDate) {
                    for ($i = 8; $i <= $index2Aula; $i++) {
                        $uniqueValuesAula->add(str_pad($i, 2, "0", STR_PAD_LEFT));
                    }
                }
            });
                    
            $newArrayAula = $uniqueValuesAula->sort()->values()->toArray();
        } else {
            $newArrayAula = [];
        }


        return view('user.jadwals', compact('jadwal', 'day', 'month', 'currentMonth', 'currentMonthNum', 'currentYear', 'currentJadwal', 'newArray', 'newArrayAula'));
    }
}
