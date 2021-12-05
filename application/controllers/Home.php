<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('homepage_m');
    }

    public function index()
    {
        $data = [
            'banner' => $this->homepage_m->getBanner(),
            'info' => $this->homepage_m->getInfo(),
            'hari' => $this->homepage_m->getHari(),
            'layanan' => $this->homepage_m->getLayanan(),
            'galeri' => $this->homepage_m->getGaleri()
        ];
        $this->load->view('home', $data);
    }

}