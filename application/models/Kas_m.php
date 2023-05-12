<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kas_m extends CI_Model
{

    public function getPemasukan()
    {
        // $this->db->join('user', 'id_user = user');
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get('kas')->result();
    }

    public function simpanPemasukan($post)
    {
        $data = [
            'tanggal' => $post['tanggal'],
            'kategori' => $post['kategori'],
            'keterangan' => $post['keterangan'],
            'jumlah_masuk' => $post['jumlah_masuk'],
            'jenis' => $post['jenis'],
            // 'user' => $this->session->userdata('id_user')
        ];

        return $this->db->insert('kas',$data);
    }

    public function hapusPemasukan($id)
    {
        return $this->db->delete('kas', ['id' => $id]);
    }

    public function getPengeluaran()
    {
        // $this->db->join('user', 'id_user = user');
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get('kas')->result();
    }

    public function simpanPengeluaran($post)
    {
        $data = [
            'tanggal' => $post['tanggal'],
            'kategori' => $post['kategori'],
            'keterangan' => $post['keterangan'],
            'jumlah_keluar' => $post['jumlah_keluar'],
            'jenis' => $post['jenis'],
            // 'user' => $this->session->userdata('id_user')
        ];

        return $this->db->insert('kas',$data);
    }

    public function hapusPengeluaran($id)
    {
        return $this->db->delete('kas', ['id' => $id]);
    }

    // public function updateSelesai($id)
    // {
    //     return $this->db->update('kas', ['kategori' => 'selesai'], ['id' => $id]);
    // }

}



