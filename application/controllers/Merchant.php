<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Merchant extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('model_merchant');
		if(!$this->session->userdata('user_id')){
			header('location:http://localhost:8080');
		}
	}

  // fix
	public function my_merchant(){
		$data_session = [
			'title' => 'TOko',
			'active_class' => 'merchant',
		];
		$this->session->set_userdata($data_session);
		$this->load->view('merchant/merchant_view');
	}
	
  // fix
	public function find_merchant(){
		$data = $this->model_merchant->find_merchant();
		echo json_encode($data);
	}

  public function simpan_data_toko(){
		$this->load->model('model_merchant');
		$data = [
			'nama_toko' => $this->input->post('nama_toko'),
			'alamat_toko' => $this->input->post('alamat_toko'),
			'telephon_toko' => $this->input->post('telephon_toko'),
			'moto_toko' => $this->input->post('moto_toko')
		];
		$data2 = $this->model_merchant->get_data_toko();
		$id = $data2->id_toko;
		if($data2 == null){
			$insert = $this->model_merchant->simpan_data_toko($data);
		}else{
			$insert = $this->model_merchant->update_data_toko($data,$id);
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
