<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('global_init')) {
    function global_init()
    {
        $CI = &get_instance();
        $CI->logout   = base_url('logout');
        $CI->u2        = $CI->uri->segment(2);
        $CI->u3        = $CI->uri->segment(3);
        $CI->u4        = $CI->uri->segment(4);
        $CI->u5        = $CI->uri->segment(5);
        $CI->u6        = $CI->uri->segment(6);
        $CI->u7        = $CI->uri->segment(7);
        $CI->u8        = $CI->uri->segment(8);
        $CI->u9        = $CI->uri->segment(9);
    }
}

if (!function_exists('enkrip')) {
    function enkrip($string)
    {
        $bumbu = md5(str_replace("=", "", base64_encode("catatanibadah.xyz")));
        $katakata = false;
        $metodeenkrip = "AES-256-CBC";
        $kunci = hash('sha256', $bumbu);
        $kodeiv = substr(hash('sha256', $bumbu), 0, 16);

        $katakata = str_replace("=", "", openssl_encrypt($string, $metodeenkrip, $kunci, 0, $kodeiv));
        $katakata = str_replace("=", "", base64_encode($katakata));

        return $katakata;
    }
}

if (!function_exists('dekrip')) {
    function dekrip($string)
    {
        $bumbu = md5(str_replace("=", "", base64_encode("catatanibadah.xyz")));
        $katakata = false;
        $metodeenkrip = "AES-256-CBC";
        $kunci = hash('sha256', $bumbu);
        $kodeiv = substr(hash('sha256', $bumbu), 0, 16);

        $katakata = openssl_decrypt(base64_decode($string), $metodeenkrip, $kunci, 0, $kodeiv);
        return $katakata;
    }
}

if (!function_exists('base64img')) {
    function base64img($url)
    {
        $type = pathinfo($url, PATHINFO_EXTENSION);
        $data = file_get_contents($url);
        $base64img = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64img;
    }
}

if (!function_exists('admin_init')) {
    function admin_init()
    {
        $CI = &get_instance();
        if (empty($CI->session->userdata('log_admin'))) {
            $CI->session->set_flashdata('error', 'Silakan login terlebih dahulu!!');
            redirect('login', 'refresh');
        } else {
            $CI->login            = $CI->session->userdata('log_admin')['is_logged_in'];
            $CI->id_user          = $CI->session->userdata('log_admin')['id'];
        }
        global_init();

        $CI->load->model('M_Admin', 'admin');
        $CI->user      = $CI->universal->getOne(['id' => $CI->id_user], 'admin');
    }
}

if (!function_exists('siswa_init')) {
    function siswa_init()
    {
        $CI = &get_instance();
        if (empty($CI->session->userdata('log_siswa'))) {
            $CI->session->set_flashdata('error', 'Silakan login terlebih dahulu!!');
            redirect('login', 'refresh');
        } else {
            $CI->login        = $CI->session->userdata('log_siswa')['is_logged_in'];
            $CI->id_siswa     = $CI->session->userdata('log_siswa')['id_siswa'];
        }
        global_init();

        $CI->load->model('M_siswa', 'siswa');
        $CI->user = $CI->siswa->getUser(['siswa.id' => $CI->id_siswa]);
    }
}

function bulan($bulan)
{
    switch ($bulan) {
        case 1:
            $bulan = "Januari";
            break;
        case 2:
            $bulan = "Februari";
            break;
        case 3:
            $bulan = "Maret";
            break;
        case 4:
            $bulan = "April";
            break;
        case 5:
            $bulan = "Mei";
            break;
        case 6:
            $bulan = "Juni";
            break;
        case 7:
            $bulan = "Juli";
            break;
        case 8:
            $bulan = "Agustus";
            break;
        case 9:
            $bulan = "September";
            break;
        case 10:
            $bulan = "Oktober";
            break;
        case 11:
            $bulan = "November";
            break;
        case 12:
            $bulan = "Desember";
            break;

        default:
            $bulan = Date('F');
            break;
    }
    return $bulan;
}

function hari($hari)
{
    if ($hari == 1) {
        $hari = "Senin";
    } else if ($hari == 2) {
        $hari = "Selasa";
    } else if ($hari == 3) {
        $hari = "Rabu";
    } else if ($hari == 4) {
        $hari = "Kamis";
    } else if ($hari == 5) {
        $hari = "Jum'at";
    } else if ($hari == 6) {
        $hari = "Sabtu";
    } else if ($hari == 7) {
        $hari = "Ahad";
    }
    return $hari;
}
function tanggal($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = bulan(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);
    $waktu = substr($tgl, 11);
    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}
function tanggal_indo()
{
    $tanggal = Date('d') . " " . bulan(date('m')) . " " . Date('Y');
    return $tanggal;
}


if (!function_exists('img_resize')) {
    function img_resize($newWidth, $targetFile, $originalFile)
    {
        $info = getimagesize($originalFile);
        $mime = $info['mime'];

        switch ($mime) {
            case 'image/jpeg':
                $image_create_func = 'imagecreatefromjpeg';
                $image_save_func = 'imagejpeg';
                $new_image_ext = 'jpg';
                break;

            case 'image/png':
                $image_create_func = 'imagecreatefrompng';
                $image_save_func = 'imagepng';
                $new_image_ext = 'png';
                break;

            case 'image/gif':
                $image_create_func = 'imagecreatefromgif';
                $image_save_func = 'imagegif';
                $new_image_ext = 'gif';
                break;

            default:
                throw new Exception('Unknown image type.');
        }

        $img = $image_create_func($originalFile);
        list($width, $height) = getimagesize($originalFile);

        if ($width > $height) {
            $y = 0;
            $x = ($width - $height) / 2;
            $smallestSide = $height;
        } else {
            $x = 0;
            $y = ($height - $width) / 2;
            $smallestSide = $width;
        }

        //$newHeight = ($height / $width) * $newWidth;
        $tmp = imagecreatetruecolor($newWidth, $newWidth);
        imagecopyresampled($tmp, $img, 0, 0, $x, $y, $newWidth, $newWidth, $smallestSide, $smallestSide);

        if (file_exists($targetFile)) {
            unlink($targetFile);
        }

        $image_save_func($tmp, "$targetFile");
    }
}

if (!function_exists('kategori_ibadah')) {
    function kategori_ibadah($url)
    {
        $CI = &get_instance();
        $data = $CI->universal->getMulti('', 'kategori');
        $kategori = [];
        foreach ($data as $hasil) {
            array_push($kategori, [
                'name'      => $hasil->nama_kategori,
                'url'       => $url . enkrip($hasil->id)
            ]);
        }
        return $kategori;
    }
}
