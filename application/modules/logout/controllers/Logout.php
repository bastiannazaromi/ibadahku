<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Logout extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        redirect(base_url());
    }
}