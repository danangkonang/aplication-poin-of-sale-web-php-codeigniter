<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_transaction extends CI_Model
{

	var $table = 'transactions as tr';
	var $column_order = array('transaction_id', null, null, 'product_name');
	var $column_search = array('products.product_name');
	var $order = array('tr.transaction_id' => 'DESC');

	function get_datatables(){
		$this->_get_datatables_query();
		if ($_POST['length'] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
			$query = $this->db->get();
			return $query->result();
		}
	}

	function create_order($data){
		return $this->db->insert('transactions', $data);
	}

	private function _get_datatables_query(){
		$this->db->select('tr.transaction_code, tr.product_name AS newname, tr.qty, users.user_name, tr.price, tr.created_at, products.purchase_price');
		$this->db->from($this->table);
		$this->db->join('products', 'products.product_id = tr.product_id');
		$this->db->join('users', 'users.user_id = tr.created_by');
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

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	function get_data_laba()
	{
		$this->_get_data_laba_query();
		if ($_POST['length'] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
			$query = $this->db->get();
			return $query->result();
		}
	}

	private function _get_data_laba_query()
	{
		$this->db->from($this->table);
		$this->db->join('barang', 'barang.id = penjualan.kode_barang');
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

		function sum_daily()
		{
			$query = $this->db->query('select sum(price) as total from transactions where day(created_at)='.date("d").'');
			return $query->row()->total;
		}

		function sum_monthly()
		{
			$query = $this->db->query('select sum(price) as total from transactions where month(created_at)='.date("m").'');
			return $query->row()->total;
		}
}
