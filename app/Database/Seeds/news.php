<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class News extends Seeder
{
	public function run()
	{
		$data = [
			[
				'id' => 1,
				'judul' => 'About the importance of RPA Maintenance: Webinar Q&A',
				'isi' => 'We recently held a webinar around the topic of RPA Maintenace and its importance in scaling your RPA program. After discussing why maintenance is needed in the first place and what’s the best way to organize your maintenance unit with Coley Vahey, Country Manager US & Canada at Digital Workforce and Elias Levo, Head of Run Management at Digital Workforce, we opened the discussion for questions.',
				'tanggalUpload' => '2020-11-21 21:10:42',
				'isDeleted' => 0,
				'img' => '/img/news/1.png',
				'created_at' => Time::now(),
				'updated_at' => Time::now()
			],
			[
				'id' => 2,
				'judul' => 'news 1',
				'isi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
				'tanggalUpload' => '2020-10-06 22:25:14',
				'isDeleted' => 0,
				'img' => '/img/news/2.png',
				'created_at' => Time::now(),
				'updated_at' => Time::now()
			],
			[
				'id' => 3,
				'judul' => 'news 2',
				'isi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
				'tanggalUpload' => '2020-10-06 22:25:17',
				'isDeleted' => 0,
				'img' => '/img/news/3.png',
				'created_at' => Time::now(),
				'updated_at' => Time::now()
			],
			[
				'id' => 4,
				'judul' => 'news 3',
				'isi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
				'tanggalUpload' => '2020-10-06 22:25:27',
				'isDeleted' => 0,
				'img' => '/img/news/4.png',
				'created_at' => Time::now(),
				'updated_at' => Time::now()
			],
			[
				'id' => 5,
				'judul' => 'news 4',
				'isi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
				'tanggalUpload' => '2020-10-06 22:25:28',
				'isDeleted' => 0,
				'img' => '/img/news/5.png',
				'created_at' => Time::now(),
				'updated_at' => Time::now()
			]
		];

		$this->db->table('news')->insertBatch($data);
	}
}
