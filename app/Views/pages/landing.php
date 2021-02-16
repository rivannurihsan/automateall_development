<?= $this->extend('layout/template');?>

<?= $this->section('content');?>
<!-- Vektor -->
<img class="position-absolute v1" src="/img/vector/squiggles.png">

<!-- Section Headline -->
<section class="headline">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center" data-sal="fade">
                <video class="landingvideo" controls>
                    <source src="/videos/aboutus.mp4" type="video/mp4">
                </video>
                <!--<iframe width="1000" height="400" src="https://www.youtube.com/embed/Z0LZSVDsNuk" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
            </div>
        </div>
    </div>
    <div class="contact-us text-center">
        <a href="/contact" class="btn border-0 position-relative" style="box-shadow: none;">Contact Us</a>
        <hr>
        <p class="noselect">Consult your bussiness with our expert for free!</p>
    </div>
</section>
<!-- Akhir Section Headline -->

<!-- Section Solution -->
<section class="solution">
    <div class="container">
        <div class="row text-center mb-2">
            <div class="col">
                <h2 class="noselect" data-sal="slide-up" data-sal-easing="ease-out-sine" data-sal-duration="1000">
                    Turn your<span>P R O B L E M S</span>into<span>S O L U T I O N S</span>
                </h2>
            </div>
        </div>
        <div class="row align-items-center justify-content-around">
            <div class="col-6 col-md-5 col-lg-5 col-xl-5">
                <picture>
                    <img src="/img/drive/tired.png" class="img-fluid" alt="tired" data-sal="slide-right" data-sal-easing="ease-out-sine" data-sal-duration="1000"/>
                </picture>
            </div>
            <div class="d-flex justify-content-sm-start justify-content-md-end col-12 col-sm-10 col-md-7 col-lg-7 col-xl-7">
                <h3 class="noselect"
                data-sal="slide-right" data-sal-easing="ease-out-sine" data-sal-duration="1000">
                    Get rest, human<br>Let&nbsp;&nbsp;<span>o u r&nbsp;&nbsp;p r o g r a m s</span>&nbsp;&nbsp;does
                </h3>
            </div>
        </div>
        <div class="row align-items-center text-right justify-content-around mt-sm-5 mt-md-0">
            <div class="col-12 order-last col-sm-10 order-sm-last order-md-first col-md-7 col-lg-7 col-xl-6">
                <h3 class="noselect"
                data-sal="slide-left" data-sal-easing="ease-out-sine" data-sal-duration="1000">
                    <span>Stop</span> repetitive spending,<br><span>L e s s&nbsp;&nbsp;c o s t</span>&nbsp;&nbsp;is better
                </h3>
            </div>
            <div class="col-6 mt-4 mt-sm-0 order-sm-first order-md-last col-md-5 col-lg-5 col-xl-5">
                <img src="/img/vector/wallet2.png" class="img-fluid" alt="wallet2"
                data-sal="slide-left" data-sal-easing="ease-out-sine" data-sal-duration="1000" width="463" height="330">
            </div>
        </div>
    </div>
</section>
<!-- Akhir Section Solution -->

<!-- Section Why -->
<section class="why noselect why__container">
    <div class="wave__container"><img class="wave__img" src="/img/vector/river.png"></div>
    <div class="container">
        <div class="row text-center">
            <div class="p-0 col-7 offset-2 order-last offset-md-0 order-md-first col-md-4 col-lg-3 col-xl-3 one-card">
                <div class="card px-1 py-4 p-lg-5"
                data-sal="slide-up" data-sal-easing="ease-out-sine" data-sal-duration="1000" id="card-width" >
                    <img src="/img/vector/wallet.png" class="card-img-top" alt="wallet">
                    <div class="card-body p-0">
                        <h3 class="card-text mt-3">
                            Cost Saving
                        </h3>
                        <p>Pembuatan bot lebih murah dibanding gaji karyawan</p>
                    </div>
                </div>
            </div>  
            <div class="col-7 order-first order-md-last col-md-8 col-lg-9 col-xl-9">
                <div class="row">
                    <div class="col why-text">
                        <h1 class="text-left text-md-right mb-0"
                        data-sal="zoom-in" data-sal-easing="ease-in-sine" data-sal-duration="800">why</h1>
                        <h3 id="aa" class="text-left"
                        data-sal="zoom-in" data-sal-easing="ease-in-sine" data-sal-duration="800">automate all?</h3>
                    </div>
                </div>
                <div class="row two-card">
                    <div class="p-0 mb-5 mb-md-0 col-12 offset-4 offset-md-0 align-self-start col-md-6 col-lg-4 offset-lg-1">
                        <div class="card px-1 py-4 p-lg-5" 
                        data-sal="slide-up" data-sal-easing="ease-out-sine" data-sal-duration="1000" id="card-width">
                            <img src="/img/vector/savetime.png" class="card-img-top" alt="savetime">
                            <div class="card-body p-0">
                                <h3 class="card-text mt-3">
                                    Save Time
                                </h3>
                                <p>Pekerjaan otomatis dilakukan oleh bot</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-0 mb-5 mb-md-0 col-12 offset-4 offset-md-0 align-self-center align-self-lg-end col-md-6 col-lg-4 offset-lg-1">
                        <div class="card px-1 py-4 p-lg-5"
                        data-sal="slide-up" data-sal-easing="ease-out-sine" data-sal-duration="1000" id="card-width" ">
                            <img src="/img/vector/humanerror.png" class="card-img-top" alt="humanerror">
                            <div class="card-body p-0">
                                <h3 class="card-text mt-3">
                                    No Human Error
                                </h3>
                                <p>Bot yang terprogram tidak akan melakukan kesalahan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Akhir Section Why -->

<?= $this->endSection();?>