<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registrasi extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('model_registrasi');
    $this->load->model('model_permision');
    if ($this->session->userdata('id')) {
      header("location: http://localhost:8080");
    }
  }



  public function index()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_rules(
      'username',
      'Username',
      'required|alpha_dash|is_unique[users.user_name]',
      array(
        'required' => 'tidak boleh kosong',
        'alpha_dash' => 'berisi angka dan huruf',
        'is_unique' => 'sudah terdaftar'
      )
    );
    $this->form_validation->set_rules(
      'password',
      'Password',
      'required',
      array(
        'required' => 'tidak boleh kosong'
      )
    );

    $this->form_validation->set_rules(
      'confirm_password',
      'Password Confirmation',
      'required|matches[password]',
      array(
        'required' => 'tidak boleh kosong',
        'matches' => 'pass harus sama'
      )
    );

    $this->form_validation->set_rules(
      'email',
      'Email',
      'required|valid_email|is_unique[users.email]',
      array(
        'required' => 'tidak boleh kosong',
        'is_unique' => 'sudah terdaftar',
        'valid_email' => 'email tidak valid'
      )
    );

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('auth/form_registrasi');
    } else {
      $username = $this->input->post('username', true);
      $email = $this->input->post('email', true);
      $password0 = $this->input->post('password', true);
      $password = $this->input->post('confirm_password', true);
      $data = array(
        'user_name' => $username,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT),
        'is_active' => false,
        'role' => 'seller',
      );
      $token = urlencode(base64_encode(random_bytes(64)));
      $data_token = array(
        'email' => $email,
        'token' => $token,
        'expired' => time()
      );
      $userId = $this->daftar_baru($data);
      $permision = array(
        'user_id' => $userId,
        'read' => true,
        'create' => false,
        'update' => false,
        'delete' => false,
      );
      $this->model_permision->new_permision($permision);
      // jika gagal hapus user
      $this->simpan_token($data_token);
      $this-> send_email($email, $token);
      $this->session->set_flashdata('message','<div class="alert alert-success " role="alert"><strong>silahkan konfirmasi email</strong></div>');
      redirect('login');
    }
  }


  public function daftar_baru($data)
  {
    return $daftar = $this->model_registrasi->daftar_baru($data);
  }

  public function simpan_token($data_token)
  {
    $this->model_registrasi->simpan_token($data_token);
  }

  public function send_email($email, $token)
  // public function send_email()
  {
    // $email='riantiresa23@gmail.com';
    // $token='fgjkkllajahbb';
    $config = [
      'protocol'   => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_user' => 'riantiresa23@gmail.com',
      'smtp_pass' => '1Q2w3e4r@#',
      'smtp_port'  => 465,
      'mailtype'   => 'html',
      'charset'     => 'utf-8',
      'newline'     => "\r\n"
    ];
    $this->load->library('email');
    $this->email->initialize($config);
    $this->email->from('noreply@kasir.com', 'kasir');
    $this->email->to($email);
    $this->email->subject('aktivasi akun');
    $this->email->message('silahkan klik link untuk aktifasi akun<a href=" ' . site_url() . 'registrasi/aktifasi?email=' . $email . '&token=' . $token . ' "> ' . site_url() . 'registrasi/aktifasi?email=' . $email . '&token=' . $token . ' </a> <br>link akan kadaluarsa dalam waktu 24 jam');
    if ($this->email->send()) {
      // echo 'sukses';
      //die;
      return true;
    } else {
      echo $this->email->print_debugger();
      die;
    }
  }

  public function aktifasi()
  {
    $email = $this->input->get('email', true);
    $token = $this->input->get('token', true);
    $data = $this->model_registrasi->cek_data_token($email);
    // echo($data['token']);
    // echo('<br>');
    // echo $token;
    // die;
    // var_dump($data);
    // var_dump($email);
    // die;
  
    if ($data['email'] == $email) {

      if ($data['token'] == urlencode($token)) {

        if (time() - $data['expired'] < (60 * 60 * 24)) {
          $this->model_registrasi->update_aktif($email);
          $this->model_registrasi->delete_token($email);
          $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
                     sukses aktifasi akun
                  </div>'
          );
          redirect('login');
        } else {
          $this->model_registrasi->delete_token($email);
          $this->model_registrasi->delete_permission($data['user_id']);
          $this->model_registrasi->delete_user($email);
          $this->session->set_flashdata(
            'message',
            '<div class="alert alert-danger" role="alert">
                     token kadaluarsa
                  </div>'
          );
          redirect('login');
        }
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">token invailed</div>');
        redirect('login');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">email invailed</div>');
      redirect('login');
    }
  }
}

// zf5D1gACThFQZ8NooG9Xy1poOuiG%2FMWWMoUwQhWaGEE%3D

// zf5D1gACThFQZ8NooG9Xy1poOuiG%2FMWWMoUwQhWaGEE%3D