<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekap extends CI_Controller
{
    function __construct(){
        parent::__construct();
        check_not_login();
        $this->load->model('rekap_m');
    }

    public function index()
    {
        $data['result'] = $this->rekap_m->getRekap();
        $this->template->load('template/template','laporan/rekap', $data);
    }
}
