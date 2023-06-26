<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Migration_add_realisasi extends CI_Migration { 
    public $table_name = 'epak_realisasi';

    public function up() { 
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'tgl' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'kode_nama_kegiatan' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'pagu' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'periode_lalu' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'periode_ini' => array(
                'type' => 'VARCHAR',
                'constraint' => '200'
            ),
            'periode_total' => array(
                'type' => 'VARCHAR',
                'constraint' => '200'
            ),
            'periode_persen' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'sisa_anggaran' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'created_at' => array('type' => 'timestamp')
        ));
        $this->dbforge->add_key('id', TRUE);
        if (!$this->db->table_exists($this->table_name)) $this->dbforge->create_table($this->table_name, TRUE);
    }

    public function down()
    {
        if ($this->db->table_exists($this->table_name)) $this->dbforge->drop_table($this->table_name);
    }
}