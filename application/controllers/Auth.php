<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pengguna_m');
    }

    public function login()
    {
        check_already_login();
        $this->load->view('auth/login');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }

    public function proses()
    {
        $post = $this->input->post(NULL, TRUE);
        if (isset($post['login'])) {
            $query = $this->pengguna_m->login($post);
            if($query->num_rows() > 0 ) {
                $row = $query->row();
                $params = [
                    'id_user' => $row->id_user,
                    'username' => $row->username,
                    'role' => $row->role,
                    'nama' => $row->nama,
                    'foto' => $row->foto
                ];
                $this->session->set_userdata($params);
                redirect('dashboard');
            }else{
                $this->session->set_flashdata('msg','
                    <div class="alert alert-danger alert-dismissible text-white" role="alert">
                        <span class="text-sm">Username/password Salah!</span>
                        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                            aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                redirect('auth/login');
            }
        }else{
            redirect('auth/login');
        }
    }

}
