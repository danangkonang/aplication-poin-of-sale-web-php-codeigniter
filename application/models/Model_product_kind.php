<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_product_kind extends CI_Model {

  var $table = 'kind_products';
  var $column_order = array('kind_id');
  var $column_search = array('kind_name');
  var $order = array('kind_id' => 'desc');

	function get_kind_datatables() {
    $this->_get_datatables_query();
    if($_POST['length'] != -1){
      $this->db->limit($_POST['length'], $_POST['start']);
      $query = $this->db->get();
      return $query->result();
    }
  }

  private function _get_datatables_query() {
    $this->db->from($this->table);
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
    $this->_get_datatables_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function count_all() {
    $this->db->from($this->table);
    return $this->db->count_all_results();
  }

  public function find_kinds() {
    $this->db->select('kind_id, kind_name');
		return $this->db->get($this->table)->result();
  }

  public function find_kind($kind_id) {
    $this->db->from($this->table);
		$this->db->where('kind_id', $kind_id);
		return $this->db->get()->row();
  }

  function save_kind($data) {
		return $this->db->insert($this->table, $data);
	}

  function update_kind($kind_id, $data) {
		$this->db->where('kind_id', $kind_id);
		return $this->db->update($this->table, $data);
	}

}
