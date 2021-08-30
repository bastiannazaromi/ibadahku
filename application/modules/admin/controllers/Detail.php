<?php

defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Detail extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		admin_init();
	}

	public function index()
	{
		if ($this->u3 == 'excel') {
			$kelas 			= dekrip($this->u4);
			$nisn			= dekrip($this->u5);
			$tanggal_awal	= $this->u6;
			$tanggal_akhir	= $this->u7;

			$nama 			= $this->universal->getOneSelect('nama', ['nisn'	=> $nisn], 'siswa')->nama;
			$kategori		= $this->universal->getMulti('', 'kategori');

			$begin = new DateTime($tanggal_awal);
			$end = new DateTime($tanggal_akhir);
			$end->modify('+1 day');

			$interval = DateInterval::createFromDateString('1 day');
			$period = new DatePeriod($begin, $interval, $end);

			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();

			$sheet->getDefaultRowDimension()->setRowHeight(20);

			$sheet->getColumnDimension('A')->setWidth(5);
			$sheet->getColumnDimension('B')->setWidth(40);

			$column = 'B';
			foreach ($period as $per) {
				$column++;
				$sheet->getColumnDimension($column)->setWidth(22);
			}

			$sheet->mergeCells('A1:B1');
			$sheet->setCellValue('A1', 'Nama');
			$sheet->setCellValue('C1', $nama);

			$sheet->mergeCells('A2:B2');
			$sheet->setCellValue('A2', 'NISN');
			$sheet->setCellValue('C2', $nisn);

			$sheet->mergeCells('A3:B3');
			$sheet->setCellValue('A3', 'Kelas');
			$sheet->getStyle('C3:C3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);

			$sheet->setCellValue('C3', $kelas);

			$sheet->getStyle('A5:' . $column . '6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

			$sheet->getStyle('A1:' . $column . '5')->getFont()->setBold(true);

			$sheet->mergeCells('A5:A6');
			$sheet->mergeCells('B5:B6');
			$sheet->setCellValue('A5', 'No');
			$sheet->setCellValue('B5', 'Kategori');

			$sheet->getStyle('A5:B6')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

			$sheet->mergeCells('C5:' . $column . '5');

			$sheet->setCellValue('C5', 'Hari / Tanggal');

			$column = 'B';
			foreach ($period as $per) {
				$column++;

				$date = strtotime($per->format('d-m-Y'));
				$hari = date('N', $date);

				$sheet->setCellValue($column . '6', hari($hari) . ', ' . $per->format('d-m-Y'));
			}

			$no = 1;
			$x = 7;

			foreach ($kategori as $kat) {
				$sheet->setCellValue('A' . $x, '');

				$sheet->getStyle('B' . $x)->getFont()->setBold(true);
				$sheet->setCellValue('B' . $x, $kat->nama_kategori);

				$x++;

				$kegiatan = $this->universal->getMulti(['id_kategori' => $kat->id], 'kegiatan');

				foreach ($kegiatan as $keg) {
					$sheet->getStyle('A' . $x)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
					$sheet->setCellValue('A' . $x, $no++);

					$sheet->setCellValue('B' . $x, $keg->nama_kegiatan);

					$column = 'B';
					foreach ($period as $per) {
						$column++;
						$cek = $this->universal->getOne([
							'id_kegiatan'	=> $keg->id,
							'nisn'			=> $nisn,
							'DATE(tanggal)' => $per->format("Y-m-d")
						], 'catatan');

						$sheet->setCellValue($column . $x, ($cek) ? '√' : '-');
					}

					$sheet->getStyle('C' . $x . ':' . $column . $x)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
					$x++;
				}
			}

			$sheet->getStyle('B' . $x)->getFont()->setBold(true);
			$sheet->setCellValue('B' . $x, 'Jumlah Kegiatan Dalam Sehari');
			$x++;

			$sheet->getStyle('B' . $x)->getFont()->setBold(true);

			$sheet->getRowDimension($x)->setRowHeight(40);

			$sheet->getStyle('B' . $x)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

			$sheet->setCellValue('B' . $x, 'TANDA TANGAN ORANG TUA');

			$sheet->getStyle('A5:' . $column . $x)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);


			$writer = new Xlsx($spreadsheet);
			$filename = 'Detail_ibadah_siswa_' . str_replace(" ", "_", $nama) . '_kelas_' . $kelas;

			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
			header('Cache-Control: max-age=0');

			$writer->save('php://output');
		} elseif ($this->u3 == 'add') {
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
		} else if ($this->u3 == 'getSiswa') {
			$kelas = dekrip($this->u4);

			$siswa	= $this->universal->getOrderBy(['kelas' => $kelas], 'siswa', 'nisn', 'ASC', '');

			$res = [];

			foreach ($siswa as $s) {
				array_push($res, [
					'nisn'		=> enkrip($s->nisn),
					'nama'		=> $s->nama
				]);
			}

			echo json_encode($res);
		} else {
			$kelas 			= dekrip($this->u3);
			$nisn			= dekrip($this->u4);
			$tanggal_awal	= $this->u5;
			$tanggal_akhir	= $this->u6;

			if (!$kelas) {
				$kelas = $this->universal->getOrderBy('', 'siswa', 'kelas', 'ASC', 1);
				$kelas = $kelas[0]->kelas;
			}

			if (!$nisn) {
				$nisn = $this->universal->getOrderBy(['kelas' => $kelas], 'siswa', 'nisn', 'ASC', 1)[0]->nisn;
			}

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

			if ($tanggal_awal > $tanggal_akhir) {
				$this->notifikasi->warning('Tanggal awal tidak boleh melebihi tanggal akhir');
				redirect($_SERVER['HTTP_REFERER']);
			}
			$siswa 			= $this->universal->getOrderBy(['kelas' => $kelas], 'siswa', 'nisn', 'ASC', '');
			$group_kelas	= $this->universal->getGroupSelect('kelas', '', 'siswa', 'kelas', 'kelas', 'ASC');

			$params = [
				'title'     	=> 'Rekap Kegiatan Siswa',
				'kelas'			=> $group_kelas,
				'kelas_ini'		=> $kelas,
				'siswa'			=> $siswa,
				'nisn_ini'		=> $nisn,
				'tanggal_awal'	=> $tanggal_awal,
				'hari_awal'		=> hari($hari_awal),
				'tanggal_akhir'	=> $tanggal_akhir,
				'hari_akhir'	=> hari($hari_akhir),
				'kategori'		=> $this->universal->getMulti('', 'kategori')
			];

			$this->load->view('detail', $params);
		}
	}
}

/* End of file Detail.php */
