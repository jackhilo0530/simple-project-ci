<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_category extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE
            ),
            'description' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'created_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            ),
            'updated_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            )
        ));

        $this->dbforge->add_key('id', TRUE);
        
        if ($this->dbforge->create_table('category', TRUE)) {
            echo 'Table "category" created successfully!';
        } else {
            echo 'Error creating table!';
        }
    }

    public function down()
    {
        if ($this->dbforge->drop_table('category', TRUE)) {
            echo 'Table "category" deleted successfully!';
        } else {
            echo 'Error deleting table!';
        }
    }
}
?>