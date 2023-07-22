<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_perkara extends CI_Model {
    public $table_name = "epak_perkara";
    public $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');

    public function rules()
    {
        return [
            ['field' => 'pulbaket_no', 'label' => 'PULBAKET NO/ TGL/NAMA JAKSA', 'rules' => 'required'],
            ['field' => 'penyelidik_no', 'label' => 'PENYELIDIKAN NO/ TGL/NAMA JAKSA','rules' => 'required'],
            ['field' => 'penyidikan_no', 'label' => 'PENYIDIKAN SPDP & P-16 NO/ TGL/NAMA JAKSA','rules' => 'required'],
            ['field' => 'instansi_asal', 'label' => 'INSTANSI ASAL','rules' => 'required'],
            ['field' => 'nama_tsk', 'label' => 'NAMA TSK/TDKW/TPDANA','rules' => 'required'],
            ['field' => 'pasal_tsk', 'label' => 'PASAL DISANGKA/DIDAKWA/DITUNTUT/TERBUKTI','rules' => 'required'],
            ['field' => 'jenis_perkara', 'label' => 'JENIS PERKARA/ PERMASALAHAN','rules' => 'required'],
            ['field' => 'tahap_1', 'label' => 'TAHAP 1','rules' => ''],
            ['field' => 'tahap_1_tipe', 'label' => 'TIPE TAHAP','rules' => 'required'],
            ['field' => 'tahap_1_proses', 'label' => 'P-18/P-19/P-21','rules' => ''],
            ['field' => 'tahap_2', 'label' => 'TAHAP II & P-16A NO/TGL/NAMA JAKSA','rules' => ''],
            ['field' => 'limpah_pn', 'label' => 'LIMPAH PN','rules' => ''],
            ['field' => 'putus_pn', 'label' => 'PUTUS PN','rules' => ''],
            ['field' => 'banding_pn', 'label' => 'BANDING','rules' => ''],
            ['field' => 'kasasi_pn', 'label' => 'KASASI','rules' => ''],
            ['field' => 'eksekusi_pn', 'label' => 'EKSEKUSI','rules' => ''],
            ['field' => 'grasi_pn', 'label' => 'GRASI','rules' => ''],
            ['field' => 'pk_pn', 'label' => 'PK','rules' => ''],
            ['field' => 'pekating_pn', 'label' => 'PEKATING','rules' => ''],
            ['field' => 'jenis_perkara', 'label' => 'JENIS PERKARA','rules' => ''],
            ['field' => 'keterangan', 'label' => 'KETERANGAN']
        ];
    }

    public function save($data) {
        $this->db->trans_begin();
        $this->db->insert($this->table_name, $data);
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_commit();
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }
    }

    public function select_all($options = "") {
        if($options) {
            $this->db->where($options);
        }

        $data = $this->db->get($this->table_name);
        return $data->result();
    }

    public function total_rows() {
        $data = $this->db->get($this->table_name);
        return $data->num_rows();
    }

    public function select_by($module=[]) {
        $key = array_keys($module)[0];
        $value = array_values($module)[0];

        $this->db->select('COUNT(*) as jml');
        $this->db->where($key, $value);
        $data = $this->db->get($this->table_name);
        return $data->row();
    }

	public function getPerkaraAll() {
		// $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
		
		$perkara = $this->select_all();
		$index = 0;
		foreach ($perkara as $value) {
		    $color = '#' .$this->rand[rand(0,15)] .$this->rand[rand(0,15)] .$this->rand[rand(0,15)] .$this->rand[rand(0,15)] .$this->rand[rand(0,15)] .$this->rand[rand(0,15)];

			// $pegawai_by_posisi = $this->M_pegawai->select_by_posisi($value->id);
			$module = $this->select_by(['jenis_module'=>$value->jenis_module]);

			$data_perkara[$index]['value'] = $module->jml;
			$data_perkara[$index]['color'] = $color;
			$data_perkara[$index]['highlight'] = $color;
			$data_perkara[$index]['label'] = ucwords($value->jenis_module);
			
			$index++;
		}

		return $data_perkara;
	}

    public function getPerkaraStatistik($jenis_module = "pidum") {
        $statistik_perkara = $this->stat_jnsperkara($jenis_module);
        // echo json_encode($statistik_perkara);
		$index = 0;
		foreach($statistik_perkara as $key => $stat) {
		    $color = '#'.$this->rand[rand(0,15)].$this->rand[rand(0,15)].$this->rand[rand(0,15)].$this->rand[rand(0,15)].$this->rand[rand(0,15)].$this->rand[rand(0,15)];

			$data_statistik_perkara[$index]['value'] = $stat;
			$data_statistik_perkara[$index]['color'] = $color;
			$data_statistik_perkara[$index]['highlight'] = $color;
			$data_statistik_perkara[$index]['label'] = strtoupper($key);
			
			$index++;
		}

        return $data_statistik_perkara;
    }

    public function stat_perkara($jenis_module = "pidum") {
        $query = $this->db->query("SELECT IFNULL(COUNT(penyidikan_no),0) AS Spdp, 
        COALESCE(COUNT(tahap_1),0) AS Pratut, 
        SUM(case when tahap_2 is null then 0 ELSE 1 END) AS Tut, 
        IFNULL(SUM(eksekusi_pn),0) AS Eksekusi, 
        SUM(case when banding_pn is null then 0 ELSE 1 END) AS Banding, 
        SUM(case when kasasi_pn is null then 0 ELSE 1 END) AS Kasasi, 
        IFNULL(SUM(pk_pn),0) AS PK, 
        IFNULL(SUM(grasi_pn),0) AS Lain
        FROM epak_perkara WHERE jenis_module='".$jenis_module."'");

        return $query->row_array();
    }

    /*
     * OHARDA, KAMNEGTIBUM DAN TPUL, NARKOTIKA, TERORISME
     */
    public function stat_jnsperkara($jenis_module = "pidum") {
        $query = $this->db->query("SELECT SUM(CASE WHEN jenis_perkara='TPUL' THEN 1 ELSE 0 END) tpul,
        SUM(CASE WHEN jenis_perkara='OHARDA' THEN 1 ELSE 0 END) oharda,
        SUM(CASE WHEN jenis_perkara='NARKOTIKA' THEN 1 ELSE 0 END) narkotika,
        SUM(CASE WHEN jenis_perkara='TERORISME' THEN 1 ELSE 0 END) terorisme,
        SUM(CASE WHEN jenis_perkara='KAMNEGTIBUM' THEN 1 ELSE 0 END) kamnegtibum
        FROM epak_perkara WHERE jenis_module='".$jenis_module."'");

        // echo $this->db->last_query();
        return $query->row_array();
    }

    /*
     * Jumlah Tersangka, Terdakwa dan Terpidana
     * Tersangka = epak_perkara
     * Terdakwa = epak_inkracth
     * Terpidana = epak_tahan
     */
    public function getTerpidanaStatistik($jenis_module = "pidum") {
        $query = $this->db->query("SELECT * FROM (
            SELECT 'tot_tsk', COUNT(nama_tsk) AS tottsk FROM epak_perkara WHERE jenis_module='".$jenis_module."'
            UNION ALL
            SELECT 'tot_dakwa', COUNT(nama_terdakwa) AS tottsk FROM epak_inkracth
            UNION ALL
            SELECT 'tot_pidana', COUNT(nama_tsk) AS tottsk FROM epak_tahan WHERE jenis_module='".$jenis_module."'
        ) t");

        // echo $this->db->last_query();
        return $query->result();
    }
}