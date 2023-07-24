<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_sptugas extends CI_Model {
    public $table_name = "epak_sptugas";

    public function rules()
    {
        return [
            ['field' => 'sumber_info', 'label' => 'SUMBER INFORMASI', 'rules' => 'required'],
            ['field' => 'sp_tugas', 'label' => 'SURAT PERINITAH/NAMA TIM','rules' => 'required'],
            ['field' => 'objek_tugas', 'label' => 'OBYEK PERINTAH TUGAS','rules' => 'required'],
            ['field' => 'kasus_posisi', 'label' => 'KASUS POSISI','rules' => 'required'],
            ['field' => 'permasalahan', 'label' => 'PERMASALAHAN','rules' => 'required'],
            ['field' => 'potensi_aght', 'label' => 'POTENSI AGHT','rules' => 'required'],
            ['field' => 'tahapan', 'label' => 'TAHAPAN','rules' => 'required'],
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

    public function select_by_module($module) {
        $this->db->select('COUNT(*) as jml');
        $this->db->where('jenis_module', $module);
        $data = $this->db->get($this->table_name);
        return $data->row();
    }

    public function getStatistik() {
        $query = $this->db->query("SELECT DISTINCT jenis_module, COUNT(jenis_module) AS tot FROM epak_sptugas GROUP BY jenis_module");

        return $query->result_array();
    }
}