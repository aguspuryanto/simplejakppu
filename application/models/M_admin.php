<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {
    public $table_name = "epak_admin";

    public function rules()
    {
        return [
            ['field' => 'username', 'label' => 'USERNAME', 'rules' => 'trim|required|min_length[6]'],
            ['field' => 'password', 'label' => 'PASSWORD','rules' => 'required'],
            ['field' => 'nama', 'label' => 'NAMA','rules' => 'trim|required'],
            ['field' => 'foto', 'label' => 'FOTO','rules' => 'required'],
            ['field' => 'area_kerja', 'label' => 'AREA KERJA','rules' => 'required'],
            ['field' => 'rule', 'label' => 'RULE','rules' => 'required']
        ];
    }

	public function update($data, $id) {
		$this->db->where("id", $id);
		$this->db->update($this->table_name, $data);

		return $this->db->affected_rows();
	}

	public function select($id = '') {
		if ($id != '') {
			$this->db->where('id', $id);
		}

		$data = $this->db->get($this->table_name);

		return $data->row();
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
}

/* End of file M_admin.php */
/* Location: ./application/models/M_admin.php */