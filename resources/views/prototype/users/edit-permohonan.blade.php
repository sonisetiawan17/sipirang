@extends('layouts.user')

@section('title', 'Data Permohonan')

@push('css')
    <link href="/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
    <link href="/assets/plugins/datatables.net-select-bs4/css/select.bootstrap4.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="mt-3 mb-4">
        <h1 class="text-xl font-semibold text-neutral-700">Edit Permohonan</h1>
    </div>
    <div class="px-8 sm:px-0">
        <div>
            <div role="tablist" aria-label="tabs"
                class="shadow-900/20 relative grid h-12 w-[60%] grid-cols-4 items-center overflow-hidden bg-neutral-200 px-[3px] shadow-2xl transition">
                <div class="indicator absolute top-0 bottom-0 left-0 my-auto h-10 rounded bg-white shadow-md"></div>
                <button role="tab" aria-selected="true" aria-controls="panel-1" id="tab-1" tabindex="-1"
                    class="tab relative block h-10 rounded px-6 border-none focus:border-none">
                    <span class="text-gray-800">Identitas Pemohon</span>
                </button>
                <button role="tab" aria-selected="false" aria-controls="panel-2" id="tab-2" tabindex="-1"
                    class="tab relative block h-10 rounded px-6">
                    <span class="text-gray-800">Kegiatan</span>
                </button>
                <button role="tab" aria-selected="false" aria-controls="panel-3" id="tab-3" tabindex="-1"
                    class="tab relative block h-10 rounded px-6">
                    <span class="text-gray-800">Peminjaman</span>
                </button>
                <button role="tab" aria-selected="false" aria-controls="panel-4" id="tab-4" tabindex="-1"
                    class="tab relative block h-10 rounded px-6">
                    <span class="text-gray-800">Status</span>
                </button>
            </div>
            <div class="relative bg-white w-full">
                <form action="{{ route('user.updatePermohonan', $permohonan->id_permohonan) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div role="tabpanel" id="panel-1" class="tab-panel p-6 transition duration-300">
                        <div>
                            <div class="form-group row mb-0">
                                <label class="col-lg-4 col-form-label">SKPD/Non SKPD <sup class="text-red">*</sup></label>
                                <div class="col-lg-8">
                                    <select class="form-input w-full text-small" name="skpd"
                                        value="{{ old('skpd', $permohonan->skpd) }}">
                                        <option disabled selected>-- Pilih Bidang SKPD --</option>
                                        <option value="skpd" {{ $permohonan->skpd == 'skpd' ? 'selected' : '' }}>SKPD
                                        </option>
                                        <option value="non_skpd" {{ $permohonan->skpd == 'non_skpd' ? 'selected' : '' }}>NON
                                            SKPD
                                        </option>
                                    </select>
                                </div>

                                <label class="col-lg-4 col-form-label mt-3">Bidang Kegiatan <sup
                                        class="text-red">*</sup></label>
                                <div class="col-lg-8 mt-3">
                                    <select class="form-input w-full text-small" name="bidang_id"
                                        value="{{ old('bidang_id', $permohonan->bidang_id) }}">
                                        <option disabled selected>-- Pilih Bidang Kegiatan --</option>
                                        <option value="1" {{ $permohonan->bidang_id == '1' ? 'selected' : '' }}>
                                            Bidang 1
                                        </option>
                                        <option value="2" {{ $permohonan->bidang_id == '2' ? 'selected' : '' }}>
                                            Bidang 2
                                        </option>
                                        <option value="3" {{ $permohonan->bidang_id == '3' ? 'selected' : '' }}>
                                            Bidang 3
                                        </option>
                                    </select>
                                </div>

                                <label class="col-lg-4 col-form-label mt-3">No KTP <sup class="text-red">*</sup></label>
                                <div class="col-lg-8 mt-3">
                                    <input type="text" id="nik" name="nik"
                                        value="{{ old('nik', $permohonan->nik) }}"
                                        class="form-control form-input text-small" style="width:100%;" disabled>
                                </div>

                                {{-- <label class="col-lg-4 col-form-label mt-3">ID User <sup
                                        class="text-red">*</sup></label>
                                <div class="col-lg-8 mt-3">
                                    <input type="text" id="user_id" name="user_id"
                                        value="{{ Auth::user()->id }}"
                                        class="form-control form-input text-small" style="width:100%;" disabled>
                                </div> --}}

                                <label class="col-lg-4 col-form-label mt-3">Nama Pemohon <sup
                                        class="text-red">*</sup></label>
                                <div class="col-lg-8 mt-3">
                                    <input type="text" id="name" name="name"
                                        value="{{ old('name', $permohonan->name) }}"
                                        class="form-control form-input text-small" style="width:100%;" disabled>
                                </div>

                                <label class="col-lg-4 col-form-label mt-3">No Telepon <sup class="text-red">*</sup></label>
                                <div class="col-lg-8 mt-3">
                                    <input type="text" id="no_telp" name="no_telp"
                                        value="{{ old('no_telp', $permohonan->no_telp) }}"
                                        class="form-control form-input text-small" style="width:100%;" disabled>
                                </div>

                                <label class="col-lg-4 col-form-label mt-3">Alamat Lengkap <sup
                                        class="text-red">*</sup></label>
                                <div class="col-lg-8 mt-3">
                                    <input type="text" id="alamat" name="alamat"
                                        value="{{ old('alamat', $permohonan->alamat) }}"
                                        class="form-control form-input text-small" style="width:100%;" disabled>
                                </div>

                                <label class="col-lg-4 col-form-label mt-3">Nama Instansi/Pribadi <sup
                                        class="text-red">*</sup></label>
                                <div class="col-lg-8 mt-3">
                                    <select class="form-input w-full text-small" name="instansi_id"
                                        value="{{ old('instansi_id', $permohonan->instansi_id) }}">
                                        <option disabled selected>-- Pilih Bidang Kegiatan --</option>
                                        <option value="1" {{ $permohonan->instansi_id == '1' ? 'selected' : '' }}>
                                            Bappenda
                                        </option>
                                        <option value="2" {{ $permohonan->instansi_id == '2' ? 'selected' : '' }}>
                                            DPMPTSP
                                        </option>
                                        <option value="3" {{ $permohonan->instansi_id == '3' ? 'selected' : '' }}>
                                            Disdukcapil
                                        </option>
                                    </select>
                                </div>

                                <label class="col-lg-4 col-form-label mt-3">Status dalam Instansi/Pribadi <sup
                                        class="text-red">*</sup></label>
                                <div class="col-lg-8 mt-3">
                                    <input type="text" id="status_instansi" name="status_instansi"
                                        value="{{ old('status_instansi', $permohonan->status_instansi) }}"
                                        class="form-control form-input text-small" style="width:100%;">
                                </div>

                                <label class="col-lg-4 col-form-label mt-3">Bidang Instansi/Pribadi <sup
                                        class="text-red">*</sup></label>
                                <div class="col-lg-8 mt-3">
                                    <input type="text" id="bidang_instansi" name="bidang_instansi"
                                        value="{{ old('bidang_instansi', $permohonan->bidang_instansi) }}"
                                        class="form-control form-input text-small" style="width:100%;">
                                </div>

                                <label class="col-lg-4 col-form-label mt-3">Alamat Instansi/Pribadi <sup
                                        class="text-red">*</sup></label>
                                <div class="col-lg-8 mt-3">
                                    <input type="text" id="alamat_instansi" name="alamat_instansi"
                                        value="{{ old('alamat_instansi', $permohonan->alamat_instansi) }}"
                                        class="form-control form-input text-small" style="width:100%;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div role="tabpanel" id="panel-2"
                        class="tab-panel invisible absolute top-0 p-6 opacity-0 transition duration-300">
                        <div class="form-group row mb-0">
                            <label class="col-lg-4 col-form-label">Nama Kegiatan <sup class="text-red">*</sup></label>
                            <div class="col-lg-8">
                                <input type="text" id="nama_kegiatan" name="nama_kegiatan"
                                    value="{{ old('nama_kegiatan', $permohonan->nama_kegiatan) }}"
                                    class="form-control form-input text-small" style="width:100%;">
                            </div>

                            <label class="col-lg-4 col-form-label mt-3">Jumlah Peserta <sup
                                    class="text-red">*</sup></label>
                            <div class="col-lg-8 mt-3">
                                <input type="text" id="jumlah_peserta" name="jumlah_peserta"
                                    value="{{ old('jumlah_peserta', $permohonan->jumlah_peserta) }}"
                                    class="form-control form-input text-small" style="width:100%;">
                            </div>

                            <label class="col-lg-4 col-form-label mt-3">Narasumber <sup class="text-red">*</sup></label>
                            <div class="col-lg-8 mt-3">
                                <input type="text" id="narasumber" name="narasumber"
                                    value="{{ old('narasumber', $permohonan->narasumber) }}"
                                    class="form-control form-input text-small" style="width:100%;">
                            </div>

                            <label class="col-lg-4 col-form-label mt-3">Ringkasan <sup class="text-red">*</sup></label>
                            <div class="col-lg-8 mt-3">
                                <input type="text" id="ringkasan" name="ringkasan"
                                    value="{{ old('ringkasan', $permohonan->ringkasan) }}"
                                    class="form-control form-input text-small" style="width:100%;">
                            </div>

                            <label class="col-lg-4 col-form-label mt-3">Surat Permohonan <sup
                                    class="text-red">*</sup></label>
                            <div class="col-lg-8 mt-3">
                                <input type="file" name="surat_permohonan" id="surat_permohonan"
                                    class="block w-full border border-gray-200 text-small focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none file:bg-gray-50 file:border-0 file:me-4 file:py-2 file:px-4">
                            </div>

                            <label class="col-lg-4 col-form-label mt-3">Rundown Acara <sup
                                    class="text-red">*</sup></label>
                            <div class="col-lg-8 mt-3">
                                <input type="file" name="rundown_acara" id="rundown_acara"
                                    class="block w-full border border-gray-200 text-small focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none file:bg-gray-50 file:border-0 file:me-4 file:py-2 file:px-4">
                            </div>

                            <label class="col-lg-4 col-form-label mt-3">Output (Optional)</label>
                            <div class="col-lg-8 mt-3">
                                <input type="text" id="output" name="output"
                                    value="{{ old('output', $permohonan->output) }}"
                                    class="form-control form-input text-small" style="width:100%;">
                            </div>

                            <label class="col-lg-4 col-form-label mt-3">Outcome (Optional)</label>
                            <div class="col-lg-8 mt-3">
                                <input type="text" id="outcome" name="outcome"
                                    value="{{ old('outcome', $permohonan->outcome) }}"
                                    class="form-control form-input text-small" style="width:100%;">
                            </div>
                        </div>
                    </div>

                    <div role="tabpanel" id="panel-3"
                        class="tab-panel invisible absolute top-0 p-6 opacity-0 transition duration-300 w-full bg-white">
                        <div class="mb-[30px]">
                            <h3 class="text-lg font-semibold text-neutral-600">Waktu dan Durasi Peminjaman</h3>
                        </div>

                        <div class="form-group row mb-0">
                            <label class="col-lg-4 col-form-label">Tanggal Mulai <sup class="text-red">*</sup></label>
                            <div class="col-lg-3">
                                <input type="date" class="form-control form-input text-small" name="tgl_mulai"
                                    value="{{ old('tgl_mulai', $permohonan->tgl_mulai) }}" />
                            </div>
                        </div>

                        <div class="form-group row mb-0 mt-3">
                            <label class="col-lg-4 col-form-label">Jam Mulai <sup class="text-red">*</sup></label>
                            <div class="col-lg-6">
                                <div class="btn-group">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-white">
                                            <input type="radio" name="jam_mulai" value="8"
                                                {{ $permohonan->jam_mulai == '1' ? 'selected' : '' }}
                                                id="8" />08:00
                                        </label>
                                        <label class="btn btn-white">
                                            <input type="radio" name="jam_mulai" value="9"
                                                {{ $permohonan->jam_mulai == '9' ? 'checked' : '' }}
                                                id="9" />09:00
                                        </label>
                                        <label class="btn btn-white">
                                            <input type="radio" name="jam_mulai" value="10"
                                                {{ $permohonan->jam_mulai == '10' ? 'checked' : '' }}
                                                id="10" />10:00
                                        </label>
                                        <label class="btn btn-white">
                                            <input type="radio" name="jam_mulai" value="11"
                                                {{ $permohonan->jam_mulai == '11' ? 'checked' : '' }}
                                                id="11" />11:00
                                        </label>
                                        <label class="btn btn-white">
                                            <input type="radio" name="jam_mulai" value="12"
                                                {{ $permohonan->jam_mulai == '12' ? 'checked' : '' }}
                                                id="12" />12:00
                                        </label>
                                        <label class="btn btn-white">
                                            <input type="radio" name="jam_mulai" value="13"
                                                {{ $permohonan->jam_mulai == '13' ? 'checked' : '' }}
                                                id="13" />13:00
                                        </label>
                                        <label class="btn btn-white">
                                            <input type="radio" name="jam_mulai" value="14"
                                                {{ $permohonan->jam_mulai == '14' ? 'checked' : '' }}
                                                id="14" />14:00
                                        </label>
                                        <label class="btn btn-white">
                                            <input type="radio" name="jam_mulai" value="15"
                                                {{ $permohonan->jam_mulai == '15' ? 'checked' : '' }}
                                                id="15" />15:00
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0 mt-3">
                            <label class="col-lg-4 col-form-label">Tanggal Selesai <sup class="text-red">*</sup></label>
                            <div class="col-lg-3">
                                <input type="date" class="form-control form-input text-small" name="tgl_selesai"
                                    value="{{ old('tgl_selesai', $permohonan->tgl_selesai) }}" />
                            </div>
                        </div>

                        <div class="form-group row mb-0 mt-3">
                            <label class="col-lg-4 col-form-label">Jam Selesai <sup class="text-red">*</sup></label>
                            <div class="col-lg-6">
                                <div class="btn-group">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-white">
                                            <input type="radio" name="jam_selesai" value="8"
                                                {{ $permohonan->jam_selesai == '1' ? 'selected' : '' }}
                                                id="8" />08:00
                                        </label>
                                        <label class="btn btn-white">
                                            <input type="radio" name="jam_selesai" value="9"
                                                {{ $permohonan->jam_selesai == '9' ? 'checked' : '' }}
                                                id="9" />09:00
                                        </label>
                                        <label class="btn btn-white">
                                            <input type="radio" name="jam_selesai" value="10"
                                                {{ $permohonan->jam_selesai == '10' ? 'checked' : '' }}
                                                id="10" />10:00
                                        </label>
                                        <label class="btn btn-white">
                                            <input type="radio" name="jam_selesai" value="11"
                                                {{ $permohonan->jam_selesai == '11' ? 'checked' : '' }}
                                                id="11" />11:00
                                        </label>
                                        <label class="btn btn-white">
                                            <input type="radio" name="jam_selesai" value="12"
                                                {{ $permohonan->jam_selesai == '12' ? 'checked' : '' }}
                                                id="12" />12:00
                                        </label>
                                        <label class="btn btn-white">
                                            <input type="radio" name="jam_selesai" value="13"
                                                {{ $permohonan->jam_selesai == '13' ? 'checked' : '' }}
                                                id="13" />13:00
                                        </label>
                                        <label class="btn btn-white">
                                            <input type="radio" name="jam_selesai" value="14"
                                                {{ $permohonan->jam_selesai == '14' ? 'checked' : '' }}
                                                id="14" />14:00
                                        </label>
                                        <label class="btn btn-white">
                                            <input type="radio" name="jam_selesai" value="15"
                                                {{ $permohonan->jam_selesai == '15' ? 'checked' : '' }}
                                                id="15" />15:00
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border-b w-full border-neutral-300 my-[50px]"></div>
                        <div class="mb-[30px]">
                            <h3 class="text-lg font-semibold text-neutral-600">Fasilitas dan Alat Pendukung</h3>
                        </div>

                        <div>
                            <h5 class="mb-3">Fasilitas Tersedia <sup class="text-red">*</sup></h5>
                            <div class="gallery">
                                <div class="row">
                                    @foreach ($fasilitas as $f)
                                        <div class="image gallery-group-1 relative" style="float:left">
                                            <div class="image-inner">
                                                <a href="/foto_fasilitas/{{ $f->file }}"
                                                    data-lightbox="gallery-group-1">
                                                    <div class="img"
                                                        style="background-image: url(/foto_fasilitas/{{ $f->file }})">
                                                    </div>
                                                </a>
                                                <p class="absolute top-0 lef-0 px-4 py-1 text-white"
                                                    style="background-color: rgba(84, 101, 255, 0.8); border-radius: 0 0 8px 0;">
                                                    {{ $f->nama_fasilitas }}
                                                </p>
                                            </div>
                                            <div class="image-info  bg-light">
                                                <h5 class="title">{{ $f->nama_fasilitas }}</h5>
                                                <div class="checkbox checkbox-css">
                                                    <input type="checkbox" name="id_fasilitas[]"
                                                        value="{{ $f->id_fasilitas }}" id="{{ $f->id_fasilitas }}">
                                                    <label for="{{ $f->id_fasilitas }}">Pilih Fasilitas</label>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="mt-5">
                            <h5>Alat Pendukung Kegiatan </h5>
                            <div class="flex gap-5">
                                @foreach ($alat as $a)
                                    <div class="flex mt-3">
                                        <input type="checkbox" name="id_alat[]"
                                            class="shrink-0 mt-0.5 border-gray-400 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                            value="{{ $a->id_alat_pendukung }}" id="{{ $a->id_alat_pendukung }}">
                                        <label for="hs-default-checkbox"
                                            class="text-sm text-gray-500 ms-3">{{ $a->nama_alat }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div role="tabpanel" id="panel-4"
                        class="tab-panel invisible absolute top-0 p-6 opacity-0 transition duration-300">
                        <div class="form-group row mb-0">
                            <label class="col-lg-4 col-form-label">Tanggal Pengajuan Permohonan</label>
                            <div class="col-lg-8">
                                <input type="text"
                                    value="{{ old('created_at', \Carbon\Carbon::parse($permohonan
                                    ->created_at)->format('d M Y - H:i')) }}"
                                    class="form-control form-input text-small" style="width:100%;" disabled>
                            </div>

                            <div class="hidden">
                                <label class="col-lg-4 col-form-label">Tanggal Pengajuan Permohonan</label>
                                <div class="col-lg-8">
                                    <input type="hidden" id="craeted_at" name="created_at"
                                        value="{{ old('created_at', $permohonan
                                        ->created_at) }}"
                                        class="form-control form-input text-small" style="width:100%;">
                                </div>
                            </div>

                            <label class="col-lg-4 col-form-label mt-3">Status Permohonan</label>
                            <div class="col-lg-8 mt-3">
                                <input type="text" id="status_permohonan" name="status_permohonan"
                                    value="{{ old('status_permohonan', $permohonan->status_permohonan) }}"
                                    class="form-control form-input text-small" style="width:100%;" disabled>
                            </div>

                            <label class="col-lg-4 col-form-label mt-3">Catatan Admin</label>
                            <div class="col-lg-8 mt-3">
                                <input type="text" id="catatan" name="catatan"
                                    value="{{ old('catatan', $permohonan->catatan) }}"
                                    class="form-control form-input text-small" style="width:100%;" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -top-[100px] right-0">
                        <button type="submit" class="button-primary rounded" style="box-shadow: rgba(71, 71, 80, 0.362) 0px 7px 29px 0px;">Kirim Permohonan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="/assets/plugins/datatables.net-select/js/dataTables.select.min.js"></script>
    <script src="/assets/plugins/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>
    <script src="/assets/js/demo/table-manage-select.demo.js"></script>
    <script src="/assets/js/demo/ui-modal-notification.demo.js"></script>
    <script src="/assets/plugins/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        let tabs = document.querySelectorAll(".tab");
        let indicator = document.querySelector(".indicator");
        let panels = document.querySelectorAll(".tab-panel");

        indicator.style.width = tabs[0].getBoundingClientRect().width + "px";
        indicator.style.left =
            tabs[0].getBoundingClientRect().left -
            tabs[0].parentElement.getBoundingClientRect().left +
            "px";

        tabs.forEach((tab) => {
            tab.addEventListener("click", () => {
                let tabTarget = tab.getAttribute("aria-controls");

                indicator.style.width = tab.getBoundingClientRect().width + "px";
                indicator.style.left =
                    tab.getBoundingClientRect().left -
                    tab.parentElement.getBoundingClientRect().left +
                    "px";

                panels.forEach((panel) => {
                    let panelId = panel.getAttribute("id");
                    if (tabTarget === panelId) {
                        panel.classList.remove("invisible", "opacity-0");
                        panel.classList.add("visible", "opacity-100");
                    } else {
                        panel.classList.add("invisible", "opacity-0");
                    }
                });
            });
        });
    </script>
@endpush
