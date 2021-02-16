<?= $this->extend('layout/template');?>

<?= $this->section('content');?>
<!-- Carousel Products -->
<div class="container">
    <div class="row products noselect" style="margin-top: 110px;">
        <div class="col py-3 text-center mb-4">
            <h1 class="display-3">Products</h1>
        </div>
    </div>
</div>
<div id="carouselControls" class="products noselect carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="container">
            <?php for ($i=0; $i < count($judul); $i++) : ?>
                <div class="carousel-item <?php if($i==0){echo 'active';} ?>">
                    <div class="row justify-content-center text-center">
                        <div class="col-10 col-lg-6 align-self-center">
                            <img src="<?= $img[$i] ?>" class="img-fluid" alt="laptop">
                        </div>
                        <div class="col-10 mt-4 mt-lg-0 col-lg-5 align-self-center">
                            <h2><?= $judul[$i] ?></h2>
                            <p><?php if(strlen($isi[$i]) > 500 )echo nl2br(substr_replace($isi[$i], '...', 500)); else echo nl2br($isi[0]) ?></p>
                            <a href="/detail?id=<?= $id[$i] ?>" class="btn pt-2 px-4">See Detail</a>      
                        </div>
                    </div>
                </div>
            <?php endfor ?>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!-- Akhir Carousel Products -->

<!-- Section Our Services -->
<section class="services noselect">
    <div class="container">
        <div class="row text-center">
            <div class="col">
                <h1 class="display-3" style="margin-top: 60px;">Our Services</h1>
            </div>
        </div>
        <div class="row justify-content-around mt-5 text-center">
            <div class="col-8 col-md-5 col-lg-4 mb-lg-0 col-xl-3" style="margin-bottom: 80px;">
                <div class="card p-4"
                data-sal="slide-up" data-sal-easing="ease-in-sine" data-sal-duration="1500">
                    <img src="/img/vector/sketch.png" class="card-img-top" alt="sketch" width="140" height="140">
                    <div class="card-body p-0">
                        <h2 class="card-text">Customized<br>Bot</h2>
                    </div>
                </div>
            </div>
            <div class="col-8 col-md-5 col-lg-4 mb-lg-0 col-xl-3" style="margin-bottom: 80px;">
                <div class="card p-4"
                data-sal="slide-up" data-sal-easing="ease-in-sine" data-sal-duration="1500">
                    <img src="/img/vector/list.png" class="card-img-top" alt="list" width="140" height="140">
                    <div class="card-body p-0">
                        <h2 class="card-text">Commissioning & Training</h2>
                    </div>
                </div>
            </div>
            <div class="col-8 col-md-5 col-lg-4 col-xl-3">
                <div class="card p-4"
                data-sal="slide-up" data-sal-easing="ease-in-sine" data-sal-duration="1500">
                    <img src="/img/vector/repair.png" class="card-img-top" alt="repair" width="140" height="140">
                    <div class="card-body p-0">
                        <h2 class="card-text">Process Unit Maintenance</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Akhir Section Our Services -->
<?= $this->endSection();?>