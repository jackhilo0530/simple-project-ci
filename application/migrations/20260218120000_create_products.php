<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_products extends CI_Migration
{
    public function up()
    {

        $fields = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'description' => array(    
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'sku' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'unique' => TRUE
            ),
            'price' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2'
            ),
            'image_path' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'category_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
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
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);

        if ($this->dbforge->create_table('products', true)) {
            echo 'Table "products" created successfully!';
        } else {
            echo 'Error creating table!';
        }
    }

    public function down()
    {
        if ($this->dbforge->drop_table('products', true)) {
            echo 'Table "products" deleted successfully!';
        } else {
            echo 'Error deleting table!';
        }
    }
}