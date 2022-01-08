<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('user_id')){
			header('location:http://localhost:8080');
		}
	}

  public function view_report_chart(){
		$data_session = [
			'title' => 'Laporan Chart',
			'active_class' => 'laporan-chart',
		];
		$this->session->set_userdata($data_session);
		$this->load->view('report/chart_report_view');
	}

  public function view_report_table(){
		$data_session = [
			'title' => 'Laporan table',
			'active_class' => 'laporan-table',
		];
		$this->session->set_userdata($data_session);
		$this->load->view('report/table_report_view');
	}

  public function find_all_report_transaction(){
		$min = date('Y-m-').'01';
		$max = date('Y-m-').'31';
		$this->db->select('created_at');
		$this->db->where('created_at >=', $min);
		$this->db->where('created_at <=', $max);
		$this->db->select_sum('price');
		$this->db->group_by('created_at');
		$query = $this->db->get('transactions');
		$data=[];
		foreach($query->result() as $row){
			$data[]=$row;
		}
		echo json_encode($data);
	}

  public function get_data_laba(){
		$this->load->model('model_report');
		$list = $this->model_report->get_data_laba();
		$data = [];
		$no = $_POST['start'];
		$n=0;
		foreach ($list as $barang) {
			$n++;
			$row = [];
			$row[] = $n;
			$row[] = $barang->product_name;
			$row[] = $barang->product_qty;
			$row[] = number_format($barang->selling_price);
			$row[] = number_format($barang->purchase_price);
			$row[] = number_format($barang->selling_price - ($barang->product_qty * $barang->purchase_price));
			$data[] = $row;
		}

		$output = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->model_report->count_all(),
			"recordsFiltered" => $this->model_report->count_filtered(),
			"data" => $data,
		];
		echo json_encode($output);
	}
}