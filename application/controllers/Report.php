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

  public function find_report_chart(){
		$min = date('Y-m-').'01';
		$max = date('Y-m-').'31';
		$this->db->select('DATE(created_at) AS daily');
		$this->db->where('created_at >=', $min);
		$this->db->where('created_at <=', $max);
		$this->db->select_sum('price');
		$this->db->group_by('daily');
		$query = $this->db->get('transactions');
		$data=[];
		foreach($query->result() as $row){
			$data[]=$row;
		}
		echo json_encode($data);
	}

	public function cari_diagram(){
    $bulan = $this->input->post('bulan') + 1;
    $tahun = $this->input->post('tahun');
    $tw = 01;
    $th = 31;
    $min = $tahun . '-' . $bulan . '-' . $tw;
    $max = $tahun . '-' . $bulan . '-' . $th;

    $this->db->select('DATE(created_at) AS daily');
		$this->db->where('created_at >=', $min);
		$this->db->where('created_at <=', $max);
		$this->db->select_sum('price');
		$this->db->group_by('daily');
		$query = $this->db->get('transactions');

    $data = [];
    foreach ($query->result() as $row) {
      $data[] = $row;
    }
    print json_encode($data);
  }

  public function find_report_table(){
		$this->load->model('model_transaction');
		$list = $this->model_transaction->get_datatables();
		$data = [];
		$no = $_POST['start'];
		$n=0;
		foreach ($list as $barang) {
			$n++;
			$row = [];
			$row[] = $n;
			$row[] = $barang->newname;
			$row[] = $barang->qty;
			$row[] = number_format($barang->purchase_price);
			$row[] = number_format($barang->price);
			$row[] = number_format(($barang->qty * $barang->price) - $barang->purchase_price);
			$data[] = $row;
		}

		$output = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->model_transaction->count_all(),
			"recordsFiltered" => $this->model_transaction->count_filtered(),
			"data" => $data,
		];
		echo json_encode($output);
	}

		public function trend()
		{
			$this->load->model('model_report');
			$data = $this->model_report->trend();
			echo json_encode($data);
		}	

		
}