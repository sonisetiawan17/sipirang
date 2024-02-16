@extends('layouts.landing')

@section('title', 'Buat Permohonan')

@section('content')

<main class="pt-[77px] mx-[140px]">
    <ul class="relative flex flex-row gap-x-2 pt-6 w-[60%]">
        <li class="flex items-center gap-x-2 shrink basis-0 flex-1 group">
            <div class="min-w-4 min-h-7 inline-flex justify-center items-center text-xs align-middle">
                <span class="step0 size-7 flex justify-center items-center flex-shrink-0 bg-gray-100 font-medium text-gray-800 rounded-full border-2 border-neutral-300">
                1
                </span>
                <span class="ms-2 block text-sm font-medium text-gray-500">
                Detail Permohonan
                </span>
            </div>
            <div class="divider0 w-full h-px flex-1 bg-gray-200 group-last:hidden"></div>
        </li>
    
        <li class="flex items-center gap-x-2 shrink basis-0 flex-1 group">
            <div class="min-w-4 min-h-7 inline-flex justify-center items-center text-xs align-middle">
                <span class="step1 size-7 flex justify-center items-center flex-shrink-0 bg-gray-100 font-medium text-gray-800 rounded-full border-2 border-neutral-300">
                2
                </span>
                <span class="ms-2 block text-sm font-medium text-gray-500">
                Data Instansi / Pribadi
                </span>
            </div>
            <div class="divider1 w-full h-px flex-1 bg-gray-200 group-last:hidden"></div>
        </li>
    
        <li class="flex items-center gap-x-2 shrink basis-0 flex-1 group">
            <div class="min-w-4 min-h-7 inline-flex justify-center items-center text-xs align-middle">
                <span class="step2 size-7 flex justify-center items-center flex-shrink-0 bg-gray-100 font-medium text-gray-800 rounded-full border-2 border-neutral-300">
                3
                </span>
                <span class="ms-2 block text-sm font-medium text-gray-500">
                Informasi Acara / Kegiatan
                </span>
            </div>
            <div class="divider2 w-full h-px flex-1 bg-gray-200 group-last:hidden"></div>
        </li>
    </ul>

    <h1 class="pt-12 font-semibold text-xl">Detail Pemohon</h1>
    <div class="grid grid-cols-[65%,1fr] mt-4 mb-24">
        <form class="permohonan-form">
            @csrf 
            <div class="form-section">
                <div class="bg-white rounded-xl p-4" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                    <div class="grid grid-cols-2 gap-x-4">
                        <div class="w-full">
                            <label class="col-form-label font-medium">SKPD / Non SKPD <sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <select class="w-full text-xs rounded-sm border border-gray-300" name="skpd">
                                    <option disabled selected>-- Pilih Bidang SKPD --</option>
                                    <option value="skpd">SKPD</option>
                                    <option value="non_skpd">NON SKPD</option>
                                </select>
                            </div>
                        </div>
                        <div class="w-full">
                            <label class="col-form-label font-medium">Bidang Kegiatan<sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <select class="w-full text-xs rounded-sm border border-gray-300" name="bidang_id">
                                    <option disabled selected>-- Pilih Bidang Kegiatan --</option>
                                    @foreach ($bidang as $b)
                                            <option value="{{ $b->id_bidang_kegiatan }}">{{ $b->nama_bidang }}
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
                <div class="bg-white rounded-xl p-4" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                    <div class="grid grid-cols-2 gap-x-4">
                        <div class="w-full">
                            <label class="col-form-label font-medium">Nama Instansi / Pribadi <sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <select class="w-full text-xs rounded-sm border border-gray-300" name="instansi_id">
                                    <option disabled selected>-- Pilih Instansi --</option>
                                    @foreach ($instansi as $i)
                                            <option value="{{ $i->id_instansi }}">{{ $i->nama_instansi }}
                                            </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="w-full">
                            <label class="col-form-label font-medium">Status dalam Instansi / Pribadi<sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <input type="text" class="form-control form-input text-small" name="status_instansi" id="status_instansi" />
                            </div>
                        </div>
                        <div class="w-full mt-3">
                            <label class="col-form-label font-medium">Bidang Instansi / Pribadi<sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <input type="text" class="form-control form-input text-small" name="bidang_instansi" id="bidang_instansi" />
                            </div>
                        </div>
                        <div class="w-full mt-3">
                            <label class="col-form-label font-medium">Alamat Instansi / Pribadi<sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <input type="text" class="form-control form-input text-small" name="alamat_instansi" id="alamat_instansi" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="bg-white rounded-xl p-4" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                    <div class="grid grid-cols-2 gap-x-4">
                        <div class="w-full hidden">
                            <label class="col-form-label font-medium">Tanggal Mulai<sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <input type="hidden" class="form-control form-input text-small" name="tgl_mulai" id="tgl_mulai" value="{{ $tgl_mulai }}" />
                            </div>
                        </div>
                        <div class="w-full hidden">
                            <label class="col-form-label font-medium">Jam Mulai<sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <input type="hidden" class="form-control form-input text-small" name="jam_mulai" id="jam_mulai" value="{{ $jam_mulai }}" />
                            </div>
                        </div>
                        <div class="w-full hidden">
                            <label class="col-form-label font-medium">Tanggal Selesai<sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <input type="hidden" class="form-control form-input text-small" name="tgl_selesai" id="tgl_selesai" value="{{ $tgl_selesai }}" />
                            </div>
                        </div>
                        <div class="w-full hidden">
                            <label class="col-form-label font-medium">Jam Selesai<sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <input type="hidden" class="form-control form-input text-small" name="jam_selesai" id="jam_selesai" value="{{ $jam_selesai }}" />
                            </div>
                        </div>
                        <div class="w-full">
                            <label class="col-form-label font-medium">Nama Acara / Kegiatan<sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <input type="text" class="form-control form-input text-small" name="nama_kegiatan" id="nama_kegiatan" />
                            </div>
                        </div>
                        <div class="w-full">
                            <label class="col-form-label font-medium">Jumlah Peserta<sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <input type="text" class="form-control form-input text-small" name="jumlah_peserta" id="jumlah_peserta" />
                            </div>
                        </div>
                        <div class="w-full mt-3">
                            <label class="col-form-label font-medium">Narasumber<sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <input type="text" class="form-control form-input text-small" name="narasumber" id="narasumber" />
                            </div>
                        </div>
                        <div class="w-full mt-3">
                            <label class="col-form-label font-medium">Surat Permohonan<sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <input type="file" class="block w-full border border-gray-200 text-small focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none file:bg-gray-50 file:border-0 file:me-4 file:py-2 file:px-4" name="surat_permohonan" id="surat_permohonan" style="font-size: 11.5px" />
                            </div>
                        </div>
                        <div class="w-full mt-3">
                            <label class="col-form-label font-medium">Rundown Acara<sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <input type="file" class="block w-full border border-gray-200 text-small focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none file:bg-gray-50 file:border-0 file:me-4 file:py-2 file:px-4" name="rundown_acara" id="rundown_acara" style="font-size: 11.5px" />
                            </div>
                        </div>
                        <div class="w-full mt-3">
                            <label class="col-form-label font-medium">Output</label>
                            <div class="block">
                                <input type="text" class="form-control form-input text-small" name="output" id="output" />
                            </div>
                        </div>
                        <div class="w-full mt-3">
                            <label class="col-form-label font-medium">Outcome</label>
                            <div class="block">
                                <input type="text" class="form-control form-input text-small" name="outcome" id="outcome" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 mt-3" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                    <div class="w-full">
                        <label class="col-form-label font-medium">Ringkasan Acara / Kegiatan<sup class="text-red-500">*</sup></label>
                        <div class="block">
                            <textarea class="border-gray-200 border-2 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md w-full" name="ringkasan" style="font-size: 13px"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-navigation flex justify-end mt-5 gap-x-3">
                <button type="button" class="button-ghost text-small rounded-lg px-4 previous">Kembali</button>
                <button type="button" class="button-primary text-small rounded-lg px-4 next">Lanjutkan</button>
                <button type="submit" class="button-primary text-small rounded-lg px-4">Submit</button>
            </div>
        </form>
        <div class="bg-white rounded-xl mx-4 h-fit" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
            <div class="h-44 w-full bg-cover bg-center rounded-t-xl" style="background-image: url('{{ asset('/assets/img/auth/multimedia.png') }}');"></div>
            <div class="p-4">
                <h1 class="font-semibold text-lg border-b border-neutral-300 pb-4">Multimedia</h1>
                <div class="pt-4 pb-2 text-neutral-500 font-medium">
                    <div class="flex flex-row items-center gap-x-2">
                        <img src="{{ asset('/assets/img/auth/kalendar.png') }}" class="h-4" />
                        <p>Kam, 15 Feb 2024 - Kam, 15 Feb 2024</p>
                    </div>
                    <div class="flex flex-row items-center gap-x-2 pt-2">
                        <img src="{{ asset('/assets/img/auth/jam.png') }}" class="h-4" />
                        <p>{{ $jam_mulai }}:00 - {{ $jam_selesai }}.00</p>
                    </div>
                </div>
            </div>
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
            $('.form-navigation .next').toggle(!atTheEnd);
            $('.form-navigation [Type=submit]').toggle(atTheEnd);

            const stepOne = document.querySelector('.step0');
            const stepTwo = document.querySelector('.step1');
            const stepThree = document.querySelector('.step2');

            const dividerOne = document.querySelector('.divider0');
            const dividerTwo = document.querySelector('.divider1');
            const dividerThree = document.querySelector('.divider2');

            if (index === 0) {
                stepOne.style.backgroundColor = '#072ac8';
                stepOne.style.color = 'white';

                stepTwo.style.backgroundColor = '';
                stepTwo.style.color = '';

                stepThree.style.backgroundColor = '';
                stepThree.style.color = '';

                dividerOne.style.backgroundColor = '';
            } else if (index === 1) {
                stepOne.style.backgroundColor = '#072ac8';
                stepOne.style.color = 'white';

                stepTwo.style.backgroundColor = '#072ac8';
                stepTwo.style.color = 'white';

                stepThree.style.backgroundColor = '';
                stepThree.style.color = '';

                dividerOne.style.backgroundColor = '#072ac8';
                dividerTwo.style.backgroundColor = '';
            } else if (index === 2) {
                stepOne.style.backgroundColor = '#072ac8';
                stepOne.style.color = 'white';

                stepTwo.style.backgroundColor = '#072ac8';
                stepTwo.style.color = 'white';

                stepThree.style.backgroundColor = '#072ac8';
                stepThree.style.color = 'white';

                dividerTwo.style.backgroundColor = '#072ac8';
            }
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

        $sections.each(function(index, section) {
            $(section).find(':input').attr('data-parsley-group', 'block-',+index);
        });

        navigateTo(0);
    })
</script>

@endsection

