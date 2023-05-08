<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function index()
    {
        $this->load->model('laporan_m');
        check_not_login();
        $post = $this->input->post(NULL, TRUE);
        if (isset($post['cetak'])) {
            $table = $post['tabel'];
            $tanggal = $post['tanggal'];
            $pecahTanggal = explode(' - ', $tanggal);
            $tglMulai = date('Y-m-d', strtotime($pecahTanggal[0]));
            $tglAkhir = date('Y-m-d', strtotime(end($pecahTanggal)));
            
            $query = $this->laporan_m->getLaporan($table, ['mulai' => $tglMulai, 'akhir' => $tglAkhir]);
            $this->_cetak($query, $table, $tanggal);

        }else{
            $this->template->load('template/template', 'laporan/laporan');
        }
    }

    private function _cetak($data, $table, $tanggal)
    {
        $this->load->library('pdf');

        $pdf = new Fpdf();

        $pdf->AddPage('P', 'Letter');
        // $pdf->Image('logo.png',20,6,23);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(190, 7, '', 0, 1, 'C');
        $pdf->SetFont('Times', 'B', 16);
        $pdf->Cell(190, 7, 'IDI Cabang Brebes', 0, 1, 'C');
        $pdf->SetFont('Times', 'B', 8);
        // $pdf->Line(10,30,205,30);
        $pdf->Ln(10);

        // $pdf->AddPage('P', 'Letter');
        $pdf->SetFont('Times', 'B', 13);
        $pdf->Cell(190, 1, 'Laporan ' . ucfirst($table), 0, 1, 'C');
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(190, 10, 'Periode : ' . $tanggal, 0, 1, 'C');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', 'B', 10);

        $total = 0;
        if ($table == 'pemasukan') :
            
            $pdf->Cell(10, 7, 'No.', 1, 0, 'C');
            $pdf->Cell(25, 7, 'Tanggal', 1, 0, 'C');
            $pdf->Cell(85, 7, 'Catatan', 1, 0, 'C');
            $pdf->Cell(45, 7, 'Jumlah', 1, 0, 'C');
            // $pdf->Cell(30, 7, 'Status', 1, 0, 'C');
            $pdf->Ln();

            $no = 1;
            foreach ($data as $d) {
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
                $pdf->Cell(25, 7, $d->tanggal, 1, 0, 'C');
                $pdf->Cell(85, 7, $d->catatan, 1, 0, 'L');
                $pdf->Cell(45, 7,"Rp. " . number_format($d->jumlah), 1, 0, 'L');
                // $pdf->Cell(30, 7, $d->status, 1, 0, 'C');
                $pdf->Ln();
                $total += $d->jumlah;
            }
            $pdf->Cell(120, 7, 'Jumlah', 1, 0, 'L');
            $pdf->Cell(45, 7, "Rp. " . number_format($total), 1, 0, 'C');
            $pdf->Ln();
        else :
            $pdf->Cell(10, 7, '', 0, 0, 'C');
            $pdf->Cell(10, 7, 'No.', 1, 0, 'C');
            $pdf->Cell(25, 7, 'Tanggal', 1, 0, 'C');
            $pdf->Cell(85, 7, 'Catatan', 1, 0, 'C');
            $pdf->Cell(55, 7, 'Jumlah', 1, 0, 'C');
            $pdf->Ln();

            $no = 1;
            foreach ($data as $d) {
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(10, 7, '', 0, 0, 'C');
                $pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
                $pdf->Cell(25, 7, $d->tanggal, 1, 0, 'C');
                $pdf->Cell(85, 7, $d->catatan, 1, 0, 'L');
                $pdf->Cell(55, 7,"Rp. " . number_format($d->jumlah), 1, 0, 'L');
                $pdf->Ln();
                $total += $d->jumlah;
            }
            $pdf->Cell(10, 7, '', 0, 0, 'C');
            $pdf->Cell(120, 7, 'Jumlah', 1, 0, 'L');
            $pdf->Cell(55, 7, "Rp. " . number_format($total), 1, 0, 'C');
            $pdf->Ln();
        endif;


        $file_name = $table . ' ' . $tanggal;
        $pdf->Output('I', $file_name);
    }
}
