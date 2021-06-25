<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Option extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('model_barang');
		if(!$this->session->userdata('user_id')){
			header('location:http://localhost:8080');
		}
	}
	
	// public function index(){
	// 	echo 'tes';
	// }

	// public function contoh(){
	// 	$this->load->view('kasir/contoh'); 
	// }

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
      // $row[] = $barang->product_image;
			$row[] = $barang->product_name;
			$row[] = number_format($barang->purchase_price,0,".",".");
			$row[] = number_format($barang->selling_price,0,".",".");
      $row[] = number_format($barang->selling_price - $barang->purchase_price,0,".",".");
			
			// if($barang->jenis_promo == 'diskon'){
			// 	$row[] = '<span class="text-danger">'.number_format($barang->selling_price - ($barang->selling_price * $barang->potongan / 100),0,".",".").'</span>';
			// }else{
			// 	$row[] = '<span class="text-danger">'.number_format($barang->harga_ahir / $barang->potongan,0,".",".").'</span>';
			// }
			
			$row[] = $barang->product_qty;
			// if($barang->potongan == 0){
			// 	$row[] = "";
			// }else{
			// 	if($barang->jenis_promo == 'diskon'){
			// 		$row[] = 'dis';
			// 	}else{
			// 		$row[] = 'min';
			// 	}
			// }
			
			// if($barang->jenis_promo == 'diskon' && $barang->potongan == 0){
			// 	$row[] = "";
			// }else if($barang->jenis_promo == 'diskon' && $barang->potongan > 0){
			// 	$row[] = $barang->potongan."%";
			// }else{
			// 	$row[] = $barang->potongan;
			// }
			
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
	
  // fix
	function save_product(){
		// $this->_validate();
    $data = [
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
  
  // fix
  public function cari_barang(){
    $data = $this->model_barang->search_product($_REQUEST['keyword']);
    echo json_encode( $data);
	}
	
  // fix
	public function add_keranjang(){
		// $data = [
		// 	'id' => $this->input->post('id'),
		// 	'name' => $this->input->post('nama'),
		// 	'jenis' => $this->input->post('jenis_promo'),
		// 	'potongan' => $this->input->post('potongan'),
		// 	'harga_potongan' => $this->input->post('harga_potongan'),
		// 	'price' => str_replace('.', '', $this->input->post('harga')),
		// 	'qty' => $this->input->post('qty')
		// ];
    $data = [
      'id' => $this->input->post('product_id'),
      'name' => $this->input->post('product_name'),
      // 'purchase_price' => $this->input->post('purchase_price'),
      'price' => str_replace(".", "" , $this->input->post('selling_price')),
      'qty' => $this->input->post('product_qty'),
    ];
		// $res = $this->cart->insert($data);
		echo json_encode(["status" => $this->cart->insert($data)]);
    // if(!$res){
    //   echo json_encode(
    //     array(
    //       "status" => 400,
    //       "message" => "internal server error",
    //       "data" => $res,
    //     )
    //   );
    //   return;  
    // }
    // echo json_encode(
    //   array(
    //     "status" => 200,
    //     "message" => "success login",
    //     "data" => $data,
    //   )
    // );
	}
	
  // fix
	public function list_shoping_cart(){
		$data = [];
		$no = 1; 
    foreach ($this->cart->contents() as $items){
			$row = [];
			$row[] = $no;
			$row[] = $items["name"];

			// if($items["jenis"] == "minimal"){
			// 	$row[] = "min";
			// }
      // else{
			// 	$row[] = "dis";
			// }

			// $row[] = $items["potongan"];
			// $row[] = $items["harga_potongan"];
			$row[] = 'Rp. ' . number_format( $items['price'], 0 , '' , '.' ) . ',-';
			$row[] = $items["qty"];

			// if($items["jenis"] == 'minimal'){
			// 	$induk = floor($items["qty"] / $items["potongan"]);
			// 	$sisa = $items["qty"] % $items["potongan"];
			// 	$sub = ($induk * $items["harga_potongan"]) + ($items['price'] * $sisa);
			// 	$row[] = 'Rp. ' . number_format( $sub, 0 , '' , '.' ) . ',-';
			// }
      // else{
			// 	$diskon = $items['qty'] * ($items['price'] - ($items['price'] * $items['potongan']/100));
			// 	$row[] = 'Rp. ' . number_format( $diskon, 0 , '' , '.' ) . ',-';
			// }
      $row[] = 'Rp. ' . number_format( $items['qty'] * $items['price'], 0 , '' , '.' ) . ',-';
			//add html for action
			$row[] = '<a href="javascript:void(0)"
                style="color: red; text-decoration: none; padding: 5px;"
                onclick="delete_cart('
                    ."'".$items["rowid"]."'".','."'".$items['subtotal'].
                    "'".')"> <i class="fas fa-times"></i></a>';
			$data[] = $row;
			$no++;
    }
		$output = [
			"data" => $data,
		];
		echo json_encode($output);
	}
	
	public function auto_update(){
		$tgl = date('Y-m-d');
		$data=['sstatus_promo'=> 0];
		$this->db->where('ahir_promo <',$tgl);
    $this->db->update('barang', $data );
    return true;
	}
	

	public function save_orders(){
		$this->load->model('model_toko');
		$bayar = $this->input->post('bayar');
		$kembali = $this->input->post('kembali');
		$toko = $this->model_toko->find_store();
    // echo json_encode($toko);
    // <p class="text-dark">'
    //   .$toko->store_name.'<br>'
    //   .$toko->store_address.'<br>tlp '
    //   .$toko->store_phone.'<br>no &nbsp; &nbsp; &nbsp; : '
    //   .$this->session->userdata('user_id').'<br>kasir &nbsp; : '
    //   .$this->session->userdata('user_name').'<br>tgl &nbsp; &nbsp; &nbsp; : '
    // .date('Y-m-d  h:i:s').'<br>

		$no = 1;
		$output = '';

    $output .='<div>'; // content

		$output .= '
              <div style="text-align: center; font-size: 20px; font-weight: bold;">'.$toko->store_name.'</div>
              <div style="text-align: center">'.$toko->store_address.' '.$toko->store_phone.'</div>
              <div style="text-align: center" id="time_transaction" data-transaction="'.date('Y-m-d  h:i:s').'">'.date('Y-m-d  h:i:s').'</div>
              ';
    $output .='<div style="border-top:1px dashed; border-bottom:1px dashed; margin: 20px 0;">'; // body

    $output .='<div style="display: flex; border-bottom:1px dashed; margin-bottom: 10px;">
                  <div style="width: 10%; font-weight: bold;">No</div>
                  <div style="width: 40%; font-weight: bold;">Nama</div>
                  <div style="width: 15%; font-weight: bold; text-align: center;">Qty</div>
                  <div style="width: 35%; font-weight: bold;">Sub Total</div>
                </div>
              ';

              foreach($this->cart->contents() as $row){
    $output .= '
                <div style="display: flex; margin-bottom: 10px;">
                  <div style="width: 10%;">'.$no++.'</div>
                  <div style="width: 40%;">'.$row["name"].'</div>
                  <div style="width: 15%; text-align: center;">'.$row["qty"].'</div>
                  <div style="width: 35%;">Rp.'.$row["price"] .'</div>
                </div>';
              }

    $output .= '</div>'; // body

    $output .= '
                <div style="display: flex;">
                  <div style="width: 60%; text-align: right;">Total</div>
                  <div style="width: 5%; text-align: center;">:</div>
                  <div style="width: 35%;">Rp.'.number_format($this->cart->total(),0,',','.').'</div>
                </div>
              ';

    $output .= '
                <div style="display: flex;">
                  <div style="width: 60%; text-align: right;">Bayar</div>
                  <div style="width: 5%; text-align: center;">:</div>
                  <div style="width: 35%;">Rp.'.number_format($bayar,0,',','.').'</div>
                </div>
              ';

    $output .= '
                <div style="display: flex;">
                  <div style="width: 60%; text-align: right;">Kembali</div>
                  <div style="width: 5%; text-align: center;">:</div>
                  <div style="width: 35%;">Rp.'.$kembali.'</div>
                </div>
              ';

    $output .= '<div style="text-align:center; margin: 20px 0;">
                  Terimakasih atas kunjungan anda
                </div>';
    $output .='</div>'; // content
    echo $output;
	}
	
	public function shoping(){
    $time_transaction = $this->input->post("time_transaction");
    $response = [];
		if($this->cart->contents() != []){
      $order_id = md5(date('Y-m-d  h:i:s'));
			foreach ($this->cart->contents() as $insert){
				$order = [
          'order_code' => $order_id,
          'user_id' => $this->session->userdata('user_id'),
          'product_id' => $insert['id'],
          'product_name' => $insert['name'],
          'price' => $insert['price'],
          'qty' => $insert['qty'],
          'created_at' => $time_transaction,
				];

        $res = $this->model_barang->get_product_qty($insert['id']);
        $last_qty = $res->product_qty - $insert['qty'];

        $this->model_barang->create_order($order);
        $this->model_barang->update_product_qty($insert['id'], $last_qty);
			}

      $this->cart->destroy();
      $response = array(
        "status" => 200,
        "message" => "success",
      );
		}else{
      $response = array(
        "status" => 400,
        "message" => "internal server error",
      );
		}
    echo json_encode($response);
	}
	
  // fix
	public function delete_shoping_cart($rowid){
		$res = $this->cart->update(
      [
				'rowid' => $rowid,
				'qty' => 0,
      ]
    );
    if(!$res){
      echo json_encode(
        array(
          "status" => 200,
          "message" => 'Internal server error',
        )
      );
      return;
    }
    echo json_encode(
      array(
        "status" => 200,
        "message" => "success",
      )
    );
	}
	
	public function data_penjualan(){
		$this->load->view('kasir/penjualan_view');
	}
	
  // fix
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
			$row[] = $barang->order_code;
      $row[] = $barang->product_name;
			$row[] = $barang->qty;
			$row[] = $barang->user_id;
			$row[] = $barang->price;
      $row[] = $barang->price * $barang->qty;
			$row[] = $barang->created_at;
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
	
  // fix
	public function data_toko(){
		$this->load->view('profil/toko_view');
	}
	
  // fix
	public function find_store(){
		$this->load->model('model_toko');
		$data = $this->model_toko->find_store();
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

	public function pengunjung(){
		$this->load->view('admin/pengunjung_view');
	}

	public function akun(){
		$this->load->model('model_member');
		$data['judul'] = 'profil';
		$data['akun'] = $this->model_member->get_profil();
		$this->load->view('profil/profil_view',$data);
	}

	public function edit_profil(){
		$this->load->model('model_member');
		$data = $this->model_member->get_profil();
		echo json_encode($data);
	}

	public function data_user(){
		$this->load->view('kasir/data_user_view');
	}

  // fix
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