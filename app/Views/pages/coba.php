<!-- Navbar -->
<nav class="navbar navbar-expand-md navbar-light fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('/');?>">
            <img src="/img/logo/autoall.png" alt="Automate All" class="img-fluid" width="1160" height="328">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav d-flex align-items-center text-center">
                <li class="nav-item <?php if($title=='Welcome to Automate All'){echo 'active';}?>">
                    <a class="nav-link" href="<?= base_url('/');?>" title="Home">Home</a>
                </li>
                <li class="nav-item <?php if($title=='Academy' OR $title=='Academy - List' OR $title=='Academy - Detail'){echo 'active';}?>">
                    <a class="nav-link" href="<?= base_url('/academy');?>" title="Academy">Academy</a>
                </li>
                <li class="nav-item <?php if($title=='Products & Services' OR $title=='Detail Product'){echo 'active';}?>">
                    <a class="nav-link" href="<?= base_url('/productsAndServices');?>" title="Products & Services">Products & Services</a>
                </li>
                <li class="nav-item <?php if($title=='Our Main Value'){echo 'active';}?>">
                    <a class="nav-link" href="<?= base_url('/ourMainValue');?>" title="Our Main Value">Our Main Value</a>
                </li>
                <li class="nav-item <?php if($title=='Blog' OR $title=='All Articles' OR $title=='Article Details'){echo 'active';}?>">
                    <a class="nav-link" href="<?= base_url('/blog');?>" title="Blog">Blog</a>
                </li>
                <li class="nav-item <?php if($title=='Contact'){echo 'active';}?>">
                    <a class="nav-link"  href="<?= base_url('/contact');?>" title="Contact">Contact</a>
                </li>
                <!-- signup -->
                <li class="nav-item nav-item__auth <?php if($title=='Login'){echo 'active';}?>">
                    <?php if(isset($userdata['nama'])){ ?>
                        <div class="dropdown">
                            <a class="nav-link login" data-toggle="dropdown"><?= $userdata['nama'] ?></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= base_url('/logout');?>">Logout</a></li>
                            </ul>
                        </div>
                    <?php }else{ ?>
                          <a class="nav-link login" href="<?= base_url('/login');?>" title="Login">Login</a>
                          <button class="nav-link signup__btn" id="btn-modal-signup" class="modal-signup"  title="Login">Daftar</button>
                          <div id="modalSignup" class="modal__signup">
                            <div class="modalDaftar__wrap">
                            <div class="modal__content-signup">
                            <div class="btn__closeSignUp__wrapp"><button id="btn__closeSignUp"><img class="logo__google img-fluid" src="/img/vector/cancel.png"/></button></div> 
                              <form id="formSignUp" name="formSignUp" class="formSignUp" onsubmit="return(validateFormSignUp())">                                
                                <div class="form-group form-group__input" id="form-group__namalengkap">
                                  <label class="label__modaldaftar" for="namaSignup">Nama Lengkap</label>
                                  <input onchange="return(getValueSignUpInput())" class="input__modaldaftar input__modaldaftarUP" name="namaSignup" id="namaSignup" type="text" placeholder="Masukan nama anda"/>
                                </div>
                                <div class="form-group form-group__input" id="form-group__email">
                                  <label class="label__modaldaftar" for="emailSignup">E-mail</label>
                                  <input onchange="return(getValueSignUpInput())" class="input__modaldaftar input__modaldaftarUP" name="emailSignup" id="emailSignup" type="email" placeholder="Masukan email anda"/>                                  
                                </div>
                                <div class="form-group form-group__input" id="form-group__password">
                                  <label class="label__modaldaftar" for="passwordSignup">Password</label>
                                  <input onchange="return(getValueSignUpInput())" class="input__modaldaftar input__modaldaftarUP" name="passwordSignup" id="passwordSignup" type="password" placeholder="Buat password anda"/>                                  
                                </div>
                                <div class="form-group form-group__input" id="form-group__rptPassword">
                                  <label class="label__modaldaftar" for="rptPasswordSignup">Ulangi Password</label>
                                  <input onchange="return(getValueSignUpInput())" class="input__modaldaftar input__modaldaftarUP" name="rptPasswordSignup" id="rptPasswordSignup" type="password" placeholder="masukan ulang password anda"/>                                  
                                </div>
                                <div class="login__withwrapp" >

                                  <div class="login__with">
                                      <img class="logo__google img-fluid" src="/img/logo/google.png"/>                                    
                                      <p>Login dengan Google</p>                                    
                                  </div>
                                </div>
                                <div class="btn__signup__wrapp">
                                  <button class="btn__signup" id="btn__signup" >Lanjut</button>

                                </div>
                              </form>
                            </div>
                            </div>
                          </div>
                    <?php } ?>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Akhir Navbar -->
<script>
  var modalSignup = document.getElementById("modalSignup");

  // Get the button that opens the modal
  var btnSignup = document.getElementById("btn-modal-signup");

  // Get the <span> element that closes the modal
  var spanSignup = document.getElementById('btn__closeSignUp');

  // When the user clicks the button, open the modal 
  btnSignup.onclick = function() {
    modalSignup.style.display = "block";
  }

  // When the user clicks on <span> (x), close the modal
  spanSignup.onclick = function() {
    modalSignup.style.display = "none";
  }

    var formSignUp = document.getElementById('formSignUp')
    var getNamaSignup = document.getElementById('namaSignup')
    var getEmailSignup = document.getElementById('emailSignup')
    var getPasswordSignup = document.getElementById('passwordSignup')
    var getRptPasswordSignup = document.getElementById('rptPasswordSignup')

    formSignUp.addEventListener('submit' , e => {
      e.preventDefault();
      checkInputs();
    })

    function checkInputs(){
      const namaValueSignup = getNamaSignup.value.trim();
      const emailValueSignup = getEmailSignup.value.trim();
      const passwordSignup = getPasswordSignup.value.trim();
      const repeatPasswordValueSignup = getRptPasswordSignup.value.trim();
      if(namaValueSignup == "" || namaValueSignup == null){
        setErrorFor(getNamaSignupSignup)
      }

      if(emailValueSignup == "" || emailValueSignup == null){
        setErrorFor(getEmailSignupSignup)
      }

      if(passwordSignup == "" || passwordSignup == null){
        setErrorFor(getPasswordSignupSignup)
      }

      if(repeatPasswordValueSignup === "" || repeatPasswordValueSignup == null){
        setErrorFor(getRptPasswordSignupSignup)
      }else if(passwordSignup !== repeatPasswordValueSignup){
        setErrorFor(repeatPasswordValueSignup)
      }

      if(namaValueSignup === "" && emailValueSignup == "" && passwordSignup == "" && repeatPasswordValueSignup == ""){
        const btnSubmitSignup = document.getElementById("btn__signup");
        btnSubmitSignup.className = 'btnDisableSignUp'
        btnSubmitSignup.setAttribute('disabled' , "disabled")
      }
    }
    function setErrorFor(input) {
      const formControl = input.parentElement;
      formControl.className = 'form-group form-group__input error';
    }

    getNamaSignupSignup.addEventListener('focus', (e) => {
      e.target.style.background = '#F2F2F2';
      setBerhasil(getNamaSignupSignup)
    })
    getEmailSignup.addEventListener('focus', (e) => {
      e.target.style.background = '#F2F2F2';
      setBerhasil(getEmailSignup)
    })
    getPasswordSignup.addEventListener('focus', (e) => {
      e.target.style.background = '#F2F2F2';
      setBerhasil(getPasswordSignup)
    })
    getRptPasswordSignup.addEventListener('focus', (e) => {
      e.target.style.background = '#F2F2F2';
      setBerhasil(getRptPasswordSignup)
    })
    function setBerhasil(input){
      const formControl = input.parentElement;
      formControl.className = 'form-group form-group__input';
    }

    function getValueSignUpInput(){
      const namaValueSignup = getNamaSignup.value.trim();
      const emailValueSignup = getEmailSignup.value.trim();
      const passwordSignup = getPasswordSignup.value.trim();
      const repeatPasswordValueSignup = getRptPasswordSignup.value.trim();
      if(namaValueSignup != "" && emailValueSignup != "" && passwordSignup != "" && repeatPasswordValue != ""){
        const btnSubmitSignup = document.getElementById("btn__signup");
        btnSubmitSignup.removeAttribute('disabled')
        btnSubmitSignup.className = 'btn__signup'
      }
    }

</script>
