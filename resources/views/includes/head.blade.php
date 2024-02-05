<meta charset="utf-8" />
<title>Color Admin | @yield('title')</title>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />

<!-- ================== BEGIN BASE CSS STYLE ================== -->
{{-- <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet"> --}}
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

<link href="/assets/css/default/app.min.css" rel="stylesheet" />
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<!-- ================== END BASE CSS STYLE ================== -->

<!-- ================== TOAST CDN ================== -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
    integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    body {
        font-size: 13px;
        background-color: #f5f5f5;
        font-family: 'Inter', sans-serif;
    }

    .tgl_info {
        color: rgb(221, 26, 26);
        font-size: 12px;
        font-style: italic;
        padding-top: 10px;
    }

    .button-primary {
        padding: 8px 12px;
        background-color: #5465ff;
        color: white;
        border-radius: 2px;
        transition-duration: 300ms;
        font-size: 13px;
    }

    .button-primary:hover {
        background-color: #5465ffb3;
    }

    .button-ghost {
        padding: 8px 12px;
        background-color: rgb(215, 216, 218, 0.7);
        color: rgb(8, 8, 8);
        text-decoration: none;
        transition-duration: 300ms;
        border-radius: 2px;
        font-size: 13px;
    }

    .button-ghost:hover {
        background-color: rgba(215, 216, 218, 0.5);
        text-decoration: none;
        color: rgb(8, 8, 8);
    }

    .breadcrumb-item:hover {
        text-decoration: none !important;
    }

    .text-small {
        font-size: 13.5px;
        border-radius: 2px;
    }

    .panel-heading h4 {
        font-size: 17px !important;
        font-weight: 500 !important;
        padding: 8px 0 !important;
    }
</style>
@stack('css')
