<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Migration_add_datun_rev extends CI_Migration { 
    public $table_name = 'epak_datun_rev';

    public function up() { 
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'kegiatan' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'pemohon' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'jenis_perkara' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'skk' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'kasus_posisi' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'dok_sp1' => array(
                'type' => 'VARCHAR',
                'constraint' => '200'
            ),
            'dok_telaah' => array(
                'type' => 'VARCHAR',
                'constraint' => '200'
            ),
            'dok_sp2' => array(
                'type' => 'VARCHAR',
                'constraint' => '200'
            ),
            'tahap' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'laporan_kegiatan' => array(
                'type' => 'VARCHAR',
                'constraint' => '200'
            ),
            'uang_selamat' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'uang_dipulihkan' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'petunjuk_kajari' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'saran_kasi' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'keterangan' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'created_at' => array('type' => 'timestamp')
        ));

        // $fields = array(
        //     'periode' => array('type' => 'VARCHAR', 'constraint' => '100')
        // );
        // $this->dbforge->add_column($this->table_name, $fields);

        $this->dbforge->add_key('id', TRUE);
        if (!$this->db->table_exists($this->table_name)) $this->dbforge->create_table($this->table_name, TRUE);
    }

    public function down()
    {
        if ($this->db->table_exists($this->table_name)) $this->dbforge->drop_table($this->table_name);
    }
}