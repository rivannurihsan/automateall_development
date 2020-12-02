<?php namespace App\Controllers;

class Pages extends BaseController
{
	/**
     * Method untuk membuat tampilan registrasi
	 * dengan link '/regis'
     * 
     * @return view|redirect
     */
    public function regis()
	{
		if (isset($_SESSION['userData'])) {
			return redirect()->to('/');
		}else{
			$data = [
				'title'=>'Automateall Registration',
				'validation' => \Config\Services::validation(),
				'isNotIncFooter' => 0,
				'isNotIncNavbar' => 0,
			];
			return view('pages/regis',$data);
		}
	}

	/**
     * Method untuk proses login
	 * dengan post '/login'
	 * 
     * @return redirect 
     */	
	public function sendRegis(){
		$rules = [
			'Name' => [
				'rules' => 'required|string|max_length[30]',
				'errors' => [
					'required' => 'Please enter your name.',
					'string' => 'Please provide a valid name.',
					'max_length' => 'Please enter less than 30 character',
				]
			],
			'Email' => [
				'rules' => 'required|valid_email|isEmailExcist',
				'errors' => [
					'required' => 'Please enter your email.',
					'valid_email' => 'Please provide a valid email.',
					'isEmailExcist' => 'Email already registered.<a style="font-size: 80%;color: #dc3545;" href="/login"> Login Now</a> ?',
				]
			],
			'Password' => [
				'rules' => 'required|min_length[3]',
				'errors' => [
					'required' => 'Please write your password.',
					'min_length' => 'Please enter more than 3 character',
				]
			],
			'ConfirmPassword' => [
				'rules' => 'required|matches[Password]',
				'errors' => [
					'required' => 'Please re-enter your password.',
					'matches' => 'passwords do not match',
				]
			],
		];
		$valid = $this->validate($rules);
		if (!$valid) {
			return redirect()->to('/regis')->withInput();
		}else{			
			$userMailS = preg_split('/@/', $_POST['Email']);
			$userPassS = $_POST['Password'];

			/// Create User
			// Generate Random id
			$idList = $this->User->getColumn('id');
			$isUnique = false;
			while(!$isUnique) { 
				$id = $this->randomGenerator(5);
				$id = $id;
				if(!in_array($id, $idList)){
					$isUnique = true;
				}
			}

			// Insert User
			$user = [
				'pass'	=> $userPassS,
				'email'	=> $userMailS[0].'@'.$userMailS[1],
				'id'	=> $id,
				'nama'	=> $_POST['Name'],
			];

			/// Send Confrimation Message
			// Link Generator
			$link 	= base_url('/verifyAccount?token=');
			$id		= $this->randomGenerator(10);
			$email	= $user['email'];
			$date	= date('Y-m-d H:i:s');
			$tokenS	= base64_encode('tkn='.$id.'&email='.$email.'&date='.$date);
			$link	= $link.$tokenS;

			// Send Email
			$from 	= 'Automate All';
			$to		= $userMailS[0].'@'.$userMailS[1];
			$subject= 'Konfirmasi Email Anda';
			$message="
                Hai, selamat datang di Automate All<br>
                Mohon verifikasi email untuk menyelesaikan akun dengan cara klik link berikut:<br>
                '.$link.'<br>
                
                Terimakasih,<br>
                The Automate All Team
			";

			$linkconfirm = [
				'token'		=> $tokenS,
				'tglTerbuat'=> $date,
				'type'		=> 'verifyAccount',
			];

			if ($this->User->insertUser($user) && $this->LinkConfirm->insert_row($linkconfirm) && $this->sendEmail($from, $to, $subject, $message)) {
				$_SESSION['isKirim'] = 'RegisterAccountSend';
				return redirect()->to('/login');
			}else{
				$_SESSION['isKirim'] = 'ErrorTechMessage';
				return redirect()->to('/regis');
			}
		}
	}

	/**
     * Method untuk cek valid link verify email
	 * jika valid maka membuat halaman verify account
	 * dengan link '/verifyAccount?token=...'
	 * 
     * @return view|redirect 
     */	
	public function verifyAccount(){
		$linkConfirmRow = $this->LinkConfirm->get_by_token($_GET['token']);
		if($linkConfirmRow != null){
			if ($linkConfirmRow['type'] = 'verifyAccount') {
				$get = base64_decode($_GET['token']);
				$token = preg_replace('/(tkn=|&email.*)/', '', $get);
				$emailS = preg_replace('/(.*&email=|&date=.*)/', '', $get);
				$emailS = preg_split('/@/', $emailS);
				$date = preg_replace('/(.*&date=)/', '', $get);

				$data = [
					'title' => 'Verify your Account',
					'email' => $emailS[0].'@'.$emailS[1],
					'emailS' => $emailS[0].'@'.$emailS[1],
					'date' => $date,
					'validation' => \Config\Services::validation(),
				];
				return view('pages/verify', $data);
			}else{
                $_SESSION['isKirim'] = 'ErrorLinkInvalid';
				return redirect()->to('/');
    		}
		}else{
            $_SESSION['isKirim'] = 'ErrorLinkInvalid';
			return redirect()->to('/');
		}
	}

	/**
	 * Method untuk proses verifikasi email
	 * dengan post '/verifyAccount?token=...'
	 * 
	 * @return redirect 
	 */	
	public function sendVerifyAccount(){
		$data = ['isVerifikasi' => date('Y-m-d H:i:s')];
		$where = ['email' => $_POST['currEmail']];
		if($this->User->updateUser($data, $where)){
			$this->LinkConfirm->delete_row($_GET['token']);
			$_SESSION['isKirim'] = 'VerifyAccountSent';
		}
		else{
			$_SESSION['isKirim'] = 'ErrorTechMessage';
		}
		return redirect()->to('/');
	}

	/**
     * Method untuk membuat tampilan login 
	 * dengan link '/login'
     * 
     * @return view|redirect
     */
	public function login()
	{
		if((!isset($_SERVER['HTTP_REFERER'])) || ($_SERVER['HTTP_REFERER'] != base_url('/login'))){
			$_SESSION['tryLoginCount'] = 0;
		}

		if (isset($_SESSION['userData'])) {
			return redirect()->to('/');
		}else{
			if(isset($_SESSION['tryLoginCount']) && $_SESSION['tryLoginCount'] >= 3){
				$lupaPass = 1;
			}else{
				$lupaPass = 0;
			}
			
			$data = [
				'title'=>'Automateall - Login',
				'validation' => \Config\Services::validation(),
				'lupaPass' => $lupaPass,
				'isNotIncFooter' => 0,
				'isNotIncNavbar' => 0,
			];
			return view('pages/login',$data);
		}
	}

	/**
     * Method untuk proses login
	 * dengan post '/login'
	 * 
     * @return view|redirect 
     */
	public function sendLogin(){
		$rules = [
			'Email' => [
				'rules' => 'required|valid_email',
				'errors' => [
					'required' => 'Please enter your email.',
					'valid_email' => 'Please provide a valid email.',
				]
			],
			'Password' => [
				'rules' => 'required|isLogedIn[{Email}]',
				'errors' => [
					'required' => 'Please enter your password.',
					'isLogedIn' => 'Please check your email or password.',
				]
			],
		];
		$valid = $this->validate($rules);
		if (!$valid) {
			if ($_POST['Password'] && $_POST['Email']) {
				if (!isset($_SESSION['tryLoginEmail']) || $_SESSION['tryLoginEmail'] != $_POST['Email']) {
					$_SESSION['tryLoginCount'] = 0;
					$_SESSION['tryLoginEmail'] = $_POST['Email'];
				}else{
					$_SESSION['tryLoginCount']+=1;
				}
			}
			return redirect()->to('/login')->withInput();
		}else{
			$_SESSION['tryLoginCount'] = 0;

			$userMailS = preg_split('/@/', $_POST['Email']);
			$userMailS = $userMailS[0].'@'.$userMailS[1];
			$userPassS = $_POST['Password'];

			$rawData = $this->User->getUser_by_login($userMailS, $userPassS);
			$_SESSION['userData'] = [
				'nama' => $rawData['nama'], $userPassS,
				'email' => preg_split('/@/', $rawData['email'])[0].preg_split('/@/', $rawData['email'])[1],
				'pass' => $rawData['pass'],
				'id' => $rawData['id'],
				'isVerifikasi' => $rawData['isVerifikasi'],
			];
			
			return redirect()->to('/');
		}
	}

	/**
     * Method untuk mengirim pesan kepada email pengguna
	 * yang berisi link untuk reset password
	 * dengan post '/login'
	 * 
     * @return view|redirect 
     */		
	public function lupaPass(){
		$userMailS = preg_split('/@/', $_POST['EmailCopy']);
		$userMailS = $userMailS[0].'@'.$userMailS[1];
		$emailList = $this->User->getColumn('email');

		if(in_array($userMailS, $emailList)){
			// Link generator
			$link = base_url('/passwordReset?token=');
			$id = $this->randomGenerator(10);
			$email = $userMailS;
			$date = date('Y-m-d H:i:s');
			$tokenS = base64_encode('tkn='.$id.'&email='.$email.'&date='.$date);
			$link = $link.$tokenS;
			
			// Sent email
			session();

			$this->email->setFrom('hayosopo69@gmail.com', 'Automate All');
			$this->email->setTo($_POST['EmailCopy']);

			$this->email->setSubject('Atur Ulang Password Anda');
			$this->email->setMessage('
				Hai, Kami menerima permintaan perubahan password, buka tautan berikut untuk mengubah password anda: <br><br>
				'.$link.'<br>
				Tautan ini akan kadaluarsa setelah 24 jam.<br>
				<br>
				Terimakasih, <br>
				The Automate All Team
			');

			$this->LinkConfirm->insert([
				'token' => $tokenS,
				'tglTerbuat' => $date,
			]);
			if($this->email->send()){
				$_SESSION['isKirim'] = 'LupassSent';
			}else{
				$_SESSION['isKirim'] = 'ErrorTechMessage';
			}
		}else{
		    $_SESSION['isKirim'] = 'LupassSent';
		}
		return redirect()->to('/');
	}

	/**
     * Method untuk logout dari akun yang login
	 * dengan link '/passwordReset?token=...'
	 * 
     * @return view
     */		
	public function confirmResetPassword()
	{
		$linkConfirmRow = $this->LinkConfirm->get_by_token($_GET['token']);
		if($linkConfirmRow != null){
			$get = base64_decode($linkConfirmRow);
			$token = preg_replace('/(tkn=|&email.*)/', '', $get);
			$emailS = preg_replace('/(.*&email=|&date=.*)/', '', $get);
			$emailS = preg_split('/@/', $emailS);
			$date = preg_replace('/(.*&date=)/', '', $get);

			$data = [
				'title' => 'Change Password',
				'email' => $emailS[0].'@'.$emailS[1],
				'emailS' => $emailS[0].'@'.$emailS[1],
				'date' => $date,
				'validation' => \Config\Services::validation(),
			];
			return view('pages/resetPassword', $data);
		}else{
		    $_SESSION['isKirim'] = 'ErrorLinkInvalid';
			return redirect()->to('/');
		}
		
	}

	/**
     * Method untuk proses reset password user
	 * dengan post '/passwordReset'
	 * 
     * @return view
     */	
	public function sendConfirmResetPassword(){
		$rules = [
			'NewPassword' => [
                'rules' => 'required|min_length[3]',
				'errors' => [
					'required' => 'Please write your password.',
					'min_length' => 'Please enter more than 3 character',
				]
			],
			'ConfirmNewPassword' => [
                'rules' => 'required|matches[NewPassword]',
				'errors' => [
					'required' => 'Please re-enter your password.',
					'matches' => 'passwords do not match',
				]
			],
		];
		$valid = $this->validate($rules);
		if (!$valid) {
			return redirect()->to('/passwordReset?token='.$_GET['token'])->withInput();
		}else{
			// Get original variabel
			$namaS = $this->User->getUser_by_email($_POST['currEmail'], 'nama');
			$passS =  $this->User->getUser_by_email($_POST['currEmail'], 'pass');
			$oriData = [
				'nama' => $namaS,
			];

			// Create new variabel
			$data = ['pass' => $_POST['NewPassword']];
			$data['nama'] = $oriData['nama'];

			// Update data
			$where = ['email' => $_POST['currEmail']];
			if($this->User->updateUser($data, $where)){
				$this->LinkConfirm->delete_row($_GET['token']);
				$_SESSION['isKirim'] = 'PasswordResetedSent';
			}
			else{
			    $_SESSION['isKirim'] = 'ErrorTechMessage';
			}
			return redirect()->to('/');
		}
	}

	/**
     * Method untuk logout dari akun yang login
	 * dengan post '/logout'
	 * 
     * @return redirect
     */	
	public function logout(){
		if (isset($_SESSION['userData'])) {
			SESSION_DESTROY();
			return redirect()->to('/');
		}else{
			return redirect()->to('/');
		}
	}
	
	/**
     * Method untuk membuat tampilan homepage 
	 * dengan link '/'
     * 
     * @return view
     */
	public function index()
	{
		$data = [
			'title'=>'Welcome to Automate All'
		];
		if(isset($_SESSION['userData'])){
			$data['userdata'] = $_SESSION['userData'];
		}
		return view('pages/landing',$data);
    }

	/**
     * Method untuk membuat tampilan blog
	 * dengan link '/blog'
     * 
     * @return view
     */
    public function blog()
	{
		$data = [
			'title'=>'Blog',
			'id' => $this->News->getNewss_Order_TglUpload('id'),
			'judul' => $this->News->getNewss_Order_TglUpload('judul'),
			'isi' => preg_replace('/<.*?>/', '', preg_replace('/<h.*?>.*/', '', $this->News->getNewss_Order_TglUpload('isi')) ),
			'img' => $this->News->getNewss_Order_TglUpload('img'),
			'tglUpload' => $this->dateToString( $this->News->getNewss_Order_TglUpload('tanggalUpload') ),
		];
		if(isset($_SESSION['userData'])){
			$data['userdata'] = $_SESSION['userData'];
		}
		return view('pages/blog',$data);
	}
	
	/**
     * Method untuk membuat tampilan list blog
	 * dengan link '/blog/all'
     * 
     * @return view
     */
	public function list()
	{
		$data = [
			'title'=>'All Articles',
			'id' => $this->News->getNewss_Order_TglUpload('id'),
			'judul' => $this->News->getNewss_Order_TglUpload('judul'),
			'isi' => preg_replace('/<.*?>/', '', preg_replace('/<h.*?>.*/', '', $this->News->getNewss_Order_TglUpload('isi')) ),
			'img' => $this->News->getNewss_Order_TglUpload('img'),
			'tglUpload' => $this->dateToString( $this->News->getNewss_Order_TglUpload('tanggalUpload') ),
		];
		if(isset($_SESSION['userData'])){
			$data['userdata'] = $_SESSION['userData'];
		}
		return view('pages/article_list',$data);
	}

	/**
     * Method untuk membuat tampilan detail blog
	 * dengan link '/blog/detail'
	 * 
     * @return view
     */
	public function articleDetail()
	{
		$data = [
			'title'=>'Article Details',
			'id' => $this->News->getNews_by_id($_GET['id'], 'id'),
			'judul' => $this->News->getNews_by_id($_GET['id'], 'judul'),
			'isi' => $this->News->getNews_by_id($_GET['id'], 'isi'),
			'img' => $this->News->getNews_by_id($_GET['id'], 'img'),
			'tglUpload' => $this->dateToString( $this->News->getNews_by_id($_GET['id'], 'tanggalUpload') ),
		];
		if(isset($_SESSION['userData'])){
			$data['userdata'] = $_SESSION['userData'];
		}
		return view('pages/article_detail',$data);
	}

	/**
     * Method untuk membuat tampilan products and services
	 * dengan link '/productsAndServices'
	 * 
     * @return view
     */	
    public function productsAndServices()
	{
		$Product = new \App\Models\Product();

		$data = [
			'title'=>'Products & Services',
			'id' => $Product->getProducts_Order_TglUpload('id'),
			'judul' => $Product->getProducts_Order_TglUpload('judul'),
			'isi' => $Product->getProducts_Order_TglUpload('isi'),
			'img' => $Product->getProducts_Order_TglUpload('img'),
		];
		if(isset($_SESSION['userData'])){
			$data['userdata'] = $_SESSION['userData'];
		}
		return view('pages/product',$data);
    }

	/**
     * Method untuk membuat tampilan our main value
	 * dengan link '/omv'
	 * 
     * @return view
     */		
    public function ourMainValue()
	{
		$data = [
			'title'=>'Our Main Value'
		];
		if(isset($_SESSION['userData'])){
			$data['userdata'] = $_SESSION['userData'];
		}
		return view('pages/omv',$data);
    }

	/**
     * Method untuk membuat tampilan contact
	 * dengan link '/contact'
	 * 
     * @return view
     */		
    public function contact()
	{
		$data = [
			'title'=>'Contact',
			'validation' => \Config\Services::validation()
		];
		if(isset($_SESSION['userData'])){
			$data['userdata'] = $_SESSION['userData'];
		}
		return view('pages/contact',$data);
	}

	/**
     * Method untuk mengirim pesan dari halaman contact
	 * dengan post '/contact'
	 * 
     * @return view|redirect 
     */	
	public function send(){
		$rules = [
			'Name' => [
				'rules' => 'required|string',
				'errors' => [
					'required' => 'Please enter your name.',
					'string' => 'Please provide a valid name.'
				]
			],
			'Email' => [
				'rules' => 'required|valid_email',
				'errors' => [
					'required' => 'Please enter your email.',
					'valid_email' => 'Please provide a valid email.'
				]
			],
			'Msg' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please write your message.'
				]
			]
		];

		$valid = $this->validate($rules);
		if(!$valid){
			return redirect()->to('/contact')->withInput();
		} else {
			if (isset($_POST['send'])) {
				$from = $_POST['Name'].', menggunakan website';
				$to		= 'irfannugraha844@gmail.com';
				$subject= 'Pesan dari pengguna, '.$_POST['Name'].', melalui website AutomateAll';
				$message= '
						<p style="font-weight: bold; margin: 0px;">Pengirim : </p>
						<table style="text-align: left; margin: 0px; margin-left: 10px;">
							<tr style="margin: 0px; margin-left: 10px; ">
								<td>Nama</td>
								<td>:</td>
								<td>'.$_POST['Name'].'</td>
							</tr>
							<tr style="margin: 0px; margin-left: 10px; ">
								<td>Email</td>
								<td>:</td>
								<td><a href="mailto: '.$_POST['Email'].'" target="_blank">'.$_POST['Email'].'</a></td>
							</tr>
							<tr style="margin: 0px; margin-left: 10px; ">
								<td>Phone</td>
								<td>:</td>
								<td>'.$_POST['Phone'].'</td>
							</tr>
						</table>
						<br>
						<p style="font-weight: bold; margin: 0px;">Pesan : </p>
						<p style="margin: 0px; margin-left: 10px; " >'.$_POST['Msg'].'</p>
					';

				if($this->sendEmail($from, $to, $subject, $message)){
					$_SESSION['isKirim'] = 'ContactMessageSent'; // #Change ubah $iskirim ke $_SESSION['isKirim']
					return redirect()->to('/contact');
				}else{
					$_SESSION['isKirim'] = 'ErrorTechMessage';
					return redirect()->to('/contact');
				}
				
				#Change tidak ada kirim pesan referral, jadi dihapus $_POST['redir']
				// return redirect()->to('/contact');
			}
		}
	}

	/**
     * Method untuk membuat tampilan detail produk dan service
	 * dengan link '/detail'
	 * 
     * @return view
     */
	public function detail()
	{
		$data = [
			'title'			=> 'Detail Product',
			'judul'			=> $this->Product->getProduct_by_id($_GET['id'], 'judul'),
			'isi'			=> $this->Product->getProduct_by_id($_GET['id'], 'isi'),
			'client'		=> $this->Product->getProduct_by_id($_GET['id'], 'client'),
			'service'		=> $this->Product->getProduct_by_id($_GET['id'], 'service'),
			'year'			=> preg_replace('/-.*/', '', $this->Product->getProduct_by_id($_GET['id'], 'tglBerlangganan')),
			'img'			=> $this->Product->getProduct_by_id($_GET['id'], 'img'),
			'isDelete'		=> $this->Product->getProduct_by_id($_GET['id'], 'isDeleted'),
			'fileLocation'	=> $this->Product->getProduct_by_id($_GET['id'], 'fileLocation'),
		];
		if(isset($_SESSION['userData'])){
			$data['userdata'] = $_SESSION['userData'];
		}
		return view('pages/detail',$data);
	}

	/**
     * Method untuk membuat tampilan akademi
	 * dengan link '/academy'
	 * 
     * @return view
     */		
	public function academy()
	{
		$data = [
			'title' => 'Academy'
		];
		if(isset($_SESSION['userData'])){
			$data['userdata'] = $_SESSION['userData'];
		}
		return view('pages/academy',$data);
	}

	/**
     * Method untuk membuat tampilan list akademi
	 * dengan link '/academy/list'
	 * 
     * @return view
     */
	public function academyList()
	{
		$data = [
			'title' => 'Academy - List',
			'id' => $this->Academy->getAcademy_Order_waktu('id'),
			'judul' => $this->Academy->getAcademy_Order_waktu('judul'),
			'subjudul' => $this->Academy->getAcademy_Order_waktu('subjudul'),
			'img' => $this->Academy->getAcademy_Order_waktu('img'),
			'isi' => $this->Academy->getAcademy_Order_waktu('isi'),
			'tanggal' => $this->dateToString( $this->Academy->getAcademy_Order_waktu('waktuMulai') ),
			'jammulai' => $this->timeToString($this->Academy->getAcademy_Order_waktu('waktuMulai'))[0],
			'jamselesai' => $this->timeToString($this->Academy->getAcademy_Order_waktu('waktuSelesai'))[0],
			'price' => $this->Academy->getAcademy_Order_waktu('price'),
			'isSelesai' => $this->Academy->getAcademy_Order_waktu('isSelesai'),
			'link' => $this->Academy->getAcademy_Order_waktu('link'),
		];
		if(isset($_SESSION['userData'])){
			$data['userdata'] = $_SESSION['userData'];
		}
		return view('pages/academy_list',$data);
	}

# Mulai System pembelian workshop ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	 
	/**
     * Method untuk membuat tampilan detail akademi
	 * dengan link '/academy/detail'
	 * 
     * @return view
     */
	public function academyDetail()
	{
		$id = $_GET['id'];
		
		$data = [
			'title' 	=> 'Academy - Detail',
			'id' 		=> $id,
			'judul' 	=> $this->Academy->getAcademy_by_id($id, 'judul'),
			'subjudul' 	=> $this->Academy->getAcademy_by_id($id, 'subjudul'),
			'img' 		=> $this->Academy->getAcademy_by_id($id, 'img'),
			'isi' 		=> $this->Academy->getAcademy_by_id($id, 'isi'),
			'tanggal' 	=> $this->dateToString( $this->Academy->getAcademy_by_id($id, 'waktuMulai') ),
			'jammulai' 	=> $this->timeToString($this->Academy->getAcademy_by_id($id, 'waktuMulai')),
			'jamselesai'=> $this->timeToString($this->Academy->getAcademy_by_id($id, 'waktuSelesai')),
			'price' 	=> $this->Academy->getAcademy_by_id($id, 'price'),
			'link' 		=> $this->Academy->getAcademy_by_id($id, 'link'),

			'nama' 		=> $this->Referral->getReferral_Order_nama('nama', $id),
			'progress' 	=> $this->Referral->getReferral_Order_nama('progress', $id),
			'email' 	=> $this->Referral->getReferral_Order_nama('email', $id),
			'validation'=> \Config\Services::validation()
		];
		if(isset($_SESSION['userData'])){
			$data['userdata'] = $_SESSION['userData'];
		}
		return view('pages/academy_detail',$data);
	}

	/**
     * Method untuk proses pendaftaran
	 * dengan post '/academy/detail'
	 * 
     * @return redirect
     */	
	public function sendAcademyDaftar(){
		return redirect()->to('/academy/detail');
	}

	/**
     * Method untuk membuat tampilan checkout
	 * dengan link '/academy/checkout'
	 * 
     * @return view
     */
	public function academyCheckout()
	{
		$data = [
			'title' => 'Academy - checkout'
		];	
		return view('pages/checkout',$data);
	}

	/**
     * Method untuk proses pembayaran
	 * dengan post '/academy/checkout'
	 * 
     * @return redirect
     */
	public function sendAcademyCheckout(){
		return redirect()->to('/academy/checkout');
	}

# Akhir System pembelian workshop ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

	/**
     * Method untuk proses mencoba fungsi/codingan
	 * dengan post '/coba'
     */	
	public function coba()
	{
            // $data = [
		// 	'title' => 'Academy - checkout'
		// ];	
            // return view("/pages/online_learning_checkout" , $data);
	}

}

?>