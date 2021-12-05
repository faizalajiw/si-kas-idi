<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Homepage_m extends CI_Model
{

    public function getBanner($id = null)
    {
        if ($id != null) {
            $this->db->where('id_banner', $id);
        }

        $this->db->order_by('id_banner', 'DESC');
        return $this->db->get('banner')->result();
    }

    public function getInfo()
    {
        return $this->db->get('home')->row();
    }

    public function getHari($id = null)
    {
        if ($id != null) {
            $this->db->where('id', $id);
        }
        return $this->db->get('jam_buka')->result();
    }

    public function getLayanan($id = null)
    {
        if ($id != null) {
            $this->db->where('id', $id);
        }
        return $this->db->get('layanan')->result();
    }

    public function getGaleri($id = null)
    {
        if ($id != null) {
            $this->db->where('id', $id);
        }
        return $this->db->get('galeri')->result();
    }

    public function updateHome($post)
    {
        $data = [
            'judul' => $post['judul'],
            'slogan' => $post['slogan'],
            'alamat' => $post['alamat'],
            'kontak' => $post['kontak']
        ];
        return $this->db->update('home', $data);
    }

    public function updateJam($post)
    {
        $data = [
            'jam' => $post['jam']
        ];
        return $this->db->update('jam_buka', $data, ['id' => $post['id']]);
    }

    public function hapusBanner($id)
    {
        $banner = $this->getBanner($id)[0];
        if (file_exists('./assets/img/banner/'. $banner->banner)) 
        {
            unlink('./assets/img/banner/'. $banner->banner);
        }
        return $this->db->delete('banner', ['id_banner' => $id]);
    }

    public function hapusGaleri($id)
    {
        $galeri = $this->getGaleri($id)[0];
        if (file_exists('./assets/img/galeri/'. $galeri->gambar)) 
        {
            unlink('./assets/img/galeri/'. $galeri->gambar);
        }
        return $this->db->delete('galeri', ['id' => $id]);
    }

    public function hapusLayanan($id)
    {
        $layanan = $this->getLayanan($id)[0];
        if (file_exists('./assets/img/icons/layanan/'. $layanan->gambar)) 
        {
            unlink('./assets/img/icons/layanan/'. $layanan->gambar);
        }
        return $this->db->delete('layanan', ['id' => $id]);
    }

    public function tambahGaleri($post)
    {
        $data = [
            'gambar' => $post['foto'],
            'tanggal' => date('Y-m-d')
        ];
    
        return $this->db->insert('galeri',$data);
    }

    public function tambahBanner($post)
    {
        $data = [
            'tanggal' => date('Y-m-d'),
            'banner' => $post['foto']
        ];
    
        return $this->db->insert('banner',$data);
    }

    public function tambahLayanan($post)
    {
        $data = [
            'nama' => $post['nama'],
            'gambar' => $post['foto']
        ];
    
        return $this->db->insert('layanan',$data);
    }
}