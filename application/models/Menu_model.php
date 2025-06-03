<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Menu_model extends CI_Model{
		function __construct(){
			parent::__construct();
			$this->load->database($GLOBALS['DEFAULT_SCHEMA']);
		}
		function __destruct(){
			//unset($this);
		}
		function listaSubMenus($id_menu){
			$this->db->where('id_menu',$id_menu);
			$res = $this->db->get('menu_sub');
			return $res->result_array();
		}
		function listaMenus(){
			return $this->db->get_where('menu', array('activo'=>1))
			            ->result_array();
		}
		function listaSubMenusUsuario($id_usuario, $id_menu){
			$this->db->where(array('id_usuario'=>$id_usuario,
					'id_menu'=>$id_menu
			));
			$res = $this->db->get('usuario_menu_sub');
			return $res->result_array();
		}
		function insert_usuario_menu_sub($data){
			$this->db->insert_batch('usuario_menu_sub', $data);
		}
		function delete_usuario_menu_sub($data_delete){
			$this->db->delete('usuario_menu_sub',$data_delete);
		}
	}
?>