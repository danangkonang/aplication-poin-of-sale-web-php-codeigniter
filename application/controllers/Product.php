<?php defined('BASEPATH') or exit('No direct script access allowed');
include_once FCPATH . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(FCPATH);
$dotenv->load();

class Product extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_product');
		$this->load->model('model_product_unit');
		$this->load->model('model_product_kind');
		$this->load->model('model_permision');
		if (!$this->session->userdata('user_id')) {
			header('location:' . $_ENV['APP_HOST'] . ':' . $_ENV['APP_PORT']);
		}
	}

	public function data_barang()
	{
		$data_session = [
			'title' => 'Produk',
			'active_class' => 'product',
		];
		$this->session->set_userdata($data_session);
		$this->model_permision->set_my_permision(
			$this->session->userdata('user_id'),
		);
		$data['units'] = $this->model_product_unit->find_units();
		$data['kinds'] = $this->model_product_kind->find_kinds();
		$this->load->view('product/product_view', $data);
	}

	public function find_all_product()
	{
		$list = $this->model_product->find_all_product();
		$data = [];
		$no = $_POST['start'];
		$n = 0;
		foreach ($list as $barang) {
			$n++;
			$row = [];
			$row[] = $n;
			$row[] = $barang->barcode;
			$row[] = $barang->kind_name;
			$row[] = $barang->product_name;
			$row[] = number_format($barang->purchase_price, 0, ".", ".");
			$row[] = number_format($barang->selling_price, 0, ".", ".");
			$row[] = number_format($barang->selling_price - $barang->purchase_price, 0, ".", ".");
			$row[] = $barang->product_qty;
			$btn_edit = $this->session->userdata('update') ? '<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit_barang(' . "'" . $barang->product_id . "'" . ')"><i class="far fa-edit"></i></a>' : '';
			$btn_delete = $this->session->userdata('delete') ? '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_barang(' . "'" . $barang->product_id . "'" . ')"><i class="far fa-trash-alt"></i></a>' : '';
			$row[] = $btn_edit . ' ' . $btn_delete;

			$data[] = $row;
		}
		$output = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->model_product->count_all(),
			"recordsFiltered" => $this->model_product->count_filtered(),
			"data" => $data,
		];
		echo json_encode($output);
	}

	function save_product()
	{
		$data = [
			'barcode' => $this->input->post('barcode'),
			'kind_id' => $this->input->post('jenis'),
			'product_name' => $this->input->post('product_name'),
			'unit' => $this->input->post('unit'),
			'purchase_price' => $this->input->post('purchase_price'),
			'selling_price' => $this->input->post('selling_price'),
			'product_qty' => $this->input->post('product_qty'),
			'product_image' => $this->input->post('product_image'),
			// 'is_promo' => $this->input->post('is_promo'),
			'is_promo' =>false,
			// 'start_promo' => $this->input->post('start_promo'),
			// 'end_promo' => $this->input->post('end_promo'),
			// 'promo_type' => $this->input->post('promo_type'),
			'piece' => $this->input->post('piece'),
			// 'end_price' => $this->input->post('end_price'),
			'is_active' => $this->input->post('is_active'),

		];

		$respon = $this->model_product->is_duplicate_barcode($this->input->post('barcode'));
		if ($respon != NULL ){
			echo json_encode(
				array(
					"status" => 400,
					"message" => "Barcode sudah tersedia, tidak bisa duplikat !",
				)
			);
			return;
		}
		
		$res = $this->model_product->save_product($data);
		if (!$res) {
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

	public function update_barang()
	{
		$data = [
			'barcode' => $this->input->post('barcode'),
			'kind_id' => $this->input->post('jenis'),
			'product_name' => $this->input->post('product_name'),
			'unit' => $this->input->post('unit'),
			'purchase_price' => $this->input->post('purchase_price'),
			'selling_price' => $this->input->post('selling_price'),
			'product_qty' => $this->input->post('product_qty'),
			'product_image' => $this->input->post('product_image'),
			'is_promo' => $this->input->post('is_promo'),
			'start_promo' => $this->input->post('start_promo'),
			'end_promo' => $this->input->post('end_promo'),
			'promo_type' => $this->input->post('promo_type'),
			'piece' => $this->input->post('piece'),
			'end_price' => $this->input->post('end_price'),
			'is_active' => $this->input->post('is_active'),
		];
		$this->model_product->update(array('product_id' => $this->input->post('product_id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function hapus_barang($id)
	{
		$this->model_product->delete_by_id($id);
		echo json_encode(["status" => TRUE]);
	}

	public function edit_barang($id)
	{
		$data = $this->model_product->get_by_id($id);
		echo json_encode($data);
	}

	public function find_by_barcode($barcode)
	{
		$data = $this->model_product->find_by_barcode($barcode);
		echo json_encode($data);
	}
}
