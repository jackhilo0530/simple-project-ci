<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_user extends CI_Migration
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
			'username' => array(
				'type' => 'VARCHAR',
				'constraint' => '50'
			),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
				'unique' => TRUE
			),
			'password_hash' => array(
				'type' => 'VARCHAR',
				'constraint' => '255'
			),
			'img_path' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
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

		if ($this->dbforge->create_table('users', true)) {
            echo 'Table "users" created successfully!';
        } else {
            echo 'Error creating table!';
        }
	}

    public function down()
    {
        if ($this->dbforge->drop_table('users', true)) {
            echo 'Table "users" deleted successfully!';
        } else {
            echo 'Error deleting table!';
        }
    }
}