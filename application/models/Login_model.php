<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Login_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database($GLOBALS['DEFAULT_SCHEMA']);
    }
    
    public function getTienda($dWhere){
        return$this->db->select(
            array(
                'nombreCompleto',
                'version',
                'idKey'
            )
        )
        ->from('tienda')
        ->where($dWhere)
        ->get()->row_array();
    }
}