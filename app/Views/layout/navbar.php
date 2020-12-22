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
                          <a class="nav-link login" href="<?= base_url('/login');?>" title="Login">Login</a>
                          <button class="nav-link signup__btn" id="btn-modal-signup" class="modal-signup"  title="Login">Daftar</button>
                          <div id="myModal" class="modal__signup">
                            <div class="modalDaftar__wrap">
                            <div class="modal__content-signup">
                            <div class="btn__closeSignUp__wrapp"><button id="btn__closeSignUp"><img class="logo__google img-fluid" src="/img/vector/cancel.png"/></button></div> 
                              <form name="formSignUp" class="formSignUp" onsubmit="return(lanjutSIgnup())">                                
                                <div class="form-group" id="form-group__namalengkap">
                                  <label class="label__modaldaftar" for="nama">Nama Lengkap</label>
                                  <input class="input__modaldaftar input__modaldaftarUP" name="nama" id="nama" type="text" placeholder="Masukan nama anda"/>
                                </div>
                                <div class="form-group div__modaldaftarUP" id="form-group__email">
                                  <label class="label__modaldaftar" for="email">E-mail</label>
                                  <input class="input__modaldaftar input__modaldaftarUP" name="email" id="email" type="email" placeholder="Masukan email anda"/>
                                </div>
                                <div class="form-group div__modaldaftarUP" id="form-group__password">
                                  <label class="label__modaldaftar" for="password">Password</label>
                                  <input class="input__modaldaftar input__modaldaftarUP" name="password" id="password" type="password" placeholder="Buat password anda"/>
                                </div>
                                <div class="form-group div__modaldaftarUP" id="form-group__rptPassword">
                                  <label class="label__modaldaftar" for="rptPassword">Ulangi Password</label>
                                  <input class="input__modaldaftar input__modaldaftarUP" name="rptPassword" id="rptPassword" type="password" placeholder="masukan ulang password anda"/>
                                </div>
                                <div class="login__withwrapp" >
                                  <div class="login__with">
                                      <img class="logo__google img-fluid" src="/img/logo/google.png"/>                                    
                                      <p>Login dengan Google</p>                                    
                                  </div>
                                </div>
                                <div class="btn__signup__wrapp">
                                  <input type="submit" class="btn__signup" id="btn__signup" value="Lanjut"/>
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
  // Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("btn-modal-signup");

// Get the <span> element that closes the modal
var span = document.getElementById('btn__closeSignUp');

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}
  var getNamaSignup = document.getElementById('nama').value
  var getEmailSignup = document.getElementById('email').value
  var getPasswordSignup = document.getElementById('password').value
  var getRptPasswordSignup = document.getElementById('rptPassword').value

// function lanjutSIgnup(){
//   if(getNamaSignup != "" && getEmailSignup != "" && getPasswordSignup != "" && getRptPasswordSignup != ""){
//     return true;
//   }else{
//     const btnInputSignUp = document.getElementById("btn__signup")
//     btnInputSignUp.setAttribute("disabled", "disabled")
    
//     const formGetMOdalNama = document.getElementById('form-group__namalengkap')
//     const formGetModalEmail = document.getElementById('form-group__email')
//     var errorIcon = document.createElement("IMG");
//       errorIcon.setAttribute("src", "/img/vector/error.png");
//       errorIcon.setAttribute("width", "20");
//       errorIcon.setAttribute("height", "20");
//       errorIcon.classList.add("errorIcon")
//       formGetMOdalNama.appendChild(errorIcon); 
//       // formGetModalEmail.appendChild(errorIcon);
//     return false;
//   }
  
// }

function cekValue(){
  var getNamaSignup = document.forms['formSignUp']['nama'].value;
  var getEmailSignup = document.forms['formSignUp']['email'].value;
  var getPasswordSignup = document.forms['formSignUp']['password'].value;
  var getRptPasswordSignup = document.forms['formSignUp']['rptPassword'].value;
}
</script>