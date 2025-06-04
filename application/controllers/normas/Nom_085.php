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
			$datosCompletos = $this->input->post('datosCompletos');
			
			if (!$datosCompletos) {
				echo json_encode(['error' => 'No se recibieron datos']);
				return;
			}


			$form1 = $datosCompletos['form1'];
			$form2 = $datosCompletos['form2'];
			$tabla = $datosCompletos['tabla'];
			$tipo_formato = $datosCompletos['normaSelect'];

			$form1_data = $this->convertir_a_array($form1);
			$form2_data = $this->convertir_a_array($form2);

			echo json_encode([
				'form1' => $form1_data,
				'form2' => $form2_data,
				'tabla' => $tabla,
				'tipo_formato' => $tipo_formato
			]);


			}
			private function convertir_a_array($array) {
				$resultado = [];
				foreach ($array as $item) {
					$resultado[$item['name']] = $item['value'];
				}
				return $resultado;
			}

		public function laboratorios(){
			$this->load->view('template/header');
		 	$this->load->view('norma85/Laboratorios');
		 	$this->load->view('template/footer');
		 }


	


		
	}	
		
?>