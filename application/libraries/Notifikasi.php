<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notifikasi
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->library('session');
    }

    function error($message)
    {
        $this->CI->session->set_flashdata('notif', "<script>jQuery(function () { One.helpers('notify', {from: 'top', align: 'right', type: 'danger', icon: 'fa fa-times mr-1', message: '" . $message . "'});});</script>");
    }

    function success($message)
    {
        $this->CI->session->set_flashdata('notif', "<script>jQuery(function () { One.helpers('notify', {from: 'top', align: 'right', type: 'success', icon: 'fa fa-check mr-1', message: '" . $message . "'});});</script>");
    }

    function warning($message)
    {
        $this->CI->session->set_flashdata('notif', "<script>jQuery(function () { One.helpers('notify', {from: 'top', align: 'right', type: 'warning', icon: 'fa fa-exclamation mr-1', message: '" . $message . "'});});</script>");
    }

    function info($message)
    {
        $this->CI->session->set_flashdata('notif', "<script>jQuery(function () { One.helpers('notify', {from: 'top', align: 'right', type: 'info', icon: 'fa fa-info-circle mr-1', message: '" . $message . "'});});</script>");
    }

    function custom($notifymode, $message)
    {
        $this->CI->session->set_flashdata('notify-' . $notifymode, "<script>jQuery(function () { One.helpers('notify', {from: 'top', align: 'right', type: '" . $notifymode . "', icon: 'fa fa-info-circle mr-1', message: '" . $message . "'});});</script>");
    }
}
