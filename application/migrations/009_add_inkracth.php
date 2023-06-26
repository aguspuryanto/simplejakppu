<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Migration_add_inkracth extends CI_Migration { 
    public $table_name = 'epak_inkracth';

    public function up() { 
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'nama_terdakwa' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'p48_no_tgl' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'putusan_no_tgl' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'putusan_amar' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'pasal_terbukti' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ),
            'barang_bukti' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ),
            'keterangan' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'ba20_pengembalin' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'alamat_bb' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            ),
            'no_telp' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            ),
            'setor_negara' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            ),
            'ntb' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            ),
            'ntpn' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            ),
            'b18' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            ),
            'bast_barang' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            ),
            'ba21' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            ),
            'pendapat_hkm' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            ),
            'p48' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            ),
            'putusan' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            ),
            'pnetapan' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            ),
            'ba_sita' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            ),
            'sp_sita' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
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