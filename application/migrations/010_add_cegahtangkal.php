<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Migration_add_cegahtangkal extends CI_Migration { 
    public $table_name = 'epak_cegahtangkal';

    public function up() { 
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'identitas' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'srt_mohon' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'kasus_posisi' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ),
            'kepja_no' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'tgl_mulai' => array(
                'type' => 'VARCHAR',
                'constraint' => '50'
            ),
            'tgl_akhir' => array(
                'type' => 'VARCHAR',
                'constraint' => '50'
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