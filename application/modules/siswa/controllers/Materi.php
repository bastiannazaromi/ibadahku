<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Materi extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		siswa_init();
	}
	public function index()
	{
		$params = [
			'title'     	=> 'Materi',
			'materi'		=> $this->universal->getOrderBy('', 'materi', 'id', 'desc', '')
		];

		$this->load->view('materi', $params);
	}
}
