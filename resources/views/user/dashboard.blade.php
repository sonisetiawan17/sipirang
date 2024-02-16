@extends('layouts.landing')

@section('content')

@php 
    $arr = [['2024-02-01', '10', '13'], ['2024-02-02', '9', '11']];
@endphp

<main class="bg-[#f7f7f8]">
    <div class="pt-[77px] relative h-screen">
        <div class="absolute z-10 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[70%]">
            <div>
                <h1 class="font-bold text-6xl text-center">Sistem Informasi Peminjaman <span class="block pt-3 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-transparent bg-clip-text h-[85px]">Media Platform</span></h1>
                <p class="pt-4 font-semibold text-lg text-center">87% Murid di Akademi berhasil melipatgandakan
                    portofolionya <span class="block pt-2">dalam waktu 3 bulan menggunakan strategi kita.</span></p>
            </div>

            <div class="mt-10 text-center">
                <button class="bg-gradient-to-t from-primary to-blue-500 text-small rounded-lg px-4 text-white" style="padding: 8px 12px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">Lihat Ruangan</button>
            </div>
        </div>

        <div class="absolute bottom-0 bg-center bg-cover w-full h-[70%] z-0" style="background: linear-gradient(transparent 0%, #eff3fb 100%);">
        </div>            
    </div>

    <div class="bg-[#eff3fb]">
        {{-- <div class="flex flex-row items-center justify-between gap-3">
            <div class="w-[40%] h-[2px] bg-neutral-400/20"></div>
            <h1 class="text-xl uppercase font-medium tracking-widest bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-transparent bg-clip-text">Pilih Ruangan</h1>
            <div class="w-[40%] h-[2px] bg-neutral-400/20"></div>
        </div> --}}
        <div class="w-full h-[2px] bg-gradient-to-r from-blue-500 via-indigo-500 to-blue-500 relative">
            <div class="absolute left-0 transform -translate-y-1/2 w-[40%] h-[50px]" style="background: linear-gradient(270deg, transparent 0%, #eff3fb 75%);"></div>
            <div class="absolute right-0 transform -translate-y-1/2 w-[40%] h-[50px]" style="background: linear-gradient(90deg, transparent 0%, #eff3fb 75%);"></div>
        </div>

        <div class="mt-5 text-center">
            <h1 class="text-xl uppercase font-semibold tracking-widest bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-transparent bg-clip-text">Pilih Ruangan</h1>
        </div>

        <div class="mt-12 flex items-start justify-center gap-5">
            @foreach ($fasilitas as $item)
            <div id="modal_show" type="button" data-toggle="modal" data-target="#isimodal" data-id_fasilitas="{{ $item->id_fasilitas }}" data-nama_fasilitas="{{ $item->nama_fasilitas }}" class="bg-[#f2f5fa] border shadow-sm rounded-xl w-[35%] mt-3 cursor-pointer transition-all duration-300 hover:transform hover:-translate-y-4 hover:transition-all hover:duration-300" style="padding: 12px">
                <div class="card-content text-center">
                    <div class="flex items-center justify-center gap-3">
                        <img src="{{ asset('/assets/img/auth/room.png') }}" class="h-7" />
                        <h3 class="font-bold text-[#0d34cd]" style="font-size: 19px">
                            {{ $item->nama_fasilitas }}
                        </h3>
                    </div>
                    <p class="mt-3 font-semibold" style="font-size: 19px">
                        Helps you write and review essays 3x faster
                    </p>
                    <p class="mt-1 text-gray-600">
                        Get essay feedback specific to your essays in seconds, anytime.
                    </p>
                </div>
                <img class="w-full h-auto rounded-xl image-border mt-4"
                    src="https://images.unsplash.com/photo-1680868543815-b8666dba60f7?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2532&q=80"
                    alt="Image Description">
            </div>
            @endforeach
        </div>

        <div class="modal fade" id="isimodal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Pilih Jadwal Peminjaman</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body mx-3" id="tampil_modal">
                        <form method="get" action="{{ route('user.buatPermohonanForm') }}">
                            @csrf
                            <div class="form-group m-b-15">
                                <input type="hidden" class="form-control form-input text-small" name="id_fasilitas" id="id_fasilitas" disabled />
                                <input type="hidden" class="form-control form-input text-small" name="nama_fasilitas" id="nama_fasilitas" disabled />
                                <label class="col-form-label">Tanggal Mulai <sup class="text-red">*</sup></label>
                                <div class="block">
                                    <input type="date" class="form-control form-input text-small" name="tgl_mulai" id="tgl_mulai" onchange="checkStartDate()" />
                                </div>
    
                                <label class="col-form-label mt-3">Jam Mulai <sup class="text-red">*</sup></label>
                                <div class="block">
                                    {{-- <div class="btn-group btn-group-toggle" data-toggle="buttons" id="data-jam">
                                        <p class="tgl_info">*Silahkan pilih tanggal mulai terlebih dahulu.</p>
                                    </div> --}}
                                    <div class="radio-toolbar" id="data-jam-mulai">
                                        <p class="tgl_info">*Silahkan pilih tanggal mulai terlebih dahulu.</p>
                                    </div>
                                </div>
    
                                <label class="col-form-label mt-3">Tanggal Selesai <sup class="text-red">*</sup></label>
                                <div class="block">
                                    <input type="date" class="form-control form-input text-small" name="tgl_selesai" id="tgl_selesai" onchange="checkEndDate()" />
                                </div>
    
                                <label class="col-form-label mt-3">Jam Selesai <sup class="text-red">*</sup></label>
                                <div class="block">
                                    <div class="radio-toolbar" id="data-jam-selesai">
                                        <p class="tgl_info">*Silahkan pilih tanggal selesai terlebih dahulu.</p>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer font-semibold text-sm">
                        <a href="javascript:;" class="button-ghost" data-dismiss="modal">Tutup</a>
                        <button type="submit" class="button-primary">Lanjutkan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="pt-24 radio-toolbar"></div>
    </div>
</main>

<script type="text/javascript">
    $(document).on("click", "#modal_show", function() {
        var id_fasilitas = $(this).data('id_fasilitas');
        var nama_fasilitas = $(this).data('nama_fasilitas');

        $("#tampil_modal #id_fasilitas").val(id_fasilitas);
        $("#tampil_modal #nama_fasilitas").val(nama_fasilitas);
    })
</script>

<script>
    function checkStartDate() {
        const selectedDate = document.getElementById("tgl_mulai").value
        const currentDate = @json($arr);

        const matchingDateItem = currentDate.find(item => item[0] === selectedDate);
        const emptyArr = [];
        const newArray = [];

        if (matchingDateItem) {
            const index1 = matchingDateItem[1];
            const index2 = matchingDateItem[2];
            emptyArr.push(index1, index2)
        } else {
            console.log("Tanggal tidak ditemukan dalam array.");
        }

        for (let i = parseInt(emptyArr[0]); i <= parseInt(emptyArr[1]); i++) {
            newArray.push(i.toString().padStart(1, '0'));
        }

        console.log(newArray);

        // ===================================================================

        const jam = document.getElementById("data-jam-mulai");

        const isDateInCurrentDate = currentDate.some(item => item[0] === selectedDate);

        jam.innerHTML = '';

        if (isDateInCurrentDate) {
            for (let i = 8; i <= 16; i++) {
                const value = i.toString();
                const isUsed = newArray.includes(value);

                jam.innerHTML +=
                    // `<label class="btn text-xs ${isUsed ? 'bg-red-500/20 disabled cursor-not-allowed' : 'btn-white'}" id="result">
                    //     <input type="radio" name="jam_mulai" value="${value}" id="${value}" />
                    //     ${value}:00
                    // </label>`;
                    `<label class="${isUsed ? 'inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-500/20 disabled cursor-not-allowed text-red-800' : 'inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-100 text-teal-800 cursor-pointer'} mr-1" id="${value}">
                        <input type="radio" name="jam_mulai" value="${value}" id="${value}" onclick="getValue()" />
                        ${value}:00
                    </label>`;
            }
        } else {
            for (let i = 8; i <= 16; i++) {
                const value = i.toString();
                jam.innerHTML +=
                    // `<label class="btn text-xs btn-white" id="result"><input type="radio" name="jam_mulai" value="${value}" id="${value}" />${value}:00</label>`;
                    `<label class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-100 text-teal-800 cursor-pointer mr-1" id="${value}">
                        <input type="radio" name="jam_mulai" value="${value}" id="${value}" onclick="getValue()" />
                        ${value}:00
                    </label>`;
            }
        }
    }

    function getValue() {
        const radioButton = document.getElementsByName("jam_mulai");
        const labelElement8 = document.getElementById('8');
        const labelElement9 = document.getElementById('9');
        const labelElement10 = document.getElementById('10');
        const labelElement11 = document.getElementById('11');
        const labelElement12 = document.getElementById('12');
        const labelElement13 = document.getElementById('13');
        const labelElement14 = document.getElementById('14');
        const labelElement15 = document.getElementById('15');
        const labelElement16 = document.getElementById('16');

        for (let i = 0; i < radioButton.length; i++) {
            if (radioButton[i].checked) {
                const selectedValue = radioButton[i].value;
                console.log(selectedValue);

                if (selectedValue === '8' && labelElement8.classList.contains('cursor-pointer')) {
                    labelElement8.style.backgroundColor = '#99f6e4';
                    labelElement9.style.backgroundColor = ''
                    labelElement10.style.backgroundColor = ''
                    labelElement11.style.backgroundColor = ''
                    labelElement12.style.backgroundColor = ''
                    labelElement13.style.backgroundColor = ''
                    labelElement14.style.backgroundColor = ''
                    labelElement15.style.backgroundColor = ''
                    labelElement16.style.backgroundColor = ''
                } else if (selectedValue === '9' && labelElement9.classList.contains('cursor-pointer')) {
                    labelElement8.style.backgroundColor = '';
                    labelElement9.style.backgroundColor = '#99f6e4'
                    labelElement10.style.backgroundColor = ''
                    labelElement11.style.backgroundColor = ''
                    labelElement12.style.backgroundColor = ''
                    labelElement13.style.backgroundColor = ''
                    labelElement14.style.backgroundColor = ''
                    labelElement15.style.backgroundColor = ''
                    labelElement16.style.backgroundColor = ''
                } else if (selectedValue === '10' && labelElement10.classList.contains('cursor-pointer')) {
                    labelElement8.style.backgroundColor = '';
                    labelElement9.style.backgroundColor = ''
                    labelElement10.style.backgroundColor = '#99f6e4'
                    labelElement11.style.backgroundColor = ''
                    labelElement12.style.backgroundColor = ''
                    labelElement13.style.backgroundColor = ''
                    labelElement14.style.backgroundColor = ''
                    labelElement15.style.backgroundColor = ''
                    labelElement16.style.backgroundColor = ''
                } else if (selectedValue === '11' && labelElement11.classList.contains('cursor-pointer')) {
                    labelElement8.style.backgroundColor = '';
                    labelElement9.style.backgroundColor = ''
                    labelElement10.style.backgroundColor = ''
                    labelElement11.style.backgroundColor = '#99f6e4'
                    labelElement12.style.backgroundColor = ''
                    labelElement13.style.backgroundColor = ''
                    labelElement14.style.backgroundColor = ''
                    labelElement15.style.backgroundColor = ''
                    labelElement16.style.backgroundColor = ''
                } else if (selectedValue === '12' && labelElement12.classList.contains('cursor-pointer')) {
                    labelElement8.style.backgroundColor = '';
                    labelElement9.style.backgroundColor = ''
                    labelElement10.style.backgroundColor = ''
                    labelElement11.style.backgroundColor = ''
                    labelElement12.style.backgroundColor = '#99f6e4'
                    labelElement13.style.backgroundColor = ''
                    labelElement14.style.backgroundColor = ''
                    labelElement15.style.backgroundColor = ''
                    labelElement16.style.backgroundColor = ''
                } else if (selectedValue === '13' && labelElement13.classList.contains('cursor-pointer')) {
                    labelElement8.style.backgroundColor = '';
                    labelElement9.style.backgroundColor = ''
                    labelElement10.style.backgroundColor = ''
                    labelElement11.style.backgroundColor = ''
                    labelElement12.style.backgroundColor = ''
                    labelElement13.style.backgroundColor = '#99f6e4'
                    labelElement14.style.backgroundColor = ''
                    labelElement15.style.backgroundColor = ''
                    labelElement16.style.backgroundColor = ''
                } else if (selectedValue === '14' && labelElement14.classList.contains('cursor-pointer')) {
                    labelElement8.style.backgroundColor = '';
                    labelElement9.style.backgroundColor = ''
                    labelElement10.style.backgroundColor = ''
                    labelElement11.style.backgroundColor = ''
                    labelElement12.style.backgroundColor = ''
                    labelElement13.style.backgroundColor = ''
                    labelElement14.style.backgroundColor = '#99f6e4'
                    labelElement15.style.backgroundColor = ''
                    labelElement16.style.backgroundColor = ''
                } else if (selectedValue === '15' && labelElement15.classList.contains('cursor-pointer')) {
                    labelElement8.style.backgroundColor = '';
                    labelElement9.style.backgroundColor = ''
                    labelElement10.style.backgroundColor = ''
                    labelElement11.style.backgroundColor = ''
                    labelElement12.style.backgroundColor = ''
                    labelElement13.style.backgroundColor = ''
                    labelElement14.style.backgroundColor = ''
                    labelElement15.style.backgroundColor = '#99f6e4'
                    labelElement16.style.backgroundColor = ''
                } else if (selectedValue === '16' && labelElement16.classList.contains('cursor-pointer')) {
                    labelElement8.style.backgroundColor = '';
                    labelElement9.style.backgroundColor = ''
                    labelElement10.style.backgroundColor = ''
                    labelElement11.style.backgroundColor = ''
                    labelElement12.style.backgroundColor = ''
                    labelElement13.style.backgroundColor = ''
                    labelElement14.style.backgroundColor = ''
                    labelElement15.style.backgroundColor = ''
                    labelElement16.style.backgroundColor = '#99f6e4'
                }
            }
        }
    }

    function checkEndDate() {
        const selectedDate = document.getElementById("tgl_selesai").value
        const currentDate = @json($arr);

        const matchingDateItem = currentDate.find(item => item[0] === selectedDate);
        const emptyArr = [];
        const newArray = [];

        if (matchingDateItem) {
            const index1 = matchingDateItem[1];
            const index2 = matchingDateItem[2];
            emptyArr.push(index1, index2)
        } else {
            console.log("Tanggal tidak ditemukan dalam array.");
        }

        for (let i = parseInt(emptyArr[0]); i <= parseInt(emptyArr[1]); i++) {
            newArray.push(i.toString().padStart(1, '0'));
        }

        console.log(newArray);

        // ===================================================================

        const jam = document.getElementById("data-jam-selesai");

        const isDateInCurrentDate = currentDate.some(item => item[0] === selectedDate);

        jam.innerHTML = '';

        if (isDateInCurrentDate) {
            for (let i = 8; i <= 15; i++) {
                const value = i.toString();
                const isUsed = newArray.includes(value);

                jam.innerHTML +=
                    `<label class="${isUsed ? 'inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-500/20 disabled cursor-not-allowed text-red-800' : 'inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-100 text-teal-800 cursor-pointer'} mr-1" id="${value}-jam_selesai">
                        <input type="radio" name="jam_selesai" value="${value}" id="${value}-jam_selesai" onclick="getValueTwo()" />
                        ${value}:00
                    </label>`;
            }
        } else {
            for (let i = 8; i <= 15; i++) {
                const value = i.toString();
                jam.innerHTML +=
                    `<label class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-100 text-teal-800 cursor-pointer mr-1" id="${value}-jam_selesai">
                        <input type="radio" name="jam_selesai" value="${value}" id="${value}-jam_selesai" onclick="getValueTwo()" />
                        ${value}:00
                    </label>`;
            }
        }
    }

    function getValueTwo() {
        const radioButton = document.getElementsByName("jam_selesai");
        const labelElement8 = document.getElementById('8-jam_selesai');
        const labelElement9 = document.getElementById('9-jam_selesai');
        const labelElement10 = document.getElementById('10-jam_selesai');
        const labelElement11 = document.getElementById('11-jam_selesai');
        const labelElement12 = document.getElementById('12-jam_selesai');
        const labelElement13 = document.getElementById('13-jam_selesai');
        const labelElement14 = document.getElementById('14-jam_selesai');
        const labelElement15 = document.getElementById('15-jam_selesai');
        const labelElement16 = document.getElementById('16-jam_selesai');

        for (let i = 0; i < radioButton.length; i++) {
            if (radioButton[i].checked) {
                const selectedValue = radioButton[i].value;

                if (selectedValue === '8' && labelElement8.classList.contains('cursor-pointer')) {
                    labelElement8.style.backgroundColor = '#99f6e4';
                    labelElement9.style.backgroundColor = ''
                    labelElement10.style.backgroundColor = ''
                    labelElement11.style.backgroundColor = ''
                    labelElement12.style.backgroundColor = ''
                    labelElement13.style.backgroundColor = ''
                    labelElement14.style.backgroundColor = ''
                    labelElement15.style.backgroundColor = ''
                    labelElement16.style.backgroundColor = ''
                } else if (selectedValue === '9' && labelElement9.classList.contains('cursor-pointer')) {
                    labelElement8.style.backgroundColor = '';
                    labelElement9.style.backgroundColor = '#99f6e4'
                    labelElement10.style.backgroundColor = ''
                    labelElement11.style.backgroundColor = ''
                    labelElement12.style.backgroundColor = ''
                    labelElement13.style.backgroundColor = ''
                    labelElement14.style.backgroundColor = ''
                    labelElement15.style.backgroundColor = ''
                    labelElement16.style.backgroundColor = ''
                } else if (selectedValue === '10' && labelElement10.classList.contains('cursor-pointer')) {
                    labelElement8.style.backgroundColor = '';
                    labelElement9.style.backgroundColor = ''
                    labelElement10.style.backgroundColor = '#99f6e4'
                    labelElement11.style.backgroundColor = ''
                    labelElement12.style.backgroundColor = ''
                    labelElement13.style.backgroundColor = ''
                    labelElement14.style.backgroundColor = ''
                    labelElement15.style.backgroundColor = ''
                    labelElement16.style.backgroundColor = ''
                } else if (selectedValue === '11' && labelElement11.classList.contains('cursor-pointer')) {
                    labelElement8.style.backgroundColor = '';
                    labelElement9.style.backgroundColor = ''
                    labelElement10.style.backgroundColor = ''
                    labelElement11.style.backgroundColor = '#99f6e4'
                    labelElement12.style.backgroundColor = ''
                    labelElement13.style.backgroundColor = ''
                    labelElement14.style.backgroundColor = ''
                    labelElement15.style.backgroundColor = ''
                    labelElement16.style.backgroundColor = ''
                } else if (selectedValue === '12' && labelElement12.classList.contains('cursor-pointer')) {
                    labelElement8.style.backgroundColor = '';
                    labelElement9.style.backgroundColor = ''
                    labelElement10.style.backgroundColor = ''
                    labelElement11.style.backgroundColor = ''
                    labelElement12.style.backgroundColor = '#99f6e4'
                    labelElement13.style.backgroundColor = ''
                    labelElement14.style.backgroundColor = ''
                    labelElement15.style.backgroundColor = ''
                    labelElement16.style.backgroundColor = ''
                } else if (selectedValue === '13' && labelElement13.classList.contains('cursor-pointer')) {
                    labelElement8.style.backgroundColor = '';
                    labelElement9.style.backgroundColor = ''
                    labelElement10.style.backgroundColor = ''
                    labelElement11.style.backgroundColor = ''
                    labelElement12.style.backgroundColor = ''
                    labelElement13.style.backgroundColor = '#99f6e4'
                    labelElement14.style.backgroundColor = ''
                    labelElement15.style.backgroundColor = ''
                    labelElement16.style.backgroundColor = ''
                } else if (selectedValue === '14' && labelElement14.classList.contains('cursor-pointer')) {
                    labelElement8.style.backgroundColor = '';
                    labelElement9.style.backgroundColor = ''
                    labelElement10.style.backgroundColor = ''
                    labelElement11.style.backgroundColor = ''
                    labelElement12.style.backgroundColor = ''
                    labelElement13.style.backgroundColor = ''
                    labelElement14.style.backgroundColor = '#99f6e4'
                    labelElement15.style.backgroundColor = ''
                    labelElement16.style.backgroundColor = ''
                } else if (selectedValue === '15' && labelElement15.classList.contains('cursor-pointer')) {
                    labelElement8.style.backgroundColor = '';
                    labelElement9.style.backgroundColor = ''
                    labelElement10.style.backgroundColor = ''
                    labelElement11.style.backgroundColor = ''
                    labelElement12.style.backgroundColor = ''
                    labelElement13.style.backgroundColor = ''
                    labelElement14.style.backgroundColor = ''
                    labelElement15.style.backgroundColor = '#99f6e4'
                    labelElement16.style.backgroundColor = ''
                } else if (selectedValue === '16' && labelElement16.classList.contains('cursor-pointer')) {
                    labelElement8.style.backgroundColor = '';
                    labelElement9.style.backgroundColor = ''
                    labelElement10.style.backgroundColor = ''
                    labelElement11.style.backgroundColor = ''
                    labelElement12.style.backgroundColor = ''
                    labelElement13.style.backgroundColor = ''
                    labelElement14.style.backgroundColor = ''
                    labelElement15.style.backgroundColor = ''
                    labelElement16.style.backgroundColor = '#99f6e4'
                }
            }
        }
    }
</script>

@endsection

