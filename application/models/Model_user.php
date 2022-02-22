<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_user extends CI_Model {

  var $table = 'users';
  var $column_order = array(null, null, 'user_name');
  var $column_search = array('email');
  var $order = array('user_id' => 'desc');

  function get_datatables() {
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

  public function get_member($id) {
    $this->db->where('id',$id);
    return $this->db->get($this->table)->row_array();
  }

  public function validasi_cookie($user_cookie) {
    $this->db->where('token_login',$user_cookie);
    return $this->db->get($this->table)->row_array();
  }

  public function input_browser($data_browser) {
    return $this->db->insert('login',$data_browser);
  }

  public function input_cookie($data_cookie) {
    return $this->db->insert('cookies',$data_cookie);
  }

  public function cek_cookie_db($id) {
    $this->db->where('id_user_cookie',$id);
    return $this->db->get('cookies')->row();
    
  }

  public function update_cookie($data_update_cookie,$cookie_id) {
    $this->db->where('id_user_cookie',$cookie_id);
    return $this->db->update('cookies',$data_update_cookie);
  }

  public function cek_data_email($email) {
    $this->db->where('email',$email);
    $this->db->where('is_active',1);
    return $this->db->get('users')->row_array();
  }

  public function cek_data_token($email, $token) {
    $this->db->where('email', $email);
    $this->db->where('token', urlencode($token));
    return $this->db->get('tokens')->row_array();
  }

  public function update_token($email, $data_token,$token) {
    $this->db->where('email', $email);
    $this->db->where('token', urlencode($token));
    return $this->db->update('tokens', $data_token);
  }

  public function simpan_token($data_token) {
    return $this->db->insert('tokens', $data_token);
  }

  public function save_new_password($email, $data) {
    $this->db->where('email',$email);
    return $this->db->update('users', $data);
  }

  public function get_profil() {
    $this->db->where('user_id',$this->session->userdata('user_id'));
    return $this->db->get($this->table)->row_array();
  }

  function count_employee()
  {
    $query = $this->db->query('select count(*) as total from users where role != "admin" ');
    return $query->row()->total;
  }
    
}