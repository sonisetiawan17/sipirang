<?php

return [
    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */

    'menu' => [
        [
            'icon' => 'fa fa-th-large',
            'title' => 'Beranda',
            'url' => '/admin/dashboard',
        ],
        [
            'icon' => 'fa fa-user',
            'title' => 'Data User',
            'url' => '/admin/users',
        ],
        [
            'icon' => 'fa fa-file-alt',
            'title' => 'Data Master',
            'url' => '#',
            'caret' => true,
            'sub_menu' => [
                [
                    'url' => '/admin/jadwal',
                    'title' => 'Jadwal',
                ],
                [
                    'url' => '/admin/fasilitas',
                    'title' => 'Fasilitas',
                ],
                [
                    'url' => '/admin/instansi',
                    'title' => 'Instansi',
                ],
                [
                    'url' => '/admin/alat-pendukung',
                    'title' => 'Alat Pendukung',
                ],
                [
                    'url' => '/admin/blok-ruangan',
                    'title' => 'Blok Ruangan',
                ],
                [
                    'url' => '/admin/bidang-kegiatan',
                    'title' => 'Bidang Kegiatan',
                ],
            ],
        ],
        [
            'icon' => 'fa fa-folder',
            'title' => 'History Permohonan',
            'url' => '/admin/history',
        ],
    ],
];
