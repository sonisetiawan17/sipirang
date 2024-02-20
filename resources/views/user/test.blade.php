@extends('layouts.landing')

@section('content')

<main class="bg-[#f7f7f8] mx-32">
    <div class="grid grid-cols-[20%,1fr] gap-5">
        <div class="mt-[100px]">
            <div class="bg-white p-4 rounded-xl mt-3" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                <div class="flex flex-col items-center justify-center gap-y-3">
                    <img src="{{ asset('/assets/img/auth/profile.png') }}" class="h-20" />
                    <h1 class="font-medium">Soni Setiawan</h1>
                    <p class="text-neutral-400 text-center" style="font-size: 11px">Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu</p>
                </div>
                <div class="w-full h-[1px] bg-gray-300 my-4"></div>
                <div>
                    <div class="flex flex-col gap-y-1">
                        <p class="font-semibold">NIK</p>
                        <p class="text-neutral-500">3273071707008751</p>
                    </div>

                    <div class="flex flex-col gap-y-1 mt-3">
                        <p class="font-semibold">No Telepon</p>
                        <p class="text-neutral-500">085219887364</p>
                    </div>
                </div>
                <div class="w-full h-[1px] bg-gray-300 my-4"></div>
                <div>
                    <div class="flex flex-col gap-y-1 mt-3">
                        <p class="font-semibold">Permohonan Bulan Ini</p>
                        <p class="text-neutral-500">10 total permohonan</p>
                    </div>
                    <div class="flex flex-col gap-y-1 mt-3">
                        <p class="font-semibold">Semua Permohonan</p>
                        <p class="text-neutral-500">10 total permohonan</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-[100px]">
            <div class="bg-white p-4 rounded-xl mt-3" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                <div>
                    <ul class="flex flex-row gap-x-14 items-center w-[600px] font-medium border-b border-neutral-300 pb-3" id="tabList">
                        <li class="text-center cursor-pointer" onclick="showPage('dashboard', this)">Dashboard</li>
                        <li class="text-center cursor-pointer" onclick="showPage('profile', this)">Profil Saya</li>
                        <li class="text-center cursor-pointer" onclick="showPage('schedule', this)">Jadwal</li>
                        <li class="text-center cursor-pointer" onclick="showPage('history', this)">Histori Permohonan</li>
                    </ul>
    
                    {{-- <div class="w-[150px] bg-primary h-1 -mt-1 rounded-sm"></div> --}}
                </div>
    
                <div id="dashboardPage">
                    <div class="mt-4">
                        <h1 class="font-medium text-lg">Dashboard</h1>
                    </div>
                    <div class="grid grid-cols-3 gap-x-7 pt-4">            
                        <div class="yellow-gradient px-[20px] py-[20px] rounded-xl">
                            <p class="text-white">Data permohonan</p>
                            <div class="flex flex-row items-end gap-x-5 pt-3">
                                <div class="px-[16px] py-[12px] rounded-full bg-white">
                                    <i class="fa fa-spinner text-xl text-yellow-500"></i>
                                </div>
                                <div class="flex flex-col items-center text-white">
                                    <p class="font-semibold" style="font-size: 18px">1</p>
                                    <p style="font-size: 13px">Dalam Proses</p>
                                </div>
                            </div>
                        </div>
            
                        <div class="red-gradient px-[20px] py-[20px] rounded-xl">
                            <p class="text-white">Data permohonan</p>
                            <div class="flex flex-row items-end gap-x-5 pt-3">
                                <div class="px-[16px] py-[12px] rounded-full bg-white">
                                    <i class="fa fa-ban text-xl text-red-500"></i>
                                </div>
                                <div class="flex flex-col items-center text-white">
                                    <p class="font-semibold" style="font-size: 18px">1</p>
                                    <p style="font-size: 13px">Ditolak</p>
                                </div>
                            </div>
                        </div>
            
                        <div class="green-gradient px-[20px] py-[20px] rounded-xl">
                            <p class="text-white">Data permohonan</p>
                            <div class="flex flex-row items-end gap-x-5 pt-3">
                                <div class="px-[16px] py-[12px] rounded-full bg-white">
                                    <i class="fa fa-check text-xl text-green-500"></i>
                                </div>
                                <div class="flex flex-col items-center text-white">
                                    <p class="font-semibold" style="font-size: 18px">1</p>
                                    <p style="font-size: 13px">Disetujui</p>
                                </div>
                            </div>
                        </div>
            
                    </div>
                    <div class="mt-5">
                        <h1 class="font-medium text-lg mb-5">Chart Statistik Permohonan</h1>
                        <canvas id="barChart" height="150px"></canvas>
                    </div> 
                </div>
                
                <div id="profilePage" class="hide">
                    <div class="mt-4">
                        <h1 class="font-medium text-lg">Profil Saya</h1>
                        <div class="pt-4">
                            <div class="flex flex-row items-center gap-x-4 relative">
                                <img src="{{ asset('/assets/img/auth/profile.png') }}" class="h-20" />
                                <div class="flex flex-col items-start gap-y-1">
                                    <p class="font-medium" style="font-size: 13px">Soni Setiawan</p>
                                    <p class="text-neutral-600">User</p>
                                    <p class="text-neutral-500">Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu</p>
                                </div>
                                <div class="absolute top-1/2 right-0 transform -translate-y-1/2">
                                    <button class="border border-gray-400 py-2 px-3 text-neutral-600 rounded-2xl flex flex-row items-center gap-x-2">
                                        Edit 
                                        <img src="{{ asset('/assets/img/auth/edit.png') }}" class="h-4" />
                                    </button>
                                </div>
                            </div>
                            
                            <div class="pt-6">
                                <div class="flex flex-row items-center justify-between">
                                    <h1 class="font-medium">Personal Information</h1>
                                    <button class="border border-gray-400 py-2 px-3 text-neutral-600 rounded-2xl flex flex-row items-center gap-x-2">
                                        Edit 
                                        <img src="{{ asset('/assets/img/auth/edit.png') }}" class="h-4" />
                                    </button>
                                </div>
    
                                <div class="pt-3 grid grid-cols-[40%,1fr] gap-x-3 gap-y-10">
                                    <div class="">
                                        <h3 class="font-medium text-neutral-500">Nama</h3>
                                        <p class="pt-2">Soni Setiawan</p>
                                    </div>
                                    <div class="">
                                        <h3 class="font-medium text-neutral-500">Email</h3>
                                        <p class="pt-2">sonisetiawan059@gmail.com</p>
                                    </div>
                                    <div class="">
                                        <h3 class="font-medium text-neutral-500">Email Verified</h3>
                                        <p class="pt-2">
                                            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800">Belum Verifikasi</span>
                                        </p>
                                    </div>
                                    <div class="">
                                        <h3 class="font-medium text-neutral-500">No Telepon</h3>
                                        <p class="pt-2">085219881523</p>
                                    </div>
                                    <div class="">
                                        <h3 class="font-medium text-neutral-500">Alamat</h3>
                                        <p class="pt-2">Bandung, Indonesia</p>
                                    </div>
                                </div>
                            </div>
    
                            <div class="w-full h-[1px] bg-gray-300 my-8"></div>
    
                            <div>
                                <div class="flex flex-row items-center justify-between">
                                    <h1 class="font-medium">Instansi / Organisasi</h1>
                                    <button class="border border-gray-400 py-2 px-3 text-neutral-600 rounded-2xl flex flex-row items-center gap-x-2">
                                        Edit 
                                        <img src="{{ asset('/assets/img/auth/edit.png') }}" class="h-4" />
                                    </button>
                                </div>
    
                                <div class="pt-3 grid grid-cols-[40%,1fr] gap-x-3 gap-y-10">
                                    <div class="">
                                        <h3 class="font-medium text-neutral-500">Instansi</h3>
                                        <p class="pt-2 pr-5">Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu</p>
                                    </div>
                                    <div class="">
                                        <h3 class="font-medium text-neutral-500">Nama Organisasi</h3>
                                        <p class="pt-2">-</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                </div>
                
                <div id="schedulePage" class="hide">
                    <div class="mt-4">
                        <h1 class="font-medium text-lg">Jadwal</h1>
                    </div>
                </div>
                
                <div id="historyPage" class="hide">
                    <div class="mt-4 flex flex-row items-center justify-between">
                        <h1 class="font-medium text-lg">Histori Permohonan</h1>
                        <div class="">
                            <select class="text-xs rounded-sm border border-gray-300" name="skpd">
                                <option value="semua_waktu" selected>Semua Waktu</option>
                                <option value="tujuh_hari">7 Hari Terakhir</option>
                                <option value="sepuluh_hari">14 Hari Terakhir</option>
                                <option value="satu_bulan">1 Bulan Terakhir</option>
                                <option value="tiga_bulan">3 Bulan Terakhir</option>
                                <option value="enam_bulan">6 Bulan Terakhir</option>
                                <option value="dua_belas_bulan">12 Bulan Terakhir</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-3 border border-neutral-400">
                        <div class="bg-slate-200 border border-neutral-400 flex flex-row items-center justify-between">
                            <h1 class="font-semibold head">Permohonan</h1>
                            <input type="text" class="form-control form-input text-small w-1/4 mr-3" style="border-radius: 5px" name="search" id="search" placeholder="Cari disini..." />
                        </div>
                        <div class="bg-white">
                            <div class="flex flex-col head">
                                <div class="-m-1.5 overflow-x-auto">
                                  <div class="p-1.5 min-w-full inline-block align-middle">
                                    <div class="border overflow-hidden">
                                      <table class="min-w-full divide-y divide-gray-200">
                                        <thead>
                                          <tr class="divide-x divide-gray-200">
                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Tanggal Mulai</th>
                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Tanggal Selesai</th>
                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Pemohon</th>
                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Ruangan</th>
                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Status</th>
                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Waktu</th>
                                          </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                          <tr class="divide-x divide-gray-200">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Senin, 12 February 2024</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Senin, 12 February 2024</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Soni Setiawan</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Ruang Aula</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Selesai</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800"><span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-100 text-teal-800">08:00</span> - <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-100 text-teal-800">10:00</span></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </div>
                    </div>
                    <div class="mt-4">

                    </div>
                </div>         
            </div>
        </div>
    </div>

    <div class="mt-24">
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    function showPage(pageName, tab) {
        document.getElementById('dashboardPage').classList.add('hide');
        document.getElementById('profilePage').classList.add('hide');
        document.getElementById('schedulePage').classList.add('hide');
        document.getElementById('historyPage').classList.add('hide');

        Array.from(document.getElementById('tabList').getElementsByTagName('li')).forEach(item => {
            item.classList.remove('active');
        });

        document.getElementById(pageName + 'Page').classList.remove('hide');

        tab.classList.add('active');
    }

    showPage('dashboard', document.getElementById('tabList').querySelector('li'));

    const barctx = document.getElementById('barChart');

    new Chart(barctx, {
        type: 'bar',
        data: {
            labels: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'Mei',
                'Jun',
                'Jul',
                'Agu',
                'Sep',
                'Okt',
                'Nov',
                'Des',
            ],
            datasets: [{
                label: 'Aula',
                data: [65, 59, 80, 81, 56, 55, 40, 30, 90, 75, 60, 85],
                backgroundColor: 'rgba(60, 91, 214, 1)',
                borderColor: 'rgba(60, 91, 214, 1)',
                borderWidth: 1,
                borderRadius: 5,
            },
            {
                label: 'Multimedia',
                data: [65, 59, 80, 81, 56, 55, 40, 30, 90, 75, 60, 85],
                backgroundColor: 'rgba(170, 168, 236, 1)',
                borderColor: 'rgba(170, 168, 236, 1)',
                borderWidth: 1,
                borderRadius: 5,
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

@endsection
