<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot extends CI_Controller {

  public function __construct() {
		parent::__construct();
		$this->load->model('model_user');
		$this->load->library('form_validation');
  }
    
  public function index() {
    $this->form_validation->set_rules('email', 'Email', 'required',
		  array('required' => 'email harus di isi')
		);
		
    if ($this->form_validation->run() == FALSE) {
      $this->load->view('auth/form_reset_password');
    }
    else {
      $email = $this->input->post('email');
      $this->forgot_password($email);
    }
  }

  public function forgot_password($email) {
		$cek = $this->model_forgot->cek_data_email($email);
		if($cek){
			$this->make_token($email);
	  }
    else {
      $this->session->set_flashdata('error_email','email belum terdaftar');
      redirect('forgot');
		}
	}
	
}