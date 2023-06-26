<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Migration_add_asset extends CI_Migration { 
    public $table_name = 'epak_asset';

    public function up() { 
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'nama_barang' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'tipe_barang' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'kondisi_barang' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'tahun_barang' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'nilai_barang' => array(
                'type' => 'VARCHAR',
                'constraint' => '200'
            ),
            'asal_barang' => array(
                'type' => 'VARCHAR',
                'constraint' => '200'
            ),
            'pj_barang' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'jenis_module' => array(
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