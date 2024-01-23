<?php

namespace App\Http\Controllers;

use App\Models\AlatPendukung;
use App\Models\BidangKegiatan;
use App\Models\BlokRuangan;
use App\Models\Fasilitas;
use App\Models\Instansi;
use App\Models\Permohonan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class CRUDController extends Controller
{
    public function index_jadwal()
    {
        return view('super-admin.data-jadwal');
    }

    // ============= FASILITAS =============

    public function index_fasilitas()
    {
        $fasilitas = Fasilitas::get();
        $user = auth::user()->name;

        if ($user == 'Admin') {
            return view('admin.data-fasilitas', compact('fasilitas'));
        } elseif ($user == 'Super Admin') {
            return view('super-admin.data-fasilitas', compact('fasilitas'));
        }
    }

    public function simpan_fasilitas(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:doc,docx,xls,xlsx,pdf,jpg,jpeg,png,bmp',
        ]);

        if ($request->hasFile('file')) {
            $uploadPath = public_path('foto_fasilitas');

            if (!File::isDirectory($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true, true);
            }

            $file = $request->file('file');
            $explode = explode('.', $file->getClientOriginalName());
            $originalName = $explode[0];
            $extension = $file->getClientOriginalExtension();
            $rename = 'file_' . date('YmdHis') . '.' . $extension;
            $mime = $file->getClientMimeType();
            $filesize = $file->getSize();
            $nama_fasilitas = $request->nama_fasilitas;

            if ($file->move($uploadPath, $rename)) {
                $media = new Fasilitas();
                $media->nama_fasilitas = $nama_fasilitas;
                $media->nama = $originalName;
                $media->file = $rename;
                $media->extension = $extension;
                $media->size = $filesize;
                $media->mime = $mime;
                $media->save();

                return redirect()
                    ->back()
                    ->with('sukses', 'Berhasil, file telah di upload');
            }

            return redirect()
                ->back()
                ->with('sukses', 'Error, file tidak dapat di upload');
        }

        return redirect()
            ->back()
            ->with('sukses', 'Error, tidak ada file ditemukan');
    }

    public function ubah_fasilitas(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:doc,docx,xls,xlsx,pdf,jpg,jpeg,png,bmp',
        ]);

        if ($request->hasFile('file')) {
            $uploadPath = public_path('foto_fasilitas');

            if (!File::isDirectory($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true, true);
            }

            $file = $request->file('file');
            $explode = explode('.', $file->getClientOriginalName());
            $originalName = $explode[0];
            $extension = $file->getClientOriginalExtension();
            $rename = 'file_' . date('YmdHis') . '.' . $extension;
            $mime = $file->getClientMimeType();
            $filesize = $file->getSize();
            $nama_fasilitas = $request->nama_fasilitas;

            if ($file->move($uploadPath, $rename)) {
                $id_fasilitas = $request->id_fasilitas;
                $fasilitas = Fasilitas::find($id_fasilitas);
                $fasilitas->nama_fasilitas = $nama_fasilitas;
                $fasilitas->nama = $originalName;
                $fasilitas->file = $rename;
                $fasilitas->extension = $extension;
                $fasilitas->size = $filesize;
                $fasilitas->mime = $mime;
                $fasilitas->update();

                return redirect()
                    ->back()
                    ->with('sukses', 'Berhasil, file telah di upload');
            }
            
            return redirect()
                ->back()
                ->with('sukses', 'Error, file tidak dapat di upload');
        }

        return redirect()
            ->back()
            ->with('sukses', 'Error, tidak ada file ditemukan');
    }

    public function hapus_fasilitas($id_fasilitas)
    {
        $data = Fasilitas::find($id_fasilitas);
        $data->delete();
        return redirect()
            ->back()
            ->with('sukses', 'Data Berhasil dihapus!');
    }

    // ============= ADMIN =============
    public function index_admin()
    {
        $users = User::where('name', 'LIKE', 'Admin%')->get();

        $user = auth::user()->name;

        if ($user == 'Admin') {
            return view('admin.data-admin', compact('users'));
        } elseif ($user == 'Super Admin') {
            return view('super-admin.data-admin', compact('users'));
        }
    }

    public function simpan_admin(Request $request)
    {
        $data = new User();
        $user = auth::user()->name;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();

        $data->assignRole('admin');

        if ($user == 'Admin') {
            return redirect('admin/admin')->with('sukses', 'Data Berhasil ditambahkan!');
        } elseif ($user == 'Super Admin') {
            return redirect('superadmin/admin')->with('sukses', 'Data Berhasil ditambahkan!');
        }
    }

    public function lihat_admin($id)
    {
        $user = User::find($id);

        $role = auth::user()->name;

        if ($role == 'Admin') {
            return view('admin.lihat-users', compact('user'));
        } elseif ($role == 'Super Admin') {
            return view('super-admin.lihat-users', compact('user'));
        }
    }

    public function hapus_admin($id)
    {
        $data = User::find($id);
        $user = auth::user()->name;
        $data->delete();

        if ($user == 'Admin') {
            return redirect('admin/admin')->with('sukses', 'Data Berhasil dihapus!');
        } elseif ($user == 'Super Admin') {
            return redirect('superadmin/admin')->with('sukses', 'Data Berhasil dihapus!');
        }
    }

    public function ubah_admin(Request $request)
    {
        $id = $request->id;
        $data = User::find($id);
        $user = auth::user()->name;

        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $simpan = $data->update();

        $data->assignRole('admin');

        if ($user == 'Admin') {
            return redirect('admin/users')->with('sukses', 'Data Berhasil diubah!');
        } elseif ($user == 'Super Admin') {
            return redirect('superadmin/users')->with('sukses', 'Data Berhasil diubah!');
        }
    }

    // ============= USERS =============
    public function index_users()
    {
        $users = User::whereNotIn('name', ['Admin', 'Super Admin'])
            ->latest()
            ->paginate(10);

        $user = auth::user()->name;

        if ($user == 'Admin') {
            return view('admin.data-users', compact('users'));
        } elseif ($user == 'Super Admin') {
            return view('super-admin.data-users', compact('users'));
        }
    }

    public function lihat_users($id)
    {
        $user = User::find($id);

        $role = auth::user()->name;

        if ($role == 'Admin') {
            return view('admin.lihat-users', compact('user'));
        } elseif ($role == 'Super Admin') {
            return view('super-admin.lihat-users', compact('user'));
        }
    }

    public function hapus_users($id)
    {
        $data = User::find($id);
        $user = auth::user()->name;
        $data->delete();

        if ($user == 'Admin') {
            return redirect('admin/users')->with('sukses', 'Data Berhasil dihapus!');
        } elseif ($user == 'Super Admin') {
            return redirect('superadmin/users')->with('sukses', 'Data Berhasil dihapus!');
        }
    }

    public function ubah_users(Request $request, $id)
    {
        $data = User::find($id);
        $user = auth::user()->name;

        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->instansi_id = $request->instansi_id;
        $data->nik = $request->nik;
        $data->no_telp = $request->no_telp;
        $data->alamat = $request->alamat;
        $data->nama_organisasi = $request->nama_organisasi;
        $simpan = $data->update();

        if ($user == 'Admin') {
            return redirect('admin/users')->with('sukses', 'Data Berhasil diubah!');
        } elseif ($user == 'Super Admin') {
            return redirect('superadmin/users')->with('sukses', 'Data Berhasil diubah!');
        }
    }

    // ============= INSTANSI =============

    public function index_instansi()
    {
        $instansi = Instansi::get();
        $user = auth::user()->name;

        if ($user == 'Admin') {
            return view('admin.data-instansi', compact('instansi'));
        } elseif ($user == 'Super Admin') {
            return view('super-admin.data-instansi', compact('instansi'));
        }
    }

    public function simpan_instansi(Request $request)
    {
        $data = new Instansi();
        $user = auth::user()->name;
        $data->nama_instansi = $request->nama_instansi;
        $data->alamat_instansi = $request->alamat_instansi;
        $data->save();

        if ($user == 'Admin') {
            return redirect('admin/instansi')->with('sukses', 'Data Berhasil ditambahkan!');
        } elseif ($user == 'Super Admin') {
            return redirect('superadmin/instansi')->with('sukses', 'Data Berhasil ditambahkan!');
        }
    }

    public function hapus_instansi($id_instansi)
    {
        $data = Instansi::find($id_instansi);
        $user = auth::user()->name;
        $data->delete();

        if ($user == 'Admin') {
            return redirect('admin/instansi')->with('sukses', 'Data Berhasil dihapus!');
        } elseif ($user == 'Super Admin') {
            return redirect('superadmin/instansi')->with('sukses', 'Data Berhasil dihapus!');
        }
    }

    public function ubah_instansi(Request $request)
    {
        $id_instansi = $request->id_instansi;
        $user = auth::user()->name;
        $data = Instansi::find($id_instansi);
        $data->nama_instansi = $request->nama_instansi;
        $data->alamat_instansi = $request->alamat_instansi;
        $simpan = $data->update();

        if ($user == 'Admin') {
            return redirect('admin/instansi')->with('sukses', 'Data Berhasil dihapus!');
        } elseif ($user == 'Super Admin') {
            return redirect('superadmin/instansi')->with('sukses', 'Data Berhasil dihapus!');
        }
    }

    // ============= ALAT PENDUKUNG =============
    public function index_alat()
    {
        $alat = AlatPendukung::get();
        $user = auth::user()->name;

        if ($user == 'Admin') {
            return view('admin.data-alat-pendukung', compact('alat'));
        } elseif ($user == 'Super Admin') {
            return view('super-admin.data-alat-pendukung', compact('alat'));
        }
    }

    public function simpan_alat(Request $request)
    {
        $data = new AlatPendukung();
        $user = auth::user()->name;
        $data->nama_alat = $request->nama_alat;
        $data->save();

        if ($user == 'Admin') {
            return redirect('admin/alat-pendukung')->with('sukses', 'Data Berhasil ditambahkan!');
        } elseif ($user == 'Super Admin') {
            return redirect('superadmin/alat-pendukung')->with('sukses', 'Data Berhasil ditambahkan!');
        }
    }

    public function hapus_alat($id_alat_pendukung)
    {
        $data = AlatPendukung::find($id_alat_pendukung);
        $user = auth::user()->name;
        $data->delete();

        if ($user == 'Admin') {
            return redirect('admin/alat-pendukung')->with('sukses', 'Data Berhasil ditambahkan!');
        } elseif ($user == 'Super Admin') {
            return redirect('superadmin/alat-pendukung')->with('sukses', 'Data Berhasil ditambahkan!');
        }
    }

    public function ubah_alat(Request $request)
    {
        $id_alat_pendukung = $request->id_alat_pendukung;
        $user = auth::user()->name;
        $data = AlatPendukung::find($id_alat_pendukung);
        $data->nama_alat = $request->nama_alat;
        $simpan = $data->update();

        if ($user == 'Admin') {
            return redirect('admin/alat-pendukung')->with('sukses', 'Data Berhasil ditambahkan!');
        } elseif ($user == 'Super Admin') {
            return redirect('superadmin/alat-pendukung')->with('sukses', 'Data Berhasil ditambahkan!');
        }
    }

    // ============= BLOK RUANGAN =============
    public function index_blok_ruangan()
    {
        $ruangan = BlokRuangan::get();
        $user = auth::user()->name;

        if ($user == 'Admin') {
            return view('admin.data-blok-ruangan', compact('ruangan'));
        } elseif ($user == 'Super Admin') {
            return view('super-admin.data-blok-ruangan', compact('ruangan'));
        }
    }

    public function simpan_blok_ruangan(Request $request)
    {
        $data = new BlokRuangan();
        $user = auth::user()->name;
        $data->tgl_mulai = $request->tgl_mulai;
        $data->tgl_selesai = $request->tgl_selesai;
        $data->keterangan = $request->keterangan;
        $data->fasilitas_id = $request->fasilitas_id;
        $data->save();

        if ($user == 'Admin') {
            return redirect('admin/blok-ruangan')->with('sukses', 'Data Berhasil ditambahkan!');
        } elseif ($user == 'Super Admin') {
            return redirect('superadmin/blok-ruangan')->with('sukses', 'Data Berhasil ditambahkan!');
        }
    }

    public function hapus_blok_ruangan($id_blok_ruangan)
    {
        $data = BlokRuangan::find($id_blok_ruangan);
        $user = auth::user()->name;
        $data->delete();

        if ($user == 'Admin') {
            return redirect('admin/blok-ruangan')->with('sukses', 'Data Berhasil dihapus!');
        } elseif ($user == 'Super Admin') {
            return redirect('superadmin/blok-ruangan')->with('sukses', 'Data Berhasil dihapus!');
        }
    }

    public function ubah_blok_ruangan(Request $request)
    {
        $id_blok_ruangan = $request->id_blok_ruangan;
        $user = auth::user()->name;
        $data = BidangKegiatan::find($id_blok_ruangan);
        $data->tgl_mulai = $request->tgl_mulai;
        $data->tgl_selesai = $request->tgl_selesai;
        $data->keterangan = $request->keterangan;
        $data->fasilitas_id = $request->fasilitas_id;
        $simpan = $data->update();

        if ($user == 'Admin') {
            return redirect('admin/blok-ruangan')->with('sukses', 'Data Berhasil diubah!');
        } elseif ($user == 'Super Admin') {
            return redirect('superadmin/blok-ruangan')->with('sukses', 'Data Berhasil diubah!');
        }
    }

    // ============= BIDANG KEGIATAN =============
    public function index_bidang_kegiatan()
    {
        $bidang = BidangKegiatan::get();
        $user = auth::user()->name;

        if ($user == 'Admin') {
            return view('admin.data-bidang-kegiatan', compact('bidang'));
        } elseif ($user == 'Super Admin') {
            return view('super-admin.data-bidang-kegiatan', compact('bidang'));
        }
    }

    public function simpan_bidang_kegiatan(Request $request)
    {
        $data = new BidangKegiatan();
        $user = auth::user()->name;
        $data->nama_bidang = $request->nama_bidang;
        $data->save();

        if ($user == 'Admin') {
            return redirect('admin/bidang-kegiatan')->with('sukses', 'Data Berhasil ditambahkan!');
        } elseif ($user == 'Super Admin') {
            return redirect('superadmin/bidang-kegiatan')->with('sukses', 'Data Berhasil ditambahkan!');
        }
    }

    public function hapus_bidang_kegiatan($id_bidang_kegiatan)
    {
        $data = BidangKegiatan::find($id_bidang_kegiatan);
        $user = auth::user()->name;
        $data->delete();

        if ($user == 'Admin') {
            return redirect('admin/bidang-kegiatan')->with('sukses', 'Data Berhasil ditambahkan!');
        } elseif ($user == 'Super Admin') {
            return redirect('superadmin/bidang-kegiatan')->with('sukses', 'Data Berhasil ditambahkan!');
        }
    }

    public function ubah_bidang_kegiatan(Request $request)
    {
        $id_bidang_kegiatan = $request->id_bidang_kegiatan;
        $user = auth::user()->name;
        $data = BidangKegiatan::find($id_bidang_kegiatan);
        $data->nama_bidang = $request->nama_bidang;
        $simpan = $data->update();

        if ($user == 'Admin') {
            return redirect('admin/bidang-kegiatan')->with('sukses', 'Data Berhasil ditambahkan!');
        } elseif ($user == 'Super Admin') {
            return redirect('superadmin/bidang-kegiatan')->with('sukses', 'Data Berhasil ditambahkan!');
        }
    }

    public function history_permohonan()
    {
        $date = Carbon::now()->format('Y-m-d');
        $permohonan_date = DB::table('permohonan')
            ->select('created_at')
            ->get();
        // $jadwal_date = DB::table('jadwal')
        //     ->select('created_at')
        //     ->get();

        foreach ($permohonan_date as $permohonan) {
            $permohonan_current_date = $permohonan->created_at;
        }

        // foreach ($jadwal_date as $jadwal) {
        //     $jadwal_current_date = $jadwal->created_at;
        // }

        $tes = Carbon::parse($permohonan_current_date)->format('Y-m-d');
        // $tes2 = Carbon::parse($jadwal_current_date)->format('Y-m-d');

        $permohonan = DB::table('permohonan')
            ->join('users', 'users.id', '=', 'permohonan.user_id')
            ->join('bidang_kegiatan', 'bidang_kegiatan.id_bidang_kegiatan', '=', 'permohonan.bidang_id')
            ->join('instansi', 'instansi.id_instansi', '=', 'permohonan.instansi_id')
            ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
            ->join('fasilitas', 'fasilitas.id_fasilitas', '=', 'permohonan.id_fasilitas')
            ->join('alat_pendukung', 'alat_pendukung.id_alat_pendukung', '=', 'permohonan.id_alat')
            ->get();

        return view('super-admin.histori-permohonan', compact('permohonan'));
    }

    public function hapus_permohonan($id_permohonan)
    {
        $data = Permohonan::find($id_permohonan);
        $data->delete();
        return redirect()
            ->back()
            ->with('sukses', 'Data Berhasil dihapus!');
    }
}
