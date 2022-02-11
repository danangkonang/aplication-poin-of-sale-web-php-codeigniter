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
		$data['akun'] = $this->model_user->get_profil();
		$this->load->view('profil/profile_view', $data);
	}

	public function edit_profil()
	{
		$data = $this->model_user->get_profil();
		echo json_encode($data);
	}
}
