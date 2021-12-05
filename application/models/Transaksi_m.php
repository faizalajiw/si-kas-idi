<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_m extends CI_Model
{

    public function getPemasukan()
    {
        $this->db->join('user', 'id_user = user');
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get('pemasukan')->result();
    }

    public function simpanPemasukan($post)
    {
        $data = [
            'tanggal' => $post['tanggal'],
            'catatan' => $post['catatan'],
            'jumlah' => $post['jumlah'],
            'status' => $post['status'],
            'user' => $this->session->userdata('id_user')
        ];

        return $this->db->insert('pemasukan',$data);
    }

    public function hapusPemasukan($id)
    {
        return $this->db->delete('pemasukan', ['id_pemasukan' => $id]);
    }

    public function getPengeluaran()
    {
        $this->db->join('user', 'id_user = user');
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get('pengeluaran')->result();
    }

    public function simpanPengeluaran($post)
    {
        $data = [
            'tanggal' => $post['tanggal'],
            'catatan' => $post['catatan'],
            'jumlah' => $post['jumlah'],
            'user' => $this->session->userdata('id_user')
        ];

        return $this->db->insert('pengeluaran',$data);
    }

    public function hapusPengeluaran($id)
    {
        return $this->db->delete('pengeluaran', ['id_pengeluaran' => $id]);
    }

    public function updateSelesai($id)
    {
        return $this->db->update('pemasukan', ['status' => 'selesai'], ['id_pemasukan' => $id]);
    }

}



