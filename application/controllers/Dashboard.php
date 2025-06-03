<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Dashboard extends CI_Controller{
		function __construct(){
			parent::__construct();
		}
		function index(){
			if($this->session->userdata('logged_in')){
				$data_session = $this->session->userdata('logged_in');
				$usuario_nivel = $data_session['id_usuario_nivel'];
				
				$data['nombre_completo'] = $data_session['nombre_completo'];
				$data['tienda'] = $data_session['tienda'];
				$data_menus['menus'] = $data_session['menus'];
				
				$this->load->view('template/header', $data_menus);
				$this->load->view('dashboard/dashboard_admin', $data);
				$this->load->view('template/footer');
			}else{
				redirect('login', 'refresh');
			}
		}
	
	}	
		
?>