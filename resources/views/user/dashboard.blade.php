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
    $currentDate = ["2024-01-24", "2024-01-25"];
    $jam_mulai = "9";
@endphp

<div class="panel-body panel-form">
    <div class="form-group row mb-3">
        <label class="col-lg-4 col-form-label">Selesai Tanggal</label>
        <div class="col-lg-3">
            <input type="date" class="form-control form-input text-small" name="tgl_selesai" id="tgl_selesai" onchange="checkDate()" />
        </div>
    </div>
</div>

<div class="panel-body panel-form">
    <div class="form-group row mb-3">
        <label class="col-lg-4 col-form-label">Mulai Jam</label>
        <div class="col-lg-6">
            <div class="btn-group">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-white" id="{{ $jam_mulai == "8" ? "result" : "8" }}">
                        <input type="radio" name="jam_mulai" value="8"
                            id="8" />08:00
                    </label>
                    <label class="btn btn-white" id="{{ $jam_mulai == "9" ? "result" : "9" }}">
                        <input type="radio" name="jam_mulai" value="9"
                            id="9" />09:00
                    </label>
                    <label class="btn btn-white" id="{{ $jam_mulai == "10" ? "result" : "10" }}">
                        <input type="radio" name="jam_mulai" value="10"
                            id="10" />10:00
                    </label>
                    <label class="btn btn-white" id="{{ $jam_mulai == "11" ? "result" : "11" }}">
                        <input type="radio" name="jam_mulai" value="11"
                            id="11" />11:00
                    </label>
                    <label class="btn btn-white" id="{{ $jam_mulai == "12" ? "result" : "12" }}">
                        <input type="radio" name="jam_mulai" value="12"
                            id="12" />12:00
                    </label>
                    <label class="btn btn-white" id="{{ $jam_mulai == "13" ? "result" : "13" }}">
                        <input type="radio" name="jam_mulai" value="13"
                            id="13" />13:00
                    </label>
                    <label class="btn btn-white" id="{{ $jam_mulai == "14" ? "result" : "14" }}">
                        <input type="radio" name="jam_mulai" value="14"
                            id="14" />14:00
                    </label>
                    <label class="btn btn-white" id="{{ $jam_mulai == "15" ? "result" : "15" }}">
                        <input type="radio" name="jam_mulai" value="15"
                            id="15" />15:00
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <h1 id="result">False</h1> --}}

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
        function checkDate() {
            const selectedDate = document.getElementById("tgl_selesai").value
            const currentDate = @json($currentDate); 

            const isDateInCurrentDate = currentDate.includes(selectedDate);

            if (isDateInCurrentDate) {
                document.getElementById("result").classList.add('hidden');
            } else {
                document.getElementById("result").classList.remove('hidden');
            }
        }
    </script>
@endpush
