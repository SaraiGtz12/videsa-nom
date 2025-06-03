<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Dashboard_model extends CI_Model{
		function __construct(){
			parent::__construct();
			$this->load->database($GLOBALS['DEFAULT_SCHEMA']);
		}
		
		function listado_ordenes($id_usuario){
			$this->db->select('orden_c.*');
			$this->db->select('entidad.nombre_razon_social');
			$this->db->select('entidad.rfc');
			$this->db->from('orden_c');
			$this->db->join('entidad', 'entidad.id_entidad = orden_c.id_entidad', 'left');
			$query = $this->db->get();
			return $query->result_array();
		}
	}
?>