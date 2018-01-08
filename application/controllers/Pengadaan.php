<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengadaan extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Organisasi_model', 'organisasi');
	}
	
	public function index()
	{
		$data['organisasi'] = $this->organisasi->get_data(array('jenis'=>4));
		$this->render('modules/pengadaan/index', $data);
	}

	public function detail()
	{
		$this->render('modules/pengadaan/detail');
	}

	public function sp2d()
	{
		$this->render('modules/pengadaan/sp2d');
	}

	public function sp2d_penunjang()
	{
		$this->render('modules/pengadaan/sp2d_penunjang');
	}

	public function rincian()
	{
		$this->render('modules/pengadaan/rincian');
	}
}