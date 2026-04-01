<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_order_items extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'order_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ),
            'product_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ),
            'quantity' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'unit_price' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2'
            )
        ));
        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE');

        if($this->dbforge->create_table('order_items', TRUE)) {
            echo 'Table "order_items" created successfully!';
        } else {
            echo 'Error creating table!';
        }
    }

    public function down()
    {
        if($this->dbforge->drop_table('order_items', TRUE)) {
            echo 'Table "order_items" deleted successfully!';
        } else {
            echo 'Error deleting table!';
        }
    }
}
?>