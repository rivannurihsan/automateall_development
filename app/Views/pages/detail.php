<?= $this->extend('layout/template');?>

<?= $this->section('content');?>
<!-- Section Detail -->
<section class="detail noselect">
    <div class="container">
        <div class="row text-center justify-content-around">
            <div class="col-11 col-sm-12 col-md-10 col-lg-7 col-xl-6">
                <h1 class="display-3"><?= $judul ?></h1>
                <p class="text-justify"><?= nl2br($isi) ?></p>
            </div>
            <div class="col-8 col-sm-10 col-md-8 mt-3 mt-lg-0 col-lg-5 align-self-start">
                <img src="<?= $img ?>" class="img-fluid" alt="laptop">
            </div>
        </div>
        <div class="row justify-content-around mt-5">
            <div class="col-md-10 col-lg-7 col-xl-6">
                <div class="row text-lg-left text-center">
                    <div class="col-12 col-md-4">
                        <h3>Clients</h3>
                        <p><?= $client ?></p>
                    </div>
                    <div class="col-12 col-md-4">
                        <h3>Services</h3>
                        <p><?= $service ?></p>
                    </div>
                    <div class="col-12 col-md-4">
                        <h3>Year</h3>
                        <p><?= $year ?></p>
                    </div>
                </div>
                <div class="row text-lg-left text-center mt-5">
                    <div class="col">
                        <a href='<?php if($isDelete == 0){echo $fileLocation;}?>' class="btn pt-2 px-4 <?php if($isDelete == 1){echo 'disable';}?>">Try For Free</a>
                    </div>
                    <div class="col">
                        <a class="btn pt-2 px-4 disable">Buy Now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5"></div>
        </div>
    </div>
</section>
<!-- Akhir Section Detail -->
<?= $this->endSection();?>