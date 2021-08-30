<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Siswa extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        siswa_init();
    }
    public function index()
    {
        $params = array(
            'title'             => 'Dashboard'
        );
        $this->load->view('dashboard', $params);
    }
}
