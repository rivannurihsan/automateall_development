<?= $this->extend('layout/template');?>

<?= $this->section('content');?>
<section class="referral academy noselect">
    <div class="container">
        <div class="row academy-detail-new">
            <div class="col academy-detail-left">
                <p><a>Online Learning</a>/<a>Workshop</a></p>
                <h1><?= $judul ?></h1>
                <img src="<?= $img ?>" />
                <button data-toggle="modal" data-target="#modaldaftar" class="btn-academy daftar <?php if($isSelesai || !isset($userdata) || !$isCanDaftar){echo 'disabled" disabled';}else{echo '"';}?>>Daftar</button>
                <button <?php if((!$isSelesai || !$isFree || $isCanBayar) && isset($userdata)){echo 'onclick="location.href=\'/academy/checkout?id='.$idDaftar.'\'"';}?> class="btn-academy daftar <?php if($isSelesai || !isset($userdata) || $isFree || !$isCanBayar){echo 'disabled" disabled';}else{echo '"';}?>>Bayar</button>
                <?php if((!$isCanDaftar) && !$isFree && isset($userdata)) { ?>
                    <div style="width:300px; margin: 0px auto; margin-top: 50px;" ><p>Status</p></div>
                    <div class="progress" style="height: 30px; width: 300px; margin: 15px auto;">
                        <?php if ($isCanGetCoupon || $isCouponExist) { ?>
                            <div class="progress-bar" role="progressbar" aria-valuenow="<?= ($jumlahPengajak)?$jumlahPengajak:0 ?>"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                <button form="createCode" style="height: 100%; color: white; background: var(--primary-color);" <?= ($isCouponExist)?'disabled':null ?>><p"><?= $couponCode ?></button>
                                <form id="createCode" style="display: none;" action="<?=base_url('/createCoupon?id='.$idAcademy)?>" method="POST">
                                    <input type="text" style="display: none;" name="uniqueCode" value="<?=$userdata['uniqueCode']?>" readonly>
                                    <input type="text" style="display: none;" name="ketCode" value="invite10" readonly>
                                </form>
                            </div>
                        <?php } else { ?>
                            <div class="progress-bar" role="progressbar" aria-valuenow="<?= ($jumlahPengajak)?$jumlahPengajak:0 ?>"
                                aria-valuemin="0" aria-valuemax="100" style="width:<?= ($jumlahPengajak)?$jumlahPengajak:0 ?>0%">
                                <?= ($jumlahPengajak)?$jumlahPengajak:0 ?>/10
                            </div>
                        <?php } ?>

                    </div>
                    <div style="width:400px; margin: 0px auto;" >
                        <ul>
                            <li><p style="font-size: 14px;">bar penuh, menandakan saudara telah mendapatkan kode kupon untuk masuk gratis.</p> </li>
                            <li><p style="font-size: 14px;">agar status terpenuhi, ajak 10 orang atau lakukan pembayaran</p> </li>
                        </ul>  
                    </div>
                <?php } ?>
            </div>
            <div class="col academy-detail-right">
                <div class="academy-detail-schedule">
                    <p><span class="price-course">Price: </span><?= $price ?></p>
                    <div class="detail-course">
                        <img src="/img/vector/calendar.png" />
                        <p><?= $tanggal ?></p>
                    </div>
                    <div class="detail-course">
                        <img src="/img/vector/clock.png" />
                        <p><?= $jammulai ?> - <?= $jamselesai ?> WIB</p>
                    </div>
                    <div class="detail-course">
                        <img src="/img/vector/location.png" />
                        <p>Google Meet</p>
                    </div>
                </div>
                <div class="academy-detail-description">
                    <h3>Deskripsi</h3>
                    <p>
                        <?= $isi ?>
                    </p>
                </div>
                <div class="academy-detail-ketentuan">
                    <h3>Ketentuan</h3>
                    <ol>
                        <li>Batas waktu pendaftaran hingga kegiatan dimulai. </li>
                        <li>Tiket workshop ini dapat diperoleh dengan cara pembelian atau gratis bersyarat. </li>
                        <li>Tiket workshop ini dapat diperoleh dengan cara pembelian atau gratis bersyarat. </li>
                        <li>Syarat tiket gratis ialah mengajak 10 orang untuk mendaftar workshop part 1 (klik disini untuk melihat workshop part 1). </li>
                        <li>Jika kegiatan part 1 berlangsung, dan belum dapat mengajak 10 orang, maka tiket hanya dapat diperoleh melalui pembelian.</li>
                        <li>Persiapkan laptop/komputer dengan OS Windows untuk dapat mengikuti sesi praktek pada kegiatan ini.</li>
                        <li>Jika saudara telah memenuhi ketentuan di atas, kami akan mengirimkan email undangan kegiatan. </li>
                    </ol>
                </div>
                
            </div>
        </div>
    </div>
</section>

<?php if (isset($userdata) && $userdata['isVerifikasi']) { ?> 
    <!-- modal daftar -->
    <?php if ( isset($_SESSION['userData']) ) { ?>
        <div class="modal fade message-sent noselect" id="modaldaftar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content modal__wrapper shadow-lg">
                <div class="modal-body p-0 ">
                <div class="row">
                    <div class="col">
                    <div class="btn__exitModal" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="/img/logo/close.svg" />
                    </div>
                    <h5 class="h5__registrasiModal mb-3">
                        Registrasi <?= $judul ?>
                    </h5>

                    <h6 class="h6__registrasiModal">
                        Mohon isi data di bawah dengan benar
                    </h6>
                    <form name="myForm" class="form__modalDaftar" id="form__modalDaftar" method="POST" data-backdrop="static" action="<?= base_url('/academy/detail/?id='.$idAcademy) ?>">
                        <?= csrf_field();?>
                        <div class="form-group form-groupModal" id="groupModal__nama">
                            <label for="name" class="input__labelModal">Nama</label>
                            <input name="nama" type="text" class="form-control input__valueModal" id="nama" value="<?= $namaPendaftar ?>" disabled />
                        </div>
                        <div class="form-group form-groupModal" id="groupModal__wa">
                            <label for="whatsapp" class="input__labelModal">Nomor whatsapp</label>
                            <input name="Whatsapp" type="text" class="form-control input__valueModal <?= ($validation->hasError('Whatsapp'))?'is-invalid':''; ?>" id="Whatsapp" value="<?= old('Whatsapp');?>"/>
                            <div class="invalid-feedback">
                                <?= $validation->getError('Whatsapp');?>
                            </div>                
                        </div>
                        <div class="form-group form-groupModal" id="groupModal__institusi">
                            <label for="institusi" class="input__labelModal">Perusahaan / institusi</label>
                            <input name="Organisasi" type="text" class="form-control input__valueModal <?= ($validation->hasError('Organisasi'))?'is-invalid':''; ?>" id="Organisasi" value="<?= old('Organisasi');?>"/>
                            <div class="invalid-feedback">
                                <?= $validation->getError('Organisasi');?>
                            </div>                
                        </div>
                        <div class="form-group form-groupModal">
                            <label for="other" class="input__labelModal">Dari mana saudara mengetahui kegiatan ini</label>
                            <br/><small class="small__otherModal">Jika saudara diajak oleh orang lain, harap tulis namanya</small>
                            <input name="Pengajak" id="Pengajak" list="listPengajak" type="text" class="form-control input__valueModal <?= ($validation->hasError('Pengajak'))?'is-invalid':''; ?>" value="<?= old('Pengajak');?>"/>
                            <?php if ($listPeserta) { ?>
                                <datalist id="listPengajak">
                                    <?php foreach ($listPeserta as $peserta) { ?>
                                    <option value="<?php echo $peserta ?>">
                                    <?php } ?>
                                </datalist>
                            <?php } ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('Pengajak');?>
                            </div>                
                        </div>

                        <div class="btn__inputWrapperModal">
                            <p class="p__sureModal">
                                pastikan data telah sesuai sebelum melakukan submit
                            </p>
                        <!-- </div>
                        <div> -->
                            <input onclick="$('#formModal').modal({'backdrop': 'static'});" type="submit" value="Submit" class="btn btn-primary btn__inputModal" id="btn__inputModal"/>
                        </div>
                    </form>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>

        <?php if (isset($_SESSION['isKirim']) && $_SESSION['isKirim'] == 'DaftarForm') { ?>
            <script>
            $(document).ready(function() {
                $('#modaldaftar').modal('show');
            });
            </script>
        <?php } ?>

    <?php } ?>
    <!-- akhir modal daftar -->
<?php } else { ?> 
    <!-- modal daftar -->
    <?php if ( isset($_SESSION['userData']) ) { ?>
        <div class="modal fade message-sent noselect" id="modaldaftar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content modal__wrapper shadow-lg">
                <div class="modal-body p-0 ">
                <div class="row">
                    <div class="col">
                        <div class="btn__exitModal" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="/img/logo/close.svg" />
                        </div>
                        <h5 class="h5__registrasiModal mb-3">
                            Registrasi <?= $judul ?>
                        </h5>

                        <h6 class="h6__registrasiModal">
                            Mohon verifikasi email anda
                        </h6>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>

        <?php if (isset($_SESSION['isKirim']) && $_SESSION['isKirim'] == 'DaftarForm') { ?>
            <script>
            $(document).ready(function() {
                $('#modaldaftar').modal('show');
            });
            </script>
        <?php } ?>

    <?php } ?>
    <!-- akhir modal daftar -->
<?php } ?> 

<?php $_SESSION['isKirim'] = 'NotYet';?>

<?= $this->endSection();?>
