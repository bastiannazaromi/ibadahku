<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_siswa extends CI_Model
{
	public function getUser($where)
	{
		$this->db->select('siswa.*, ss.nama_status');
		$this->db->join('status_siswa ss', 'ss.id = siswa.status', 'inner');

		$this->db->where($where);

		return $this->db->get('siswa')->row();
	}
}
