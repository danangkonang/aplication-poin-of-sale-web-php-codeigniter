<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Permision extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('model_permision');
		if(!$this->session->userdata('user_id')){
			header('location:http://localhost:8080');
		}
	}

	public function index(){
		$data_session = [
			'title' => 'Permision',
			'active_class' => 'permision',
		];
		$this->session->set_userdata($data_session);
		$this->load->view('admin/permision_view');
	}

	public function find_permision(){
		$list = $this->model_permision->find_permision();
		$data = [];
		$no = $_POST['start'];
		$n=0;
		foreach ($list as $user) {
			$n++;
			$row = [];
			$row[] = $n;
			$row[] = $user->user_name;
			$row[] = $user->read ? '<span class="badge badge-pill badge-primary text-primary">.</span>' : '<span class="badge badge-pill badge-secondary text-secondary">.</span>';
			$row[] = $user->create ? '<span class="badge badge-pill badge-primary text-primary">.</span>' : '<span class="badge badge-pill badge-secondary text-secondary">.</span>';
			$row[] = $user->update ? '<span class="badge badge-pill badge-primary text-primary">.</span>' : '<span class="badge badge-pill badge-secondary text-secondary">.</span>';
			$row[] = $user->delete ? '<span class="badge badge-pill badge-primary text-primary">.</span>' : '<span class="badge badge-pill badge-secondary text-secondary">.</span>';
			$row[] = '<button class="btn btn-danger btn-sm" roler="button" onClick="edit_permision('."'".$user->user_id."'".', '."'".$user->user_name."'".')">Edit</button>';
			$data[] = $row;
		}
		$output = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->model_permision->count_all(),
			"recordsFiltered" => $this->model_permision->count_filtered(),
			"data" => $data,
		];
		echo json_encode($output);
	}

	public function permision_by_id($user_id){
		$res = $this->model_permision->permision_by_id($user_id);
		$response = array(
			"status" => 200,
			"data" => $res,
		);
		echo json_encode($response);
	}
	
	public function update_permision(){
		$data = [
			'create' => (int)$this->input->post('create'),
			'update' => (int)$this->input->post('update'),
			'delete' => (int)$this->input->post('delete'),
		];
		$res = $this->model_permision->update_permision((int)$this->input->post('user_id'), $data);
		$response = array(
			"status" => $res,
			"data" => $this->input->post('create'),
		);
		echo json_encode($response);
	}

}
