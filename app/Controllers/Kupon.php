<?php namespace App\Controllers;

class Kupon extends BaseController
{
	public function __construct() {
		$this->Academy = new \App\Models\Academy();
		$this->User = new \App\Models\User();
		$this->Coupon = new \App\Models\Coupon();
		$this->email = \Config\Services::email();
	}

	public function createCoupon_Invite10($userUniqueCode, $userId, $idAcademy){
		$userData = $this->User->getUser(['uniqueCode'=>$userUniqueCode, 'id'=>$userId]);
		$academyData = $this->Academy->getAcademy(['id'=>$idAcademy]);

		if($userData && $academyData){

			$code = strtoupper(substr($userData['nama'], 0, 3).'FREE10');



			$idVital = [
				'idUser'    => $userData['id'],
				'idAcademy' => $academyData['id'],

			];

			$coupon = [

				'code'      => $code,

				'potongan'  => 100,

				'keterangan'=> 'Invite10',

				'tglMulai'  => date('Y-m-d H:i:s'),

				'tglSelesai'=> date('Y-m-d H:i:s', strtotime($academyData['waktuMulai']. ' - 90 minutes')),

				'jumlah'    => 1,

				'idVital'   => json_encode($idVital),

			];



			// cek Coupon exist

			$couponData = $this->Coupon->getCoupon(['code'=>$code, 'idVital'=>$idVital]);



			// send Email

			$from 	= 'Automate All';

			$to		= $userData['email'];

			$subject= 'Anda mendapatkan code kupon';

			$message="

				Selamat anda mendapatkan potongan 100% untuk workshop \"".$academyData['judul']."\"<br>

				Silahkan masukan kode kupon $code ketika akan melakukan pembelian <br>

				Keterangan code voucher : <br>

				<br>

				1. Code			: ".$coupon['code']." <br>

				2. Potongan		: ".$coupon['potongan']."% <br>

				3. Berlaku pada	: ".$academyData['judul']."<br>

				4. Tanggal Berlaku	: ".$coupon['tglMulai']." <br>

				5. Tanggal Selesai	: ".$coupon['tglSelesai']." <br>

				6. Jumlah Pemakaian	: ".$coupon['jumlah']." <br>

				<br>

                Terimakasih,<br>

                The Automate All Team 

			";



			if(!$couponData && $this->Coupon->insertCoupon($coupon) && $this->sendEmail($from, $to, $subject, $message)){

				return true;

			}else{

				return false;

			}



			return true;

		}else {

			return false;

		}

	}



	public function getCoupon_Invite10($price, $potongan){

		return [

			'potongan' => $price*($potongan/100),

			'total' => $price - $price*($potongan/100),

		];

	}



	public function getCoupon_discount($price, $potongan){

		return [

			'potongan' => $price*($potongan/100),

			'total' => $price - $price*($potongan/100),

		];

	}



}



?>