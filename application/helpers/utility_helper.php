<?php
	function asset_url(){
		return base_url().'assets/';	
	}
	function path_root(){
		return $_SERVER['DOCUMENT_ROOT'].'/upload';
	}
	function calculoPrecios($items) {
	    $itemsOut = array();
	    foreach ($items as $item) {
	        // validando tipo de calculo, (f)factor o (d)descuento
	        if($item['tipoCalculo']=='f') { // factor
	            // descomponiendo medida EJE. 6X7.20, del catalogo cat_medida
	            $aMed = explode('X', $item['medida']);
	            // validando la descomposocion en 2 elementos
	            if(count($aMed) == 2){
	                // validando que medias sean numericas
	                $me1 = rtrim($aMed[0]);
	                $me2 = rtrim($aMed[1]);
	                if(is_numeric($me1) and is_numeric($me2)) {
	                    $me1 = (double)$me1;
	                    //log_message('debug', 'me1 ' . $me1);
	                    $me2 = (double)$me2;
	                    //log_message('debug', 'me2 ' . $me2);
	                    // validando valor del factor
	                    if(is_numeric($item['facDes'])) {
	                        $facDes = (double)$item['facDes'];
	                        // calculo de precio cliente
	                        $calPre = ($me1 * $me2) * $facDes;
	                        //log_message('debug', 'calculo factor ' . $calPre);
	                        $precioCliente = str_replace(",", "", number_format($calPre, 2));
	                        $item['precioCliente'] = $precioCliente;
	                        
	                        $item['error'] = FALSE;
	                        $item['msg'] = '';
	                        
	                    }else{
	                        // mensaje de error
	                        $item['error'] = TRUE;
	                        $item['msg'] = 'el valor del factor es incorrecto';
	                    }
	                    
	                }else{
	                    // mensaje de error
	                    $item['error'] = TRUE;
	                    $item['msg'] = 'los valores para la medida no son numericos';
	                }
	            }else{
	                // mensaje de error
	                $item['error'] = TRUE;
	                $item['msg'] = 'no se encuentra asiganada una medida correcta';
	            }
	            
	        } else if($item['tipoCalculo']=='d') { // descuento
	            if(is_numeric($item['facDes'])){
	                // calculo del precio cliente
	                $factorDesc = ((double)$item['facDes'] * (double)$item['precio02']) / 100;
	                $precioCliente =  str_replace(",", "", number_format(((double)$item['precio02'] - $factorDesc), 2));
	                $item['precioCliente'] = $precioCliente;
	                $item['error'] = FALSE;
	                $item['msg'] = '';
	            }else{
	                // mensaje de error
	                $item['error'] = TRUE;
	                $item['msg'] = 'el valor del descuento es incorrecto';
	            }
	            
	        }else if($item['tipoCalculo']=='p1'){ // fijo al precio 1
	            
	            $precioCliente = $item['precio01'];
	            $item['precioCliente'] = $precioCliente;
	            
	        }else if($item['tipoCalculo']=='p2'){ // fijo al precio 2
	            
	            $precioCliente = $item['precio02'];
	            $item['precioCliente'] = $precioCliente;
	            
	        }else if($item['tipoCalculo']=='i'){ // fijo al colocado
                $precioCliente = $item['facDes'];
                $item['precioCliente'] = $precioCliente;
            }
	        
	        // calculando el porcentaje de la utilidad
	        if(isset($item['error'])){
	            if((double)$item['costo']>0){
	                //log_message('debug', 'item ' . print_r($item, TRUE));
	                $utili = (($precioCliente - (double)$item['costo']) / (double)$item['costo'] * 100);
	                $utili = number_format($utili, 0);
	                $item['utilidad'] = $utili;
	            }else{
	                // mensaje de error
	                $item['error'] = TRUE;
	                $item['msg'] = 'el costo del articulo debe ser mayor a cero';
	                $item['utilidad'] = 0;
	            }
	        }else{
	            $item['utilidad'] = 0;
	        }
	        
	        unset($item['costo']);
	        unset($item['error']);
	        unset($item['medida']);
	        unset($item['msg']);
	        unset($item['precio01']);
	        unset($item['precio02']);
	        unset($item['utilidad']);
	        
	        array_push($itemsOut, $item);
	    }
	    return $itemsOut;
	}
?>