<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Migration_add_bmn extends CI_Migration { 
    public $table_name = 'epak_bmn';

    public function up() {

        $fields = array(
            'id' => array('type' => 'INT', 'constraint' => '5', 'unsigned' => TRUE, 'auto_increment' => TRUE),
            'kelompok' => array('type' => 'VARCHAR', 'constraint' => '100'),
            'kode_barang' => array('type' => 'VARCHAR', 'constraint' => '100'),
            'nama_barang' => array('type' => 'VARCHAR', 'constraint' => '100'),
            'nup' => array('type' => 'VARCHAR', 'constraint' => '100'),
            'kondisi' => array('type' => 'VARCHAR', 'constraint' => '100'),
            'merk_tipe' => array('type' => 'VARCHAR', 'constraint' => '100'),
            'tgl_perolehan' => array('type' => 'DATE'),
            'nilai_perolehan' => array('type' => 'VARCHAR', 'constraint' => '100'),
            'kuantiti' => array('type' => 'VARCHAR', 'constraint' => '100'),
            'status_kelolas' => array('type' => 'VARCHAR', 'constraint' => '100'),
            'no_psp' => array('type' => 'VARCHAR', 'constraint' => '100'),
            'tgl_psp' => array('type' => 'DATE'),
            'nobpkb' => array('type' => 'VARCHAR', 'constraint' => '100'),
            'nopol' => array('type' => 'VARCHAR', 'constraint' => '100'),
            'pemakain' => array('type' => 'VARCHAR', 'constraint' => '100'),
            'jml_kib' => array('type' => 'VARCHAR', 'constraint' => '100'),
        );
        
        $this->dbforge->add_column($this->table_name, $fields);

        $this->dbforge->add_key('id', TRUE);
        if (!$this->db->table_exists($this->table_name)) $this->dbforge->create_table($this->table_name, TRUE);
    }

    public function down() { 
        if ($this->db->table_exists($this->table_name)) $this->dbforge->drop_table($this->table_name);
    }

}