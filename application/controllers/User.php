<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('model_member');
		if(!$this->session->userdata('user_id')){
			header('location:http://localhost:8080');
		}
	}

  public function data_user(){
		$this->load->view('admin/user_data_view');
	}

	public function get_data_user(){
		$list = $this->model_member->get_datatables();
		$data = [];
		$no = $_POST['start'];
		$n=0;
		foreach ($list as $user) {
			$n++;
			$row = [];
			$row[] = $n;
			$row[] = $user->user_name;
			$row[] = $user->email;
			$row[] = $user->gender;
			$row[] = $user->telephone;
			if($user->is_active){
				$row[] = "aktif";
			}else {
				$row[] = "blokir";
			}
			$row[] = '<button class="btn btn-danger" roler="button" onClick="edit_user('."'".$user->user_id."'".')">edit</button>';
			$data[] = $row;
		}
		$output = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->model_member->count_all(),
			"recordsFiltered" => $this->model_member->count_filtered(),
			"data" => $data,
		];
		echo json_encode($output);
	}
}
