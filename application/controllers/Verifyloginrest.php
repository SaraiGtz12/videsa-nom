<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/Format.php';
require APPPATH . '/model/RestOutModel.php';
use Restserver\Libraries\REST_Controller;

class Verifyloginrest extends REST_Controller{
    
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
            'user_agent',
            'form_validation'
        ));
    }
    
    public function veryfyUser_post(){
        $dData =  $this->post();
        
        if($this->form_validation->run('usuario_veryfi')) {
                
                $username = $dData['login-username'];
                $password = $dData['login-password1'];
                $defaultSchema = $dData['defaultSchema'];
                
                $res = $this->verifylogin_model->check_database($username, $password);
                if($res != NULL) {
                    
                    $id_usuario = $res['id_usuario'];
                    
                    # menus
                    $menus = $this->verifylogin_model->seleccionaMenusUsuario($id_usuario);
                    
                    $tiendas = $this->tienda_model->getListTiendas(NULL, array('idTienda','nombreCorto'));
                    
                    # tiendas para combos
                    # datos de la tienda
                    
                    $dRaSoc = $this->tienda_model->getDatosTienda(array(
                        'idTienda'=>$res['id_tienda']), array('repLegal')
                        );
                    
                    $sess_array = array(
                        'id_usuario_nivel'=>$res['id_usuario_nivel'],
                        'id_usuario' =>$id_usuario,
                        'nombre_completo'=>$res['nombre_completo'],
                        'id_tienda'=>$res['id_tienda'],
                        'tienda'=>$res['tienda'],
                        //'tiendaTelefono'=>$res['tiendaTelefono'],
                        'menus'=>$menus,
                        'usuario'=>$res['usuario'],
                        'id_caja'=>$res['id_caja'],
                        'razon_social_tienda'=>$dRaSoc->repLegal,
                        'listaTiendas'=>$tiendas,
                        //'rfc'=>$res['rfc'],
                        'direccion'=>$res['direccion'],
                        //'codRegimenFiscal'=>$res['codRegimenFiscal'],
                        //'regimenFiscal'=>$res['regimenFiscal'],
                        //'cp'=>$res['cp'],
                        'apiKey'=>$res['apiKey'],
                        'idEntidad'=>$res['idEntidad'],
                        'version'=>$res['version'],
                        'idKey'  =>'mobile2021v1.0'
                    );
                    
                    $this->session->set_userdata('logged_in', $sess_array);
                    $id_usuario = $id_usuario;
                    $password_cambiado = $res['password_cambiado'];
                    
                    // datos de acceso
                    log_message('debug', 'Usuario_Login ' . print_r($sess_array, TRUE));
                    log_message('debug', 'Browser ' . $this->agent->browser() .
                        ' browserVersion ' . $this->agent->version() .
                        ' platform' . $this->agent->platform() .
                        ' full_user_agent_string ' . $_SERVER['HTTP_USER_AGENT'] .
                        ' IP ' . $this->input->ip_address()
                    );
                
                
                    # historial de acceso
                    $agent = $this->agent->browser() . ' ' . $this->agent->version();
                    
                    $remote_ip = $this->input->ip_address();
                    
                    $data = array(
                        'id_usuario'=>$id_usuario,
                        'remote_ip'=>$remote_ip,
                        'agent'=>$agent
                    );
                    
                    $this->verifylogin_model->insertaHistorial($data);
                    
                    //$password_cambiado = $this->password_cambiado;
                    
                    if($password_cambiado ==1 ){
                        #cambio de password

                        $this->response(array(
                            'status'=>TRUE,
                            'url'=>base_url().'index.php/resetpassword/'
                        ));
                        
                    } else {
                        #panel principal

                        $this->response(array(
                            'status'=>TRUE,
                            'url'=>base_url() . 'index.php/dashboard/'
                        ));
                        
                    }
            
            } else {
                
                $res = new RestOutModel();
                $res->status = FALSE;
                $res->msg = 'Usuario o password incorrectos';
                $res->error = $this->form_validation->get_errores_arreglo();
                $this->response($res, REST_Controller::HTTP_BAD_REQUEST);
                
            }
            
        }else{
            
            $res = new RestOutModel();
            $res->status = FALSE;
            $res->msg = 'Ingresa el usuario y el password';
            $res->error = $this->form_validation->get_errores_arreglo();
            $this->response($res, REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }
     
}