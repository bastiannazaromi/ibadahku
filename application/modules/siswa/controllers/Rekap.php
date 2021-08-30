<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Rekap extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		siswa_init();
	}
	public function index()
	{
		$tanggal_awal	= $this->u3;
		$tanggal_akhir	= $this->u4;
		if (!$tanggal_awal) {
			$tanggal_awal = date('Y-m-d');
		}

		$date = strtotime($tanggal_awal);
		$hari_awal = date('N', $date);

		if (!$tanggal_akhir) {
			$tanggal_akhir = date('Y-m-d');
		}

		$date = strtotime($tanggal_akhir);
		$hari_akhir = date('N', $date);

		$params = [
			'title'     	=> 'Rekap Kegiatan Siswa',
			'tanggal_awal'	=> $tanggal_awal,
			'hari_awal'		=> hari($hari_awal),
			'tanggal_akhir'	=> $tanggal_akhir,
			'hari_akhir'	=> hari($hari_akhir),
			'kategori'		=> $this->universal->getMulti('', 'kategori')
		];

		$this->load->view('rekap', $params);
	}
}
