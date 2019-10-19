<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_member');
	}
	
	public function index()
	{
		$id= $this->session->userdata('id');
		if(! $id){
			$this->tdk_ada_sesion();
			}else{
				$this->load->view('kasir/kasir_view');
			}
	}
	
	public function tdk_ada_sesion()
	{
		$this->load->helper('cookie');
		$user_cookie = get_cookie('id');
		if(empty($user_cookie)){
			$this->load->view('user/form_login');
			}else{
				$this->cek_cookie_ke_db($user_cookie);
			}
	}
	
	public function cek_cookie_ke_db($user_cookie)
	{
		$data = $this->model_member->validasi_cookie($user_cookie);
		if($data =="")
		{
			$this->load->view('user/form_login');
		}
		else
		{
			$get = $this->model_member->get_member($data['id_user_cookie']);
			$this->load->library('user_agent');
			$data_browser =[
				'id_user' => $get["id"],
				'browser' => $this->agent->browser(),
				'browser_version' => $this->agent->version(),
				'os' => $this->agent->platform(),
				'waktu_login' => date("Y-m-m h:i:s"),
				'ip_address' => $this->input->ip_address()
			];
			$input_browser = $this->model_member->input_browser($data_browser);
			if($input_browser)
			{
				$cookie = $this->_acak($get['id']);
				$cookie_id = $get['id'];
				$data_input_cookie = [
					'cookie' => $cookie,
					'id_user_cookie' => $get['id']
				];
				$data_update_cookie = [
					'cookie' => $cookie,
					];
				$data_session = [
					'id'  => $get['id'],
					'username'  => $get['nama'],
					'email'  => $get['email'],
					'level'  => $get['level']
				];
				$this->_input_cookie($data_input_cookie, $data_update_cookie, $data_session, $cookie_id);
				$this->_cookie_session($data_session,$cookie);
				header("location: http://localhost/penjualan");
			}
		}
	}
	
	private function _acak($n)
	{
		$key = 'q6w7ert4yu8iop3asd2fgh0jk5lzx9cvb1nm';
		$text = strlen($key)-1;
		$hasil = array();
		$hasil = '';
			for($i=0; $i<$n; $i++){
				for($j=0; $j<32; $j++){
					$buat = rand(0, strlen($key)-1);
					$hasil .= $key[$buat];
				}
			}
		return $hasil;
	}

	private function _input_cookie($data_input_cookie, $data_update_cookie, $data_session, $cookie_id)
	{
		
		$cek_cookie = $this->model_member->cek_cookie_db($cookie_id);
		if($cek_cookie)
		{
			$this->model_member->update_cookie($data_update_cookie,$cookie_id);
			return;
		}
		else 
		{
			$input_cookie = $this->model_member->input_cookie($data_input_cookie);
			return;
		}
	}

	private function _cookie_session($data_session,$cookie)
	{
		$this->load->helper('cookie');
		delete_cookie('id');
		set_cookie('id',$cookie,'604800');
		$this->session->set_userdata($data_session);
		return;
	}
		
	
			
			
}