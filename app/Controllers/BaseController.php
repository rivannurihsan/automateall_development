<?php
namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;
use CodeIgniter\Pager\Exceptions\PagerException;

use function PHPSTORM_META\type;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();
		$this->News = new \App\Models\News();
		$this->Academy = new \App\Models\Academy();
		$this->User = new \App\Models\User();
		$this->LinkConfirm = new \App\Models\LinkConfirm(); 
		$this->Daftar = new \App\Models\Daftar();
		$this->Referral = new \App\Models\Referral();
		$this->Product = new \App\Models\Product();
		$this->Daftar = new \App\Models\Daftar();
		$this->Bayar = new \App\Models\Bayar();
		$this->Coupon = new \App\Models\Coupon();
		$this->Kupon = new \App\Controllers\Kupon();

		$this->email = \Config\Services::email();
		$this->sKeyLink = 'keylink';
		session();
	}

	public function randomGenerator($len){
		$rand='';
		for ($i=0; $i < $len; $i++) { 
			$random = [
				rand(48,57),
				rand(65,90),
				rand(97,122),
			];
			$rand = $rand.chr($random[rand(0,2)]);
		}
		return $rand;
	}

	public function dateToString($date)
	{
		if (gettype($date) == 'array') {
			for ($i=0; $i < count($date); $i++) { 
				$date[$i] = preg_replace('/ .*/', '', $date[$i]);
				$date[$i] = preg_split('/-/', $date[$i]);
				switch ($date[$i][1]) {
					case '1':
						$date[$i][1] = 'Januari';
						break;
					case '2':
						$date[$i][1] = 'Februari';
						break;
					case '3':
						$date[$i][1] = 'Maret';
						break;
					case '4':
						$date[$i][1] = 'April';
						break;
					case '5':
						$date[$i][1] = 'Mei';
						break;
					case '6':
						$date[$i][1] = 'Juni';
						break;
					case '7':
						$date[$i][1] = 'Juli';
						break;
					case '8':
						$date[$i][1] = 'Agustus';
						break;
					case '9':
						$date[$i][1] = 'September';
						break;
					case '10':
						$date[$i][1] = 'Oktober';
						break;
					case '11':
						$date[$i][1] = 'November';
						break;
					case '12':
						$date[$i][1] = 'Desember';
						break;										
				}
				$date[$i] = $date[$i][2].' '.$date[$i][1].' '.$date[$i][0];
			}
		}
		elseif (gettype($date) == 'string') {
			$date = preg_replace('/ .*/', '', $date);
			$date = preg_split('/-/', $date);
			switch ($date[1]) {
				case '1':
					$date[1] = 'Januari';
					break;
				case '2':
					$date[1] = 'Februari';
					break;
				case '3':
					$date[1] = 'Maret';
					break;
				case '4':
					$date[1] = 'April';
					break;
				case '5':
					$date[1] = 'Mei';
					break;
				case '6':
					$date[1] = 'Juni';
					break;
				case '7':
					$date[1] = 'Juli';
					break;
				case '8':
					$date[1] = 'Agustus';
					break;
				case '9':
					$date[1] = 'September';
					break;
				case '10':
					$date[1] = 'Oktober';
					break;
				case '11':
					$date[1] = 'November';
					break;
				case '12':
					$date[1] = 'Desember';
					break;										
			}
			$date = $date[2].' '.$date[1].' '.$date[0];
		}
		return $date;
	}
	
	public function timeToString($date)
	{
		if (gettype($date) == 'array') {
			for ($i=0; $i < count($date); $i++) {
				$date[$i] = preg_replace("/^[0-9].*\s/", '', $date[$i]);
				$date[$i] = preg_split("/:/", $date[$i]);
				$date[$i] = $date[$i][0].':'.$date[$i][1];
			}
		}elseif (gettype($date) == 'string') {
			$date = preg_replace("/^[0-9].*\s/", '', $date);
			$date = preg_split("/:/", $date);
			$date = $date[0].':'.$date[1];
		}
		return $date;
	}	
	
	/**
     * Method untuk mengubah waktu dengan format date('Y-m-d H:i:s')
	 * menjadi date('H:i'),
	 * Contoh '10:08:53' menjadi '10:08'
     * 
     * @return true|false
     */  	
	public function sendEmail($fromEmail, $from, $to, $subject=null, $message=null){
		session();
		$this->email->setFrom($fromEmail, $from);
		$this->email->setTo($to);

		$this->email->setSubject($subject);
		$this->email->setMessage($message);
    
 		return $this->email->send();
		// echo $this->email->printDebugger();
	}
	
	public function tranposeArray($data){
		$result = array_fill_keys( array_keys($data[0]) , array() );
		foreach ($result as $key => $value) {
			$result[$key] = array_column($data, $key);
		}
		return ($result);
    }

	public function encryption($text, $key){
		$metode = "AES-128-CTR"; 
		$options = 0; 
		$iv = '1234567890123456';

		$encryption = openssl_encrypt($text, $metode, $key, $options, $iv);
		return base64_encode($encryption);
	}

	public function decryption($text, $key){
		$metode = "AES-128-CTR"; 
		$options = 0; 
		$iv = '1234567890123456';

		$decryption = openssl_decrypt(base64_decode($text), $metode, $key, $options, $iv);
		return $decryption;
	}

	public function intToMoney($int){
		$int = strrev($int);
		$int = str_split($int, 3);

		$hasil = null;
		for ($i=count($int); $i > 0; $i--) { 
			if ($i-1 == count($int)-1) {
				$hasil = strrev($int[$i-1]);
			}else {
				$hasil = $hasil.'.'.strrev($int[$i-1]);
			}
		}
		return $hasil;
	}
	
}
