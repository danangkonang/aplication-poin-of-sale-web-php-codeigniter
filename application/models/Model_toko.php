<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_toko extends CI_Model {
	
	public function simpan_data_toko($data)
	{
		return $this->db->insert('toko',$data);
		//$this->db->where('id_toko',$id);
		//$this->db->update('toko', $data);
	}
	
	public function get_data_toko()
	{
		$this->db->select('*');
		$this->db->limit(1);
		return $this->db->get('toko')->row();
	}
	
	public function update_data_toko($data,$id)
	{
		//return $this->db->insert('toko',$data);
		$this->db->where('id_toko',$id);
		return $this->db->update('toko', $data);
	}
	
}