<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_order extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ),
            'total_price' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2'
            ),
            'status' => array(
                'type' => 'ENUM("pending", "processing", "completed", "cancelled")',
                'default' => 'pending'
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
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE');

        if($this->dbforge->create_table('orders', TRUE)) {
            echo 'Table "orders" created successfully!';
        } else {
            echo 'Error creating table!';
        }
    }

    public function down()
    {
        if($this->dbforge->drop_table('orders', TRUE)) {
            echo 'Table "orders" deleted successfully!';
        } else {
            echo 'Error deleting table!';
        }
    }
}
