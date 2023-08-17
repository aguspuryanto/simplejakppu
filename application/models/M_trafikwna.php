<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_trafikwna extends CI_Model {
    public $table_name = "epak_trafikwna";

    public function rules()
    {
        return [
            ['field' => 'asal_wna', 'label' => 'ASAL NEGARA', 'rules' => 'required'],
            ['field' => 'pnduduk_wna', 'label' => 'ORANG ASING PENDUDUK','rules' => 'required'],
            ['field' => 'tnaga_kerja', 'label' => 'TENAGA KERJA','rules' => 'required'],
            ['field' => 'plajar', 'label' => 'PELAJAR/MAHASISWA','rules' => 'required'],
            ['field' => 'pneliti', 'label' => 'PENELITI','rules' => 'required'],
            ['field' => 'kluarga', 'label' => 'KELUARGA','rules' => 'required'],
            ['field' => 'rohaniwan', 'label' => 'ROHANIAWAN','rules' => 'required'],
            ['field' => 'ilegal', 'label' => 'PENDATANG ILEGAL','rules' => 'required'],
            ['field' => 'usaha', 'label' => 'USAHA','rules' => 'required'],
            ['field' => 'sosbud', 'label' => 'SOSBUD','rules' => 'required'],
            ['field' => 'wisata', 'label' => 'WISATA','rules' => 'required'],
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

    public function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update($this->table_name, $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table_name);
    }

    public function select_by_id($id) {
        $this->db->where('id', $id);
        $data = $this->db->get($this->table_name);
        return $data->row();
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