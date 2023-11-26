<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Reset extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_user');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->form_validation->set_rules(
			'email',
			'Email',
			'required',
			['required' => 'email harus di isi']
		);
		if ($this->form_validation->run() === false) {
			$this->load->view('auth/form_reset_password');
		} else {
			$email = $this->input->post('email');
			$this->forgot_password($email);
		}
	}

	public function forgot_password($email)
	{
		$cek = $this->model_user->cek_data_email($email);
		if ($cek) {
			$this->generate_token($email);
		} else {
			$this->session->set_flashdata('error_email', 'email belum terdaftar');
			redirect('reset');
		}
	}

	public function generate_token($email)
	{
		$token = urlencode(base64_encode(random_bytes(32)));
		$data_token = [
			'email' => $email,
			'token' => $token,
			'expired' => time(),
		];
		$this->simpan_token($email, $data_token, $token);
		if ($_ENV['EMAIL_VERIFICATION'] === "TRUE") {
			$this->send_email($email, $token);
			$this->session->set_flashdata('forgot', '<p class="text-center text-success">silahkan cek email ' . $email . '</p>');
			redirect('reset');
		} else {
			$URL = $_ENV['APP_HOST'].'reset/reset_password?email='. $email .'&token='. $token;
			header('location:'. $URL);
		}
	}

	public function send_email($email, $token)
	{
		$config = [
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => $_ENV['SMTP_USER'],
			'smtp_pass' => $_ENV['SMTP_PASS'],
			'smtp_port' => 465,
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'newline'   => "\r\n",
		];
		$this->load->library('email');
		$this->email->initialize($config);
		$this->email->from('security@kasir.com', 'Kasir Security');
		$this->email->to($email);
		$this->email->subject('Reset Password');
		$this->email->message('kami diminta untu mereset password anda<br>jika benar silahkan klik link ini <a href=" ' . site_url() . 'reset/reset_password?email=' . $email . '&token=' . $token . ' "> ' . site_url() . 'reset/reset_password?email=' . $email . '&token=' . $token . ' </a> <p> jika anda tidak merasa meminta reset password silahkan abaikan email ini</p>');
		if ($this->email->send()) {
			return true;
		}
		echo $this->email->print_debugger();
		exit;
	}

	public function simpan_token($email, $data_token, $token)
	{
		$cek_token = $this->model_user->cek_data_token($email, $token);
		if ($cek_token) {
			return $this->model_user->update_token($email, $data_token);
		}
		return $this->model_user->simpan_token($data_token);
	}

	public function reset_password()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');
		$data  = $this->model_user->cek_data_token($email, $token);
		if ($data) {
			if (time() - $data['expired'] < (60 * 60 * 24)) {
				$this->session->set_userdata('reset', $data['email']);
				redirect('reset/validasi_reset');
			} else {
				$this->session->set_flashdata('forgot', 'token ekspaired');
				redirect('reset');
			}
		} else {
			$this->session->set_flashdata('forgot', 'token invailid');
			redirect('reset');
		}
	}

	public function validasi_reset()
	{
		if (! $this->session->userdata('reset')) {
			redirect('login');
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules(
			'password1',
			'Password',
			'required',
			['required' => 'tidak boleh kosong']
		);
		$this->form_validation->set_rules(
			'password2',
			'Password Confirmation',
			'required',
			['required' => 'tidak boleh kosong']
		);
		if ($this->form_validation->run() === false) {
			$this->load->view('auth/form_new_password');
		} else {
			$password = $this->input->post('password1');
			$this->new_password($password);
			$this->session->sess_destroy();
			redirect('login');
		}
	}

	public function new_password($password)
	{
		$email = $this->session->userdata('reset');
		$data  = [
			'password' => password_hash($password, PASSWORD_BCRYPT),
		];
		return $this->model_user->save_new_password($email, $data);
	}
}
