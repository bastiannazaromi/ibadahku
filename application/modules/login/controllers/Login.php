<?php

use function GuzzleHttp\json_decode;

defined('BASEPATH') or exit('No direct script access allowed');
class Login extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->u1        = $this->uri->segment(1);
        $this->u2        = $this->uri->segment(2);
        if (!empty($this->session->userdata('log_admin'))) {
            if ($this->u1 != 'logout') {
                $this->session->set_userdata('proteksi', 1);
                redirect('admin', 'refresh');
            }
        } else if (!empty($this->session->userdata('log_siswa'))) {
            if ($this->u1 != 'logout') {
                $this->session->set_userdata('proteksi', 1);
                redirect('siswa', 'refresh');
            }
        }

        $this->load->model('M_Login', 'login');
        $this->load->model('universal_model', 'universal');
    }

    function index()
    {
        $params = array('title' => 'Login | IBADAHKU');
        $this->load->view('login', $params);
    }

    public function proses()
    {
        $username     = addslashes(trim($this->input->post('username', true)));
        $password     = addslashes(trim($this->input->post('password', true)));
        $row          = $this->login->validasi($username, $password);

        if ($row != null) {
            $this->_daftarkan_session($row);
        } else {
            $message = "Sepertinya Anda salah memasukkan username atau password!!";
            $this->session->set_flashdata('error', $message);
            redirect(base_url());
        }
    }

    public function _daftarkan_session($row)
    {
        array_merge($row, array('is_logged_in' => true));
        if ($row['role'] == 'admin') {
            $this->session->set_userdata('log_admin', $row);
            $this->notifikasi->success('Selamat Datang di IBADAHKU');
            redirect('admin');
        } else {
            $this->session->set_userdata('log_siswa', $row);
            $this->notifikasi->success('Selamat Datang di IBADAHKU');
            redirect('siswa');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
