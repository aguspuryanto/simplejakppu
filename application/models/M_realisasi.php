<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_realisasi extends CI_Model {
    public $table_name = "epak_realisasi";

    public function rules()
    {
        return [
            ['field' => 'tgl', 'label' => 'TANGGAL', 'rules' => ''],
            ['field' => 'kode_nama_kegiatan', 'label' => 'KEGIATAN','rules' => 'required'],
            ['field' => 'pagu', 'label' => 'PAGU','rules' => 'required'],
            ['field' => 'periode_lalu', 'label' => 'S/D PERIODE LALU','rules' => 'required'],
            ['field' => 'periode_ini', 'label' => 'PERIODE INI','rules' => 'required'],
            ['field' => 'periode_total', 'label' => 'TOTAL S/D PERIODE','rules' => 'required'],
            ['field' => 'periode_total', 'label' => 'PRESENTASE','rules' => 'required'],
            ['field' => 'sisa_anggaran', 'label' => 'SISA ANGGARAN','rules' => 'required']
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

    public function select_by_module($module) {
        $this->db->select('COUNT(*) as jml');
        $this->db->where('jenis_module', $module);
        $data = $this->db->get($this->table_name);
        return $data->row();
    }
}