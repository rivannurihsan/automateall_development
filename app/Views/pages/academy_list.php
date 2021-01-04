<?= $this->extend('layout/template');?>

<?= $this->section('content');?>

<!-- Carousel Courses -->
<section class="academy noselect">
    <div class="container">
        <div class="row">
            <div class="col text-center academy-list-title">
                <h1>Online Learning</h1>
                <p class="mx-auto">Workshop</p>
            </div>
        </div>
        <div class="row online-learning-list">
            <?php for ($i=0; $i < count($idAcademy); $i++) { ?>
                <div class="col">
                    <div class="card mt-5 mx-auto">
                        <img class="card-img-top crop-img" src="<?=$img[$i]?>" />
                        <div class="card-body">
                            <h2 class="card-title"><?=$judul[$i]?></h2>
                            <div class="card-text">
                                <p><span class="price-course">Price: </span><?=$price[$i]?></p>
                                <div class="detail-course">
                                    <img src="/img/vector/calendar.png" />
                                    <p><?=$tanggal[$i]?></p>
                                </div>
                                <div class="detail-course">
                                    <img src="/img/vector/clock.png" />
                                    <p><?=$jammulai[$i]?> - <?=$jamselesai[$i]?> WIB</p>
                                </div>
                                <div class="detail-course">
                                    <img src="/img/vector/location.png" />
                                    <p>Google Meet</p>
                                </div>
                                <button onclick="location.href='/academy/detail?id=<?=$idAcademy[$i]?>&openDaftar=1'" class="btn btn-daftar <?php if($isSelesai[$i] || !isset($userdata) || !$isCanDaftar[$i]){echo 'disabled" disabled';}else{echo '"';}?>>Daftar</button>
                                <p"">
                                <button class="btn btn-detail" onclick="location.href='/academy/detail?id=<?=$idAcademy[$i]?>'">Detail</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    
</section>
<!-- Akhir Section Our Services -->
<?= $this->endSection();?>