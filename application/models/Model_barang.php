<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_barang extends CI_Model {
	
	var $table = 'product';
	var $column_order = array(null, null, 'purchase_price');
	var $column_search = array('product_name');
	var $order = array('product_id' => 'desc');
	
	function find_all_product() {
		$this->_get_product_query();
		if($_POST['length'] != -1){
      $this->db->limit($_POST['length'], $_POST['start']);
      $query = $this->db->get();
      return $query->result();
    }
	}
	
	private function _get_product_query() {
		$this->db->from($this->table);
		$i = 0;
		foreach ($this->column_search as $item) {
			if($_POST['search']['value']) {
				if($i===0) {
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else {
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if(count($this->column_search) - 1 == $i){
					$this->db->group_end();
        }
			}
			$i++;
		}
		
		if(isset($_POST['order'])) {
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	
	function count_filtered() {
		$this->_get_product_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all() {
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
	
	public function save_product($data) {
		$this->db->insert('product', $data);
		return $this->db->insert_id();
	}
	
	public function delete_by_id($id) {
		$this->db->where('id_barang', $id);
		return $this->db->delete($this->table);
	}
	
	public function get_by_id($id) {
		$this->db->from($this->table);
		$this->db->where('id_barang',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	public function update($where, $data) {
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
	
	public function search_product($key) {
		$this->db->select('*');
		$this->db->like('product_name', $key);
		$this->db->or_like('product_id', $key);
		$query = $this->db->get('product');
		if($query->num_rows() > 0) {
			foreach($query->result() as $data) {
				$hasil[] = $data;
			}
			return $hasil;
		}
	}
	
	function insert_penjualan($data) {
		return $this->db->insert('penjualan',$data);
	}
	
	function update_setok($id,$qty) {
		$this->db->set('setok',$qty);
		$this->db->where('id_barang',$id);
		return $this->db->update('barang');
	}
	
	function get_setok($id) {
		$this->db->select('setok');
		$this->db->where('id_barang',$id);
		return $this->db->get('barang')->row();
	}
	
}
