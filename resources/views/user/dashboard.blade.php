@extends('layouts.user')

@section('title', 'Dashboard V2')

@push('css')
    <link href="/assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" />
    <link href="/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
    <link href="/assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
@endpush

@section('content')


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
@endpush
