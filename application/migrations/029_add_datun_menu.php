<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Migration_add_datun_menu extends CI_Migration { 
    public $table_name = 'epak_datun_menu';

    public function up() { 
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'nama' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'deskripsi' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'parent' => array(
                'type' => 'CHAR',
                'constraint' => '4'
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table($this->table_name, TRUE);

        $menu_datun = array(array(
            'nama' => "gakkum",
            'deskripsi' => "GAKKUM",
            'parent' => 0,
        ), array(
            'nama' => "timkum",
            'deskripsi' => "TIMKUM",
            'parent' => 0,
        ), array(
            'nama' => "bankum",
            'deskripsi' => "BANKUM",
            'parent' => 0,
        ), array(
            'nama' => "thl",
            'deskripsi' => "THL",
            'parent' => 0,
        ), array(
            'nama' => "yankum",
            'deskripsi' => "YANKUM",
            'parent' => 0,
        ), array(
            'nama' => "gakkum_ligitasi",
            'deskripsi' => "Ligitasi",
            'parent' => 1,
        ), array(
            'nama' => "gakkum_nonligitasi",
            'deskripsi' => "Non Ligitasi",
            'parent' => 1,
        ), array(
            'nama' => "timkum_lo",
            'deskripsi' => "Legal Opinian (LO)",
            'parent' => 2,
        ), array(
            'nama' => "timkum_la",
            'deskripsi' => "Legal Assistant (LA)",
            'parent' => 2,
        ), array(
            'nama' => "bankum_ligitasi",
            'deskripsi' => "Ligitasi",
            'parent' => 3,
        ), array(
            'nama' => "bankum_nonligitasi",
            'deskripsi' => "Non Ligitasi",
            'parent' => 3,
        ), array(
            'nama' => "thl_kosiliasi",
            'deskripsi' => "Kosiliasi",
            'parent' => 4,
        ), array(
            'nama' => "thl_mediasi",
            'deskripsi' => "Mediasi",
            'parent' => 4,
        ), array(
            'nama' => "thl_fasilitasi",
            'deskripsi' => "Fasilitasi",
            'parent' => 4,
        ), array(
            'nama' => "yankum",
            'deskripsi' => "Pelayanan Hukum",
            'parent' => 5,
        ), array(
            'nama' => "yankum_lisan",
            'deskripsi' => "Pelayanan Hukum Lisan",
            'parent' => 5,
        ));

        // $this->db->insert_batch($this->table_name, $menu_datun);
        // $insert_query = $this->db->insert_string($this->table_name, $menu_datun);
        // $insert_query = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_query);
        // $this->db->query($insert_query);

        $sql = $this->db->set($menu_datun)->get_compiled_insert($this->table_name);
        $sql = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $sql);
        $this->db->query($sql);
    }

    public function down()
    {
        $this->dbforge->drop_table($this->table_name, TRUE);
    }

}