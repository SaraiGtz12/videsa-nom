<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Resetpassword_model extends CI_Model{
		function __construct(){
			parent::__construct();
			$this->load->database($GLOBALS['DEFAULT_SCHEMA']);
		}
		function __destruct(){
			//unset($this);
		}
		function reset($data, $id_usuario){
			$this->db->where('id_usuario', $id_usuario);
			$this->db->update('usuario', $data);
			$affect = $this->db->affected_rows();
			return $affect;
		}
	}
?>