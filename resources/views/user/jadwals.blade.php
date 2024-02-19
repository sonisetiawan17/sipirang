@extends('layouts.landing')

@section('content')

@php

$schedule = $jadwal;

@endphp

<main class="bg-[#f7f7f8]">
    <div class="pt-[120px] mx-[140px]">
        <div class="bg-white border border-neutral-400">
            <div class="flex flex-row items-start justify-center gap-x-2 border-b border-neutral-200 py-4">
                <img src="{{ asset('/assets/img/auth/kalendar.png') }}" alt="kalendar" class="h-4" />
                <h1 class="font-semibold" style="font-size: 15px">February 2024</h1>
            </div> 
            <div class="py-2 border-b border-neutral-200 px-4">
                <ul class="flex items-center gap-5">
                    @foreach ($day as $d)
                        <li class="cursor-pointer" id="date" data-tgl="{{ $currentYear }}-{{ $currentMonthNum }}-{{ $d }}" onclick="checkSchedule(this)">{{ $currentYear }}-{{ $currentMonthNum }}-{{ $d }}</li>
                    @endforeach
                    {{-- <li class="cursor-pointer" id="date" onclick="checkSchedule('2024-02-19')">2024-02-19</li>
                    <li class="cursor-pointer" id="date" onclick="checkSchedule('2024-02-20')">2024-02-20</li> --}}
                </ul>
            </div>
            
            <div class="px-4 pt-4">
                <h1 class="font-bold text-lg text-green-500">Ruang Multimedia</h1>
                <div>
                    <p>Jam tersedia</p>
                </div>
            </div>

            <div class="p-4 grid grid-cols-4 gap-5" id="jadwal-multimedia">
            </div>
            
            <div class="px-4 pt-4">
                <h1 class="font-bold text-lg text-blue-500">Ruang Aula</h1>
                <div>
                    <p>Jam tersedia</p>
                </div>
            </div>

            <div class="p-4 grid grid-cols-4 gap-5" id="jadwal-aula">      
            </div>  
        </div>
    </div>
</main>

<script>
    const dataJadwal = @json($schedule);

    function checkSchedule(date) {
        const dates = date.dataset.tgl;
    // Lakukan sesuatu dengan tanggal (date)
    console.log(dates);
        const jadwalMultimedia = document.getElementById("jadwal-multimedia");
        const jadwalAula = document.getElementById("jadwal-aula");

        const dateValue = dates;
        const check = dataJadwal.filter(item => item.tgl_mulai === dateValue)
        console.log(check);

        jadwalMultimedia.innerHTML = '';
        jadwalAula.innerHTML = '';

        check.map(item => {
            if (item.nama_fasilitas === 'Multimedia') {
                jadwalMultimedia.innerHTML += 
                `<div class="flex flex-col gap-2 p-3 bg-white border-t border-t-neutral-100 border-r border-r-neutral-100 border-b border-b-neutral-100 rounded-lg w-full px-4 border-l-4 border-l-green-500" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                    <div class="flex flex-row items-center gap-x-2">
                        <img src="{{ asset('/assets/img/auth/user.png') }}" class="h-3" />
                        <p class=" text-neutral-500 font-medium" style="font-size: 11px">${item.name}</p>
                    </div>
                    <p class="text-lg font-semibold">${item.jam_mulai.length === 1 ? '0' + item.jam_mulai : item.jam_mulai}:00 - ${item.jam_selesai.length === 1 ? '0' + item.jam_selesai : item.jam_selesai}:00</p>
                    <p class="font-medium text-green-500">${item.nama_fasilitas}</p>
                </div>`
            } else {
                jadwalAula.innerHTML += 
                `<div class="flex flex-col gap-2 p-3 bg-white border-t border-t-neutral-100 border-r border-r-neutral-100 border-b border-b-neutral-100 rounded-lg w-full px-4 border-l-4 border-l-blue-500" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                    <div class="flex flex-row items-center gap-x-2">
                        <img src="{{ asset('/assets/img/auth/user.png') }}" class="h-3" />
                        <p class=" text-neutral-500 font-medium" style="font-size: 11px">${item.name}</p>
                    </div>
                    <p class="text-lg font-semibold">${item.jam_mulai.length === 1 ? '0' + item.jam_mulai : item.jam_mulai}:00 - ${item.jam_selesai.length === 1 ? '0' + item.jam_selesai : item.jam_selesai}:00</p>
                    <p class="font-medium text-blue-500">${item.nama_fasilitas}</p>
                </div>`
            }
        })

        // check.map(item => (
        //     if ($item.nama_fasilitas === 'Multimedia') {

        //     }
        // ))
    }
</script>

@endsection

