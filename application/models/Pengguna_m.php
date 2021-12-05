<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna_m extends CI_Model
{

    public function login($post)
    {
        $where = [
            'username' => $post['username'],
            'password' => $post['password'],
            'is_active' => "1"
        ];

        return $this->db->get_where('user', $where);
    }

    public function getUser($id_user = null)
    {
        if ($id_user != null) {
            $this->db->where('id_user', $id_user);
        }
        return $this->db->get('user')->result();
    }

    public function simpanUser($post)
    {
        
        if (!$this->_checkUsername($post['username'])) {
            $data = [
                'username' => $post['username'],
                'nama' => $post['nama'],
                'email' => $post['email'],
                'no_telp' => $post['no_telp'],
                'create_at' => time(),
                'password' => $post['password'],
                'role' => $post['role']
            ];
            return $this->db->insert('user', $data);
        }
        return false;
    }

    public function setActive($id)
    {
        $user = $this->getUser($id)[0];
        
        if ($user->is_active == 1) {
            $data = [
                'is_active' => '0'
            ];
        }else if($user->is_active == 0){
            $data = [
                'is_active' => '1'
            ];
        }
        return $this->db->update('user',$data, ['id_user' => $id]);
    }

    public function updateProfil($post)
    {
        $user = $this->getUser($post['id']);
        if ($user) {
            $user = $user[0]->username;

            $data = [
                'nama' => $post['nama'],
                'email' => $post['email'],
                'no_telp' => $post['no_telp']
            ];
            if($post['foto'] != null) $data['foto'] = $post['foto'];

            if($user != $post['username'] && empty($this->_checkUsername($post['username']))){
                
                $data['username'] = $post['username'];
            }
            return $this->db->update('user',$data, ['id_user' => $post['id']]);
        }
        return false;
    }

    public function updatePassword($post)
    {
        if ($post['password_baru'] == $post['konfirmasi_password']) {
            if ($this->_checkPassword($post['password_lama'])) {
                $data = [
                    'password' => $post['password_baru'],
                ];
                return $this->db->update('user', $data, ['id_user' => $post['id']]);
            }
            return false;
        }
        return false;
    }

    private function _checkPassword($password)
    {
        $this->db->select('password');
        return $this->db->get_where('user', ['password' => $password])->row();
    }

    private function _checkUsername($username)
    {
        return $this->db->get_where('user', ['username' => $username])->row();
    }

    public function hapusUser($id)
    {
        $user = $this->getUser($id)[0];
        if (file_exists('./assets/img/profil/'. $user->foto)) 
        {
            unlink('./assets/img/profil/'. $user->foto);
        }
        return $this->db->delete('user', ['id_user' => $id]);
    }

}



