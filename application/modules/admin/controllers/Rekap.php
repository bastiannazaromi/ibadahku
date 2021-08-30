<?php

defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Rekap extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		admin_init();
	}

	public function index()
	{
		if ($this->u3 == 'excel') {
			$id_kat 	= dekrip($this->u4);
			$kelas 		= dekrip($this->u5);
			$tanggal 	= $this->u6;

			$date = strtotime($tanggal);
			$hari = date('N', $date);

			$kegiatan 	= $this->universal->getMulti(['id_kategori' => $id_kat], 'kegiatan');
			$siswa		= $this->universal->getOrderBy(['kelas'	=> $kelas], 'siswa', 'nisn', 'asc', '');

			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();

			$sheet->getDefaultRowDimension()->setRowHeight(20);

			$sheet->getColumnDimension('A')->setWidth(5);
			$sheet->getColumnDimension('B')->setWidth(15);
			$sheet->getColumnDimension('C')->setWidth(40);

			$column = 'C';
			foreach ($kegiatan as $keg) {
				$column++;
				$sheet->getColumnDimension($column)->setWidth(22);
			}

			$sheet->mergeCells('A1:B1');
			$sheet->setCellValue('A1', 'Tanggal');
			$sheet->setCellValue('C1', hari($hari) . ', ' . tanggal($tanggal));

			$sheet->mergeCells('A2:B2');
			$sheet->setCellValue('A2', 'Kelas');
			$sheet->getStyle('C2:C2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);

			$sheet->setCellValue('C2', $kelas);

			$sheet->getStyle('A4:' . $column . '4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

			$sheet->getStyle('A1:' . $column . '4')->getFont()->setBold(true);

			$sheet->setCellValue('A4', 'No');
			$sheet->setCellValue('B4', 'NISN');
			$sheet->setCellValue('C4', 'Nama Siswa');

			$column = 'C';
			foreach ($kegiatan as $keg) {
				$column++;
				$sheet->setCellValue($column . '4', $keg->nama_kegiatan);
			}

			$no = 1;
			$x = 5;

			foreach ($siswa as $s) {
				$sheet->getStyle('A' . $x . ':' . 'B' . $x)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

				$sheet->setCellValue('A' . $x, $no++);
				$sheet->setCellValue('B' . $x, $s->nisn);
				$sheet->setCellValue('C' . $x, $s->nama);

				$column = 'C';
				foreach ($kegiatan as $keg) {
					$column++;

					$cek = $this->universal->getOneSelect('id', [
						'id_kegiatan'	=> $keg->id,
						'nisn'			=> $s->nisn
					], 'catatan');

					$sheet->setCellValue($column . $x, ($cek) ? '√' : '-');
				}

				$sheet->getStyle('D' . $x . ':' . $column . $x)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

				$x++;
			}

			$writer = new Xlsx($spreadsheet);
			$filename = 'Rekap_ibadah_kelas_' . $kelas . '_' . str_replace(" ", "_", $tanggal);

			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
			header('Cache-Control: max-age=0');

			$writer->save('php://output');
		} else if ($this->u3 == 'add') {
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
			$id_kat 	= dekrip($this->u3);
			$kelas		= dekrip($this->u4);
			$tanggal	= $this->u5;

			if (!$kelas) {
				$kelas = $this->universal->getOrderBy('', 'siswa', 'kelas', 'ASC', 1);
				$kelas = $kelas[0]->kelas;
			}

			if (!$tanggal) {
				$tanggal = date('Y-m-d');
			}

			$date = strtotime($tanggal);
			$hari = date('N', $date);

			$siswa = $this->universal->getOrderBy(['kelas' => $kelas], 'siswa', 'nisn', 'ASC', '');

			$kategori = $this->universal->getOne(['id' => $id_kat], 'kategori');

			$params = [
				'title'     	=> 'Rekap Kegiatan Siswa',
				'kegiatan'      => $this->universal->getMulti(['id_kategori' => $id_kat], 'kegiatan'),
				'kategori'		=> $kategori,
				'kelas_ini'		=> $kelas,
				'kelas'			=> $this->universal->getGroupSelect('kelas', '', 'siswa', 'kelas', 'kelas', 'ASC'),
				'siswa'			=> $siswa,
				'tanggal'		=> $tanggal,
				'hari'			=> hari($hari)
			];

			$this->load->view('rekap', $params);
		}
	}
}

/* End of file Rekap.php */