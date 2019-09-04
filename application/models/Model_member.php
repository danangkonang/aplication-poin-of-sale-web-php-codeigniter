<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_member extends CI_Model {

    var $table = 'user';
	var $column_order = array(null,null,'nama');
	var $column_search = array('email');
    var $order = array('id' => 'desc');

    function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
    }

    private function _get_datatables_query()
	{
		$this->db->from($this->table);
		$i = 0;
		foreach ($this->column_search as $item)
		{
			if($_POST['search']['value'])
			{
				if($i===0)
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if(count($this->column_search) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}
		
		if(isset($_POST['order']))
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
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
    
    public function get_member($id)
    {
        $this->db->where('id',$id);
        return $this->db->get('user')->row_array();
    }

	public function validasi_cookie($user_cookie)
    {
        $this->db->where('cookie',$user_cookie);
       return $this->db->get('cookie')->row_array();
    }

    public function input_browser($data_browser)
    {
        return $this->db->insert('login',$data_browser);
    }

    public function input_cookie($data_cookie)
    {
        return $this->db->insert('cookie',$data_cookie);
    }

    public function cek_cookie_db($id)
    {
        $this->db->where('id_user_cookie',$id);
        return $this->db->get('cookie')->row();
        
    }

    public function update_cookie($data_update_cookie,$cookie_id)
    {
        $this->db->where('id_user_cookie',$cookie_id);
        return $this->db->update('cookie',$data_update_cookie);
    }

    //forgot password
    public function cek_data_email($email)
    {
        $this->db->where('email',$email);
        $this->db->where('aktif',1);
        return $this->db->get('user')->row_array();
    }

    public function cek_data_token($email, $token)
    {
        $this->db->where('email', $email);
        $this->db->where('token', urlencode($token));
        return $this->db->get('token')->row_array();
    }

    public function update_token($email, $data_token,$token)
    {
        $this->db->where('email', $email);
        $this->db->where('token', urlencode($token));
        return $this->db->update('token', $data_token);
    }

    public function simpan_token($data_token)
    {
        return $this->db->insert('token', $data_token);
    }

    public function save_new_password($email, $data)
    {
        $this->db->where('email',$email);
        return $this->db->update('user', $data);
    }

    //
    public function get_profil()
    {
        $this->db->where('id',$this->session->userdata('id'));
        return $this->db->get('user')->row_array();
    }

    
}