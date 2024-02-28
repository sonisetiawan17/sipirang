<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8" />
    <title>SIPIRANG | @yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Mulish:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

</head>

<body>
    <nav class="fixed bg-[#f7f7f8] z-50 w-full border-b border-neutral-200">
        <div class="py-2 lg:px-32">
            <div class="flex flex-row items-center justify-between">
                <a href="/user/dashboard">
                    <img src="{{ asset('/assets/img/auth/logo.png') }}" class="h-[60px]" />
                </a>
                <div class="relative">
                    {{-- <form method="POST" action="{{ route('logout') }}" class="hidden md:inline-flex">
                        @csrf
                        <a :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"><p class="font-semibold cursor-pointer hover:text-[#0d34cd]">Log out</p></a>         
                    </form>
                    <a href="{{ route('user.test') }}">
                        <button class="button-primary text-small rounded-lg px-4">Dashboard</button>
                    </a> --}}
                    <div class="flex items-center gap-x-3 cursor-pointer">
                        <p>{{ Auth::user()->name }}</p>
                        <div class="border-2 border-lime-500 rounded-full">
                            <img src="{{ asset('/assets/img/auth/profile.png') }}" alt="user icon" class="h-8"  />
                        </div>
                        <img src="{{ asset('/assets/img/auth/down-arrow.png') }}" alt="arrow down" class="h-4" />
                    </div>
                    <div class="absolute right-0 mt-3 bg-white rounded-lg p-3" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                        <ul class="font-medium space-y-3">
                            <a href="{{ route('user.test') }}">
                                <li class="flex items-center cursor-pointer"><i class="fa-solid fa-house mr-3"></i>Dashboard</li>
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="hidden md:inline-flex">
                                @csrf
                                <a :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"><li class="flex items-center text-red-500 ml-[2px] cursor-pointer"><i class="fa-solid fa-right-from-bracket mr-3"></i>Log out</li></a>         
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    @yield('content')
</body>
</html>
