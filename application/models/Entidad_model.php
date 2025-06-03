<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Entidad_model extends CI_Model{
	    
	    public $id_entidad;
	    public $cod_entidad;
	    public $tipo_persona;
	    public $rfc;
	    public $nombre_razon_social;
	    public $nombre;
	    public $a_paterno;
	    public $a_materno;
	    public $calle;
	    public $n_interior;
	    public $n_exterior;
	    public $poblacion;
	    public $colonia;
	    public $CIUDAD;
	    public $REFERENCIA;
	    public $LOCALIDAD;
	    public $CP;
	    public $REGION;
	    public $ESTADO;
	    public $pais;
	    public $entidad_tipo;
	    public $dias_credito;
	    public $monto_credito;
	    public $SALDO;
	    public $DESCUENTO;
	    public $id_tienda;
	    public $fec_ult_com;
	    public $numero_compras;
	    public $activo;
	    public $tipo_precio;
	    public $id_metodo_pago;
	    public $ref;
	    public $pagado;
	    public $fec_ult_pag_cred;
	    public $fecha_baja;
	    public $id_usuario_baja;
	    public $esCliente;
	    public $esProveedor;
	    public $tipoCredito;
	    public $id_forma_pago;
	    public $id_uso_cfdi;
	    public $articulosListaPrecio;
	    public $codMetPago;
	    public $codFormaPago;
	    public $codUsoCFDI;
	    public $debe;
	    public $idTiendaProveedor;
	    
		function __construct(){
			parent::__construct();
			$this->load->database($GLOBALS['DEFAULT_SCHEMA']);
		}
		
		public function setFields($dData) {
		    foreach($dData as $nameF=>$valF){
		        if(property_exists('Entidad_model', $nameF)){
		            $this->$nameF = $valF;
		        }
		    }
		    $this->nombre_razon_social = strtoupper($this->nombre_razon_social);
		    $this->rfc = strtoupper($this->rfc);
		    $this->calle = strtoupper($this->calle);
		    $this->n_interior = strtoupper($this->n_interior);
		    $this->n_exterior = strtoupper($this->n_exterior);
		    $this->poblacion = strtoupper($this->poblacion);
		    $this->colonia = strtoupper($this->colonia);
		    $this->CIUDAD = strtoupper($this->CIUDAD);
		    $this->REFERENCIA = strtoupper($this->REFERENCIA);
		    $this->LOCALIDAD = strtoupper($this->LOCALIDAD);
		    $this->REGION = strtoupper($this->REGION);
		    $this->ESTADO = strtoupper($this->ESTADO);
		    $this->pais = strtoupper($this->pais);
		    return $this;
		}
		
		function actualiza_credito($id_entidad, $col){
			$this->db->set('SALDO',$col, FALSE);
			$this->db->where(array('id_entidad'=>$id_entidad));
			$this->db->update('entidad');
		}
		
		function listEntidadPrecios($col, $criterio){
			
		}
		
		# actualiza ultima compra
		function actualiza_ultima_compra($id_entidad, $data){
			
		}
		
		# listado de descuentos
		function listado_descuentos($id_entidad){
			$this->db->select(array('descuentos_clientes.*',
					'articulo.descripcion as articulo')
			);
			$this->db->from('descuentos_clientes');
			$this->db->join('articulo', 'articulo.id_articulo = descuentos_clientes.id_articulo', 'left');
			$this->db->where('id_entidad', $id_entidad);
			$query = $this->db->get()->result_array();
			return $query;
		}
		
		function insert_descuento($data){
			$this->db->insert('descuentos_clientes', $data);
		}
		
		public function insertar_entidad($data){
			$this->db->insert('entidad', $data);
			return $this->db->insert_id();
		}
		
		public function saveEntiArti($idEntidad, $items){
		    $this->db->trans_begin();
		    
		    $this->db->delete('articulo_proveedor', array(
		        'idEntidad' => $idEntidad
		    ));
		    
		    $this->db->insert_batch('articulo_proveedor', $items);
		    
		    if ($this->db->trans_status() === FALSE) {
		        $this->db->trans_rollback();
		        log_message('error', 'Error al insertar o actualzar la entidad');
		    } else {
		        $this->db->trans_commit();
		    }
		    
		}
		
		// guarda entidad o actualiza entidad, metodos de cotnacto
		public function saveEntidadPro($idEntidad, $dEntidad, $contactos, $direcciones = NULL){
		    
		    // $edoTrans = NULL;
		    $codEntidad = '';
		    
		    $this->db->trans_begin();
		    
		    //log_message('debug', 'ENTIDAD_OBJ ' . print_r($dEntidad, TRUE));
		    
		    if ($idEntidad == 0){
		        // guadardo entidad como nuevo registro
		        $this->db->insert('entidad', $dEntidad);
		        $idEntidad = $this->db->insert_id();
		        if($dEntidad['cod_entidad']==''){
		            // armando cod entidad primeras dos letras despues de escacios con formato al consecutivo #####
		            $cadDes = explode(' ', $dEntidad['nombre_razon_social']);
		            $codEntidad = '';
		            if(isset($cadDes[0])){
		                $codEntidad.= substr($cadDes[0], 0, 1);
		            }
		            
		            if(isset($cadDes[1])){
		                $codEntidad.= substr($cadDes[1], 0, 1);
		            }
		            $codEntidad = $codEntidad . str_pad($idEntidad, 5, '0', STR_PAD_LEFT);
		            $this->db->update('entidad', array('cod_entidad'=>$codEntidad), array(
		                'id_entidad' => $idEntidad
		            ));
		        }
		    } else {
		        
		        $codEntidad = $dEntidad['cod_entidad'];
		        
		        // actualizando entidad
		        $this->db->update('entidad', $dEntidad, array(
		            'id_entidad' => $idEntidad
		        ));
		        // CAMBIAR POR UPDATE
		        $this->db->delete('entidad_propiedad', array(
		            'id_entidad' => $idEntidad
		        ));
		        // CAMBIAR POR UPDATE
		        $this->db->delete('entidad_direccion', array(
		            'id_entidad' => $idEntidad
		        ));
		        
		    }
		    // log_message('debug', 'contactos entidad ' . print_r($contactos, TRUE));
		    // iterando contactos
		    
		    $insertContact = array();
		    if ($contactos != NULL) {
		        foreach ($contactos as $item) {
		            $row = json_decode($item, TRUE); //cambiar en donde se dan de alta las entidades
		            $itemA = array(
		                'id_propiedad_tipo' => $row['id_propiedad_tipo'],
		                'id_entidad'=>$idEntidad,
		                'valor'=>$row['valor']
		            );
		            array_push($insertContact, $itemA);
		        }
		    }
		    
		    $insertDirecciones = array();
		    if($direcciones != NULL) {
		        foreach ($direcciones as $item) {
		            unset($item['catEntidadDireccion']);
		            unset($item['idEntidadDireccion']);
		            $item['cod_entidad'] = $codEntidad;
		            $item['id_entidad'] = $idEntidad;
		            array_push($insertDirecciones, $item);
		        }
		    }
		    
		    // insertando contactos
		    if(! empty($insertContact)) {
		        $this->db->insert_batch('entidad_propiedad', $insertContact);
		    }
		     
		    if(!empty($insertDirecciones)){
		        log_message('debug', 'direcciones ' . print_r($insertDirecciones, TRUE));
		        $this->db->insert_batch('entidad_direccion', $insertDirecciones);
		    }
		    
		    if($this->db->trans_status() === FALSE) {
		        $this->db->trans_rollback();
		        log_message('error', 'Error al insertar o actualzar la entidad');
		    } else {
		        $this->db->trans_commit();
		        $edoTrans = $idEntidad;
		    }
		    
		    return array(
		        'idEntidad'=>$idEntidad,
		        'codEntidad'=>$codEntidad
		    );
		}
		
		function insertar_propiedad($data){
			$this->db->insert('entidad_propiedad', $data);
		}
		
		function obtener_propiedad($id_entidad_propiedad){
			$this->db->where('id_entidad_propiedad', $id_entidad_propiedad);
			$res = $this->db->get('entidad_propiedad');
			return ($res->num_rows()>0) ? $res->row() : null;
		}
		
		# Obtiene los correos para el apartado Ordenes, venta al publico en general
		public function obtener_lista_propiedad_correo($idEntidad){
		    $res = $this->db->get_where('entidad_propiedad', array('id_propiedad_tipo'=>2,'id_entidad'=>$idEntidad))
		    ->result_array();
			return $res;
		}
		
		# Obtiene los telefonos para el apartado Ordenes, venta al publico en general
		function obtener_lista_propiedad_telefono($id_entidad){
			$this->db->where('id_entidad', $id_entidad);
			# Solo obtiene los telefonos donde id_propiedad_tipo = 1
			$this->db->where('id_propiedad_tipo', 1);
			$res = $this->db->get('entidad_propiedad');
			return $res->result_array();
		}
		
		# borra los correos o telefonos existentes para agregar nuevos desde la venta mostrador
		function borra_propiedad_entidad($id_propiedad_tipo, $id_entidad){
			$dwhere = array('id_propiedad_tipo'=>$id_propiedad_tipo,
					'id_entidad'=>$id_entidad
			);
			$this->db->where($dwhere);
			//log_message('error', print_r($dwhere, TRUE));
			$res = $this->db->delete('entidad_propiedad');
			return $res;
		}
		
		# inserta correos de la entidad
		function inserta_correos_entidad($data){
			$this->db->insert_batch('entidad_propiedad', $data);
			return $this->db->affected_rows();
		}
		
		# inserta telefonos de la entidad
		function inserta_telefonos_entidad($data){
			$this->db->insert_batch('entidad_propiedad', $data);
			return $this->db->affected_rows();
		}
		
		function getListaPropiedades($dWhere){
			$this->db->select(array(
			    'ep.id_entidad_propiedad',
			    'ep.valor',
			    'ep.tipo',
			    'po.descripcion',
			    'po.id_propiedad_tipo',
			    'cb.banco'
			));
			$this->db->from('entidad_propiedad ep');
			$this->db->where($dWhere);
			$this->db->join('propiedad_tipo po', 'po.id_propiedad_tipo = ep.id_propiedad_tipo', 'inner');
			$this->db->join('cat_banco cb', 'cb.idCatBanco = ep.idCatBanco', 'left');
			$res = $this->db->get()->result_array();
			return $res;
		}
			
		public function entidadesSelect($criterio, $tipo = NULL){
			
			$this->db->select(array(
			    'id_entidad',
				'nombre_razon_social',
				'cod_entidad'
			));
			if($tipo!=NULL){
			    $this->db->where(array('entidad_tipo'=>$tipo,'activo'=>'1'));
			}else{
			    $this->db->where(array('activo'=>'1'));
			}
			
			$this->db->like('nombre_razon_social', $criterio);
			$res = $this->db->get('entidad')->result_array();
			return $res;
		}
		
		public function bancoSelect($cri){
		    $this->db->select(array(
		        'idCatBanco',
		        'banco'
		    ));
// 		    $this->db->where(array('entidad_tipo'=>$tipo,
// 		        'activo'=>'1'
// 		    ));
		    $this->db->like('banco', $cri);
		    $res = $this->db->get('cat_banco')->result_array();
		    return $res;
		}
		public function cuentaBancoSelect($cri, $idEntidadPropiedad, $idEntidad){
		    $this->db->select(array(
		        'id_entidad_propiedad',
		        'valor'
		    ));
		    $this->db->where(array(
		        'id_entidad'=>$idEntidad
		    ));
		    $this->db->like('valor', $cri);
		    $res = $this->db->get('entidad_propiedad')->result_array();
		    return $res;
		}
		
		
		function obtener_entidades($criterio,
				$tipo,
				$col,
				$cols=array()){
			if(!empty($cols)){
				$this->db->select($cols);
			}
			$this->db->where(array('entidad_tipo'=>$tipo,
					'activo'=>'1'
			));
			$this->db->like($col, $criterio);
			$res = $this->db->get('entidad')->result_array();
			return $res;
		}
		
		public function obtenerEntidad($param){
		    
		    $totalItems = count($param['items']);
		    $tipoEntidad = $param['tipoEntidad'];
		    $x = 1;
		    $sqlR = '';
		    $cols = 'SELECT * FROM (SELECT
                 en.entidad_tipo, 
                 en.cod_entidad, 
                 en.id_entidad, 
                 en.nombre_razon_social, 
                 en.monto_credito, 
                 en.SALDO,
                 en.debe 
                     FROM entidad en ';
		    $res = NULL;
		    if(isset($param['items'])){
		        foreach ($param['items'] as $item){
		            
		            switch ($item['col']){
		                case 'cod':
		                    $sqlR.= $cols . 'WHERE en.entidad_tipo = "'. $tipoEntidad .'" and en.cod_entidad = "'. $item['val'] . '")';
		                    break;
		                case 'nom':
		                    $sqlR.= $cols . 'WHERE en.entidad_tipo = "'. $tipoEntidad .'" and en.nombre_razon_social like "%'. $item['val'] .'%"' . ')';
		                    break;
		                case 'con':
		                    $sqlR.= $cols . 'INNER JOIN entidad_propiedad ep ON ep.id_entidad = en.id_entidad
                             WHERE en.entidad_tipo = "'. $tipoEntidad .'" AND ep.id_propiedad_tipo = 4 AND ep.valor LIKE "%'. $item['val'] .'%"' . ')';
		                    break;
		            }
		            
		            if($x<$totalItems){
		                $sqlR.= ' a UNION ALL ';
		            }else{
		                $sqlR.= ' a';
		            }
		            
		            $x++;
		            
		        }
		        //log_message('debug', 'QUERY '.$sqlR);
		        $res = $this->db->query($sqlR)->result_array();
		    }
		    return $res;
		}
		
		function actualizaTipoPrecio($idEntidad){
			$this->db->update('entidad', array('tipo_precio'=>'pc'), array('id_entidad'=>$idEntidad));
			$afect = $this->db->affected_rows();
			return $afect;
		}
		
		function actualizar_propiedad($data, $id_entidad_propiedad){
			$this->db->update('entidad_propiedad', $data, array('id_entidad_propiedad'=>$id_entidad_propiedad));
			$afect = $this->db->affected_rows();
			$estado = ($afect>0) ? true : false;
			return $estado;
		}
		
		function eliminar_propiedad($id_entidad_propiedad){
			$this->db->where('id_entidad_propiedad', $id_entidad_propiedad);
			$this->db->delete('entidad_propiedad');
			$afect = $this->db->affected_rows();
			$estado = ($afect>0) ? true : false;
			return $estado;
		}
		
		public function actualizar_entidad($data, $id_entidad){
			$this->db->update('entidad', $data, array('id_entidad'=>$id_entidad));
			return $this->db->affected_rows();
		}
		
		public function afectaDebeEntidad($idEntidad, $setEnt){
		    $this->db->set('debe', $setEnt, FALSE);
		    $this->db->where('id_entidad', $idEntidad);
		    $this->db->update('entidad');
		    log_message('debug', print_r($this->db->last_query(), TRUE));
		}
		
		function eliminar_entidad($data, $id_entidad){
			$this->db->update('entidad', $data, array('id_entidad'=>$id_entidad));
			$afect = $this->db->affected_rows();
			$estado = ($afect>0) ? true : false;
			return $estado;
		}
		
		function obtener_entidad($id_entidad){
			$this->db->where('id_entidad', $id_entidad);
			$res = $this->db->get('entidad')->row_array();
			return $res;
		}
		
		#entidad por criterio
		public function getEntidad($dWhere, $cols=array()){
			if(!empty($cols)){
				$this->db->select($cols);
			}
			$query = $this->db->get_where('entidad', $dWhere)->row_array();
			return $query;
		}
		
		# listado de entidad por criterio
		function getListaEntidadCri($dWhere, $cols=array()){
			if(!empty($cols)){
				$this->db->select($cols);
			}
			$query = $this->db->get_where('entidad', $dWhere)->result_array();
			return $query;
		}
		
		#inserta registro en estado de cuenta
		function insertEstadoCuentaEntidad($dData){
			$this->db->insert('estado_cuenta_entidad', $dData);
		}
		
		#inserta registros en estado de cuenta
		function insertEstadosCuentaEntidad($dData){
			$this->db->insert_batch('estado_cuenta_entidad', $dData);
		}
		
		#inserta registros en estado de cuenta
		function updateBatchEstadosCuentaEntidad($dData){
			$this->db->update_batch('estado_cuenta_entidad', $dData, 'id_estado_cuenta_entidad');
		}
		
		# recupera listado de movimientos de estado de cuenta
		function getEdoCuentaEntidad($dWhere){
			
			$this->db->select(array(
					'ec.*',
					'tec.descripcion',
					'tec.clave',
					'oc.estado',
					'oc.fol_presupuesto',
					'oc.fol_factura',
					'oc.fol_orden',
					'oc.serie_factura',
					'oc.id_tipo_comprobante',
					'oc.serie_presupuesto',
					'us.nombre_completo as usuario',
					'ti.nombre_corto as tienda'
			));
			
			$this->db->from('estado_cuenta_entidad ec');
			
			$this->db->join('tipo_estado_cuenta tec', 'tec.id_tipo_estado_cuenta = ec.id_tipo_estado_cuenta', 'inner');
			$this->db->join('orden_c oc', 'oc.id_orden_c = ec.id_orden_c', 'left');
			$this->db->join('usuario us', 'us.id_usuario = ec.id_usuario', 'inner');
			$this->db->join('tienda ti', 'ti.id_tienda = ec.id_tienda', 'inner');
			
			$this->db->where($dWhere);
			$this->db->order_by('ec.id_estado_cuenta_entidad', 'ASC');
			$res = $this->db->get()->result_array();
			
			return $res;
		
		}
		
		# recupera documentos por entidad
		function getListDocEntidad($dWhere, $cols=array()){                                                                                                                          
			if(!empty($cols)){
				$this->db->select($cols);
			}
			$res = $this->db->get_where('orden_c', $dWhere)->result_array();
			return $res;
		}
		
		# recupera documentos por tipo de documento JOIN
		function getListDocEntidadJOIN($dWhere){
			$this->db->select(array(
				'oc.id_orden_c',
				'oc.id_tipo_comprobante',
				'tc.tipo_comprobante'		
			));
			$this->db->from('orden_c oc');
			$this->db->join('tipo_comprobante tc', 'tc.id_tipo_comprobante = oc.id_tipo_comprobante', 'inner');
			$this->db->where($dWhere);
			$res = $this->db->get()->result_array();
			return $res;
		}
		
		# recupera JOIN por entidad estado de cuenta
		function getListEdoCuentaEntJOIN($dWhere){
			$this->db->select(array('ec.*',
					'entidad.nombre_razon_social',
					'entidad.rfc',
					'entidad.cod_entidad',
					'usuario.usuario',
					'tienda.nombre_corto',
					'tienda.rfc as rfcTienda',
					'metodo_pago.metodo_pago',
					'tipo_estado_cuenta.descripcion as tipoEdoCuenta',
					'tipo_estado_cuenta.clave as claveEdoCuenta',
					'datediff(ec.fecha_vence, now()) as diasCredVig',
					'datediff(now(), ec.fecha_vence) as diasCredVen',
					'DATE_FORMAT(ec.fecha,"%d-%m-%Y") as fechaElabora',
					'condiciones_pago.condiciones_pago'
				)
			);
				
			$this->db->from('estado_cuenta_entidad ec');
			$this->db->join('entidad', 'entidad.id_entidad = ec.id_entidad', 'inner');
			$this->db->join('usuario', 'usuario.id_usuario = ec.id_usuario', 'inner');
			$this->db->join('tienda', 'tienda.id_tienda = ec.id_tienda', 'inner');
			$this->db->join('tipo_estado_cuenta', 'tipo_estado_cuenta.id_tipo_estado_cuenta = ec.id_tipo_estado_cuenta', 'inner');
			$this->db->join('metodo_pago', 'metodo_pago.id_metodo_pago = ec.id_metodo_pago', 'left');
			$this->db->join('condiciones_pago', 'condiciones_pago.id_condiciones_pago = ec.id_condiciones_pago', 'inner');
			
			$this->db->where($dWhere);
			$this->db->order_by('ec.id_estado_cuenta_entidad', 'DESC');
			$query = $this->db->get()->result_array();
			return $query;	
		}
		
		# actualiza saldo de estado de cuenta cliente
		function actualizaSadoEdoCienta($whereData, $colSal, $colPagado){
			$this->db->set('saldo',$colSal, FALSE);
			$this->db->set('total_pagado',$colPagado, FALSE);
			$this->db->set('fecha_ult_pago','NOW()', FALSE);
			$this->db->where($whereData);
			$this->db->update('estado_cuenta_entidad');
		}
		
		# recupera listado de movimientos de estado de cuenta
		function getListEdoCuentaEntidad($dWhere){
			
			$this->db->select(array('ec.*',
					'tipo_mov.tipo_movimiento'		
				)
			);
			
			$this->db->from('estado_cuenta_entidad ec');
			$this->db->join('tipo_mov', 'tipo_mov.id_tipo_mov = ec.id_tipo_mov', 'inner');
				
			$this->db->where($dWhere);
			$this->db->order_by('ec.id_estado_cuenta_entidad', 'ASC');
			$query = $this->db->get()->result_array();
			
			return $query;
			
		}
		
		# recupera listado sin join edo cuenta enti
		function getEdosCuentaEntidad($dWhere, $cols=array()){
			if(!empty($cols)){
				$this->db->select($cols);
			}
			$this->db->order_by('fecha', 'ASC'); # del mas viejo al mas nuevo
			$res = $this->db->get_where('estado_cuenta_entidad', $dWhere)->result_array();
			return $res;
		}
		
		# actializa datos id_estado_cuenta_entidad
		function updateEdoCuentaEnti($dData, $dWhere){
			$this->db->update('estado_cuenta_entidad', $dData, $dWhere);
		}
		
		public function getDireccionEntidad($dWhere){
		    $res = $this->db->select(array(
		        'en.*',
		        'cen.catEntidadDireccion'
		    ))
		      ->from('entidad_direccion en')
		      ->join('cat_entidad_direccion cen', 'cen.idCatEntidadDireccion = en.idCatEntidadDireccion', 'inner')
		      ->where($dWhere)
		      ->get()->result_array();
		    
		   //log_message('debug', 'lastQuery ' . print_r($this->db->last_query(), TRUE));
		   
		   return $res;
		}
		
		// Kardex cargos abonos
		public function getRepAuxiliarEntidad($dWhere) {
		    $res = $this->db->select(array(
		        'cpd.impSaldoAnt',
		        'cpd.impPagado',
		        'cpd.impSaldoInsoluto',
		        'cpd.saldoFinal',
		        'cpc.folio',
		        'cpc.fecha',
		        'cpc.estatus',
		        'cpc.idTipoComprobante',
		        'cpc.codMetodoPago',
		        'cpc.fechaPago',
		        'tc.tipoComprobante'
		    ))
		    ->from('cobro_pago_c cpc')
		    ->join('cobro_pago_d cpd', 'cpd.idCobroPagoC = cpc.idCobroPagoC', 'inner')
		    ->join('tipo_comprobante tc', 'tc.idTipoComprobante = cpc.idTipoComprobante', 'inner')
		    ->where($dWhere)
		    ->get()->result_array();
		    //log_message('debug', 'lastQuery ' . print_r($this->db->last_query(), TRUE));
		    return $res;
		}
		
	}

?>