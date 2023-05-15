<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Histori_m extends CI_Model
{

    private $kas = 'kas';

    public function getLaporan($table, $tgl)
    {
        $this->db->order_by('tanggal', 'ASC');
        $this->db->where('tanggal' . ' >=', $tgl['mulai']);
        $this->db->where('tanggal' . ' <=', $tgl['akhir']);
        return $this->db->get($table)->result();
    }

    public function getCetakRekap($table, $tanggal) {
        $this->db->order_by('tanggal', 'ASC');
        $this->db->where('tanggal' . ' >=', $tanggal['mulai']);
        $this->db->where('tanggal' . ' <=', $tanggal['akhir']);      
        $this->db->select('tanggal, kategori, keterangan, jumlah_masuk, jumlah_keluar');
        return $this->db->get($table)->result();
    }
    
    public function getKasMasuk()
    {
        $this->db->order_by('id', 'DESC');
        $this->db->limit(5);
        $this->db->where('jenis' , 'masuk');
        return $this->db->get($this->kas)->result();
    }
    
    public function getKasKeluar()
    {
        $this->db->order_by('id', 'DESC');
        $this->db->limit(5);
        $this->db->where('jenis' , 'keluar');
        return $this->db->get($this->kas)->result();
    }
    
    // pendapatan
    public function getPendapatanPerHari($tgl)
    {
        $this->db->where('DATE(tanggal)', $tgl);
        $this->db->where('jenis' , 'masuk');
        return $this->_getJumlahMasuk($this->kas);
    }

    public function getPendapatanPerBulan($tgl)
    {
        $this->db->where('MONTH(tanggal)', date('m', strtotime($tgl)));
        $this->db->where('YEAR(tanggal)', date('Y', strtotime($tgl)));
        return $this->_getJumlahMasuk($this->kas);
    }
    
    public function getCountPendapatanPerhari($tgl)
    {
        $this->db->where('DATE(tanggal)', $tgl);
        return $this->_getCount($this->kas);
    }
    
    public function getCountPendapatanPerBulan($tgl)
    {
        $this->db->where('MONTH(tanggal)', date('m', strtotime($tgl)));
        $this->db->where('YEAR(tanggal)', date('Y', strtotime($tgl)));
        return $this->_getCount($this->kas);
    }
    
    // pengeluaran
    public function getPengeluaranPerHari($tgl)
    {
        $this->db->where('DATE(tanggal)', $tgl);
        return $this->_getJumlahKeluar($this->kas);
    }

    public function getPengeluaranPerBulan($tgl)
    {
        $this->db->where('MONTH(tanggal)', date('m', strtotime($tgl)));
        $this->db->where('YEAR(tanggal)', date('Y', strtotime($tgl)));
        return $this->_getJumlahKeluar($this->kas);
    }

    public function getCountUser()
    {
        return $this->db->count_all('user');
    }

    //Jumlah
    private function _getJumlahMasuk($table)
    {
        $this->db->select_sum('jumlah_masuk');
        return $this->db->get($table)->row();
    }
    private function _getJumlahKeluar($table)
    {
        $this->db->select_sum('jumlah_keluar');
        return $this->db->get($table)->row();
    }

    private function _getCount($table)
    {
        return $this->db->count_all_results($table);
    }

    public function getChartPendapatan($bulan)
    {
        $where = [
            'MONTH(tanggal)' => $bulan,
            'YEAR(tanggal)' => date('Y')
        ];
        $this->db->where($where);
        return $this->_getJumlahMasuk($this->kas)->jumlah_masuk;
    }

    public function getChartPengeluaran($bulan)
    {
        $where = [
            'MONTH(tanggal)' => $bulan,
            'YEAR(tanggal)' => date('Y')
        ];
        $this->db->where($where);
        return $this->_getJumlahKeluar($this->kas)->jumlah_keluar;
    }

    public function getChartTransaksi($bulan)
    {
        $where = [
            'MONTH(tanggal)' => $bulan,
            'YEAR(tanggal)' => date('Y')
        ];
        $this->db->where($where);
        $this->db->where('jenis' , 'masuk');
        $kas = $this->_getCount($this->kas);

        return $kas;
    }
}