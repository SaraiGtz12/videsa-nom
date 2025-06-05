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

		//Función para generar el arreglo de los datos
		private function generarDatos($dataCampo, $dataEquipo, $dataConcentracion){
			// Recuperar datos del equipo
			$extencionPuerto = $dataEquipo['extencionPuerto'];
			$diametroIntC = $dataEquipo['diametro_interior_conducto'];

			// Obtención del promedio para los datos de campo
			$promediosDatosCampo = $this->calcularPromediosCampo($dataCampo);

			// Calculos para la Tabla de "Determinación de la Estratificación"
			$marcadoSonda = $this->calcularMarcadoSonda($diametroIntC, $extencionPuerto);

			$resultadosEstratificacion = $this->calcularEstratificacion($dataConcentracion);


			//tabla de conclusiones
			$conclusiones = $this->determinarConclusiones(
				$resultadosEstratificacion['estratificacion']['estratMaxima'],
				$resultadosEstratificacion['ppm']['ppmMaxima']
			);

			#--- Armado del arreglo ---#

			$datos = [
				'promedios_campo' => $promediosDatosCampo,
				'equipo' => [
					'geometriaConducto' => $dataEquipo['geometriaConducto'],
					'diametro_equivalente' => $dataEquipo['diametro_equivalente']
				],
				'tablaEstra' => array_merge(
					['marcado_sonda' => $marcadoSonda],
					$resultadosEstratificacion
				), 'conclusiones' => $conclusiones
			];

			$informacion = json_encode($datos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
			log_message('error', 'Datos de la función: '.$informacion);

			return $datos;
		}

		//Función para los datos de la sonda
		private function calcularMarcadoSonda($diametroIntC, $extencionPuerto) {
			return [
				'marcado1' => number_format((($diametroIntC*(1/6))+$extencionPuerto), 2),
				'marcado2' => number_format((($diametroIntC*(1/2))+$extencionPuerto), 2),
				'marcado3' => number_format((($diametroIntC*(5/6))+$extencionPuerto), 2)
			];
		}

		//Función para calcular los datps promedios de campo
		private function calcularPromediosCampo($dataCampo) {
			$total_muestras = count($dataCampo);
			$sumas = [
				'nox' => 0,
				'co' => 0,
				'o2' => 0,
				'co2' => 0,
				'temp' => 0
			];

			foreach($dataCampo as $muestra) {
				$sumas['nox'] += $muestra['nox'];
				$sumas['co'] += $muestra['co'];
				$sumas['o2'] += $muestra['o2'];
				$sumas['co2'] += $muestra['co2'];
				$sumas['temp'] += $muestra['temp'];
			}

			return [
				'nox' => $sumas['nox'] / $total_muestras,
				'co' => $sumas['co'] / $total_muestras,
				'o2' => $sumas['o2'] / $total_muestras,
				'co2' => $sumas['co2'] / $total_muestras,
				'temp' => $sumas['temp'] / $total_muestras
			];
		}

		//Función para calcular los datos de estratificacion
		private function calcularEstratificacion($concentraciones) {
			$ConcentracionPpm1 = $concentraciones[0]['concentracion1'];
			$ConcentracionPpm2 = $concentraciones[0]['concentracion2'];
			$ConcentracionPpm3 = $concentraciones[0]['concentracion3'];

			$ConcentracionPromedio = number_format(($ConcentracionPpm1 + $ConcentracionPpm2 + $ConcentracionPpm3) / 3, 2);

			$estratificacion1 = number_format(($ConcentracionPromedio == 0) ? 0 : abs(($ConcentracionPromedio - $ConcentracionPpm1) / $ConcentracionPromedio) * 100, 2);
			$estratificacion2 = number_format(($ConcentracionPromedio == 0) ? 0 : abs(($ConcentracionPromedio - $ConcentracionPpm2) / $ConcentracionPromedio) * 100, 2);
			$estratificacion3 = number_format(($ConcentracionPromedio == 0) ? 0 : abs(($ConcentracionPromedio - $ConcentracionPpm3) / $ConcentracionPromedio) * 100, 2);

			$ppm1 = number_format(abs($ConcentracionPromedio - $ConcentracionPpm1), 2);
			$ppm2 = number_format(abs($ConcentracionPromedio - $ConcentracionPpm2), 2);
			$ppm3 = number_format(abs($ConcentracionPromedio - $ConcentracionPpm3), 2);

			return [
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
					'estratMaxima' => max($estratificacion1, $estratificacion2, $estratificacion3)
				],
				'ppm' => [
					'ppm1' => $ppm1,
					'ppm2' => $ppm2,
					'ppm3' => $ppm3,
					'ppmMaxima' => max($ppm1, $ppm2, $ppm3)
				]
			];
		}

		//Función para determinar las conclusiones con base a los puntos obtenidos
		private function determinarConclusiones($estratMax, $ppmMax) {
			// Puntos para estratificación
			$puntosEstrat = ($estratMax <= 5) ? 1 : 
						(($estratMax <= 10) ? 3 : 12);
			
			// Puntos para ppm
			$puntosPpm = ($ppmMax <= 0.5) ? 1 : 
						(($ppmMax <= 1) ? 3 : 12);
			
			$puntosFinales = min($puntosEstrat, $puntosPpm);
			
			$conclusion = "No Estratificada";
			if($puntosFinales == 3) {
				$conclusion = "Minimamente Estratificada";
			} elseif($puntosFinales == 12) {
				$conclusion = "Estratificada";
			}
			
			return [
				'puntosFinales' => $puntosFinales,
				'conclusion' => $conclusion
			];
		}

		private function distribucionPuntosEstratificacion(){
			
		}

	}	
?>
