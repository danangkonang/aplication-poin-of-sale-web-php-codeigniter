<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_merchant extends CI_Model {
	var $table = 'merchants';

	public function simpan_data_merchant($data) {
		return $this->db->insert($this->table, $data);
	}
	
	public function find_merchant() {
		$this->db->select('*');
		return $this->db->get($this->table)->row();
	}
	
	public function update_data_merchant($data, $id) {
		$this->db->where('merchant_id', $id);
		return $this->db->update($this->table, $data);
	}
}
