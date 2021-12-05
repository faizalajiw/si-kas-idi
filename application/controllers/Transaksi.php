<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('transaksi_m');
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
            'pemasukan' => $this->transaksi_m->getPemasukan()
        ];
        $this->template->load('template/template','transaksi/pemasukan',$data);
    }

    public function pemasukan_proses()
    {
        $post = $this->input->post(NULL, TRUE);
        if (isset($post['simpan'])) {
            if ($this->transaksi_m->simpanPemasukan($post)) {
                $this->session->set_flashdata('msg', $this->msgSuccess('Berhasil ditambahkan'));
                redirect('transaksi/pemasukan');
            }else{
                $this->session->set_flashdata('msg', $this->msgError('Gagal ditambahkan!'));
                redirect('transaksi/pemasukan');
            }
        }else{
            redirect('transaksi/pemasukan');
        }
    }

    public function pemasukan_hapus($id = null)
    {
        if ($id != null) {
            if ($this->transaksi_m->hapusPemasukan($id)) {
                $this->session->set_flashdata('msg', $this->msgSuccess('Berhasil dihapus'));
                redirect('transaksi/pemasukan');
            }else{
                $this->session->set_flashdata('msg', $this->msgError('Gagal dihapus!'));
                redirect('transaksi/pemasukan');
            }
        }else{
            redirect('transaksi/pemasukan');
        }
    }

    public function pengeluaran()
    {
        $data = [
            'pengeluaran' => $this->transaksi_m->getPengeluaran()
        ];
        $this->template->load('template/template','transaksi/pengeluaran',$data);
    }

    public function pengeluaran_proses()
    {
        $post = $this->input->post(NULL, TRUE);
        if (isset($post['simpan'])) {
            if ($this->transaksi_m->simpanPengeluaran($post)) {
                $this->session->set_flashdata('msg', $this->msgSuccess('Berhasil ditambahkan'));
                redirect('transaksi/pengeluaran');
            }else{
                $this->session->set_flashdata('msg', $this->msgError('Gagal ditambahkan!'));
            redirect('transaksi/pengeluaran');
            }
        }else{
            redirect('transaksi/pengeluaran');
        }
    }

    public function pengeluaran_hapus($id = null)
    {
        if ($id != null) {
            if ($this->transaksi_m->hapusPengeluaran($id)) {
                $this->session->set_flashdata('msg', $this->msgSuccess('Berhasil dihapus'));
                redirect('transaksi/pengeluaran');
            }else{
                $this->session->set_flashdata('msg', $this->msgError('Gagal dihapus!'));
            redirect('transaksi/pengeluaran');
            }
        }else{
            redirect('transaksi/pengeluaran');
        }
    }

    public function selesai($id = null)
    {
        if ($id != null) {
            if ($this->transaksi_m->updateSelesai($id)) {
                redirect('transaksi/pemasukan');
            }else{
                redirect('transaksi/pemasukan');
            }
        }else{
            redirect('transaksi/pemasukan');
        }
    }

}
