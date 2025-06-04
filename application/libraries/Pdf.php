<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '../vendor/autoload.php'; // Asegúrate de que la ruta es correcta

class Pdf extends \Mpdf\Mpdf {
    public function __construct($params = []) {
        parent::__construct($params);
    }
}
