<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Resetpassword extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->helper('form');
			$this->load->model('resetpassword_model');
		}
		function __destruct(){
			//unset($this);
		}
		function index(){
			if($this->session->userdata('logged_in')){
				$data_session = $this->session->userdata('logged_in');
				$nombre_completo = $data_session['nombre_completo'];
				$id_usuario = $data_session['id_usuario'];
				$data['id_usuario'] = $id_usuario;
				$data['nombre_completo'] = $nombre_completo;
				$data['msg'] = '';
				$this->load->view('usuarios/reset_password', $data);
			}else{
				redirect('login', 'refresh');
			}
		}
		function reset(){
			$id_usuario = $this->input->post('id_usuario');
			$password = $this->input->post('register-password');
			$confirmPass = $this->input->post('register-password2');
			if($confirmPass!=$password){
				redirect('resetpassword', 'refresh');
				$data['msg'] = '<h3>Las contraseñas son incorrectas</h3>';
				$this->load->view('usuarios/reset_password', $data);
			}
			$data = array("password"=>md5($password),
					"password_cambiado"=>0,
			);
			$this->resetpassword_model->reset($data, $id_usuario);
			redirect('dashboard', 'refresh');
		}
	}
?>