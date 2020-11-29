<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class Product extends Seeder
{
	public function run()
	{
		$data = [
			[
				'id' => 1,
				'judul' => 'ProScan OCR',
				'isi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
				'client' => 'Lorem ipsum',
				'service' => 'Lorem ipsum dolor sit amet',
				'year' => '2020',
				'tanggalUpload' => '2020-10-06 15:59:00',
				'isDeleted' => 0,
				'img' => '/img/pictures/laptop.png',
				'created_at' => Time::now(),
				'updated_at' => Time::now()
			],
			[
				'id' => 2,
				'judul' => 'PDF Extraction',
				'isi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
				'client' => 'Lorem ipsum dolor',
				'service' => 'Lorem ipsum dolor sit',
				'year' => '2019',
				'tanggalUpload' => '2020-10-06 16:00:00',
				'isDeleted' => 0,
				'img' => '/img/pictures/laptop.png',
				'created_at' => Time::now(),
				'updated_at' => Time::now()
			]
		];

		$this->db->table('product')->insertBatch($data);
	}
}
