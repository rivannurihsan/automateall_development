<?= $this->extend('layout/template');?>

<?= $this->section('content');?>

<!--Article List Section-->
<section class="article_list">
    <div class="container">
        <div class="row">
            <?php for ($i=0; $i < count($judul); $i++) : ?>
                <div class="col-md-6 col-lg-4 article-item">
                    <div class="article-img">
                        <img src="<?= $img[$i] ?>" alt="1">
                    </div>
                    <div class="article-content">
                        <h5><?= $judul[$i] ?></h5>
                        <p class="text-justify"><?php if(strlen($isi[$i]) > 200 )echo (substr_replace($isi[$i], '...', 200)); else echo ($isi[0]) ?>
                            <br><span class="date"><?= $tglUpload[$i] ?></span>
                        </p>
                        <div class="d-flex justify-content-end">
                            <a href="<?= base_url('/blog/detail?id='.$id[$i]);?>">View in detail</a>
                        </div>
                    </div>
                </div>
            <?php endfor ?>
        </div>
    </div>
</section>
<!--Akhir Article List Section-->


<?= $this->endSection();?>