<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_asset extends CI_Model {
    public $table_name = "epak_asset";

    public function rules()
    {
        return [
            ['field' => 'nama_barang', 'label' => 'NAMA BARANG', 'rules' => 'required'],
            ['field' => 'tipe_barang', 'label' => 'TIPE/JENIS','rules' => 'required'],
            ['field' => 'kondisi_barang', 'label' => 'KONDISI','rules' => 'required'],
            ['field' => 'tahun_barang', 'label' => 'TAHUN PEROLEHAN','rules' => 'required'],
            ['field' => 'nilai_barang', 'label' => 'NILAI PEROLEHAN','rules' => 'required'],
            ['field' => 'asal_barang', 'label' => 'ASAL','rules' => 'required'],
            ['field' => 'pj_barang', 'label' => 'PENANGGUNG JAWAB','rules' => 'required'],
            ['field' => 'jenis_module', 'label' => 'MODULE']
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