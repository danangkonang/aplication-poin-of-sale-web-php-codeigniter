<?php

defined('BASEPATH') || exit('No direct script access allowed');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, '../../.env');
$dotenv->load();

class Profile extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_user');
		if (! $this->session->userdata('user_id')) {
			header('location:' . $_ENV['APP_HOST']);
		}
	}

	public function me()
	{
		$data_session = [
			'title'        => 'Profil',
			'active_class' => '',
		];
		$this->session->set_userdata($data_session);
		// $data['akun'] = $this->model_user->get_profil();
		// $this->load->view('profil/profile_view', $data);
		$this->load->view('profil/profile_view');
	}

	public function my_profile()
	{
		$user_id = $this->session->userdata('user_id');
		$res = $this->model_user->get_profil($user_id);
		echo json_encode($res);
	}

	// public function edit_profil()
	// {
	// 	$user_id = $this->session->userdata('user_id');
	// 	$res = $this->model_user->get_profil($user_id);
	// 	echo json_encode($res);
	// }

	public function update_profil()
	{
		$data = [
			'user_name'	=> $this->input->post('user_name'),
			'email'			=> $this->input->post('email'),
			'telephone'	=> $this->input->post('telephone'),
			'gender'		=> $this->input->post('gender'),
		];
		$res = $this->model_user->update_profil($data, $this->session->userdata('user_id'));
		echo json_encode($res);
	}
}
