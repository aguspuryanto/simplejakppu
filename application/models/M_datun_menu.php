<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_datun_menu extends CI_Model {
    // public $table_name = "epak_datun";
    public $table_name = "epak_datun_menu";

    public function rules()
    {
        return [
            ['field' => 'nama', 'label' => 'NAMA','rules' => false],
            ['field' => 'deskripsi', 'label' => 'DESKRIPSI','rules' => false],
            ['field' => 'parent', 'label' => 'PARENT','rules' => false],
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

    public function select_all($options = "", $search_type='where', $search_val='') {
        if($options) {
            $this->db->where($options);
        }

        if(!$options && $search_type == 'like') {
            $this->db->like('kegiatan', $search_val);
        }

        $data = $this->db->get($this->table_name);
        // print_r($this->db->last_query());
        return $data->result();
    }

    public function total_rows() {
        $data = $this->db->get($this->table_name);
        return $data->num_rows();
    }
}