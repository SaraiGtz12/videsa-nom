<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	require_once FCPATH . 'vendor/autoload.php';
	use Dompdf\Dompdf;
	use Dompdf\Options;
		
	class Nom_085 extends CI_Controller{
		function __construct(){
			parent::__construct();

            			// if(!$this->session->userdata('logged_in')){
                        // 				redirect('login', 'refresh');

                        // }

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
			$registrosCampos = $datosCompletos['registrosCampos'];
			$registrosCampos2 = $datosCompletos['registrosCampos2'];


			$form1_data = $this->convertir_a_array($form1);
			$form2_data = $this->convertir_a_array($form2);
			
			
			$grafica_co = $datosCompletos['grafica_co'] ?? '';
			$grafica_o2 = $datosCompletos['grafica_o2'] ?? '';
			$grafica_co2 = $datosCompletos['grafica_co2'] ?? '';


			echo json_encode([
				'form1' => $form1_data,
				'form2' => $form2_data,
				'tabla' => $tabla,
				'tipo_formato' => $tipo_formato,
				'registrosCampos' => $registrosCampos,
				'registrosCampos2' => $registrosCampos2,
				'grafica_co' => $grafica_co,
				'grafica_o2' => $grafica_o2,
				'grafica_co2' => $grafica_co2
			]);
			

			}
			private function convertir_a_array($array) {
				$resultado = [];
				foreach ($array as $item) {
					$resultado[$item['name']] = $item['value'];
				}
				return $resultado;
			}

		public function generar_pdf() {
			$form1 = json_decode($this->input->post('form1'), true);
			$form2 = json_decode($this->input->post('form2'), true);
			$tabla = json_decode($this->input->post('tabla'), true);
			$tipo_formato = $this->input->post('tipo_formato');
			$registrosCampos = json_decode($this->input->post('registrosCampos'), true);
			$registrosCampos2 = json_decode($this->input->post('registrosCampos2'), true);

			$grafica_co = $this->input->post('grafica_co');
			$grafica_o2 = $this->input->post('grafica_o2');
			$grafica_co2 = $this->input->post('grafica_co2');
			
			$data = [
				'numero_informe' => $form1['numero_informe'],
				'orden_servicio' => $form1['orden_servicio'],
				'fecha_evaluacion' => $form1['fecha_evaluacion'],
				'recepcion' => $form1['recepcion'],
				'fecha_informe' => $form1['fecha_informe'],
				'razon_social' => $form1['razon_social'],
				'calle' => $form1['calle'],
				'colonia' => $form1['colonia'],
				'alcaldia' => $form1['alcaldia'],
				'estado' => $form1['estado'],
				'cp' => $form1['cp'],

				'equipo_evaluado' =>$form2['equipo_evaluado'],
				'marca' =>$form2['marca'],
				'combustible' =>$form2['combustible'],

				'concentracion' =>$tabla[0]['concentracion'],
				'estratificacion' =>$tabla[0]['estratificacion'],
				'ppm' =>$tabla[0]['ppm'],

				//tabla
				'registrosCampos' => $registrosCampos,

				'grafica_co' => $grafica_co,
				'grafica_o2' => $grafica_o2,
				'grafica_co2' => $grafica_co2,


			];


	


			$html = $this->load->view('pdf/plantilla-085MG', $data, true);

			$options = new Options();
			$options->set('isRemoteEnabled', true); 
			$dompdf = new Dompdf($options);
			$dompdf->loadHtml($html);
			$dompdf->setPaper('A4', 'portrait');
			$dompdf->render();
			$dompdf->stream("informe_nom_085.pdf", ["Attachment" => true]);
		}



		
	}	
		
?>