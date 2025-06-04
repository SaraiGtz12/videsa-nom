<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Nom_085 extends CI_Controller{
		function __construct(){
			parent::__construct();

            			if(!$this->session->userdata('logged_in')){
                        				redirect('login', 'refresh');

                        }

        }
		function index(){
				$data_session = $this->session->userdata('logged_in');
				$usuario_nivel = $data_session['id_usuario_nivel'];
				
				$data['nombre_completo'] = $data_session['nombre_completo'];
				$data['tienda'] = $data_session['tienda'];
				$data_menus['menus'] = $data_session['menus'];
				
				$this->load->view('template/header', $data_menus);
				$this->load->view('normas/085', $data);
				$this->load->view('template/footer');

		}

		public function guardar() {
			$json = file_get_contents('php://input');
			$datos = json_decode($json, true);

			// Accede a los datos como array asociativo:
			$numero_informe = $datos['numero_informe'];
			$orden_servicio = $datos['orden_servicio'];
			print_r("llegue aqui: ",$numero_informe);

			echo json_encode(['status' => 'ok']);
			}


	


		
	}	
		
?>