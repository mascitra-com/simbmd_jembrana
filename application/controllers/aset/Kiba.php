<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kiba extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('aset/Kiba_model', 'kib');
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
			$data['superadmin'] = FALSE;
		} else {
            $data['superadmin'] = TRUE;
        }

		$result 			= $this->kib->get_data($filter);
		$data['kib'] 		= $result['data'];
		$data['statistic'] 	= $this->kib->get_statistic($filter['id_organisasi']);
		$data['pagination'] = $this->pagination->get_pagination($result['data_count'], $filter, 'aset/'.get_class($this));
		$data['filter'] 	= (!empty($filter) ? $filter : array('id_organisasi'=>''));
		$this->render('modules/aset/kiba/index', $data);
	}

	public function add($id = NULL)
	{
		if(empty($id)) {
			$this->message('Pilih organisasi terlebih dahulu', 'danger');
			$this->go('aset/kiba');
		}

		$data['org'] = $this->organisasi->get($id);
		$data['kat'] = $this->kategori->get_data_list(array('sub_dari'=>NULL));
		$this->render('modules/aset/kiba/form', $data);
	}

	public function edit($id = NULL)
	{
		if(empty($id)) {
			$this->message('Pilih organisasi terlebih dahulu', 'danger');
			$this->go('aset/kiba');
		}

		$data['kib'] = $this->kib->get($id);
		$data['kib']->id_kategori = $this->kategori->get($data['kib']->id_kategori);
		$data['org'] = $this->organisasi->get($data['kib']->id_organisasi);
		$data['kat'] = $this->kategori->get_data_list(array('sub_dari'=>NULL));
		$this->render('modules/aset/kiba/form', $data);
	}

	public function detail($id = NULL)
	{
		if(empty($id)) {
			$this->message('Pilih organisasi terlebih dahulu', 'danger');
			$this->go('aset/kiba');
		}

		$data['kib'] = $this->kib->get($id);
		$data['kib']->id_kategori = $this->kategori->get($data['kib']->id_kategori);
		$data['org'] = $this->organisasi->get($data['kib']->id_organisasi);
		$data['kat'] = $this->kategori->get_data_list(array('sub_dari'=>NULL));
		$this->render('modules/aset/kiba/detail', $data);
	}

	public function insert()
	{
		$data = $this->input->post();
		$data['tahun'] 		= !empty($data['tgl_perolehan']) ? datify($data['tgl_perolehan'], 'Y') : '';
		$data['reg_barang'] = $this->kib->get_reg_barang($data['id_kategori']);
		$data['reg_induk'] 	= $this->kib->get_reg_induk();

		if (!$this->kib->form_verify($data)) {
			$this->message('Isi data yang wajib diisi', 'danger');
			$this->go('aset/kiba');
		}
        $data['album_code'] = uniqid();
		$sukses = $this->kib->insert($data);
		if($sukses) {
			$this->message('Data berhasil disimpan','success');
			$this->go('aset/kiba/add/'.$data['id_organisasi']);
		} else {
			$this->message('Data gagal disimpan','danger');
			$this->go('aset/kiba/add/'.$data['id_organisasi']);
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
			$this->go('aset/kiba');
		}

		$sukses = $this->kib->update($id, $data);
		if($sukses) {
			$this->message('Data berhasil disimpan','success');
			$this->go('aset/kiba');
		} else {
			$this->message('Data gagal disimpan','danger');
			$this->go('aset/kiba/edit/'.$id);
		}
	}

	public function delete($id = NULL)
	{
		if(empty($id)) {
			$this->message('Pilih organisasi terlebih dahulu', 'danger');
			$this->go('aset/kiba');
		}

		$sukses = $this->kib->update($id, array('is_deleted'=>1));
		if($sukses) {
			$this->message("Data berhasil dihapus, <a href='".site_url('aset/kiba/undelete/'.$id)."'><b>Urungkan!</b></a>",'success');
			$this->go('aset/kiba');
		} else {
			$this->message('Data gagal dihapus','danger');
			$this->go('aset/kiba');
		}
	}

	public function undelete($id = NULL)
	{
		if(empty($id)) {
			$this->message('Pilih organisasi terlebih dahulu', 'danger');
			$this->go('aset/kiba');
		}

		$sukses = $this->kib->update($id, array('is_deleted'=>0));
		if($sukses) {
			$this->message("Data dihapus berhasil diurungkan.",'success');
			$this->go('aset/kiba');
		} else {
			$this->message('Data dihapus gagal diurungkan','danger');
			$this->go('aset/kiba');
		}
	}

    public function get_all_json()
    {
        $this->db->select('id, pengguna, hak, garis_bujur, garis_lintang, alamat, keterangan, luas, sertifikat_no');
        $this->db->where('garis_bujur !=', '');
        $this->db->where('garis_lintang !=', '');
        $result =  $this->db->get('aset_a')->result_array();
        foreach ($result as $key => $value){
            $result[$key] = array_values($result[$key]);
        }
        echo json_encode($result);
	}

    public function maps($koordinatLintang = NULL, $koordinatBujur = NULL)
    {
        if(is_null($koordinatLintang) && is_null($koordinatBujur)){
            $data['location'] = 'get_all_json';
        } else {
            $data['location'] = 'get_coordinate_json/'.$koordinatLintang.'/'.$koordinatBujur;
        }
        $this->render('modules/map/maps',$data);
    }

    public function get_coordinate_json($koordinatLintang, $koordinatBujur)
    {
        $this->db->select('id, pengguna, hak, garis_bujur, garis_lintang, alamat, keterangan, luas, sertifikat_no');
        $this->db->where('garis_bujur', $koordinatBujur);
        $this->db->where('garis_lintang', $koordinatLintang);
        $result =  $this->db->get('aset_a')->result_array();
        foreach ($result as $key => $value){
            $result[$key] = array_values($result[$key]);
        }
        echo json_encode($result);
    }

    public function upload()
    {
        $album_code = $this->input->get('dir');
        mkdir('res/images/kib/'.$album_code);
        $dir = realpath(FCPATH.'res/images/kib/'.$album_code);
        if ($_FILES['file']['size'] > 0) {
            $config['upload_path']   = $dir;
            $config['file_name']	 = date('mdhis').''.uniqid();
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size']      = 1024*2;
            $config['overwrite']     = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->do_upload('file');

            # set cover
            $result = $this->kib->get(array('album_code'=>$album_code));
            if (empty($result->album_cover)) {
                $this->kib->update($result->id, array('album_cover'=>$this->upload->data('file_name')));
            }
        }
    }

    public function delete_image($album, $file, $id)
    {
        $dir = realpath(FCPATH.'res/images/kib/'.$album.'/'.$file);
        if (unlink($dir)) {
            $this->message('Gambar berhasil dihapus', 'success');
            $this->go('aset/kiba/edit/'.$id);
        } else {
            $this->message('Gambar gagal dihapus', 'danger');
            $this->go('aset/kiba/edit/'.$id);
        }
    }

    public function set_cover($id, $file)
    {
        $sukses = $this->kib->update($id, array('album_cover'=>$file));
        if ($sukses) {
            $this->message('Berhasil mengganti cover', 'success');
            $this->go('/aset/kiba/edit/'.$id);
        } else {
            $this->message('Gagal mengganti cover', 'danger');
            $this->go('/aset/kiba/edit/'.$id);
        }
    }
}