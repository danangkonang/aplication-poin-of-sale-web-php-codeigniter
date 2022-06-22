<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Model_registrasi extends CI_Model
{
	public function daftar_baru($data)
	{
		$this->db->insert('users', $data);
		return $this->db->insert_id();
	}

	public function simpan_token($data_token)
	{
		return $this->db->insert('tokens', $data_token);
	}

	public function cek_data_token($email)
	{
		$this->db->where('email', $email);
		return $this->db->get('tokens')->row_array();
	}

	public function update_aktif($email)
	{
		$data = ['aktif' => 1];
		$this->db->where('email', $email);
		return $this->db->update('users', $data);
	}

	public function delete_token($email)
	{
		$this->db->where('email', $email);
		return $this->db->delete('tokens');
	}

	public function delete_user($email)
	{
		$this->db->where('email', $email);
		return $this->db->delete('users');
	}
}
