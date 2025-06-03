<?php
	if (!defined('BASEPATH')) exit('No direct script access allowed');
	class Tienda_model extends CI_Model{
		function __construct(){
			parent::__construct();
			$this->load->database($GLOBALS['DEFAULT_SCHEMA']);
		}
		function __destruct(){
			//unset($this);
		}
		# Recupera datos de tienda		
		function getDatosTienda($dWhere, $cols=NULL){
			//log_message('error', print_R($dWhere,TRUE));
			if(!empty($cols)){
				$this->db->select($cols);
			}
			$res = $this->db->get_where('tienda', $dWhere)->row();
			return $res;
		}
		
		# recupera lista de tiendas
		function getListTiendas($dWhere, $cols=NULL){
			$res;
			if(!empty($cols)){
				$this->db->select($cols);
			}
			if(!empty($dWhere)){
				$res = $this->db->get_where('tienda', $dWhere)->row_array();
			}else{
				$res = $this->db->get('tienda')->result_array();
			}
			return $res;
		}

	}
?>