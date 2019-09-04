<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_registrasi extends CI_Model {
	
	public function daftar_baru($data)
	{
		return $this->db->insert('user',$data);
	}
	
	public function simpan_token($data_token)
    {
        return $this->db->insert('token', $data_token);
    }
    
    public function cek_data_token($email)
    {
        $this->db->where('email', $email);
        return $this->db->get('token')->row_array();
    }
    
    public function update_aktif($email)
    {
        $data = ['aktif' => 1];
        $this->db->where('email',$email);
        return $this->db->update('user', $data);
    }
    
    public function delete_token($email)
    {
        $this->db->where('email',$email);
        return $this->db->delete('token');
    }
    
    public function delete_user($email)
    {
        $this->db->where('email',$email);
        return $this->db->delete('user');
    }
    
}