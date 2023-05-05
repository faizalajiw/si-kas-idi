<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('kategori_m');
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

    public function kategori_pemasukan()
    {
        $data = [
            'kategori_pemasukan' => $this->kategori_m->getKategoriPemasukan()
        ];
        $this->template->load('template/template','kategori/kategori_pemasukan',$data);
    }

    public function kategori_pemasukan_proses()
    {
        $post = $this->input->post(NULL, TRUE);
        if (isset($post['simpan'])) {
            if ($this->kategori_m->simpanKategoriPemasukan($post)) {
                $this->session->set_flashdata('msg', $this->msgSuccess('Berhasil ditambahkan'));
                redirect('kategori/kategori_pemasukan');
            }else{
                $this->session->set_flashdata('msg', $this->msgError('Gagal ditambahkan!'));
                redirect('kategori/kategori_pemasukan');
            }
        }else{
            redirect('kategori/kategori_pemasukan');
        }
    }

    public function kategori_pemasukan_hapus($id = null)
    {
        if ($id != null) {
            if ($this->kategori_m->hapusKategoriPemasukan($id)) {
                $this->session->set_flashdata('msg', $this->msgSuccess('Berhasil dihapus'));
                redirect('kategori/kategori_pemasukan');
            }else{
                $this->session->set_flashdata('msg', $this->msgError('Gagal dihapus!'));
                redirect('kategori/kategori_pemasukan');
            }
        }else{
            redirect('kategori/kategori_pemasukan');
        }
    }

}
