<?php
defined('BASEPATH') OR exit('No direct script access allowed');

<<<<<<< HEAD
require_once APPPATH . '../vendor/autoload.php'; // Asegúrate de que la ruta es correcta
=======
require_once APPPATH . '../vendor/autoload.php'; 
>>>>>>> 6007add26cb8910a324892d6f1735686faf815c2

class Pdf extends \Mpdf\Mpdf {
    public function __construct($params = []) {
        parent::__construct($params);
    }
}
