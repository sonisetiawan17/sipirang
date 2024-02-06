@extends('layouts.super')

@section('title', 'Dashboard V2')

@push('css')
    <link href="/assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" />
    <link href="/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
    <link href="/assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
@endpush

@section('content')
    {{-- <div class="grid grid-cols-2">
		<div>
			<canvas id="myChart" height="200px"></canvas>
		</div>
	</div> --}}

    <div>
        <h1 class="font-semibold text-xl">Statistik Terbaru</h1>
        <div class="grid grid-cols-4 gap-x-7 mt-3">
            <div class="bg-white shadow-sm px-[20px] py-[20px] rounded-sm">
                <p class="text-neutral-500">Data permohonan</p>
                <div class="flex flex-row items-end gap-x-5 pt-3">
                    <div class="px-[16px] py-[12px] rounded-full bg-blue-500">
                        <i class="fa fa-check text-xl text-white"></i>
                    </div>
                    <div class="flex flex-col items-center">
                        <p class="font-semibold" style="font-size: 18px">1</p>
                        <p style="font-size: 13px">Disetujui</p>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm px-[20px] py-[20px] rounded-sm">
                <p class="text-neutral-500">Data permohonan</p>
                <div class="flex flex-row items-end gap-x-5 pt-3">
                    <div class="px-[16px] py-[12px] rounded-full bg-yellow-500">
                        <i class="fa fa-spinner text-xl text-white"></i>
                    </div>
                    <div class="flex flex-col items-center">
                        <p class="font-semibold" style="font-size: 18px">1</p>
                        <p style="font-size: 13px">Dalam Proses</p>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm px-[20px] py-[20px] rounded-sm">
                <p class="text-neutral-500">Data permohonan</p>
                <div class="flex flex-row items-end gap-x-5 pt-3">
                    <div class="px-[16px] py-[12px] rounded-full bg-red-500">
                        <i class="fa fa-ban text-xl text-white"></i>
                    </div>
                    <div class="flex flex-col items-center">
                        <p class="font-semibold" style="font-size: 18px">1</p>
                        <p style="font-size: 13px">Ditolak</p>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm px-[20px] py-[20px] rounded-sm">
                <p class="text-neutral-500">Data permohonan</p>
                <div class="flex flex-row items-end gap-x-5 pt-3">
                    <div class="px-[19px] py-[12px] rounded-full bg-green-500">
                        <i class="fa fa-clipboard-check text-xl text-white"></i>
                    </div>
                    <div class="flex flex-col items-center">
                        <p class="font-semibold" style="font-size: 18px">1</p>
                        <p style="font-size: 13px">Selesai</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <h1 class="font-semibold text-xl mt-5">Bidang Kegiatan Terbanyak</h1>
        <div class="grid grid-cols-4 gap-x-7 mt-3">
            <div class="bg-white shadow-sm px-[20px] py-[20px] rounded-sm">
                <p class="text-neutral-500">Bidang Kegiatan</p>
                <div class="flex flex-row items-end gap-x-5 pt-3">
                    <div class="px-[14px] py-[12px] rounded-full bg-blue-500">
                        <i class="fa fa-users text-xl text-white"></i>
                    </div>
                    <div class="flex flex-col items-center">
                        <p class="font-semibold" style="font-size: 18px">1</p>
                        <p style="font-size: 13px">Bappenda</p>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm px-[20px] py-[20px] rounded-sm">
                <p class="text-neutral-500">Bidang Kegiatan</p>
                <div class="flex flex-row items-end gap-x-5 pt-3">
                    <div class="px-[14px] py-[12px] rounded-full bg-yellow-500">
                        <i class="fa fa-users text-xl text-white"></i>
                    </div>
                    <div class="flex flex-col items-center">
                        <p class="font-semibold" style="font-size: 18px">1</p>
                        <p style="font-size: 13px">DPMPTSP</p>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm px-[20px] py-[20px] rounded-sm">
                <p class="text-neutral-500">Bidang Kegiatan</p>
                <div class="flex flex-row items-end gap-x-5 pt-3">
                    <div class="px-[14px] py-[12px] rounded-full bg-red-500">
                        <i class="fa fa-users text-xl text-white"></i>
                    </div>
                    <div class="flex flex-col items-center">
                        <p class="font-semibold" style="font-size: 18px">1</p>
                        <p style="font-size: 13px">Disdukcapil</p>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm px-[20px] py-[20px] rounded-sm">
                <p class="text-neutral-500">Bidang Kegiatan</p>
                <div class="flex flex-row items-end gap-x-5 pt-3">
                    <div class="px-[14px] py-[12px] rounded-full bg-green-500">
                        <i class="fa fa-users text-xl text-white"></i>
                    </div>
                    <div class="flex flex-col items-center">
                        <p class="font-semibold" style="font-size: 18px">1</p>
                        <p style="font-size: 13px">Diskominfo</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h1 class="font-semibold text-xl">Chart Statistik Permohonan</h1>
        <div class="mt-3 grid grid-cols-2 gap-5 bg-white p-7">
            <div>
                <canvas id="myChart" height="200px"></canvas>
            </div>
            <div>
                <canvas id="myChart2" height="200px"></canvas>
            </div>
        </div>
    </div>
    </div>
@endsection



@push('scripts')
    <script src="/assets/plugins/d3/d3.min.js"></script>
    <script src="/assets/plugins/nvd3/build/nv.d3.js"></script>
    <script src="/assets/plugins/jvectormap-next/jquery-jvectormap.min.js"></script>
    <script src="/assets/plugins/jvectormap-next/jquery-jvectormap-world-mill.js"></script>
    <script src="/assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js"></script>
    <script src="/assets/plugins/gritter/js/jquery.gritter.js"></script>
    <script src="/assets/js/demo/dashboard-v2.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember',
                ],
                datasets: [{
                    label: 'My First Dataset',
                    data: [65, 59, 80, 81, 56, 55, 40, 30, 90, 75, 60, 85],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        });

        const ctx2 = document.getElementById('myChart2');

        new Chart(ctx2, {
            type: 'line',
            data: {
                labels: [
                    'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember',
                ],
                datasets: [{
                    label: 'My First Dataset',
                    data: [65, 59, 80, 81, 56, 55, 40, 30, 90, 75, 60, 85],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        });
    </script>
@endpush
