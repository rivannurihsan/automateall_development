<?php namespace App\Controllers;

class Pages extends BaseController
{	
# mulai kelola user    
	
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
			$userPassS = ($_POST['passwordSignup']);

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
				'email'	=> ($userMailS[0]).'@'.$userMailS[1],
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
			$userMailS = ($userMailS[0]).'@'.$userMailS[1];
			$userPassS = ($_POST['passwordLogin']);

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
		$userMailS = ($userMailS[0]).'@'.$userMailS[1];
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
				'email' => ($emailS[0]).'@'.$emailS[1],
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
				'nama' => ($namaS),
			];

			// Create new variabel
			$data = ['pass' => ($_POST['NewPassword'])];
			$data['nama'] = ($oriData['nama']);

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

# akhir kelola user

# mulai tampilan halaman
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

    /**
	 * Method untuk membuat tampilan list akademi
	 * dengan link '/academy/list'
	 * 
	 * @return view
	 */
    public function academyList()
	{
		// // get all academy data
		$academyData = $this->Academy->getAcademy(0,0,'waktuMulai');
		$academyData = $this->tranposeArray($academyData);

		// // get course data
		// get kategori
		$kategoriData = array_unique($this->CourseOnline->getCourseOnline(0,['kategori']));

		// get course data
		$courseData = $this->CourseOnline->getCourseOnline();
		$courseData = $this->tranposeArray($courseData);

		// create price tag data
		$priceTag = array_map(function($n){return ($n>0)?'premium':'free'; },$courseData['biaya']);

		// get instruktur data
		$instructurData = array_map(function($n){return $this->CourseInstructur->getCourseInstructur(['id'=>$n]); },$courseData['idStruktur']);
		$instructurData = $this->tranposeArray($instructurData);
		
		// // push to data
		$data = [
			'title' 	=> 'Academy - List',
			'validation'=> \Config\Services::validation(),
			'workshop'	=> [
				'idAcademy' => $academyData['id'],
				'judul' 	=> $academyData['judul'],
				'img' 		=> $academyData['img'],
				'tanggal' 	=> $this->dateToString($academyData['waktuMulai']),
				'jammulai' 	=> $this->timeToString($academyData['waktuMulai']),
				'jamselesai'=> $this->timeToString($academyData['waktuSelesai']),
				'price' 	=> $academyData['price'],
				'isSelesai' => $academyData['isSelesai'],
				'isCanDaftar' => false,
			],
			'kategori' => $kategoriData,
			'course' => [
				'id'		=> $courseData['id'],
				'nama' 		=> $courseData['nama'],
				'deskripsi' => $courseData['deskripsiSingkat'],
				'thumbnail' => $courseData['linkThumbnail'],
				'kategori'	=> $courseData['kategori'],
				'biaya'		=> $this->intToMoney($courseData['biaya']),
				'priceTag' 	=> $priceTag,
				'durasiLangganan'=> $this->intToBerlangganan($courseData['durasiBerlangganan']),
				'namaInstruktur' => $instructurData['nama'],
				'deskInstruktur' => $instructurData['keterangan'],
			],
		];

		// // set variabel jika user login
		if (isset($_SESSION['userData'])) {
			// set variable
			foreach ($data['workshop']['idAcademy'] as $key => $id) {
				$data['workshop']['isCanDaftar'][$key] = $this->Daftar->getDaftar(['idPendaftar' => $_SESSION['userData']['id']]);
			}
			$data['userdata'] = $_SESSION['userData'];
			
			// // get user course data
			$daftarData = $this->CourseDaftar->getCourseDaftar(['idUser'=>$_SESSION['userData']['id']]);
			
			$data['userCourse'] = null;
			// cek if daftar data exist
			// cek array 2d
			if ($daftarData && (count($daftarData) != count($daftarData, COUNT_RECURSIVE))) {
				$userCourseData = [];
				foreach ($daftarData as $key => $value) {
					$bayarData = $this->Bayar->getBayar(['idCourseDaftar'=>$value['id'], 'keterangan'=>'terverifikasi']);
					
					if ($bayarData) {
						$userCourseData[$key] = $this->CourseOnline->getCourseOnline(['id'=>$value['idCourse']])[0];
						$userInstData[$key] = $this->CourseInstructur->getCourseInstructur(['id'=>$userCourseData[$key]['idStruktur']]);
						$idDaftarData[$key] = $value['id'];

						// get lastest episode
						$userSectionData = $this->CourseSection->getCourseSection(['idCourse'=>$userCourseData[$key]['id']], 0, 'no');
						foreach ($userSectionData as $key1 => $value1) {
							$userEpisodeData = $this->CourseEpisode->getCourseEpisode(['idSection'=>$value1['id']], 0, 'no');
							foreach ($userEpisodeData as $key2 => $value2) {
								$userProgressData = $this->CourseProgress->getCourseProgress(['idDaftar'=>$value['id'], 'idEpisode'=>$value2['id']]);
								// set lastest episode
								if(!isset($userProgressData['tglSelesai'])){
    								 if (!isset($userlastestEpisode[$key])) {
    									$userlastestEpisode[$key] = $value2['no'].'. '.$value2['nama'];
    								}   
								}
							}
							// set lastest episode if still null
							if (!isset($userlastestEpisode[$key])) {
							    $userlastestEpisode[$key] = $userEpisodeData[0]['no'].'. '.$userEpisodeData[0]['nama'];
							}							
						}
					}
				}
				if ($userCourseData) {
					$userCourseData = $this->tranposeArray($userCourseData);
					$userInstData = $this->tranposeArray($userInstData);

					// push to data
					$data['userCourse'] = [
					    'id'			=> $idDaftarData,
						'course'        => $userCourseData['id'],
						'thumbnail'		=> $userCourseData['linkThumbnail'],
						'nama' 			=> $userCourseData['nama'],
						'namaInstruktur' => $userInstData['nama'],
						'deskInstruktur' => $userInstData['keterangan'],
						'judul'			=> $userlastestEpisode,
					];
				}
			// cek array 1d
			}elseif($daftarData && count($daftarData) == count($daftarData, COUNT_RECURSIVE)){
				$bayarData = $this->Bayar->getBayar(['idCourseDaftar'=>$daftarData['id'], 'keterangan'=>'terverifikasi']);;
				if ($bayarData) {
					$userCourseData = $this->CourseOnline->getCourseOnline(['id'=>$daftarData['idCourse']])[0];
					$userInstData = $this->CourseInstructur->getCourseInstructur(['id'=>$userCourseData['idStruktur']]);
					
					// get lastest episode
					$userSectionData = $this->CourseSection->getCourseSection(['idCourse'=>$userCourseData['id']],0,'no');
					foreach ($userSectionData as $key => $value) {
						$userEpisodeData = $this->CourseEpisode->getCourseEpisode(['idSection'=>$value['id']],0,'no');
						foreach ($userEpisodeData as $key1 => $value1) {
							$userProgressData = $this->CourseProgress->getCourseProgress(['idDaftar'=>$daftarData['id'], 'idEpisode'=>$value1['id']]);

							// set lastest episode
							if (!isset($userlastestEpisode) && $userProgressData) {
								$userlastestEpisode = [
									'no'		=> $value1['no'],
									'judul' 	=> $value1['nama'],
								];
							}
						}
						// set lastest episode if still null
						if (!isset($userlastestEpisode)) {
							$userlastestEpisode = [
								'no'		=> $userEpisodeData[0]['no'],
								'judul' 	=> $userEpisodeData[0]['nama'],
							];
						}
					}

					$data['userCourse'] = [
						'id'			=> [0 => $daftarData['id']],
						'course'		=> [0 => $userCourseData['id']],
						'thumbnail'		=> [0 => $userCourseData['linkThumbnail']],
						'nama' 			=> [0 => $userCourseData['nama']],
						'namaInstruktur' => [0 => $userInstData['nama']],
						'deskInstruktur' => [0 => $userInstData['keterangan']],
						'judul'			=> [0=> $userlastestEpisode['no'].'. '.$userlastestEpisode['judul']],
					];
				}
			}
		
			// delete course data from userCourse
			$p = array_search($data['userCourse']['course'][0], $data['course']['id']);
			$data['course'] = (array_map(function($data)use($p){ unset($data[$p]);return array_values($data); }, $data['course']));
		}
		return view('pages/academy_list',$data);
	}
	
# akhir kelola halaman 

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

# Mulai System pembelian online course -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	/**
	 * Method untuk membuat tampilan detail online cousre
	 * dengan link '/course/detail'
	 * 
	 * @return view
	 */
	public function onlineCourseDetail()
	{
		if(isset($_GET['id']) || $_GET['id']='') {
			// get data from db
			$courseOnlineData = $this->CourseOnline->getCourseOnline(['id'=>$_GET['id']])[0];
			$sectionData = $this->CourseSection->getCourseSection(['idCourse'=>$courseOnlineData['id']], 0, 'no');
			$instructurData = $this->CourseInstructur->getCourseInstructur(['id'=>$courseOnlineData['idStruktur']]);

			// get introduction
			foreach ($sectionData as $value) {
				$temp = $this->CourseEpisode->getCourseEpisode(['idSection'=>$value['id'], 'isIntroduction'=>1]);
				($temp)?$introduction = $temp:null;
			}

			$data = [
				'title' 		=> 'Course - detail',

				'id' 			=> $courseOnlineData['id'],
				'nama' 			=> $courseOnlineData['nama'],
				'kategori' 		=> $courseOnlineData['kategori'],
				'deskripsiSingkat'=> $courseOnlineData['deskripsiSingkat'],
				'deskripsi' 	=> $courseOnlineData['deskripsi'],
				'persyaratan' 	=> explode(';;', $courseOnlineData['persyaratan']),
				'mendapatkan' 	=> explode(';;', $courseOnlineData['mendapatkan']),
				'mempelajari' 	=> explode(';;', $courseOnlineData['mempelajari']),
				'idStruktur' 	=> $courseOnlineData['idStruktur'],
				'lastUpdate' 	=> $courseOnlineData['lastUpdate'],
				'biaya' 		=> $this->intToMoney($courseOnlineData['biaya']),
				'tools' 		=> explode(';;', $courseOnlineData['tools']),
				'OS' 			=> $courseOnlineData['OS'],
				'RAM' 			=> $courseOnlineData['RAM'],
				'storage' 		=> $courseOnlineData['Storage'],
				'isCheckout'	=> 0,
				'isTerdaftar'	=> 0,

				'introduction'	=> [
					'thumbnail'		=> $courseOnlineData['linkThumbnail'],
					'nama'			=> $introduction[0]['nama'],
					'video'			=> $introduction[0]['linkVideo'],
				],

				'namaInstruktur'=> $instructurData['nama'],
				'keteranganInstruktur'=> $instructurData['keterangan'],

				'validation'	=> \Config\Services::validation(),
			];
			
			// set section and episode
			foreach ($sectionData as $key => $value) {
				$data['section'][$key]['judul'] = $value['nama'];
				$episodeData = $this->CourseEpisode->getCourseEpisode(['idSection'=>$value['id']], 0, 'no');
				foreach ($episodeData as $key2 => $value2) {
					$data['section'][$key]['episode'][$key2]['judul'] = $value2['nama'];
				}
			}

			if (isset($_SESSION['userData'])){
				// set userData
				$data['userdata'] = $_SESSION['userData'];

				// set isCheckout true
				$dataDaftar = $this->CourseDaftar->getCourseDaftar([ 'idCourse'=>$_GET['id'], 'idUser'=>$_SESSION['userData']['id'] ]);
				if ($dataDaftar) {
					$data['isCheckout'] = 1;
					$data['idDaftar'] = $dataDaftar['id'];
				}	

				// ser isTerdaftar true
				if ($dataDaftar) {
					$dataBayar = $this->Bayar->getBayar([ 'idDaftar'=>$dataDaftar['id'] ]);
					if ($dataBayar) {
						$data['isTerdaftar'] = 1;
						$data['isCheckout'] = 0;
					}
				}
			}

			// print("<pre>".print_r($data,true)."</pre>");

			return view('pages/onlineCourseDetail',$data);
		}else {
			return redirect()->to('/academy/list');
		}
	}

	/**
	 * Method untuk membuat tampilan streaming online cousre
	 * dengan link '/course/streaming'
	 * 
	 * @return view
	 */
	public function onlineCourseStreaming()
	{
		if(isset($_GET['id']) && $_GET['id'] && isset($_GET['course']) && $_GET['course'] && isset($_SESSION['userData'])) {
			$daftar = $this->CourseDaftar->getCourseDaftar(['id'=>$_GET['id'], 'idCourse'=>$_GET['course'], 'idUser'=>$_SESSION['userData']['id']]);
			if ( $daftar ) {
				$courseOnlineData = $this->CourseOnline->getCourseOnline(['id'=>$daftar['idCourse']])[0];
				$sectionData = $this->CourseSection->getCourseSection(['idCourse'=>$courseOnlineData['id']], 0, 'no');
				$totalEpisode = 0;
				$totalDone = 0;
				

				// get and set episode data
				$section = [];
				foreach ($sectionData as $key => $value) {
					// get data episode
					$episodeData = $this->CourseEpisode->getCourseEpisode(['idSection'=>$value['id']], 0, 'no');
					$section[$key] = [
						'judul' 	=> $value['nama'],
						'jumlahEps'	=> ($episodeData)?count($episodeData):0,
					];

					foreach ($episodeData as $key2 => $value2) {
						
						// get data progress
						$progressData = $this->CourseProgress->getCourseProgress(['idDaftar'=>$daftar['id'], 'idEpisode'=>$value2['id']]);

						// set episode data
						$section[$key]['episode'][$key2] = [
								'id'		=> $value2['id'],
								'judul' 	=> $value2['nama'],
								'linkVideo'	=> $value2['linkVideo'],
								'durasi'	=> explode(':',$value2['durasi'])[0].' menit '.explode(':',$value2['durasi'])[1].' detik ',
						];
						
				        // set if certificate available
				        $totalEpisode += 1;
						if(isset($progressData['tglSelesai'])){
						    $section[$key]['episode'][$key2]['isSelesai'] = 1;
						    $totalDone += 1;
						}else{
						    $section[$key]['episode'][$key2]['isSelesai'] = 0;
						}

						// set isSelesai dan lastEpisode
						if (!isset($progressData['tglSelesai'])) {
						    
							// set lastest episode
							if (!isset($lastestEpisode)) {
								$lastestEpisode = [
								    'id'        => $value2['id'],
									'judulSection'=> $value['nama'],
									'judul' 	=> $value2['nama'],
									'linkVideo'	=> $value2['linkVideo'],
									'isSelesai'	=> 0,
								];
							}
							
						}

					}
					
				}

				// set lastestEpisode if not set yet
				if (!isset($lastestEpisode)) {
					$lastestEpsData = $this->CourseEpisode->getCourseEpisode(['id'=>$section[0]['episode'][0]['id']]);
					$lastestSecData = $this->CourseSection->getCourseSection(['id'=>$lastestEpsData['idSection']]);
					$lastestProData = $this->CourseProgress->getCourseProgress(['idDaftar'=>$daftar['id'], 'idEpisode'=>$lastestEpsData['id']]);
					$lastestEpisode = [
						'id'		=> $section[0]['episode'][0]['id'],
						'judulSection'=>$lastestSecData['nama'],
						'judul' 	=> $lastestEpsData['nama'],
						'linkVideo'	=> $lastestEpsData['linkVideo'],
						'isSelesai'	=> (isset($progressData['tglSelesai'])?1:0),
					];
				}

				// set data
				$data = [
					'title' 		=> 'Course - detail',
					'userdata'		=> $_SESSION['userData'],
					'validation'	=> \Config\Services::validation(),

					'nama'			=> $courseOnlineData['nama'],
					'linkTelegram'	=> $courseOnlineData['linkTelegram'],
					'linkMateri'    => $courseOnlineData['linkMateri'],
					'rating'		=> $daftar['rating'],
					'ulasan'		=> $daftar['ulasan'],
					'section'		=> $section,
					'lastestEpisode'=> $lastestEpisode,
					'isCanDownSertif'=> ($totalDone >= $totalEpisode)?1:0,
				];
				// print("<pre>".print_r($data,true)."</pre>");
				return view('pages/onlineCourseStreamingStatic',$data);
			}
			return redirect()->to('/academy/list');
		}
		return redirect()->to('/academy/list');
	}

	public function sendOnlineCourseDaftar(){
		if ($_SESSION['userData']) {
			$courseData = $this->CourseOnline->getCourseOnline(['id'=>$_POST['id']])[0];
			$userData = $this->User->getUser(['id'=>$_SESSION['userData']['id']]);	

			$daftar = [
				'idCourse'	=> $courseData['id'],
				'idUser'	=> $userData['id'],
				'maxTglBayar'=> date('Y-m-d H:i:s'),
				'jumlahBayar'=> $courseData['biaya'],
			];

			if($this->CourseDaftar->insertCourseDaftar($daftar)){
				$_SESSION['isKirim'] = 'sendCourseDaftarSuccess';
			}else {
				// rollback Insert
				$insertedId = $this->CourseDaftar->getCourseDaftar($daftar);
				$this->CourseDaftar->rollbackInsertCourseDaftar($insertedId);

				$_SESSION['isKirim'] = 'errorTechMessage';
			}
		}else{
			$_SESSION['isKirim'] = 'errorTechMessage';
		}

		return redirect()->to('/onlineCourse/detail/?category='.$_POST['category'].'&id='.$_POST['id']);
	}

	/**
	 * Method untuk membuat tampilan checkout
	 * dengan link '/checkout'
	 * 
	 * @return view
	 */
	public function checkout()
	{
		$daftarData = $this->CourseDaftar->getCourseDaftar(['id' => $_GET['id']]);
		if($daftarData && isset($_SESSION['userData'])) {
			// get data
			$courseData = $this->CourseOnline->getCourseOnline( ['id'=>$daftarData['idCourse']] )[0];

			$data = [
				'title' 		=> 'Checkout',
				'id'			=> $daftarData['id'],
				'namaKegiatan' 	=> $courseData['nama'],
				'kategori'		=> 'Online Course',
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
				$data['isBuktiBayar'] = ($data['totalHarga'] == 0)?false:true;

				// set bayar data
				$bayarData = $this->Bayar->getBayar( ['idCourseDaftar' => $daftarData['id']] );
				if ($bayarData) {
					$data['isBuktiBayar'] = ($bayarData['id'])?false:true;
					$data['keterangan'] = $bayarData['keterangan'];
				}else {
					$data['isBuktiBayar'] = ($data['totalHarga'] == 0)?false:true;
				}
			}

			
			return view('pages/checkout',$data);
		}else {
			return redirect()->to('/onlineCourse/detail?id='.$daftarData['id']);
		}
	}

	public function sendCheckoutOnlineCourse(){
		// get data
		$daftarData = $this->Daftar->getDaftar(['id'=>$_GET['id']]);

		// get prices
		if (isset($_SESSION['userData']['pesanan'][$_GET['id']])) {
			$couponData = $this->Coupon->getCoupon( ['code' => $_SESSION['userData']['pesanan'][$_GET['id']]] );
			$method = 'getCoupon_'.$couponData['keterangan'];
			$prices = $this->Kupon->$method( $daftarData['jumlahBayar'], $couponData['potongan'] );
		}

	}

	/**
	 * Method untuk proses pembayaran
	 * dengan post '/academy/checkout'
	 * 
	 * @return redirect
	 */
	public function sendCheckout(){
		// get data
		$daftarData = $this->CourseDaftar->getCourseDaftar(['id' => $_GET['id']]);

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
		if(!$valid){
			return redirect()->to('/checkout?id='.$_GET['id'])->withInput();
		}else{
			// create data bayar
			$bayar = [
				'idCourseDaftar' 	=> $daftarData['id'],
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
				1. Nama Kegiatan : ".$this->CourseOnline->getCourseOnline(['id' => $daftarData['idCourse']], 'nama')[0]." <br>
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
				1. Nama Kegiatan : ".$this->CourseOnline->getCourseOnline(['id' => $daftarData['idCourse']], 'nama')[0]." <br>
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

			return redirect()->to('/checkout?id='.$_GET['id']);
		}
	}
	
	public function sendOnlineCourseUlasan(){
		$daftarData = $this->CourseDaftar->getCourseDaftar(['id'=>$_GET['id'], 'idCourse'=>$_GET['course'], 'idUser'=>$_SESSION['userData']['id']]);
		if ($daftarData) {
			$daftar = [
				'rating'	=> $_POST['rate'],
				'ulasan'	=> $_POST['review-desc'],
			];
	
			if($this->CourseDaftar->updateCourseDaftar($daftar, ['id'=>$daftarData['id']])) {
				$_SESSION['isKirim'] = 'sendCourseUlasanSuccess';
			}else{
				// rollback update
				$updateId = $this->CourseDaftar->getCourseDaftar(0,'id','updateDate')[0];
				$this->CourseDaftar->rollbackUpdateCourseDaftar($updateId);
	
				$_SESSION['isKirim'] = 'errorTechMessage';
			}
		}else{
			$_SESSION['isKirim'] = 'errorTechMessage';
		}
		return redirect()->to('/onlineCourse/streaming?id='.($_GET['id']).'&course='.($_GET['course']));
	}

	public function sendOnlineCourseSelesai(){
		$daftarData = $this->CourseDaftar->getCourseDaftar(['id'=>$_GET['id'], 'idCourse'=>$_GET['course'], 'idUser'=>$_SESSION['userData']['id']]);
		$episodeData = $this->CourseEpisode->getCourseEpisode(['id'=>$_GET['episode']])[0];
		if ($daftarData) {
			$progress = [
				'idDaftar'	=> $daftarData['id'],
				'idEpisode'	=> $episodeData['id'],
			];
			if($this->CourseProgress->insertCourseProgress($progress)) {
				$_SESSION['isKirim'] = 'sendCourseTandaiSuccess';
			}else{
				$_SESSION['isKirim'] = 'errorTechMessage';
			}
		}else{
			$_SESSION['isKirim'] = 'errorTechMessage';
		}
		return redirect()->to('/onlineCourse/streaming?id='.($_GET['id']).'&course='.($_GET['course']));
	}
	
	public function sendOnlineCourseSertifikat(){
	    $daftar = $this->CourseDaftar->getCourseDaftar(['id'=>$_GET['id'], 'idCourse'=>$_GET['course'], 'idUser'=>$_SESSION['userData']['id']]);
	    if($daftar){
	        if(!$daftar['idSertifikat']){
	            $user = $this->User->getUser(['id'=>$_SESSION['userData']['id']]);
    	        $course = $this->CourseOnline->getCourseOnline(['id'=>$_GET['course']])[0];
    	        $instruktur = $this->CourseInstructur->getCourseInstructur(['id'=>$course['idStruktur']]);
    	        
    	        // set token number
    	        $tknUsr = $this->encryption($user['id'], 'DT98RPBID9');
    	        $tknCourse = $this->encryption(str_replace('CON','',$course['id']), 'DT98RPBID9');
    	        
    	       // generate random id for serifikat
    	        $id = $this->CourseSertifikat->getCourseSertifikat(0,'id');
    	        (gettype($id)!='array')?$idList[0] = $id:$idList = $id;
                if ($idList) {
                    $isUnique = false;
                    while(!$isUnique) { 
                        $idSert = $this->randomGenerator(5);
                        $idSert = $idSert;
                        if(!in_array($idSert, $idList)){
                            $isUnique = true;
                        }
                    }
                    $idSert = 'CST'.$idSert;
                }else {
                    $idSert = 'CST'.$this->randomGenerator(5);
                }
                
                //  set sertifikat data
                $sertifikatData = [ 
    	            'id'        => $idSert,
    	            'token'     => 'SAI-OC-'.$tknUsr.'-'.$tknCourse,
    	            'version'   => 1,
                ];
                $sertifikatData['location'] = ('/public/user/'.$_SESSION['userData']['uniqueCode'].'/pesan/'.$daftar['id']).'/'.$sertifikatData['token'].'.pdf';
        		
                // input Sertifikat
        		if($this->CourseSertifikat->insertCourseSertifikat($sertifikatData) && $this->CourseDaftar->updateCourseDaftar(['idSertifikat' => $sertifikatData['id']], ['id'=>$daftar['id']])){
                    /// Generate Sertificate
                    // set template
            		$this->pdf -> setSourceFile(WRITEPATH.'certificate/Sertif ins '.$instruktur['nama'].'.pdf');
            		$tplIdx = $this->pdf -> importPage(1);
            		$size = $this->pdf->getTemplateSize($tplIdx);
            		$this->pdf -> AddPage($size['orientation']);
            		$this->pdf ->useTemplate($tplIdx, null, null, $size['width'], $size['height'], true);
            		$this->pdf->SetAutoPageBreak(false);
            
            		// write 
            		$this->pdf -> SetFont('Arial', false, 40);
            		$this->pdf -> SetTextColor(0, 0, 0);
            		$this->pdf->SetFillColor(255,255,255);
            		$this->pdf -> SetXY(0, 0);
            		$this->pdf->Cell(152.4, 10, '', 0, 0, 'C');
            		$this->pdf->Cell(152.4, 135, '', 0, 2, 'C');
            		
            		$this->pdf -> SetFont('Arial', 'B', 40);
            		$this->pdf -> SetTextColor(12, 76, 117);
            		$this->pdf->Cell(152.4, 20, strtoupper($user['nama']), 0, 2, 'C', true);
            		
            		$this->pdf->Cell(152.4, 30, '', 0, 2, 'C');
            		
            		$this->pdf -> SetTextColor(12, 76, 117);
            		$this->pdf -> SetFont('Arial', 'B', 30);
            		$this->pdf->Cell(152.4, 19, $course['nama'], 0, 2, 'C', true);
            
                    $this->pdf -> SetTextColor(0, 0, 0);
            		$this->pdf -> SetFont('Arial', false, 20);
            		$this->pdf->Cell(152.4, 10, 'Pada Minggu, 32 Desember 2020', 0, 2, 'C', true);
            
            		$this->pdf->Cell(152.4, 98, '', 0, 2, 'C');
            		
            		$this->pdf -> SetFont('Arial', false, 13);
            		$this->pdf->Cell(152.4, 10, $sertifikatData['token'].' | Version '.$sertifikatData['version'], 0, 2, 'C', true);
            
            		$this->response->setHeader('Content-Type', 'application/pdf');
            		$this->pdf->Output('I', $sertifikatData['token'].'.pdf');
            		$this->pdf->Output('F', (ROOTPATH.'/public/user/'.$_SESSION['userData']['uniqueCode'].'/pesan/'.$daftar['id']).'/'.$sertifikatData['token'].'.pdf');
        		}else{
                    // rollback insert
    				$updateId = $this->CourseSertifikat->getCourseSertifikat(0,'id','updateDate')[0];
    				$this->CourseSertifikat->rollbackInsertCourseSertifikat($updateId);
    				
    				// rollback update
    				$updateId = $this->CourseDaftar->getCourseDaftar(0,'id','updateDate')[0];
    				$this->CourseDaftar->rollbackUpdateCourseDaftar(['id'=>$daftar['id']]);
        		}
	        }else{
	            $sertifikat = $this->CourseSertifikat->getCourseSertifikat(['id'=>$daftar['idSertifikat']]);
	            
	            $this->pdf->setSourceFile( ROOTPATH.$sertifikat['location'] );
        		$tplIdx = $this->pdf -> importPage(1);
        		$size = $this->pdf->getTemplateSize($tplIdx);
        		$this->pdf -> AddPage($size['orientation']);
        		$this->pdf ->useTemplate($tplIdx, null, null, $size['width'], $size['height'], true);
        		
        		$this->response->setHeader('Content-Type', 'application/pdf');
        		$this->pdf->Output('I', $sertifikat['token'].'.pdf');
	        }
	    }
	}

# Akhir System pembelian online course -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

# Mulai Checkout
	/**
	 * Method untuk proses cek kupon dan memasukan kupon
	 * dengan post '/academy/inputkupon'
	 * 
	 * @return redirect
	 */
	public function useCoupon(){
		// get coupon
		$idVital = [
		// $this->CourseDaftar->getCourseDaftar(['id' => $_POST['id']], 'id'),
		];

		$where = [
			'code' => $_POST['code'], 
			// 'idVital' => $idVital,
			'jumlah !=' => 0,
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
			return redirect()->to('/checkout?id='.$_GET['id'])->withInput();
		}else{
			if ($couponData) {
				$_SESSION['userData']['pesanan'][$_GET['id']] = $couponData['code'];
				$_SESSION['isKirim'] = 'CouponAppliedSend';
			}else {
				$_SESSION['isKirim'] = 'ErrorTechMessage';
			}
			return redirect()->to('/checkout?id='.$_GET['id']);
		}
	}

	public function unUseCoupon(){
		$_SESSION['userData']['pesanan'][$_GET['id']] = null;
		return redirect()->to('/checkout?id='.$_GET['id']);
	}
	
# Akhir Checkout

# Mulai Lainya
	/**
     * Method untuk proses mencoba fungsi/codingan
	 * dengan post '/coba'
     */	
	public function coba()
	{
		// set template
		$this->pdf -> setSourceFile(WRITEPATH.'certificate/Sertif instruktur dicky.pdf');
		$tplIdx = $this->pdf -> importPage(1);
		$size = $this->pdf->getTemplateSize($tplIdx);
		$this->pdf -> AddPage($size['orientation']);
		$this->pdf ->useTemplate($tplIdx, null, null, $size['width'], $size['height'], true);
		$this->pdf->SetAutoPageBreak(false);

		// write 
		$this->pdf -> SetFont('Arial', false, 40);
		$this->pdf -> SetTextColor(0, 0, 0);
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf -> SetXY(0, 0);
		$this->pdf->Cell(152.4, 10, '', 0, 0, 'C');
		$this->pdf->Cell(152.4, 135, '', 0, 2, 'C');

		$this->pdf -> SetTextColor(0, 0, 0);
		$this->pdf->Cell(152.4, 20, 'IRFAN NUGRAHA', 0, 2, 'C', true);
		$this->pdf->Cell(152.4, 34, '', 0, 2, 'C');

		$this->pdf -> SetFont('Arial', false, 30);
		$this->pdf->Cell(152.4, 15, 'Masak Telor', 0, 2, 'C', true);

		$this->pdf -> SetFont('Arial', false, 20);
		$this->pdf->Cell(152.4, 10, 'Pada Minggu, 32 Desember 2020', 0, 2, 'C', true);

		$this->pdf->Cell(152.4, 98, '', 0, 2, 'C');

		$this->pdf -> SetFont('Arial', false, 15);
		$this->pdf->Cell(152.4, 10, 'numbre-numbre-number', 0, 2, 'C', true);

		$this->response->setHeader('Content-Type', 'application/pdf');
		$this->pdf->Output('I', 'generated.pdf');
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
	
		//   return redirect()->to( base_url('/coba') )->with('msg', $msg);
	}
# Akhir Lainya

}

?>