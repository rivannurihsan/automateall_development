<?php namespace App\Controllers;

class Pages extends BaseController
{	
	
	/**
     * Method untuk proses login
	 * dengan post '/login'
	 * 
     * @return redirect 
     */	
	public function sendRegis(){
		$rules = [
			'namaSignup' => [
				'rules' => 'required|string',
				'errors' => [
					'required' => 'Please enter your name.',
					'string' => 'Please provide a valid name.',
				]
			],
			'emailSignup' => [
				'rules' => 'required|valid_email|isEmailExcist',
				'errors' => [
					'required' => 'Please enter your email.',
					'valid_email' => 'Please provide a valid email.',
					'isEmailExcist' => 'Email already registered.<a style="font-size: 80%;color: #dc3545;" href="/login"> Login Now</a> ?',
				]
			],
			'passwordSignup' => [
				'rules' => 'required|min_length[3]',
				'errors' => [
					'required' => 'Please write your password.',
					'min_length' => 'Please enter more than 3 character',
				]
			],
			'rptPasswordSignup' => [
				'rules' => 'required|matches[passwordSignup]',
				'errors' => [
					'required' => 'Please re-enter your password.',
					'matches' => 'passwords do not match',
				]
			],
		];
		$valid = $this->validate($rules);
		if (!$valid) {
			return redirect()->to($_SERVER['HTTP_REFERER'])->withInput();
		}else{			
			$userMailS = preg_split('/@/', $_POST['emailSignup']);
			$userPassS = $_POST['passwordSignup'];

			/// Create User
			// Generate Random id
			$idList = $this->User->getColumn('id');
			$isUnique = false;
			while(!$isUnique) { 
				$id = $this->randomGenerator(10);
				if(!in_array($id, $idList)){
					$isUnique = true;
				}
			}

			// Insert User
			$user = [
				'pass'	=> $userPassS,
				'email'	=> $userMailS[0].'@'.$userMailS[1],
				'id'	=> $id,
				'nama'	=> $_POST['namaSignup'],
			];

			/// Send Confrimation Message
			// Link Generator
			$link 	= base_url('/verifyAccount?token=');
			$id		= $this->randomGenerator(10);
			$email	= $user['email'];
			$date	= date('Y-m-d H:i:s');
			$tokenS	= $this->encryption('tkn='.$id.'&email='.$email.'&date='.$date, $this->sKeyLink);
			$link	= $link.$tokenS;

			// Send Email
			$fromEmail = 'noreply@automateall.id';
			$from 	= 'Automate All';
			$to		= $userMailS[0].'@'.$userMailS[1];
			$subject= 'Konfirmasi Email Anda';
			$message="
				Hai, selamat datang di Automate All<br>
				Mohon verifikasi email untuk menyelesaikan akun dengan cara klik link berikut:<br>
				'.$link.'<br>
				
				Terimakasih,<br>
				The Automate All Team 
                The Automate All Team 
				The Automate All Team 
                The Automate All Team 
				The Automate All Team 
                The Automate All Team 
				The Automate All Team 
                The Automate All Team 
				The Automate All Team 
                The Automate All Team 
				The Automate All Team 
			";

			$linkconfirm = [
				'token'		=> $tokenS,
				'tglTerbuat'=> $date,
				'type'		=> 'verifyAccount',
			];
			
			if ($this->User->insertUser($user) && $this->LinkConfirm->insertLinkConfirm($linkconfirm) && $this->sendEmail($fromEmail, $from, $to, $subject, $message)) {
				$_SESSION['isKirim'] = 'RegisterAccountSend';
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}else{
				$_SESSION['isKirim'] = 'ErrorTechMessage';
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}
		}
	}

	public function sendVerifyMessage()
	{
		/// Send Confrimation Message
		// Link Generator
		$link 	= base_url('/verifyAccount?token=');
		$id		= $this->randomGenerator(10);
		$email	= $_SESSION['userData']['email'];
		$date	= date('Y-m-d H:i:s');
		$tokenS	= $this->encryption('tkn='.$id.'&email='.$email.'&date='.$date, $this->sKeyLink);
		$tokenS = str_replace(['+','/','='], ['xtamx','xgarx','xsamx'], $tokenS);
		$link	= $link.$tokenS;
		
		$userMailS = preg_split('/@/', $email);

		// Send Email
		$fromEmail = 'noreply@automateall.id';
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

		if ($this->LinkConfirm->insertLinkConfirm($linkconfirm) && $this->sendEmail($fromEmail, $from, $to, $subject, $message)) {
			$_SESSION['isKirim'] = 'VerifyMessageSend';
			return redirect()->to($_SERVER['HTTP_REFERER']);
		}else{
			$_SESSION['isKirim'] = 'ErrorTechMessage';
			return redirect()->to($_SERVER['HTTP_REFERER']);
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
			    $token = str_replace(['xtamx','xgarx','xsamx'], ['+','/','='], $_GET['token']);
				$get = $this->decryption($token, $this->sKeyLink);
				$token = preg_replace('/(tkn=|&email.*)/', '', $get);
				$emailS = preg_replace('/(.*&email=|&date=.*)/', '', $get);
				$emailS = preg_split('/@/', $emailS);
				$date = preg_replace('/(.*&date=)/', '', $get);

				$data = [
					'title' => 'Verify your Account',
					'emailS' => ($emailS[0]).'@'.$emailS[1],
					'email' => $emailS[0].'@'.$emailS[1],
					'date' => $date,
					'userdata' => $_SESSION['userData'],
					'validation' => \Config\Services::validation(),
				];
				$_SESSION['userData']['isVerifikasi'] = 1;
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
     * Method untuk proses login
	 * dengan post '/login'
	 * 
     * @return view|redirect 
     */
	public function sendLogin(){
		$rules = [
			'emailLogin' => [
				'rules' => 'required|valid_email',
				'errors' => [
					'required' => 'Please enter your password.',
					'valid_email' => 'Please provide a valid email.',
				]
			],
			'passwordLogin' => [
				'rules' => 'required|isLogedIn[{emailLogin}]',
				'errors' => [
					'required' => 'Please enter your password.',
					'isLogedIn' => 'Please check your email or password.',
				]
			],
		];
		$valid = $this->validate($rules);
		if (!$valid) {
			if ($_POST['emailLogin'] != $_POST['tryEmail']) {
				$_POST['countTry'] = 0;
				$tryEmail = $_POST['emailLogin'];
			}else{
				$tryEmail = $_POST['tryEmail'];
			}
			$countTry = (intval($_POST['countTry']) + 1);
			return redirect()->to($_SERVER['HTTP_REFERER'])->withInput()->with('countLogin', $countTry)->with('curEmail', $tryEmail);
		}else{
			$_SESSION['tryLoginCount'] = 0;

			$userMailS = preg_split('/@/', $_POST['emailLogin']);
			$userMailS = $userMailS[0].'@'.$userMailS[1];
			$userPassS = $_POST['passwordLogin'];

			$rawData = $this->User->getUser_by_login($userMailS, $userPassS);
			$_SESSION['userData'] = [
				'nama' => $rawData['nama'],
				'email' => (preg_split('/@/', $rawData['email'])[0]).'@'.preg_split('/@/', $rawData['email'])[1],
				'uniqueCode' => $rawData['uniqueCode'],
				'id' => $rawData['id'],
				'isVerifikasi' => $rawData['isVerifikasi'],
			];
			
			return redirect()->to($_SERVER['HTTP_REFERER']);
		}
	}

	/**
     * Method untuk mengirim pesan kepada email pengguna
	 * yang berisi link untuk reset password
	 * dengan post '/lupaPass'
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
			$tokenS = $this->encryption('tkn='.$id.'&email='.$email.'&date='.$date, $this->sKeyLink);
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
			return redirect()->to($_SERVER['HTTP_REFERER']);
		}else{
			return redirect()->to($_SERVER['HTTP_REFERER']);
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
			'title'=>'Welcome to Automate All',
			'validation' => \Config\Services::validation(),
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
			'validation' => \Config\Services::validation(),
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
			'validation' => \Config\Services::validation(),
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
			'validation' => \Config\Services::validation(),
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
			'validation' => \Config\Services::validation(),
		];
		if(isset($_SESSION['userData'])){
			$data['userdata'] = $_SESSION['userData'];
		}
		return view('pages/product',$data);
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
			'validation' 	=> \Config\Services::validation(),
		];
		if(isset($_SESSION['userData'])){
			$data['userdata'] = $_SESSION['userData'];
		}
		return view('pages/product_detail',$data);
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
			'title'=>'Our Main Value',
			'validation' => \Config\Services::validation(),
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
			    print($_POST['Email']);
			    $fromEmail = $_POST['Email'];
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
				
				if($this->sendEmail($fromEmail, $from, $to, $subject, $message)){
					$_SESSION['isKirim'] = 'ContactMessageSent';
					return redirect()->to('/contact');
				}else{
					$_SESSION['isKirim'] = 'ErrorTechMessage';
					return redirect()->to('/contact');
				}
			}
		}
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
			'title' => 'Academy',
			'validation' => \Config\Services::validation(),
		];
		if(isset($_SESSION['userData'])){
			$data['userdata'] = $_SESSION['userData'];
		}
		return view('pages/academy',$data);
	}

	# ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	/**
     * Method untuk membuat tampilan list akademi
	 * dengan link '/academy/list'
	 * 
     * @return view
     */
	public function academyList()
	{
		// get all academy data
		$academyData = $this->Academy->getAcademy(0,0,'waktuMulai');
		$academyData = $this->tranposeArray($academyData);

		// get list pendaftar
		$nameListArr = [];
		foreach ($academyData['id'] as $key => $value) {
			$idPendaftar = $this->Daftar->getDaftar(['idAcademy' => $value], 'idPendaftar');
			if (gettype($idPendaftar) == 'array') {	
				$nameList = [];
				for ($i=0; $i < count($idPendaftar); $i++) { 
					$nameList[$i] = $this->User->getUser(['id' => $idPendaftar[$i]], 'nama');
				}
				$nameListArr[$key] = $nameList;
			}elseif($idPendaftar != null){
				$nameList=[$this->User->getUser(['id' => $idPendaftar], 'nama')];
				$nameListArr[$key] = $nameList;
			}
			else {
				$nameListArr[$key] = [];
			}
		}

		$data = [
			'title' => 'Academy - List',
			'idAcademy' => $academyData['id'],
			'judul' => $academyData['judul'],
			'img' => $academyData['img'],
			'tanggal' => $this->dateToString($academyData['waktuMulai']),
			'jammulai' => $this->timeToString($academyData['waktuMulai']),
			'jamselesai' => $this->timeToString($academyData['waktuSelesai']),
			'price' => $academyData['price'],
			'isSelesai' => $academyData['isSelesai'],
			'isCanDaftar' => false,
			'validation' => \Config\Services::validation(),
		];

		// set variabel jika user login
		if (isset($_SESSION['userData'])) {
			// set variable
			foreach ($data['idAcademy'] as $key => $id) {	
				$data['isCanDaftar'][$key] = $this->Daftar->getDaftar(['idPendaftar' => $_SESSION['userData']['id'], 'idAcademy' => $id ], 'nama')?false:true;
			}
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
		if (isset($_GET['id'])) {
			// Get academy data
			$academyData = $this->Academy->getAcademy(['id' => $_GET['id']]);

			// get list pendaftar
			$idPendaftarList = $this->Daftar->getDaftar(['idAcademy' => $_GET['id']], 'idPendaftar');
			if (gettype($idPendaftarList) == 'array') {	
				$nameList = [];
				for ($i=0; $i < count($idPendaftarList); $i++) { 
					$nameList[$i] = $this->User->getUser(['id' => $idPendaftarList[$i]], 'nama');
				}
			}elseif (gettype($idPendaftarList)=='string') {
				$nameList=[$this->User->getUser(['id' => $idPendaftarList], 'nama')];
			}else {
				$nameList=false;
			}

			$data = [
				'title' 	=> 'Academy - Detail',

				'idAcademy'	=> $_GET['id'],
				'judul' 	=> $academyData['judul'],
				'subjudul' 	=> $academyData['subjudul'],
				'img' 		=> $academyData['img'],
				'isi' 		=> $academyData['isi'],
				'tanggal' 	=> $this->dateToString($academyData['waktuMulai']),
				'jammulai' 	=> $this->timeToString($academyData['waktuMulai']),
				'jamselesai'=> $this->timeToString($academyData['waktuSelesai']),
				'price' 	=> $academyData['price'],
				'listPeserta'	=> $nameList,

				'jumlahPengajak'=> null,
				'isCanGetCoupon'=> 0,
				'isCouponExist' => 0,
				'couponCode' 	=> 'Dapatkan kode voucher',

				'link' 		=> $academyData['link'],
				'isSelesai' => $academyData['isSelesai'],
				'isFree'	=> ($academyData['price'] == 'FREE')?true:false,
				'isCanDaftar'	=> 0,
				'isCanBayar'	=> 0,

				'validation'	=> \Config\Services::validation()
			];

			// set variabel jika user login
			if (isset($_SESSION['userData'])) {
				if (isset($_GET['openDaftar']) && $_GET['openDaftar']) {
					$_SESSION['isKirim'] = 'DaftarForm';
				}

				// hitung pengajak
				if ($academyData['keterangan'] == 'Free because other workshop part 1') {
					// get list diajak
					$jumlahPengajak = $this->Daftar->getDaftar(['idAcademy' => $academyData['idAcademy'], 'idPengajak' => $_SESSION['userData']['id']]);
					if (!$jumlahPengajak) {
						$data['jumlahPengajak'] = 0;
					}elseif (!(count($jumlahPengajak) == count($jumlahPengajak, COUNT_RECURSIVE))) {
						$data['jumlahPengajak'] = count($jumlahPengajak);
					}elseif (count($jumlahPengajak) == count($jumlahPengajak, COUNT_RECURSIVE)) {
						$data['jumlahPengajak'] = 1;
					}
					// set isCanGetCoupon
					if ($data['jumlahPengajak'] >= 10) {
						// check coupon exist
						$idVital = [
							'idUser'    => $_SESSION['userData']['id'],
							'idAcademy' => $_GET['id'],
						];
						$inviteCoupon = $this->Coupon->getCoupon(['keterangan'=>'Invite10', 'idVital'=>$idVital]);
						if ($inviteCoupon) {
							$data['isCouponExist'] = 1;
							$data['couponCode'] = 'Kode kupon : '.$inviteCoupon['code'];
						}else{
							$data['isCanGetCoupon'] = 1;
							$data['isCouponExist'] = 0;
						}
						$data['jumlahPengajak'] = 1;
					}
				}else{
					$data['jumlahPengajak'] = null;
				}

				// set variabel
				$data['idDaftar']		= $this->Daftar->getDaftar(['idPendaftar' => $_SESSION['userData']['id'], 'idAcademy' => $_GET['id']], 'nama');
				$data['isCanDaftar']	= ( $this->Daftar->getDaftar(['idPendaftar' => $_SESSION['userData']['id'], 'idAcademy' => $_GET['id']], 'nama') )?false:true;
				$data['isCanBayar'] 	= ( $this->Daftar->getDaftar(['idPendaftar' => $_SESSION['userData']['id'], 'idAcademy' => $_GET['id']], 'nama') )?true:false;
				$data['namaPendaftar'] 	= $_SESSION['userData']['nama'];
				$data['userdata'] 		= $_SESSION['userData'];
			}
			print_r($data['isCanGetCoupon']);
			return view('pages/academy_detail',$data);
		}else {
			return redirect()->to('/academy/list');
		}
	}

	public function sendCoupon(){
		$method = 'createCoupon_'.$_POST['ketCode'];
		$result = $this->Kupon->$method($_POST['uniqueCode'], $_SESSION['userData']['id'], $_GET['id']);

		if($result){
			$_SESSION['isKirim'] = 'CreateCouponSend';
		}else{
			$_SESSION['isKirim'] = 'ErrorTechMessage';
		}

		return redirect()->to($_SERVER['HTTP_REFERER']);
	}

	/**
     * Method untuk proses pendaftaran
	 * dengan post '/academy/detail'
	 * 
     * @return redirect
     */	
	public function sendAcademyDaftar(){
		$rules = [
			'Whatsapp' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Mohon masukan nomor whatsapp.',
				]
			],
			'Organisasi' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Mohon masukan perusahan/instansi.',
				]
			],
		];
		$valid = $this->validate($rules);
		if (!$valid) {
			return redirect()->to('/academy/detail/?id='.$_GET['id'])->withInput();
		}else{
			$academyData = $this->Academy->getAcademy(['id'=>$_GET['id']]);

			// data daftar
			$daftar = [
				'idPendaftar' 	=> $_SESSION['userData']['id'],
				'idPengajak' 	=> ($this->User->getUser(['nama' => $_POST['Pengajak']], 'id'))?$this->User->getUser(['nama' => $_POST['Pengajak']], 'id'):null,
				'idAcademy' 	=> $_GET['id'],
				'namaPengajak' 	=> $_POST['Pengajak'],
				'whatsapp' 		=> $_POST['Whatsapp'],
				'organisasi' 	=> $_POST['Organisasi'],
				'jumlahBayar'	=> $this->Academy->getAcademy_by_id($_GET['id'], 'price'),
				'tglDaftar' 	=> date('Y-m-d H:i:s'),
				'maxTglBayar' 	=> date('Y-m-d H:i:s', strtotime($this->Academy->getAcademy_by_id($_GET['id'], 'waktuMulai'). ' - 90 minutes')),
			];

			// if Free, send message
			if ($academyData['price'] == 'FREE') {
				// data email ke penjual
				$fromPenjualEmail = $_SESSION['userData']['email'];
				$fromPenjual 	= $_SESSION['userData']['email'];
				$toPenjual		= 'irfannugraha@automateall.id';
				$subjectPenjual	= "bukti pembayar";
				$messagePenjual	="
					Pelanggan telah mendaftar workshop gratis. Rekap pendaftaran : <br>
					1. Nama Pelanggan : ".$this->User->getUser(['id'=>$_SESSION['userData']['id']], 'nama')." <br>
					2. Nama Kegiatan : ".$academyData['judul']." <br>
					3. Tgl Mendaftar : ".date('Y-m-d H:i:s')." <br>
					4. Whatsapp	: ".$_POST['Whatsapp']." <br>
					5. Organisasi : ".$_POST['Organisasi']." <br>
				";
				if(!$this->sendEmail($fromPenjualEmail, $fromPenjual, $toPenjual, $subjectPenjual, $messagePenjual)){
					// $_SESSION['isKirim'] = 'ErrorTechMessage';
					return redirect()->to('/academy/detail/?id='.$_GET['id'])->with('isKirim', 'ErrorTechMessage');
				}
			}
			if($this->Daftar->insertDaftar($daftar)){
				$_SESSION['isKirim'] = 'DaftarAcademySend';
			}else{
				$_SESSION['isKirim'] = 'ErrorTechMessage';
			}

			// return redirect()->to('/academy/detail/?id='.$_GET['id']);
		}
	}

	/**
     * Method untuk membuat tampilan checkout
	 * dengan link '/academy/checkout'
	 * 
     * @return view
     */
	public function academyCheckout()
	{
		$daftarData = $this->Daftar->getDaftar(['nama' => $_GET['id']]);
		if($daftarData && isset($_SESSION['userData'])) {
			// get data
			$academyData = $this->Academy->getAcademy_by_id( $daftarData['idAcademy'] );

			$data = [
				'title' 		=> 'Academy - checkout',
				'namaKegiatan' 	=> $academyData['judul'],
				'maxBayar'		=> $this->dateToString($daftarData['maxTglBayar']).', Pukul '.$this->timeToString($daftarData['maxTglBayar']),
				'hargaAwal'		=> $this->intToMoney($daftarData['jumlahBayar']),
				'potongan'		=> $this->intToMoney(0),
				'totalHarga'	=> $this->intToMoney($daftarData['jumlahBayar']),
				'isBuktiBayar'	=> 1,
				'code'			=> null,
				'userdata'		=> $_SESSION['userData'],
				'validation'	=> \Config\Services::validation(),
			];

			// set coupon data
			if (isset($_SESSION['userData']['pesanan'][$_GET['id']])) {
				$couponCode = $_SESSION['userData']['pesanan'][$_GET['id']];
				$couponData = $this->Coupon->getCoupon_by_code( $couponCode );

				$method = 'getCoupon_'.$couponData['keterangan'];
				$Prices = $this->Kupon->$method( $daftarData['jumlahBayar'], $couponData['potongan'] );

				$data['code'] 		= $couponCode;
				$data['potongan'] 	= $this->intToMoney($Prices['potongan']);
				$data['totalHarga']	= $this->intToMoney($Prices['total']);
			}

			
			// set bayar data
			$bayarData = $this->Bayar->getBayar( ['idDaftar' => $daftarData['id']] );
			if ($bayarData) {
				$data['isBuktiBayar'] = ($bayarData['id'])?false:true;
				$data['keterangan'] = $bayarData['keterangan'];
			}else {
				// set bukti bayar
				$data['isBuktiBayar'] = ($data['totalHarga'] == 0)?false:true;
			}

			return view('pages/online_learning_checkout',$data);
		}else {
			return redirect()->to('/academy/detail?id='.$daftarData['idAcademy']);
		}
	}

	/**
     * Method untuk proses cek kupon dan memasukan kupon
	 * dengan post '/academy/inputkupon'
	 * 
     * @return redirect
     */
	public function sendAcademyCoupon(){
		// get coupon
		$where = [
			'code' => $_POST['code'], 
			'idVital' => [
				'idUser' => $this->Daftar->getDaftar(['nama' => $_GET['id']], 'idPendaftar'),
				'idAcademy' => $this->Daftar->getDaftar(['nama' => $_GET['id']], 'idAcademy'),
			],
			'jumlah' => 1,
		];
		$couponData = $this->Coupon->getCoupon($where);
		$isCoupon = ($couponData)?true:false;
		
		$rules = [
			'code' => [
				'rules' => 'required|isTrue['.$isCoupon.']',
				'errors' => [
					'required'	=> 'Mohon masukan kupon code',
					'isTrue'	=> 'Kupon code tidak ditemukan atau telah habis',
				]
			],
		];
		
		$valid = $this->validate($rules);
		if(!$valid){
			return redirect()->to('/academy/checkout?id='.$_GET['id'])->withInput();
		}else{
			if ($couponData) {
				$_SESSION['userData']['pesanan'][$_GET['id']] = $couponData['code'];
				$_SESSION['isKirim'] = 'CouponAppliedSend';
			}else {
				$_SESSION['isKirim'] = 'ErrorTechMessage';
			}
			return redirect()->to('/academy/checkout?id='.$_GET['id']);
		}
	}

	public function deleteAcademyCoupon(){
		$_SESSION['userData']['pesanan'][$_GET['id']] = null;
		return redirect()->to('/academy/checkout?id='.$_GET['id']);
	}

	/**
     * Method untuk proses pembayaran
	 * dengan post '/academy/checkout'
	 * 
     * @return redirect
     */
	public function sendAcademyCheckout(){
		// get data
		$daftarData = $this->Daftar->getDaftar(['nama' => $_GET['id']]);

		// get prices
		if (isset($_SESSION['userData']['pesanan'][$_GET['id']])) {
			$couponData = $this->Coupon->getCoupon( ['code' => $_SESSION['userData']['pesanan'][$_GET['id']]] );
			$method = 'getCoupon_'.$couponData['keterangan'];
			$prices = $this->Kupon->$method( $daftarData['jumlahBayar'], $couponData['potongan'] );
		}

		$rules = [
			'bukti' => [
				'rules' => 'uploaded[bukti]',
				'errors' => [
					'uploaded' => 'Mohon input bukti pembayaran.',
				],
			],
		];
		$valid = $this->validate($rules);
		if(!$valid && $prices['total']!=0 ){
			return redirect()->to('/academy/checkout?id='.$_GET['id'])->withInput();
		}else{
			// create data bayar
			$bayar = [
				'idDaftar' 	=> $daftarData['id'],
				'keterangan'=> 'pengecekan',
				'hargaAwal'	=> $daftarData['jumlahBayar'],
				'diskon'	=> 0,
				'total'		=> $daftarData['jumlahBayar'],	
				'bukti'		=> 'Free Entry',
			];

			// Add coupon to data bayar if exist
			if (isset($_SESSION['userData']['pesanan'][$_GET['id']])) {
				$bayar['idCoupon'] 	= $couponData['id'];
				$bayar['hargaAwal']	= $daftarData['jumlahBayar'];
				$bayar['diskon']	= $prices['potongan'];
				$bayar['total']		= $prices['total'];

				// set coupon data
				$coupon = [
					'jumlah' => $couponData['jumlah'] - 1,
				];
				if(!$this->Coupon->updateCoupon($coupon, ['id' => $couponData['id']])){
					$_SESSION['isKirim'] = 'ErrorTechMessage';
				}
			}

			// set bukti bayar location
			if ($bayar['total'] > 0) {
				$img = $this->request->getFile('bukti');
				$img->move(ROOTPATH.'/public/user/'.$_SESSION['userData']['uniqueCode'].'/pesan/'.$_GET['id']).'/'.$img->getName();
				$bayar['bukti'] = '/user/'.$_SESSION['userData']['uniqueCode'].'/pesan/'.$_GET['id'].'/'.$img->getName();
			}

			// data email ke pendaftar
			$fromEmailPendaftar = 'noreply@automateall.id';
			$fromPendaftar	 	= 'Automate All';
			$toPendaftar		= $_SESSION['userData']['email'];
			$subjectPendaftar	= "Checkout anda berhasil";
			$messagePendaftar	="
				Checkout anda telah kami terima. Selanjutnya kami akan melakukan verifikasi, silahkan melihat status checkout anda pada <a href='".$_SERVER['HTTP_REFERER']."'>link ini</a><br>
				Rekap pembelian : <br>
				1. Nama Kegiatan : ".$this->Academy->getAcademy(['id' => $daftarData['idAcademy']], 'judul')." <br>
				2. Tgl Pembayaran : ".date('Y-m-d H:i:s')." <br>
				3. Kode Kupon : ".((isset($couponData['code']))?$couponData['code']:'-')." <br>
				4. Bukti Pembayaran : ". (($bayar['bukti']=='Free Entry')?'-': "<a href='".base_url($bayar['bukti'])."'>bukti pembayaran</a>") ." <br>
				5. Harga Awal : ".$bayar['hargaAwal']." <br>
				6. Diskon : ".$bayar['diskon']." <br>
				7. Total Harga :".$bayar['total']." <br>
				<br>
				<br>
                Terimakasih,<br>
                The Automate All Team 
			";

			// data email ke penjual
			$fromEmailPenjual = $_SESSION['userData']['email'];
			$fromPenjual 	= $_SESSION['userData']['email'];
			$toPenjual		= 'irfannugraha@automateall.id';
			$subjectPenjual	= "bukti pembayar";
			$messagePenjual	="
				Pelanggan telah mengirim bukti pembayaran. Rekap pembayaran : <br>
				1. Nama Pelanggan : ".$this->User->getUser(['id'=>$_SESSION['userData']['id']], 'nama')." <br>
				1. Nama Kegiatan : ".$this->Academy->getAcademy(['id' => $daftarData['idAcademy']], 'judul')." <br>
				2. Tgl Pembayaran : ".date('Y-m-d H:i:s')." <br>
				3. Kode Kupon : ".((isset($couponData['code']))?$couponData['code']:'-')." <br>
				4. Bukti Pembayaran : ". (($bayar['bukti']=='Free Entry')?'-': "<a href='".base_url($bayar['bukti'])."'>bukti pembayaran</a>") ." <br>
				5. Harga Awal : ".$bayar['hargaAwal']." <br>
				6. Diskon : ".$bayar['diskon']." <br>
				7. Total Harga :".$bayar['total']." <br>
			";

			if( $this->Bayar->insertBayar($bayar) && $this->sendEmail($fromEmailPendaftar, $fromPendaftar, $toPendaftar, $subjectPendaftar, $messagePendaftar) && $this->sendEmail($fromEmailPenjual, $fromPenjual, $toPenjual, $subjectPenjual, $messagePenjual)) {
				$_SESSION['isKirim'] = 'CheckoutAcademySendFree';
			}else{
				$_SESSION['isKirim'] = 'ErrorTechMessage';
			}

			return redirect()->to('/academy/checkout?id='.$_GET['id']);
		}
	}

# Akhir System pembelian workshop ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

# ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	/**
     * Method untuk proses mencoba fungsi/codingan
	 * dengan post '/coba'
     */	
	public function coba()
	{
		print_r($_SESSION['userData']);
	}

	public function sendCoba()
	{
		helper(['form', 'url']);
	
			$rules = [
				'bukti' => [
					'rules' => 'uploaded[bukti]',
					'errors' => [
						'uploaded' => 'Mohon input bukti pembayaran.',
					],
				],
			];
			$valid = $this->validate($rules);
	
			$msg = 'Please select a valid bukti';
	 
		   if ($valid) {
			   $avatar = $this->request->getFile('bukti');
			   $avatar->move(WRITEPATH . 'uploads');
	
			 $data = [
	
			   'name' =>  $avatar->getClientName(),
			   'type'  => $avatar->getClientMimeType()
			 ];
	
			 $msg = 'File has been uploaded';
		   }

		   print_r($msg);
	
		//   return redirect()->to( base_url('/coba') )->with('msg', $msg);
	}

}

?>