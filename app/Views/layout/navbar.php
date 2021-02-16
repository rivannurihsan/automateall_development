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

                <!-- name tab if user loged in -->
                <?php if(isset($userdata['nama'])){ ?>
                <li class="nav-item nav-item__auth">
                  <div class="dropdown">
                      <a class="nav-link login" data-toggle="dropdown" title="<?= $userdata['nama'] ?>"><?= $userdata['nama'] ?></a>
                      <ul class="dropdown-menu">
                          <?php if($userdata['isVerifikasi']){ ?>
                            <li><a style="cursor: default;">Email Terverifikasi</a></li>
                          <?php }else{ ?>
                            <li><a href="<?= base_url('/sendVerifyMessage');?>">Verifikasi Email</a></li>
                          <?php }?>
                          <li><a href="<?= base_url('/logout');?>">Logout</a></li>
                      </ul>
                  </div>
                </li>
                <?php }else{ ?>

                <!-- login tab -->
                <li class="nav-item nav-item__auth">
                  <a class="nav-link login" id="btn-modal-login" class="modal-login" title="Login">Login</a>
                  <div id="modalLogin" class="modal__login">
                    <div class="modalLogin__wrap">
                      <div class="modal__content-login">
                        <div class="btn__closeLogin__wrap"><button id="btn__closeLogin"><img class="logo__google img-fluid" src="/img/vector/cancel.svg"/></button></div>
                        <form name="formLogin" class="formLogin" method="POST" action="<?=base_url('/login');?>">
                          <div class="form-group div__modalLogin" id="form-group__email">
                            <label class="label__modalLogin" for="emailLogin">E-mail</label>
                            <input class="input__modalLogin input__modalLogins <?= ($validation->hasError('emailLogin'))?'input__modalLoginError':''; ?>" value="<?= old('emailLogin');?>" name="emailLogin" id="emailLogin" type="email" placeholder="Masukan email anda"/>
                          </div>
                          <div class="form-group div__modalLogins" id="form-group__password">
                            <label class="label__modalLogin" for="passwordLogin">Password</label>
                            <input class="input__modalLogin input__modalLogins <?= ($validation->hasError('passwordLogin'))?'input__modalLoginError':''; ?>" value="<?= old('passwordLogin');?>" name="passwordLogin" id="passwordLogin" type="password" placeholder="Masukan password anda"/>
                          </div>
                          <!-- <div class="login__withwrap" >
                            <div class="login__with">
                                <img class="logo__google img-fluid" src="/img/logo/google.png"/>                                    
                                <p>Login dengan Google</p>
                            </div>
                          </div> -->
                          <div class="signup_linkwrap">

                              <!-- show reset password -->
                              <?php if(isset($_SESSION['countLogin']) && $_SESSION['countLogin'] >= 3){ ?>
                                <a class="signup_link" href="javascript:{}" onclick="document.getElementById('lupaPassForm').submit(); return false;">Ubah password</a>
                              <?php } ?>
                              <a class="signup_link" onclick="{modalSignup.style.display = 'block'; modalLogin.style.display = 'none';}">Saya tidak punya akun</a>
                              <input style="display: none;" type="text" name="countTry" readonly value="<?php print(isset($_SESSION['countLogin'])?$_SESSION['countLogin']:null); ?>">
                              <input style="display: none;" type="text" name="tryEmail" readonly value="<?php print(isset($_SESSION['curEmail'])?$_SESSION['curEmail']:null); ?>">
                              <input form="lupaPassForm" style="display: none;" type="text" name="EmailCopy" id="EmailCopy" value="<?= old('emailLogin');?>" readonly>
                          </div>
                          <div class="btn__login__wrap">
                            <input type="submit" class="btn__login" id="btn__login" value="Lanjut"
                              <?= ($validation->hasError('emailLogin') || $validation->hasError('passwordLogin'))?'style="background: rgba(15, 76, 117, 0.25);" disabled':null ?>
                            />
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </li>

                <!-- register tab -->
                <li class="nav-item nav-item__auth">
                  <a class="nav-link regist" id="btn-modal-signup" class="modal-signup" title="Daftar">Daftar</a>
                  <div id="modalSignup" class="modal__signup">
                    <div class="modalDaftar__wrap">
                    <div class="modal__content-signup">
                    <div class="btn__closeSignUp__wrapp"><button id="btn__closeSignUp"><img class="logo__google img-fluid" src="/img/vector/cancel.svg"/></button></div>
                      <form id="formSignUp" name="formSignUp" class="formSignUp" method="POST" action="<?=base_url('/regis');?>">
                        <div class="form-group form-group__input" id="form-group__namalengkap">
                          <label class="label__modaldaftar" for="namaSignup">Nama Lengkap</label>
                          <input value="<?= old('namaSignup');?>" class="input__modaldaftar input__modaldaftarUP <?= ($validation->hasError('namaSignup'))?'input__modalLoginError':''; ?>" name="namaSignup" id="namaSignup" type="text" placeholder="Masukan nama anda" maxlength="30"/>
                        </div>
                        <div class="form-group form-group__input" id="form-group__email">
                          <label class="label__modaldaftar" for="emailSignup">E-mail</label>
                          <input value="<?= old('emailSignup');?>" class="input__modaldaftar input__modaldaftarUP <?= ($validation->hasError('emailSignup'))?'input__modalLoginError':''; ?>" name="emailSignup" id="emailSignup" type="email" placeholder="Masukan email anda"/>                                  
                        </div>
                        <div class="form-group form-group__input" id="form-group__password">
                          <label class="label__modaldaftar" for="passwordSignup">Password</label>
                          <input value="<?= old('passwordSignup');?>" class="input__modaldaftar input__modaldaftarUP <?= ($validation->hasError('passwordSignup'))?'input__modalLoginError':''; ?>" name="passwordSignup" id="passwordSignup" type="password" placeholder="Buat password anda"/>                                  
                        </div>
                        <div class="form-group form-group__input" id="form-group__rptPassword">
                          <label class="label__modaldaftar" for="rptPasswordSignup">Ulangi Password</label>
                          <input value="<?= old('rptPasswordSignup');?>" class="input__modaldaftar input__modaldaftarUP <?= ($validation->hasError('rptPasswordSignup'))?'input__modalLoginError':''; ?>" name="rptPasswordSignup" id="rptPasswordSignup" type="password" placeholder="masukan ulang password anda"/>                                  
                        </div>
                        <div class="login__withwrapp" >

                          <!-- <div class="login__with">
                              <img class="logo__google img-fluid" src="/img/logo/google.png"/>                                    
                              <p>Login dengan Google</p>                                    
                          </div> -->
                        </div>
                        <div class="btn__signup__wrapp">
                          <button class="btn__signup" id="btn__signup" >Lanjut</button>
                        </div>
                      </form>
                    </div>
                    </div>
                  </div>
                </li>

                <?php } ?>
            </ul>
        </div>
    </div>
    <form id="lupaPassForm" method="POST" action="<?= base_url('/lupaPass') ?>"></form>
</nav>
<!-- Akhir Navbar -->

<!-- Script modal login -->
<script>
  // Get the modal
  var modalLogin = document.getElementById("modalLogin");

  // Get the button that opens the modal
  var btnLogin = document.getElementById("btn-modal-login");

  // Get the <span> element that closes the modal
  var spanLogin = document.getElementById('btn__closeLogin');

  // Get the btn element "lanjut"
  var lanjutLogin = document.getElementById('btn__login')

  // Get the input element
  var userEmailLogin = document.getElementById('emailLogin');
  var userPasswordLogin = document.getElementById('passwordLogin');

  // When the user clicks the button, open the modal 
  btnLogin.onclick = function() {
    modalLogin.style.display = "block";
    modalSignup.style.display = "none";
  }

  // When the user clicks on <span> (x), close the modal
  spanLogin.onclick = function() {
    modalLogin.style.display = "none";
  }

  // When the user change on input, delete class error

  userEmailLogin.oninput = function () {
    document.getElementById('EmailCopy').value = document.getElementById('emailLogin').value;

    userEmailLogin.classList.remove('input__modalLoginError');
    if (!userPasswordLogin.classList.contains('input_modalLoginError')) {
      lanjutLogin.removeAttribute('style');
      lanjutLogin.removeAttribute('disabled'); 
    }
  }

  userPasswordLogin.oninput = function () {
    userPasswordLogin.classList.remove('input__modalLoginError');
    if (!userEmailLogin.classList.contains('input_modalLoginError')) {
      lanjutLogin.removeAttribute('style');
      lanjutLogin.removeAttribute('disabled'); 
    }    
  }

</script> 
<?php if ($validation->hasError('emailLogin') || $validation->hasError('passwordLogin')) { ?>
  <script>
    $(document).ready(function() {
      modalLogin.style.display = "block";
      modalSignup.style.display = "none";
    });
  </script>
<?php } ?>

<!-- Script modal register -->
<script>
  var modalSignup = document.getElementById("modalSignup");

  // Get the button that opens the modal
  var btnSignup = document.getElementById("btn-modal-signup");

  // Get the <span> element that closes the modal
  var spanSignup = document.getElementById('btn__closeSignUp');

  // When the user clicks the button, open the modal 
  btnSignup.onclick = function() {
    modalSignup.style.display = "block";
    modalLogin.style.display = "none";
  }

  // When the user clicks on <span> (x), close the modal
  spanSignup.onclick = function() {
    modalSignup.style.display = "none";
  }
</script>
<?php if (($validation->hasError('namaSignup')) || ($validation->hasError('emailSignup')) || ($validation->hasError('passwordSignup')) || ($validation->hasError('rptPasswordSignup'))) { ?>
  <script>
    $(document).ready(function() {
      modalSignup.style.display = "block";
      modalLogin.style.display = "none";
    });
  </script>
<?php } ?>
