<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {
	
	public function acak() {
		$n = 2;
		$key = 'abcd';
		// $text = strlen($key)-1;
		$hasil = array();
		$hasil = '';
			for($i=0; $i<$n; $i++){
				for($j=0; $j<4; $j++){
					$buat = rand(0, strlen($key)-1);
					$hasil .= $key[$buat];
				}
			}
		return $hasil;
	}
	
	public function arrayacak() {
		$data[] = $this->acak();
		for($a=0; $a<2; $a++) {
			print_r($data);
		}
	}

	public function index() {
		$a = '7hvig4ljsoe14kahv7cm0lvgzj7wgth6epasogl92knvifgix8vsphbrbj4wqveguqtzqzjbsbp8jarn07kpe9dyofyiacuhhrppuf77p72npo95fcnq78csnqzypivn';
		echo strlen($a);
	}

	function hapus() {
		$id = 2;
		$this->db->where('id_penjualan',$id);
		$this->db->delete('penjualan');
	}
}
