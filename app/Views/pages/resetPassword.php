<?= $this->extend('layout/template');?>

<?= $this->section('content');?>
<!-- Section Contact Us -->
<section class="contact-us logres noselect pt-5">
    <div class="container col-5 text-center pt-5 pb-3 pr-5 pl-5">
        <span class="mt-5" style="color: var(--primary-color) !important;">
            Change Password for <?= $email; ?>
        </span>
        <form id="contactForm" method="POST" action="">
            <?= csrf_field();?>
            <div class="form-group row">
                <div class="col">
                    <input type="password" class="form-control" id="NewPassword" placeholder="New Password" name="NewPassword" value="<?= old('NewPassword');?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('NewPassword');?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    <input type="password" class="form-control" id="ConfirmNewPassword" placeholder="Re-enter New Password" name="ConfirmNewPassword" value="<?= old('ConfirmNewPassword');?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('ConfirmNewPassword');?>
                    </div>
                </div>
            </div>
            <input name="currEmail" value="<?= $emailS ?>" readonly hidden>
            <div class="form-group row mt-5">
                <div class="col">
                    <button type="submit" name="send" class="form-control border-0 btn" id="submitForm">Change Password</button>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Akhir Section Contact Us -->

<?= $this->endSection();?>