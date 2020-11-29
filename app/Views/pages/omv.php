<?= $this->extend('layout/template');?>

<?= $this->section('content');?>
<!-- OMV Section -->
<section class="omv noselect">
    <div class="container-fluid">
        <div class="list-group list-group-horizontal justify-content-end" id="list-tab" role="tablist">
            <a class="list-group-item active border-0 py-0" title="Background" id="list-bg-list" data-toggle="list" href="#list-bg" role="tab" aria-controls="background">Background</a>
            <a class="list-group-item border-0 py-0" id="list-wwd-list" title="What we do?" data-toggle="list" href="#list-wwd" role="tab" aria-controls="wwd">What we do?</a>
            <a class="list-group-item border-0 py-0" id="list-mp-list" title="Main Purpose" data-toggle="list" href="#list-mp" role="tab" aria-controls="mp">Main Purpose</a>
        </div>
    </div>
    <div class="container">
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="list-bg" role="tabpanel" aria-labelledby="list-bg-list">
                <div class="row">
                    <!--<div class="col-10 offset-1 offset-md-0 order-2 col-md-6 order-lg-1 col-lg-6"-->
                    <!--data-sal="slide-right" data-sal-easing="ease-in-sine" data-sal-duration="1000">-->
                    <!--    <img src="/img/pictures/hand.png" class="img-fluid" alt="hand">-->
                    <!--</div>-->
                    <!--<div class="col-10 offset-1 offset-md-0 order-1 col-md-12 order-lg-2 col-lg-6 align-self-center text-center"-->
                    <!--data-sal="slide-right" data-sal-easing="ease-in-sine" data-sal-duration="1000">-->
                    <!--    <h1></h1>-->
                    <!--</div>-->
                    <div class="col-12">
                        <div id="ocr">
                            <picture>
                                <source srcset="/img/drive/compresspng/home-sm.png" media="(max-width: 767.98px)" />
                                <source srcset="/img/drive/compresspng/home-md.png" media="(max-width: 991.98px)" />
                                <source srcset="/img/drive/compresspng/home-lg.png" media="(max-width: 1199.98px)" />
                                <source srcset="/img/drive/compresspng/home.png" media="(min-width: 1200px)" />
                                <img src="/img/drive/compresspng/home-sm.png" class="img-fluid" alt="home"/>
                            </picture>
                        </div>
                    </div>
                    <div class="col-10 offset-1 offset-md-0 order-4 col-md-12 order-lg-3 col-lg-6 offset-lg-3 text-justify" data-sal="slide-left" data-sal-easing="ease-in-sine" data-sal-duration="1000">
                        <p>Automate All adalah startup teknologi yang menyediakan layanan jasa automasi pada proses bisnis di perusahaan atau usaha anda. Kami berfokus pada bidang Robotic Process Automation, RPA sendiri berfungsi menyelesaikan pekerjaan manusia yang bersifat repetitive task yang memakan banyak waktu.</p>
                    </div>
                    <!--<div class="col-10 offset-1 offset-md-0 order-3 col-md-6 order-lg-4 col-lg-6 mt-xl-5"-->
                    <!--data-sal="slide-left" data-sal-easing="ease-in-sine" data-sal-duration="1000">-->
                    <!--    <img src="/img/pictures/book.png" alt="book" class="img-fluid">-->
                    <!--</div>-->
                </div>
                <div class="row" data-sal="fade" data-sal-easing="ease-in-sine" data-sal-duration="1000">
                    <div class="col-10 offset-1 offset-md-0 col-md-12 text-center text-wrap" style="margin-top: 80px;"> 
                        <h1>Your time is now!</h1>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade text-center" id="list-wwd" role="tabpanel" aria-labelledby="list-wwd-list">
                <div class="row">
                    <div class="col">What we do's content is under construction.</div>
                </div>
            </div>
            <div class="tab-pane fade text-center" id="list-mp" role="tabpanel" aria-labelledby="list-mp-list">
                <div class="row">
                    <div class="col">Main purpose's content is under construction.</div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Akhir OMV Section -->

<?= $this->endSection();?>