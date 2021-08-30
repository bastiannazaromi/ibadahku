<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nusoap
{
    function Nusoap()
    {
        require_once(str_replace("\\", "/", APPPATH) . 'libraries/nusoap/nusoap' . EXT); //If we are executing this script on a Windows server
        require_once(str_replace("\\", "/", APPPATH) . 'libraries/nusoap/class.wsdlcache' . EXT); //If we are executing this script on a Windows server
    }
}
