<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Admin extends CI_Model
{

	public function get_siswa($like)
	{
		$this->db->select('siswa.*, status_siswa.nama_status');
		$this->db->from('siswa');
		$this->db->join('status_siswa', 'status_siswa.id = siswa.status', 'inner');
		if ($like != 'Semua') {
			$this->db->like('siswa.status', $like);
		}
		$this->db->order_by('siswa.kelas, siswa.nisn', 'asc');
		return $this->db->get()->result();
	}

	public function get_grafik_kegiatan()
	{
		$this->db->select('COUNT(kegiatan.id) as total, kategori.nama_kategori as nama');
		$this->db->join('kategori', 'kategori.id = kegiatan.id_kategori', 'inner');

		$this->db->group_by('kegiatan.id_kategori');

		return $this->db->get('kegiatan')->result();
	}
}

/* End of file M_Admin.php */