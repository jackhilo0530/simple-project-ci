<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_cart extends CI_Migration
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
                'unsigned' => TRUE,
            ),
            'product_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
            'quantity' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
            'created_at' => array(
                'type' => 'DATETIME',
                'null' => FALSE,
            ),
            'updated_at' => array(
                'type' => 'DATETIME',
                'null' => FALSE,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE');

        if ($this->dbforge->create_table('cart', TRUE)) {
            echo 'Table "cart" created successfully!';
        } else {
            echo 'Error creating table!';
        }
    }

    public function down()
    {
        if ($this->dbforge->drop_table('cart', TRUE)) {
            echo 'Table "cart" deleted successfully!';
        } else {
            echo 'Error deleting table!';
        }
    }
}
?>