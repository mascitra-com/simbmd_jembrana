<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Spk_model extends MY_Model
{
	public $_table = 'spk';
	public $requird = array('nomor', 'tanggal', 'id_organisasi');

    public function __construct()
    {
        parent::__construct();
    }

    public function get_data($filter = array())
    {
    	$id = isset($filter['id_organisasi']) ? $filter['id_organisasi'] : '';
    	$keyword = isset($filter['q']) ? $filter['q'] : '';

    	if (empty($id)) {
    		return [];
    	}

    	$this->where('id_organisasi', $id);
    	$this->db->group_start();
    	$this->like('nomor', $keyword);
    	$this->or_like('uraian_pekerjaan', $keyword);
    	$this->or_like('tanggal', $keyword);
    	$this->or_like('nama_rekanan', $keyword);
    	$this->or_like('alamat_rekanan', $keyword);
    	$this->or_like('nilai', $keyword);
    	$this->db->group_end();

    	return $this->get_all();
    }
}