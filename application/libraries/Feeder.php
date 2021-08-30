<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Feeder
{
    private $client;
    private $proxy;
    protected $CI;

    function __construct()
    {
        $this->CI = &get_instance();
        $this->client = new nusoap_client($this->CI->session->userdata('ws'), TRUE);
        $this->proxy = $this->client->getProxy();
    }

    function GetToken($username, $password)
    {
        return $this->proxy->GetToken($username, $password);
    }

    function ListTable($token)
    {
        return $this->proxy->ListTable($token);
    }

    function GetDictionary($token, $table)
    {
        return $this->proxy->GetDictionary($token, $table);
    }

    function GetRecordset($token, $table, $filter, $order, $limit, $offset)
    {
        return $this->proxy->GetRecordset($token, $table, $filter, $order, $limit, $offset);
    }

    function GetRecord($token, $table, $filter)
    {
        return $this->proxy->GetRecord($token, $table, $filter);
    }

    function InsertRecordset($token, $table, $records)
    {
        return $this->proxy->InsertRecordset($token, $table, json_encode($records));
    }

    function InsertRecord($token, $table, $records)
    {
        return $this->proxy->InsertRecord($token, $table, json_encode($records));
    }

    function UpdateRecord($token, $table, $records)
    {
        return $this->proxy->UpdateRecord($token, $table, json_encode($records));
    }

    function UpdateRecordset($token, $table, $records)
    {
        return $this->proxy->UpdateRecordset($token, $table, json_encode($records));
    }

    function GetCountRecordSet($token, $table, $filter)
    {
        return $this->proxy->GetCountRecordSet($token, $table, $filter);
    }

    function GetListMahasiswa($token, $filter, $order, $limit, $offset)
    {
        return $this->proxy->GetListMahasiswa($token, $filter, $order, $limit, $offset);
    }

    function GetListMataKuliah($token, $filter, $order, $limit, $offset)
    {
        return $this->proxy->GetListMataKuliah($token, $filter, $order, $limit, $offset);
    }

    function GetProdi($token, $filter, $order, $limit, $offset)
    {
        return $this->proxy->GetProdi($token, $filter, $order, $limit, $offset);
    }

    function GetBiodataMahasiswa($token, $filter, $order, $limit, $offset)
    {
        return $this->proxy->GetBiodataMahasiswa($token, $filter, $order, $limit, $offset);
    }
}
