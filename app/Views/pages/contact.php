<?= $this->extend('layout/template');?>

<?= $this->section('content');?>
<!-- Section Contact Us -->
<section class="contact-us noselect">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-10 offset-1 offset-md-0 text-center text-lg-left offset-md-1 offset-lg-0 col-lg-6">
                <h1 data-sal="slide-right" data-sal-easing="ease-in-sine" data-sal-duration="600">
                    Contact Us
                </h1>
                <p data-sal="slide-right" data-sal-easing="ease-in-sine" data-sal-duration="600">
                    Reach out to us for any enquiry
                </p>
                <form id="contactForm" method="POST" action="<?=base_url('/contact');?>">
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
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            <div class="invalid-feedback">
                                <?= $validation->getError('Email');?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <input type="text" class="form-control" id="Phone" placeholder="Phone" name="Phone" value="<?= old('Phone');?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <textarea class="form-control <?= ($validation->hasError('Msg'))?'is-invalid':''; ?>" rows="5" id="Msg" placeholder="Message" name="Msg" value="<?= old('Msg');?>"></textarea>
                            <div class="invalid-feedback">
                                <?= $validation->getError('Msg');?>
                            </div>
                        </div>
                    </div>
                    <input type="text" class="form-control" id="redir" placeholder="redir" name="redir" value="contact" hidden>
                    <div class="form-group row">
                        <div class="col">
                            <button type="submit" name="send" class="form-control border-0 btn" id="submitForm">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-10 offset-1 col-md-8 offset-md-2 offset-lg-0 col-lg-6 spaceatas1">
                <div id="map">
                    <iframe scrolling="no" marginheight="0" marginwidth="0" id="gmap_canvas" src="https://maps.google.com/maps?width=640&height=409&hl=en&q=Jl.%20Telekomunikasi%20Jl.%20Terusan%20Buah%20Batu,%20Sukapura,%20Kec.%20Dayeuhkolot%20Bandung+(Telkom%20University)&t=p&z=13&ie=UTF8&iwloc=B&output=embed" width="100%" height="300" frameborder="0"></iframe> 
                </div>
            </div>
        </div>
        <div class="row text-center text-xl-left spaceatas2">
            <div class="col-10 offset-1 offset-md-0 mb-5 mb-md-0 col-md-4 col-xl-5"
            data-sal="slide-up" data-sal-easing="ease-in-sine" data-sal-duration="800">
                <img src="/img/vector/geo.png" class="float-xl-left pr-3" alt="geo" style="width:100px;height:100px;">
                <h4 class="mt-3">Location :</h4>
                <span>Jl. Telekomunikasi Jl. Terusan Buah Batu, Sukapura, Kec. Dayeuhkolot, Bandung, Jawa Barat 40257</span>
            </div>
            <div class="col-10 offset-1 offset-md-0 mb-5 mb-md-0 col-md-4 col-xl-4"
            data-sal="slide-up" data-sal-easing="ease-in-sine" data-sal-duration="800">
                <img src="/img/vector/mail.png" class="float-xl-left pr-3" alt="geo" style="width:100px;height:100px;">
                <h4 class="mt-3">Email :</h4>
                <span>contact@automateall.id</span>
            </div>
            <div class="col-10 offset-1 offset-md-0 col-md-4 col-xl-3"
            data-sal="slide-up" data-sal-easing="ease-in-sine" data-sal-duration="800">
                <img src="/img/vector/wa2.png" class="float-xl-left pr-3" alt="geo" style="width:100px;height:100px;">
                <h4 class="mt-3">Whatsapp :</h4>
                <span>+62 899-9211-425</span>
            </div>
        </div>
    </div>
</section>
<!-- Akhir Section Contact Us -->

<?= $this->endSection();?>