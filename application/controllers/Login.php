<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Login extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->helper('form');
			$this->load->model(array(
			    'login_model'
			));
		}
		public function index(){
		    $data = array();
		    //$data['item'] = $this->login_model->getTienda(array('default'=>1));
			$this->load->view('login_view', $data);
		}
		
		public function logout(){
			$this->session->unset_userdata('logged_in');
			session_destroy();
			redirect('login', 'refresh');
		}
	}
?>