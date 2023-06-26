<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Migration_add_buron extends CI_Migration { 
    public $table_name = 'epak_buron';

    public function up() { 
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'asal_buron' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'identitas_buron' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'tmpt_tangkap' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'keterangan' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'jenis_module' => array(
                'type' => 'VARCHAR',
                'constraint' => '50'
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