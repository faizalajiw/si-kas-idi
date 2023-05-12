<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('kas_m');
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

    public function pemasukan()
    {
        $data = [
            'kas' => $this->kas_m->getPemasukan()
        ];
        $this->template->load('template/template','kas/pemasukan',$data);
    }

    public function pemasukan_proses()
    {
        $post = $this->input->post(NULL, TRUE);
        if (isset($post['simpan'])) {
            if ($this->kas_m->simpanPemasukan($post)) {
                $this->session->set_flashdata('msg', $this->msgSuccess('Berhasil ditambahkan'));
                redirect('kas/pemasukan');
            }else{
                $this->session->set_flashdata('msg', $this->msgError('Gagal ditambahkan!'));
                redirect('kas/pemasukan');
            }
        }else{
            redirect('kas/pemasukan');
        }
    }

    public function pemasukan_hapus($id = null)
    {
        if ($id != null) {
            if ($this->kas_m->hapusPemasukan($id)) {
                $this->session->set_flashdata('msg', $this->msgSuccess('Berhasil dihapus'));
                redirect('kas/pemasukan');
            }else{
                $this->session->set_flashdata('msg', $this->msgError('Gagal dihapus!'));
                redirect('kas/pemasukan');
            }
        }else{
            redirect('kas/pemasukan');
        }
    }

    public function pengeluaran()
    {
        $data = [
            'kas' => $this->kas_m->getPengeluaran()
        ];
        $this->template->load('template/template','kas/pengeluaran',$data);
    }

    public function pengeluaran_proses()
    {
        $post = $this->input->post(NULL, TRUE);
        if (isset($post['simpan'])) {
            if ($this->kas_m->simpanPengeluaran($post)) {
                $this->session->set_flashdata('msg', $this->msgSuccess('Berhasil ditambahkan'));
                redirect('kas/pengeluaran');
            }else{
                $this->session->set_flashdata('msg', $this->msgError('Gagal ditambahkan!'));
            redirect('kas/pengeluaran');
            }
        }else{
            redirect('kas/pengeluaran');
        }
    }

    public function pengeluaran_hapus($id = null)
    {
        if ($id != null) {
            if ($this->kas_m->hapusPengeluaran($id)) {
                $this->session->set_flashdata('msg', $this->msgSuccess('Berhasil dihapus'));
                redirect('kas/pengeluaran');
            }else{
                $this->session->set_flashdata('msg', $this->msgError('Gagal dihapus!'));
            redirect('kas/pengeluaran');
            }
        }else{
            redirect('kas/pengeluaran');
        }
    }

    // public function selesai($id = null)
    // {
    //     if ($id != null) {
    //         if ($this->kas_m->updateSelesai($id)) {
    //             redirect('kas/pemasukan');
    //         }else{
    //             redirect('kas/pemasukan');
    //         }
    //     }else{
    //         redirect('kas/pemasukan');
    //     }
    // }

}
