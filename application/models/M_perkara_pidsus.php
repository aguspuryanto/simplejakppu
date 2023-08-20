<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_perkara_pidsus extends M_perkara {
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
            ['field' => 'tahap_1', 'label' => 'TAHAP 1','rules' => 'required'],
            ['field' => 'tahap_1_proses', 'label' => 'P-18/P-19/P-21','rules' => 'required'],
            ['field' => 'tahap_2', 'label' => 'TAHAP II & P-16A NO/TGL/NAMA JAKSA','rules' => 'required'],
            ['field' => 'limpah_pn', 'label' => 'LIMPAH PN','rules' => 'required'],
            ['field' => 'putus_pn', 'label' => 'PUTUS PN','rules' => 'required'],
            ['field' => 'banding_pn', 'label' => 'BANDING','rules' => 'required'],
            ['field' => 'kasasi_pn', 'label' => 'KASASI','rules' => 'required'],
            ['field' => 'eksekusi_pn', 'label' => 'EKSEKUSI'],
            ['field' => 'grasi_pn', 'label' => 'GRASI'],
            ['field' => 'pk_pn', 'label' => 'PK'],
            ['field' => 'pekating_pn', 'label' => 'PEKATING'],
            ['field' => 'description', 'label' => 'KETERANGAN']
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

    public function select_by_id($id) {
        $this->db->where('id', $id);
        $data = $this->db->get($this->table_name);
        return $data->row();
    }

    public function select_by($module=[]) {
        $key = array_keys($module)[0];
        $value = array_values($module)[0];

        $this->db->select('COUNT(*) as jml');
        $this->db->where($key, $value);
        $data = $this->db->get($this->table_name);
        return $data->row();
    }
}