<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function index()
    {
        $this->load->model('histori_m');
        check_not_login();
        $post = $this->input->post(NULL, TRUE);
        if (isset($post['cetak'])) {
            $table = $post['tabel'];
            $tanggal = $post['tanggal'];
            $pecahTanggal = explode(' - ', $tanggal);
            $tglMulai = date('Y-m-d', strtotime($pecahTanggal[0]));
            $tglAkhir = date('Y-m-d', strtotime(end($pecahTanggal)));

            $query = $this->histori_m->getLaporan($table, ['mulai' => $tglMulai, 'akhir' => $tglAkhir]);
            $this->_cetak($query, $table, $tanggal);
        } else {
            $this->template->load('template/template', 'laporan/laporan');
        }
    }

    private function _cetak($data, $table, $tanggal)
    {
        $this->load->library('pdf');

        $pdf = new Fpdf();

        $pdf->AddPage('P', 'Letter');
        // $pdf->Image('logo.png',20,6,23);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(190, 7, '', 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(190, 7, 'IDI Cabang Brebes', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 8);
        // $pdf->Line(10,25,205,25);
        $pdf->Ln(10);

        // $pdf->AddPage('P', 'Letter');
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(190, 1, 'Laporan ' . ucfirst($table), 0, 1, 'C');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(190, 10, 'Periode : ' . $tanggal, 0, 1, 'C');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', 'B', 9);

        $total_masuk = 0;
        $total_keluar = 0;
        if ($table == 'kas') :
        // ------------------ KAS MASUK --------------------
            // Title 1: Kas Masuk
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(0, 10, 'Kas Masuk', 0, 1, 'L');
            $pdf->Ln(3);

            // Table header
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(30, 7, 'Tanggal', 'B', 0, 'C');
            $pdf->Cell(100, 7, 'Keterangan', 'B', 0, 'C');
            $pdf->Cell(65, 7, 'Jumlah Masuk', 'B', 1, 'C');

            // Table rows
            $pdf->SetFont('Arial', '', 10);
            foreach ($data as $d) {
                $total_masuk += $d->jumlah_masuk;

                if ($d->jumlah_masuk != 0) {
                    $pdf->Cell(30, 7, $d->tanggal, 0, 0, 'L');
                    $pdf->Cell(100, 7, $d->keterangan, 0, 0, 'L');
                    $pdf->Cell(65, 7, "Rp. " . number_format($d->jumlah_masuk), 0, 1, 'C');
                } else {
                    // $pdf->Cell(65, 7, "-", 0, 1, 'C');
                }
            }
            $pdf->Ln(3);
            // Total Masuk
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(130, 7, 'Total Pemasukan :', 0, 0, 'R');
            $pdf->Cell(65, 7, "Rp. " . number_format($total_masuk), 0, 1, 'C');
            $pdf->Ln(10);
        // ------------------ KAS MASUK --------------------

        // ------------------ KAS KELUAR --------------------
            // Title 1: Kas Keluar
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(0, 10, 'Kas Keluar', 0, 1, 'L');
            $pdf->Ln(3);

            // Table header
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(30, 7, 'Tanggal', 'B', 0, 'C');
            $pdf->Cell(100, 7, 'Keterangan', 'B', 0, 'C');
            $pdf->Cell(65, 7, 'Jumlah Keluar', 'B', 1, 'C');

            // Table rows
            $pdf->SetFont('Arial', '', 10);
            foreach ($data as $d) {
                $total_keluar += $d->jumlah_keluar;

                if ($d->jumlah_keluar != 0) {
                    $pdf->Cell(30, 7, $d->tanggal, 0, 0, 'L');
                    $pdf->Cell(100, 7, $d->keterangan, 0, 0, 'L');
                    $pdf->Cell(65, 7, "Rp. " . number_format($d->jumlah_keluar), 0, 1, 'C');
                } else {
                    // $pdf->Cell(65, 7, "-", 0, 1, 'C');
                }
            }
            $pdf->Ln(3);
            // Total Keluar
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(130, 7, 'Total Pengeluaran :', 0, 0, 'R');
            $pdf->Cell(65, 7, "Rp. " . number_format($total_keluar), 0, 1, 'C');
            $pdf->Ln(10);
        // ------------------ KAS KELUAR --------------------

        // ------------------ SALDO AKHIR -------------------
            // Calculate Saldo Akhir
            $saldo_akhir = $total_masuk - $total_keluar;

            // Title 3: Saldo Akhir
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(30, 10, 'Saldo Akhir : ', 0, 0, 'L');
            $pdf->Cell(70, 10, "Rp. " . number_format($saldo_akhir), 0, 0, 'L');
        // ------------------ SALDO AKHIR -------------------
        endif;


        $file_name = $table . ' ' . $tanggal;
        $pdf->Output('I', $file_name);
    }
}
