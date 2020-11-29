<?= $this->extend('layout/template');?>

<?= $this->section('content');?>
<section class="referral academy noselect">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12"><h1><?= $judul ?></h1></div>
            <div class="col-12"><p class="subjudul"><?= $subjudul ?></p></div>
        </div>
        <div class="row text-center justify-content-around">
            <div class="col-8 col-sm-10 col-md-8 mt-3 mt-lg-0 col-lg-5 align-self-start">
                <div class="row  justify-content-around">
                    <img src="<?= $img ?>" class="img-fluid" alt="laptop">
                </div>
                <div class="row justify-content-around mt-5">
                    <a href="<?= $link ?>" class="btn border-0 <?php if(date('Y-m-d H:i:s') > $tanggal.' '.$jammulai){echo 'disabled';} ?>" style="box-shadow: none;" >Daftar</a>
                </div>
            </div>
            <div class="col-11 col-sm-12 col-md-10 col-lg-7 col-xl-6">
                <p class="text-justify" style="font-size: 16px;">
                    <?= $isi ?>
                </p>
            </div>
        </div>
        <div class="row justify-content-around mt-5 text-center detail">
            <div class="col-4">
                <h4>Tanggal</h4>
                <p style="font-size: 16px;"><?= $tanggal ?></p>
            </div>
            <div class="col-4">
                <h4>Jam</h4>
                <p style="font-size: 16px;"><?= $jammulai.' - '.$jamselesai ?></p>
            </div>
            <div class="col-4">
                <h4>Price</h4>
                <p style="font-size: 16px;"><?= $price ?></p>
            </div>
        </div>
        <?php if($price != 'FREE') { ?>
        <div class="row mt-1 text-right detail">
            <div class="col">
                <p style="font-size: 16px;">* mengajak 10 orang mendaftar part 1.</p>
            </div>
        </div>
        <?php }?>
        <!--<div class="d-flex justify-content-end">-->
        <!--    <a href="/academy/list" style="color:#0F4C75; font-size: 16px;">Kembali ke Course List.</p>-->
        <!--</div>-->
        <?php if(($price != 'FREE') && ($tanggal.' '.$jammulai > date('Y-m-d H:i:s'))) { ?>
        <div class="row" style="margin-top: 100px;">
            <h2>List Pendaftar</h2>
        </div>
        <div class="row mt-2">
            <table class="table table-hover">
                <thead>
                    <tr class="d-flex">
                        <th class="col-1" scope="col"></th>
                        <th class="col-3" scope="col">Nama Pendaftar</th>
                        <th class="col-6" scope="col">Progress</th>
                        <th class="col-2" scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($nama > 0) { ?>
                    <?php foreach ($nama as $i => $val) {?>
                    <tr class="d-flex">
                        <th class="col-1" id="number" scope="row"><div class="center"><?=$i+1?></div></th>
                        <td class="col-3" id="name"><div class="center"><?=$val?></div></td>
                        <td class="col-6" id="progress">
                            <div class="progress center">
                                <div class="progress-bar" role="progressbar" aria-valuenow="<?= $progress[$i] ?>0" aria-valuemin="0" aria-valuemax="100" style="width:<?= $progress[$i] ?>0%;">
                                    <?= $progress[$i] ?>/10
                                </div>
                            </div>
                        </td>
                        <td class="col-2" id="status">
                                <form id="contactForm" method="POST" action="<?=base_url('/academy/detail');?>">
                                    <?= csrf_field();?>
                                    <div>
                                        <div>
                                            <input type="text" class="<?= ($validation->hasError('Name'))?'is-invalid':''; ?>" id="Name" placeholder="Name" name="Name" value="<?= $val.' (Bot)'; ?>" hidden>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('Name');?>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <input type="email" class="<?= ($validation->hasError('Email'))?'is-invalid':''; ?>" id="Email" placeholder="Email" name="Email" value="<?= $email[$i]; ?>" aria-describedby="emailHelp" hidden>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('Email');?>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <input type="text" class="form-control" id="Phone" placeholder="Phone" name="Phone" value="<?= old('Phone');?>" hidden>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <textarea class="<?= ($validation->hasError('Msg'))?'is-invalid':''; ?>" rows="5" id="Msg" placeholder="Message" name="Msg" value="<?= old('Msg');?>" hidden>Pelanggan <?=$val?> sudah mengajak 10 orang, mohon kirim konfirmasi ke email pelanggan <?= $email[$i] ?> (BOT).&lt;br&gt;Send id : <?= rand() ?> </textarea>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('Msg');?>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="redir" placeholder="redir" name="redir" value="referral" hidden>
                                    <input type="text" class="form-control" id="id" placeholder="id" name="id" value="<?= $id; ?>" hidden>
                                    <div>
                                        <div>
                                        <button type="submit" name="send" class="border-0 btn <?php if($progress[$i]<10){ echo 'disabled'; } ?>" id="submitForm" <?php if($progress[$i]<10){ echo 'Disabled'; } ?> >Masuk Gratis</button>
                                        </div>
                                    </div>
                                </form>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php } else {
                        echo '
                        <tr class="d-flex"> 
                            <th class="col-12" id="number" scope="row"><div class="center">Belum ada pendaftar</div></th>
                        </tr>';
                    }?>
                </tbody>
            </table>
        </div>
        <?php } ?>
    </div>
</section>


<?= $this->endSection();?>
