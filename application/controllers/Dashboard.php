<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Dashboard extends CI_Controller
{
    public function index()
    {
        $this->load->model('histori_m');
        check_not_login();

        $tglSekarang = $this->_tgl();
        $kemarin = $this->_tgl('yesterday');
        $bulanLalu = $this->_tgl('last month');
        
        $pendapatan = [
            'pendapatan_sekarang' => $this->histori_m->getPendapatanPerHari($tglSekarang)->jumlah_masuk,
            'pendapatan_perbulan' => $this->histori_m->getPendapatanPerBulan($tglSekarang)->jumlah_masuk,
            'pendapatan_kemarin' => $this->histori_m->getPendapatanPerHari($kemarin)->jumlah_masuk,
            'pendapatan_bulan_lalu' => $this->histori_m->getPendapatanPerBulan($bulanLalu)->jumlah_masuk
        ];
        $pendapatan['persentase_pendapatan_sekarang'] = $this->_persentase($pendapatan['pendapatan_kemarin'], $pendapatan['pendapatan_sekarang']);
        $pendapatan['persentase_pendapatan_bulan'] = $this->_persentase($pendapatan['pendapatan_bulan_lalu'], $pendapatan['pendapatan_perbulan']);
        
        $pengeluaran = [
            'pengeluaran_sekarang' => $this->histori_m->getPengeluaranPerHari($tglSekarang)->jumlah_keluar,
            'pengeluaran_perbulan' => $this->histori_m->getPengeluaranPerBulan($tglSekarang)->jumlah_keluar,
            'pengeluaran_kemarin' => $this->histori_m->getPengeluaranPerHari($kemarin)->jumlah_keluar,
            'pengeluaran_bulan_lalu' => $this->histori_m->getPengeluaranPerBulan($bulanLalu)->jumlah_keluar
        ];
        $pengeluaran['persentase_pengeluaran_sekarang'] = $this->_persentase($pengeluaran['pengeluaran_kemarin'], $pengeluaran['pengeluaran_sekarang']);
        $pengeluaran['persentase_pengeluaran_bulan'] = $this->_persentase($pengeluaran['pengeluaran_bulan_lalu'], $pengeluaran['pengeluaran_perbulan']);
        
        $transaksi = [
            'transaksi_sekarang' => $this->histori_m->getCountPendapatanPerHari($tglSekarang),
            'transaksi_perbulan' => $this->histori_m->getCountPendapatanPerBulan($tglSekarang),
            'transaksi_kemarin' => $this->histori_m->getCountPendapatanPerHari($kemarin),
            'transaksi_bulan_lalu' => $this->histori_m->getCountPendapatanPerBulan($bulanLalu)
        ];
        $transaksi['persentase_transaksi_sekarang'] = $this->_persentase($transaksi['transaksi_kemarin'], $transaksi['transaksi_sekarang']);
        $transaksi['persentase_transaksi_bulan'] = $this->_persentase($transaksi['transaksi_bulan_lalu'], $transaksi['transaksi_perbulan']);
        
        $bln = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        foreach($bln as $b){
            $chart['cpdt'][] = $this->histori_m->getChartPendapatan($b);
            $chart['cpgt'][] = $this->histori_m->getChartPengeluaran($b);
            $chart['ctt'][] = $this->histori_m->getChartTransaksi($b);
        }

        $data = [
            'pendapatan' => $pendapatan,
            'pengeluaran' => $pengeluaran,
            'transaksi' => $transaksi,
            'pengguna' => $this->histori_m->getCountUser(),
            'pemasukan_terbaru' => $this->histori_m->getKasMasuk(),
            'pengeluaran_terbaru' => $this->histori_m->getKasKeluar(),
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
