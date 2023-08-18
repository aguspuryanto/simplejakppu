<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_datun extends CI_Model {
    // public $table_name = "epak_datun";
    public $table_name = "epak_datun_rev";

    public function rules()
    {
        return [
            // ['field' => 'skk', 'label' => 'SURAT PERMOHONAN/SKK', 'rules' => 'required'],
            // ['field' => 'kegiatan', 'label' => 'KEGIATAN','rules' => 'required'],
            // ['field' => 'penggugat', 'label' => 'PENGGUGAT/PEMOHON/PELAWAN','rules' => 'required'],
            // ['field' => 'tergugat', 'label' => 'TERGUGAT/TERMOHON/TERLAWAN','rules' => 'required'],
            // ['field' => 'seksi', 'label' => 'SEKSI','rules' => 'required'],
            // ['field' => 'sk_tim', 'label' => 'SP/SK TIM JPN','rules' => 'required'],
            // ['field' => 'posisi_kasus', 'label' => 'POSISI KASUS/PERMASALAHAN/OBYEK PERKARA','rules' => 'required'],
            // ['field' => 'tahap', 'label' => 'TAHAP','rules' => 'required'],
            // ['field' => 'periode', 'label' => 'PERIODE','rules' => 'required'],
            // ['field' => 'keterangan', 'label' => 'KETERANGAN'],
            ['field' => 'kegiatan', 'label' => 'JENIS KEGIATAN','rules' => 'required'],
            ['field' => 'pemohon', 'label' => 'PEMOHON','rules' => 'required'],
            ['field' => 'jenis_perkara', 'label' => 'JENIS PERKARA','rules' => 'required'],
            ['field' => 'skk', 'label' => 'SURAT PERMOHONAN/SKK','rules' => 'required'],
            ['field' => 'kasus_posisi', 'label' => 'KASUS POSISI','rules' => 'required'],
            ['field' => 'dok_sp1', 'label' => 'SP-1','rules' => 'required'],
            ['field' => 'dok_telaah', 'label' => 'TELAAHAN S-5','rules' => 'required'],
            ['field' => 'dok_sp2', 'label' => 'SP-2','rules' => 'required'],
            ['field' => 'tahap', 'label' => 'TAHAPAN KEGIATAN / PERKARA','rules' => 'required'],
            ['field' => 'laporan_kegiatan', 'label' => 'LAPORAN KEGIATAN','rules' => 'required'],
            ['field' => 'uang_selamat', 'label' => 'UANG YANG DISELAMATKAN','rules' => 'required'],
            ['field' => 'uang_dipulihkan', 'label' => 'UANG YANG DIPULIHKAN','rules' => 'required'],
            ['field' => 'petunjuk_kajari', 'label' => 'PETUNJUK KAJARI','rules' => 'required'],
            ['field' => 'saran_kasi', 'label' => 'SARAN KASI','rules' => 'required'],
            ['field' => 'keterangan', 'label' => 'KETERANGAN'],
            ['field' => 'Kajari_note', 'label' => 'CATATAN KAJARI'],
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

    public function select_by_module($module) {
        $this->db->select('COUNT(*) as jml');
        $this->db->where('jenis_module', $module);
        $data = $this->db->get($this->table_name);
        return $data->row();
    }
}