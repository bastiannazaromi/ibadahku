<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends MX_Controller
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

			if ($this->form_validation->run() == false) {
				$this->notifikasi->error(str_replace("\r\n", "", json_encode(strip_tags(validation_errors()))));
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			} else {
				$data = [
					'nama_kategori' => $this->input->post('nama')
				];
				$insert = $this->universal->insert($data, 'kategori');
				if ($insert) {
					$this->notifikasi->success('Data berhasil ditambah');
				}
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			}
		} elseif ($this->u3 == 'edit') {
			$this->form_validation->set_rules('nama', 'Nama', 'required');

			if ($this->form_validation->run() == false) {
				$this->notifikasi->error(str_replace("\r\n", "", json_encode(strip_tags(validation_errors()))));
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			} else {
				$id = dekrip($this->input->post('id'));
				$data = [
					'nama_kategori' => $this->input->post('nama')
				];

				$update = $this->universal->update($data, ['id' => $id], 'kategori');
				if ($update) {
					$this->notifikasi->success('Data berhasil diupdate');
				}
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			}
		} elseif ($this->u3 == 'multiple_delete') {
			$id = $this->input->post('id_kat');
			$id_new = [];
			if ($id) {
				foreach ($id as $hasil) {
					$id_new[] = dekrip($hasil);
				}
			} else {
				$this->notifikasi->error('Silahkan pilih data yang akan dihapus');
			}

			$delete = $this->universal->multiple_delete('id', $id_new, 'kategori');
			if ($delete) {
				$this->notifikasi->success('Berhasil hapus data');
			}

			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$params = [
				'title'     	=> 'Kategori Ibadah',
				'kategori'      => $this->universal->getMulti('', 'kategori')
			];

			$this->load->view('kategori', $params);
		}
	}
}

/* End of file Kategori.php */