<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/Format.php';
require APPPATH . '/model/RestOutModel.php';

use Restserver\Libraries\REST_Controller;

class Entidadesrest extends REST_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model(array(
            'entidad_model',
            'catalogos_model'
        ));
        $this->load->library(array(            
            'form_validation'
        ));
    }
    
    // reporte auxiliar por entidad
    public function getReporteAuxiliar_post() {
        
        $dData = $this->post();
        
        $this->form_validation->set_data($dData);
        if($this->form_validation->run('getReporteAuxiliar_post')) {
            
            $desde = $dData['txtDesde'];
            $hasta = $dData['txtHasta'];
            $idEntidad = (int)$dData['idEntidad'];
            $dWhere = "";
            
            if($dData['txtDesde'] != '' and $dData['txtHasta'] != '') {
                $desde = substr($dData['txtDesde'], 6, 4) . substr($dData['txtDesde'], 3, 2) . substr($dData['txtDesde'], 0, 2);
                $hasta = substr($dData['txtHasta'], 6, 4) . substr($dData['txtHasta'], 3, 2) . substr($dData['txtHasta'], 0, 2);
            } else {
                // mes actual
                $date = new DateTime('now');
                $desde = $date->format('Y') . $date->format('m') . '01'; // desde el primero de cada mes
                //$desde = $date->format('Ymd');
                $hasta = $date->format('Ymd');
            }
            
            $dWhere .= "DATE(cpc.fecha) BETWEEN '$desde' AND '$hasta' AND cpc.idEntidad=" . $idEntidad;
            
            $items =  $this->entidad_model->getRepAuxiliarEntidad($dWhere);
            
            $res = new RestOutModel();
            $res->item = $items;
            
            $this->response($res);
            
        } else {
            
            $res = new RestOutModel();
            $res->status = FALSE;
            $res->msg = 'Campos incompletos';
            $res->error = $this->form_validation->get_errores_arreglo();
            
            $this->response($res, REST_Controller::HTTP_BAD_REQUEST);
        }
        
    }
    
    public function getClientesPag_post() {
        
        $dData = $this->post();
        
        $this->form_validation->set_data($dData);
        
        if($this->form_validation->run('pagination_helper')){
            // true
            
            $this->load->helper('pagination');
            
            $dWhere = array(
                'entidad_tipo'=>'c'
            );
            
            $likeField = $dData['likeField']; // campo
            $likeMatch = $dData['likeMatch']; // valor del campo
            $pagina = $dData['pagina']; // pagina actual
            $porPagina = $dData['porPagina']; // cuantos mostrara por pagina
            
            $item = paginationPage('entidad', $pagina, $porPagina, array('cod_entidad', 'nombre_razon_social', 'rfc', 'ESTADO', 'id_entidad'), $dWhere, $likeField, $likeMatch);
            
            $res = new RestOutModel();
            $res->item = $item;
            
            $this->response($res);
            
        } else {
            // false
            
            $res = new RestOutModel();
            $res->status = FALSE;
            $res->msg = 'Hay campos incompletos';
            $res->error = $this->form_validation->get_errores_arreglo();
           
            $this->response($res, REST_Controller::HTTP_BAD_REQUEST);
            
        }
        
    }
    
    public function getEntidadById_post() {
        
        $dData = $this->post();
        
        $this->form_validation->set_data($dData);
        
        if($this->form_validation->run('get_entidad_by_id')) {
      
            $item = $this->catalogos_model->getSimpleResult(array(
                                                                    'id_entidad'=>$dData['idEntidad']
                                                                ), 'entidad', array(), 'row');
            
            $res = new RestOutModel();
            $res->item = $item;
            
            $this->response($res);
            
        } else {
            // false
            
            $res = new RestOutModel();
            $res->status = FALSE;
            $res->msg = 'Hay campos incompletos';
            $res->error = $this->form_validation->get_errores_arreglo();
            
            $this->response($res, REST_Controller::HTTP_BAD_REQUEST);
            
        }
        
    }
    
    public function saveEntidad_post(){
        
        $dData = $this->post();
        
        $this->form_validation->set_data($dData);
        
        if($this->form_validation->run('set_entidad')) {
            
            //log_message('debug', 'itemsss' . print_r($dData, TRUE));
            
            $contactos = $dData['contactos'];
            $entidad = $this->entidad_model->setFields($dData);
            $entidad->entidad_tipo = 'c';
            $entidad->activo = 1;
            $entidad->esCliente = 1;
            $idEntidad = $dData['id_entidad'];
            
            $item = $this->entidad_model->saveEntidadPro($idEntidad, (array)$entidad, $contactos);
            
            $res = new RestOutModel();
            $res->item = $item;
            
            $this->response($res);
            
        }else{
             
            $res = new RestOutModel();
            $res->status = FALSE;
            $res->msg = 'Hay campos incompletos';
            $res->error = $this->form_validation->get_errores_arreglo();
            
            $this->response($res, REST_Controller::HTTP_BAD_REQUEST);
            
        }
        
    }
    
    public function saveDireccionEntidad_post(){
        
        $dData = $this->post();
        
        if($this->form_validation->run('set_entidad')) {
            
        }else{
            
            $res = new RestOutModel();
            $res->status = FALSE;
            $res->msg = 'Hay campos incompletos';
            $res->error = $this->form_validation->get_errores_arreglo();
            
            $this->response($res, REST_Controller::HTTP_BAD_REQUEST);
            
        }
        
    }
    
    
    
}
