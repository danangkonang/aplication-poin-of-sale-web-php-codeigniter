<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('model_member');
		if(!$this->session->userdata('user_id')){
			header('location:http://localhost:8080');
		}
	}

  public function me(){
		$data['judul'] = 'profil';
		$data['akun'] = $this->model_member->get_profil();
		$this->load->view('profil/profile_view',$data);
	}

	public function edit_profil(){
		$data = $this->model_member->get_profil();
		echo json_encode($data);
	}
}
