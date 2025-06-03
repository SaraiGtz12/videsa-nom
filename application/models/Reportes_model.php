<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Reportes_model extends CI_Model{
		function __construct(){
			parent::__construct();
			$this->load->database($GLOBALS['DEFAULT_SCHEMA']);
		}
		
		public function getUtilidad($dWhere=array()) {
			return $this->db->select(array(
					'od.clave_art',
					'ar.descripcion',
					'sum(od.cantidad) as cantidad',
					'od.costo',
					'od.precio',
					'sum(od.utilidad_porciento) as porciento',
					'sum(od.utilidad) as utilidad'
			))
		    ->from('articulo ar')
			->join('orden_d od', 'od.id_articulo = ar.id_articulo', 'inner')
			->where('od.fol_caja IS NOT NULL')
			->where($dWhere)
			->group_by(array('od.clave_art', 'ar.descripcion', 'od.costo', 'od.precio'))
			->get()->result_array();
		}
		
		public function getVentasPorVendedorCon($dWhere) {
		    $res = $this->db->select(array(
		        'dc.idUsuarioVendedor', 
		        'us.nombre_completo', 
		        'count(*) num', 
		        'sum(dc.total) as total'
		    ))
		      ->from('venta_c dc')
		      ->join('usuario us', 'us.id_usuario = dc.idUsuarioVendedor', 'left')
		      ->where($dWhere)
		      ->group_by(array('dc.idUsuarioVendedor'))
		      ->get()->result_array();
		      log_message('debug', 'getVentasPorVendedorCon ' . $this->db->last_query());
		      return $res;
		}
		
		public function getVentasPorVendedorDet($dWhere) {
		    return $this->db->select(array(
		        'dc.*',
		        'en.rfc',
		        'en.nombre_razon_social',
		        'tc.tipoComprobante'
		    ))
		    ->from('venta_c dc')
		    ->join('entidad en', 'en.id_entidad = dc.idEntidad', 'left')
		    ->join('tipo_comprobante tc', 'tc.idTipoComprobante = dc.idTipoComprobante', 'left')
		    ->where($dWhere)
		    ->order_by('dc.idUsuarioVendedor asc', 'dc.fecha asc')
		    ->get()->result_array();
		}
		
		public function getVentasPorDocumento($dWhere) {
		    return $this->db->select(array(
		        'dc.*',
		        'en.rfc',
		        'en.nombre_razon_social',
		        'tc.tipoComprobante',
		        'tc.nombreCorto as nombreCortoCompro',
		        'us.usuario as vendedor'
		    ))
		    ->from('venta_c dc')
		    ->join('entidad en', 'en.id_entidad = dc.idEntidad', 'left')
		    ->join('usuario us', 'us.id_usuario = dc.idUsuarioVendedor', 'left')
		    ->join('tipo_comprobante tc', 'tc.idTipoComprobante = dc.idTipoComprobante', 'inner')
		    ->where($dWhere)
		    ->order_by('dc.fecha asc')
		    ->get()->result_array();
		}
		
		
	}

