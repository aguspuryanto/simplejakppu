<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {
    public $table_name = "epak_admin";

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
}

/* End of file M_admin.php */
/* Location: ./application/models/M_admin.php */