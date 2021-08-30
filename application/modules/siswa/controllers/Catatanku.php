<?php
defined('BASEPATH') or exit('No direct script access allowed');
class catatanku extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		siswa_init();
	}
	public function index()
	{
		if ($this->u3 == 'add_bukti') {
			$this->form_validation->set_rules('nm_kat', 'Nama Kegiatan', 'required');
			$this->form_validation->set_rules('ket', 'Kegiatan', 'required', [
				'required'	=> 'Keterangan harus di isi'
			]);
			$this->form_validation->set_rules('id_kegiatan', 'ID Kegiatan', 'required');

			if ($this->form_validation->run() == false) {
				$this->notifikasi->error(str_replace("\r\n", "", json_encode(strip_tags(validation_errors()))));
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			} else {
				$upload_bukti 	= $_FILES['file_bukti']['name'];
				$id_kegiatan 	= dekrip($this->input->post('id_kegiatan'));
				$nm_kat 		= str_replace(' ', '_', dekrip($this->input->post('nm_kat')));
				$ket 			= $this->input->post('ket');

				$tgl			= dekrip($this->input->post('tgl'));

				if ($upload_bukti) {
					$dir = date('Y-m');

					if (is_dir('upload/' . $nm_kat) === false) {
						mkdir('upload/' . $nm_kat);
						chmod('upload/' . $nm_kat, 0777);

						if (is_dir('upload/' . $nm_kat . '/' . $dir) === false) {
							mkdir('upload/' . $nm_kat . '/' . $dir);
							chmod('upload/' . $nm_kat . '/' . $dir, 0777);
						}
					} else {
						if (is_dir('upload/' . $nm_kat . '/' . $dir) === false) {
							mkdir('upload/' . $nm_kat . '/' . $dir);
							chmod('upload/' . $nm_kat . '/' . $dir, 0777);
						}
					}

					$this->load->library('upload');
					$config['upload_path']          = './upload/' . $nm_kat . '/' . $dir;
					$config['allowed_types']        = 'png|jpg|jpeg';
					$config['max_size']             = 15360; // 15 mb
					$config['remove_spaces']        = TRUE;
					$config['detect_mime']          = TRUE;
					$config['encrypt_name']         = TRUE;

					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if (!$this->upload->do_upload('file_bukti')) {
						$this->notifikasi->error($this->upload->display_errors());
						redirect($_SERVER['HTTP_REFERER'], 'refresh');
					} else {
						$upload_data = $this->upload->data();

						if ($tgl) {
							$cek = $this->universal->getOneSelect('nama_file', [
								'id_kegiatan'	=> $id_kegiatan,
								'nisn'			=> $this->user->nisn
							], 'catatan');
						} else {
							$cek = null;
						}

						if ($cek) {
							unlink(FCPATH . 'upload/' . $nm_kat . '/' . $cek->nama_file);

							$data = [
								'nama_file'     => $dir . '/' . $upload_data['file_name'],
								'ket'			=> $ket
							];

							$ex = $this->universal->update($data, [
								'id_kegiatan'	=> $id_kegiatan,
								'nisn'			=> $this->user->nisn,
								'tanggal'		=> $tgl
							], 'catatan');
						} else {
							$data = [
								'id_kegiatan'   => $id_kegiatan,
								'nisn'			=> $this->user->nisn,
								'kelas'			=> $this->user->kelas,
								'tanggal'		=> date('Y-m-d H:i:s'),
								'nama_file'     => $dir . '/' . $upload_data['file_name'],
								'ket'			=> $ket
							];

							$ex = $this->universal->insert($data, 'catatan');
						}

						if ($ex) {
							$this->notifikasi->success('Bukti berhasil diupload');
						} else {
							$this->notifikasi->error('Bukti gagal diupload !');
						}
					}
				} else {
					$this->notifikasi->warning('Foto tidak boleh kosong !');
				}

				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			}
		} else if ($this->u3 == 'delete') {
			$id		= dekrip($this->u4);
			$folder	= dekrip($this->u5);

			$cek = $this->universal->getOneSelect('nama_file', ['id' => $id], 'catatan');

			$delete = $this->universal->delete(['id' => $id], 'catatan');
			if ($delete) {
				unlink(FCPATH . 'upload/' . $folder . '/' . $cek->nama_file);
				$this->notifikasi->success('Bukti berhasil hapus');
			}
			redirect($_SERVER['HTTP_REFERER'], 'refresh');
		} else {
			$id_kategori	= dekrip($this->u3);
			$tanggal		= $this->u4;

			if (!$tanggal) {
				$tanggal = date('Y-m-d');
			}

			$date = strtotime($tanggal);
			$hari = date('N', $date);

			$params = array(
				'title'				=> 'Catatan Ibadahku',
				'kegiatan'			=> $this->universal->getMulti(['id_kategori' => $id_kategori], 'kegiatan'),
				'tanggal'			=> $tanggal,
				'hari'				=> hari($hari),
				'nama_kategori'		=> $this->universal->getOneSelect('nama_kategori', ['id' => $id_kategori], 'kategori')->nama_kategori
			);

			$this->load->view('catatanku', $params);
		}
	}
}
