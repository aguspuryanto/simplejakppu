<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Migration_add_perkara extends CI_Migration { 
    public $table_name = 'epak_perkara';

    public function up() { 
        if (!$this->db->table_exists($this->table_name) )
        {
            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'pulbaket_no' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100'
                ),
                'penyelidik_no' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100'
                ),
                'penyidikan_no' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100'
                ),
                'instansi_asal' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100'
                ),
                'nama_tsk' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100'
                ),
                'pasal_tsk' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100'
                ),
                'jenis_perkara' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100'
                ),
                'tahap_1' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100'
                ),
                'tahap_1_tipe' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '5'
                ),
                'tahap_1_proses' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100'
                ),
                'tahap_2' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100'
                ),
                'limpah_pn' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100'
                ),
                'putus_pn' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100'
                ),
                'banding_pn' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100'
                ),
                'kasasi_pn' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100'
                ),
                'eksekusi_pn' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100'
                ),
                'grasi_pn' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100'
                ),
                'pk_pn' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100'
                ),
                'pekating_pn' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100'
                ),
                'jenis_module' => array(
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
            if (!$this->db->table_exists($this->table_name)) $this->dbforge->create_table($this->table_name);
        }
    }

    public function down()
    {
        if ($this->db->table_exists($this->table_name)) $this->dbforge->drop_table($this->table_name);
    }
}