<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Merchant extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('model_merchant');
		if(!$this->session->userdata('user_id')){
			header('location:http://localhost:8080');
		}
	}

	public function my_merchant(){
		$data_session = [
			'title' => 'Toko',
			'active_class' => 'merchant',
		];
		$this->session->set_userdata($data_session);
		$this->load->view('merchant/merchant_view');
	}
	
	public function find_merchant(){
		$data = $this->model_merchant->find_merchant();
		echo json_encode($data);
	}

  public function simpan_data_merchant(){
		$this->load->model('model_merchant');
		$data = [
			'merchant_name' => $this->input->post('store_name'),
			'merchant_address' => $this->input->post('store_address'),
			'merchant_telephone' => $this->input->post('store_telephone'),
			'merchant_description' => $this->input->post('textarea_store_description')
		];
		$merchant = $this->model_merchant->find_merchant();
		$id = $merchant->merchant_id;
		if($merchant == null){
			$insert = $this->model_merchant->simpan_data_merchant($data);
		}else{
			$insert = $this->model_merchant->update_data_merchant($data, $id);
		}
		echo json_encode($data);
	}
	
	public function edit_data_toko(){
		$this->load->model('model_merchant');
		$data = $this->model_merchant->get_data_toko();
		if($data == null){
			$data2 =[
				'nama_toko' => 'toko',
				'alamat_toko' => 'alamat',
				'telephon_toko' => '123',
				'moto_toko' => 'moto'
			];
			echo json_encode($data2);
		}else{
			echo json_encode($data);
		}
		
	}
}
