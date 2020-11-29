<?= $this->extend('layout/template');?>

<?= $this->section('content');?>

<!--Section Article Details-->
<section class="articleDetails">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="detailImage">
                    <img src="<?= $img ?>" alt="gambar">
                </div>
                <div class="detailContent">
                    <span class="date"><?= $tglUpload ?></span>
                    <h1><?= $judul ?></h1>
                    <p class="text-justify"><?= $isi ?></p>
                    <a href="<?= base_url('/blog/all');?>">Back to Article List.</a>
                </div>
            </div>
        </div>
    </div>
</section>




<?= $this->endSection();?>