<?php
$one->inc_sidebar                = APPPATH . 'views/inc/admin/views/inc_sidebar.php';
$one->inc_header                 = APPPATH . 'views/inc/admin/views/inc_header.php';
$one->inc_footer                 = APPPATH . 'views/inc/admin/views/inc_footer.php';
$one->l_m_content                = 'narrow';
$one->main_nav                   = [
    [
        'name'  => 'Dashboard',
        'icon'  => 'si si-speedometer',
        'url'   => base_url('admin')
    ],
    [
        'name'  => 'Master Data',
        'icon'  => 'si si-layers',
        'sub'   => [
            [
                'name'  => 'Admin',
                'url'   => base_url('admin/list_admin')
            ],
            [
                'name'  => 'Daftar Siswa',
                'url'   => base_url('admin/siswa')
            ], [
                'name'  => 'Kategori Ibadah',
                'url'   => base_url('admin/kategori_ibadah')
            ], [
                'name'  => 'Rincian Ibadah',
                'sub'   => kategori_ibadah(base_url('admin/rincian_ibadah/'))
            ]
        ]
    ],
    [
        'name'  => 'Rekap Ibadah Siswa',
        'icon'  => 'fa fa-print',
        'sub'   => kategori_ibadah(base_url('admin/rekap_ibadah/'))
    ],
    [
        'name'  => 'Detail Ibadah Siswa',
        'icon'  => 'fa fa-info',
        'url'   => base_url('admin/detail_ibadah')
    ],
    [
        'name'  => 'Materi',
        'icon'  => 'fa fa-file',
        'url'   => base_url('admin/materi')
    ]
];
