<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Forgot extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $params = array('title' => 'Lupa Password | OASEPHB');
        $this->load->view('forgot', $params);
    }

    function setpw()
    {
        $params = array('title' => 'Atur Password | OASEPHB');
        $this->load->view('newpass', $params);
    }
}
