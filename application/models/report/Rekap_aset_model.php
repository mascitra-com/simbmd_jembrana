<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Rekap_aset_model extends MY_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_rekapitulasi_aset($level = 1, $org = "")
	{
	    if($org){
            $querya = "SELECT kd_golongan, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_a JOIN kategori k ON id_kategori = k.id WHERE id_organisasi = {$org} GROUP BY kd_golongan";
            $queryb = "SELECT kd_golongan, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_b JOIN kategori k ON id_kategori = k.id WHERE id_organisasi = {$org} GROUP BY kd_golongan";
            $queryc = "SELECT kd_golongan, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_c JOIN kategori k ON id_kategori = k.id WHERE id_organisasi = {$org} GROUP BY kd_golongan";
            $queryd = "SELECT kd_golongan, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_d JOIN kategori k ON id_kategori = k.id WHERE id_organisasi = {$org} GROUP BY kd_golongan";
            $querye = "SELECT kd_golongan, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_e JOIN kategori k ON id_kategori = k.id WHERE id_organisasi = {$org} GROUP BY kd_golongan";
            $queryf = "SELECT kd_golongan, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_f JOIN kategori k ON id_kategori = k.id WHERE id_organisasi = {$org} GROUP BY kd_golongan";
        } else {
            $querya = "SELECT kd_golongan, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_a JOIN kategori k ON id_kategori = k.id GROUP BY kd_golongan";
            $queryb = "SELECT kd_golongan, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_b JOIN kategori k ON id_kategori = k.id GROUP BY kd_golongan";
            $queryc = "SELECT kd_golongan, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_c JOIN kategori k ON id_kategori = k.id GROUP BY kd_golongan";
            $queryd = "SELECT kd_golongan, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_d JOIN kategori k ON id_kategori = k.id GROUP BY kd_golongan";
            $querye = "SELECT kd_golongan, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_e JOIN kategori k ON id_kategori = k.id GROUP BY kd_golongan";
            $queryf = "SELECT kd_golongan, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_f JOIN kategori k ON id_kategori = k.id GROUP BY kd_golongan";
        }

		$query  = "SELECT * FROM ({$querya} UNION {$queryb} UNION {$queryc} UNION {$queryd} UNION {$querye} UNION {$queryf}) AS q";
		$lv1  = $this->db->query($query)->result();
		$lv1  = $this->kodefikasi($lv1);

		if ($level > 1) {
		    if($org) {
                $querya = "SELECT kd_golongan, kd_bidang, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_a JOIN kategori k ON id_kategori = k.id WHERE id_organisasi = {$org} GROUP BY kd_golongan, kd_bidang";
                $queryb = "SELECT kd_golongan, kd_bidang, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_b JOIN kategori k ON id_kategori = k.id WHERE id_organisasi = {$org} GROUP BY kd_golongan, kd_bidang";
                $queryc = "SELECT kd_golongan, kd_bidang, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_c JOIN kategori k ON id_kategori = k.id WHERE id_organisasi = {$org} GROUP BY kd_golongan, kd_bidang";
                $queryd = "SELECT kd_golongan, kd_bidang, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_d JOIN kategori k ON id_kategori = k.id WHERE id_organisasi = {$org} GROUP BY kd_golongan, kd_bidang";
                $querye = "SELECT kd_golongan, kd_bidang, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_e JOIN kategori k ON id_kategori = k.id WHERE id_organisasi = {$org} GROUP BY kd_golongan, kd_bidang";
                $queryf = "SELECT kd_golongan, kd_bidang, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_f JOIN kategori k ON id_kategori = k.id WHERE id_organisasi = {$org} GROUP BY kd_golongan, kd_bidang";
            } else {
                $querya = "SELECT kd_golongan, kd_bidang, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_a JOIN kategori k ON id_kategori = k.id GROUP BY kd_golongan, kd_bidang";
                $queryb = "SELECT kd_golongan, kd_bidang, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_b JOIN kategori k ON id_kategori = k.id GROUP BY kd_golongan, kd_bidang";
                $queryc = "SELECT kd_golongan, kd_bidang, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_c JOIN kategori k ON id_kategori = k.id GROUP BY kd_golongan, kd_bidang";
                $queryd = "SELECT kd_golongan, kd_bidang, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_d JOIN kategori k ON id_kategori = k.id GROUP BY kd_golongan, kd_bidang";
                $querye = "SELECT kd_golongan, kd_bidang, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_e JOIN kategori k ON id_kategori = k.id GROUP BY kd_golongan, kd_bidang";
                $queryf = "SELECT kd_golongan, kd_bidang, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_f JOIN kategori k ON id_kategori = k.id GROUP BY kd_golongan, kd_bidang";

            }
			$query  = "SELECT * FROM ({$querya} UNION {$queryb} UNION {$queryc} UNION {$queryd} UNION {$querye} UNION {$queryf}) AS q";
			$lv2  = $this->db->query($query)->result();
			$lv2  = $this->kodefikasi($lv2);
			
			foreach ($lv1 as $lv1_key => $lv1_value) {
				$lv1_value->detail = array();
				foreach ($lv2 as $lv2_key => $lv2_value) {
					if ($lv2_value->kd_golongan === $lv1_value->kd_golongan) {
						$lv1_value->detail[] = $lv2_value;
						unset($lv2_value);
					}
				}
			}
		}

		if ($level > 2) {
		    if($org) {
                $querya = "SELECT kd_golongan, kd_bidang, kd_kelompok, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_a JOIN kategori k ON id_kategori = k.id WHERE id_organisasi = {$org} GROUP BY kd_golongan, kd_bidang, kd_kelompok";
                $queryb = "SELECT kd_golongan, kd_bidang, kd_kelompok, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_b JOIN kategori k ON id_kategori = k.id WHERE id_organisasi = {$org} GROUP BY kd_golongan, kd_bidang, kd_kelompok";
                $queryc = "SELECT kd_golongan, kd_bidang, kd_kelompok, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_c JOIN kategori k ON id_kategori = k.id WHERE id_organisasi = {$org} GROUP BY kd_golongan, kd_bidang, kd_kelompok";
                $queryd = "SELECT kd_golongan, kd_bidang, kd_kelompok, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_d JOIN kategori k ON id_kategori = k.id WHERE id_organisasi = {$org} GROUP BY kd_golongan, kd_bidang, kd_kelompok";
                $querye = "SELECT kd_golongan, kd_bidang, kd_kelompok, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_e JOIN kategori k ON id_kategori = k.id WHERE id_organisasi = {$org} GROUP BY kd_golongan, kd_bidang, kd_kelompok";
                $queryf = "SELECT kd_golongan, kd_bidang, kd_kelompok, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_f JOIN kategori k ON id_kategori = k.id WHERE id_organisasi = {$org} GROUP BY kd_golongan, kd_bidang, kd_kelompok";
            } else {
                $querya = "SELECT kd_golongan, kd_bidang, kd_kelompok, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_a JOIN kategori k ON id_kategori = k.id GROUP BY kd_golongan, kd_bidang, kd_kelompok";
                $queryb = "SELECT kd_golongan, kd_bidang, kd_kelompok, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_b JOIN kategori k ON id_kategori = k.id GROUP BY kd_golongan, kd_bidang, kd_kelompok";
                $queryc = "SELECT kd_golongan, kd_bidang, kd_kelompok, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_c JOIN kategori k ON id_kategori = k.id GROUP BY kd_golongan, kd_bidang, kd_kelompok";
                $queryd = "SELECT kd_golongan, kd_bidang, kd_kelompok, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_d JOIN kategori k ON id_kategori = k.id GROUP BY kd_golongan, kd_bidang, kd_kelompok";
                $querye = "SELECT kd_golongan, kd_bidang, kd_kelompok, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_e JOIN kategori k ON id_kategori = k.id GROUP BY kd_golongan, kd_bidang, kd_kelompok";
                $queryf = "SELECT kd_golongan, kd_bidang, kd_kelompok, COUNT(nilai) AS jumlah_aset, SUM(nilai) as jumlah_nilai FROM aset_f JOIN kategori k ON id_kategori = k.id GROUP BY kd_golongan, kd_bidang, kd_kelompok";

            }
			$query  = "SELECT * FROM ({$querya} UNION {$queryb} UNION {$queryc} UNION {$queryd} UNION {$querye} UNION {$queryf}) AS q";
			$lv3  = $this->db->query($query)->result();
			$lv3  = $this->kodefikasi($lv3);
			
			foreach ($lv1 as $lv1_key => $lv1_value) {
				foreach ($lv1_value->detail as $lv2_key => $lv2_value) {
					$lv2_value->detail = array();
					foreach ($lv3 as $lv3_key => $lv3_value) {
						if ($lv3_value->kd_golongan === $lv2_value->kd_golongan && $lv3_value->kd_bidang === $lv2_value->kd_bidang) {
							$lv2_value->detail[] = $lv3_value;
							unset($lv3_value);
						}
					}
				}
			}
		}
		
		return $lv1;
	}

	public function kodefikasi($data)
	{
		$this->load->model('Kategori_model','kategori');
		$temp = $this->kategori->get_many_by(array('jenis<'=>4));

		$kategori = array();
		foreach ($temp as $key => $value) {
			$kode  = $value->kd_golongan;
			$kode .= (isset($value->kd_bidang))?'.'.$value->kd_bidang:'';
			$kode .= (isset($value->kd_kelompok))?'.'.$value->kd_kelompok:'';

			$kategori[$kode] = $value;
		}

		foreach ($data as $index=>$item) {
			$kode  = $item->kd_golongan;
			$kode .= (isset($item->kd_bidang))?'.'.$item->kd_bidang:'';
			$kode .= (isset($item->kd_kelompok))?'.'.$item->kd_kelompok:'';

			$item->kategori = $kategori[$kode]->nama;
		}

		return $data;
	}
}