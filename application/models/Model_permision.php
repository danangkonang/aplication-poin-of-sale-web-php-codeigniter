<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_permision extends CI_Model {
  var $table = 'permisions';
  var $column_order = array();
  var $column_search = array();
  var $order = array('permision_id' => 'desc');

  function find_permision() {
    $this->_get_datatables_query();
    if($_POST['length'] != -1){
      $this->db->limit($_POST['length'], $_POST['start']);
      $query = $this->db->get();
      return $query->result();
    }
  }

  private function _get_datatables_query() {
    $this->db->from($this->table);
    $this->db->where('users.role !=', 'admin');
    $this->db->join('users', 'users.user_id = permisions.user_id');
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

  public function is_read($user_id){
    $this->db->select('read');
    $this->db->where('user_id', $user_id);
		return $this->db->get($this->table)->row()->read;
  }

  public function is_create($user_id){
    $this->db->select('create');
    $this->db->where('user_id', $user_id);
		return $this->db->get($this->table)->row()->create;
  }

  public function is_update($user_id){
    $this->db->select('update');
    $this->db->where('user_id', $user_id);
		return $this->db->get($this->table)->row()->update;
  }

  public function is_delete($user_id){
    $this->db->select('delete');
    $this->db->where('user_id', $user_id);
		return $this->db->get($this->table)->row()->delete;
  }

  public function set_read($user_id, $read){
    $data = ['read' => $read];
    $this->db->where('user_id', $user_id);
		return $this->db->update($this->table, $data);
  }

  public function set_create($user_id, $create){
    $data = ['create' => $create];
    $this->db->where('user_id', $user_id);
		return $this->db->update($this->table, $data);
  }

  public function set_update($user_id, $update){
    $data = ['update' => $update];
    $this->db->where('user_id', $user_id);
		return $this->db->update($this->table, $data);
  }

  public function set_delete($user_id, $delete){
    $data = ['delete' => $delete];
    $this->db->where('user_id', $user_id);
		return $this->db->update($this->table, $data);
  }

  public function permision_by_id($user_id){
    $this->db->where('user_id', $user_id);
		return $this->db->get($this->table)->row();
  }

  public function update_permision($user_id, $data){
    $this->db->where('user_id', $user_id);
		return $this->db->update($this->table, $data);
  }

  public function set_my_permision($id){
    $data_session = [
      'read' => $this->is_read($id),
      'create' => $this->is_create($id),
      'update' => $this->is_update($id),
      'delete' => $this->is_delete($id),
    ];
    $this->session->set_userdata($data_session);
  }

  public function new_permision($data){
    return $this->db->insert($this->table, $data);
  }
}
