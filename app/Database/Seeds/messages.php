<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class Messages extends Seeder
{
	public function run()
	{
		$data = [
			[
				'id' => 1,
				'name' => 'Irfan Nugraha',
				'email' => 'irfannugraha844@gmail.com',
				'phone' => '82140310174',
				'message' => 'great!',
				'created_at' => Time::now(),
				'updated_at' => Time::now()
			],
			[
				'id' => 2,
				'name' => 'Alkahfi Khuzaimy',
				'email' => 'alkahfi25@gmail.com',
				'phone' => '81808931753',
				'message' => 'amazing!',
				'created_at' => Time::now(),
				'updated_at' => Time::now()
			]
		];

		$this->db->table('messages')->insertBatch($data);
	}
}
