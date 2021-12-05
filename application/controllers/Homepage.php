<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Homepage extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('homepage_m');
    }

    public function index()
    {
        check_admin();
        $data = [
            
            'info' => $this->homepage_m->getInfo(),
        ];
        $this->template->load('template/template', 'homepage/homepage', $data);
    }

    public function info_banner()
    {
        check_admin();
        $data =[
            'banner' => $this->homepage_m->getBanner()
        ];
        $this->load->view('homepage/banner', $data);
    }

    public function info_layanan()
    {
        check_admin();
        $data = [
            'layanan' => $this->homepage_m->getLayanan()
        ];
        $this->load->view('homepage/layanan', $data);
    }
    
    public function info_galeri()
    {
        check_admin();
        $data = [
            'galeri' => $this->homepage_m->getGaleri()
        ];
        $this->load->view('homepage/galeri', $data);
    }
    
    public function info_jam_buka()
    {
        check_admin();
        $data = [
            'hari' => $this->homepage_m->getHari()
        ];
        $this->load->view('homepage/jam_buka', $data);
    }

    private function msgSuccess($msg)
    {
        return '<div class="alert alert-success alert-dismissible text-white" role="alert">
                    <span class="text-sm">'.$msg.'</span>
                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                        aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
    }
    private function msgError($msg)
    {
        return '<div class="alert alert-danger alert-dismissible text-white" role="alert">
                    <span class="text-sm">'.$msg.'</span>
                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                        aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
    }

    public function update_home()
    {
        check_admin();
        $post = $this->input->post(NULL, TRUE);
        if (isset($_POST['simpan'])) {
            if ($this->homepage_m->updateHome($post)) {
                $this->session->set_flashdata('msg', $this->msgSuccess('Berhasil disimpan'));
            }else{
                $this->session->set_flashdata('msg', $this->msgError('Gagal disimpan'));
            }
            redirect('homepage');
        }else{
            redirect('homepage');
        }
    }

    public function update_jam()
    {
        check_admin();
        $post = $this->input->post(NULL, TRUE);
        if (isset($_POST['simpan'])) {
            if ($this->homepage_m->updateJam($post)) {
                $this->session->set_flashdata('msg', $this->msgSuccess('Berhasil disimpan'));
            }else{
                $this->session->set_flashdata('msg', $this->msgError('Gagal disimpan'));
            }
            redirect('homepage');
        }else{
            redirect('homepage');
        }
    }

    public function banner_hapus($id = null)
    {
        check_admin();
        if ($id != null) {
            if ($this->homepage_m->hapusBanner($id)) {
                $this->session->set_flashdata('msg', $this->msgSuccess('Berhasil dihapus'));
            }else{
                $this->session->set_flashdata('msg', $this->msgError('Gagal dihapus'));
            }
            redirect('homepage');
        }else{
            redirect('homepage');
        }
    }

    public function tambah_banner()
    {
        check_admin();
        $post = $this->input->post(NULL, TRUE);
        if (isset($post['simpan'])) {
            $config['upload_path'] = './assets/img/banner/';   
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;
            $config['file_name'] = 'banner-'.date('ymd').time();
            $this->load->library('upload', $config);

            $post['foto'] = null;
            if(@$_FILES['foto']['error'] == 0){
                
                if ($this->upload->do_upload('foto')) {
                    $post['foto'] = $this->upload->data('file_name');
                    if ($this->homepage_m->tambahBanner($post)) {
                        $this->session->set_flashdata('msg', $this->msgSuccess('Berhasil disimpan'));
                    }else{
                        $this->session->set_flashdata('msg', $this->msgError('Gagal disimpan'));
                    }
                    redirect('homepage');
                }else{
                    redirect('homepage');
                }
            }else{
                redirect('homepage');
            }
        }else{
            redirect('homepage');
        }
    }

    public function galeri_hapus($id = null)
    {
        check_admin();
        if ($id != null) {
            if ($this->homepage_m->hapusGaleri($id)) {
                $this->session->set_flashdata('msg', $this->msgSuccess('Berhasil dihapus'));
                redirect('homepage');
            }else{
                $this->session->set_flashdata('msg', $this->msgError('Gagal dihapus'));
                redirect('homepage');
            }
        }else{
            redirect('homepage');
        }
    }

    public function tambah_galeri()
    {
        check_admin();
        $post = $this->input->post(NULL, TRUE);
        if (isset($post['simpan'])) {
            $config['upload_path'] = './assets/img/galeri/';   
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;
            $config['file_name'] = 'galeri-'.date('ymd').time();
            $this->load->library('upload', $config);

            $post['foto'] = null;
            if(@$_FILES['foto']['error'] == 0){
                
                if ($this->upload->do_upload('foto')) {
                    $post['foto'] = $this->upload->data('file_name');
                    if ($this->homepage_m->tambahGaleri($post)) {
                        $this->session->set_flashdata('msg', $this->msgSuccess('Berhasil disimpan'));
                        redirect('homepage');
                    }else{
                        $this->session->set_flashdata('msg', $this->msgError('Gagal disimpan'));
                        redirect('homepage');
                    }
                }else{
                    redirect('homepage');
                }
            }else{
                redirect('homepage');
            }
        }else{
            redirect('homepage');
        }
    }

    
    public function layanan_hapus($id = null)
    {
        check_admin();
        if ($id != null) {
            if ($this->homepage_m->hapusLayanan($id)) {
                $this->session->set_flashdata('msg', $this->msgSuccess('Berhasil dihapus'));
                redirect('homepage');
            }else{
                $this->session->set_flashdata('msg', $this->msgError('Gagal dihapus'));
                redirect('homepage');
            }
        }else{
            redirect('homepage');
        }
    }

    public function tambah_layanan()
    {
        check_admin();
        $post = $this->input->post(NULL, TRUE);
        if (isset($post['simpan'])) {
            $config['upload_path'] = './assets/img/icons/layanan/';   
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;
            $config['file_name'] = 'layanan-'.date('ymd').time();
            $this->load->library('upload', $config);

            $post['foto'] = null;
            if(@$_FILES['foto']['error'] == 0){
                
                if ($this->upload->do_upload('foto')) {
                    $post['foto'] = $this->upload->data('file_name');
                    if ($this->homepage_m->tambahLayanan($post)) {
                        $this->session->set_flashdata('msg', $this->msgSuccess('Berhasil disimpan'));
                        redirect('homepage');
                    }else{
                        $this->session->set_flashdata('msg', $this->msgError('Gagal disimpan'));
                        redirect('homepage');
                    }
                }else{
                    redirect('homepage');
                }
            }else{
                redirect('homepage');
            }
        }else{
            redirect('homepage');
        }
    }

    public function get_jam($id = null)
    {
        if ($id != null) {
            $data = $this->homepage_m->getHari($id)[0];
            echo json_encode($data);
        }else{
            redirect('homepage');
        }
    }


}