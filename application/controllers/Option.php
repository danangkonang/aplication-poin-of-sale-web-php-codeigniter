<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Option extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('model_barang');
		if(!$this->session->userdata('id')){
			header('location:http://localhost/penjualan');
		}
	}
	
	public function index(){
		echo 'tes';
	}

	public function contoh(){
		$this->load->view('kasir/contoh'); 
	}

	public function get_barang(){
		$list = $this->model_barang->get_datatables();
		$data = [];
		$no = $_POST['start'];
		$n=0;
		foreach ($list as $barang) {
			$n++;
			$row = [];
			$row[] = $n;
			$row[] = $barang->nama_barang;
			$row[] = number_format($barang->harga_beli,0,".",".");
			$row[] = number_format($barang->harga_jual,0,".",".");
			
			if($barang->jenis_promo == 'diskon'){
				$row[] = '<span class="text-danger">'.number_format($barang->harga_jual - ($barang->harga_jual * $barang->potongan / 100),0,".",".").'</span>';
			}else{
				$row[] = '<span class="text-danger">'.number_format($barang->harga_ahir / $barang->potongan,0,".",".").'</span>';
			}
			
			$row[] = $barang->setok;
			if($barang->potongan == 0){
				$row[] = "";
			}else{
				if($barang->jenis_promo == 'diskon'){
					$row[] = 'dis';
				}else{
					$row[] = 'min';
				}
			}
			
			if($barang->jenis_promo == 'diskon' && $barang->potongan == 0){
				$row[] = "";
			}else if($barang->jenis_promo == 'diskon' && $barang->potongan > 0){
				$row[] = $barang->potongan."%";
			}else{
				$row[] = $barang->potongan;
			}
			
			if($this->session->userdata('level') == 1 ){
				$row[] = '<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit_barang('."'".$barang->id_barang."'".')"><i class="far fa-edit"></i></a>
				  	  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_barang('."'".$barang->id_barang."'".')"><i class="far fa-trash-alt"></i></a>';
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
	
	public function data_barang(){
		$this->load->view('kasir/barang_view');
	}
	
	public function hapus_barang($id){
		$this->model_barang->delete_by_id($id);
		echo json_encode(["status" => TRUE]);
	}
	
	public function edit_barang($id){
		$data = $this->model_barang->get_by_id($id);
		echo json_encode($data);
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
	
	function simpan_barang(){
		$this->_validate();
		$data =[
			'setatus_barang' 	=> $this->input->post('setatus_barang'),
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
		$insert = $this->model_barang->save($data);
		echo json_encode(array("status" => TRUE));
	}
	
	private function _validate(){
        $data = [];
        $data['error_string'] = [];
        $data['inputerror'] = [];
        $data['status'] = TRUE;
 
        if($this->input->post('nama_barang') == ''){
            $data['inputerror'][] = 'nama_barang';
            $data['error_string'][] = 'Nama barang is required';
            $data['status'] = FALSE;
        }
        
        if($this->input->post('harga_beli') == ''){
            $data['inputerror'][] = 'harga_beli';
            $data['error_string'][] = 'Harga beli is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('harga_jual') == ''){
            $data['inputerror'][] = 'harga_jual';
            $data['error_string'][] = 'Harga jual is required';
            $data['status'] = FALSE;
        }
        
        if($this->input->post('setok') == ''){
            $data['inputerror'][] = 'setok';
            $data['error_string'][] = 'Setok is required';
            $data['status'] = FALSE;
        }
        
        if($this->input->post('satuan') == ''){
            $data['inputerror'][] = 'satuan';
            $data['error_string'][] = 'Satuan is required';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }
    
    public function cari_barang(){
		$data = $this->model_barang->cari_barang($_REQUEST['keyword']);
		echo json_encode( $data);
	}
	
	public function add_keranjang(){
		$data = [
			'id' => $this->input->post('id'),
			'name' => $this->input->post('nama'),
			'jenis' => $this->input->post('jenis_promo'),
			'potongan' => $this->input->post('potongan'),
			'harga_potongan' => $this->input->post('harga_potongan'),
			'price' => str_replace('.', '', $this->input->post('harga')),
			'qty' => $this->input->post('qty')
		];
		$insert = $this->cart->insert($data);
		echo json_encode(["status" => TRUE]);
	}
	
	public function list_transaksi(){
		$data = [];
		$no = 1; 
        foreach ($this->cart->contents() as $items){
			$row = [];
			$row[] = $no;
			$row[] = $items["name"];
			if($items["jenis"] == "minimal"){
				$row[] = "min";
			}else{
				$row[] = "dis";
			}
			//$row[] = $items["jenis"];
			$row[] = $items["potongan"];
			$row[] = $items["harga_potongan"];
			$row[] = 'Rp. ' . number_format( $items['price'], 0 , '' , '.' ) . ',-';
			$row[] = $items["qty"];
			//$row[] = 'Rp. ' . number_format( $items['subtotal'], 0 , '' , '.' ) . ',-';
			//$row[] = 'Rp. ' . number_format( $items['qty'] * $items['price'], 0 , '' , '.' ) . ',-';
			if($items["jenis"] == 'minimal'){
				$induk = floor($items["qty"] / $items["potongan"]);
				$sisa = $items["qty"] % $items["potongan"];
				$sub = ($induk * $items["harga_potongan"]) + ($items['price'] * $sisa);
				$row[] = 'Rp. ' . number_format( $sub, 0 , '' , '.' ) . ',-';
			}else{
				$diskon = $items['qty'] * ($items['price'] - ($items['price'] * $items['potongan']/100));
				$row[] = 'Rp. ' . number_format( $diskon, 0 , '' , '.' ) . ',-';
			}
			//add html for action
			$row[] = '<a 
				href="javascript:void()" style="color:rgb(255,128,128);
				text-decoration:none" onclick="deletebarang('
					."'".$items["rowid"]."'".','."'".$items['subtotal'].
					"'".')"> <i class="fas fa-times"></i></a>';
			$data[] = $row;
			$no++;
        }
		$output = [
			"data" => $data,
		];
		//$this->auto_update();
		echo json_encode($output);
	}
	
	public function auto_update(){
		$tgl = date('Y-m-d');
		$data=['sstatus_promo'=> 0];
		$this->db->where('ahir_promo <',$tgl);
	    $this->db->update('barang', $data );
	    return true;
	}
	
	public function cetak_nota(){
		$this->load->model('model_toko');
		$bayar = $this->input->post('bayar');
		$kembali = $this->input->post('kembali');
		$toko = $this->model_toko->get_data_toko();
		$no=1;
		$output = '';
		$output = '<p class="text-dark">'.$toko->nama_toko.'<br>
				                    	'.$toko->alamat_toko.'<br>
				                    tlp '.$toko->telephon_toko.'<br>
		no &nbsp; &nbsp; &nbsp; : '.$this->session->userdata('id').'<br>
                    	kasir &nbsp; : '.$this->session->userdata('nama').'<br>
		tgl &nbsp; &nbsp; &nbsp; : '.date('Y-m-d  h:i:s').'<br>
					</p>
					<table>
					<thead>
						<tr style="border-top:1px dashed">
							<th width="50">No</th>
							<th width="100">Nama</th>
							<th width="50">qty</th>
							<th>harga</th>
						</tr>
					</thead>
					<tbody>';
					foreach($this->cart->contents() as $row){
		$output .= 		'<tr>
							<td>'.$no++.'</td>
							<td>'.$row["name"].'</td>
							<td>'.$row["qty"].'</td>
							<td>Rp.'.$row["price"] .'</td>
						</tr>';
						}
		$output .= 		'<tr style="border-top:1px dashed">
							<td colspan="3" style="text-align:right">Total :</td>
							<td>Rp.'.number_format($this->cart->total(),0,',','.').'</td>
						</tr>
						<tr>
							<td colspan="3" style="text-align:right">Bayar :</td>
							<td>Rp.'.number_format($bayar,0,',','.').'</td>
						</tr>
						<tr style="border-bottom:1px dashed">
							<td colspan="3" style="text-align:right">Kembali :</td>
							<td>Rp.'.$kembali.'</td>
						</tr>
					</tbody>
					</table>
            <div style="text-align:center">terimakasih atas kunjungan anda</div>';
        echo $output;
	}
	
	public function shoping(){
		if($this->cart->contents() !==[]){
			foreach ($this->cart->contents() as $insert){
				$id 		= $insert['id'];
				$q 			= $insert['qty'];
				$rowid 		= $insert['rowid'];
				$tgl 		= date('Y-m-d');
				$datestring = '%H:%i';
				$time 		= time();
				$waktu 		= mdate($datestring, $time);
				
				$data = [
					'kode_brg' => $insert['id'],
					'jumlah' => $insert['qty'],
					'nama_brg' => $insert['name'],
					'harga_brg' => $insert['price'],
					'total_harga' => $insert['subtotal'],
					'tgl_transaksi' => $tgl,
					'waktu' => $waktu
				];
			}
			$insert =  $this->model_barang->insert_penjualan($data);
			if($insert){
				$hasil = $this->model_barang->get_setok($id);
				$sisa =  $hasil->setok;
				$qty = $sisa-$q;
				$aksi = $this->model_barang->update_setok($id,$qty);
				$this->cart->destroy();
				echo json_encode(["status" => TRUE]);
			}else{
				echo json_encode(["status" => FALSE]);
			}
		}else{
			echo('404');
		}
	}
	
	public function deletebarang($rowid){
		$this->cart->update([
				'rowid'=>$rowid,
				'qty'=>0,]);
		echo json_encode(["status" => TRUE]);
	}
	
	public function data_penjualan(){
		$this->load->view('kasir/penjualan_view');
	}
	
	public function get_penjualan(){
		$this->load->model('model_penjualan');
		$list = $this->model_penjualan->get_datatables();
		$data = [];
		$no = $_POST['start'];
		$n=0;
		foreach ($list as $barang) {
			$n++;
			$row = [];
			$row[] = $n;
			$row[] = $barang->nama_brg;
			$row[] = $barang->jumlah;
			$row[] = $barang->kasir;
			$row[] = $barang->total_harga;
			$row[] = $barang->tgl_transaksi.' '.$barang->waktu;
			$data[] = $row;
		}

		$output = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->model_penjualan->count_all(),
			"recordsFiltered" => $this->model_penjualan->count_filtered(),
			"data" => $data,
		];
		echo json_encode($output);
	}
	
	public function data_toko(){
		$this->load->view('profil/toko_view');
	}
	
	public function get_data_toko(){
		$this->load->model('model_toko');
		$data = $this->model_toko->get_data_toko();
		echo json_encode($data);
	}
	
	public function simpan_data_toko(){
		$this->load->model('model_toko');
		$data = [
			'nama_toko' => $this->input->post('nama_toko'),
			'alamat_toko' => $this->input->post('alamat_toko'),
			'telephon_toko' => $this->input->post('telephon_toko'),
			'moto_toko' => $this->input->post('moto_toko')
		];
		$data2 = $this->model_toko->get_data_toko();
		$id = $data2->id_toko;
		if($data2 == null){
			$insert = $this->model_toko->simpan_data_toko($data);
		}else{
			$insert = $this->model_toko->update_data_toko($data,$id);
		}
		
		echo json_encode($data);
	}
	
	public function edit_data_toko(){
		$this->load->model('model_toko');
		$data = $this->model_toko->get_data_toko();
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
	
	public function update_data_toko(){
		
	}
	
	public function laba(){
		$this->load->view('kasir/laba_view');
	}
	
	public function get_data_laba(){
		$this->load->model('model_laba');
		$list = $this->model_laba->get_data_laba();
		$data = [];
		$no = $_POST['start'];
		$n=0;
		foreach ($list as $barang) {
			$n++;
			$row = [];
			$row[] = $n;
			$row[] = $barang->nama_barang;
			$row[] = $barang->jumlah;
			$row[] = number_format($barang->total_harga);
			$row[] = number_format($barang->harga_beli);
			$row[] = number_format($barang->total_harga - ($barang->jumlah * $barang->harga_beli));
			$data[] = $row;
		}

		$output = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->model_laba->count_all(),
			"recordsFiltered" => $this->model_laba->count_filtered(),
			"data" => $data,
		];
		echo json_encode($output);
	}
	
	public function diagram(){
		$min = date('Y-m-').'01';
		$max = date('Y-m-').'31';
		$this->db->select('tgl_transaksi');
		$this->db->where('tgl_transaksi >=', $min);
		$this->db->where('tgl_transaksi <=', $max);
		$this->db->select_sum('total_harga');
		$this->db->group_by('tgl_transaksi');
		$query=    $this->db->get('penjualan');
		$data=[];
		foreach($query->result() as $row)
		{
			$data[]=$row;
		}
		print json_encode($data);
	}

	public function laba_tabel(){
		$this->load->view('kasir/tabel_view');
	}

	public function laba_diagram(){
		$this->load->view('kasir/diagram_view');
	}

	public function cari_diagram(){
		$bulan = $this->input->post('bulan')+1;
		$tahun = $this->input->post('tahun');
		$tw = 01;
		$th = 31;
		$min = $tahun.'-'.$bulan.'-'.$tw;
		$max = $tahun.'-'.$bulan.'-'.$th;
		$this->db->select('tgl_transaksi');
		$this->db->where('tgl_transaksi >=', $min);
		$this->db->where('tgl_transaksi <=', $max);
		$this->db->select_sum('total_harga');
		$this->db->group_by('tgl_transaksi');
		$query=    $this->db->get('penjualan');
		$data=[];
		foreach($query->result() as $row)
		{
			$data[]=$row;
		}
		print json_encode($data);
	}

	public function logout(){
		$this->load->helper('cookie');
		delete_cookie('id');
		$this->session->sess_destroy();
		header('location:http://localhost/penjualan');
	}

	public function pengunjung(){
		$this->load->view('admin/pengunjung_view');
	}

	public function akun(){
		$this->load->model('model_member');
		$data['judul'] = 'profil';
		$data['akun'] = $this->model_member->get_profil();
		$this->load->view('profil/profil_view',$data);
	}

	public function edit_profil()
	{
		$this->load->model('model_member');
		$data = $this->model_member->get_profil();
		echo json_encode($data);
	}

	public function data_user(){
		$this->load->view('kasir/data_user_view');
	}

	public function get_data_user(){
		$this->load->model('model_member');
		$list = $this->model_member->get_datatables();
		$data = [];
		$no = $_POST['start'];
		$n=0;
		foreach ($list as $user) {
			$n++;
			$row = [];
			$row[] = $n;
			$row[] = $user->nama;
			$row[] = $user->email;
			$row[] = $user->jenis_kelamin;
			$row[] = $user->telephone;
			if($user->aktif == 1){
				$row[] = "aktif";
			}else {
				$row[] = "blokir";
			}
			$row[] = '<button class="btn btn-danger" roler="button" onClick="edit_user('."'".$user->id."'".')">edit</button>';
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