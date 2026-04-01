<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Migration_Create_shipment extends CI_Migration {

    public function up() {
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
            'tracking_number' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'carrier' => array(
                'type'=> 'ENUM("FedEx", "DHL", "UPS", "USPS")',
                'default' => 'UPS',
            ),
            'status' => array(
                'type' => 'ENUM("pending", "shipped", "delivered", "returned")',
                'default' => 'pending',
            ),
            'shipped_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            ),
            'created_at' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'updated_at' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            )
        ));
        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->add_key('carrier');
        $this->dbforge->add_key('status');

        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE');

        if ($this->dbforge->create_table('shipments', TRUE)) {
            echo 'Table "shipments" created successfully!';
        } else {
            echo 'Error creating table!';
        }
    }

    public function down() {
        if ($this->dbforge->drop_table('shipments', TRUE)) {
            echo 'Table "shipments" deleted successfully!';
        } else {
            echo 'Error deleting table!';
        }
    }
}
?>