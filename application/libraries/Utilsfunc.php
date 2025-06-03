<?php 
	if (!defined('BASEPATH')) exit('No direct script access allowed');
	class Utilsfunc{
		
	    /*
	     * Function para eliminar columna de array multi
	     */
	    public function deleteColArray(&$array, $offset) {
	        return array_walk($array, function (&$v) use ($offset) {
	            array_splice($v, $offset, 1);
	        });
	    }
	    
		/**
		 * functoin para agregar dias a una n fecha
		 *  @param date $date
		 *  @param int days
		 */
		public function addDayswithDate($date, $days){
		    $date = strtotime('+'.$days.' days', strtotime($date));
		    return  date('Y-m-d', $date);
		}
		/**
		* funcion para convertir un numero a decimal con X digitos sin redondear
		* @param String $number
		* @param Int $digitos cantidad de digitos a mostrar
		* @return Float
		*/
		public function truncateFloat($number){
			$digitos=2;
		    $raiz=10;
		    $multiplicador = pow($raiz,$digitos);
		    $resultado = ((int)($number * $multiplicador)) / $multiplicador;
		    return str_replace(",", "", number_format($resultado, $digitos));
		}
		/**
		 * funcion para buscar por n campo indice en el que se encuentra en un array entero.
		 * @param Int $id - clave o texto a buscar en array.
		 * @param Int $array - coleccion.
		 * @param String $col - columna a buscar.
		 * @return NULL ? Int.
		 */
		public function searchListId($id, $array, $col){
			foreach ($array as $key=>$val){
				$idCom = (int)$val[$col];
				if ($idCom===(int)$id){
					return $key;
				}
			}
			return -1;
		}
		
		/**
			* funcion para buscar por n campo indice en el que se encuentra en un array texto
		*/
		public function searchListArray($id, $array, $col) {
			foreach ($array as $key=>$val){
				$idCom = $val[$col];
				if (trim($idCom) === trim($id)) {
					return (int)$key;
				}
			}
			return -1;
		}
		
		/**
		 * dias entre dos fechas.
		 * @param Date $fecha_i - 'yyy-mm-dd'
		 * @param Date $fecha_f - 'yyy-mm-dd'
		 */
		public function diasTrascurridos($fecha_i, $fecha_f){
			$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
			$dias 	= abs($dias); $dias = floor($dias);
			return $dias;
		}
		
		/*
		 * CURL API CALLS WITH PHP AND JSON DATA (GET POST PUT DELETE)
		 * source : https://www.weichieprojects.com/blog/curl-api-calls-with-php/#!
		 */
		public function callAPI($method, $url, $data){
		    $curl = curl_init();
		    switch ($method){
		        case 'POST':
		            curl_setopt($curl, CURLOPT_POST, 1);
		            if ($data)
		                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		                break;
		        case 'PUT':
		            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
		            if ($data)
		                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		                break;
		        default:
		            if ($data)
		                $url = sprintf("%s?%s", $url, http_build_query($data));
		    }
		    
		    // OPTIONS:
		    curl_setopt($curl, CURLOPT_URL, $url);
		    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		        'Content-Type: application/json',
		    ));
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		    
		    // EXECUTE:
		    $result = curl_exec($curl);
		    if(!$result){die("Connection Failure");}
		    curl_close($curl);
		    return $result;
		}
		/*
		 * @param Int $num - Numero a parsear
		 * @param int $toCeros - Numero de ceros a la iz, si no viene seteado en auto asigna 4
		 */
		public function cerosIzquierda($num, $toCeros = 4){
		    return str_pad($num, $toCeros, '0', STR_PAD_LEFT);
		}
		
		public function is_JSON($string, $return_data = false) {
		    $data = json_decode($string);
		    return (json_last_error() == JSON_ERROR_NONE) ? ($return_data ? $data : TRUE) : FALSE;
		}
		
		/**
		 * funcion numero a letras.
		 * @param Int $num - numero
		 * @param boolean $fem 
		 * @param boolean $dec 
		 */
		function num2letras($num, $fem=false, $dec=true) {
			$matuni[2]  = "dos";
			$matuni[3]  = "tres";
			$matuni[4]  = "cuatro";
			$matuni[5]  = "cinco";
			$matuni[6]  = "seis";
			$matuni[7]  = "siete";
			$matuni[8]  = "ocho";
			$matuni[9]  = "nueve";
			$matuni[10] = "diez";
			$matuni[11] = "once";
			$matuni[12] = "doce";
			$matuni[13] = "trece";
			$matuni[14] = "catorce";
			$matuni[15] = "quince";
			$matuni[16] = "dieciseis";
			$matuni[17] = "diecisiete";
			$matuni[18] = "dieciocho";
			$matuni[19] = "diecinueve";
			$matuni[20] = "veinte";
			$matunisub[2] = "dos";
			$matunisub[3] = "tres";
			$matunisub[4] = "cuatro";
			$matunisub[5] = "quin";
			$matunisub[6] = "seis";
			$matunisub[7] = "sete";
			$matunisub[8] = "ocho";
			$matunisub[9] = "nove";
		
			$matdec[2] = "veint";
			$matdec[3] = "treinta";
			$matdec[4] = "cuarenta";
			$matdec[5] = "cincuenta";
			$matdec[6] = "sesenta";
			$matdec[7] = "setenta";
			$matdec[8] = "ochenta";
			$matdec[9] = "noventa";
			$matsub[3]  = 'mill';
			$matsub[5]  = 'bill';
			$matsub[7]  = 'mill';
			$matsub[9]  = 'trill';
			$matsub[11] = 'mill';
			$matsub[13] = 'bill';
			$matsub[15] = 'mill';
			$matmil[4]  = 'millones';
			$matmil[6]  = 'billones';
			$matmil[7]  = 'de billones';
			$matmil[8]  = 'millones de billones';
			$matmil[10] = 'trillones';
			$matmil[11] = 'de trillones';
			$matmil[12] = 'millones de trillones';
			$matmil[13] = 'de trillones';
			$matmil[14] = 'billones de trillones';
			$matmil[15] = 'de billones de trillones';
			$matmil[16] = 'millones de billones de trillones';
			 
			//Zi hack
			$float=explode('.',$num);
			$num=$float[0];
		
			$num = trim((string)@$num);
			if ($num[0] == '-') {
				$neg = 'menos ';
				$num = substr($num, 1);
			}else
				$neg = '';
				while ($num[0] == '0') $num = substr($num, 1);
				if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num;
				$zeros = true;
				$punt = false;
				$ent = '';
				$fra = '';
				for ($c = 0; $c < strlen($num); $c++) {
					$n = $num[$c];
					if (! (strpos(".,'''", $n) === false)) {
						if ($punt) break;
						else{
							$punt = true;
							continue;
						}
		
					}elseif (! (strpos('0123456789', $n) === false)) {
						if ($punt) {
							if ($n != '0') $zeros = false;
							$fra .= $n;
						}else
		
							$ent .= $n;
					}else
		
						break;
		
				}
				$ent = '     ' . $ent;
				if ($dec and $fra and ! $zeros) {
					$fin = ' coma';
					for ($n = 0; $n < strlen($fra); $n++) {
						if (($s = $fra[$n]) == '0')
							$fin .= ' cero';
							elseif ($s == '1')
							$fin .= $fem ? ' una' : ' un';
							else
								$fin .= ' ' . $matuni[$s];
					}
				}else
					$fin = '';
					if ((int)$ent === 0) return 'Cero ' . $fin;
					$tex = '';
					$sub = 0;
					$mils = 0;
					$neutro = false;
					while ( ($num = substr($ent, -3)) != '   ') {
						$ent = substr($ent, 0, -3);
						if (++$sub < 3 and $fem) {
							$matuni[1] = 'una';
							$subcent = 'as';
						}else{
							$matuni[1] = $neutro ? 'un' : 'uno';
							$subcent = 'os';
						}
						$t = '';
						$n2 = substr($num, 1);
						if ($n2 == '00') {
						}elseif ($n2 < 21)
						$t = ' ' . $matuni[(int)$n2];
						elseif ($n2 < 30) {
							$n3 = $num[2];
							if ($n3 != 0) $t = 'i' . $matuni[$n3];
							$n2 = $num[1];
							$t = ' ' . $matdec[$n2] . $t;
						}else{
							$n3 = $num[2];
							if ($n3 != 0) $t = ' y ' . $matuni[$n3];
							$n2 = $num[1];
							$t = ' ' . $matdec[$n2] . $t;
						}
						$n = $num[0];
						if ($n == 1) {
							$t = ' ciento' . $t;
						}elseif ($n == 5){
							$t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t;
						}elseif ($n != 0){
							$t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t;
						}
						if ($sub == 1) {
						}elseif (! isset($matsub[$sub])) {
							if ($num == 1) {
								$t = ' mil';
							}elseif ($num > 1){
								$t .= ' mil';
							}
						}elseif ($num == 1) {
							$t .= ' ' . $matsub[$sub] . 'รณn';
						}elseif ($num > 1){
							$t .= ' ' . $matsub[$sub] . 'ones';
						}
						if ($num == '000') $mils ++;
						elseif ($mils != 0) {
							if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub];
							$mils = 0;
						}
						$neutro = true;
						$tex = $t . $tex;
					}
					$tex = $neg . substr($tex, 1) . $fin;
					//Zi hack --> return ucfirst($tex);
					 
					//Si el arreglo es mayor que 1 tiene decimales, en caso contrario es 0
					if(count($float)>1){
						$end_num=ucfirst($tex).' pesos '.$float[1].'/100 M.N.';
					}else{
						$end_num=ucfirst($tex).' pesos 00/100 M.N.';
					}
		
					//$end_num=ucfirst($tex).' pesos '.$float[1].'/100 M.N.';
					return $end_num;
		}
		function amoneda($numero, $moneda){
			$longitud = strlen($numero);
			$punto = substr($numero, -1,1);
			$punto2 = substr($numero, 0,1);
			$separador = ".";
			if($punto == "."){
				$numero = substr($numero, 0,$longitud-1);
				$longitud = strlen($numero);
			}
			if($punto2 == "."){
				$numero = "0".$numero;
				$longitud = strlen($numero);
			}
			$num_entero = strpos ($numero, $separador);
			$centavos = substr ($numero, ($num_entero));
			$l_cent = strlen($centavos);
			if($l_cent == 2){$centavos = $centavos."0";}
			elseif($l_cent == 3){$centavos = $centavos;}
			elseif($l_cent > 3){$centavos = substr($centavos, 0,3);}
			$entero = substr($numero, -$longitud,$longitud-$l_cent);
			if(!$num_entero){
				$num_entero = $longitud;
				$centavos = ".00";
				$entero = substr($numero, -$longitud,$longitud);
			}
		
			$start = floor($num_entero/3);
			$res = $num_entero-($start*3);
			if($res == 0){$coma = $start-1; $init = 0;}else{$coma = $start; $init = 3-$res;}
			$d= $init; $i = 0; $c = $coma;
			while($i <= $num_entero){
				if($d == 3 && $c > 0){$d = 0; $sep = ","; $c = $c-1;}else{$sep = "";}
				$final .=  $sep.$entero[$i];
				$i = $i+1; // todos los digitos
				$d = $d+1; // poner las comas
			}
			if($moneda == "pesos")  {$moneda = "$";
			return $moneda." ".$final.$centavos;
			}
			elseif($moneda == "dolares"){$moneda = "USD";
			return $moneda." ".$final.$centavos;
			}
			elseif($moneda == "euros")  {$moneda = "EUR";
			return $final.$centavos." ".$moneda;
			}
		}
	}
?>