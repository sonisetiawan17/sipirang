@extends('layouts.default')

@section('title', 'Histori Permohonan')

@push('css')
    <link href="/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
    <link href="/assets/plugins/datatables.net-select-bs4/css/select.bootstrap4.min.css" rel="stylesheet" />
@endpush

@section('content')
    <nav class="flex ml-2" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="{{ route('admin.index') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary no-underline hover:no-underline">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Beranda
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="#" class="ms-1 text-sm text-gray-500 md:ms-2 no-underline hover:no-underline">History
                        Permohonan</a>
                </div>
            </li>
        </ol>
    </nav>
    <!-- end page-header -->
    <!-- begin row -->
    <div class="row mt-4">
        <!-- begin col-112 -->
        <div class="col-xl-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading" style="background-color: #ffffff;">
                    <h4 class="panel-title text-black"><i class="fa fa-user mr-2"></i>History Permohonan</h4>
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    @if (session('sukses'))
                        <div class="alert alert-success fade show">
                            <span class="close" data-dismiss="alert">×</span>

                            {{ session('sukses') }}
                        </div>
                    @endif
                    <table id="data-table-select" class="table table-striped table-bordered table-td-valign-middle"
                        width="100%">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th class="text-nowrap">Nama Pemohon</th>
                                <th class="text-nowrap">Kegiatan</th>
                                <th class="text-nowrap">Surat Permohonan</th>
                                <th class="text-nowrap">Rundown Acara</th>
                                <th class="text-nowrap">Status</th>
                                <th class="text-nowrap">ACC</th>
                                <th class="text-nowrap">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1; @endphp
                            @foreach ($permohonan as $p)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->nama_kegiatan }}</td>
                                    <td><a target=_blank href="/file_upload/{{ $p->surat_permohonan }}"><small><i
                                                    class="fa fa-cloud-download-alt"></i> Surat</a></small></td>
                                    <td><a target=_blank href="/file_upload/{{ $p->rundown_acara }}"><small><i
                                                    class="fa fa-cloud-download-alt"></i> Rundown</a></small></td>

                                    <td>
                                        <div class="progress progress-sm rounded-corner m-b-5">
                                            @if ($p->status_permohonan == 'menunggu')
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-yellow f-s-10 f-w-900"
                                                    style="width: 50%;">50%</div>
                                            @elseif($p->status_permohonan == 'diterima')
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary f-s-10 f-w-900"
                                                    style="width: 100%;">100%</div>
                                            @else
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger f-s-10 f-w-900"
                                                    style="width: 100%;">0%</div>
                                            @endif
                                        </div>
                                        <div class="clearfix f-s-10">
                                            status:
                                            <b class="text-inverse" data-id="widget-elm" data-light-class="text-inverse"
                                                data-dark-class="text-white">{{ $p->status_permohonan }}</b>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex flex-row items-center gap-1">
                                            {{-- <a id="modal_show" href="#" data-toggle="modal" data-target="#modal-acc"
                                                data-id_permohonan="{{ $p->id_permohonan }}" type="button"
                                                class="btn btn-green btn-xs" placholder="Terima Permohonan"><i
                                                    style="font-size:90%" class="fa fa-check text-white"></i></a>
                                            <a id="modal_show" href="#" data-toggle="modal" data-target="#modal-tolak"
                                                data-id_permohonan="{{ $p->id_permohonan }}" type="button"
                                                class="btn btn-red btn-xs" placholder="Tolak Permohonan"><i
                                                    style="font-size:100%" class="fa fa-times text-white"></i></a> --}}
                                            <a id="modal_show" href="#" data-toggle="modal" data-target="#modal-acc"
                                                data-id_permohonan="{{ $p->id_permohonan }}" type="button"
                                                class="bg-green-500 hover:bg-green-500/70 transition px-[10px] py-[3px] rounded-sm"
                                                placholder="Terima Permohonan"><i style="font-size:75%"
                                                    class="fa fa-check text-white"></i></a>
                                            <a id="modal_show" href="#" data-toggle="modal" data-target="#modal-tolak"
                                                data-id_permohonan="{{ $p->id_permohonan }}" type="button"
                                                class="bg-red-500 hover:bg-red-500/70 transition px-[11px] py-[3px] rounded-sm"
                                                placholder="Tolak Permohonan"><i style="font-size:75%"
                                                    class="fa fa-times text-white"></i></a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            {{-- <a href="{{ route('admin.lihatPermohonan', $p->id_permohonan) }}"
                                                class="btn btn-white"><i class="fa fa-edit text-blue"></i></a>
                                            <a href="{{ route('admin.lihatPermohonan', $p->id_permohonan) }}"
                                                class="btn btn-white"><i class="fa fa-search-plus text-black"></i></a> --}}
                                            <form action="{{ route('admin.hapus_permohonan', $p->id_permohonan) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-white title="Hapus Data"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                                        class="fa fa-trash text-red"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- end panel-body -->
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-10 -->
    </div>

    </div>
    </div>
    <!-- end row -->

    <!-- #modal-dialog acc -->
    <div class="modal fade" id="modal-acc">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg p-3 mb-5 bg-white rounded">
                <div class="modal-header">
                    <h4 class="modal-title">Catatan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                            class="fa fa-times"></i></button>
                </div>
                <form method="post" action="{{ route('admin.terima_permohonan') }}">
                    @csrf
                    <div class="modal-body" id="tampilAcc">
                        <input type="hidden" id="id_permohonan" name="id_permohonan">
                        <input type="hidden" name="status_permohonan" value="diterima">
                        <textarea
                            class="border-gray-200 border-2 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md w-full"
                            name="catatan" placeholder="Tuliskan keterangan" autofocus style="font-size: 13px"></textarea>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="button-ghost" data-dismiss="modal">Batal</a>
                        <button type="submit" class="button-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end modal  -->

    <!-- #modal-dialog tolak -->
    <div class="modal fade" id="modal-tolak">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg p-3 mb-5 bg-white rounded">
                <div class="modal-header">
                    <h4 class="modal-title">Catatan Tolak</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                            class="fa fa-times"></i></button>
                </div>
                <form method="post" action="{{ route('admin.tolak_permohonan') }}">
                    @csrf
                    <div class="modal-body" id="tampilAcc">
                        <input type="hidden" id="id_permohonan" name="id_permohonan">
                        <input type="hidden" name="status_permohonan" value="ditolak">
                        <textarea class="border-gray-200 border-2 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md w-full" name="catatan" placeholder="Tuliskan Keterangan" autofocus style="font-size: 13px"></textarea>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="button-ghost" data-dismiss="modal">Batal</a>
                        <button type="submit" class="button-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- end modal  -->
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).on("click", "#modal_show", function() {
            var id_permohonan = $(this).data('id_permohonan');

            $("#tampilAcc #id_permohonan").val(id_permohonan);

        })
    </script>
    <script src="/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="/assets/plugins/datatables.net-select/js/dataTables.select.min.js"></script>
    <script src="/assets/plugins/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>
    <script src="/assets/js/demo/table-manage-select.demo.js"></script>
    <script src="/assets/js/demo/ui-modal-notification.demo.js"></script>
    <script src="/assets/plugins/sweetalert/dist/sweetalert.min.js"></script>
@endpush
