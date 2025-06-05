<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	require_once FCPATH . 'vendor/autoload.php';
	use Dompdf\Dompdf;
	use Dompdf\Options;
		
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
			$registrosCampos = $datosCompletos['registrosCampos'];
			$registrosCampos2 = $datosCompletos['registrosCampos2'];


			$form1_data = $this->convertir_a_array($form1);
			$form2_data = $this->convertir_a_array($form2);
			
			
			echo json_encode([
				'form1' => $form1_data,
				'form2' => $form2_data,
				'tabla' => $tabla,
				'tipo_formato' => $tipo_formato,
				'registrosCampos' => $registrosCampos,
				'registrosCampos2' => $registrosCampos2
			]);
			
			

		}

		private function convertir_a_array($array) {
			$resultado = [];
			foreach ($array as $item) {
				$resultado[$item['name']] = $item['value'];
			}
			return $resultado;
		}
		
			// public function generar_pdf() {
			// 	$form1 = $this->input->post('form1');
			// 	$form2 = $this->input->post('form2');
			// 	$tabla = $this->input->post('tabla');
			// 	$tipo_formato = $this->input->post('tipo_formato');
			// 	$registrosCampos = $this->input->post('registrosCampos');
			// 	$registrosCampos2 = $this->input->post('registrosCampos2');


			// 	// echo json_encode([
			// 	// 	'form1' => $form1,
			// 	// 	'form2' => $form2,
			// 	// 	'tabla' => $tabla,
			// 	// 	'registrosCampos' => $registrosCampos,
			// 	// 	'registrosCampos2' => $registrosCampos2
			// 	// ]);
			// 	  $data = [
			// 		'numero_informe' => $form1['numero_informe'],
			// 		'orden_servicio' => $form1['orden_servicio'],
			// 		'fecha_evaluacion' => $form1['fecha_evaluacion'],
			// 		'recepcion' => $form1['recepcion'],
			// 		'fecha_informe' => $form1['fecha_informe'],
			// 	];

			// 	$html = $this->load->view('pdf/plantilla', $data, true);

			// 	$this->pdf->loadHtml($html);
			// 	$this->pdf->render();
			// 	$this->pdf->stream("informe_nom_085.pdf", ["Attachment" => true]);

			// }
		public function generar_pdf() {
		
			$form1 = $this->input->post('form1');
			$form2 = $this->input->post('form2');
			$tabla = $this->input->post('tabla');
			$tipo_formato = $this->input->post('tipo_formato');
			$registrosCampos = $this->input->post('registrosCampos');
			$registrosCampos2 = $this->input->post('registrosCampos2');

			$data = [
				'numero_informe' => $form1['numero_informe'],
				'orden_servicio' => $form1['orden_servicio'],
				'fecha_evaluacion' => $form1['fecha_evaluacion'],
				'recepcion' => $form1['recepcion'],
				'fecha_informe' => $form1['fecha_informe'],
			];

			$html = $this->load->view('pdf/plantilla', $data, true);

			$options = new Options();
			$options->set('isRemoteEnabled', true); 
			$dompdf = new Dompdf($options);
			$dompdf->loadHtml($html);
			$dompdf->setPaper('A4', 'portrait');
			$dompdf->render();
			$dompdf->stream("informe_nom_085.pdf", ["Attachment" => true]);

			$informacion = $this->generarDatos($registrosCampos, $form2, $tabla);
			
		}

		private function generarDatos($dataCampo, $dataEquipo, $dataConcentracion){
			// Recuperar datos del equipo
			$extencionPuerto = $dataEquipo['extencionPuerto'];
			$diametroIntC = $dataEquipo['diametro_interior_conducto'];

			// Obtención del promedio para los datos de campo
			$total_muestras = count($dataCampo);
			$suma_nox = 0;
			$suma_co = 0;
			$suma_o2 = 0;
			$suma_co2 = 0;
			$suma_temp = 0;

			foreach($dataCampo as $muestra) {
				$suma_nox += $muestra['nox'];
				$suma_co += $muestra['co'];
				$suma_o2 += $muestra['o2'];
				$suma_co2 += $muestra['co2'];
				$suma_temp += $muestra['temp'];
			}

			$promedios = [
				'nox' => $suma_nox / $total_muestras,
				'co' => $suma_co / $total_muestras,
				'o2' => $suma_o2 / $total_muestras,
				'co2' => $suma_co2 / $total_muestras,
				'temp' => $suma_temp / $total_muestras
			];

			// Calculos para la Tabla de "Determinación de la Estratificación"
			$marcado1 = number_format((($diametroIntC*(1/6))+$extencionPuerto), 2);
			$marcado2 = number_format((($diametroIntC*(1/2))+$extencionPuerto), 2);
			$marcado3 = number_format((($diametroIntC*(5/6))+$extencionPuerto), 2);

			$ConcentracionPpm1 = $dataConcentracion['Concentracion1'];
			$ConcentracionPpm2 = $dataConcentracion['Concentracion2'];
			$ConcentracionPpm3 = $dataConcentracion['Concentracion3'];

			$ConcentracionPromedio = ($ConcentracionPpm1 + $ConcentracionPpm2 + $ConcentracionPpm3) / 3;

			$estratificacion1 = ($ConcentracionPromedio == 0) ? 0 : abs(($ConcentracionPromedio - $ConcentracionPpm1) / $ConcentracionPromedio) * 100;
			$estratificacion2 = ($ConcentracionPromedio == 0) ? 0 : abs(($ConcentracionPromedio - $ConcentracionPpm2) / $ConcentracionPromedio) * 100;
			$estratificacion3 = ($ConcentracionPromedio == 0) ? 0 : abs(($ConcentracionPromedio - $ConcentracionPpm3) / $ConcentracionPromedio) * 100;

			$ppm1 = number_format(abs($ConcentracionPromedio - $ConcentracionPpm1), 2);
			$ppm2 = number_format(abs($ConcentracionPromedio - $ConcentracionPpm2), 2);
			$ppm3 = number_format(abs($ConcentracionPromedio - $ConcentracionPpm3), 2);

			return [
				'promedios_campo' => $promedios,
				'equipo' => [
					'geometriaConducto' => $dataEquipo['geometriaConducto'],
					'diametro_equivalente' => $dataEquipo['diametro_equivalente']
				],
				'estratificacion' => [
					'marcado_sonda' => [
						'marcado1' => $marcado1,
						'marcado2' => $marcado2,
						'marcado3' => $marcado3
					],
					'concentraciones' => [
						'concentracion1' => $ConcentracionPpm1,
						'concentracion2' => $ConcentracionPpm2,
						'concentracion3' => $ConcentracionPpm3,
						'promedio' => $ConcentracionPromedio
					],
					'porcentajes' => [
						'estratificacion1' => $estratificacion1,
						'estratificacion2' => $estratificacion2,
						'estratificacion3' => $estratificacion3,
						'maxima' => max($estratificacion1, $estratificacion2, $estratificacion3)
					],
					'ppm' => [
						'ppm1' => $ppm1,
						'ppm2' => $ppm2,
						'ppm3' => $ppm3,
						'maxima' => max($ppm1, $ppm2, $ppm3)
					]
				]
			];
		}

	}	
?>