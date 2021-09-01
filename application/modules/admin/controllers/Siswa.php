<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		admin_init();
	}

	public function index()
	{
		if ($this->u3 == 'add') {
			$this->form_validation->set_rules('nisn', 'NISN', 'required|numeric|min_length[10]|max_length[10]');
			$this->form_validation->set_rules('nama', 'Nama', 'required');
			$this->form_validation->set_rules('kelas', 'Kelas', 'required|numeric|max_length[1]');
			$this->form_validation->set_rules('jk', 'Jenis Kelasmin', 'required');
			$this->form_validation->set_rules('status', 'Status Siswa', 'required');

			if ($this->form_validation->run() == false) {
				$this->notifikasi->error(str_replace("\r\n", "", json_encode(strip_tags(validation_errors()))));
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			} else {
				$data = [
					'nisn'           => $this->input->post('nisn'),
					'password'      => password_hash($this->input->post('nisn'), PASSWORD_BCRYPT, ['const' => 14]),
					'nama'          => $this->input->post('nama'),
					'kelas'         => $this->input->post('kelas'),
					'jk'         	=> dekrip($this->input->post('jk')),
					'status'        => dekrip($this->input->post('status'))
				];
				$insert = $this->universal->insert($data, 'siswa');
				if ($insert) {
					$this->notifikasi->success('Data berhasil ditambah');
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
		} elseif ($this->u3 == 'edit') {
			$this->form_validation->set_rules('nisn', 'NISN', 'required|numeric|min_length[10]|max_length[10]');
			$this->form_validation->set_rules('nama', 'Nama', 'required');
			$this->form_validation->set_rules('kelas', 'Kelas', 'required|numeric|max_length[1]');
			$this->form_validation->set_rules('jk', 'Jenis Kelasmin', 'required');
			$this->form_validation->set_rules('status', 'Status Siswa', 'required');

			if ($this->form_validation->run() == false) {
				$this->notifikasi->error(str_replace("\r\n", "", json_encode(strip_tags(validation_errors()))));
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			} else {
				$id = dekrip($this->input->post('id'));
				$data = [
					'nisn'          => $this->input->post('nisn'),
					'nama'          => $this->input->post('nama'),
					'kelas'         => $this->input->post('kelas'),
					'jk'         	=> dekrip($this->input->post('jk')),
					'status'        => dekrip($this->input->post('status'))
				];

				$update = $this->universal->update($data, ['id' => $id], 'siswa');
				if ($update) {
					$this->notifikasi->success('Data berhasil diupdate');
				}
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			}
		} elseif ($this->u3 == 'multiple_delete') {
			$id = $this->input->post('id_siswa');
			$id_new = [];
			if ($id) {
				foreach ($id as $hasil) {
					$id_new[] = dekrip($hasil);
					$cek = $this->universal->getOneSelect('foto', ['id' => dekrip($hasil)], 'siswa');

					if ($cek->foto != 'default.jpg') {
						unlink(FCPATH . 'upload/siswa/' . $cek->foto);
					}
				}
			} else {
				$this->notifikasi->error('Silahkan pilih data yang akan dihapus');
			}

			$delete = $this->universal->multiple_delete('id', $id_new, 'siswa');
			if ($delete) {
				$this->notifikasi->success('Berhasil hapus data');
			}

			redirect($_SERVER['HTTP_REFERER']);
		} elseif ($this->u3 == 'reset') {
			$id = dekrip($this->u4);
			$nisn = $this->universal->getOneSelect('nisn', ['id' => $id], 'siswa')->nisn;
			$data = [
				'password'  => password_hash($nisn, PASSWORD_BCRYPT, ['const' => 14])
			];
			$update = $this->universal->update($data, ['id' => $id], 'siswa');
			if ($update) {
				$this->notifikasi->success('Reset password sukses');
			}
			redirect($_SERVER['HTTP_REFERER'], 'refresh');
		} else if ($this->u3 == 'import') {
			$this->_import();
		} else {
			$status      = dekrip($this->u3);

			if (!$status) {
				$status = 'Semua';
			}

			$params = [
				'title'     	=> 'List Siswa',
				'siswa' 		=> $this->admin->get_siswa($status),
				'status'        => $this->universal->getMulti('', 'status_siswa'),
				'status_ini'    => $status,
			];

			$this->load->view('siswa', $params);
		}
	}

	private function _import()
	{
		$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

		$config['upload_path']      = realpath('upload/excel');
		$config['allowed_types']    = 'xlsx|xls|csv';
		$config['max_size']         = '10000';
		$config['remove_spaces']    = TRUE;
		$config['encrypt_name']     = true;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('file_excel')) {
			//upload gagal
			$this->notifikasi->error(str_replace("\r\n", "", json_encode(strip_tags($this->upload->display_errors()))));
			//redirect halaman

			redirect($_SERVER['HTTP_REFERER']);
		} else {
			if (isset($_FILES['file_excel']['name']) && in_array($_FILES['file_excel']['type'], $file_mimes)) {
				$upload_data = $this->upload->data();

				$arr_file = explode('.', $_FILES['file_excel']['name']);
				$extension = end($arr_file);
				if ('csv' == $extension) {
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
				} else {
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
				}
				$spreadsheet = $reader->load($_FILES['file_excel']['tmp_name']);
				$sheetData = $spreadsheet->getActiveSheet()->toArray();
				echo "<pre>";
				$numrow = 1;
				$data = [];
				foreach ($sheetData as $hasil) {
					if ($numrow > 1) {
						if ($hasil[0] && $hasil[1]) {
							$cek = $this->universal->getOneSelect('nama', [
								'nama'      => $hasil[1],
								'kelas'		=> $hasil[3]
							], 'siswa');

							if (!$cek) {
								array_push($data, [
									'nisn'              => str_replace('\'', '', $hasil[2]),
									'password'          => password_hash(str_replace('\'', '', $hasil[2]), PASSWORD_BCRYPT, ['const' => 14]),
									'nama'              => $hasil[1],
									'kelas'             => $hasil[3],
									'jk'             	=> $hasil[4],
									'status'            => 1,
								]);
							}
						}
					}
					$numrow++;
				}
				//delete file from server
				unlink(FCPATH . 'upload/excel/' . $upload_data['file_name']);

				echo count($data);
				die;
				if (count($data) != 0) {
					//$insert = $this->db->insert_batch('mahasiswa', $data);
					$insert = $this->universal->insert_batch($data, 'siswa');
					if ($insert) {
						$this->notifikasi->success('Data berhasil diimport');
					} else {
						$this->notifikasi->error('Data gagal diimport');
					}
				} else {
					$this->notifikasi->error('Gagal import ! Data kosong / sudah ada dalam database');
				}
				//redirect halaman
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
	}
}

/* End of file Siswa.php */