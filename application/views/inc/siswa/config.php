<?php
$one->inc_header                 = APPPATH . 'views/inc/siswa/views/inc_header.php';
$one->inc_footer                 = APPPATH . 'views/inc/siswa/views/inc_footer.php';

$one->l_header_dark              = true;
$one->l_header_fixed             = false;

$one->l_m_content                = 'boxed';

$one->main_nav                   = [
    [
        'name'  => 'Dashboard',
        'icon'  => 'si si-compass',
        'url'   => base_url('siswa')
    ],
    [
        'name'  => 'Menu',
        'type'  => 'heading'
    ],
    [
        'name'  => 'Catatan Ibadahku',
        'icon'  => 'fa fa-book',
        'sub'   => kategori_ibadah(base_url('siswa/catatanku/'))
    ],
    [
        'name'  => 'Rekap',
        'icon'  => 'fa fa-print',
        'sub'   => [
            [
                'name'  => 'Rekap Ibadahku',
                'url'   => base_url('siswa/rekap')
            ]
        ]
    ],
    [
        'name'  => 'Infromasi',
        'icon'  => 'fa fa-info',
        'sub'   => [
            [
                'name'  => 'Materi',
                'url'   => base_url('siswa/materi')
            ]
        ]
    ]
];
