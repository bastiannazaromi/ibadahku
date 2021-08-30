<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Materi extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		admin_init();
	}

	public function index()
	{
		if ($this->u3 == 'add') {
			$this->form_validation->set_rules('tipe', 'Jenis Materi', 'required');
			$this->form_validation->set_rules('deskripsi', 'Deskripsi / Judul', 'required');

			if ($this->form_validation->run() == false) {
				$this->notifikasi->error(str_replace("\r\n", "", json_encode(strip_tags(validation_errors()))));
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			} else {
				$upload_materi 	= $_FILES['file_upload']['name'];
				$tipe 			= dekrip($this->input->post('tipe'));
				$deskripsi 		= $this->input->post('deskripsi');

				if ($upload_materi) {
					$dir = date('Y-m');

					if (is_dir('upload/materi/' . $dir) === false) {
						mkdir('upload/materi/' . $dir);
						chmod('upload/materi/' . $dir, 0777);
					}

					if ($tipe == 1) {
						$types = 'pdf';
					} else {
						$types = 'mp4|avi|3gp';
					}

					$this->load->library('upload');
					$config['upload_path']          = './upload/materi/' . $dir;
					$config['allowed_types']        = $types;
					$config['max_size']             = 100000; // 100 mb
					$config['remove_spaces']        = TRUE;
					$config['detect_mime']          = TRUE;
					$config['encrypt_name']         = TRUE;

					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if (!$this->upload->do_upload('file_upload')) {
						$this->notifikasi->error($this->upload->display_errors());
						redirect($_SERVER['HTTP_REFERER'], 'refresh');
					} else {
						$upload_data = $this->upload->data();

						$data = [
							'tipe'   		=> $tipe,
							'deskripsi'		=> $deskripsi,
							'nama_file'     => $dir . '/' . $upload_data['file_name'],
						];

						$ex = $this->universal->insert($data, 'materi');

						if ($ex) {
							$this->notifikasi->success('Materi berhasil ditambahkan');
						} else {
							$this->notifikasi->error('Materi gagal ditambhakan !');
						}
					}
				} else {
					$this->notifikasi->warning('File tidak boleh kosong !');
				}

				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			}
		} elseif ($this->u3 == 'getOne') {
			$id = dekrip($this->u4);
			$data = $this->universal->getOne(['id' => $id], 'siswa');

			$res = [
				'nisn'		=> $data->nisn,
				'nama'		=> $data->nama,
				'kelas'		=> $data->kelas,
				'jk'		=> enkrip($data->jk),
				'status'	=> enkrip($data->status)
			];
			echo json_encode($res);
		} elseif ($this->u3 == 'multiple_delete') {
			$id = $this->input->post('id');
			$id_new = [];
			if ($id) {
				foreach ($id as $hasil) {
					$id_new[] = dekrip($hasil);
					$cek = $this->universal->getOneSelect('nama_file', ['id' => dekrip($hasil)], 'materi');
					unlink(FCPATH . 'upload/materi/' . $cek->nama_file);
				}
			} else {
				$this->notifikasi->error('Silahkan pilih data yang akan dihapus');
			}

			$delete = $this->universal->multiple_delete('id', $id_new, 'materi');
			if ($delete) {
				$this->notifikasi->success('Berhasil hapus data');
			}

			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$params = [
				'title'     	=> 'Materi',
				'materi'		=> $this->universal->getOrderBy('', 'materi', 'id', 'desc', '')
			];

			$this->load->view('materi', $params);
		}
	}
}

/* End of file Materi.php */