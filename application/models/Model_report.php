<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_report extends CI_Model {
	
	var $table = 'transactions';
	var $column_order = array(null,'product_name');
	var $column_search = array('product_name');
	var $order = array('transaction_id' => 'desc');
	
	function get_data_laba() {
		$this->_get_data_laba_query();
		if($_POST['length'] != -1){
      $this->db->limit($_POST['length'], $_POST['start']);
      $query = $this->db->get();
      return $query->result();
    }
	}
	
	private function _get_data_laba_query(){
		$this->db->from($this->table);
		$this->db->join('products', 'products.product_id = transactions.product_id');
		$i = 0;
		foreach ($this->column_search as $item) {
			if($_POST['search']['value']) {
				if($i===0) {
					$this->db->group_start();
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
		$this->_get_data_laba_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all() {
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
	
	public function trend()
	{
		$data = [];
		for($i = 1; $i <= 12; $i++){
			$query = $this->db->query('select sum(price) as total from transactions where month(created_at)='.$i.'');
			$data[]=$query->row()->total == null? 0 : $query->row()->total;
		}
		return $data;
	}
}
