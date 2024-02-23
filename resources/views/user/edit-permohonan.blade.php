@extends('layouts.landing')

@section('content')

<main class="bg-[#f7f7f8]">
    <div class="pt-[100px] w-1/2 mx-auto">
        <div class="bg-white rounded-xl p-4 my-3" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
            <div class="border-b border-b-gray-300 pb-3">
                <h1 class="font-medium text-lg">Edit Permohonan</h1>
            </div>
            <form enctype="multipart/form-data" class="permohonan-form">
                @csrf 
                <div class="form-section">
                    <h1 class="pt-3 font-semibold text-center">Detail Pemohon</h1>
                    <div class="bg-white rounded-xl p-4" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                        <div class="grid grid-cols-2 gap-x-4">
                            <div class="w-full">
                                <label class="col-form-label font-medium">SKPD / Non SKPD <sup class="text-red-500">*</sup></label>
                                <div class="block">
                                    <select class="w-full text-xs rounded-sm border border-gray-300" id="skpd" name="skpd" value="{{ old('skpd', $permohonan->skpd) }}">
                                        <option value="" disabled selected>-- Pilih Bidang SKPD --</option>
                                        <option value="skpd" {{ $permohonan->skpd == 'skpd' ? 'selected' : '' }}>SKPD
                                        </option>
                                        <option value="non_skpd" {{ $permohonan->skpd == 'non_skpd' ? 'selected' : '' }}>NON
                                            SKPD
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="w-full">
                                <label class="col-form-label font-medium">Bidang Kegiatan<sup class="text-red-500">*</sup></label>
                                <div class="block">
                                    <select class="w-full text-xs rounded-sm border border-gray-300" id="bidang_id" name="bidang_id" value="{{ old('bidang_id', $permohonan->bidang_id) }}">
                                        <option value="" disabled selected>-- Pilih Bidang SKPD --</option>
                                        @foreach ($bidang as $item)
                                            <option value="{{ $item->id_bidang_kegiatan }}" {{ $permohonan->bidang_id == $item->id_bidang_kegiatan ? 'selected' : '' }}>
                                                {{ $item->nama_bidang }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="bg-primary/20 px-7 py-2 my-2 rounded-md">
                            <small><b>Catatan :</b><br>
                                <b>SKPD</b> (acara pemerintah)<br>
                                <b>NON SKPD</b> (acara diluar pemerintah)
                            </small>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl p-4 mt-3" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                        <div class="grid grid-cols-2 gap-x-4">
                            <div class="w-full">
                                <label class="col-form-label font-medium">NIK <sup class="text-red-500">*</sup></label>
                                <div class="block">
                                    <input type="text" class="form-control form-input text-small" name="nik" id="nik" value="{{ Auth::user()->nik }}" disabled />
                                </div>
                            </div>
                            <div class="w-full">
                                <label class="col-form-label font-medium">Nama Pemohon<sup class="text-red-500">*</sup></label>
                                <div class="block">
                                    <input type="hidden" class="form-control form-input text-small" value="{{ Auth::user()->id }}" name="user_id" />
                                    <input type="hidden" class="form-control form-input text-small" value="" name="permohonan_id" />
                                    <input type="text" class="form-control form-input text-small" name="name" id="name" value="{{ Auth::user()->name }}" disabled />
                                </div>
                            </div>
                            <div class="w-full mt-3">
                                <label class="col-form-label font-medium">No Telepon<sup class="text-red-500">*</sup></label>
                                <div class="block">
                                    <input type="text" class="form-control form-input text-small" name="no_telp" id="no_telp" value="{{ Auth::user()->no_telp }}" disabled />
                                </div>
                            </div>
                            <div class="w-full mt-3">
                                <label class="col-form-label font-medium">Alamat Lengkap<sup class="text-red-500">*</sup></label>
                                <div class="block">
                                    <input type="text" class="form-control form-input text-small" name="alamat" id="alamat" value="{{ Auth::user()->alamat }}" disabled />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h1 class="pt-3 font-semibold text-center">Instansi / Pribadi</h1>
                    <div class="bg-white rounded-xl p-4" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                        <div class="grid grid-cols-2 gap-x-4">
                            <div class="w-full">
                                <label class="col-form-label font-medium">Nama Instansi / Pribadi <sup class="text-red-500">*</sup></label>
                                <div class="block">
                                    <select class="w-full text-xs rounded-sm border border-gray-300" id="instansiSelect" name="instansi_id" required>
                                        <option value="" disabled selected>-- Pilih Instansi --</option>
                                        @foreach ($instansi as $item)
                                            <option value="{{ $item->id_instansi }}" {{ $permohonan->instansi_id == $item->id_instansi ? 'selected' : '' }}>
                                                {{ $item->nama_instansi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="w-full">
                                <label class="col-form-label font-medium">Status dalam Instansi / Pribadi<sup class="text-red-500">*</sup></label>
                                <div class="block">
                                    <input type="text" class="form-control form-input text-small" name="status_instansi" id="status_instansi" value="{{ old('status_instansi', $permohonan->status_instansi) }}" required />
                                </div>
                            </div>
                            <div class="w-full mt-3">
                                <label class="col-form-label font-medium">Bidang Instansi / Pribadi<sup class="text-red-500">*</sup></label>
                                <div class="block">
                                    <input type="text" class="form-control form-input text-small" name="bidang_instansi" id="bidang_instansi" value="{{ old('bidang_instansi', $permohonan->bidang_instansi) }}" required />
                                </div>
                            </div>
                            <div class="w-full mt-3">
                                <label class="col-form-label font-medium">Alamat Instansi / Pribadi<sup class="text-red-500">*</sup></label>
                                <div class="block">
                                    <input type="text" class="form-control form-input text-small" name="alamat_instansi" id="valAlamat" value="{{ old('alamat_instansi', $permohonan->alamat_instansi) }}" required disabled />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h1 class="pt-3 font-semibold text-center">Acara / Kegiatan</h1>
                    <div class="bg-white rounded-xl p-4" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                        <div class="grid grid-cols-2 gap-x-4">
                            <div class="w-full hidden">
                                <label class="col-form-label font-medium">Tanggal Mulai<sup class="text-red-500">*</sup></label>
                                <div class="block">
                                    <input type="hidden" class="form-control form-input text-small" name="tgl_mulai" id="tgl_mulai" value="{{ old('tgl_mulai', $permohonan->tgl_mulai) }}" required />
                                </div>
                            </div>
                            <div class="w-full hidden">
                                <label class="col-form-label font-medium">Jam Mulai<sup class="text-red-500">*</sup></label>
                                <div class="block">
                                    <input type="hidden" class="form-control form-input text-small" name="jam_mulai" id="jam_mulai" value="{{ old('jam_mulai', $permohonan->jam_mulai) }}" required />
                                </div>
                            </div>
                            <div class="w-full hidden">
                                <label class="col-form-label font-medium">Tanggal Selesai<sup class="text-red-500">*</sup></label>
                                <div class="block">
                                    <input type="hidden" class="form-control form-input text-small" name="tgl_selesai" id="tgl_selesai" value="{{ old('tgl_selesai', $permohonan->tgl_selesai) }}" required />
                                </div>
                            </div>
                            <div class="w-full hidden">
                                <label class="col-form-label font-medium">Jam Selesai<sup class="text-red-500">*</sup></label>
                                <div class="block">
                                    <input type="hidden" class="form-control form-input text-small" name="jam_selesai" id="jam_selesai" value="{{ old('jam_selesai', $permohonan->jam_selesai) }}" required />
                                </div>
                            </div>
                            <div class="w-full">
                                <label class="col-form-label font-medium">Nama Acara / Kegiatan<sup class="text-red-500">*</sup></label>
                                <div class="block">
                                    <input type="text" class="form-control form-input text-small" name="nama_kegiatan" id="nama_kegiatan" value="{{ old('tgl_mulai', $permohonan->tgl_mulai) }}" required />
                                </div>
                            </div>
                            <div class="w-full">
                                <label class="col-form-label font-medium">Jumlah Peserta<sup class="text-red-500">*</sup></label>
                                <div class="block">
                                    <input type="text" class="form-control form-input text-small" name="jumlah_peserta" id="jumlah_peserta" value="{{ old('jumlah_peserta', $permohonan->jumlah_peserta) }}" required />
                                </div>
                            </div>
                            <div class="w-full mt-3">
                                <label class="col-form-label font-medium">Narasumber<sup class="text-red-500">*</sup></label>
                                <div class="block">
                                    <input type="text" class="form-control form-input text-small" name="narasumber" id="narasumber" value="{{ old('narasumber', $permohonan->narasumber) }}" required />
                                </div>
                            </div>
                            <div class="w-full mt-3">
                                <label class="col-form-label font-medium">Surat Permohonan<sup class="text-red-500">*</sup></label>
                                <div class="block">
                                    <input type="file" class="block w-full border border-gray-200 text-small focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none file:bg-gray-50 file:border-0 file:me-4 file:py-2 file:px-4" name="surat_permohonan" id="surat_permohonan" style="font-size: 11.5px" required />
                                </div>
                            </div>
                            <div class="w-full mt-3">
                                <label class="col-form-label font-medium">Rundown Acara<sup class="text-red-500">*</sup></label>
                                <div class="block">
                                    <input type="file" class="block w-full border border-gray-200 text-small focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none file:bg-gray-50 file:border-0 file:me-4 file:py-2 file:px-4" name="rundown_acara" id="rundown_acara" style="font-size: 11.5px" required />
                                </div>
                            </div>
                            <div class="w-full mt-3">
                                <label class="col-form-label font-medium">Output</label>
                                <div class="block">
                                    <input type="text" class="form-control form-input text-small" name="output" id="output" value="{{ old('output', $permohonan->output) }}" />
                                </div>
                            </div>
                            <div class="w-full mt-3">
                                <label class="col-form-label font-medium">Outcome</label>
                                <div class="block">
                                    <input type="text" class="form-control form-input text-small" name="outcome" id="outcome" value="{{ old('outcome', $permohonan->outcome) }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl p-4 mt-3" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                        <div class="w-full">
                            <label class="col-form-label font-medium">Ringkasan Acara / Kegiatan<sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <textarea class="border-gray-200 border-2 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md w-full" name="ringkasan" id="ringkasan" value="{{ old('ringkasan', $permohonan->ringkasan) }}" style="font-size: 13px" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl p-4 mt-3" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                        <div class="w-full">
                            <label class="col-form-label font-medium">Alat Pendukung</label>
                            <div class="block mt-2">
                                <div class="flex gap-x-6">
                                    @foreach ($alat as $item)
                                    <div class="flex">
                                      <input type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" name="id_alat[]" value="{{ $item->id_alat_pendukung }}"
                                      id="alat_pendukung">
                                      <label for="hs-checkbox-group-1" class="text-sm text-gray-500 ms-3">{{ $item->nama_alat }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-navigation flex justify-end mt-5 gap-x-3">
                    <button type="button" class="button-ghost text-small rounded-lg px-4 previous">Kembali</button>
                    <button type="button" id="btn-next" class="button-primary text-small rounded-lg px-4 next">Lanjutkan</button>
                    <button type="button" id="btn-step-one" class="button-primary text-small rounded-lg px-4 next-step">Lanjutkan</button>
                    <button type="submit" id="btn-submit" class="button-primary text-small rounded-lg px-4">Submit</button>
                </div>
            </form>
        </div>
    </div>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(function() {
        var $sections=$('.form-section');

        function navigateTo(index) {
            $sections.removeClass('current').eq(index).addClass('current');

            $('.form-navigation .previous').toggle(index > 0);
            var atTheEnd = index >= $sections.length - 1;
            $('.form-navigation .next').toggle(index === 0);
            $('.form-navigation .next-step').toggle(index === 1);
            $('.form-navigation [Type=submit]').toggle(atTheEnd);
        }
        
        function curIndex() {
            return $sections.index($sections.filter('.current'));
        }

        $('.form-navigation .previous').click(function() {
            navigateTo(curIndex() - 1);
        });

        $('.form-navigation .next').click(function() {
            $('.permohonan-form').parsley().whenValidate({
                group:'block-'+curIndex()
            }).done(function() {
                navigateTo(curIndex() + 1);
            })
        });

        $('.form-navigation .next-step').click(function() {
            $('.permohonan-form').parsley().whenValidate({
                group:'block-'+curIndex()
            }).done(function() {
                navigateTo(curIndex() + 1);
            })
        });

        $sections.each(function(index, section) {
            $(section).find(':input').attr('data-parsley-group', 'block-',+index);
        });

        navigateTo(0);
    })
</script>

<script>
    const skpd = document.getElementById("skpd");
    const bidang = document.getElementById("bidang_id");
    const button = document.getElementById("btn-next");

    function stepOneValidation(userSkpd, userBidang) {
        const isSkpdValid = userSkpd.length > 0

        const isBidangValid = userBidang.length > 0;

        if (isSkpdValid && isBidangValid) {
            button.removeAttribute("disabled");
            button.style.backgroundColor = "#072ac8";
            button.style.color = "white";
            button.style.cursor = "pointer";
            button.style.transitionDuration = "300ms";

            button.addEventListener("mouseover", function () {
            button.style.backgroundColor = "#072ac8";
            });

            button.addEventListener("mouseout", function () {
            button.style.backgroundColor = "#072ac8";
            });
        } else {
            button.setAttribute("disabled", true);
            button.style.backgroundColor = "rgba(44, 62, 80, 0.1)";
            button.style.color = "rgba(0, 0, 0, 0.5)";
            button.style.cursor = "not-allowed";

            button.addEventListener("mouseover", function () {
            button.style.backgroundColor = "rgba(44, 62, 80, 0.1)";
            });

            button.addEventListener("mouseout", function () {
            button.style.backgroundColor = "rgba(44, 62, 80, 0.1)";
            });
        }
    }

    skpd.addEventListener("input", function (event) {
        const skpdValue = skpd.value;
        stepOneValidation(skpdValue, bidang.value);
    });

    bidang.addEventListener("input", function (event) {
        const bidangValue = bidang.value;
        stepOneValidation(skpd.value, bidangValue);
    });

    // ================================================

    const instansi = document.getElementById("instansiSelect");
    const statusInstansi = document.getElementById("status_instansi");
    const bidangInstansi = document.getElementById("bidang_instansi");
    const alamatInstansi = document.getElementById("valAlamat");
    const buttonNext = document.getElementById("btn-step-one");
    
    function stepTwoValidation(userInstansi, userStatusInstansi, userBidangInstansi, userAlamatInstansi) {
        const isInstansiValid = userInstansi.length > 0
        const isStatusValid = userStatusInstansi.length > 0;
        const isBidangValid = userBidangInstansi.length > 0;
        const isAlamatValid = userAlamatInstansi.length > 0;

        if (isInstansiValid && isStatusValid && isBidangValid && isAlamatValid) {
            buttonNext.removeAttribute("disabled");
            buttonNext.style.backgroundColor = "#072ac8";
            buttonNext.style.color = "white";
            buttonNext.style.cursor = "pointer";
            buttonNext.style.transitionDuration = "300ms";

            buttonNext.addEventListener("mouseover", function () {
            buttonNext.style.backgroundColor = "#072ac8";
            });

            buttonNext.addEventListener("mouseout", function () {
            buttonNext.style.backgroundColor = "#072ac8";
            });
        } else {
            buttonNext.setAttribute("disabled", true);
            buttonNext.style.backgroundColor = "rgba(44, 62, 80, 0.1)";
            buttonNext.style.color = "rgba(0, 0, 0, 0.5)";
            buttonNext.style.cursor = "not-allowed";

            buttonNext.addEventListener("mouseover", function () {
            buttonNext.style.backgroundColor = "rgba(44, 62, 80, 0.1)";
            });

            buttonNext.addEventListener("mouseout", function () {
            buttonNext.style.backgroundColor = "rgba(44, 62, 80, 0.1)";
            });
        }
    }

    instansi.addEventListener("input", function (event) {
        const instansiValue = instansi.value;
        stepTwoValidation(instansiValue, statusInstansi.value, bidangInstansi.value, alamatInstansi.value);
    });

    statusInstansi.addEventListener("input", function (event) {
        const statusValue = statusInstansi.value;
        stepTwoValidation(instansi.value, statusValue, bidangInstansi.value, alamatInstansi.value);
    });

    bidangInstansi.addEventListener("input", function (event) {
        const bidangValue = bidangInstansi.value;
        stepTwoValidation(instansi.value, statusInstansi.value, bidangValue, alamatInstansi.value);
    });

    alamatInstansi.addEventListener("input", function (event) {
        const alamatValue = alamatInstansi.value;
        stepTwoValidation(instansi.value, statusInstansi.value, bidangInstansi.value, alamatValue);
    });

    // ================================================

    const namaKegiatan = document.getElementById("nama_kegiatan");
    const jumlahPeserta = document.getElementById("jumlah_peserta");
    const narasumber = document.getElementById("narasumber");
    const suratPermohonan = document.getElementById("surat_permohonan");
    const rundownAcara = document.getElementById("rundown_acara");
    const ringkasan = document.getElementById("ringkasan");
    const alatPendukung = document.getElementById("alat_pendukung");
    const buttonSubmit = document.getElementById("btn-submit");

    console.log(suratPermohonan.value);
    
    function stepThreeValidation(userNamaKegiatan, userJumlahPeserta, userNarasumber, userSuratPermohonan, userRundownAcara, userRingkasan, userAlatPendukung) {
        const isKegiatanValid = userNamaKegiatan.length > 0
        const isPesertaValid = userJumlahPeserta.length > 0;
        const isNarasumberValid = userNarasumber.length > 0;
        const isSuratValid = userSuratPermohonan.length > 0;
        const isRundownValid = userRundownAcara.length > 0;
        const isRingkasanValid = userRingkasan.length > 0;
        const isAlatValid = userAlatPendukung.length > 0;

        if (isKegiatanValid && isPesertaValid && isNarasumberValid && isSuratValid && isRundownValid && isRingkasanValid && isAlatValid) {
            buttonSubmit.removeAttribute("disabled");
            buttonSubmit.style.backgroundColor = "#072ac8";
            buttonSubmit.style.color = "white";
            buttonSubmit.style.cursor = "pointer";
            buttonSubmit.style.transitionDuration = "300ms";

            buttonSubmit.addEventListener("mouseover", function () {
            buttonSubmit.style.backgroundColor = "#072ac8";
            });

            buttonSubmit.addEventListener("mouseout", function () {
            buttonSubmit.style.backgroundColor = "#072ac8";
            });
        } else {
            buttonSubmit.setAttribute("disabled", true);
            buttonSubmit.style.backgroundColor = "rgba(44, 62, 80, 0.1)";
            buttonSubmit.style.color = "rgba(0, 0, 0, 0.5)";
            buttonSubmit.style.cursor = "not-allowed";

            buttonSubmit.addEventListener("mouseover", function () {
            buttonSubmit.style.backgroundColor = "rgba(44, 62, 80, 0.1)";
            });

            buttonSubmit.addEventListener("mouseout", function () {
            buttonSubmit.style.backgroundColor = "rgba(44, 62, 80, 0.1)";
            });
        }
    }

    namaKegiatan.addEventListener("input", function (event) {
        const kegiatanValue = namaKegiatan.value;
        stepThreeValidation(kegiatanValue, jumlahPeserta.value, narasumber.value, suratPermohonan.value, rundownAcara.value, ringkasan.value, alatPendukung.value);
    });

    jumlahPeserta.addEventListener("input", function (event) {
        const pesertaValue = jumlahPeserta.value;
        stepThreeValidation(namaKegiatan.value, pesertaValue, narasumber.value, suratPermohonan.value, rundownAcara.value, ringkasan.value, alatPendukung.value);
    });

    narasumber.addEventListener("input", function (event) {
        const narasumberValue = narasumber.value;
        stepThreeValidation(namaKegiatan.value, jumlahPeserta.value, narasumberValue, suratPermohonan.value, rundownAcara.value, ringkasan.value, alatPendukung.value);
    });

    suratPermohonan.addEventListener("input", function (event) {
        const permohonanValue = suratPermohonan.value;
        stepThreeValidation(namaKegiatan.value, jumlahPeserta.value, narasumber.value, permohonanValue, rundownAcara.value, ringkasan.value, alatPendukung.value);
    });

    rundownAcara.addEventListener("input", function (event) {
        const rundownValue = rundownAcara.value;
        stepThreeValidation(namaKegiatan.value, jumlahPeserta.value, narasumber.value, suratPermohonan.value, rundownValue, ringkasan.value, alatPendukung.value);
    });

    ringkasan.addEventListener("input", function (event) {
        const ringkasanValue = ringkasan.value;
        stepThreeValidation(namaKegiatan.value, jumlahPeserta.value, narasumber.value, suratPermohonan.value, rundownAcara.value, ringkasanValue, alatPendukung.value);
    });

    alatPendukung.addEventListener("input", function (event) {
        const alatValue = alatPendukung.value;
        stepThreeValidation(namaKegiatan.value, jumlahPeserta.value, narasumber.value, suratPermohonan.value, rundownAcara.value, ringkasan.value, alatValue);
    });
</script>

@endsection