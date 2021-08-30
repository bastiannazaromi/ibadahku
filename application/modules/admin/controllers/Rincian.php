<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rincian extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		admin_init();
	}

	public function index()
	{
		if ($this->u3 == 'add') {
			$this->form_validation->set_rules('nama', 'Nama', 'required');
			$this->form_validation->set_rules('mulai', 'Waktu Mulai', 'required');
			$this->form_validation->set_rules('akhir', 'Waktu Akhir', 'required');

			if ($this->form_validation->run() == false) {
				$this->notifikasi->error(str_replace("\r\n", "", json_encode(strip_tags(validation_errors()))));
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			} else {
				$data = [
					'id_kategori' 		=> dekrip($this->input->post('id_kat')),
					'nama_kegiatan' 	=> $this->input->post('nama'),
					'mulai' 			=> $this->input->post('mulai'),
					'akhir' 			=> $this->input->post('akhir')
				];
				$insert = $this->universal->insert($data, 'kegiatan');
				if ($insert) {
					$this->notifikasi->success('Data berhasil ditambah');
				}
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			}
		} elseif ($this->u3 == 'edit') {
			$this->form_validation->set_rules('nama', 'Nama', 'required');
			$this->form_validation->set_rules('mulai', 'Waktu Mulai', 'required');
			$this->form_validation->set_rules('akhir', 'Waktu Akhir', 'required');

			if ($this->form_validation->run() == false) {
				$this->notifikasi->error(str_replace("\r\n", "", json_encode(strip_tags(validation_errors()))));
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			} else {
				$id = dekrip($this->input->post('id'));
				$data = [
					'nama_kegiatan' 	=> $this->input->post('nama'),
					'mulai' 			=> $this->input->post('mulai'),
					'akhir' 			=> $this->input->post('akhir')
				];

				$update = $this->universal->update($data, ['id' => $id], 'kegiatan');
				if ($update) {
					$this->notifikasi->success('Data berhasil diupdate');
				}
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			}
		} elseif ($this->u3 == 'multiple_delete') {
			$id = $this->input->post('id_keg');
			$id_new = [];
			if ($id) {
				foreach ($id as $hasil) {
					$id_new[] = dekrip($hasil);
				}
			} else {
				$this->notifikasi->error('Silahkan pilih data yang akan dihapus');
			}

			$delete = $this->universal->multiple_delete('id', $id_new, 'kegiatan');
			if ($delete) {
				$this->notifikasi->success('Berhasil hapus data');
			}

			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$id_kat = dekrip($this->u3);

			$kategori = $this->universal->getOne(['id' => $id_kat], 'kategori');

			$params = [
				'title'     	=> 'Rincian Ibadah',
				'rincian'      	=> $this->universal->getMulti(['id_kategori' => $id_kat], 'kegiatan'),
				'kategori'		=> $kategori
			];

			$this->load->view('rincian', $params);
		}
	}
}

/* End of file Rincian.php */