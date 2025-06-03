<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Norma85_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Norma85_model');
    }

    public function index() {
    $this->load->view('template/header');  
    $this->load->view('norma85/moduloNorma85');  
    $this->load->view('template/footer'); 
}

}