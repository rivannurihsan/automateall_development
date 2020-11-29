<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Messages extends Migration
{
	public function up()
    {
		$this->forge->addField([
				'id'          => [
						'type'           => 'INT',
						'constraint'     => 11,
						'unsigned'       => true,
						'auto_increment' => true
				],
				'name'       => [
						'type'           => 'TEXT'
				],
				'email' 	=> [
						'type'           => 'TEXT'
				],
				'phone' 	=> [
						'type'           => 'TEXT',
						'null'			 => true
				],
				'message'	=> [
						'type'			 => 'LONGTEXT'
				],
				'created_at'=> [
						'type'			 => 'DATETIME',
						'null'			 => true	
				],
				'updated_at'=> [
						'type'			 => 'DATETIME',
						'null'			 => true	
				]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('messages');
    }

	public function down()
	{
			$this->forge->dropTable('messages');
	}
}
