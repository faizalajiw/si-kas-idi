<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Dashboard extends CI_Controller
{
    public function index()
    {
        $this->load->model('laporan_m');
        check_not_login();

        $tglSekarang = $this->_tgl();
        $kemarin = $this->_tgl('yesterday');
        $bulanLalu = $this->_tgl('last month');
        
        $pendapatan = [
            'pendapatan_sekarang' => $this->laporan_m->getPendapatanPerHari($tglSekarang)->jumlah,
            'pendapatan_perbulan' => $this->laporan_m->getPendapatanPerBulan($tglSekarang)->jumlah,
            'pendapatan_kemarin' => $this->laporan_m->getPendapatanPerHari($kemarin)->jumlah,
            'pendapatan_bulan_lalu' => $this->laporan_m->getPendapatanPerBulan($bulanLalu)->jumlah
        ];
        $pendapatan['persentase_pendapatan_sekarang'] = $this->_persentase($pendapatan['pendapatan_kemarin'], $pendapatan['pendapatan_sekarang']);
        $pendapatan['persentase_pendapatan_bulan'] = $this->_persentase($pendapatan['pendapatan_bulan_lalu'], $pendapatan['pendapatan_perbulan']);
        
        $pengeluaran = [
            'pengeluaran_sekarang' => $this->laporan_m->getPengeluaranPerHari($tglSekarang)->jumlah,
            'pengeluaran_perbulan' => $this->laporan_m->getPengeluaranPerBulan($tglSekarang)->jumlah,
            'pengeluaran_kemarin' => $this->laporan_m->getPengeluaranPerHari($kemarin)->jumlah,
            'pengeluaran_bulan_lalu' => $this->laporan_m->getPengeluaranPerBulan($bulanLalu)->jumlah
        ];
        $pengeluaran['persentase_pengeluaran_sekarang'] = $this->_persentase($pengeluaran['pengeluaran_kemarin'], $pengeluaran['pengeluaran_sekarang']);
        $pengeluaran['persentase_pengeluaran_bulan'] = $this->_persentase($pengeluaran['pengeluaran_bulan_lalu'], $pengeluaran['pengeluaran_perbulan']);
        
        $transaksi = [
            'transaksi_sekarang' => $this->laporan_m->getCountPendapatanPerHari($tglSekarang),
            'transaksi_perbulan' => $this->laporan_m->getCountPendapatanPerBulan($tglSekarang),
            'transaksi_kemarin' => $this->laporan_m->getCountPendapatanPerHari($kemarin),
            'transaksi_bulan_lalu' => $this->laporan_m->getCountPendapatanPerBulan($bulanLalu)
        ];
        $transaksi['persentase_transaksi_sekarang'] = $this->_persentase($transaksi['transaksi_kemarin'], $transaksi['transaksi_sekarang']);
        $transaksi['persentase_transaksi_bulan'] = $this->_persentase($transaksi['transaksi_bulan_lalu'], $transaksi['transaksi_perbulan']);
        
        $bln = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        foreach($bln as $b){
            $chart['cpdt'][] = $this->laporan_m->getChartPendapatan($b);
            $chart['cpgt'][] = $this->laporan_m->getChartPengeluaran($b);
            $chart['ctt'][] = $this->laporan_m->getChartTransaksi($b);
        }

        $data = [
            'pendapatan' => $pendapatan,
            'pengeluaran' => $pengeluaran,
            'transaksi' => $transaksi,
            'pending' => $this->laporan_m->getPemasukanPending(),
            'pengguna' => $this->laporan_m->getCountUser(),
            'pemasukan_terbaru' => $this->laporan_m->getPemasukan(),
            'pengeluaran_terbaru' => $this->laporan_m->getPengeluaran(),
            'chart' =>$chart,
        ];

        $this->template->load('template/template', 'dashboard',$data);
    }

    private function _tgl($tipe = null)
    {
        if ($tipe == null) {
            $date = date('Y-m-d',time());
        }else {
            $date = date('Y-m-d', strtotime($tipe));
        }
        return $date;
    }

    // $v1 kemarin, $v2 sekarang
    private function _persentase($v1, $v2)
    {   
        // ((sekarang - kemarin) / kemarin) * 100
        if ($v1 == 0) {
            return 0;
        }else{
            return (($v2 - $v1)/ $v1) * 100;
        }
    }
}
