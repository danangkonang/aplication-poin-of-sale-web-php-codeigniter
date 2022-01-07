<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_toko extends CI_Model {
	public function simpan_data_toko($data) {
		return $this->db->insert('toko',$data);
	}
	
	public function find_store() {
		$this->db->select('*');
		return $this->db->get('stores')->row();
	}
	
	public function update_data_toko($data,$id) {
		$this->db->where('id_toko',$id);
		return $this->db->update('toko', $data);
	}
}
