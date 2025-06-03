<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Usuarios extends CI_Controller{
	    
		function __construct(){
			parent::__construct();
			$this->load->helper('form');
			$this->load->model(array('usuario_model','menu_model'));
		}
		
		public function index() {
			if($this->session->userdata('logged_in')) {
				$data_session = $this->session->userdata('logged_in');
				$data_menus['menus'] = $data_session['menus'];
				$id_usuario = $data_session['id_usuario'];
				$data_menus_sub['menus'] = $this->usuario_model->subMenusUsuario($id_usuario, 8);	// menu_id : 8 - Table menu_sub
				$this->load->view('template/header',$data_menus);
				$this->load->view('usuarios/menu_usuario',$data_menus_sub);
				$this->load->view('template/footer');
			}else{
				redirect('login', 'refresh');
			}
		}
		
		# vista nuevo usuario
		public function nuevoUsuario() {
			if($this->session->userdata('logged_in')){
				$data_session = $this->session->userdata('logged_in');
				$data_menus['menus'] = $data_session['menus'];
				$data["title"] = "Alta de Usuario";
				$data["id_usuario"] = 0;
				$data['sucursales'] = $this->usuario_model->getSucursales();

				$this->load->view('template/header',$data_menus);
				$this->load->view('usuarios/usuario', $data);
				$this->load->view('template/footer');
			}else{
				redirect('login', 'refresh');
			}
		}
		
		# vista edita usuario
		public function editaUsuario() {
			if($this->session->userdata('logged_in')){
				$data_session = $this->session->userdata('logged_in');
				$data_menus['menus'] = $data_session['menus'];
				$data["title"] = "Edici&oacute;n de Usuario";
				$id_usuario = $this->uri->segment(3);
				$data["id_usuario"] = $id_usuario;
				$this->load->view('template/header',$data_menus);
				$this->load->view('usuarios/usuario', $data);
				$this->load->view('template/footer');
			}else{
				redirect('login', 'refresh');
			}
		}
		
		# vista lista de usuarios
		function viewUsuarios(){
			if($this->session->userdata('logged_in')){
				$data_session = $this->session->userdata('logged_in');
				$data_menus['menus'] = $data_session['menus'];
				$this->load->view('template/header',$data_menus);
				$this->load->view('usuarios/lista_usuarios');
				$this->load->view('template/footer');
			}else{
				redirect('login', 'refresh');
			}
		}
		# guardar usuario
		function guardaUsuario() {
			if($this->session->userdata('logged_in')){
				
			    $data_session = $this->session->userdata('logged_in');
				$id_usuario_alta = $data_session['id_usuario'];
				$id_tienda = $this->input->post('us-sucursal');
				$id_usuario = $this->input->post('id_usuario');
				$usuario = $this->input->post('us-usuario');
				$nombreCompleto = strtoupper($this->input->post('us-nombre-completo'));
				$renuevaPassword = ($this->input->post('us-renueva-pw') != "") ? 1 : 0;
				$correo = $this->input->post('art-correo');
				$telefono = $this->input->post('art-telefono');
				$id_usuario_nivel = $this->input->post('us-usuario-nivel');
				$puesto = $this->input->post('us-puesto');
				$direccion = strtoupper($this->input->post('art-direccion'));
				$inicialesUsuario = strtoupper($this->input->post('inicialesUsuario'));
				
				$data = array('id_tienda'=>$id_tienda,
						'usuario'=>$usuario,
						'nombre_completo'=>$nombreCompleto,
						'renueva_password'=>$renuevaPassword,
						'correo'=>$correo,
						'telefono'=>$telefono,
						'id_usuario_nivel'=>$id_usuario_nivel,
						'puesto'=>$puesto,
						'direccion'=>$direccion,
						'id_usuario_alta'=>$id_usuario_alta,
				        'inicialesUsuario'=>$inicialesUsuario
				);
				$info_type = "success";
				$msg="";
				if($id_usuario==0){
					# Nuevo Usuario
				    $data['password'] = md5($usuario);
					$id_usuario = $this->usuario_model->insertaUsuario($data);
					$msg = "Usuario dado de alta correctamente, el password es el mismo que el usuario, selecciona los menus a los que tendra acceso";
				}else{
					# Editar usuario
					$this->usuario_model->editaUsuario($data, $id_usuario);
					$msg = "Usuario editado correctamente";
				}
				# busqueda de menus para asignacion de menu
				$itemsMenu = $this->menu_model->listaMenus();
				$req_arr = array("id_usuario"=>$id_usuario, "info_type"=>$info_type, "msg"=>$msg, "itemsMenu"=>$itemsMenu);
				echo json_encode($req_arr);
			}else{
				echo "error";
			}
		}
		#eliminar usuario
		function elimnarUsuario(){
			$idUsuario = $this->input->post('idUsuario');
			$this->usuario_model->eliminaUsuario($idUsuario);
			$req_arr = array("info_type"=>"success", "msg"=>"Registro eliminado correctamente");
			echo json_encode($req_arr);
		}
		#lista menus
		function listaMenu(){
			$id_menu = $this->input->post('id_menu');
			$id_usuario = $this->input->post('id_usuario');
			$items = $this->menu_model->listaSubMenus($id_menu);
			$itemsUsuario = $this->menu_model->listaSubMenusUsuario($id_usuario, $id_menu);
			$r_array = array("items"=>$items,"items_usaurio_menu"=>$itemsUsuario);
			echo json_encode($r_array);
		}
		# Guarda los menus al que tiene derecho el usuario
		function guardaUsuarioMenu(){
			$id_menu = $this->input->post('id_menu');
			$id_menu_sub = ($this->input->post('id_menu_sub')!="") ? $this->input->post('id_menu_sub') : NULL;
			$id_usaurio = $this->input->post('id_usuario');
			$data_delete = array('id_usuario'=>$id_usaurio, 'id_menu'=>$id_menu);
			$this->menu_model->delete_usuario_menu_sub($data_delete);
			if($id_menu_sub!=NULL){
				$data_insert = array();
				foreach ($id_menu_sub as $sub_menu){
					$row_in = array('id_usuario'=>$id_usaurio,
							'id_menu'=>$id_menu,
							'id_menu_sub'=>$sub_menu
					);
					array_push($data_insert, $row_in);
				}
				$this->menu_model->insert_usuario_menu_sub($data_insert);
			}
			$arr_ret = array('info_type'=>'success', 'msg'=>'Men&uacute;s asignados correctamente');
			echo json_encode($arr_ret);
		}
		# datos del usuario
		public function datosUsuario() {
			if($this->input->is_ajax_request()) {
				$id_usuario = $this->input->post('id_usuario');
				$usuario = $this->usuario_model->mostrarUsuario($id_usuario);
				$itemsMenu = $this->menu_model->listaMenus();
				$return_a = array('usuario'=>$usuario, 'itemsMenu'=>$itemsMenu);
				echo json_encode($return_a);
			}else{
				 show_404();
			}
		}
		#listado de usuarios
		function listadoUsuarios(){
			if($this->input->is_ajax_request()){
				$id_tienda = $this->input->post('id_tienda');
				$criterio = $this->input->post('criterio');
				$usuarios = $this->usuario_model->listadoUsuarios($id_tienda, $criterio);
				$return_arr = array('items'=>$usuarios);
				echo json_encode($return_arr);
			}else{
				 show_404();
			}
		}
		#listado accesos
		function listadoAccesos(){
			if($this->input->is_ajax_request()){
				$id_usuario = $this->input->post('id_usuario');
				$items = $this->usuario_model->listadoUsuariosAcceso($id_usuario);
				$return_a = array('items'=>$items);
				echo json_encode($return_a);
			}else{
				show_404();
			}
		}
		#guarda prop
		function guardaPropiedad(){
			if($this->input->is_ajax_request()){
				$id_usuario = $this->input->post('id_usuario');
				$usuario = $this->usuario_model->mostrarUsuario($id_usuario);
				$reset_pw = ($this->input->post('us-renueva-pw')!="") ? $this->input->post('us-renueva-pw') : 0;
				$desac_acceso = ($this->input->post('us-desactiva-acc')!="") ? 0 : 1;
				$observacion = $this->input->post('us-observacion');
				$data = array("password_cambiado"=>$reset_pw,
						"activo"=>$desac_acceso,
						"observacion"=>$observacion,
						"password"=>md5($usuario->usuario)
				);
				$this->usuario_model->actualizaPropiedad($data, $id_usuario);
				$arr_ret = array('info_type'=>'success', 'msg'=>'Registro actualizado correctamente');
				echo json_encode($arr_ret);
			}else{
				show_404();
			}	
		}
		function validaUsuario(){
			$usuario = $this->input->post('usuario');
			$existe = $this->usuario_model->validaUsuario($usuario);
			if($existe){
				$info_type="warning";
				$msg = "El usuario ya existe favor de verificarlo";
			}else{
				$info_type="success";
				$msg = "El usuario esta disponible";
			}
			$return_a = array('existe'=>$existe,'info_type'=>$info_type,'msg'=>$msg);
			echo json_encode($return_a);
		}
		
		# establece idTienda
		function setIdTienda(){
			if($this->input->is_ajax_request()){
				if($this->session->userdata('logged_in')){
					$data_session = $this->session->userdata('logged_in');
					$idUsuarioMod = $data_session['id_usuario'];
					$idTienda = $this->input->post('idTienda');
					
					$uData = array('id_tienda'=>$idTienda,
							'id_usuario_mod'=>$idUsuarioMod,
							'fecha_mod'=>date('Y-m-d H:i:s')
					);
					
					$this->usuario_model->updateUsuarioModel($uData, $idUsuarioMod);
					
					echo json_encode(array('msg'=>'success'));
				}else{
					show_404();
				}
			}else{
				show_404();
			}
		}
		
		# usuarios select2
		public function usuariosSelect(){
		    if($this->input->is_ajax_request()){
		        $search = $this->input->post('search');
		        $result = $this->usuario_model->usuariosSelect($search);
		        echo json_encode($result);
		    }else{
		        show_404();
		    }
		}


		public function getSucursales()
		{

		}

	}
?>