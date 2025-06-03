<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Usuario_model extends CI_Model{
		function __construct(){
			parent::__construct();
			$this->load->database($GLOBALS['DEFAULT_SCHEMA']);
		}
		function __destruct(){
			//unset($this);
		}	
		function insertaUsuario($data){
			$this->db->set('fecha_alta', 'NOW()', FALSE);
			$this->db->insert('usuario', $data);
			return $this->db->insert_id();
		}
		function eliminaUsuario($idUsuario){
			$this->db->where('id_usuario', $idUsuario);
			$this->db->update('usuario', array("activo"=>0));
			$affect = $this->db->affected_rows();
			return $affect;
		}
		function editaUsuario($data, $id_usuario){
			$this->db->where('id_usuario', $id_usuario);
			$this->db->update('usuario', $data);
			$affect = $this->db->affected_rows();
			return $affect;
		}
		public function mostrarUsuario($id_usaurio) {
			return $this->db->where('id_usuario', $id_usaurio)
			         ->get('usuario')->row();
		}
		public function getUser($dWhere, $cols=array()) {
		    $cols = (empty($cols)) ? array('*') : $cols;
		    return $this->db->select($cols)
		      ->from('usuario')
		      ->where($dWhere)
		      ->get()->row_array();
		}


		public function getSucursales()
		{
			$this->db->select("*");
			$query = $this->db->get("tienda");
			return $query->result();
		}



		public function listadoUsuarios($id_tienda, $criterio) {
			return $this->db->select(array('usuario.id_usuario',
					'usuario.nombre_completo',
					'usuario.puesto',
					'usuario.activo',
					'usuario.password_cambiado',
					'usuario.observacion',
			        'usuario.inicialesUsuario',
			        'usuario.usuario',
					'tienda.nombreCorto as tienda',
					'usuario_nivel.descripcion as perfil'
			))
			->from('usuario')
			->join('tienda', 'tienda.idTienda = usuario.id_tienda', 'inner')
			->join('usuario_nivel', 'usuario_nivel.id_usuario_nivel = usuario.id_usuario_nivel', 'inner')
			->where(array(
			    //'usuario.id_tienda'=>$id_tienda,
				'usuario.activo'=>1
			))
			->like('usuario.nombre_completo', $criterio)
			->get()->result_array();
		}
		function listadoUsuariosAcceso($id_usuario) {
			$this->db->where('id_usuario',$id_usuario);
			$this->db->order_by('fecha', 'DESC');
			$res = $this->db->get('usuario_acceso', 5);
			return $res->result_array();
		}
		function actualizaPropiedad($data, $id_usuario){
			$this->db->where('id_usuario', $id_usuario);
			$this->db->update('usuario', $data);
			$affect = $this->db->affected_rows();
			return $affect;
		}
		function validaUsuario($usuario){
			$this->db->where('usuario', $usuario);
			$res = $this->db->get('usuario');
			return ($res->num_rows()>0) ? true : false;
		}
		function subMenusUsuario($idUsuario, $idMenu) {
			$sql = "
					SELECT 
						ms1.descripcion,
					    ms1.url
					FROM usuario_menu_sub ums
					INNER JOIN menu_sub ms1 ON ms1.id_menu_sub = ums.id_menu_sub
					WHERE ums.id_usuario = $idUsuario AND ums.id_menu = $idMenu
			";
			$res = $this->db->query($sql);
			return $res->result_array();
		}
		function updateUsuarioModel($data, $idUsuario) {
			$this->db->update('usuario', $data, array('id_usuario' => $idUsuario));
		}
		
		public function usuariosSelect($criterio) {
		    return $this->db->select(array(
		        'id_usuario',
		        'nombre_completo'
		    ))
		    ->where(array('activo'=>'1'))
		    ->like('nombre_completo', $criterio)
		    ->get('usuario')->result_array();
		}
		
		public function resetPassword($dWhere, $dData) {
		    $this->db->update('usuario', $dData, $dWhere);
		}
		
		
	}
?>