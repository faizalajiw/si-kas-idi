<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekap_m extends CI_Model
{
    public function getRekap()
    {
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get('kas')->result();
        
        // $this->db->select('*');
        // $this->db->from('pemasukan');
        // $this->db->join('pengeluaran', 'pemasukan.id = pengeluaran.id');
        // $query = $this->db->get();
        // return $query->result();
    }
}
