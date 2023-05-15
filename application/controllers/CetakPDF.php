<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CetakPDF extends CI_Controller
{
    public function index()
    {
        // Load library Fpdf
        $this->load->model('histori_m');
        check_not_login();
        $post = $this->input->post(NULL, TRUE);
        if (isset($post['cetak'])) {
            $table = $post['tabel'];
            $tanggal = $post['tanggal'];
            $pecahTanggal = explode(' - ', $tanggal);
            $tglMulai = date('Y-m-d', strtotime($pecahTanggal[0]));
            $tglAkhir = date('Y-m-d', strtotime(end($pecahTanggal)));

            $query = $this->histori_m->getCetakRekap($table, ['mulai' => $tglMulai, 'akhir' => $tglAkhir]);
            $this->_cetak($query, $table, $tanggal);
            
        } else {
            $this->template->load('template/template', 'laporan/rekap');
        }
    }

    private function _cetak($table, $result, $tanggal)
    {
        $this->load->library('pdf');
        // Set judul dan ukuran halaman
        // $pdf = new Fpdf('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf = new Fpdf();
        $pdf->SetTitle('Laporan Transaksi ' . date('d F Y', strtotime($tanggal)));

        // Tambahkan halaman
        $pdf->AddPage();

        // Tambahkan judul
        $pdf->SetFont('times', 'B', 16);
        $pdf->Cell(0, 10, 'Laporan Transaksi ' . date('d F Y', strtotime($tanggal)), 0, 1, 'C');

        // Tambahkan tabel data
        $pdf->SetFont('times', '', 12);
        
        if ($table == 'kas') {
            $pdf->SetFillColor(230, 230, 230);
            $pdf->Cell(30, 10, 'Tanggal', 1, 0, 'C', 1);
            $pdf->Cell(40, 10, 'Kategori', 1, 0, 'C', 1);
            $pdf->Cell(70, 10, 'Keterangan', 1, 0, 'C', 1);
            $pdf->Cell(40, 10, 'Jumlah Masuk', 1, 0, 'C', 1);
            $pdf->Cell(40, 10, 'Jumlah Keluar', 1, 1, 'C', 1);

            foreach ($result as $row) {
                $pdf->Cell(30, 10, date('d F Y', strtotime($row->tanggal)), 1, 0, 'C');
                $pdf->Cell(40, 10, $row->kategori, 1, 0, 'L');
                $pdf->Cell(70, 10, $row->keterangan, 1, 0, 'L');
                $pdf->Cell(40, 10, number_format($row->jumlah_masuk), 1, 0, 'R');
                $pdf->Cell(40, 10, number_format($row->jumlah_keluar), 1, 1, 'R');
            }
            $file_name = $table . ' ' . $tanggal;
            $pdf->Output('I', $file_name);
            // $pdf->Output('Laporan Transaksi ' . date('d F Y', strtotime($tanggal)) . '.pdf', 'I');
        }
    }
}
