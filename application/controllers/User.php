<?php

defined('BASEPATH') || exit('No direct script access allowed');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, '../../.env');
$dotenv->load();

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_user');
		if (! $this->session->userdata('user_id')) {
			header('location:' . $_ENV['APP_HOST']);
		}
	}

	public function data_user()
	{
		$data_session = [
			'title'        => 'User',
			'active_class' => 'user',
		];
		$this->session->set_userdata($data_session);
		$this->load->view('admin/user_data_view');
	}

	public function get_data_user()
	{
		$list = $this->model_user->get_datatables();
		$data = [];
		$no   = $_POST['start'];
		$n    = 0;

		foreach ($list as $user) {
			$n++;
			$row   = [];
			$row[] = $n;
			$row[] = $user->user_name;
			$row[] = $user->email;
			$row[] = $user->gender;
			$row[] = $user->telephone;
			if ($user->is_active) {
				$row[] = 'aktif';
			} else {
				$row[] = 'blokir';
			}
			$row[]  = '<button class="btn btn-danger" roler="button" onClick="edit_user(' . "'" . $user->user_id . "'" . ')">Edit</button>';
			$data[] = $row;
		}
		$output = [
			'draw'            => $_POST['draw'],
			'recordsTotal'    => $this->model_user->count_all(),
			'recordsFiltered' => $this->model_user->count_filtered(),
			'data'            => $data,
		];
		echo json_encode($output);
	}

	public function find_user_by_id($user_id)
	{
		$res = $this->model_user->get_profil($user_id);
		echo json_encode($res);
	}

	public function update_user_by_id()
	{
		$data = [
			'user_name'	=> $this->input->post('user_name'),
			'email'			=> $this->input->post('email'),
			'telephone'	=> $this->input->post('telephone'),
			'gender'		=> $this->input->post('gender'),
			'is_active'		=> $this->input->post('is_active'),
		];
		$res = $this->model_user->update_profil($data, $this->input->post('user_id'));
		echo json_encode($res);
	}
}
