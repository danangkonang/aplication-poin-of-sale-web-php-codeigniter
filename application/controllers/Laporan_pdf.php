<?php 
// if (!defined('BASEPATH')) exit('No direct script access allowed');
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Laporan_pdf extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->library('Pdf');
  }
  public function index() {
    $data = 'testing';
    $this->load->view('laporan/nota_penjualan', $data);
  }
}
