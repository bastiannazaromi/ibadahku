<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Profil extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		siswa_init();
	}

	function index()
	{
		if ($this->u3 == 'update') {
			$this->form_validation->set_rules('kelas', 'Kelas', 'required|numeric|max_length[1]');
			$this->form_validation->set_rules('nama', 'Nama', 'required');

			if ($this->form_validation->run() == false) {
				$this->notifikasi->error(str_replace("\r\n", "", json_encode(strip_tags(validation_errors()))));
				redirect('siswa/profil/edit', 'refresh');
			} else {
				$upload_foto = $_FILES['foto']['name'];
				if ($upload_foto) {
					$dir = date('Y-m');

					if (is_dir('upload/siswa/' . $dir) === false) {
						mkdir('upload/siswa/' . $dir);
						chmod('upload/siswa/' . $dir, 0777);
					}

					$this->load->library('upload');
					$config['upload_path']          = './upload/siswa/' . $dir;
					$config['allowed_types']        = 'jpg|jpeg|png';
					$config['max_size']             = 2048; // 2 mb
					$config['remove_spaces']        = TRUE;
					$config['detect_mime']          = TRUE;
					$config['encrypt_name']         = TRUE;

					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if (!$this->upload->do_upload('foto')) {
						// $this->notifikasi->error($this->upload->display_errors());
						$this->notifikasi->error('Maaf, file foto yang Anda unggah tidak memenuhi persyaratan :(');
						redirect('siswa/profil/edit', 'refresh');
					} else {

						$upload_data = $this->upload->data();
						$dataSebelumnya = $this->universal->getOne(['id' => $this->id_siswa], 'siswa');
						$path = FCPATH . 'upload/siswa/';
						if ($dataSebelumnya->foto != 'default.jpg') {
							unlink($path . $dataSebelumnya->foto);
						}

						$data = [
							'foto'          => $dir . '/' . $upload_data['file_name']
						];

						img_resize(300, $path . $data['foto'], $path . $data['foto']);

						$update = $this->universal->update($data, ['id' => $this->id_siswa], 'siswa');

						($update) ? $this->notifikasi->success('Foto berhasil diubah :)') : $this->notifikasi->error('Foto gagal dirubah :(');

						redirect('siswa/profil', 'refresh');
					}
				} else {
					$this->notifikasi->success('Update data diri berhasil');
					redirect('siswa/profil', 'refresh');
				}
			}
		} elseif ($this->u3 == 'edit') {
			$params = [
				'title'     	=> 'Edit Data Diri'
			];

			$this->load->view('editprofil', $params);
		} else {
			$params = [
				'title'     		=> 'Data Diri'
			];
			$this->load->view('profil', $params);
		}
	}
}
