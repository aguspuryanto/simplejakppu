<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Migration_add_investasi extends CI_Migration { 
    public $table_name = 'epak_investasi';

    public function up() { 
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'sp' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'nama_pemodal' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'bidang_usaha' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'nilai' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'wktu' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'lokasi' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'tipe' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'tahapan' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'potensi_aght' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'keterangan' => array(
                'type' => 'TEXT',
                'null' => TRUE
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