<?= $this->extend('layout/template');?>

<?= $this->section('content');?>

<!-- Section Blog -->
<section class="blog">
    <div class="container">
        <div class="row justify-content-around">
            <div class="col-10 col-sm-12 col-md-11 col-lg-5 col-xl-6">
                <img src="<?= $img[0] ?>" class="img-fluid" alt="webinar"
                data-sal="slide-right" data-sal-easing="ease-in-sine" data-sal-duration="1000">
                <h1
                data-sal="slide-right" data-sal-easing="ease-in-sine" data-sal-duration="1000"><?= $judul[0] ?></h1>
                <p class="text-justify" data-sal="slide-right" data-sal-duration="1000">
                    <?php if(strlen($isi[0]) > 700 )echo (substr_replace($isi[0], '...', 700)); else echo ($isi[0]) ?>
                    <br>
                    <a class="small-link" style="font-size:18px;" href="<?= base_url('/blog/detail?id='.$id[0]);?>">
                        View in detail.
                    </a>
                    <span class="date text-right"><?= $tglUpload[0] ?></span>
                </p>
            </div>
            <div class="col-10 col-sm-12 col-md-11 col-lg-7 col-xl-6">
                <div class="row text-left">
                    <?php if(count($judul) > 4) {$max = 5;}else {$max = count($judul);} ?>
                    <?php for ($i=1; $i < $max; $i++) : ?>
                        <div class="col-md-6"
                        data-sal="slide-left" data-sal-easing="ease-in-sine" data-sal-duration="1000">
                            <img src="<?= $img[$i] ?>" class="img-fluid" alt="event">
                            <h4><?= $judul[$i] ?></h4>
                            <p class="smaller-p text-justify">
                                <?php if(strlen($isi[$i]) > 200 )echo (substr_replace($isi[$i], '...', 200)); else echo ($isi[0]) ?>
                                <br>
                                <a class="small-link" href="<?= base_url('/blog/detail?id='.$id[$i]);?>">View in detail.</a>
                                <span class="date text-right"><?= $tglUpload[$i] ?></span>
                            </p>
                        </div>
                    <?php endfor ?>
                </div>
                <?php if($max > 4) : ?>
                <div class="row" style="margin-top: 1.5rem;">
                    <div class="col text-center">
                        <a class="big-link" href="<?= base_url('/blog/all');?>">View all Articles</a>
                    </div>
                </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</section>
<!-- Akhir Section Blog -->


<?= $this->endSection();?>