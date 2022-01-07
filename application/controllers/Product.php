<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('model_barang');
		if(!$this->session->userdata('user_id')){
			header('location:http://localhost:8080');
		}
	}

  // fix
	public function data_barang(){
		$this->load->view('product/product_view');
		// $this->load->view('product/product_with_bacode_view');
	}

  // fix
	public function find_all_product(){
		$list = $this->model_barang->find_all_product();
    // var_dump($list);
    // die;
		$data = [];
		$no = $_POST['start'];
		$n=0;
		foreach ($list as $barang) {
			$n++;
			$row = [];
			$row[] = $n;
      $row[] = $barang->barcode;
			$row[] = $barang->kind_name;
			$row[] = $barang->product_name;
			$row[] = number_format($barang->purchase_price,0,".",".");
			$row[] = number_format($barang->selling_price,0,".",".");
      $row[] = number_format($barang->selling_price - $barang->purchase_price,0,".",".");
			$row[] = $barang->product_qty;
			if($this->session->userdata('role') == 'admin' ){
				$row[] = '<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit_barang('."'".$barang->product_id."'".')"><i class="far fa-edit"></i></a>
				  	  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_barang('."'".$barang->product_id."'".')"><i class="far fa-trash-alt"></i></a>';
			}else{
				$row[] = '<a class="btn btn-sm btn-warning disabled" href="javascript:void(0)" title="Edit" ><i class="far fa-edit"></i></a>
				  	  <a class="btn btn-sm btn-danger disabled" href="javascript:void(0)" title="Hapus" ><i class="far fa-trash-alt"></i></a>';
			}
			$data[] = $row;
		}
		$output = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->model_barang->count_all(),
			"recordsFiltered" => $this->model_barang->count_filtered(),
			"data" => $data,
		];
		echo json_encode($output);
	}

  // fix
	function save_product(){
		// $this->_validate();
    $data = [
			'barcode' => $this->input->post('barcode'),
			'kind_id' => $this->input->post('jenis'),
      'product_name' => $this->input->post('product_name'),
      'purchase_price' => $this->input->post('purchase_price'),
      'selling_price' => $this->input->post('selling_price'),
      'product_qty' => $this->input->post('product_qty'),
      'is_promo' => false,
      'product_image' => 'telur.png',
      'is_active' => true,
    ];
		$res = $this->model_barang->save_product($data);
    if(!$res){
      echo json_encode(
        array(
          "status" => 400,
          "message" => "internal server error",
        )
      );
      return;
    }
    echo json_encode(
      array(
        "status" => 200,
        "message" => "success login",
        "data" => $data,
      )
    );
	}
	
  public function update_barang(){
		$data =[
			'setatus_barang'	=> $this->input->post('setatus_barang'),
			'nama_barang' 		=> $this->input->post('nama_barang'),
			'harga_beli' 		=> $this->input->post('harga_beli'),
			'harga_jual' 		=> $this->input->post('harga_jual'),
			'laba' 				=> $this->input->post('harga_jual')-$this->input->post('harga_beli'),
			'satuan' 			=> $this->input->post('satuan'),
			'setok' 			=> $this->input->post('setok'),
			'mulai_promo' 		=> $this->input->post('mulai_promo'),
			'ahir_promo' 		=> $this->input->post('ahir_promo'),
			'jenis_promo' 		=> $this->input->post('jenis_promo'),
			'potongan' 			=> $this->input->post('potongan'),
			'harga_ahir' 		=> $this->input->post('harga_ahir'),
			'setatus_promo' 	=> $this->input->post('setatus_promo'),
		];
		$this->model_barang->update(array('id_barang' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

  public function hapus_barang($id){
		$this->model_barang->delete_by_id($id);
		echo json_encode(["status" => TRUE]);
	}
	
	public function edit_barang($id){
		$data = $this->model_barang->get_by_id($id);
		echo json_encode($data);
	}
	
}
