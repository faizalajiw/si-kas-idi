<?php

class Fungsi
{
    protected $ci;

    function __construct()
    {
        $this->ci = &get_instance();
    }

    function user_login()
    {
        $this->ci->load->model('pengguna_m');
        $user_id = $this->ci->session->userdata('id_user');
        return $this->ci->pengguna_m->getUser($user_id)[0];
    }
}