<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_login extends CI_Model {
	public function cek_email_member($email)
	{
		$this->db->where('email',$email);
		return $this->db->get('user')->row_array();
	}
}