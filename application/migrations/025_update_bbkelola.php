<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Migration_Update_bbkelola extends CI_Migration { 
    public $table_name = 'epak_bbkelola';

    public function up() {
        // update table
        $fields = array(
            'nama_terdakwa' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'after' => 'id'
            ),
            'pasal_disangka' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'after' => 'nama_terdakwa'
            ),
            'bb' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'after' => 'pasal_disangka'
            ),
            'pasal_terbukti' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'after' => 'bb'
            ),
            'putusan' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'after' => 'pasal_terbukti'
            ),
            'eksekusi' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'after' => 'putusan'
            ),
            'dokumen' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'after' => 'eksekusi'
            ),
            'petunjuk' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'after' => 'dokumen'
            )
        );

        $this->dbforge->add_column($this->table_name, $fields);
    }

    public function down()
    {
        // drop column
        // $this->dbforge->drop_column($this->table_name, 'tahun');
        // $this->dbforge->drop_column($this->table_name, 'jmlbb');
        // $this->dbforge->drop_column($this->table_name, 'jmlperkara');
        // $this->dbforge->drop_column($this->table_name, 'keterangan');

        // drop table
        // $this->dbforge->drop_table($this->table_name);
    }
}