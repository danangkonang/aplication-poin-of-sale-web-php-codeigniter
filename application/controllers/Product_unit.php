<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product_unit extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('model_product_unit');
		if(!$this->session->userdata('user_id')){
			header('location:http://localhost:8080');
		}
	}

  public function index(){
		$data_session = [
			'title' => 'Unit',
			'active_class' => 'product_unit',
		];
		$this->session->set_userdata($data_session);
    $this->load->view('product/product_unit_view');
  }

  public function find_units(){
		$list = $this->model_product_unit->get_unit_datatables();
		$data = [];
		$no = $_POST['start'];
		$n=0;
		foreach ($list as $user) {
			$n++;
			$row = [];
			$row[] = $n;
			$row[] = $user->unit;
			$row[] = '<button class="btn btn-danger btn-sm" roler="button" onClick="edit_unit('."'".$user->unit_id."'".')">Edit</button>';
			$data[] = $row;
		}
		$output = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->model_product_unit->count_all(),
			"recordsFiltered" => $this->model_product_unit->count_filtered(),
			"data" => $data,
		];
		echo json_encode($output);
	}

	public function find_unit_list(){
		$res = $this->model_product_unit->find_unit_list();
		echo json_encode($res);
	}

	public function find_unit($unit_id){
		$res = $this->model_product_unit->find_unit($unit_id);
		echo json_encode($res);
	}

	public function save_unit(){
		$data = [
			'unit' => $this->input->post('unit'),
		];
		$res = $this->model_product_unit->save_unit($data);
		echo json_encode(
			array(
				"status" => $res,
			)
		);
	}

	public function update_unit(){
		$data = [
			'unit' => $this->input->post('unit'),
			'updated_at' => date("Y-m-d h:i:s"),
		];
		$res = $this->model_product_unit->update_unit($this->input->post('unit_id'), $data);
		echo json_encode(
			array(
				"status" => $this->input->post('unit_id'),
			)
		);
	}

}
