<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_user');
		$this->load->model('model_permision');
		$this->load->model('model_product');
		$this->load->model('model_transaction');
		
	}

	public function index()
	{
		$id = $this->session->userdata('user_id');
		if (!$id) {
			$this->empty_sesion();
		} else {
			$data_session = [
      		    'title' => 'Dashboard',
				'active_class' => 'dashboard',
     		 ];
			$this->session->set_userdata($data_session);
		
			$data = [
				'pendapatan_harian' => $this->model_transaction->sum_daily(),
				'pendapatan_bulanan' => $this->model_transaction->sum_monthly(),
				'produk' =>$this->model_product->count_all(),
				'pegawai' => $this->model_user->count_employee(),
			];
			// var_dump($data);
			// die;
			$this->load->view('dashboard/dashboard',$data);
		
    }
	}

	public function empty_sesion()
	{
		$this->load->helper('cookie');
		$user_cookie = get_cookie('cookie_id');
		if (empty($user_cookie)) {
			$this->load->view('auth/form_login');
		} else {
			$this->auth_valid_cookie($user_cookie);
		}
	}

	public function auth_valid_cookie($user_cookie)
	{
		$data = $this->model_user->validasi_cookie($user_cookie);
		if ($data == NULL) {
			delete_cookie('cookie_id');
			$this->load->view('auth/form_login');
			return;
		}
		if (!$data) {
			delete_cookie('cookie_id');
			$this->load->view('auth/form_login');
			return;
		}
		if ($data['token_login'] == $user_cookie) {
			$this->load->model('model_login');
			$data_session = [
				'user_id'  => $data['user_id'],
				'user_name'  => $data['user_name'],
				'email'  => $data['email'],
				'role'  => $data['role'],
				'read' => $this->model_permision->is_read($data['user_id']),
				'create' => $this->model_permision->is_create($data['user_id']),
				'update' => $this->model_permision->is_update($data['user_id']),
				'delete' => $this->model_permision->is_delete($data['user_id']),
			];
			$cookie = $this->_rundom_string($data['user_id']);
			$this->_cookie_session($data_session, $cookie);
			$respon = $this->model_login->save_coocie($data['user_id'], ['token_login' => $cookie]);
			header("location: http://localhost:8080");
		}
	}

	private function _rundom_string($n)
	{
		$strings = 'q6w7ert4yu8iop3asd2fgh0jk5lzx9cvb1nm';
		$result = '';
		for ($i = 0; $i < $n; $i++) {
			for ($j = 0; $j < 64; $j++) {
				$create = rand(0, strlen($strings) - 1);
				$result .= $strings[$create];
			}
		}
		return $result;
	}

	private function _cookie_session($data_session, $data_cookie)
	{
		$this->load->helper('cookie');
		set_cookie('cookie_id', $data_cookie, '604800');
		return $this->session->set_userdata($data_session);
	}

	public function logout()
	{
		$this->load->helper('cookie');
		delete_cookie('cookie_id');
		$this->session->sess_destroy();
		header('location:http://localhost:8080');
	}
}
