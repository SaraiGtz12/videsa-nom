<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/Format.php';
require APPPATH . '/model/RestOutModel.php';
use Restserver\Libraries\REST_Controller;

class Usuariosrest extends REST_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->helper(array(
            'security',
            'url'
        ));
        $this->load->model(array(
            'usuario_model',
            'menu_model',
            'catalogos_model'
        ));
        $this->load->library(array(
            'form_validation'
        ));
    }
    
    public function updateUserData_post(){ 
        $dData =  $this->post();
        
        if($this->form_validation->run('usuario_model')) {
            
            
            
            
        }else{
            
            $res = new RestOutModel();
            $res->status = FALSE;
            $res->msg = 'Campos obligatorios';
            $res->error = $this->form_validation->get_errores_arreglo();
            $this->response($res, REST_Controller::HTTP_BAD_REQUEST);
            
        }
        
    }
    
    public function validatePassword_post(){
        $dData =  $this->post();
        if($this->form_validation->run('validatePassword_post')) {
            
            $idUsuario = $dData['idUsuario'];
            $password = $dData['password'];
            
            $dWhere = array(
                'id_usuario'=> $idUsuario,
                'password'=>md5($password)
            );
            
            $item = $this->usuario_model->getUser($dWhere, array('id_usuario'));
            
            $res = new RestOutModel();
            $res->item = $item;
            
            $this->response($res);
            
        }else{
            
            $res = new RestOutModel();
            $res->status = FALSE;
            $res->msg = 'Campos obligatorios';
            $res->error = $this->form_validation->get_errores_arreglo();
            $this->response($res, REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }
    
    public function getUserData_post(){
        $dData =  $this->post();
        
        if($this->form_validation->run('get_usuario')) {
               
            $idUsuario = $dData['idUsuario'];
            
            $item = $this->usuario_model->mostrarUsuario($idUsuario);
            
            $res = new RestOutModel();
            $res->item = $item;
            
            $this->response($res);
            
        }else{
            
            $res = new RestOutModel();
            $res->status = FALSE;
            $res->msg = 'Campos obligatorios';
            $res->error = $this->form_validation->get_errores_arreglo();
            $this->response($res, REST_Controller::HTTP_BAD_REQUEST);
            
        }
        
    }
    
    public function resetPassword_post(){
        $dData =  $this->post();
        
        if($this->form_validation->run('get_usuario')) {
            
            $idUsuario = $dData['idUsuario'];
            $password = $dData['password'];
            
            $dWhere = array(
                'id_usuario'=> $idUsuario
            );
            
            $dData = array(
                'password'=>md5($password),
                'fecha_mod'=>date('Y-m-d H:i:s')
            );
            
            $this->usuario_model->resetPassword($dWhere, $dData);
            
            $this->response(new RestOutModel());
            
        }else{
            
            $res = new RestOutModel();
            $res->status = FALSE;
            $res->msg = 'Campos obligatorios';
            $res->error = $this->form_validation->get_errores_arreglo();
            $this->response($res, REST_Controller::HTTP_BAD_REQUEST);
            
        }
        
    }
    
    public function saveUserData_post() {
        
        $dData =  $this->post();
        
        if($this->form_validation->run('usuario_save')) {
            
            $idUsuario = $dData['idUsuario'];
            $password = $dData['password'];
            
            $dWhere = array(
                'id_usuario'=> $idUsuario
            );
            
            $dData = array(
                'password'=>md5($password),
                'fecha_mod'=>date('Y-m-d H:i:s')
            );
            
            $this->usuario_model->resetPassword($dWhere, $dData);
            
            $this->response(new RestOutModel());
            
        } else {
            
            $res = new RestOutModel();
            $res->status = FALSE;
            $res->msg = 'Campos obligatorios';
            $res->error = $this->form_validation->get_errores_arreglo();
            $this->response($res, REST_Controller::HTTP_BAD_REQUEST);
            
        }
        
    }
    
    public function validaIniciales_post() {
        
        $dData =  $this->post();
        
        if($this->form_validation->run('validaIniciales_post')) {
            
            $iniciales = $dData['inicialesUsuario'];
            
            $item = $this->catalogos_model->getSimpleResult(array('inicialesUsuario'=>$iniciales), 'usuario', array('usuario'), 'row');
            
            $res = new RestOutModel();
            $res->item = $item;
            $this->response($res);
            
        } else {
            
            $res = new RestOutModel();
            $res->status = FALSE;
            $res->msg = 'Campos obligatorios';
            $res->error = $this->form_validation->get_errores_arreglo();
            $this->response($res, REST_Controller::HTTP_BAD_REQUEST);
            
        }
        
    }
         
}