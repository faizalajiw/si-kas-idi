<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_m extends CI_Model
{

    private $pemasukan = 'pemasukan';
    private $pengeluaran = 'pengeluaran';

    public function getLaporan($table, $tgl)
    {
        $this->db->order_by('tanggal', 'ASC');
        $this->db->where('tanggal' . ' >=', $tgl['mulai']);
        $this->db->where('tanggal' . ' <=', $tgl['akhir']);
        return $this->db->get($table)->result();
    }

    public function getPemasukan()
    {
        $this->db->join('user', 'id_user = user');
        $this->db->order_by('id_pemasukan', 'DESC');
        $this->db->limit(5);
        return $this->db->get($this->pemasukan)->result();
    }

    public function getPengeluaran()
    {
        $this->db->join('user', 'id_user = user');
        $this->db->order_by('id_pengeluaran', 'DESC');
        $this->db->limit(5);
        return $this->db->get($this->pengeluaran)->result();
    }

    // pendapatan
    public function getPendapatanPerHari($tgl)
    {
        $this->db->where('DATE(tanggal)', $tgl);
        return $this->_getJumlah($this->pemasukan);
    }

    public function getPendapatanPerBulan($tgl)
    {
        $this->db->where('MONTH(tanggal)', date('m', strtotime($tgl)));
        $this->db->where('YEAR(tanggal)', date('Y', strtotime($tgl)));
        return $this->_getJumlah($this->pemasukan);
    }
    
    public function getCountPendapatanPerhari($tgl)
    {
        $this->db->where('DATE(tanggal)', $tgl);
        return $this->_getCount($this->pemasukan);
    }
    
    public function getCountPendapatanPerBulan($tgl)
    {
        $this->db->where('MONTH(tanggal)', date('m', strtotime($tgl)));
        $this->db->where('YEAR(tanggal)', date('Y', strtotime($tgl)));
        return $this->_getCount($this->pemasukan);
    }

    public function getPemasukanPending()
    {
        $this->db->where('status', 'pending');
        return $this->_getCount($this->pemasukan);
    }
    
    // pengeluaran
    public function getPengeluaranPerHari($tgl)
    {
        $this->db->where('DATE(tanggal)', $tgl);
        return $this->_getJumlah($this->pengeluaran);
    }

    public function getPengeluaranPerBulan($tgl)
    {
        $this->db->where('MONTH(tanggal)', date('m', strtotime($tgl)));
        $this->db->where('YEAR(tanggal)', date('Y', strtotime($tgl)));
        return $this->_getJumlah($this->pengeluaran);
    }

    public function getCountUser()
    {
        return $this->db->count_all('user');
    }

    private function _getJumlah($table)
    {
        $this->db->select_sum('jumlah');
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
        return $this->_getJumlah($this->pemasukan)->jumlah;
    }

    public function getChartPengeluaran($bulan)
    {
        $where = [
            'MONTH(tanggal)' => $bulan,
            'YEAR(tanggal)' => date('Y')
        ];
        $this->db->where($where);
        return $this->_getJumlah($this->pengeluaran)->jumlah;
    }

    public function getChartTransaksi($bulan)
    {
        $where = [
            'MONTH(tanggal)' => $bulan,
            'YEAR(tanggal)' => date('Y')
        ];
        $this->db->where($where);
        $pemasukan = $this->_getCount($this->pemasukan);

        return $pemasukan;
    }
}