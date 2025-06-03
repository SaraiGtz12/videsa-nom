<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Altas_colaboradores_model extends CI_Model {


function getPosiciones()
{
	$this->db->select("*");
	$this->db->from("cat_posiciones");
	$resultado = $this->db->get();
	return $resultado->result();
}
	
function getTurnos()
{
	$this->db->select("*");
	$this->db->from("cat_turnos");
	$resultado = $this->db->get();
	return $resultado->result();
}	


function getDeptos()
{
	$this->db->select("*");
	$this->db->from("cat_departamentos");
	$resultado = $this->db->get();
	return $resultado->result();
}	



function getAreas()
{
	$this->db->select("*");
	$this->db->from("cat_areas");
	$resultado = $this->db->get();
	return $resultado->result();
}	


function getCentroDeCostos()
{
	$this->db->select("*");
	$this->db->from(" cat_centroDeCostos");
	$resultado = $this->db->get();
	return $resultado->result();
}	

}

/* End of file Altas_colaboradores_model.php */
/* Location: ./application/models/Altas_colaboradores_model.php */