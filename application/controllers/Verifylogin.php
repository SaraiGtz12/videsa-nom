<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Verifylogin extends CI_Controller{
		
		private $id_usuario=0;
		private $password_cambiado;
		
		function __construct(){
			parent::__construct();
			$this->load->helper(array(
			    'security',
			    'url'
			));
			$this->load->model(array(
			    'verifylogin_model',
				'tienda_model'
			));
			$this->load->library(array(
			    'user_agent'
			));
		}
		public function index(){
			
			$this->load->library('form_validation');
			
			if(!$this->form_validation->run('usuario_get')){
				$this->load->view('login_view');
				
			}else{
				
				# historial de acceso
				$agent = $this->agent->browser() . ' ' . $this->agent->version();
				
				$remote_ip = $this->input->ip_address();
				
				$data = array('id_usuario'=>$this->id_usuario,
						'remote_ip'=>$remote_ip,
						'agent'=>$agent
				);
				
				$this->verifylogin_model->insertaHistorial($data);
				
				$password_cambiado = $this->password_cambiado;
				
				if($password_cambiado==1){
					#cambio de password
					redirect('resetpassword', 'refresh');
				}else{
					#panel principal
					redirect('dashboard', 'refresh');
				}
				
			}
		}
		public function check_database($password) {
			$username = $this->input->post('login-username');
			
			# datos del usuario
			$res = $this->verifylogin_model->check_database($username, $password);
			if($res!=NULL) {
				$id_usuario = $res['id_usuario'];
				# menus
				$menus = $this->verifylogin_model->seleccionaMenusUsuario($id_usuario);
				
				$tiendas = $this->tienda_model->getListTiendas(NULL, array('idTienda','nombreCorto'));
				# tiendas para combos
				# datos de la tienda
				$dRaSoc = $this->tienda_model->getDatosTienda(array(
					'idTienda'=>$res['id_tienda']), array('repLegal')
				);
								
				$sess_array = array('id_usuario_nivel'=>$res['id_usuario_nivel'],
				'id_usuario'     	 =>$id_usuario, 
				'nombre_completo'	 =>$res['nombre_completo'],
				'id_tienda'      	 =>$res['id_tienda'],
				'tienda'		 	 =>$res['tienda'],
				'tiendaTelefono' 	 =>$res['tiendaTelefono'],
				'menus'  		 	 =>$menus,
				'usuario' 		 	 =>$res['usuario'],
				'id_caja' 		 	 =>$res['id_caja'],
				'razon_social_tienda'=>$dRaSoc->repLegal,
				'listaTiendas'       =>$tiendas,
				'apiKey'	   		 =>$res['apiKey'],
				'idEntidad'	   		 =>$res['idEntidad'],
				'version'	   		 =>$res['version'],
				'idKey'		   		 =>'mobile2021v1.0'
				);
				
				$this->session->set_userdata('logged_in', $sess_array);
				$this->id_usuario = $id_usuario;
				$this->password_cambiado = $res['password_cambiado'];
				
				// datos de acceso
				log_message('debug', 'Usuario_Login ' . print_r($sess_array, TRUE));
				log_message('debug', 'Browser ' . $this->agent->browser() . 
				    ' browserVersion ' . $this->agent->version() .
				    ' platform' . $this->agent->platform() .
				    ' full_user_agent_string ' . $_SERVER['HTTP_USER_AGENT'] . 
				    ' IP ' . $this->input->ip_address()
				);
				
				return TRUE;
			} else {
			    log_message('debug', 'Usuario o password invalido Usuario :' . $username . ' Password ' . $password);
				$this->form_validation->set_message('check_database', 'Usuario o password inv&aacute;lido');
				return false;
			}
		}
	
	}
?>