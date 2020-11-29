<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\I18n\Time;

class News extends Migration
{
	public function up()
    {
		$now = Time::now('Asia/Jakarta','en_US');
		$this->forge->addField([
				'id'          => [
						'type'           => 'INT',
						'constraint'     => 11,
						'unsigned'       => true,
						'auto_increment' => true
				],
				'judul'       => [
						'type'           => 'TEXT'
				],
				'isi' 	=> [
						'type'           => 'LONGTEXT'
				],
				'tanggalUpload' 	=> [
						'type'           => 'DATETIME',
						'default'		 => $now
				],
				'isDeleted'	=> [
						'type'			 => 'TINYINT',
						'constraint'	 => 1,
						'default'		 => 0
				],
				'img'		=> [
						'type'			 => 'TEXT'
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
		$this->forge->createTable('news');
    }

	public function down()
	{
			$this->forge->dropTable('news');
	}
}
