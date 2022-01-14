<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product_kind extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('model_product_kind');
		if(!$this->session->userdata('user_id')){
			header('location:http://localhost:8080');
		}
	}

  public function index(){
		$data_session = [
			'title' => 'Kind',
			'active_class' => 'product_kind',
		];
		$this->session->set_userdata($data_session);
    $this->load->view('product/product_kind_view');
  }

  public function find_kinds(){
		$list = $this->model_product_kind->get_kind_datatables();
		$data = [];
		$no = $_POST['start'];
		$n=0;
		foreach ($list as $user) {
			$n++;
			$row = [];
			$row[] = $n;
			$row[] = $user->kind_name;
			$row[] = '<button class="btn btn-danger btn-sm" roler="button" onClick="edit_kind('."'".$user->kind_id."'".')">Edit</button>';
			$data[] = $row;
		}
		$output = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->model_product_kind->count_all(),
			"recordsFiltered" => $this->model_product_kind->count_filtered(),
			"data" => $data,
		];
		echo json_encode($output);
	}

	public function find_kind($kind_id){
		$res = $this->model_product_kind->find_kind($kind_id);
		echo json_encode($res);
	}

	public function save_kind(){
		$data = [
			'kind_name' => $this->input->post('kind_name'),
		];
		$res = $this->model_product_kind->save_kind($data);
		echo json_encode(
			array(
				"status" => $res,
			)
		);
	}

	public function update_kind(){
		$data = [
			'kind_name' => $this->input->post('kind_name'),
			'updated_at' => date("Y-m-d h:i:s"),
		];
		$res = $this->model_product_kind->update_kind($this->input->post('kind_id'), $data);
		echo json_encode(
			array(
				"status" => $this->input->post('kind_id'),
			)
		);
	}

}
