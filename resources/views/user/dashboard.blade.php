<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    @include('includes.head')
</head>

{{-- @push('css')
    <link href="/assets/plugins/smartwizard/dist/css/smart_wizard.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" />
    <link href="/assets/plugins/lightbox2/dist/css/lightbox.css" rel="stylesheet" />
@endpush --}}

<body>
    <nav class="fixed bg-transparent z-10 w-full border-b border-neutral-200">
        <div class="py-2 px-32">
            <div class="flex flex-row items-center justify-between">
                <div>
                    <img src="{{ asset('/assets/img/auth/logo.png') }}" class="h-[60px]" />
                </div>
                <div class="flex items-center gap-x-7">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"><p class="font-semibold cursor-pointer hover:text-[#0d34cd]">Log out</p></a>         
                    </form>
                    <button class="button-primary text-small rounded-lg px-4">Dashboard</button>
                </div>
            </div>
        </div>
    </nav>
    <main class="bg-[#f7f7f8]">
        <div class="pt-[77px] relative h-screen">
            <div class="absolute z-10 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[70%]">
                <div>
                    <h1 class="font-bold text-6xl text-center">Sistem Informasi Peminjaman <span
                            class="block pt-3 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-transparent bg-clip-text h-[85px]">Media Platform</span></h1>
                    <p class="pt-4 font-semibold text-lg text-center">87% Murid di Akademi berhasil melipatgandakan
                        portofolionya <span class="block pt-2">dalam waktu 3 bulan menggunakan strategi kita.</span></p>
                </div>

                <div class="mt-10 text-center">
                    <button class="bg-gradient-to-t from-primary to-blue-500 text-small rounded-lg px-4 text-white" style="padding: 8px 12px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">Lihat Ruangan</button>
                </div>
            </div>

            <div class="absolute bottom-0 bg-center bg-cover w-full h-[70%] z-0" style="background: linear-gradient(transparent 0%, #eff3fb 100%);">
                <!-- Your content goes here -->
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
                <div class="bg-[#f2f5fa] border shadow-sm rounded-xl w-[35%] mt-3 cursor-pointer transition-all duration-300 hover:transform hover:-translate-y-4 hover:transition-all hover:duration-300" style="padding: 12px">
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
                        <button id="modal_show" type="button" data-toggle="modal" data-target="#isimodal" data-id_fasilitas="{{ $item->id_fasilitas }}" data-nama_fasilitas="{{ $item->nama_fasilitas }}" class="mt-2 py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none w-full">
                            Pilih Ruangan
                        </button>
                    </div>
                    <img class="w-full h-auto rounded-xl border border-green-500 mt-4"
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
                                    <input type="hidden" class="form-control form-input text-small" name="id_fasilitas" id="id_fasilitas" />
                                    <input type="hidden" class="form-control form-input text-small" name="nama_fasilitas" id="nama_fasilitas" />
                                    <label class="col-form-label">Tanggal Mulai <sup class="text-red">*</sup></label>
                                    <div class="block">
                                        <input type="date" class="form-control form-input text-small" name="tgl_mulai" id="tgl_mulai" onchange="checkDate()" />
                                    </div>
        
                                    <label class="col-form-label mt-3">Jam Mulai <sup class="text-red">*</sup></label>
                                    <div class="block">
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons" id="data-jam">
                                            <p class="tgl_info">*Silahkan pilih tanggal mulai terlebih dahulu.</p>
                                        </div>
                                    </div>
        
                                    <label class="col-form-label mt-3">Tanggal Selesai <sup class="text-red">*</sup></label>
                                    <div class="block">
                                        <input type="date" class="form-control form-input text-small" name="tgl_selesai" id="tgl_selesai" onchange="checkDateDua()" />
                                    </div>
        
                                    <label class="col-form-label mt-3">Jam Selesai <sup class="text-red">*</sup></label>
                                    <div class="block">
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons" id="data-jam-dua">
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

        </div>
    </main>

    

    
</body>

{{-- @push('scripts')
        <script src="/assets/plugins/smartwizard/dist/js/jquery.smartWizard.js"></script>
        <script src="/assets/js/demo/form-wizards.demo.js"></script>
        <script src="/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
        <script src="/assets/plugins/isotope-layout/dist/isotope.pkgd.min.js"></script>
        <script src="/assets/plugins/lightbox2/dist/js/lightbox.min.js"></script>
        <script src="/assets/js/demo/gallery.demo.js"></script>

        <script type="text/javascript">
            $(document).on("click", "#modal_show", function() {
                var id_fasilitas = $(this).data('id_fasilitas');
                var nama_fasilitas = $(this).data('nama_fasilitas');

                $("#tampil_modal #id_fasilitas").val(id_fasilitas);
                $("#tampil_modal #nama_fasilitas").val(nama_fasilitas);
            })
        </script>
    @endpush --}}

</html>
