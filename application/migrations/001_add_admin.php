<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Migration_add_admin extends CI_Migration { 
    public $table_name = 'epak_admin';

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
                'username' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '15'
                ),
                'password' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '50'
                ),
                'nama' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '50'
                ),
                'foto' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255'
                ),
                'rule' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '50' //kajari,kasi,staff
                ),
                'created_at' => array('type' => 'timestamp')
            ));
            $this->dbforge->add_key('id', TRUE);
            if (!$this->db->table_exists($this->table_name)) $this->dbforge->create_table($this->table_name);

            $data_dummies = array(
                array('username' => "superadmin",'password' => "10c4981bb793e1698a83aea43030a388",'nama' => "Administrator",'foto' => "profil1.jpg",'rule' => "admin"),
            );
            $this->db->insert_batch($this->table_name, $data_dummies);
        }
    }

    public function down()
    {
        if ($this->db->table_exists($this->table_name) ) $this->dbforge->drop_table($this->table_name);
    }
}