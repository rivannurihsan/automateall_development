<?= $this->extend('layout/template');?>

<?= $this->section('content');?>
<!-- Section Verify Account -->

<section class="contact-us logres noselect pt-5">
    <div class="container col-5 text-center pt-5 pb-3 pr-5 pl-5" style='margin-bottom: 250px'>
        <span class="mt-5" style="color: var(--primary-color) !important;">
            Verify email <?= $email; ?>
        </span>
        <form id="contactForm" method="POST" action="<?=base_url('/verifyAccount?token='.$_GET['token']);?>">
            <input name="currEmail" value="<?= $emailS ?>" readonly hidden>
            <div class="form-group row mt-5">
                <div class="col">
                    <button type="submit" name="send" class="form-control border-0 btn" id="submitForm">Verify Account</button>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Akhir Section Verify Account -->

<?= $this->endSection();?>