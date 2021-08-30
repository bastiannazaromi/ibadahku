<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PhpspreadsheetController extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->session->set_userdata('previous_url', current_url());
        $this->load->view('spreadsheet');
    }
    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');
        $writer = new Xlsx($spreadsheet);
        $filename = 'name-of-the-generated-file';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output'); // download file
    }
    public function import()
    {
        $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        $config['upload_path'] = realpath('excel');
        $config['allowed_types'] = 'xlsx|xls|csv';
        $config['max_size'] = '10000';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('upload_file')) {

            //upload gagal
            $this->notifikasi->error(str_replace("\r\n", "", json_encode($this->upload->display_errors())));
            //redirect halaman
            $previous_url = $this->session->userdata('previous_url');
            redirect($previous_url);
        } else {
            if (isset($_FILES['upload_file']['name']) && in_array($_FILES['upload_file']['type'], $file_mimes)) {
                $arr_file = explode('.', $_FILES['upload_file']['name']);
                $extension = end($arr_file);
                if ('csv' == $extension) {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                }
                $spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
                $sheetData = $spreadsheet->getActiveSheet()->toArray();
                echo "<pre>";

                // $numrow = 1;
                // $data = [];
                // foreach ($sheetData as $hasil) {
                //     if ($numrow > 1) {
                //         array_push($data, [
                //             'nim'       => $hasil[2],
                //             'nama'      => $hasil[1]
                //         ]);
                //     }
                //     $numrow++;
                // }

                echo json_encode($sheetData);
            }
        }
    }
}
