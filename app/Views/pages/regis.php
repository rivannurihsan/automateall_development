<?= $this->extend('layout/template');?>

<?= $this->section('content');?>
<!-- Section Contact Us -->
<section class="contact-us logres noselect pt-5">
    <div class="container col-5 text-center pt-5 pb-3 pr-5 pl-5">
        <h1 style="color: var(--primary-color) !important;">
            Join Us
        </h1>
        <form id="contactForm" method="POST" action="<?=base_url('/regis');?>">
            <?= csrf_field();?>
            <div class="form-group row">
                <div class="col">
                    <input type="text" class="form-control <?= ($validation->hasError('Name'))?'is-invalid':''; ?>" id="Name" placeholder="Name" name="Name" value="<?= old('Name');?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('Name');?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    <input type="email" class="form-control <?= ($validation->hasError('Email'))?'is-invalid':''; ?>" id="Email" placeholder="Email" name="Email" value="<?= old('Email');?>" aria-describedby="emailHelp">
                    <div class="invalid-feedback">
                        <?= $validation->getError('Email');?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    <input oninput="cekPasswordStrong()" type="password" class="form-control <?= ($validation->hasError('Password'))?'is-invalid':''; ?>" id="Password" placeholder="Password" name="Password" value="<?= old('Password');?>" aria-describedby="passwordHelp">
                    <div class="invalid-feedback">
                        <?= $validation->getError('Password');?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    <input type="password" class="form-control <?= ($validation->hasError('ConfirmPassword'))?'is-invalid':''; ?>" id="ConfirmPassword" placeholder="ConfirmPassword" name="ConfirmPassword" value="<?= old('ConfirmPassword');?>" aria-describedby="passwordHelp">
                    <div class="invalid-feedback">
                        <?= $validation->getError('ConfirmPassword');?>
                    </div>
                </div>
            </div>
            <div class="form-group row mt-5">
                <div class="col">
                    <button type="submit" name="send" class="form-control border-0 btn" id="submitForm">Register</button>
                </div>
            </div>
            <div class="form-group row">
                <div class="col link">
                    Already registered?
                    <a href="/login">Login now!</a>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Akhir Section Contact Us -->

<!-- Modal Pesan Terkirim -->
<div class="modal fade message-sent noselect" id="sentSuccessModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body p-0 text-center">
                <img src="img/vector/tick.png" class="mb-4" style="width:132px;height:132px;margin-top: 30px">
                <p>The message was successfuly sent!</p>
                <button type="button" class="btn" data-dismiss="modal">OK</button>
                <img src="/img/vector/ellipse.png" class="img-fluid ellipse" alt="ellipse">
            </div>
        </div>
    </div>
</div>

<!-- Akhir Modal Pesan Terkirim -->

<script>
    // sMet = 0;
    // function cekPasswordStrong() {
    //     sArr = ['Very Weak', 'Weak', 'Medium', 'Strong', 'Very Strong']
    //     passTag = document.getElementById("Password").value;

    //     if (passTag.length > 2) {
    //         sMet+=1;
    //     }else{
    //         sMet-=1;
    //     }

    //     // if (passTag.match(/[]/)) {
    //     //     document.getElementById('strength').innerHTML = sArr[1];
    //     // }

    //     alert(sMet);

    //     switch(sMet) {
    //         case 1:
    //             document.getElementById('strength').innerHTML = sArr[0];
    //             break;
    //         case 2:
    //             document.getElementById('strength').innerHTML = sArr[1];
    //             break;
    //         case 3:
    //             document.getElementById('strength').innerHTML = sArr[2];
    //             break;
    //         case 4:
    //             document.getElementById('strength').innerHTML = sArr[3];
    //             break;
    //         case 4:
    //             document.getElementById('strength').innerHTML = sArr[4];
    //             break;                
    //         }
    // }
</script>

<?= $this->endSection();?>