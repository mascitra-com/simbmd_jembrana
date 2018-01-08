<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Kegiatan_model extends MY_Model {

	public $_table = 'kegiatan';
	public $required = array('kode', 'nama', 'id_organisasi');
	
    public function __construct() {
        parent::__construct();
    }
}