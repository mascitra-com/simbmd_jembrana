<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap_aset extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('report/Rekap_aset_model', 'report');
		$this->load->model('organisasi_model', 'organisasi');
	}
	
	public function index()
	{
		$data['organisasi'] = $this->organisasi->get_many_by(array('jenis'=>4));
		$this->render('modules/report/rekap_aset/index', $data);
	}

	public function cetak()
	{
		$input = $this->input->post();
		if($input['id_organisasi'])
    		$input['upb']	= $this->organisasi->get($input['id_organisasi'])->nama;
		else
            $input['upb']	= 'SEMUA UPB';

        $data['detail'] = $input;
		$data['rekap']  = $this->report->get_rekapitulasi_aset($input['jenis'], $input['id_organisasi']);

		$this->render('modules/report/rekap_aset/cetak', $data);
	}
}