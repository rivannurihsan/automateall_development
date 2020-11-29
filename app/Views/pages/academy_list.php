<?= $this->extend('layout/template');?>

<?= $this->section('content');?>

<!-- Carousel Courses -->
<div class="academy_list">
    <div class="container">
        <div class="row products noselect" style="margin-top: 110px;">
            <div class="col py-3 text-center mb-4">
                <h1 class="display-3">Online Course</h1>
            </div>
        </div>
    </div>
    <div id="carouselControls" class="products noselect carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="container">
                <?php for ($i=0; $i < count($judul); $i++) { ?>
                    <div class="carousel-item <?php if($i==0){echo 'active';} ?>">
                        <div class="row justify-content-center text-center">
                            <div class="col-10 col-lg-6 align-self-center">
                                <img src="<?= $img[$i] ?>" class="img-fluid" alt="laptop">
                            </div>
                            <div class="col-10 mt-4 mt-lg-0 col-lg-5 align-self-center">
                                <h2><?= $judul[$i] ?></h2>
                                <p><?php if(strlen($isi[$i]) > 500 )echo nl2br(substr_replace($isi[$i], '...', 500)); else echo nl2br($isi[0]) ?></p>
                                <div class="row justify-content-around mt-5 text-center detail">
                                    <div class="col-4">
                                        <h4>Tanggal</h4>
                                        <p><?= $tanggal[$i] ?></p>
                                    </div>
                                    <div class="col-4">
                                        <h4>Jam</h4>
                                        <p><?= $jammulai[$i] ?></p>
                                    </div>
                                    <div class="col-4">
                                        <h4>Price</h4>
                                        <p><?= $price[$i] ?></p>
                                    </div>
                                </div>                             
                                <a href="/academy/detail?id=<?= $id[$i] ?>" class="btn pt-2 px-4">See Detail</a>      
                            </div>
                        </div>                   
                    </div>
                <?php } ?>
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
    <!-- Akhir Carousel Courses -->

    <!-- Section Course List -->
    <section class="article_list">
        <div class="container">
            <h2>Online Course List</h2>
            <div class="row mt-5">
                <?php for ($i=0; $i < count($judul); $i++) : ?>
                    <div class="col-md-6 col-lg-4 article-item">
                        <div class="article-img mb-3">
                            <img style="border-radius: 0;" src="<?= $img[$i] ?>" alt="1">
                        </div>
                        <div class="article-content">
                            <h5><?= $judul[$i] ?></h5>
                            <p class="text-justify"><?php if(strlen($isi[$i]) > 200 )echo (substr_replace($isi[$i], '...', 200)); else echo ($isi[0]) ?>
                                <br><span class="date"></span>
                            </p>
                            <div class="row justify-content-around text-center detailmini">
                                <div class="col-6">
                                    <h4>Tanggal</h4>
                                    <p><?= $tanggal[$i] ?></p>
                                </div>
                                <div class="col-6">
                                    <h4>Price</h4>
                                    <p><?= $price[$i] ?></p>
                                </div>
                            </div>       
                            <div class="d-flex justify-content-end">
                                <a href="/academy/detail?id=<?= $id[$i] ?>">View detail</a>
                            </div>
                        </div>
                    </div>
                <?php endfor ?>
            </div>
        </div>
    </section>
</div>
<!-- Akhir Section Our Services -->
<?= $this->endSection();?>