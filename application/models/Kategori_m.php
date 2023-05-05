<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_m extends CI_Model
{

    public function getKategoriPemasukan()
    {
        return $this->db->get('kategori_pemasukan')->result();
    }

    public function simpanKategoriPemasukan($post)
    {
        $data = [
            'nama' => $post['nama']
        ];

        return $this->db->insert('kategori_pemasukan',$data);
    }

    public function hapusKategoriPemasukan($id)
    {
        return $this->db->delete('kategori_pemasukan', ['id_kategori' => $id]);
    }
}

