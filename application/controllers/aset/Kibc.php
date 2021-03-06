<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kibc extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('aset/Kibc_model', 'kib');
		$this->load->model('Organisasi_model', 'organisasi');
		$this->load->model('Kategori_model', 'kategori');
		$this->load->library('pagination');
	}
	
	public function index()
	{
		$filter = $this->input->get();
		$data['organisasi'] = $this->organisasi->get_data(array('jenis'=>4));
		$filter['id_organisasi'] = isset($filter['id_organisasi'])?$filter['id_organisasi']:'';
		
		# Jika bukan superadmin
		if (!$this->auth->get_super_access()) {
			$filter['id_organisasi'] = $this->auth->get_id_organisasi();
			$data['organisasi'] 	 = $this->organisasi->get_many_by('id', $filter['id_organisasi']);
		}

		$result 			= $this->kib->get_data($filter);
		$data['kib'] 		= $result['data'];
		$data['statistic'] 	= $this->kib->get_statistic($filter['id_organisasi']);
		$data['pagination'] = $this->pagination->get_pagination($result['data_count'], $filter, 'aset/'.get_class($this));
		$data['filter'] 	= (!empty($filter) ? $filter : array('id_organisasi'=>''));

		$this->render('modules/aset/kibc/index', $data);
	}

	public function add($id = NULL)
	{
		if(empty($id)) {
			$this->message('Pilih organisasi terlebih dahulu', 'danger');
			$this->go('aset/kibc');
		}

		$data['org'] = $this->organisasi->get($id);
		$data['kat'] = $this->kategori->get_data_list(array('sub_dari'=>NULL));
		$this->render('modules/aset/kibc/form', $data);
	}

	public function edit($id = NULL)
	{
		if(empty($id)) {
			$this->message('Pilih organisasi terlebih dahulu', 'danger');
			$this->go('aset/kibc');
		}

		$data['kib'] = $this->kib->get($id);
		$data['kib']->id_kategori = $this->kategori->get($data['kib']->id_kategori);
		$data['org'] = $this->organisasi->get($data['kib']->id_organisasi);
		$data['kat'] = $this->kategori->get_data_list(array('sub_dari'=>NULL));
		$this->render('modules/aset/kibc/form', $data);
	}

	public function insert()
	{
		$data = $this->input->post();
		$data['tahun'] 		= !empty($data['tgl_perolehan']) ? datify($data['tgl_perolehan'], 'Y') : '';
		$data['reg_barang'] = $this->kib->get_reg_barang($data['id_kategori']);
		$data['reg_induk'] 	= $this->kib->get_reg_induk();

		if (!$this->kib->form_verify($data)) {
			$this->message('Isi data yang wajib diisi', 'danger');
			$this->go('aset/kibc');
		}

		$sukses = $this->kib->insert($data);
		if($sukses) {
			$this->message('Data berhasil disimpan','success');
			$this->go('aset/kibc/add/'.$data['id_organisasi']);
		} else {
			$this->message('Data gagal disimpan','danger');
			$this->go('aset/kibc/add/'.$data['id_organisasi']);
		}
	}

	public function update()
	{
		$data 		   = $this->input->post();
		$data['tahun'] = !empty($data['tgl_perolehan']) ? datify($data['tgl_perolehan'], 'Y') : NULL;
		$id 		   = $data['id'];
		unset($data['id']);

		if (!$this->kib->form_verify($data)) {
			$this->message('Isi data yang wajib diisi', 'danger');
			$this->go('aset/kibc');
		}

		$sukses = $this->kib->update($id, $data);
		if($sukses) {
			$this->message('Data berhasil disimpan','success');
			$this->go('aset/kibc');
		} else {
			$this->message('Data gagal disimpan','danger');
			$this->go('aset/kibc/edit/'.$id);
		}
	}

	public function delete($id = NULL)
	{
		if(empty($id)) {
			$this->message('Pilih organisasi terlebih dahulu', 'danger');
			$this->go('aset/kibc');
		}

		$sukses = $this->kib->update($id, array('is_deleted'=>1));
		if($sukses) {
			$this->message("Data berhasil dihapus, <a href='".site_url('aset/kibc/undelete/'.$id)."'><b>Urungkan!</b></a>",'success');
			$this->go('aset/kibc');
		} else {
			$this->message('Data gagal dihapus','danger');
			$this->go('aset/kibc');
		}
	}

	public function undelete($id = NULL)
	{
		if(empty($id)) {
			$this->message('Pilih organisasi terlebih dahulu', 'danger');
			$this->go('aset/kibc');
		}

		$sukses = $this->kib->update($id, array('is_deleted'=>0));
		if($sukses) {
			$this->message("Data dihapus berhasil diurungkan.",'success');
			$this->go('aset/kibc');
		} else {
			$this->message('Data dihapus gagal diurungkan','danger');
			$this->go('aset/kibc');
		}
	}
}