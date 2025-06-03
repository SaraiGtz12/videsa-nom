<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Verifylogin_model extends CI_Model{
		function __construct(){
			parent::__construct();
			$this->load->database($GLOBALS['DEFAULT_SCHEMA']);
		}
		function check_database($username, $password){
			return $this->db->select(array(
			        'usuario.id_usuario_nivel',
					'usuario.id_usuario',
					'usuario.nombre_completo',
					'usuario.usuario',
					'usuario.id_tienda',
					'usuario.password_cambiado',
					'usuario.id_caja',
			        'tienda.idEntidad',
					'tienda.nombreCompleto as tienda',
			        'tienda.telefono as tiendaTelefono',
			        'tienda.rfc',
			        'tienda.direccion',
			        'tienda.codRegimenFiscal',
			        'tienda.apiKey',
			        'tienda.idKey',
			        'tienda.cp',
			        'tienda.version',
			        'tienda.idCatVaInvVenta',
			        'tienda.idCatVaInvCompra'
			        //'crf.regimenFiscal'
			))
			->from('usuario')
			->join('tienda', 'tienda.idTienda = usuario.id_tienda', 'inner')
			//->join('cat_regimen_fiscal crf', 'tienda.codRegimenFiscal = crf.codRegimenFiscal', 'left')
			->where(array('usuario'=>$username,
					'password'=>md5($password),
					'activo'=>1
			))
			->get()->row_array();
		}
		function insertaHistorial($data){
			$this->db->set('fecha', 'NOW()', FALSE);
			$this->db->insert('usuario_acceso',$data);
		}
		
		public function seleccionaMenusUsuario($id_usaurio) {
		    return $this->db->select(array(
		        'menu_sub.url',
		        'menu_sub.urlAddItem',
		        'menu_sub.id_menu',
		        'menu_sub.descripcion as menu'
		    ))
		    ->from('usuario_menu_sub usm')
		    ->join('menu_sub', 'menu_sub.id_menu_sub = usm.id_menu_sub', 'join')
		    ->where(array('id_usuario'=>$id_usaurio))
		    ->order_by('usm.id_menu', 'ASC')
		    ->get()->result_array();
// 			$sql = "
// 					SELECT  
//                     	menu_sub.url,
//                         menu_sub.urlAddItem,
//                     	menu_sub.id_menu,
//                         menu_sub.descripcion as menu
//                     FROM usuario_menu_sub usm
//                     INNER JOIN menu_sub ON menu_sub.id_menu_sub = usm.id_menu_sub
//                     where id_usuario = $id_usaurio
//                     order by usm.id_menu
// 					";
// 			$res = $this->db->query($sql);
// 			return $res->result_array();
		}
	}
?>