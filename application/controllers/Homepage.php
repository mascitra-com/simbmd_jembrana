<?php
/**
 * Created by PhpStorm.
 * User: Rizki Herdatullah
 * Date: 30/11/2017
 * Time: 03.20
 */

class Homepage extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('aset/Kiba_model', 'kib');
        $this->load->model('Organisasi_model', 'organisasi');
        $this->load->library('pagination');
        $this->is_accessible = TRUE;
    }

    public function index()
    {
        $filter = $this->input->get();
        $data['organisasi'] = $this->organisasi->get_data(array('jenis'=>4));
        $filter['id_organisasi'] = isset($filter['id_organisasi'])?$filter['id_organisasi']:'';
        # Jika bukan superadmin
        if (!$this->auth->get_super_access() && !$this->is_accessible) {
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
        $this->render('modules/homepage/index', $data);
    }

    public function maps($koordinatLintang = NULL, $koordinatBujur = NULL)
    {
        if(is_null($koordinatLintang) && is_null($koordinatBujur)){
            $data['location'] = 'get_all_json';
        } else {
            $data['location'] = 'get_coordinate_json/'.$koordinatLintang.'/'.$koordinatBujur;
        }
        $this->render('modules/homepage/maps',$data);
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
}