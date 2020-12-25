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
                <li class="nav-item nav-item__auth <?php if($title=='Login'){echo 'active';}?>">
                    <?php if(isset($userdata['nama'])){ ?>
                        <div class="dropdown">
                            <a class="nav-link login" data-toggle="dropdown"><?= $userdata['nama'] ?></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= base_url('/logout');?>">Logout</a></li>
                            </ul>
                        </div>
                    <?php }else{ ?>
                        <button class="nav-link login__btn" id="btn-modal-login" class="modal-login"  title="Login">Login</button>
                          <div id="myModal" class="modal__login">
                            <div class="modalLogin__wrap">
                            <div class="modal__content-login">
                            <div class="btn__closeLogin__wrap"><button id="btn__closeLogin"><img class="logo__google img-fluid" src="/img/vector/cancel.png"/></button></div> 
                              <form name="formLogin" class="formLogin" >                                
                                <div class="form-group div__modalLogin" id="form-group__email">
                                  <label class="label__modalLogin" for="email">E-mail</label>
                                  <input class="input__modalLogin input__modalLogins" name="email" id="email" type="email" placeholder="Masukan email anda"/>
                                </div>
                                <div class="form-group div__modalLogins" id="form-group__password">
                                  <label class="label__modalLogin" for="password">Password</label>
                                  <input class="input__modalLogin input__modalLogins" name="password" id="password" type="password" placeholder="Buat password anda"/>
                                </div>
                                <div class="login__withwrap" >
                                  <div class="login__with">
                                      <img class="logo__google img-fluid" src="/img/logo/google.png"/>                                    
                                      <p>Login dengan Google</p>                                    
                                  </div>
                                </div>
                                <div class="signup_linkwrap">
                                    <a class="signup_link" href="#">Saya tidak punya akun</a>
                                </div>
                                <div class="btn__login__wrap">
                                  <input type="submit" class="btn__login locked" id="btn__login" value="Lanjut"/>
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

<!-- Akhir Navbar -->
<script>
  // Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("btn-modal-login");

// Get the <span> element that closes the modal
var span = document.getElementById('btn__closeLogin');

// Get the btn element "lanjut"
var lanjut = document.getElementById('btn__login')

var userEmail = document.getElementById('email');
var userPassword = document.getElementById('password');


// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}
  var getEmail = document.getElementById('email').value
  var getPassword= document.getElementById('password').value

var userEmail = document.getElementById('email');
var userPassword = document.getElementById('password');

userEmail.addEventListener('keydown', function() {   
    var getEmail = document.getElementById('email').value   
    if(getEmail) {
        lanjut.classList.remove('locked')
    }
}
)


function cekValue(){
  var getEmail = document.forms['formSignUp']['email'].value;
  var getPassword = document.forms['formSignUp']['password'].value;
}
</script> 