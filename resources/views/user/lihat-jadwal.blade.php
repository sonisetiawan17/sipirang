@extends('layouts.user')

@section('title', 'Dashboard V2')

@push('css')
    <link href="/assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" />
    <link href="/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
    <link href="/assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
@endpush

@section('content')

@php
// Dummy data untuk dijadikan contoh
$data = [];
@endphp

    <div>
        <div>
            <h1 class="font-semibold text-xl">February</h1>
        </div>
        <div class="mt-4 flex flex-row items-center gap-3">
            <button class="w-[10%] rounded-md border-2 border-neutral-200 tanggal-button" value="01">
                <div class="flex flex-col items-center py-1">
                    <p class="font-medium text-lg">01</p>
                    <p>Kamis</p>
                </div>
            </button>
            <button class="w-[10%] rounded-md border-2 border-neutral-200 tanggal-button" value="02">
                <div class="flex flex-col items-center py-1">
                    <p class="font-medium text-lg">02</p>
                    <p>Jum'at</p>
                </div>
            </button>
            <button class="w-[10%] rounded-md border-2 border-neutral-200 tanggal-button" value="03">
                <div class="flex flex-col items-center py-1">
                    <p class="font-medium text-lg">03</p>
                    <p>Sabtu</p>
                </div>
            </button>
        </div>

        <div id="jadwal-container">
            @foreach($data as $jadwal)
                <div>
                    {{ $jadwal->tgl_mulai }}
                </div>
            @endforeach
        </div>

        <div class="flex flex-col" style="margin-top: 30px;">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="border rounded-lg overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">No</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Ruangan
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Tanggal
                                        Mulai</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Tanggal
                                        Selesai</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Waktu</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">1</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Aula</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">1 February 2024</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">1 February 2024</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-100 text-teal-800 ">Badge</span>
                                            <span
                                                class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-100 text-teal-800 ">Badge</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
    
    <script>
        $(document).ready(function () {
            $('.tanggal-button').on('click', function () {
                var tanggal = $(this).val();
    
                $.ajax({
                    type: 'GET',
                    url: '/jadwal/' + tanggal,
                    success: function (data) {
                        $('#jadwal-container').html(data);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endpush
