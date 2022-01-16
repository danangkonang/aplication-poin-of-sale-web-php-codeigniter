<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_product extends CI_Model
{

	var $table = 'products';
	var $column_order = array('product_id', null, 'kind_products.kind_name', 'product_name');
	var $column_search = array('product_name', 'barcode');
	var $order = array('product_id' => 'desc');

	function find_all_product(){
		$this->_get_product_query();
		if ($_POST['length'] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
			$query = $this->db->get();
			return $query->result();
		}
	}

	private function _get_product_query(){
		$this->db->from($this->table);
		$this->db->join('kind_products', 'kind_products.kind_id = products.kind_id');
		$i = 0;
		foreach ($this->column_search as $item) {
			if ($_POST['search']['value']) {
				if ($i === 0) {
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if (count($this->column_search) - 1 == $i) {
					$this->db->group_end();
				}
			}
			$i++;
		}

		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function count_filtered(){
		$this->_get_product_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all(){
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function save_product($data){
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function delete_by_id($id){
		$this->db->where('product_id', $id);
		return $this->db->delete($this->table);
	}

	public function get_by_id($id){
		$this->db->from($this->table);
		$this->db->where('product_id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function update($where, $data){
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function search_product($key){
		$this->db->select('*');
		$this->db->like('product_name', $key);
		$this->db->or_like('barcode', $key);
		$this->db->limit(10);
		$query = $this->db->get($this->table);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $data) {
				$hasil[] = $data;
			}
			return $hasil;
		}
	}

	public function find_by_barcode($key){
		$this->db->select('*');
		$this->db->where('barcode', $key);
		$this->db->limit(1);
		$query = $this->db->get($this->table);
		return $query->row();
	}



	function update_product_qty($id, $qty){
		$this->db->set('product_qty', $qty);
		$this->db->where('product_id', $id);
		return $this->db->update($this->table);
	}

	function get_product_qty($product_id){
		$this->db->select('product_qty');
		$this->db->where('product_id', $product_id);
		return $this->db->get($this->table)->row();
	}

	function is_duplicate_barcode($barcode){
		$this->db->where('barcode',$barcode);
		return $this->db->get($this->table)->row();
	}
}
