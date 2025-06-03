<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	interface ModelInterface{
    	public function get($id);
    	public function save($data);
    	public function update($data, $id);
    	public function delete($idArt, $idUs);
	}
?>