<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('model_login');
		if($this->session->userdata('id')){
			header("location: http://localhost:9000");
		}
	}

  public function loginv2(){
    if($_SERVER['REQUEST_METHOD'] != "POST"){
      echo json_encode(
        array(
          "status" => 400,
          "message" => "method not allowed",
        )
      );
      return;
    }

    $email = $this->input->post('email');
    $password = $this->input->post('password');

    if($email == NULL) {
      echo json_encode(
        array(
          "status" => 400,
          "message" => "email required",
        )
      );
      return;
    }

    if($password == NULL) {
      echo json_encode(
        array(
          "status" => 400,
          "message" => "password required",
        )
      );
      return;
    }

    $data = $this->model_login->cek_email_member($email);

    if($data == NULL) {
      echo json_encode(
        array(
          "status" => 400,
          "message" => "email not register",
        )
      );
      return;
    }
    
    if(!$data['is_active']){
      echo json_encode(
        array(
          "status" => 400,
          "message" => "yaur account not active",
        )
      );
      return;
    }

    if(!password_verify($password, $data['password'])){
      echo json_encode(
        array(
          "status" => 400,
          "message" => "wrong password",
        )
      );
      return;
    }

    $data_session = [
      'user_id'  => $data['user_id'],
      'user_name'  => $data['user_name'],
      'email'  => $data['email'],
      'role'  => $data['role']
    ];
    $cookie = $this->_rundom_string($data['user_id']);
    $this->_cookie_session($data_session, $cookie);
    $respon = $this->model_login->save_coocie($data['user_id'], ['token_login' => $cookie]);
    echo json_encode(
      array(
        "status" => 200,
        "message" => "success login",
        "data" => $data_session,
      )
    );
  }

  private function _rundom_string($n) {
		$strings = 'q6w7ert4yu8iop3asd2fgh0jk5lzx9cvb1nm';
		$result = '';
			for($i = 0; $i < $n; $i++){
				for($j = 0; $j < 64; $j++){
					$create = rand(0, strlen($strings) - 1);
					$result .= $strings[$create];
				}
			}
		return $result;
	}

	public function index(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules(
      'email',
      'Email',
      'required',
		  array(
        'required' => 'email harus di isi'
      )
		);
		$this->form_validation->set_rules(
      'password',
      'password',
      'required',
			array(
        'required' => 'password harus di isi'
      )
		);
		if (!$this->form_validation->run()){
			$this->load->view('auth/form_login');
		}
    else{
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$this->proses_masuk($email, $password);
		}
	}
	
	public function proses_masuk($email, $password) {
		$data = $this->model_login->cek_email_member($email);
    // var_dump($data);
    // die;
		if($data['email'] == '') {
			$this->session->set_flashdata('error_email','Email salah');
			$this->load->view('auth/form_login');
		}
		else {
			if($data['aktif'] == 0) {
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">anda belum konfirmasi email</div>');
				$this->load->view('auth/form_login');
			}
			else {
				if(password_verify($password, $data['password'])) {
					$this->load->model('model_user');
					$this->load->library('user_agent');
					$data_browser =[
						'id_user' => $data["id"],
						'browser' => $this->agent->browser(),
						'browser_version' => $this->agent->version(),
						'os' => $this->agent->platform(),
						'waktu_login' => date("Y-m-m h:i:s"),
						'ip_address' => $this->input->ip_address()
					];
					// $input_browser = $this->model_user->input_browser($data_browser);
					// if($input_browser)
					// {
						$cookie = $this->_acak($data['id']);
						$cookie_id = $data['id'];
						$data_input_cookie = [
							'cookie' => $cookie,
							'id_user_cookie' => $data['id']
						];
						$data_update_cookie = [
							'cookie' => $cookie,
						];
						$data_session = [
							'id'  => $data['id'],
							'username'  => $data['nama'],
							'email'  => $data['email'],
							'level'  => $data['level']
						];
						$this->_input_cookie($data_input_cookie, $data_update_cookie, $data_session, $cookie_id);
						$this->_cookie_session($data_session,$cookie);
						header("location: http://localhost:9000");
					// }
				}
				else {
					$this->session->set_flashdata('error_password','password salah');
					$this->load->view('auth/form_login');
				}
			}
		}
	}
	
	private function _input_cookie($data_input_cookie, $data_update_cookie, $data_session, $cookie_id){
		$cek_cookie = $this->model_user->cek_cookie_db($cookie_id);
		if($cek_cookie) {
			return $this->model_user->update_cookie($data_update_cookie,$cookie_id);
		}
		else {
			// $input_cookie = $this->model_user->input_cookie($data_input_cookie);
			return $this->model_user->input_cookie($data_input_cookie);
		}
	}

	private function _cookie_session($data_session, $data_cookie){
		$this->load->helper('cookie');
		set_cookie('cookie_id', $data_cookie, '604800');
		return $this->session->set_userdata($data_session);
	}

	private function _acak($n) {
		$key = 'q6w7ert4yu8iop3asd2fgh0jk5lzx9cvb1nm';
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
}
