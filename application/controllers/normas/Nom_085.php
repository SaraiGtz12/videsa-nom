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

		public function generar_pdf() {
			$form1 = json_decode($this->input->post('form1'), true);
			$form2 = json_decode($this->input->post('form2'), true);
			$tabla = json_decode($this->input->post('tabla'), true);
			$tipo_formato = $this->input->post('tipo_formato');
			$registrosCampos = json_decode($this->input->post('registrosCampos'), true);
			$registrosCampos2 = json_decode($this->input->post('registrosCampos2'), true);
			
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

				'concentracion1' =>$tabla[0]['concentracion1'],
				'concentracion2' =>$tabla[0]['concentracion2'],
				'concentracion3' =>$tabla[0]['concentracion3'],
			];

			$informacion = $this->generarDatos($registrosCampos, $form2, $tabla);
			$informacion = json_encode($informacion, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
			log_message('error', 'Datos de la función: '.$informacion);
			
			$html = $this->load->view('pdf/plantilla-085MG', $data, true);

			$options = new Options();
			$options->set('isRemoteEnabled', true); 
			$dompdf = new Dompdf($options);
			$dompdf->loadHtml($html);
			$dompdf->setPaper('A4', 'portrait');
			$dompdf->render();
			$dompdf->stream("informe_nom_085.pdf", ["Attachment" => true]);
			
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

			$ConcentracionPpm1 = $dataConcentracion[0]['concentracion1'];
			$ConcentracionPpm2 = $dataConcentracion[0]['concentracion2'];
			$ConcentracionPpm3 = $dataConcentracion[0]['concentracion3'];

			$ConcentracionPromedio = number_format(($ConcentracionPpm1 + $ConcentracionPpm2 + $ConcentracionPpm3) / 3,2);

			$estratificacion1 = number_format(($ConcentracionPromedio == 0) ? 0 : abs(($ConcentracionPromedio - $ConcentracionPpm1) / $ConcentracionPromedio) * 100,2);
			$estratificacion2 = number_format(($ConcentracionPromedio == 0) ? 0 : abs(($ConcentracionPromedio - $ConcentracionPpm2) / $ConcentracionPromedio) * 100,2);
			$estratificacion3 = number_format(($ConcentracionPromedio == 0) ? 0 : abs(($ConcentracionPromedio - $ConcentracionPpm3) / $ConcentracionPromedio) * 100,2);
			$estratMax = max($estratificacion1, $estratificacion2, $estratificacion3);

			$ppm1 = number_format(abs($ConcentracionPromedio - $ConcentracionPpm1), 2);
			$ppm2 = number_format(abs($ConcentracionPromedio - $ConcentracionPpm2), 2);
			$ppm3 = number_format(abs($ConcentracionPromedio - $ConcentracionPpm3), 2);
			$ppmMax = max($ppm1, $ppm2, $ppm3);


			//tabla de conclusiones
			#--- Puntos para la estratificacion ---#
			$estratPts1 = 0;
			$estratPts2 = 0;
			$estratPts3 = 0;

			if($estratMax <= 5){
				$estratPts1 = 1;
			}
			if($estratMax <=10 && $estratMax >= 5){
				$estratPts2 = 3;
			}
			if($estratMax >= 10){
				$estratPts3 = 12;
			}

			$puntosMaxEstrat = max ($estratPts1, $estratPts2, $estratPts3);

			#--- Puntos para el ppm ---#
			$ppmPts1 = 0;
			$ppmPts1 = 0;
			$ppmPts1 = 0;

			if($ppmMax <= .5){
				$ppmPts1 = 1;
			}
			if($ppmMax > .5 && $ppmMax<= 1 ){
				$ppmPts2 = 3;
			}
			if($ppmMax > 1){
				$ppmPts3 = 12;
			}

			$puntosMaxPpm = min($ppmPts1, $ppmPts2, $ppmPts3);

			#--- Puntos finales ---#
			$puntosFinales = min($puntosMaxEstrat, $puntosMaxPpm);

			#--- Logica de la conclusión ---#
			$conclusion = "";
			if($puntosFinales == 1){
				$conclusion == "No Estratificada";
			}elseif($puntosFinales == 3){
				$conclusion == "Minimamente Estratificada";
			}elseif($puntosFinales == 12){
				$conclusion == "Estratificada";
			}

			#--- Armado del arreglo ---#

			$datos = [
				'promedios_campo' => $promedios,
				'equipo' => [
					'geometriaConducto' => $dataEquipo['geometriaConducto'],
					'diametro_equivalente' => $dataEquipo['diametro_equivalente']
				],
				'tablaEstra' => [
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
					'estratificacion' => [
						'estratificacion1' => $estratificacion1,
						'estratificacion2' => $estratificacion2,
						'estratificacion3' => $estratificacion3,
						'estratMaxima' => $estratMax
					],
					'ppm' => [
						'ppm1' => $ppm1,
						'ppm2' => $ppm2,
						'ppm3' => $ppm3,
						'ppmMaxima' => $ppmMax
					]
				]
			];

			$informacion = json_encode($datos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
			log_message('error', 'Datos de la función: '.$informacion);

			return $datos;
		}

	}	
?>
