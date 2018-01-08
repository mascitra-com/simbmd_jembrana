<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maps_data extends MY_Model {

	public function get_all(){
		return $this->db->get('tb_lokasi')->result_array();
	}
}
