<?= $this->extend('layout/template');?>

<?= $this->section('content');?>
<!-- Section Contact Us -->
<section class="contact-us logres noselect pt-5">
    <h1 class="text-center" style="font-size: 40px;">
        Welcome to Automate All
    </h1>
    <div class="container col-5 text-center pt-5 pb-3 pr-5 pl-5 mt-5">
        <form id="contactForm" method="POST" action="<?=base_url('/login');?>" style="margin-top: 0px;">
            <?= csrf_field();?>
            <div class="form-group row">
                <div class="col">
                    <input type="email" class="form-control <?= ($validation->hasError('Email'))?'is-invalid':''; ?>" id="Email" placeholder="Email" name="Email" value="<?= old('Email');?>" aria-describedby="emailHelp" onchange="document.getElementById('EmailCopy').value = document.getElementById('Email').value;" oninput="hideButton()">
                    <div class="invalid-feedback">
                        <?= $validation->getError('Email');?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    <input type="password" class="form-control <?= ($validation->hasError('Password'))?'is-invalid':''; ?>" id="Password" placeholder="Password" name="Password" value="<?= old('Password');?>" aria-describedby="passwordHelp">
                    <div class="invalid-feedback">
                        <?= $validation->getError('Password');?>
                    </div>
                </div>
            </div>
            <?php if($lupaPass) { ?>
                <div id="lupaPassword" class="invalid-feedback" style="display: block;"> 
                    <button class="btn link" form="lupaPass" >Forgot Password</button>
                </div>
            <?php } ?>
            <div class="form-group row mt-5">
                <div class="col">
                    <button type="submit" name="send" class="form-control border-0 btn">Login</button>
                </div>
            </div>
            <div class="form-group row">
                <div class="col link">
                    Don't have an account yet?
                    <a href="/regis"> Register now</a>
                </div>
            </div>
        </form>
    </div>
    <!-- <input type="text" id="trash">  -->
</section>
<?php if($lupaPass) { ?>
    <form method="POST" action="<?=base_url('/lupaPass');?>" id="lupaPass" hidden>
        <input id="EmailCopy" name="EmailCopy" value="<?= old('Email');?>">
    </form>
<?php } ?>

<script>
    window.onload = hideButton();
    function hideButton() {
        $docEmail = document.getElementById('Email').value;
        $docLupaPass = document.getElementById('lupaPassword').value;

        if (($docEmail.length <= 0) || ($docEmail != "<?php if(isset($_SESSION['tryLoginEmail'])){echo $_SESSION['tryLoginEmail'];} ?>")) {
            document.getElementById('lupaPassword').setAttribute('hidden', true);
        }else{
            document.getElementById('lupaPassword').removeAttribute('hidden');
        }
    }
</script>
<!-- Akhir Section Contact Us -->

<?= $this->endSection();?>